@extends('admin.app')
@section('title') Quiz @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-file"></i>Quiz</h1>
            <p>Quiz List</p>
        </div>
        <a href="{{ route('admin.module-quiz.create') }}" class="btn btn-primary pull-right">Add New</a>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                {{-- @if (Session::get('success'))
                    <div class="alert alert-success"> {{Session::get('success')}} </div>
                @endif --}}
                <div class="tile-body">
                    <table class="table table-hover custom-data-table-style table-striped" id="sampleTable">
                        <thead>
                            <tr>
                                <th>Sl. No.</th>
                                <th> Module </th>
                                <th style="width:100px; min-width:100px;" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $key => $data)
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>{{  $data->module ? $data->module->name : 'NA' }}</td>
                                 
                                   
                                    <td class="text-center">
                                    
                                        <div class="btn-group" role="group" aria-label="Second group">
                                            <a href="{{ url('admin/module-quiz/edit', $data['id']) }}" class="btn btn-sm btn-primary edit-btn"><i class="fa fa-edit"></i></a>
                                            <a href="{{ url('admin/module-quiz/question-ans', $data['id']) }}" class="btn btn-sm btn-primary edit-btn">Add Question Answer</a>
                                            {{-- <a href="{{ route('admin.interest.details', $interest['id']) }}" class="btn btn-sm btn-primary edit-btn"><i class="fa fa-eye"></i></a> --}}
                                             <a href="javascript: void(0)" data-id="{{$data['id']}}" class="sa-remove btn btn-sm btn-danger edit-btn"><i class="fa fa-trash"></i></a>
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
    <script type="text/javascript">
    $('.sa-remove').on("click",function(){
        var proCourseId = $(this).data('id');
        swal({
          title: "Are you sure?",
          text: "Your will not be able to recover the record!",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: "btn-danger",
          confirmButtonText: "Yes, delete it!",
          closeOnConfirm: false
        },
        function(isConfirm){
          if (isConfirm) {
            window.location.href = "module-quiz/delete/"+proCourseId;
            } else {
              swal("Cancelled", "Record is safe", "error");
            }
        });
    });
    </script>
@endpush