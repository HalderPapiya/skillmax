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
            <div class="card">
                <div class="card-body">
                    <table class="table table-sm">
                        <tbody>
                            <form>
                                <tr>
                                    <td colspan="100%">
                                        <h5 class="mb-0">Question</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" name="question" id="question" class="form-control" placeholder="Enter Question">
                                    </td>
                                    <td>OR</td>
                                    <td>
                                        <input type="file" name="image" id="image" class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="100%">
                                        <h5 class="mb-0">Hint</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" name="hint" id="hint" class="form-control" placeholder="Enter Hint">
                                    </td>
                                    <td>OR</td>
                                    <td>
                                        <input type="file" name="hint_image" id="hint_image" class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="100%">
                                        <h5 class="mb-0">Option</h5>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex">
                                            <label> Select right answer</label>
                                            <input type="radio" name="is_correct[]" id="is_correct" value="1">
                                            <input type="text" name="answer[]" id="" class="form-control" placeholder="Enter Answer">
                                        </div>
                                    </td>
                                    <td>OR</td>
                                    <td>
                                        <input type="file" name="answer_image[]" id="" class="form-control">
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="javascript: void(0)" class="btn btn-sm btn-success optionAdd">+</a>
                                            <a href="javascript: void(0)" class="btn btn-sm btn-danger">&times;</a>
                                        </div>
                                    </td>
                                </tr>
                                {{-- <tr>
                                    <td>
                                        <div class="d-flex">
                                            <input type="radio" name="answer" id="" value="2">
                                            <input type="text" name="" id="" class="form-control" placeholder="Enter Answer">
                                        </div>
                                    </td>
                                    <td>OR</td>
                                    <td>
                                        <input type="file" name="" id="" class="form-control">
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="" class="btn btn-sm btn-success">+</a>
                                            <a href="" class="btn btn-sm btn-danger">&times;</a>
                                        </div>
                                    </td>
                                </tr> --}}
                               
                                <tr>
                                <div class="tile-footer">
                                    <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Question & Answers</button>
                                    &nbsp;&nbsp;&nbsp;
                                    <a class="btn btn-secondary" href="{{ url('admin/module-quiz/question-ans', $quizzes['id']) }}">Back</a>
                                    {{-- {{ url('admin/quiz/question-ans/create', $quizzes['id']) }} --}}
                                </div>
                                </tr>
                                
                            </form>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('.optionAdd').on('click', function() {
            var content = `
            <tr>
                <td>
                    <div class="d-flex">
                        <input type="radio" name="answer" id="" value="1">
                        <input type="text" name="" id="" class="form-control" placeholder="Enter Answer">
                    </div>
                </td>
                <td>OR</td>
                <td>
                    <input type="file" name="" id="" class="form-control">
                </td>
                <td>
                    <div class="d-flex">
                        <a href="javascript: void(0)" class="btn btn-sm btn-success optionAdd">+</a>
                        <a href="" class="btn btn-sm btn-danger">&times;</a>
                    </div>
                </td>
            </tr>
            `;

            $('table tbody').append(content);
        });
    </script>
@endpush