<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Reports
        </h2>
    </x-slot>
    @include('report.mini-dashboard.index')
    <div class="container mt-4" style="font-family: 'Poppins', san-serif;">
    <h1 style="font-size: 25px;">COLLEGES STAT : REGISTERED STUDENT REPORT</h1>
        <div class="row">
            <div class="col-md-2 mr-3 mt-3 mb-3 bg-white overflow-hidden shadow-xl sm:rounded-lg px-3 py-4">
                <label style="font-size: 15px;">College of Technology</label>
                <label class="text-primary font-semibold">{{$cot}} students</label>
            </div>
            <div class="col-md-2 mr-3 mt-3 mb-3 bg-white overflow-hidden shadow-xl sm:rounded-lg px-3 py-4">
                <label style="font-size: 15px;">College of Business</label>
                <label class="text-primary font-semibold">{{$cob}} students</label>
            </div>
            <div class="col-md-2 mr-3 mt-3 mb-3 bg-white overflow-hidden shadow-xl sm:rounded-lg px-3 py-4">
                <label style="font-size: 15px;">College of Nursing</label>
                <label class="text-primary font-semibold">{{$con}} students</label>
            </div>
            <div class="col-md-2 mr-3 mt-3 mb-3 bg-white overflow-hidden shadow-xl sm:rounded-lg px-3 py-4">
                <label style="font-size: 15px;">College of Law</label>
                <label class="text-primary font-semibold">{{$col}} students</label>
            </div>
            <div class="col-md-2 mr-3 mt-3 mb-3 bg-white overflow-hidden shadow-xl sm:rounded-lg px-3 py-4">
                <label style="font-size: 15px;">College of Education</label>
                <label class="text-primary font-semibold">{{$coe}} students</label>
            </div>
            <div class="col-md-2 mr-3 mt-3 mb-3 bg-white overflow-hidden shadow-xl sm:rounded-lg px-3 py-4">
                <label style="font-size: 15px;">College of Arts and Sciences</label>
                <label class="text-primary font-semibold">{{$cas}} students</label>
            </div>
            <div class="col-md-2 mr-3 mt-3 mb-3 bg-white overflow-hidden shadow-xl sm:rounded-lg px-3 py-4">
                <label style="font-size: 15px;">College of Administration</label>
                <label class="text-primary font-semibold">{{$coa}} students</label>
            </div>
        </div>
       
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
            #search, #select_report{
                box-shadow: none;
            }

        </style>
    @endpush
</x-app-layout>