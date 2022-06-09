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
               Add Question & Answers
                    {{-- <span class="top-form-btn">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Category</button>
                        <a class="btn btn-secondary" href=""><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    </span> --}}
                </h3>
                <hr>
                <form action="{{ route('admin.quiz.store') }}" method="POST" role="form" enctype="multipart/form-data">
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
                            <input type="hidden" name="quiz_id" value="{{$quizzes->id}}">
                            {{-- <label class="control-label" for="quiz_id">Quiz <span class="m-l-5 text-danger"> *</span></label>
                            <select class="form-control @error('quiz_id') is-invalid @enderror"
                                name="quiz_id" id="quiz_id" value="{{ old('quiz_id') }}">
                                <option selected disabled>Select one</option>
                                @foreach ($quizzes as $quiz)
                                    <option value="{{ $quiz->id }}">{{ $quiz->module->name }}</option>
                                @endforeach
                            </select>
                            @error('quiz_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message ?? '' }} </strong>
                                </span>
                            @enderror --}}
                        </div>
                    </div>
                    <div class="tile-body">
                        <div class="form-group ">
                            <label class="control-label" for="question">Question <span class="m-l-5 text-danger"> </span></label>
                            {{-- <textarea class="form-control @error('question') is-invalid @enderror" name="question"  id="ckeditor" value="{{ old('question') }}"></textarea> --}}
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
                    <div class="dynamic-field" id="dynamic-field-1">
                        <input type="hidden" name="addMore[]">
                        <div class="tile-body">
                            <div class="form-group">
                                <label class="control-label " for="answer">Option <span class="m-l-5 text-danger"> *</span></label>
                                {{-- <textarea class="form-control @error('description') is-invalid @enderror" name="description[]"  ></textarea> --}}
                                <input class="form-control @error('answer') is-invalid @enderror" type="text" name="option_answer[]" id="answer" value="{{ old('answer') }}"/>
                                @error('answer')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message ?? '' }} </strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="tile-body">
                            <div class="form-group">
                                <label class="control-label" for="option_answer_image">Option Image <span class="m-l-5 text-danger"> *</span></label>
                                <input class="form-control @error('option_answer_image') is-invalid @enderror" type="file" name="option_answer_image[]" id="option_answer_image" value="{{ old('option_answer_image') }}"/>
                                @error('option_answer_image') {{ $message ?? '' }} @enderror
                            </div>
                        </div>
                        <div class="tile-body">
                            <div class="form-group">
                                {{-- <input type="hidden"name="is_right"value="1"> --}}
                                {{-- <input type="radio" id="is_right" name="is_right[]" value=[1]> --}}
                                {{-- <input type="radio" id="is_right" name="is_right[]" value="0"> --}}
                                {{-- <label class="control-label " for="is_right">Right nswer </label> --}}

                                {{-- <input type="radio" id="is_right" name="is_right[]" value="0"> --}}
                                {{-- <input type="radio" id="is_righ" name="is_right[]" value=[0]> --}}
                                {{-- <label class="control-label " for="is_right">Wrong </label> --}}
                                {{-- <textarea class="form-control @error('description') is-invalid @enderror" name="description[]"  ></textarea> --}}
                                {{-- <input class="form-control @error('answer') is-invalid @enderror" type="text" name="answer" id="answer" value="{{ old('answer') }}"/>
                                <input type="radio" id="answer" name="answer" value="HTML">
                                <label for="answer">1</label><br>
                                @error('answer')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message ?? '' }} </strong>
                                    </span>
                                @enderror --}}
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-3">
                        <div>Add / Remove Option Images and Option</div>
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
                    {{-- <div class="dynamic-field" id="dynamic-field-1"> --}}
                        <div class="tile-body">
                            <div class="form-group">
                                <label class="control-label" for="answer">Select Right Answer <span class="m-l-5 text-danger"> </span></label>
                                {{-- @foreach ($option_answer[] as $optAns) --}}
                                {{-- <input class="form-control @error('answer') is-invalid @enderror" type="text" name="answer[0]" id="answer" value="{{ old('answer') }}"/> --}}
                                {{-- @endforeach --}}
                                @error('answer') {{ $message ?? '' }} @enderror
                            </div>
                        </div>
                        <div class="tile-body">
                            <div class="form-group">
                                <label class="control-label" for="answer">Select Right Answer <span class="m-l-5 text-danger"> </span></label>
                                {{-- @foreach ($option_answer[] as $optAns) --}}
                                {{-- <input class="form-control @error('answer') is-invalid @enderror" type="text" name="answer[1]" id="answer" value="{{ old('answer') }}"/> --}}
                                {{-- @endforeach --}}
                                @error('answer') {{ $message ?? '' }} @enderror
                            </div>
                        </div>
                       
                    {{-- </div> --}}

                    {{-- <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="answer">Answer <span class="m-l-5 text-danger"> </span></label>
                            <input class="form-control @error('answer') is-invalid @enderror" type="text" name="answer" id="answer" value="{{ old('answer') }}"/>
                            @error('answer') {{ $message ?? '' }} @enderror
                        </div>OR
                        <div class="form-group">
                            <label class="control-label" for="answer_image">Answer Image <span class="m-l-5 text-danger"> </span></label>
                            <input class="form-control @error('answer_image') is-invalid @enderror" type="file" name="answer_image" id="answer_image" value="{{ old('answer_image') }}"/>
                            @error('answer_image') {{ $message ?? '' }} @enderror
                        </div>
                    </div> --}}
                    <div class="tile-body">
                        
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Question & Answers</button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ url('admin/module-quiz/question-ans', $quizzes['id']) }}">Back</a>
                        {{-- {{ url('admin/quiz/question-ans/create', $quizzes['id']) }} --}}
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection