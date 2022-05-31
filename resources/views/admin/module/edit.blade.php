



@extends('admin.app')
@section('title') User @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> User</h1>
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="tile">
                <h3 class="tile-title">Edit User</h3>
                <form action="{{ route('admin.module.update',$data->id) }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $data->id }}">
                   


                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="course_id">Course <span class="m-l-5 text-danger"> *</span></label>
                            <select class="form-control @error('course_id') is-invalid @enderror"
                                name="course_id" id="course_id" value="{{ old('course_id') }}">
                                <option selected disabled>Select one</option>
                                @foreach ($courses as $data)
                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
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
                            <label class="control-label" for="name">Name <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" value="{{ old('name',$data->name) }}"/>
                            @error('name') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                    
                     <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="icon">Icon <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('icon') is-invalid @enderror" type="file" name="icon" id="icon" value="{{ old('icon') }}"/>
                            @error('icon') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                     
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update Team</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.module.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection