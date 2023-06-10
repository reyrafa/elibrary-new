<?php

namespace App\Http\Controllers;

use App\Models\Librarian;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kreait\Firebase\Contract\Database;
use Kreait\Laravel\Firebase\Facades\Firebase;

class FirebaseController extends Controller
{
   
    //for the firebase database connection
    public function __construct(Database $database)
    {
        $this->database = $database;
        $this->tablename_student= 'students';
        $this->tablename_student_read_collection = 'student_read_collection';
        $this->tablename_student_download_collection = 'student_download_collection';
        $this->collection = 'collections';
        $this->location = 'locations';
        $this->section = 'sections';
        $this->subject = 'subject';
       
    }

    //for the registered student report
    public function registered_student(){
        $student = $this->database->getReference($this->tablename_student)->getValue();
   
        $librarian = Librarian::all()->where('librarian_id', Auth::user()->id);

         //counters for the reports
         $counter_day = 0;
         $counter_week = 0;
         $counter_month =0;
         $counter_year = 0;
         $counter_alltime =0;


       
        //getting the registered per day, week, month, etc.
        foreach($student as $key => $added_info){

            if (\date('m/d/yyyy',\strtotime($added_info['createdDate'])) == Carbon::now()->toDateString()){
                  ++$counter_day;
                 
            }
            if (Carbon::parse($added_info['createdDate'])->endOfWeek() == Carbon::now()->endOfWeek()){
              ++$counter_week;
            
              }
            if (Carbon::parse($added_info['createdDate'])->format('F') == Carbon::now()->format('F')){
                ++$counter_month;
               
                }
            if (Carbon::parse($added_info['createdDate'])->format('Y') == Carbon::now()->format('Y')){

                ++$counter_year;
                }
          
            ++$counter_alltime;
           
        }



       return \view('report.registeredStudent.index', \compact('librarian','student', 'counter_day','counter_week', 'counter_month', 'counter_year', 'counter_alltime'));
    }

    //for the read and dl report of student
    public function read_dl_report(){

        //getting data from firebase
        $student = $this->database->getReference($this->tablename_student)->getValue();
        $read_report = $this->database->getReference( $this->tablename_student_read_collection)->getValue();
        $download_report = $this->database->getReference( $this->tablename_student_download_collection)->getValue();
        $collection = $this->database->getReference( $this->collection)->getValue();
        $location = $this->database->getReference( $this->location)->getValue();
        $section = $this->database->getReference( $this->section)->getValue();
        $subject = $this->database->getReference( $this->subject)->getValue();

        //getting data from sql server
        $librarian = Librarian::all()->where('librarian_id', Auth::user()->id);

        //counters for the read reports
        $counter_day = 0;
        $counter_week = 0;
        $counter_month =0;
        $counter_year = 0;
        $counter_alltime =0;

        //getting the no of read per day, week, month, etc.
        foreach($read_report as $key => $added_info){
            if (\date('Y-m-d',\strtotime($added_info['created_at'])) == Carbon::now()->toDateString()){
                  ++$counter_day;
                 
            }
            if (Carbon::parse($added_info['created_at'])->endOfWeek() == Carbon::now()->endOfWeek()){
              ++$counter_week;
            
              }
            if (Carbon::parse($added_info['created_at'])->format('F') == Carbon::now()->format('F')){
                ++$counter_month;
               
                }
            if (Carbon::parse($added_info['created_at'])->format('Y') == Carbon::now()->format('Y')){

                ++$counter_year;
                }
          
            ++$counter_alltime;
           
        }

         //counters for the download reports
         $counter_download_day = 0;
         $counter_download_week = 0;
         $counter_download_month =0;
         $counter_download_year = 0;
         $counter_download_alltime =0;


        //getting the no of download per day, week, month, etc.
        foreach($download_report as $downloadKey => $added_infoDownload){
            if (\date('Y-m-d',\strtotime($added_infoDownload['created_at'])) == Carbon::now()->toDateString()){
                  ++$counter_download_day;
                 
            }
            if (Carbon::parse($added_infoDownload['created_at'])->endOfWeek() == Carbon::now()->endOfWeek()){
              ++$counter_download_week;
            
              }
            if (Carbon::parse($added_infoDownload['created_at'])->format('F') == Carbon::now()->format('F')){
                ++$counter_download_month;
               
                }
            if (Carbon::parse($added_infoDownload['created_at'])->format('Y') == Carbon::now()->format('Y')){

                ++$counter_download_year;
                }
          
            ++$counter_download_alltime;
           
        }

        return \view('report.readDownloadReport.index', \compact('librarian','student', 'read_report', 'collection', 'location', 'section', 'subject',
        'counter_day','counter_week', 'counter_month', 'counter_year', 'counter_alltime', 'counter_download_day','counter_download_week',
    'counter_download_month','counter_download_year', 'counter_download_alltime', 'download_report'));
    }


    //for the collection stat report page processess
    public function ind_collect_stat_report(){

        //getting data from sql server
        $librarian = Librarian::all()->where('librarian_id', Auth::user()->id);

        //getting data from firebase reatimedb
        $read_report = $this->database->getReference( $this->tablename_student_read_collection)->getValue();
        $download_report = $this->database->getReference( $this->tablename_student_download_collection)->getValue();
        $collection = $this->database->getReference( $this->collection)->getValue();

        
        
         $collection_array = array();
         $collection_array_day = array();

         //getting the no of read per day, week, month, etc.
         foreach($read_report as $key => $added_info){
             if (\date('Y-m-d',\strtotime($added_info['created_at'])) == Carbon::now()->toDateString()){
                array_push($collection_array_day,$added_info['collection_id']);
                  
             }
             if (Carbon::parse($added_info['created_at'])->endOfWeek() == Carbon::now()->endOfWeek()){
            
               }
             if (Carbon::parse($added_info['created_at'])->format('F') == Carbon::now()->format('F')){
                  array_push($collection_array,$added_info['collection_id']);
                
                 }
             if (Carbon::parse($added_info['created_at'])->format('Y') == Carbon::now()->format('Y')){
 
                 
                 }
           
         
         }
         $occurence_day = array_count_values($collection_array_day);
         $occurence = array_count_values($collection_array);

        return \view('report.individualCollectionStatReport.index', \compact('librarian', 'read_report', 'collection', 'occurence', 'occurence_day'));
    }



    //for the college and courses report
    public function college_course_report(){
        //getting data from sql server
        $librarian = Librarian::all()->where('librarian_id', Auth::user()->id);

        //getting data from firebase
        $student = $this->database->getReference($this->tablename_student)->getValue();


       /* $college_array = [];

       foreach($student as $studentKey=>$studentInfo){
             array_push($college_array,$studentInfo['college']);
        }
        
        $colleges = [];
        $colleges_count = array();
        //getting the colleges
        foreach($college_array as $college => $values){
            $colleges[]=$values;
          
        }
        
        //calculating the same values
        $colleges_count = array_count_values($college_array);


        $college_total = [];
        //getting the number of registered on each college
        foreach($colleges_count as $keyIndex =>$valuesCollege){
            $college_total[]=$valuesCollege;
        }*/

        //initializing variables for the college counter
        $cot =0;
        $cob =0;
        $con =0;
        $col =0;
        $coe =0;
        $cas =0;
        $coa =0;


        //process
        foreach($student as $studentKey => $studentInfo){
            if($studentInfo['college'] == 'College of Technology'){
                ++$cot;
            }
            else if($studentInfo['college'] == 'College of Business'){
                ++$cob;
            }
            else if($studentInfo['college'] == 'College of Nursing'){
                ++$con;
            }
            else if($studentInfo['college'] == 'College of Law'){
                ++$col;
            }
            else if($studentInfo['college'] == 'College of Education'){
                ++$coe;
            }
            else if($studentInfo['college'] == 'College of Arts and Sciences'){
                ++$cas;
            }
            else if($studentInfo['college'] == 'College of Administration'){
                ++$coa;
            }
        }

    return \view('report.collegeCourseReport.index', \compact('librarian', 'cot', 'cob', 'con', 'col', 'coe', 'cas', 'coa') /* ['colleges'=>$colleges,'college_total' => $college_total]*/ );
    }

}
