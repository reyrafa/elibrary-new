<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            User Management
        </h2>
    </x-slot>
    <div class="container mt-5">
        @foreach($librarian as $librarian_info)
        <form action="/admin/user/update/user" method="POST">
            @csrf
            <div class="row">
            <?php       
                    $id = DB::table('collection_update_history')->latest('created_at')->pluck('id')->first();
                      if($id != null){
                    
                        echo "<input type='hidden' id='get_id1' value='$id'/>"; }
               
                      else{
                        echo "<input type='hidden' id='get_id1' value='0'/>";
                      }
                       ?>          
                <input type="hidden" id="user_id1" name="id1">
                <div class="col-md-12 mb-1">
                    <h1 style="font-size: 25px; font-weight:bold">Update Librarian</h1>
                    <hr>
                </div>
                <div class="col-md-12 mb-3">
                    <span style="font-size: 12px;">Note: input field with <span class="text-danger">*</span> is required</span>
                </div>
                <input type="hidden" name="id" value="{{$librarian_info->id}}">
                <input type="hidden" name="librarian_id" value="{{$librarian_info->librarian_id}}">
                <div class="col-md-3 mb-2">
                    <x-jet-label id="label">Employee Id <span class="text-danger">*</span></x-jet-label>
                    <x-jet-input
                        type="number"
                        name="id_number"
                        value="{{$librarian_info->id_number}}"
                        placeholder="Employee Id"
                        class="form-control"
                        required
                    />
                </div>
                <div class="col-md-3 mb-2">
                    <x-jet-label id="label">Firstname <span class="text-danger">*</span></x-jet-label>
                    <x-jet-input
                        type="text"
                        name="firstname"
                        value="{{$librarian_info->firstname}}"
                        placeholder="Firstname"
                        class="form-control"
                        required 
                    />
                </div>
                <div class="col-md-3 mb-2">
                    <x-jet-label id="label">Lastname <span class="text-danger">*</span></x-jet-label>
                    <x-jet-input
                        type="text"
                        name="lastname"
                        placeholder="Lastname"
                        value="{{$librarian_info->lastname}}"
                        class="form-control"
                        required 
                    />
                </div>
                <div class="col-md-3 mb-2">
                    <x-jet-label id="label">Middlename <span class="text-danger">*</span></x-jet-label>
                    <x-jet-input
                        type="text"
                        name="middlename"
                        placeholder="Middlename"
                        value="{{$librarian_info->middlename}}"
                        class="form-control"
                        required 
                    />
                </div>
                <div class="col-md-3 mb-3">
                    <x-jet-label id="label">Role <span class="text-danger">*</span></x-jet-label>
                    <select 
                        name="role" 
                        class="form-control form-select"
                        required 
                        id="role"
                        >
                        <option value="" disabled="true" selected="true">--Select Role--</option>
                        @foreach($role as $role_info)
                            <option value="{{$role_info->id}}"
                            @if($role_info->id == old('id',$librarian_info->role_id))
                            selected="selected"
                            @endif
                             >{{$role_info->role_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <x-jet-label id="label">Account Status <span class="text-danger">*</span></x-jet-label>
                    <select 
                        name="status_id" 
                        class="form-control form-select"
                        required 
                        id="status_id"
                        >
                        <option value="" disabled="true" selected="true">--Select Status--</option>
                        @foreach($user as $user_info)
                            <option value="1" @if('1'==old('status_id',$user_info->status_id)) selected="selected" @endif>Enable</option>
                            <option value="2" @if('2'==old('status_id',$user_info->status_id)) selected="selected" @endif>Disable</option>
                        @endforeach
                    </select>
                </div>
                <div class="hidden">
                    <x-jet-input
                        type="number"
                        name="org"
                        value="1"
                    />
                </div>
                <div class="col-md-3"></div>
                <div class="col-md-3 "></div>
                <div class="col-md-3">
                    <x-jet-button type="submit" id="submit">Update Librarian</x-jet-button>
                </div>
            </div>
        </form>
        @endforeach
    </div>
    @push('style')
        <style>
            #label{
                font-size: 15px;
                margin-bottom: 3px;
            }
            #role, #status_id{
                box-shadow: none;
            }
        </style>
    @endpush
    @push('script')
            <script>
                $(document).ready(function(){
                    var id = parseInt($('#get_id1').val()) + 1
                    $('#user_id1').val(id) 
                })
            </script>
    @endpush
</x-app-layout>