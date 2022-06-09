@extends('admin.app')
@section('title') Quiz @endsection
@section('content')
<div class="app-title">
    <div>
        <h1><i class="fa fa-tags"></i> Quiz</h1>
    </div>
</div>
@include('admin.partials.flash')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="tile">
            <h3 class="tile-title">Edit Question & Answers</h3>
            <form action="{{ route('admin.quiz.update',$data->id) }}" method="POST" role="form"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $data->id }}">
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
            <label class="control-label" for="quiz_id">Quiz <span class="m-l-5 text-danger"> *</span></label>
            <select class="form-control @error('quiz_id') is-invalid @enderror" name="quiz_id" id="quiz_id"
                value="{{ old('quiz_id') }}">
                <option selected disabled>Select one</option>
                @foreach ($quizzes as $quiz)
                <option value="{{ $quiz->id }}">{{ $quiz->id }}</option>
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
            <label class="control-label" for="question">Question <span class="m-l-5 text-danger"> </span></label>
            <input class="form-control @error('question') is-invalid @enderror" type="text" name="question"
                id="question" value="{{ old('question',$data->question) }}" />
            @error('question') {{ $message ?? '' }} @enderror
        </div> OR
        <div class="form-group">
            <label class="control-label" for="image">Question Image <span class="m-l-5 text-danger"> </span></label>
            <img src="{{asset($data->image)}}" width="60" />

            <input class="form-control @error('image') is-invalid @enderror" type="file" name="image" id="image"
                value="{{ old('image') }}" />
            @error('image') {{ $message ?? '' }} @enderror
        </div>
    </div>
    <div class="dynamic-field" id="dynamic-field-1">
        @foreach ($dataOptionAns as $key => $option)
        <div class="tile-body">
            <div class="form-group">
                <label class="control-label " for="answer">Option <span class="m-l-5 text-danger"> *</span></label>
                {{-- <textarea class="form-control @error('description') is-invalid @enderror" name="description[]"  ></textarea> --}}
                <input class="form-control @error('answer') is-invalid @enderror" type="text" name="option_answer[]"
                    id="answer" value="{{ $option }}" />
                @error('answer')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message ?? '' }} </strong>
                </span>
                @enderror
            </div>

        </div>
        <div class="tile-body">
            @if ($dataOptionImg[0] != "")
            <img src="{{asset($dataOptionImg[$key])}}" alt="" width="100">
            @endif
            <div class="form-group">
                <label class="control-label" for="option_answer_image">Option Image <span class="m-l-5 text-danger">
                        *</span></label>
                <input class="form-control @error('option_answer_image') is-invalid @enderror" type="file"
                    name="option_answer_image[]" id="option_answer_image" value="{{ old('option_answer_image') }}" />
                @error('option_answer_image') {{ $message ?? '' }} @enderror
            </div>
        </div>
        @endforeach

        <div class="tile-body">
            <div class="form-group">
                <label class="control-label " for="answer">Select Right {{-- nswer --}} <span class="m-l-5 text-danger">
                        *</span></label>
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
            <a href="javascript:void(0)" id="remove-button" class="btn btn-secondary">
                <i class="fa fa-minus"></i>
            </a>
        </div>
    </div>
    <div class="tile-body">
        <div class="form-group">
            <label class="control-label" for="position">Position <span class="m-l-5 text-danger"> </span></label>
            <input class="form-control @error('position') is-invalid @enderror" type="number" name="position"
                id="position" value="{{ old('position',$data->position) }}" />
            @error('position') {{ $message ?? '' }} @enderror
        </div>
    </div>
    <div class="tile-body">
        <div class="form-group">
            <label class="control-label" for="hint">Hint <span class="m-l-5 text-danger"> </span></label>
            <input class="form-control @error('hint') is-invalid @enderror" type="text" name="hint" id="hint"
                value="{{ old('hint',$data->hint) }}" />
            @error('hint') {{ $message ?? '' }} @enderror
        </div>
    </div>
    OR
    <div class="tile-body">
        <div class="form-group">
            <label class="control-label" for="hint_image">Hint Image <span class="m-l-5 text-danger"> </span></label>
            <img src="{{asset($data->hint_image)}}" width="60" />
            <input class="form-control @error('hint_image') is-invalid @enderror" type="file" name="hint_image"
                id="hint_image" value="{{ old('hint_image') }}" />
            @error('hint_image') {{ $message ?? '' }} @enderror
        </div>
    </div>

    {{-- <div class="tile-body">
                                <div class="form-group">
                                    <label class="control-label" for="answer">Answer <span class="m-l-5 text-danger"> </span></label>
                                    <input class="form-control @error('answer') is-invalid @enderror" type="text" name="answer" id="answer" value="{{ old('answer',$data->answer) }}"/>
    @error('answer') {{ $message ?? '' }} @enderror
</div>OR
<div class="form-group">
    <label class="control-label" for="answer_image">Answer Image <span class="m-l-5 text-danger"> </span></label>
    <img src="{{asset($data->answer_image)}}" width="60" />
    <input class="form-control @error('answer_image') is-invalid @enderror" type="file" name="answer_image"
        id="answer_image" value="{{ old('answer_image') }}" />
    @error('answer_image') {{ $message ?? '' }} @enderror
</div>
</div> --}}
<div class="tile-footer">
    <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update Quiz</button>
    &nbsp;&nbsp;&nbsp;
    <a class="btn btn-secondary" href="{{ route('admin.quiz.index') }}"><i
            class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
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
$('.sa-remove').on("click", function() {
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
        function(isConfirm) {
            if (isConfirm) {
                window.location.href = "quiz-questuin-image/delete/" + proCourseId;
            } else {
                swal("Cancelled", "Record is safe", "error");
            }
        });
});
</script>

@endpush