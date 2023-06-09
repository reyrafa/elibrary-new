<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Reports
        </h2>
    </x-slot>
    @include('report.mini-dashboard.index')
    <div class="container mt-4" style="font-family: 'Poppins', san-serif;">
        <h1 style="font-size: 25px;">REGISTERED STUDENT REPORT</h1>
        <div class="row">
            <div class="col-md-2 mr-3 mt-3 mb-3 bg-white overflow-hidden shadow-xl sm:rounded-lg px-3 py-4">
                <label style="font-size: 15px;">Total registered : Day</label>
                <label class="text-primary font-semibold">{{$counter_day}} students</label>
            </div>
            <div class="col-md-2 mr-3 mt-3 mb-3 bg-white overflow-hidden shadow-xl sm:rounded-lg px-3 py-4">
                <label style="font-size: 15px;">Total registered : Week</label>
                <label class="text-primary font-semibold">{{$counter_week}} students</label>
            </div>
            <div class="col-md-2 mr-3 mt-3 mb-3 bg-white overflow-hidden shadow-xl sm:rounded-lg px-3 py-4">
                <label style="font-size: 15px;">Total registered : Month</label>
                <label class="text-primary font-semibold">{{$counter_month}} students</label>
            </div>
            <div class="col-md-2 mr-3 mt-3 mb-3 bg-white overflow-hidden shadow-xl sm:rounded-lg px-3 py-4">
                <label style="font-size: 15px;">Total registered : Year</label>
                <label class="text-primary font-semibold">{{$counter_year}} students</label>
            </div>
            <div class="col-md-2 mr-3 mt-3 mb-3 bg-white overflow-hidden shadow-xl sm:rounded-lg px-3 py-4">
                <label style="font-size: 15px;">Total registered : Alltime</label>
                <label class="text-primary font-semibold">{{$counter_alltime}} students</label>
            </div>
           <!--to pdf-->
           <div class="col-md-2"> 
                <x-jet-button id="btnExportPdf" onclick="toPdf()" value="Export To PDF">Export to Pdf</x-jet-button>
            </div>

            <!--download-->
            <div class="col-md-3">
            <x-jet-button id="btnExportExcel" onclick="fnExportToExcel('xlsx', 'StudentReport')">Export to excel</x-jet-button>
            </div>
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
                <table class="table hover align:middle stripe" id="student_table">
                    <thead>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Middlename</th>
                        <th>College</th>
                        <th>Course</th>
                        <th>Date Registered</th>
                        <th>Last Update</th>
                    </thead>
                    <tbody>
                        @forelse ($student as $key=>$item)
                        <tr>
                            <td>{{$item['firstname']}}</td>
                            <td>{{$item['lastname']}}</td>
                            <td>{{$item['middlename']}}</td>
                            <td>{{$item['college']}}</td>
                            <td>{{$item['course']}}</td>
                            <td>{{date('D, M d, Y h:i A',strtotime($item['created_at']))}}</td>

                            @if($item['updated_at'] != '')
                            <td class="text-primary">{{\Carbon\Carbon::parse($item['updated_at'])->diffForHumans()}}</td>
                            @else
                            <td></td>
                            @endif
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
           dtable = $('#student_table').DataTable({
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

            $('#rowsPerPage').on('change', function(){
                    let row =$('#rowsPerPage').val()
                    dtable.page.len(row).draw();
                })


            //search function
            $('#search').keyup(function(){
                dtable.search($(this).val()).draw();
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
                    doc.text(200, y = y + 30, "STUDENT REPORT");
                    doc.autoTable({
                        html: '#student_table',
                        startY: 70,
                        theme: 'grid',
                        
                        styles: {
                            minCellHeight: 40
                        }
                    })
                    doc.save('AddedCollection.pdf');
                };
                
                function fnExportToExcel(fileExtension, filename){
                    var elt = document.getElementById('student_table');
                    var wb = XLSX.utils.table_to_book(elt, {sheet: "sheet1"})
                    return XLSX.writeFile(wb, filename + "." + fileExtension || ('StudentReport.' + (fileExtension || 'xlsx')));
                }

    </script>
@endpush
</x-app-layout>