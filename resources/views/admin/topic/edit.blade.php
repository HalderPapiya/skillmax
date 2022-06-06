@extends('admin.app')
@section('title') Topic @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> Topic</h1>
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="tile">
                <h3 class="tile-title">Edit Topic</h3>
                <form action="{{ route('admin.topic.update',$data->id) }}" method="POST" role="form" enctype="multipart/form-data">

                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                    <input type="hidden" name="id" value="{{ $data->id }}">

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
                            <label class="control-label" for="title">Title <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" value="{{ old('title',$data->title) }}"/>
                            @error('title') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                    {{-- <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label " for="description">Description <span class="m-l-5 text-danger"> *</span></label>
                            <textarea class="form-control @error('description') is-invalid @enderror" name="description"  id="ckeditor" >{{ old('description',$data->description) }}</textarea>
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
                      --}}
                     




                    <div class="dynamic-field" id="dynamic-field-1">
                        {{-- @foreach(explode('*', $data->description) as $desc)  --}}
                        @foreach ($dataDesc as $key => $desc)
                        <div class="tile-body">
                            <div class="form-group">
                                <label class="control-label " for="description">Description <span class="m-l-5 text-danger"> *</span></label>
                                {{-- <textarea class="form-control @error('description') is-invalid @enderror" name="description[]"  ></textarea> --}}
                                <input class="form-control @error('description') is-invalid @enderror" type="text" name="description[]" id="description" value="{{ $desc }}"/>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message ?? '' }} </strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="tile-body">
                            {{-- {{dd($dataImg)}} --}}
                            <img src="{{asset($dataImg[$key])}}" alt="" width="100">
                            <div class="form-group">
                                <label class="control-label" for="image">Image <span class="m-l-5 text-danger"> *</span></label>
                                <input class="form-control @error('image') is-invalid @enderror" type="file" name="image[]" id="image" value="{{ old('image') }}"/>
                                @error('image') {{ $message ?? '' }} @enderror
                            </div>
                        </div>
                        @endforeach
                        
                        
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
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="extra_note">Extra Note <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('extra_note') is-invalid @enderror" type="text" name="extra_note" id="extra_note" value="{{ old('extra_note',$data->extra_note) }}"/>
                            @error('extra_note') {{ $message ?? '' }} @enderror
                        </div>
                    </div>



                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update Topic</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.topic.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection