<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserInterest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\BaseController;
use App\Models\QuizAnswer;
use App\Models\QuizQuestion;
use App\Models\Subscription;
use Illuminate\Support\Facades\Validator;
use App\Models\UserQuiz;
use App\Models\UserQuizAnswer;

class SubscriptionController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = UserQuiz::with('quizQuestion')->get();


        if ($data) {
            return response()->json([
                "status" => 200,
                "message" => "User Quiz List",
                "data" =>   $data

            ]);
        } else {
            return response()->json([
                "status" => 400,
                'message' => 'Something happened'
            ]);
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            // 'start_date' => 'required',
            // 'end_date' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        // $request->quiz_question_id= [];
        // foreach ($request->quiz_question_id as $interestIdKey => $userQuizValue) {

        $data = Subscription::create([
            'user_id' => $request->user_id,
            'start_date' =>  $request->start_date,
            'end_date' =>  $request->end_date
        ]);


        if ($data) {
            return response()->json([
                "status" => 200,
                "message" => "Subscription Successfully",
                "data" => $data,
            ]);
        } else {
            return response()->json([
                "status" => 400,
                'message' => 'Something happened'
            ]);
        }
    }

    public function storeAnswer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'quiz_id' => 'required',
            'question_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        // $request->quiz_question_id= [];
        // foreach ($request->quiz_question_id as $interestIdKey => $userQuizValue) {

        $data = UserQuizAnswer::create([
            'user_id' => $request->user_id,
            'quiz_id' =>  $request->quiz_id,
            'question_id' =>  $request->question_id,
            'answer' =>  $request->answer
        ]);


        if ($data) {
            return response()->json([
                "status" => 200,
                "message" => "User Quiz Answered Successfully",
                "data" => $data,
            ]);
        } else {
            return response()->json([
                "status" => 400,
                'message' => 'Something happened'
            ]);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $data = UserInterest::with('interestDetails')->where('userId', $id)->get();
        // return response()->json([
        //     "status" => 200,
        //     "message" => "User wise interest list",
        //     "data" => $data,
        // ]);
    }
    public function showHint(Request $request, $id)
    {
        $dataQuestion = QuizQuestion::where('id', $id)->first();
        $answer = $dataQuestion->answer;
        $hint = $dataQuestion->hint;
        $answerImagePath = $dataQuestion->answer_image_path;
        $hintAnswerImagePath = $dataQuestion->hint_answer_image_path;
        $dataAnswer = QuizAnswer::where('question_id', $dataQuestion->id)->get();
        foreach ($dataAnswer as $key => $value) {
            $optionAns[] = $value->answer;
            $optionAnsImagePath[] = $value->answer_image_path;
        }
        if (in_array($answer, $optionAns)) {
            return $hint;
        } elseif (in_array($answerImagePath, $optionAnsImagePath)) {
            return $hintAnswerImagePath;
        } else {
            return $hint;
        }

        // return $optionAnsImage;
        // else {
        //     // $status = "Not Paid";
        // }
        // return $optionAns;
        // if($optionAns==$answer){
        //     return   "test";

        // }
        // if($dataAnswer){

        // return response()->json([
        //     "status" => 200,
        //     "message" => "User wise interest list",
        //     "data" => $dataHint,
        // ]);
        // }

        // if($dataAnswer == 0){
        //     $dataHint = QuizQuestion::where('id',$id)->first(['hint','hint_image_path']);
        //     return response()->json([
        //         "status" => 200,
        //         "message" => "User wise interest list",
        //         "data" => $dataHint,
        //     ]);
        // }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $validator = Validator::make($request->all(), [
        //     'interestId' => 'required',
        //     'userId' => 'required',
        // ]);

        // if ($validator->fails()) {
        //     return $this->sendError('Validation Error.', $validator->errors());
        // }
        // $userInterest = UserInterest::where('id', $request->id)->update([
        //     'interestId' => $request->interestId,
        //     'userId' => $request->userId,
        // ]);

        // return response()->json([
        //     "status" => 200,
        //     "data" => $userInterest,
        //     "message" => "User Interest Edit Successful",
        // ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // UserInterest::where('id', $id)->delete();

        // return response()->json([
        //     "status" => 200,
        //     "message" => "User Interest Delete Successful",
        // ]);
    }
}