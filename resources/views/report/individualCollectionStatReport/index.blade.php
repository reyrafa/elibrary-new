<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Reports
        </h2>
    </x-slot>
    @include('report.mini-dashboard.index')
    <div class="container mt-4" style="font-family: 'Poppins', san-serif;">
        <h1 style="font-size: 25px; ">COLLECTION STAT REPORT</h1>
        <div class="row">
            
            
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
                        <th>Title</th>
                        <th>Author</th>
                        <th>Read: day</th>
                        <th>Read: week</th>
                        <th>Read: month</th>
                        <th>Read: year</th>
                        <th>Download: day</th>
                        <th>Download: week</th>
                        <th>Download: month</th>
                        <th>Download: year</th>
                    </thead>
                    <tbody>
                        @foreach($occurence as $occurenceKey => $occurence_info)
                        <tr>
                        
                               
                                    @foreach($collection as $keyCollection =>$collection_info)
                                        @if($occurenceKey== $collection_info['key'])
                                            <td>{{$collection_info['title']}}</td>
                                            <td>{{$collection_info['author']}}</td>
                                        @endif
                                    @endforeach


                                    @foreach($read_report as $readKey => $read_info)
                                        @foreach($occurence_day as $occurence_dayKey => $occurence_dayinfo)
                                            @if($read_info['collection_id'] == $occurence_dayKey)
                                                <td>{{$occurence_dayinfo}}</td>
                                            @else
                                                <td>0</td>
                                           
                                            @endif

                                        @endforeach
                                    @endforeach

                                    <td>{{$occurence_info}} </td>

                                   
                        
                            </tr>
                        @endforeach
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
               "order" :[[1, "desc"]],

           
            });

            //search function
            $('#search').keyup(function(){
                dtable.search($(this).val()).draw();
            })

            $('#rowsPerPage').on('change', function(){
                    let row =$('#rowsPerPage').val()
                    dtable.page.len(row).draw();
                })

        
            });


    </script>
@endpush
</x-app-layout>