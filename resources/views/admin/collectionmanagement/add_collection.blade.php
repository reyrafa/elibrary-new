<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Collection Management
        </h2>
    </x-slot>
    <div class="container">
        <form action="/add/collection/book" method="POST">
            @csrf
            <div class="mt-5 row">
            <?php       
                    $id = DB::table('collections')->latest('created_at')->pluck('id')->first();
                      if($id != null){
                    
                        echo "<input type='hidden' id='get_id' value='$id'/>"; }
               
                      else{
                        echo "<input type='hidden' id='get_id' value='0'/>";
                      }
                       ?> 
                       <?php       
                    $id = DB::table('librarian_added_collections')->latest('created_at')->pluck('id')->first();
                      if($id != null){
                    
                        echo "<input type='hidden' id='get_id1' value='$id'/>"; }
               
                      else{
                        echo "<input type='hidden' id='get_id1' value='0'/>";
                      }
                       ?>          
                <input type="hidden" id="user_id1" name="id1">         
                <input type="hidden" id="col_id" name="id">
                <div class="col-md-12 mb-1">
                    <h1 style="font-size: 25px; font-weight:bold">Add Collection</h1>
                    <hr>
                </div>
                <div class="col-md-12 mb-3">
                    <span style="font-size: 12px;">Note: input field with <span class="text-danger">*</span> is required.</span>
                </div>
                <div class="col-md-3 mb-2">
                    <x-jet-label id="label">Title <span class="text-danger">*</span></x-jet-label>
                    <x-jet-input
                        type="text"
                        name="title"
                        placeholder="Title"
                        class="form-control"
                        required autofocus
                    />
                </div>
                <div class="col-md-3 mb-2">
                    <x-jet-label id="label">Author <span class="text-danger">*</span></x-jet-label>
                    <x-jet-input
                        type="text"
                        name="author"
                        placeholder="Author"
                        class="form-control"
                        required autofocus
                    />
                </div>
                <div class="col-md-3 mb-2">
                    <x-jet-label id="label">Isbn <span class="text-danger">*</span></x-jet-label>
                    <x-jet-input
                        type="number"
                        name="isbn"
                        placeholder="ISBN"
                        class="form-control"
                        required autofocus
                    />
                </div>
                <div class="col-md-3 mb-2">
                    <x-jet-label id="label">Callnumber <span class="text-danger">*</span></x-jet-label>
                    <x-jet-input
                        type="number"
                        name="call_number"
                        placeholder="Call number"
                        class="form-control"
                        required autofocus
                    />
                </div>
                <div class="col-md-3 mb-2">
                    <x-jet-label id="label">Page number <span class="text-danger">*</span></x-jet-label>
                    <x-jet-input
                        type="number"
                        name="page_num"
                        placeholder="Page number"
                        class="form-control"
                        required autofocus
                    />
                </div>
                <div class="col-md-3 mb-2">
                    <x-jet-label id="label">Date Publish <span class="text-danger">*</span></x-jet-label>
                    <x-jet-input
                        type="text"
                        name="date_publish"
                        placeholder="Date Publish"
                        class="form-control"
                        required autofocus
                        onfocus="(this.type='date')"
                    />
                </div>
                <div class="col-md-3 mb-3">
                    <x-jet-label id="label">location <span class="text-danger">*</span></x-jet-label>
                    <select 
                        name="location" 
                        class="form-control form-select"
                        required autofocus
                        id="location"
                        >
                        <option value="" disabled="true" selected="true">--Select Location--</option>
                        @foreach($location as $location_info)
                            <option value="{{$location_info->id}}">{{$location_info->location_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <x-jet-label id="label">Section <span class="text-danger">*</span></x-jet-label>
                    <select 
                        name="section" 
                        class="form-control form-select"
                        required autofocus
                        id="section"
                        >
                        <option value="" disabled="true" selected="true">--Select Section--</option>
                        @foreach($section as $section_info)
                            <option value="{{$section_info->id}}">{{$section_info->section_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <x-jet-label id="label">Subject <span class="text-danger">*</span></x-jet-label>
                    <select 
                        name="subject" 
                        class="form-control form-select"
                        required autofocus
                        id="subject"
                        >
                        <option value="" disabled="true" selected="true">--Select Subject--</option>
                        @foreach($subject as $subject_info)
                            <option value="{{$subject_info->id}}">{{$subject_info->subject_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <x-jet-label id="label">Permission <span class="text-danger">*</span></x-jet-label>
                    <select 
                        name="permission" 
                        class="form-control form-select"
                        required autofocus
                        id="permission"
                        >
                        <option value="" disabled="true" selected="true">--Select Permission--</option>
                        @foreach($permission as $permission_info)
                            <option value="{{$permission_info->id}}">{{$permission_info->permission_name}}</option>
                        @endforeach
                    </select>
                </div>
               <div class="col-md-3"></div>
               <div class="col-md-3"></div>
                <div class="col-md-3">
                    <x-jet-label id="label">Upload File <span class="text-danger">*</span> (Only Accepts PDF file.)</x-jet-label>
                    <input 
                        type="file"
                        name="filelink"
                        id="filelink"
                        class="form-control"
                        required autofocus
                        accept="application/pdf">
                    <span id="errorFile"  style="color: red; font-size: 10px" class="text-danger hidden">Still Upload.. Please wait...</span>
                </div>
                <input type="hidden" name="file_url" id="file_url" required>
                <div class="col-md-3"></div>
                <div class="col-md-3"></div>
                <div class="col-md-3"></div>
                <div class="col-md-3 mb-3">
                    <x-jet-button type="submit" id="submit">Add Collection</x-jet-button>
                </div>
            </div>
        </form>
    </div>
    @push('style')
        <style>
            #label{
                font-size: 15px;
                margin-bottom: 3px;
            }
            #location, #section, #subject, #permission{
                box-shadow: none;
            }
        </style>
    @endpush

    @push('script')
        <script>
            $(document).ready(function(){
                var id = parseInt($('#get_id1').val()) + 1
                $('#user_id1').val(id) 
              
                var id = parseInt($('#get_id').val()) + 1
                $('#col_id').val(id) 
               
                $('#filelink').on('change', (event)=>{
                    if($('#file_url').val() == ''){
                    $('#submit').attr('disabled', 'disabled')
                    $('#errorFile').show()
              }
                  else{
                    $('#submit').removeAttr('disabled')
                    $('#errorFile').hide()
              }
                    const file =event.target.files[0]
                    const storageRef = firebase.storage().ref('collection/'+file.name)
                    const task = storageRef.put(file)
                    task.on('state_change', (snapshot)=>{
                        
                    })
                    storageRef.getDownloadURL().then(function(url){
                    console.log(url)
                    $('#file_url').val('')
                    $('#file_url').val(url)
                    if($('#file_url').val() != '') {
                    $('#submit').removeAttr('disabled')
                    $('#errorFile').hide()
              }
                    })
                    
                       
                })
                
               
                
            })

             FilePond.registerPlugin(FilePondPluginFileValidateType);
             FilePond.create(document.querySelector('input[id="filelink"]'), {
                acceptedFileTypes: ['application/pdf'],
                fileValidateTypeDetectType: (source, type) =>
                    new Promise((resolve, reject) => {
            // Do custom type detection here and return with promise

            resolve(type);
            }),
            });

            // Get a reference to the file input element
            const inputElement = document.querySelector('input[id="filelink"]');

            // Create a FilePond instance
            const pond = FilePond.create(inputElement);

            FilePond.setOptions({
                server: {
                    url: '/collection_upload',
                    headers:{
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                }

                

                
            })

        </script>
    @endpush
</x-app-layout>