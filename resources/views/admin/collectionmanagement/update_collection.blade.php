<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Collection Management
        </h2>
    </x-slot>
    <div class="container">
        <form action="/update/collection/book" method="POST">
            @csrf
            @foreach($collection as $collection_info)
            <div class="mt-5 row">

                <div class="col-md-12 mb-1">
                    <h1 style="font-size: 25px; font-weight:bold">Update Collection</h1>
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
                        value="{{$collection_info->title}}"
                        placeholder="Title"
                        class="form-control"
                        required
                    />
                </div>
                <div class="col-md-3 mb-2">
                    <x-jet-label id="label">Author <span class="text-danger">*</span></x-jet-label>
                    <x-jet-input
                        type="text"
                        name="author"
                        value="{{$collection_info->author}}"
                        placeholder="Author"
                        class="form-control"
                        required 
                    />
                </div>
                <div class="col-md-3 mb-2">
                    <x-jet-label id="label">Isbn <span class="text-danger">*</span></x-jet-label>
                    <x-jet-input
                        type="number"
                        name="isbn"
                        placeholder="ISBN"
                        value="{{$collection_info->isbn}}"
                        class="form-control"
                        required
                    />
                </div>
                <div class="col-md-3 mb-2">
                    <x-jet-label id="label">Callnumber <span class="text-danger">*</span></x-jet-label>
                    <x-jet-input
                        type="number"
                        name="call_number"
                        value="{{$collection_info->call_number}}"
                        placeholder="Call number"
                        class="form-control"
                        required
                    />
                </div>
                <div class="col-md-3 mb-2">
                    <x-jet-label id="label">Page number <span class="text-danger">*</span></x-jet-label>
                    <x-jet-input
                        type="number"
                        name="page_num"
                        value="{{$collection_info->page_num}}"
                        placeholder="Page number"
                        class="form-control"
                        required 
                    />
                </div>
                <div class="col-md-3 mb-2">
                    <x-jet-label id="label">Date Publish <span class="text-danger">*</span></x-jet-label>
                    <x-jet-input
                        type="text"
                        name="date_publish"
                        placeholder="Date Publish"
                        value="{{$collection_info->date_publish}}"
                        class="form-control"
                        required 
                        onfocus="(this.type='date')"
                    />
                </div>
                <div class="col-md-3 mb-3">
                    <x-jet-label id="label">location <span class="text-danger">*</span></x-jet-label>
                    <select 
                        name="location" 
                        class="form-control form-select"
                        required 
                        id="location"
                        >
                        <option value="" disabled="true" selected="true">--Select Location--</option>
                        @foreach($location as $location_info)
                            <option value="{{$location_info->id}}"
                                @if($location_info->id == old('id',$location_info->id))
                                selected="selected"
                                @endif
                            >{{$location_info->location_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <x-jet-label id="label">Section <span class="text-danger">*</span></x-jet-label>
                    <select 
                        name="section" 
                        class="form-control form-select"
                        required 
                        id="section"
                        >
                        <option value="" disabled="true" selected="true">--Select Section--</option>
                        @foreach($section as $section_info)
                            <option value="{{$section_info->id}}"
                                @if($section_info->id == old('id',$section_info->id))
                                selected="selected"
                                @endif
                            >{{$section_info->section_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <x-jet-label id="label">Subject <span class="text-danger">*</span></x-jet-label>
                    <select 
                        name="subject" 
                        class="form-control form-select"
                        required 
                        id="subject"
                        >
                        <option value="" disabled="true" selected="true">--Select Subject--</option>
                        @foreach($subject as $subject_info)
                            <option value="{{$subject_info->id}}"
                                @if($subject_info->id == old('id',$subject_info->id))
                                selected="selected"
                                @endif
                            >{{$subject_info->subject_name}}</option>
                        @endforeach
                    </select>
                </div>
                <input type="hidden" value="{{$collection_info->firebase_key}}" name="firebase_key">
                <div class="col-md-3 mb-3">
                    <x-jet-label id="label">Permission <span class="text-danger">*</span></x-jet-label>
                    <select 
                        name="permission" 
                        class="form-control form-select"
                        required 
                        id="permission"
                        >
                        <option value="" disabled="true" selected="true">--Select Permission--</option>
                        @foreach($permission as $permission_info)
                            <option value="{{$permission_info->id}}"
                                @if($permission_info->id == old('id',$permission_info->id))
                                selected="selected"
                                @endif
                            >{{$permission_info->permission_name}}</option>
                        @endforeach
                    </select>
                </div>
                <input type="hidden" name="id" value="{{$collection_info->id}}">
               <div class="col-md-3"></div>
               <div class="col-md-3"></div>
                <div class="col-md-3">
                    <x-jet-label id="label">Upload File <span class="text-danger">*</span> (Only Accepts PDF file.)</x-jet-label>
                    <input 
                        type="file"
                        name="filelink"
                        id="filelink"
                        class="form-control"
                        required 
                        accept="application/pdf">
                </div>
                <input type="hidden" name="file_url" id="file_url" required>
                <div class="col-md-3"></div>
                <div class="col-md-3"></div>
                <div class="col-md-3"></div>
                <div class="col-md-3 mb-3">
                    <x-jet-button type="submit" id="submit">Update Collection</x-jet-button>
                </div>
            </div>
            @endforeach
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
              
                $('#filelink').on('change', (event)=>{
                    const file =event.target.files[0]
                    const storageRef = firebase.storage().ref('collection/'+file.name)
                    const task = storageRef.put(file)
                    task.on('state_change', (snapshot)=>{
                        
                    })
                    storageRef.getDownloadURL().then(function(url){
                    console.log(url)
                    $('#file_url').val('')
                    $('#file_url').val(url)
    
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