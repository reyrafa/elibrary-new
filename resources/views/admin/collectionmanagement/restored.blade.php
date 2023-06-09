<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Collection Management
        </h2>
    </x-slot>
    <div class="py-12">
        @foreach($librarian as $librarian_info)
            @if($librarian_info->role_id == '1')
                <div class="container mb-4">
                <div class="bg-white overflow-hidden p-4 shadow-xl sm:rounded-lg">
                    <a href="/admin/user/manage/collection/deleted" class="btn btn-danger">Deleted Collection</a>
                    <a href="/admin/user/manage/collection" class="btn btn-secondary">Added Collection</a>
                    <a href="/admin/user/restored/collection" class="btn btn-success">Restored Collection</a>
                </div>
            @endif
        </div>
        @endforeach
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="row mb-3">
                <div class="col-md-9"></div>
              
                <div class="col-md-3">
                    <div class="input-group">   
                        <div class="form-outline">
                          <input 
                              type="search" 
                              id="search" 
                              name="query"
                              class="form-control" 
                              placeholder="Search Collection"/>
                        </div>
                        <button type="button" class="btn btn-success disabled">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>  
                </div>
            </div>
            <div class="bg-white overflow-hidden p-4 shadow-xl sm:rounded-lg">
                <h1 class="mb-2 text-success" style="font-size: 25px;">Restored Collection Table</h1>
                <div class="table-responsive">
                Show <select name="" id="rowsPerPage" class="form-control-sm rounded-2 col-1">
                        <option selected="true" disabled="disabled"></option>
                        <option value="3">3</option>
                        <option value="10">10</option>
                        <option value="30">30</option>
                    </select> Entries
                    <table class="table stripe align-middle hover" id="collection_table">
                        <thead> 
                            <th>Title</th>
                            <th>Author</th>
                            <th>Isbn</th>
                            <th>Call Number</th>
                            <th>Page Number</th>
                            <th>Location</th>
                            <th>Section</th>
                            <th>Date Publish</th>
                            <th>Subject</th>
                            <th>Date Restored</th>
                            <th style="display: none;">Action</th>
                        </thead>
                        <tbody>
                            @foreach($collection as $collection_info)
                                <tr>
                                    <td>{{$collection_info->title}}</td>
                                    <td>{{$collection_info->author}}</td>
                                    <td>{{$collection_info->isbn}}</td>
                                    <td>{{$collection_info->call_number}}</td>
                                    <td>{{$collection_info->page_num}}</td>

                                    @foreach($location as $location_info)
                                        @if($collection_info->location_id == $location_info->id)
                                        <td>{{$location_info->location_name}}</td>
                                        @endif
                                    @endforeach

                                    @foreach($section as $section_info)
                                        @if($collection_info->section_id == $section_info->id)
                                        <td>{{$section_info->section_name}}</td>
                                        @endif
                                    @endforeach

                                    <td>{{date('F d, Y', strtotime($collection_info->date_publish))}}</td>

                                    @foreach($subject as $subject_info)
                                        @if($collection_info->subject_id == $subject_info->id)
                                        <td>{{$subject_info->subject_name}}</td>
                                        @endif
                                    @endforeach

                                    <td>{{$collection_info->updated_at->toDayDateTimeString()}}</td>
                                    <td style="font-size: 10px; display:none">
                                        <a type="button" 
                                            href="#" 
                                            data-bs-toggle="modal"
                                            data-id="{{$collection_info->id}}"
                                            data-bs-target="#restore_collection"
                                            class="btn btn-primary bg-primary RestoreCol">
                                        <i class="fa fa-refresh" aria-hidden="true">
                                            Restore
                                        </i></a>
                                    
                                    </td>

                                </tr> 
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" 
        id="restore_collection" 
        data-bs-backdrop="static" 
        data-bs-keyboard="false" 
        tabindex="-1" 
        aria-hidden="true" 
        aria-labelledby="exampleModalLabel"> 

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h3 style="text-transform: uppercase; color:white; font-style:bold;" 
                        class="modal-title" 
                        id="exampleModalLabel"
                        >Restore Collection</h3>
                    <button class="btn-close" 
                        data-bs-dismiss="modal" 
                        aria-label="close"> </button>
                </div>
                <form  action="/restore/collection" 
                    method="POST" 
                    enctype="multipart/form-data">
                @csrf
                 <div class="modal-body">
                    <input type="hidden" id="restore" name="id">
                    <x-jet-label>Are you sure you want to Restore this collection?</x-jet-label>
                 </div>
                 <div class="modal-footer">
                     <button data-bs-dismiss="modal" type="button" class="btn btn-secondary bg-secondary">Close</button>
                     <button type="submit" class="btn btn-warning bg-warning" id="submit">Restore</button>
                 </div>

                 </form>
            </div>
        </div>
    </div>
@push('script')

    <script>
   
        $(document).ready( function () {

            //data table
           dtable = $('#collection_table').DataTable({
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

            $(document).on('click', '.RestoreCol', function(){
                var id = $(this).data('id');
                $('#restore').val(id)
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