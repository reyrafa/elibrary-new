<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Reports
        </h2>
    </x-slot>
    @include('report.mini-dashboard.index')
    <div class="container mt-4" style="font-family: 'Poppins', san-serif;">
        <h1 style="font-size: 25px;">STUDENT READ AND DOWNLOAD REPORT</h1>
        <div class="row">
            <div class="col-md-2 mr-3 mt-3 mb-3 bg-white overflow-hidden shadow-xl sm:rounded-lg px-3 py-4">
                <label style="font-size: 15px;">Total read : Day</label>
                <label class="text-primary font-semibold">{{$counter_day}} books</label>
            </div>
            <div class="col-md-2 mr-3 mt-3 mb-3 bg-white overflow-hidden shadow-xl sm:rounded-lg px-3 py-4">
                <label style="font-size: 15px;">Total read : Week</label>
                <label class="text-primary font-semibold">{{$counter_week}} books</label>
            </div>
            <div class="col-md-2 mr-3 mt-3 mb-3 bg-white overflow-hidden shadow-xl sm:rounded-lg px-3 py-4">
                <label style="font-size: 15px;">Total read : Month</label>
                <label class="text-primary font-semibold">{{$counter_month}} books</label>
            </div>
            <div class="col-md-2 mr-3 mt-3 mb-3 bg-white overflow-hidden shadow-xl sm:rounded-lg px-3 py-4">
                <label style="font-size: 15px;">Total read : Year</label>
                <label class="text-primary font-semibold">{{$counter_year}} books</label>
            </div>
            <div class="col-md-2 mr-3 mt-3 mb-3 bg-white overflow-hidden shadow-xl sm:rounded-lg px-3 py-4">
                <label style="font-size: 15px;">Total read : Alltime</label>
                <label class="text-primary font-semibold">{{$counter_alltime}} books</label>
            </div>
            
            <div class="col-md-5"></div>
        <div class="col-md-4"></div>
            <div class="col-md-3">
                <div class="input-group">   
                    <div class="form-outline">
                      <input 
                          type="search" 
                          id="search" 
                          name="query"
                          class="form-control" 
                          placeholder="Search Data"/>
                    </div>
                    <button type="button" class="btn btn-success disabled form-control">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
        <h1 style="font-size: 25px;">STUDENT READ REPORT</h1>
        <div class="bg-white mt-3 overflow-hidden shadow-xl sm:rounded-lg px-3 py-4">
           
            <div class="table-responsive">
            Show <select name="" id="rowsPerPage" class="form-control-sm rounded-2 col-1">
                        <option selected="true" disabled="disabled"></option>
                        <option value="3">3</option>
                        <option value="10">10</option>
                        <option value="30">30</option>
                    </select> Entries
                <table class="table hover align:middle stripe" id="read_dl_report_Table">
                    <thead>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Middlename</th>
                        <th>Book Title</th>
                        <th>Book Author</th>
                        <th>Location</th>
                        <th>Section</th>
                        <th>Subject</th>
                        <th>Date Read</th>
                    </thead>
                    <tbody>
                        @forelse ($read_report as $key=>$item)
                            <tr>
                                @foreach($student as $studentKey=>$studentItem)
                                    @if($item['student_id'] == $studentItem['key'])
                                        <td>{{$studentItem['firstname']}}</td>
                                        <td>{{$studentItem['lastname']}}</td>
                                        <td>{{$studentItem['middlename']}}</td>
                                    @endif
                                @endforeach
                                @foreach($collection as $collectionKey=>$collectionItem)
                                    @if($item['collection_id'] == $collectionItem['key'])
                                        <td>{{$collectionItem['title']}}</td>
                                        <td>{{$collectionItem['author']}}</td>
                                   
                                        @foreach($location as $locationKey=>$locationItem)
                                            @if($collectionItem['location'] == $locationItem['id'])
                                            <td>{{$locationItem['location']}}</td>
                                            @endif
                                        @endforeach

                                        @foreach($section as $sectionKey=>$sectionItem)
                                            @if($collectionItem['section'] == $sectionItem['id'])
                                            <td>{{$sectionItem['section']}}</td>
                                            @endif
                                        @endforeach

                                        @foreach($subject as $subjectKey=>$subjectItem)
                                            @if($collectionItem['subject'] == $subjectItem['id'])
                                            <td>{{$subjectItem['subject']}}</td>
                                            @endif
                                        @endforeach
                                          
                                       
                                    @endif
                                @endforeach
                            
                                <td>{{\Carbon\Carbon::parse($item['created_at'])->toDayDateTimeString()}}</td>
                               
                              
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7">No Records</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
        </div>
        <h1 style="font-size: 25px;" class="mt-5">STUDENT DOWNLOAD REPORT</h1>
        <div class="row">
            <div class="col-md-2 mr-3 mt-3 mb-3 bg-white overflow-hidden shadow-xl sm:rounded-lg px-3 py-4">
                <label style="font-size: 15px;">Total download : Day</label>
                <label class="text-primary font-semibold">{{$counter_download_day}} books</label>
            </div>
            <div class="col-md-2 mr-3 mt-3 mb-3 bg-white overflow-hidden shadow-xl sm:rounded-lg px-3 py-4">
                <label style="font-size: 15px;">Total download : Week</label>
                <label class="text-primary font-semibold">{{$counter_download_week}} books</label>
            </div>
            <div class="col-md-2 mr-3 mt-3 mb-3 bg-white overflow-hidden shadow-xl sm:rounded-lg px-3 py-4">
                <label style="font-size: 15px;">Total download : Month</label>
                <label class="text-primary font-semibold">{{$counter_download_month}} books</label>
            </div>
            <div class="col-md-2 mr-3 mt-3 mb-3 bg-white overflow-hidden shadow-xl sm:rounded-lg px-3 py-4">
                <label style="font-size: 15px;">Total download : Year</label>
                <label class="text-primary font-semibold">{{$counter_download_year}} books</label>
            </div>
            <div class="col-md-2 mr-3 mt-3 mb-3 bg-white overflow-hidden shadow-xl sm:rounded-lg px-3 py-4">
                <label style="font-size: 15px;">Total download : Alltime</label>
                <label class="text-primary font-semibold">{{$counter_download_alltime}} books</label>
            </div>
            <div class="col-md-5"></div>
            <div class="col-md-4"></div>
            <div class="col-md-3">
                <div class="input-group">   
                    <div class="form-outline">
                      <input 
                          type="search" 
                          id="searchDl" 
                          name="query"
                          class="form-control" 
                          placeholder="Search Data"/>
                    </div>
                    <button type="button" class="btn btn-success disabled form-control">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
       
        <div class="bg-white mt-3 overflow-hidden shadow-xl sm:rounded-lg px-3 py-4">
           
            <div class="table-responsive">
            Show <select name="" id="rowsPerPage1" class="form-control-sm rounded-2 col-1">
                        <option selected="true" disabled="disabled"></option>
                        <option value="3">3</option>
                        <option value="10">10</option>
                        <option value="30">30</option>
                    </select> Entries
                <table class="table hover align:middle stripe" id="dl_report_Table">
                    <thead>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Middlename</th>
                        <th>Book Title</th>
                        <th>Book Author</th>
                        <th>Location</th>
                        <th>Section</th>
                        <th>Subject</th>
                        <th>Date Downloaded</th>
                    </thead>
                    <tbody>
                        @forelse ($download_report as $downloadkey=>$downloaditem)
                            <tr>
                                @foreach($student as $studentKey=>$studentItem)
                                    @if($downloaditem['student_id'] == $studentItem['key'])
                                        <td>{{$studentItem['firstname']}}</td>
                                        <td>{{$studentItem['lastname']}}</td>
                                        <td>{{$studentItem['middlename']}}</td>
                                    @endif
                                @endforeach
                                @foreach($collection as $collectionKey=>$collectionItem)
                                    @if($downloaditem['collection_id'] == $collectionItem['key'])
                                        <td>{{$collectionItem['title']}}</td>
                                        <td>{{$collectionItem['author']}}</td>
                                   
                                        @foreach($location as $locationKey=>$locationItem)
                                            @if($collectionItem['location'] == $locationItem['id'])
                                            <td>{{$locationItem['location']}}</td>
                                            @endif
                                        @endforeach

                                        @foreach($section as $sectionKey=>$sectionItem)
                                            @if($collectionItem['section'] == $sectionItem['id'])
                                            <td>{{$sectionItem['section']}}</td>
                                            @endif
                                        @endforeach

                                        @foreach($subject as $subjectKey=>$subjectItem)
                                            @if($collectionItem['subject'] == $subjectItem['id'])
                                            <td>{{$subjectItem['subject']}}</td>
                                            @endif
                                        @endforeach
                                          
                                       
                                    @endif
                                @endforeach
                            
                                <td>{{\Carbon\Carbon::parse($downloaditem['created_at'])->toDayDateTimeString()}}</td>
                               
                              
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7">No Records</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>
    
    @push('script')

    <script>
   
        $(document).ready( function () {

            //data table
            
            //for read
           dtable = $('#read_dl_report_Table').DataTable({
                "language": {
                "search": "Filter records:"
                },
                "className": "text-center nosort text-nowrap",
               "lengthMenu": [2, 5, 10, 20, 50],
               "bLengthChange": false,
               "columnDefs":[
                   {"className": "dt:center", "targets": "_all"}
               ], 
               "dom" :"lrtrip",
               "order" :[[5, "desc"]],

           
            });

            //search function
            $('#search').keyup(function(){
                dtable.search($(this).val()).draw();
            })

            $('#rowsPerPage').on('change', function(){
                    let row =$('#rowsPerPage').val()
                    dtable.page.len(row).draw();
                })


        

            //for download
            dtable_dl = $('#dl_report_Table').DataTable({
                "language": {
                "search": "Filter records:"
                },
                "className": "text-center nosort text-nowrap",
               "lengthMenu": [2, 5, 10, 20, 50],
               "bLengthChange": false,
               "columnDefs":[
                   {"className": "dt:center", "targets": "_all"}
               ], 
               "dom" :"lrtrip",
               "order" :[[5, "desc"]],

           
            });

            //search function
            $('#searchDl').keyup(function(){
                dtable_dl.search($(this).val()).draw();
            })

            $('#rowsPerPage1').on('change', function(){
                    let row =$('#rowsPerPage1').val()
                    dtable_dl.page.len(row).draw();
                })
            });


    </script>
@endpush
</x-app-layout>