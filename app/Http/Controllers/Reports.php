<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Librarian;
use App\Models\LibrarianAddedCollection;
use Carbon\Carbon;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Reports extends Controller
{

    //route to report page
    public function index(){
        

        $chart_options = [
            'chart_title' => 'Add',
            'chart_type'            => 'line',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\LibrarianAddedCollection',
            'group_by_field' => 'created_at',
            'group_by_period'       => 'day',
            'filter_field'          => 'created_at',
            'filter_days'           => '15',
            'date_format' => 'F j, Y',
            'conditions'            => [
                ['condition'=>'', 'color' => 'blue', 'fill' => true],
               
                    ],
           
            'entries_number'        => '5',

            'continuous_time'       => true,
           
            'chart_color'=> '0,255,255',
            'show_blank_data' => true,
        ];
       
        $chart1 = new LaravelChart($chart_options);

        $chart_options_delete = [
            'chart_title' => 'Deletes',
            'chart_type'            => 'line',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\LibrarianDeletedCollection',
            'group_by_field' => 'created_at',
            'group_by_period'       => 'day',
            'filter_field'          => 'created_at',
            'filter_days'           => '15',
            'date_format' => 'F j, Y',
           'conditions'            => [
        ['condition'=>'', 'color' => 'red', 'fill' => true],
       
            ],
            'entries_number'        => '5',

            'continuous_time'       => true,
           
            'chart_color'=> '255,0,0',
            'show_blank_data' => true,
        ];
        
       
        $chart_delete = new LaravelChart($chart_options_delete);

        $librarian = Librarian::all()->where('librarian_id', Auth::user()->id);
        return \view('report.index', \compact('chart1', 'librarian', 'chart_delete'));
    }


    //route to added collection page
    public function added_collection(){
        $added = LibrarianAddedCollection::all();
        $librarian = Librarian::all();
        
        $collection = Collection::all();
      
        $text_added = '';
        //counters
        $counter_day = 0;
        $counter_week = 0;
        $counter_month =0;
        $counter_year = 0;
        $counter_alltime =0;

        $show_report_total_add = 1;

        $librarian_id_array = array();

        //getting the patron top current week
        foreach($added as $added_info){
            if ($added_info->created_at->toDateString() == Carbon::now()->toDateString()){
                  ++$counter_day;
            }
            if ($added_info->created_at->endOfWeek() == Carbon::now()->endOfWeek()){
              ++$counter_week;
              }
            if ($added_info->created_at->format('F') == Carbon::now()->format('F')){
                ++$counter_month;
                }
            if ($added_info->created_at->format('Y') == Carbon::now()->format('Y')){
                ++$counter_year;
                }
            ++$counter_alltime;
        }

        foreach($added as $added_info){
            if($added_info->created_at->format('F') == Carbon::now()->format('F')){
             array_push($librarian_id_array,$added_info->librarian_id);

            }
        }
        $occurences = array_count_values($librarian_id_array);

        return \view('report.addedCollection.index', \compact('added', 'librarian', 'collection', 'counter_day','counter_week', 'counter_month', 'counter_year', 'counter_alltime', 'text_added','show_report_total_add', 'occurences'));
    }

    //route to personal report page
    public function personal_report(){
        $chart1 ='';

        $librarian_id = LibrarianAddedCollection::all()->where('librarian_id', Auth::user()->id);
        foreach($librarian_id as $librarian_info){
            
            
        $chart_options = [
            'chart_title' => 'Add',
            'chart_type'            => 'line',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\LibrarianAddedCollection',
            'group_by_field' => 'created_at',
            'group_by_period'       => 'day',
            'filter_field'          => 'created_at',
            'filter_days'           => '15',
            'date_format' => 'F j, Y',
            'conditions'            => [
                ['condition'=>"librarian_id='$librarian_info->librarian_id'", 'color' => 'blue', 'fill' => true],
                
               
                    ],
            'entries_number'        => '5',

            'continuous_time'       => true,
           
            'chart_color'=> '0,255,255',
            'show_blank_data' => true,
            
        ];
        $chart1 = new LaravelChart($chart_options);
    }
       
        $librarian = Librarian::all()->where('librarian_id', Auth::user()->id);
        $add_day = LibrarianAddedCollection::all()->where('librarian_id', Auth::user()->id);
 
        return \view('report.personalreport.index', \compact('librarian','chart1', 'add_day'));
    }

    //select 
    public function select_report(Request $request){
        $selected = $request->report;
       
        $added = LibrarianAddedCollection::all();
        $librarian = Librarian::all();
        
        $collection = Collection::all();
      
        
        //counters
        $counter_day = 0;
        $counter_week = 0;
        $counter_month =0;
        $counter_year = 0;
        $counter_alltime =0;

        $text_added = '';

        //getting the patron top current week
       

        foreach($added as $added_info2){
            if($selected == '1'){
                $text_added = 'Collection Uploaded This Day';
                $added = LibrarianAddedCollection::whereBetween('created_at', [Carbon::now()->startOfDay(), Carbon::now()->endOfDay()])
                ->get();
            }
            else if($selected == '2'){
                $text_added = 'Collection Uploaded This Week';
                $added = LibrarianAddedCollection::where('created_at', '>', Carbon::now()->startOfWeek())
                ->where('created_at', '<', Carbon::now()->endOfWeek())
                ->get();
            }
            else if($selected == '3'){
                $text_added = 'Collection Uploaded This Month';
                $added = LibrarianAddedCollection::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
                ->get();
            }
            else if($selected == '4'){
                $text_added = 'Collection Uploaded This Year';
                $added = LibrarianAddedCollection::whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])
                ->get();
            }
            else if($selected == '5'){
                $text_added = 'Collection Uploaded Alltime';
                $added = LibrarianAddedCollection::all();
            }
        }
       
        $show_report_total_add = 0;

      
        return \view('report.addedCollection.index', \compact('added', 'librarian', 'collection', 'counter_day','counter_week', 'counter_month', 'counter_year', 'counter_alltime', 'text_added', 'show_report_total_add'));
    }

}
