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
                    {{-- <span class="top-form-btn">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Category</button>
                        <a class="btn btn-secondary" href=""><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </span> --}}
                </h3>
                <hr>
                <form action="{{ route('admin.quiz.store') }}" method="POST" role="form" enctype="multipart/form-data">
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
                        <div class="form-group ">
                            <label class="control-label" for="question">Question <span class="m-l-5 text-danger"> </span></label>
                            <input class="form-control @error('question') is-invalid @enderror" type="text" name="question" id="question" value="{{ old('question') }}"/>
                            @error('question') {{ $message ?? '' }} @enderror
                        </div>OR
                        <div class="form-group">
                            <label class="control-label" for="image">Question Image <span class="m-l-5 text-danger"></span></label>
                            <input class="form-control @error('image') is-invalid @enderror" type="file" name="image" id="image" value="{{ old('image') }}"/>
                            @error('image') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                    {{-- <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="hint">Hint <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('hint') is-invalid @enderror" type="text" name="hint" id="hint" value="{{ old('hint') }}"/>
                            @error('hint') {{ $message ?? '' }} @enderror
                        </div>
                    </div> --}}
                   
                     <div class="tile-body">
                       
                    </div>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="position">Position <span class="m-l-5 text-danger"> </span></label>
                            <input class="form-control @error('position') is-invalid @enderror" type="number" name="position" id="position" value="{{ old('position') }}"/>
                            @error('position') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                     <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="hint">Hint <span class="m-l-5 text-danger"> </span></label>
                            <input class="form-control @error('hint') is-invalid @enderror" type="text" name="hint" id="hint" value="{{ old('hint') }}"/>
                            @error('hint') {{ $message ?? '' }} @enderror
                        </div>OR
                        <div class="form-group">
                            <label class="control-label" for="hint_image">Hint Image <span class="m-l-5 text-danger"> </span></label>
                            <input class="form-control @error('hint_image') is-invalid @enderror" type="file" name="hint_image" id="hint_image" value="{{ old('hint_image') }}"/>
                            @error('hint_image') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                    <div class="tile-body">
                        
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Question</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.quiz.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection