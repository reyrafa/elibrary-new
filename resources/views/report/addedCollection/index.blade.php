<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Reports
        </h2>
    </x-slot>
    @include('report.mini-dashboard.index')
    <div class="container mt-4" style="font-family: 'Poppins', san-serif;">
        <h1 style="font-size: 25px;">ADDED COLLECTION REPORT</h1>
        <div class="row">
            <div class="col-md-2 mr-3 mt-3 mb-3 bg-white overflow-hidden shadow-xl sm:rounded-lg px-3 py-4">
                <label style="font-size: 15px;">Total Add : Day</label>
                <label class="text-primary font-semibold">{{$counter_day}} collections</label>
            </div>
            <div class="col-md-2 mr-3 mt-3 mb-3 bg-white overflow-hidden shadow-xl sm:rounded-lg px-3 py-4">
                <label style="font-size: 15px;">Total Add : Week</label>
                <label class="text-primary font-semibold">{{$counter_week}} collections</label>
            </div>
            <div class="col-md-2 mr-3 mt-3 mb-3 bg-white overflow-hidden shadow-xl sm:rounded-lg px-3 py-4">
                <label style="font-size: 15px;">Total Add : Month</label>
                <label class="text-primary font-semibold">{{$counter_month}} collections</label>
            </div>
            <div class="col-md-2 mr-3 mt-3 mb-3 bg-white overflow-hidden shadow-xl sm:rounded-lg px-3 py-4">
                <label style="font-size: 15px;">Total Add : Year</label>
                <label class="text-primary font-semibold">{{$counter_year}} collections</label>
            </div>
            <div class="col-md-2 mr-3 mt-3 mb-3 bg-white overflow-hidden shadow-xl sm:rounded-lg px-3 py-4">
                <label style="font-size: 15px;">Total Add : Alltime</label>
                <label class="text-primary font-semibold">{{$counter_alltime}} collections</label>
            </div>

            <!--to pdf-->
            <div class="col-md-2"> 
                <x-jet-button id="btnExportPdf" onclick="toPdf()" value="Export To PDF">Export to Pdf</x-jet-button>
            </div>

            <!--download-->
            <div class="col-md-3">
            <x-jet-button id="btnExportExcel" onclick="fnExportToExcel('xlsx', 'AddedCollectionReport')">Export to excel</x-jet-button>
            </div>
            <div class="col-md-4">
                <form action="select_report" method="GET">
                    @csrf
                    <div class="input-group">
                        <div class="form-outline">  
                            <select 
                                name="report" 
                                id="select_report"
                                class="form-control form-select"
                                required autofocus>
                                    <option value="0" selected="true" disabled="true">--Select Time Report--</option>
                                    <option value="1">This Day</option>
                                    <option value="2">This Week</option>
                                    <option value="3">This Month</option>
                                    <option value="4">This Year</option>  
                                    <option value="5">Alltime</option>
                            </select>
                        </div>
                            <button type="submit" class="btn bg-primary btn-success form-control">
                                <i class="fa fa-check-circle-o" aria-hidden="true"></i>
                            </button>
                    </div>
                </select>

                </form>
            </div>
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
            <h1 style="font-size: 25px; font-weight:bold" class="mb-2">{{$text_added}}</h1>
        <div class="table-responsive">
            Show <select name="" id="rowsPerPage" class="form-control-sm rounded-2 col-1">
                        <option selected="true" disabled="disabled"></option>
                        <option value="3">3</option>
                        <option value="10">10</option>
                        <option value="30">30</option>
                    </select> Entries
            <table class="table hover align-middle stripe" id="add_table">
                <thead>
                    <th>Employee Id</th>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Isbn</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Date Added</th>
                </thead>
                <tbody>
                    @foreach($added as $added_info)
                    <tr>
                        @foreach($librarian as $librarian_info)
                            
                            @if($added_info->librarian_id == $librarian_info->librarian_id)
                                <td>{{$librarian_info->id_number}}</td>
                                <td>{{$librarian_info->firstname}}</td>
                                <td>{{$librarian_info->lastname}}</td>
                            @endif
                        @endforeach

                        @foreach($collection as $collection_info)
                            @if($added_info->collection_id == $collection_info->id)
                                <td>{{$collection_info->isbn}}</td>
                                <td>{{$collection_info->title}}</td>
                                <td>{{$collection_info->author}}</td>
                            @endif
                        @endforeach
                            
                        <td>{{$added_info->created_at->toDayDateTimeString()}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        </div>
        @if($show_report_total_add == 1)
        <div class="bg-white mt-3 overflow-hidden shadow-xl sm:rounded-lg px-3 py-4">
        <h1 style="font-size: 25px; font-weight:bold" class="mb-2">Librarians Total Add : Month of {{\Carbon\Carbon::now()->format('F')}}</h1>
        <div class="table-responsive">
      
            <table class="table hover align-middle stripe" id="add_table">
                <thead>
                    <th>Employee Id</th>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Total Add</th>
                </thead>
                <tbody>
                    @foreach($occurences as $key=>$occurences_info)
                    <tr>
                        @foreach($librarian as $librarian_info)
                            @if($key == $librarian_info->librarian_id)
                                <td>{{$librarian_info->firstname}}</td>
                                <td>{{$librarian_info->lastname}}</td>
                                <td>{{$librarian_info->middlename}}</td>
                            @endif
                        @endforeach
                        <td>{{$occurences_info}} collections</td>

                       
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        </div>
        @endif
    </div>
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
                   "bLengthChange": false,
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
                $('#rowsPerPage').on('change', function(){
                    let row =$('#rowsPerPage').val()
                    dtable.page.len(row).draw();
                })
                
                } );
               function toPdf(){
                    var doc = new jsPDF('p', 'pt', 'letter');
                    var htmlstring = '';
                    var tempVarToCheckPageHeight = 0;
                    var pageHeight = 0;
                    pageHeight = doc.internal.pageSize.height;
                    specialElementHandlers = {
                        // element with id of "bypass" - jQuery style selector  
                        '#bypassme': function (element, renderer) {
                            // true = "handled elsewhere, bypass text extraction"  
                            return true
                        }
                    };
                    margins = {
                        top: 150,
                        bottom: 60,
                        left: 40,
                        right: 40,
                        width: 600
                    };
                    var y = 20;
                    doc.setLineWidth(2);
                    doc.text(200, y = y + 30, "ADDED COLLECTION REPORT");
                    doc.autoTable({
                        html: '#add_table',
                        startY: 70,
                        theme: 'grid',
                        
                        styles: {
                            minCellHeight: 40
                        }
                    })
                    doc.save('AddedCollection.pdf');
                };
                
                function fnExportToExcel(fileExtension, filename){
                    var elt = document.getElementById('add_table');
                    var wb = XLSX.utils.table_to_book(elt, {sheet: "sheet1"})
                    return XLSX.writeFile(wb, filename + "." + fileExtension || ('AddedCollectionReport.' + (fileExtension || 'xlsx')));
                }

        </script>
    @endpush
    @push('style')
        <style>
            #search, #select_report{
                box-shadow: none;
            }

        </style>
    @endpush
</x-app-layout>