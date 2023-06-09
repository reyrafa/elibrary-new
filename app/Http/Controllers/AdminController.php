<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\CollectionUpdateHistory;
use App\Models\EmailValidation;
use App\Models\Librarian;
use App\Models\LibrarianAddedCollection;
use App\Models\LibrarianDeletedCollection;
use App\Models\LibrarianRestoredCollection;
use App\Models\Location;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Section;
use App\Models\Subject;
use App\Models\TemporaryFile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Kreait\Firebase\Contract\Database;

class AdminController extends Controller
{
    //process on connecting firebase
    public function __construct(Database $database)
    {
        $this->database = $database;
        $this->tablename = 'collections';
       
    }
    //route to admin page
    public function index(){
        $librarian =Librarian::all()->where('librarian_id', Auth::user()->id);
        return view('admin.index', \compact('librarian'));
    }

    //route to manage librarian page
    public function manage_user(){
        $librarian = Librarian::all();
        $role = Role::all();
        $user = User::all();
        return view('admin.usermanagement.index', compact('librarian', 'role', 'user'));
    }

    //route to add librarian page
    public function add_page(){
        $last = User::all()->last()->pluck('id');
        return view('admin.usermanagement.add_user', \compact('last'));
    }

    //route to validate email address
    public function validate_email(Request $request){
        $data = EmailValidation::select('email')->where('email', $request->id)->take(100)->get();
        return response()->json($data);
    }

    //route to add librarian
    public function add_librarian(Request $request){
        
        $user = new User();
   
        $user->email = $request->email;
        $user->id = $request->id;
        $user->password = Hash::make($request->password);
        $user->status_id = '1';
        $user->scope = 'librarian';
        $user->save();

        $librarian = new Librarian();
        $librarian->id = $request->id;
        $librarian->librarian_id = $user->id;
        $librarian->id_number = $request->id_number;
        $librarian->firstname = $request->firstname;
        $librarian->lastname = $request->lastname;
        $librarian->middlename = $request->middlename;
        $librarian->role_id = $request->role;
        $librarian->org_id = $request->org;
        $librarian->save();

        return redirect('/admin/user/manage/user');
        //return request()->input();
    }
    
    //route to update librarian
    public function update_page($id){
        $librarian = Librarian::all()->where('librarian_id', $id);
        $role = Role::all();
        $user = User::all()->where('id', $id);
        return view('admin.usermanagement.update_user', compact('librarian', 'user', 'role'));
    }

    //update librarian
    public function update_librarian(Request $request){
        $data = Librarian::find($request->id);
        $data->id_number = $request->id_number;
        $data->firstname = $request->firstname;
        $data->lastname = $request->lastname;
        $data->middlename = $request->middlename;
        $data->role_id = $request->role;
        $data->updated_at = now();
        $data->save();

        $user = User::find($request->librarian_id);
        $user->status_id = $request->status_id;
       
        $user->save();
        return \redirect('/admin/user/manage/user');
    }

    //route to collection page
    public function collection_page(){
        $collection = Collection::all();
        $location = Location::all();
        $section = Section::all();
        $subject = Subject::all();
        $librarian = Librarian::all()->where('librarian_id', Auth::user()->id);
        return \view('admin.collectionmanagement.index', \compact('collection', 'location', 'section', 'subject','librarian'));
    }

    //route to collection add page
    public function collection_add_page(){
        $location =Location::all();
        $section = Section::all();
        $subject = Subject::all();
        $permission = Permission::all();
        return \view('admin.collectionmanagement.add_collection', \compact('location', 'section', 'subject', 'permission'));
    }

    //process on uploading file

    public function upload(Request $request){
        //if($request->hasFile('filelink')){
        //    $file = $request->file('filelink');
        //    $filename1 =$file->getClientOriginalExtension();
        //    $filename = \time() . '.' . $filename1;
        //    $folder = uniqid() . '-' . now()->timestamp;
        //    $file->storeAs('/public/filelink/tmp/'.$folder, $filename);
//
        //    TemporaryFile::create([
        //        'folder'=>$folder,
        //        'filename'=>$filename
        //    ]);
        //    return $folder;
        //}
        return '';
    }

    //process in storing collection data
    public function add_collection(Request $request){
        //on firebase database
        $postRef = $this->database->getReference($this->tablename)->push()->getKey();
        $postData =[
            'id' => $request->id,
            'key' => $postRef,
            'title' => $request->title,
            'author' => $request->author,
            'isbn' => $request->isbn,
            'call_num'=> $request->call_number,
            'page_num' => $request->page_num,
            'location' => $request->location,
            'section' => $request->section,
            'datePublish' => $request->date_publish,
            'subject' => $request->subject,
            'collection_status' => '1',
            'permission'=> $request->permission,
            'filelink' => $request->file_url

        ];
    
       
          //update firebase database
          $updatedCollection = $this->database->getReference($this->tablename.'/'.$postRef)->update($postData);
     

        //on sql database
        $collection = new Collection();
        $collection->id = $request->id;
        $collection->title = $request->title;
        $collection->author = $request->author;
        $collection->isbn = $request->isbn;
        $collection->firebase_key = $postRef;
        $collection->call_number = $request->call_number;
        $collection->page_num = $request->page_num;
        $collection->location_id = $request->location;
        $collection->section_id = $request->section;
        $collection->date_publish = $request->date_publish;
        $collection->subject_id = $request->subject;
        $collection->collection_status = '1';
        $collection->permission_id = $request->permission;
        $collection->filelink = $request->file_url;
        $collection->save();

       $librarian = Librarian::all()->where('librarian_id', Auth::user()->id);

       //process on adding librarian who add the collection
        $added_col = new LibrarianAddedCollection();
        $added_col->id = $request->id1;
        $added_col->librarian_id = Auth::user()->id;
        $added_col->collection_id = $collection->id;
        $added_col->save();
        return \redirect('/admin/user/manage/collection');
    }




    //redirect to update Page
    public function update_collection($id){
        $location =Location::all();
        $section = Section::all();
        $subject = Subject::all();
        $permission = Permission::all();
        $collection = Collection::all()->where('id', $id);
        return view('admin.collectionmanagement.update_collection', \compact('location', 'section', 'subject', 'permission', 'collection'));
    }

    //update collection
    public function update_collection_input(Request $request){

        $key = $request->firebase_key;

        $updates_collection =[
            'id' => $request->id,
            'title' => $request->title,
            'author' => $request->author,
            'isbn' => $request->isbn,
            'call_num'=> $request->call_number,
            'page_num' => $request->page_num,
            'location' => $request->location,
            'section' => $request->section,
            'datePublish' => $request->date_publish,
            'subject' => $request->subject,
            'collection_status' => '1',
            'permission'=> $request->permission,
            'filelink' => $request->file_url

        ];
        //update firebase database
        $updatedCollection = $this->database->getReference($this->tablename.'/'.$key)->update($updates_collection);


        //update sql database
        $collection = Collection::find($request->id);
        $collection->title = $request->title;
        $collection->author = $request->author;
        $collection->isbn = $request->isbn;
        $collection->call_number = $request->call_number;
        $collection->page_num = $request->page_num;
        $collection->location_id = $request->location;
        $collection->section_id = $request->section;
        $collection->date_publish = $request->date_publish;
        $collection->subject_id = $request->subject;
        $collection->permission_id =$request->permission;
        $collection->filelink = $request->file_url;
        $collection->collection_status = '1';
        $collection->save();

        $history = new CollectionUpdateHistory();
        $history->librarian_id = Auth::user()->id;
        $history->collection_id = $request->id;
        $history->save();

        return \redirect('/admin/user/manage/collection');
    }

    //process on deleting the collection
    public function delete_collection(Request $request){
        $collection = Collection::find($request->id);

        $collection->collection_status = '2';
        $collection->save();

        $key = $collection->firebase_key;
        $delete_collection =[
            'collection_status' => '2',
        ];
        $updatedCollection = $this->database->getReference($this->tablename.'/'.$key)->update($delete_collection);

        $delete = new LibrarianDeletedCollection();
        $delete->id = $request->id;
        $delete->librarian_id = Auth::user()->id;
        $delete->collection_id = $request->id;
        $delete->save();
        
        return \redirect('/admin/user/manage/collection');
    }

    //redirect to deleted collection page
    public function deleted_collection(){
        $librarian = Librarian::where('librarian_id', Auth::user()->id)->get();
        $collection = Collection::where('collection_status', 2)->get();
        $location = Location::all();
        $section = Section::all();
        $subject = Subject::all();
        return \view('admin.collectionmanagement.deleted_collection', \compact('librarian', 'collection', 'section', 'location', 'subject'));
    }

    //process to restore collection
    public function restore_collection(Request $request){
        $data = Collection::find($request->id);
        $data->collection_status = '3';
        $data->save();

        //restore deleted collection on firebase

        $key = $data->firebase_key;
        $restore_collection =[
            'collection_status' => '3',
        ];
        $updatedCollection = $this->database->getReference($this->tablename.'/'.$key)->update($restore_collection);

        $restoreData = new LibrarianRestoredCollection();
        $restoreData->id = $request->id;
        $restoreData->librarian_id = Auth::user()->id;
        $restoreData->collection_id = $request->id;
        $restoreData->save();
        return \redirect('/admin/user/manage/collection/deleted');
        
    }


    //redirect to restored page
    public function restored_collection(){
        $librarian = Librarian::where('librarian_id', Auth::user()->id)->get();
        $collection = Collection::where('collection_status', 3)->get();
        $location = Location::all();
        $section = Section::all();
        $subject = Subject::all();
        return \view('admin.collectionmanagement.restored', \compact('librarian', 'collection', 'location', 'section', 'subject'));
    }
}
