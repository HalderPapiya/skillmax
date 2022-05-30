<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Models\QuizAnswer;
use App\Models\Quiz;

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
        $quizzes = Quiz::get();
        return view('admin.quiz-answer.add', compact('quizzes'));
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
            'answer' => 'required',
            'quiz_id' => 'required',
            'hint' => 'required',
        ]);

        $data = new Quiz;
        // $team->premium_id = $request->premium_id;
        $data->quiz_id = $request->quiz_id;
        $data->answer = $request->answer;
        $data->hint = $request->hint;

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
        $quizzes = Quiz::get();

        $data = QuizAnswer::find($id);
        return view('admin.quiz-answer.edit', compact('data', 'quizzes'));
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
            'answer' => 'required',
            'quiz_id' => 'required',
            'hint' => 'required',
        ]);


        QuizAnswer::where('id', $id)->update([
            'quiz_id' => $request->quiz_id,
            'answer' => $request->answer,
            'hint' => $request->hint,



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
        Quiz::where('id', $id)->delete();
        return $this->responseRedirect('admin.quiz-answer.index', 'Quiz answer has been deleted successfully', 'success', false, false);
    }
}