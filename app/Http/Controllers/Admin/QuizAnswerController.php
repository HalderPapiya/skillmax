<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Models\Module;
use App\Models\QuizAnswer;
use App\Models\QuizQuestion;

class QuizAnswerController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $data = QuizAnswer::get();
        return view('admin.quiz-answer.index', compact('data'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $modules = Module::get();
        $quizzes = QuizQuestion::get();
        return view('admin.quiz-answer.add', compact('quizzes', 'modules'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'question_id' => 'required',
            'module_id' => 'required',
            'answer_image' => 'mimes:img,jpeg,jpg,svg',
            // 'position' => 'digit',
        ]);

        $data = new QuizAnswer;
        // $team->premium_id = $request->premium_id;
        $data->question_id = $request->question_id;
        $data->module_id = $request->module_id;
        $data->answer = $request->answer;
        $data->position = $request->position;

        if ($request->hasFile('answer_image')) {
            $fileName = uniqid() . '' . date('ymdhis') . '' . uniqid() . '.' . strtolower($request->answer_image->extension());
            $request->answer_image->move(public_path('uploads/quiz_answer/'), $fileName);
            $path = env('APP_URL') . '/'  . 'uploads/quiz_answer/' . $fileName;
            $answerImage = 'uploads/quiz_answer/' . $fileName;
        }
        if ($request->hasFile('answer_image')) {

            $data->answer_image =  $answerImage;
            $data->answer_image_path =  $path;
        }
        $data->save();

        return $this->responseRedirect('admin.quiz-answer.index', 'Quiz answer has been created successfully', 'success', false, false);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    //     $users = Quiz::get();
    //     $team = Team::find($id);
    //     return view('admin.team.edit', compact('team', 'users'));
    // }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request)
    {


        $teamId = $request->id;

        $team = QuizAnswer::where('id', $teamId)->update([
            'status' => $request->status,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $modules = Module::get();
        $quizzes = QuizQuestion::get();

        $data = QuizAnswer::find($id);
        return view('admin.quiz-answer.edit', compact('data', 'quizzes', 'modules'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'question_id' => 'required',
            'module_id' => 'required',
            'answer_image' => 'mimes:img,jpeg,jpg,svg',
            // 'position' => 'digit:10',
        ]);
        if ($request->hasFile('answer_image')) {
            $fileName = time() . '.' . $request->answer_image->extension();
            $request->answer_image->move(public_path('uploads/quiz/'), $fileName);
            $answer_image = 'uploads/quiz/' . $fileName;
            $path = env('APP_URL') . '/'  . 'uploads/quiz/' . $fileName;
            QuizAnswer::where('id', $id)->update([
                'answer_image' => $answer_image,
                'answer_image_path' => $path,
            ]);
        } else {
            QuizAnswer::where('id', $id)->update([
                'answer_image' => '',
                'answer_image_path' => '',
            ]);
        }

        QuizAnswer::where('id', $id)->update([
            'question_id' => $request->question_id,
            'answer' => $request->answer,
            'position' => $request->position,
            'module_id' => $request->module_id,



        ]);
        return $this->responseRedirect('admin.quiz-answer.index', 'Quiz answer has been updated successfully', 'success', false, false);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        QuizAnswer::where('id', $id)->delete();
        return $this->responseRedirect('admin.quiz-answer.index', 'Quiz answer has been deleted successfully', 'success', false, false);
    }
}