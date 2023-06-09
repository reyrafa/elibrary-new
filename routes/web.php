<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DisabledAccount;
use App\Http\Controllers\FirebaseController;
use App\Http\Controllers\Redirects;
use App\Http\Controllers\Reports;
use Illuminate\Support\Facades\Route;
use Kreait\Laravel\Firebase\Facades\Firebase;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

//route to determine user
Route::get('/redirects', [Redirects::class, 'index'])->middleware('auth:sanctum');

//route to admin user
Route::get('/dashboard/user', [AdminController::class, 'index'])->middleware('auth:sanctum','isLibrarian', 'isDisabled')->name('admin_dashboard');

//route to user management
Route::get('/admin/user/manage/user', [AdminController::class, 'manage_user'])->middleware('auth:sanctum', 'isLibrarian', 'isAdmin', 'isDisabled')->name('admin_user_management');

//route to after add button is clicked
Route::get('/admin/user/manage/user/add', [AdminController::class, 'add_page'])->middleware('auth:sanctum', 'isLibrarian', 'isAdmin', 'isDisabled');

//route to validate email address
Route::get('/validateEmailAdd', [AdminController::class,'validate_email'])->middleware('auth:sanctum', 'isLibrarian', 'isAdmin', 'isDisabled');

//route to add librarian
Route::post('/add/librarian', [AdminController::class, 'add_librarian'])->middleware('auth:sanctum', 'isLibrarian', 'isAdmin', 'isDisabled');

//route to update page
Route::get('/admin/user/manage/user/update/librarian/{id}', [AdminController::class, 'update_page'])->middleware('auth:sanctum', 'isLibrarian', 'isAdmin', 'isDisabled');

//route to update librarian
Route::post('/admin/user/update/user', [AdminController::class, 'update_librarian'])->middleware('auth:sanctum', 'isLibrarian', 'isAdmin', 'isDisabled');

//route to collection management page
Route::get('/admin/user/manage/collection', [AdminController::class, 'collection_page'])->middleware('auth:sanctum', 'isLibrarian', 'isDisabled')->name('collection_management');

//route to redirect to collection page
Route::get('/admin/user/manage/collection/add', [AdminController::class, 'collection_add_page'])->middleware('auth:sanctum', 'isLibrarian', 'isDisabled')->name('collection_management');

//route in uploading collection file
Route::post('/collection_upload', [AdminController::class, 'upload'])->middleware('auth:sanctum', 'isLibrarian', 'isDisabled');

//route to add collection
Route::post('/add/collection/book', [AdminController::class, 'add_collection'])->middleware('auth:sanctum', 'isLibrarian', 'isDisabled');

//route to update collection page
Route::get('/admin/user/manage/collection/update/collection/{id}', [AdminController::class, 'update_collection'])->middleware('auth:sanctum', 'isLibrarian', 'isDisabled');

//route to update the collection
Route::post('/update/collection/book', [AdminController::class, 'update_collection_input'])->middleware('auth:sanctum', 'isLibrarian', 'isDisabled');

//route to delete the collection
Route::post('/delete/collection', [AdminController::class, 'delete_collection'])->middleware('auth:sanctum', 'isLibrarian', 'isAdmin', 'isDisabled');

//route to redirect to disabled user page
Route::get('/disabled/Account',[DisabledAccount::class, 'index'])->middleware('auth:sanctum');

//route to redirect to report page
Route::get('/admin/user/report', [Reports::class, 'index'])->middleware('auth:sanctum', 'isLibrarian', 'isDisabled')->name('report');

//route to added Collection Report
Route::get('/user/collection/report', [Reports::class, 'added_collection'])->middleware('auth:sanctum', 'isLibrarian', 'isDisabled','isAdmin');

//route to personal report page
Route::get('/admin/user/report/personal/report', [Reports::class, 'personal_report'])->middleware('auth:sanctum', 'isLibrarian', 'isDisabled')->name('personal_report');

//route to select report page
Route::get('/user/collection/select_report', [Reports::class, 'select_report'])->middleware('auth:sanctum', 'isLibrarian', 'isDisabled');

//route to deleted collection
Route::get('/admin/user/manage/collection/deleted', [AdminController::class, 'deleted_collection'])->middleware('auth:sanctum', 'isLibrarian', 'isAdmin', 'isDisabled');

//route to restore collection
Route::post('/restore/collection', [AdminController::class, 'restore_collection'])->middleware('auth:sanctum', 'isLibrarian', 'isAdmin', 'isDisabled');

//route to restored collection page
Route::get('/admin/user/restored/collection', [AdminController::class, 'restored_collection'])->middleware('auth:sanctum', 'isLibrarian', 'isAdmin', 'isDisabled');

//route to registered student report
Route::get('/registered/student/report', [FirebaseController::class, 'registered_student'])->middleware('auth:sanctum', 'isLibrarian', 'isDisabled');

//route to student read and download report
Route::get('/student/read/download/report', [FirebaseController::class, 'read_dl_report'])->middleware('auth:sanctum', 'isLibrarian', 'isDisabled');

//route to collection stat report
//Route::get('/collection/stat/report', [FirebaseController::class, 'ind_collect_stat_report'])->middleware('auth:sanctum', 'isLibrarian', 'isDisabled');

Route::get('/college/course/report', [FirebaseController::class, 'college_course_report'])->middleware('auth:sanctum', 'isLibrarian', 'isDisabled');
