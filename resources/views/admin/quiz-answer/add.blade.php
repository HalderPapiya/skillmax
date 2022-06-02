@extends('admin.app')
@section('title')
Quiz Answer
 @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> Quiz Answer</h1>
            {{-- <h1><i class="fa fa-tags"></i> Add Category</h1> --}}
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="tile">
                <h3 class="tile-title">
               Add Quiz Answer
                    {{-- <span class="top-form-btn">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Category</button>
                        <a class="btn btn-secondary" href=""><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </span> --}}
                </h3>
                <hr>
                <form action="{{ route('admin.quiz-answer.store') }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    {{-- <div class="tile-body">
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
                    </div> --}}
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="question_id">Quistion <span class="m-l-5 text-danger"> *</span></label>
                            <select class="form-control @error('question_id') is-invalid @enderror"
                                name="question_id" id="question_id" value="{{ old('question_id') }}">
                                <option selected disabled>Select one</option>
                                @foreach ($quizzes as $quiz)
                                    <option value="{{ $quiz->id }}">{{ $quiz->question }}</option>
                                @endforeach
                            </select>
                            @error('question_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message ?? '' }} </strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="answer">Answer <span class="m-l-5 text-danger"> </span></label>
                            <input class="form-control @error('answer') is-invalid @enderror" type="text" name="answer" id="answer" value="{{ old('answer') }}"/>
                            @error('answer') {{ $message ?? '' }} @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="answer_image">Answer Image <span class="m-l-5 text-danger"> </span></label>
                            <input class="form-control @error('answer_image') is-invalid @enderror" type="file" name="answer_image" id="answer_image" value="{{ old('answer_image') }}"/>
                            @error('answer_image') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                   
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="position">Position <span class="m-l-5 text-danger"> </span></label>
                            <input class="form-control @error('position') is-invalid @enderror" type="number" name="position" id="position" value="{{ old('position') }}"/>
                            @error('position') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Answer</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.quiz-answer.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection