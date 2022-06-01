@extends('admin.app')
@section('title')
Topic @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> Topic</h1>
            {{-- <h1><i class="fa fa-tags"></i> Add Category</h1> --}}
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="tile">
                <h3 class="tile-title">
               Add Topic
                    {{-- <span class="top-form-btn">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Category</button>
                        <a class="btn btn-secondary" href=""><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </span> --}}
                </h3>
                <hr>
                <form action="{{ route('admin.topic.store') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="module_id">Module <span class="m-l-5 text-danger"> *</span></label>
                            <select class="form-control @error('module_id') is-invalid @enderror"
                                name="module_id" id="module_id" value="{{ old('module_id') }}">
                                <option selected disabled>Select one</option>
                                @foreach ($modules as $module)
                                    <option value="{{ $module->id }}">{{ $module->name }}</option>
                                @endforeach
                            </select>
                            @error('module_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message ?? '' }} </strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="title">Name <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" value="{{ old('title') }}"/>
                            @error('title') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                    
                    <div class="dynamic-field" id="dynamic-field-1">
                        <div class="tile-body">
                            <div class="form-group">
                                <label class="control-label " for="description">Description <span class="m-l-5 text-danger"> *</span></label>
                                {{-- <textarea class="form-control @error('description') is-invalid @enderror" name="description[]"  ></textarea> --}}
                                <input class="form-control @error('description') is-invalid @enderror" type="text" name="description[]" id="description" value="{{ old('description') }}"/>
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
                                <input class="form-control @error('image') is-invalid @enderror" type="file" name="image[]" id="image" value="{{ old('image') }}"/>
                                @error('image') {{ $message ?? '' }} @enderror
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-3">
                        <div>Add / Remove Images and Descriptions</div>
                        <div>
                            <a href="javascript:void(0)" id="add-button" class="btn btn-primary mr-3"> 
                                <i class="fa fa-plus"></i> 
                            </a>
                            <a href="javascript:void(0)"  id="remove-button" class="btn btn-secondary">
                                <i class="fa fa-minus"></i>
                            </a>
                        </div>
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Course</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.topic.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection