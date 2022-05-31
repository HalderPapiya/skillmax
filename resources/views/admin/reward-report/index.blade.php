@extends('admin.app')
@section('title')  @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-file"></i> {{ $pageTitle }}</h1>
            <p>{{ $subTitle }}</p>
            {{-- <p>Category List</p> --}}
        </div>
        {{-- <a href="{{ route('admin.reword.create') }}" class="btn btn-primary pull-right">Add New</a> --}}
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <table class="table table-hover custom-data-table-style table-striped" id="sampleTable">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th> Reward Time </th>
                                <th> Point </th>
                                <th style="width:100px; min-width:100px;" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rewardReports as $key => $rewardReport)
                                <tr>
                                    <td>{{ $rewardReport->id }}</td>
                                    <td>{{ $rewardReport->time }}</td>
                                    <td>{{ $rewardReport->user->name }}</td>
                                    <td>{{ $rewardReport->amount }}</td>
                                    <td class="text-center">
                                    
                                        <div class="btn-group" role="group" aria-label="Second group">
                                            {{-- <a href="{{ url('admin/reword/edit', $reword['id']) }}" class="btn btn-sm btn-primary edit-btn"><i class="fa fa-edit"></i></a> --}}
                                            <a href="{{ route('admin.reward-report.details', $rewardReport['id']) }}" class="btn btn-sm btn-primary edit-btn"><i class="fa fa-eye"></i></a>
                                             {{-- <a href="javascript: void(0)" data-id="{{$reword['id']}}" class="sa-remove btn btn-sm btn-danger edit-btn"><i class="fa fa-trash"></i></a> --}}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('backend/js/plugins/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/plugins/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript">$('#sampleTable').DataTable({"ordering": false});</script>
     {{-- New Add --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.js"></script>
   
@endpush