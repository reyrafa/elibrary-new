<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Reports
        </h2>
    </x-slot>
    <div class="container mt-3 bg-white py-3 px-3 overflow-hidden shadow-xl sm:rounded-lg">
        <div class="row">
            <div class="col-md-2">
                <a href="/admin/user/report/personal/report" class="btn btn-secondary">Personal Add Report</a>
            </div>
            @foreach($librarian as $librarian_info)
                @if($librarian_info->role_id == '1')
                    <div class="col-md-2">
                        <a href="/user/collection/report" class="btn btn-secondary">Added Collection Report</a>
                    </div>
                @endif
            @endforeach
            
            <div class="col-md-2">
                <a href="/registered/student/report" class="btn btn-secondary">Registered Student Report</a>
            </div>
            <div class="col-md-2">
                <a href="#" class="btn btn-secondary">Student Read and Download Report</a>
            </div>
            <div class="col-md-2">
                <a href="#" class="btn btn-secondary">Collection Stat Report</a>
            </div>
            <div class="col-md-2">
                <a href="#" class="btn btn-secondary">College and Course Report</a>
            </div>
        </div>
    </div>
    <div class="container bg-white mt-3 py-3 px-3 overflow-hidden shadow-xl sm:rounded-lg">
        <div class="row justify-content-center">
            <div class="col-md-12 mt-2 mb-3" style="text-align: center;">
                <h1 style="font-size: 20px;">Add, Delete, and Restore Collection Statistics</h1>
            </div>
            <div class="col-md-6">
                <h1 style="text-align: center; text-transform:uppercase" class="mb-2 text-primary">librarian Adds Per Day</h1>
                {!! $chart1->renderHtml() !!}
            </div>
            <div class="col-md-6">
            <h1 style="text-align: center; text-transform:uppercase" class="mb-2 text-danger">Deleted Per Day</h1>
            {!! $chart_delete->renderHtml() !!}
            </div>
        </div>
    </div>
    {!! $chart1->renderChartJsLibrary() !!}
    {!! $chart1->renderJs() !!}
    {!! $chart_delete->renderChartJsLibrary() !!}
    {!! $chart_delete->renderJs() !!}
@push('script')
<script>
    $(document).ready(function(){
      
    })

</script>
@endpush
</x-app-layout>