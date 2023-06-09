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
                <div class="col-md-7"></div>
                <div class="col-md-2">
                    <a href="/admin/user/manage/collection/add" class="btn btn-primary">Add Collection</a>
                </div>
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
                <h1 class="mb-2 text-primary" style="font-size: 25px;">Collection Table</h1>
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
                            <th>Date Added</th>
                            <th>Last Update</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach($collection as $collection_info)
                                @if($collection_info->collection_status == '1')
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

                                    <td>{{$collection_info->created_at->toDayDateTimeString()}}</td>
                                    @if($collection_info->updated_at == $collection_info->created_at)
                                        <td></td>
                                    @else
                                        <td>{{$collection_info->updated_at->diffForHumans(['parts'=> 2])}}</td>
                                    @endif
                                    <td style="font-size: 10px;">
                                        <a type="button" style="margin-bottom: 20px;" href={{"/admin/user/manage/collection/update/collection/".$collection_info->id}} class="btn btn-primary bg-primary"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                                    @foreach($librarian as $librarian_info) 
                                        @if($librarian_info->role_id == '1')
                                        <a 
                                            href="#" 
                                            data-bs-toggle="modal"
                                            class="btn btn-danger bg-danger deleteCol"
                                            data-id="{{$collection_info->id}}" 
                                            data-bs-target="#delete_collection"
                                            >
                                            <i class="fa fa-trash-o" 
                                            aria-hidden="true"></i></a> 
                                        @endif
                                    @endforeach
                                    </td>

                                </tr> 
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="delete_collection" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true" aria-labelledby="exampleModalLabel"> 
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h3 style="text-transform: uppercase; color:white; font-style:bold;" class="modal-title" id="exampleModalLabel">Delete Collection</h3>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="close"> </button>
                </div>
                <form  action="/delete/collection" method="POST" enctype="multipart/form-data">
                @csrf
                 <div class="modal-body">
                    <input type="hidden" id="delete" name="id">
                    <x-jet-label>Are you sure you want to Delete this collection?</x-jet-label>
                 </div>
                 <div class="modal-footer">
                     <button data-bs-dismiss="modal" type="button" class="btn btn-secondary bg-secondary">Close</button>
                     <button type="submit" class="btn btn-danger bg-danger" id="submit">Delete</button>
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

            $(document).on('click', '.deleteCol', function(){
                var id = $(this).data('id');
                $('#delete').val(id)
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