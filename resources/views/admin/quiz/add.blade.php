@extends('admin.app')
@section('title')
Quiz @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> Quiz</h1>
            {{-- <h1><i class="fa fa-tags"></i> Add Category</h1> --}}
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="tile">
                <h3 class="tile-title">
               Add Quiz
                  
                </h3>
                <hr>
                <form action="{{ route('admin.module-quiz.store') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="course_id">Course <span class="m-l-5 text-danger"> *</span></label>
                            <select class="form-control @error('course_id') is-invalid @enderror"
                                name="course_id" id="course_id" value="{{ old('course_id') }}">
                                <option selected disabled>Select one</option>
                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                                @endforeach
                            </select>
                            @error('course_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message ?? '' }} </strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="module_id">Module <span class="m-l-5 text-danger"> *</span></label>
                            <select class="form-control @error('module_id') is-invalid @enderror"
                                name="module_id" id="module_id" value="{{ old('module_id') }}">
                                <option selected disabled>Select one</option>
                                {{-- @foreach ($modules as $module)
                                    <option value="{{ $module->id }}">{{ $module->name }}</option>
                                @endforeach --}}
                            </select>
                            @error('module_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message ?? '' }} </strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                   
                   
                    
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Question</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.module-quiz.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
     {{-- New Add --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.js"></script>
    <script type="text/javascript">

    $(document).ready(function() {
        $('#course_id').on('change', function() {
            var course_id = $('#course_id').val();
            $.ajax({
                url: "{{route('admin.module-quiz.course')}}",
                type: 'POST',
                data: {
                    _token: '{{csrf_token()}}',
                    val: course_id
                },
                success: function(result) {
                    var options = '<option value="" selected="" hidden="">Select Module</option>';
                    $.each(result.sub, function(key, val) {
                        options += '<option value="' + val.id + '">' + val.name + '</option>';
                    });
                    $('#module_id').empty().append(options);
                    // $res->success = false;
                }
            });
        });
    });

    </script>
   
@endpush