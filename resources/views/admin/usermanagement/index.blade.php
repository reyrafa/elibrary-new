<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            User Management
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="row mb-3">
                <div class="col-md-7"></div>
                <div class="col-md-2">
                    <a href="/admin/user/manage/user/add" class="btn btn-primary">Add Librarian</a>
                </div>
                <div class="col-md-3">
                    <div class="input-group">   
                        <div class="form-outline">
                          <input 
                              type="search" 
                              id="search" 
                              name="query"
                              class="form-control" 
                              placeholder="Search Librarian"/>
                        </div>
                        <button type="button" class="btn btn-success disabled">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>  
                </div>
            </div>
            <div class="bg-white overflow-hidden p-4 shadow-xl sm:rounded-lg">
                <h1 class="text-xl font-bold mb-2">Librarian Table</h1>
                <div class="table-responsive">
                   Show <select name="" id="rowsPerPage" class="form-control-sm rounded-2 col-1">
                        <option selected="true" disabled="disabled"></option>
                        <option value="3">3</option>
                        <option value="10">10</option>
                        <option value="30">30</option>
                    </select> Entries
                    <table class="table stripe align-middle hover" id="user_table">
                        <thead> 
                            <th>Employee Id</th>
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>Middlename</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Registered Date</th>
                            <th>Last Update</th>
                            <th>Status</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach($librarian as $librarian_info)
                            <tr>
                                <td>{{$librarian_info->id_number}}</td>
                                <td>{{$librarian_info->firstname}}</td>
                                <td>{{$librarian_info->lastname}}</td>
                                <td>{{$librarian_info->middlename}}</td>
                                @foreach($user as $user_info)
                                    @if($librarian_info->librarian_id == $user_info->id)
                                    <td>{{$user_info->email}}</td>
                                    @endif
                                @endforeach
                                @foreach($role as $role_info)
                                    @if($librarian_info->role_id == $role_info->id)
                                        @if($role_info->id == '1')
                                            <td><span style="background-color: yellowgreen; padding:5px; border-radius:25px">{{$role_info->role_name}}</span></td>
                                        @elseif($role_info->id == '2')
                                            <td><span style="background-color: blue; padding:5px; border-radius:25px; color:white">{{$role_info->role_name}}</span></td>
                                        @endif
                                    @endif
                                @endforeach
                                <td>{{$librarian_info->created_at->toDayDateTimeString()}}</td>

                                @if($librarian_info->updated_at == $librarian_info->created_at)
                                    <td></td>
                                @else
                                    <td>{{$librarian_info->updated_at->diffForHumans(['parts' => 2])}}</td>
                                @endif
                                
                                @foreach($user as $user_info)
                                    @if($librarian_info->librarian_id == $user_info->id)
                                        @if($user_info->status_id == '1')
                                            <td>Enabled</td>
                                        @elseif($user_info->status_id == '2')
                                            <td>Disabled</td>
                                        @endif
                                    @endif
                                @endforeach
                                <td><a type="button" href={{"/admin/user/manage/user/update/librarian/".$librarian_info->librarian_id}} class="btn btn-primary bg-primary"><i class="fa fa-refresh" aria-hidden="true"></i></a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @push('script')

        <script>
           
            $(document).ready( function () {

                //data table
               dtable = $('#user_table').DataTable({
                    "language": {
                    "search": "Filter records:"
                    },
                   
                   "lengthMenu": [5, 10, 20, 50],
                   "bLengthChange": false,
                  
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

