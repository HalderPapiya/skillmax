@extends('admin.app')
@section('title') Pro Course @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> Pro Course</h1>
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="tile">
                <h3 class="tile-title">Edit Pro Course</h3>
                <form action="{{ route('admin.pro-course.update',$data->id) }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $data->id }}">
                   


                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="mentor">Mentor <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('mentor') is-invalid @enderror" type="text" name="mentor" id="mentor" value="{{ old('mentor',$data->mentor) }}"/>
                            @error('mentor') {{ $message ?? '' }} @enderror
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
                            <label class="control-label " for="description">Description <span class="m-l-5 text-danger"> *</span></label>
                            <textarea class="form-control @error('description') is-invalid @enderror" name="description"  id="ckeditor" >{{ old('name',$data->description) }}</textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message ?? '' }} </strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                     <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="image">Image <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('image') is-invalid @enderror" type="file" name="image" id="image" value="{{ old('image') }}"/>
                            @error('image') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                     
                     
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update Team</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.pro-course.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection