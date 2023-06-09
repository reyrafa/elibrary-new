<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Reports
        </h2>
    </x-slot>
    @include('report.mini-dashboard.index')
    <div class="container mt-4" style="font-family: 'Poppins', san-serif;">
        <h1 style="font-size: 25px;">PERSONAL STAT REPORT</h1>
        <div class="row mt-3">
            <div class="col-md-2 mr-2 bg-white overflow-hidden shadow-xl sm:rounded-lg px-3 py-3">
                <label style="font-size: 14px;" class="mb-1">Total Add : Day</label>
                @php
                    $counter_day = 0;
                    $validator = 0;
                @endphp
                @foreach($add_day as $add_info)
                    @if($add_info->created_at->toDateString() == Carbon\Carbon::now()->toDateString()) 
                        <label class="font-semibold hidden text-primary">{{++$counter_day}} collections</label>
                      
                    @endif
                @endforeach  
                <label class="font-semibold text-primary">{{$counter_day}} collections</label>
   
            </div>
            <div class="col-md-2 mr-2 bg-white overflow-hidden shadow-xl sm:rounded-lg px-3 py-3">
                <label style="font-size: 14px;" class="mb-1">Total Add : Week</label>
                @php 
                    $counter_week = 0;
                @endphp
                @foreach($add_day as $add_info)
                    @if($add_info->created_at->endOfWeek() ==  Carbon\Carbon::now()->endOfWeek())
                        <h1 class="font-semibold hidden text-primary">{{++$counter_week}} collections</h1>
                    @endif
                @endforeach
                <h1 class="font-semibold text-primary">{{$counter_week}} collections</h1>
               
            </div>
            <div class="col-md-2 mr-2 bg-white overflow-hidden shadow-xl sm:rounded-lg px-3 py-3">
                <label style="font-size: 14px;" class="mb-1">Total Add : Month</label>
                @php 
                    $counter_month = 0;
                @endphp
                @foreach($add_day as $add_info)
                    @if($add_info->created_at->format('F') ==  Carbon\Carbon::now()->format('F'))
                        <h1 class="font-semibold hidden text-primary">{{++$counter_month}} collections</h1>
                    @endif
                @endforeach
                <h1 class="font-semibold text-primary">{{$counter_month}} collections</h1>
            </div>
            <div class="col-md-2 mr-2 bg-white overflow-hidden shadow-xl sm:rounded-lg px-3 py-3">
                <label style="font-size: 14px;" class="mb-1">Total Add : Year</label>
                @php 
                    $counter_year = 0;
                @endphp
                @foreach($add_day as $add_info)
                    @if($add_info->created_at->format('Y') ==  Carbon\Carbon::now()->format('Y'))
                        <h1 class="font-semibold hidden text-primary">{{++$counter_year}} collections</h1>
                    @endif
                @endforeach
                <h1 class="font-semibold text-primary">{{$counter_year}} collections</h1>
            </div>
            <div class="col-md-2 mr-2 bg-white overflow-hidden shadow-xl sm:rounded-lg px-3 py-3">
                <label style="font-size: 14px;" class="mb-1">Total Add : Alltime</label>
                @php 
                    $counter_alltime = 0;
                @endphp
                @foreach($add_day as $add_info)
                    <h1 class="font-semibold hidden text-primary">{{++$counter_alltime}} collections</h1>
                    
                @endforeach
                <h1 class="font-semibold text-primary">{{$counter_alltime}} collections</h1>
            </div>
               
            <div class="col-md-5 mt-3 mr-3 bg-white overflow-hidden shadow-xl sm:rounded-lg px-3 py-3">
            @if($chart1 != '')
            {!! $chart1->renderHtml() !!}
            @else
                <h1 class="font-semibold text-primary">No Data</h1>
            @endif
            </div>
            <div class="col-md-6 mt-3 bg-white overflow-hidden shadow-xl sm:rounded-lg px-3 py-3">
                <div class="row">
                    @foreach($librarian as $librarian_info)
                    <div class="col-md-12 mb-3">
                        <label>Fullname: {{$librarian_info->firstname}} {{$librarian_info->middlename}} {{$librarian_info->lastname}}</label>
                    </div>
                    <div class="col-md-12 mb-3">
                        @if($librarian_info->role_id == '1')
                            <label>Role: Admin</label>
                        @else
                            <label>Role: Personnel</label>
                        @endif
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Date Registered: {{$librarian_info->created_at->toDayDateTimeString()}}</label>
                    </div>
                    <div class="col-md-12">
                        <label>Email Address: {{Auth::user()->email}}</label>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @if($chart1 != '')
    {!! $chart1->renderChartJsLibrary() !!}
    {!! $chart1->renderJs() !!}
    @endif
    @push('script')

        <script>
           
            $(document).ready( function () {

                //data table
               dtable = $('#add_table').DataTable({
                    "language": {
                    "search": "Filter records:"
                    },
                    "className": "text-center nosort text-nowrap",
                   "lengthMenu": [5, 10, 20, 50],
                   "bLengthChange": true,
                   "columnDefs":[
                       {"className": "dt:center", "targets": "_all"}
                   ], 
                   "dom" :"lrtrip",
                   "order" :[[6, "desc"]],
                   
                  
                });

                //search function
                $('#search').keyup(function(){
                    dtable.search($(this).val()).draw();
                })
                
                } );


        </script>
    @endpush
    @push('style')
        <style>
            #search{
                box-shadow: none;
            }
            
        </style>
    @endpush
</x-app-layout>