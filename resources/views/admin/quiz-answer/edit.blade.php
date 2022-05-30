@extends('admin.app')
@section('title') Quiz Answer @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> Quiz Answer</h1>
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="tile">
                <h3 class="tile-title">Edit Quiz</h3>
                <form action="{{ route('admin.quiz-answer.update',$data->id) }}" method="POST" role="form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $data->id }}">
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="quiz_id">Question <span class="m-l-5 text-danger"> *</span></label>
                            <select class="form-control @error('quiz_id') is-invalid @enderror"
                                name="quiz_id" id="quiz_id" value="{{ old('quiz_id') }}">
                                <option selected disabled>Select one</option>
                                @foreach ($quizzes as $quiz)
                                    <option value="{{ $quiz->id }}">{{ $quiz->name }}</option>
                                @endforeach
                            </select>
                            @error('quiz_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message ?? '' }} </strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                     <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="answer">Answer <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('answer') is-invalid @enderror" type="text" name="answer" id="answer" value="{{ old('answer',$data->answer) }}"/>
                            @error('answer') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="hint">Hint <span class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('hint') is-invalid @enderror" type="text" name="hint" id="hint" value="{{ old('hint',$data->hint) }}"/>
                            @error('hint') {{ $message ?? '' }} @enderror
                        </div>
                    </div>
                   
                    
                    
                     
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update Quiz</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('admin.quiz-answer.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection