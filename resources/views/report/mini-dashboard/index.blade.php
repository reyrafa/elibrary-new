<div class="container mt-3 bg-white py-3 px-3 overflow-hidden shadow-xl sm:rounded-lg">
        <div class="row">
            <div class="col-md-2 link1">
                <a href="/admin/user/report/personal/report" id="something" class="btn btn-secondary">Personal Add Report</a>
            </div>
            @foreach($librarian as $librarian_info)
                @if($librarian_info->role_id == '1')
                    <div class="col-md-2 link2">
                        <a href="/user/collection/report" class="btn btn-secondary">Added Collection Report</a>
                    </div>
                @endif
            @endforeach
            
            <div class="col-md-2 link3">
                <a href="/registered/student/report" class="btn btn-secondary">Registered Student Report</a>
            </div>
            <div class="col-md-2 link4">
                <a href="/student/read/download/report" class="btn btn-secondary ">Student Read and Download Report</a>
            </div>
            {{--<div class="col-md-2">
                <a href="/collection/stat/report" class="btn btn-secondary">Collection Stat Report</a>
            </div>--}}
            <div class="col-md-2 link5">
                <a href="/college/course/report" class="btn btn-secondary">College and Course Report</a>
            </div>
        </div>
    </div>
    <script>
    
           /* let buttons = document.querySelectorAll(".btn")
            document.addEventListener("click", function(evt){
                if(evt.target.classList.contains("btn")){
                    buttons.forEach(function(button){
                        button.classList.remove("active")
                    })
                    
                    evt.target.classList.add("active")
                }
            })*/
            function highlightCurrent(){
                const curPage = document.URL;
                const links = document.getElementsByTagName('a')

                
                for(let link of links){
                    
                    if(link.href == curPage){
                    
                        link.classList.add("current")
                    }
                }
            }
            
            document.onreadystatechange = () =>{
                if(document.readyState === 'complete'){
                    highlightCurrent()
                }
            }
    </script>
    <style>
       .current{
            background-color: blue;
           
        }
       /* .link2 a:visited{
            background-color: white;
            text-decoration: none;
        }
        .link3 a:visited{
            background-color: white;
            text-decoration: none;
        }*/
    </style>