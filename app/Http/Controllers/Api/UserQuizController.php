<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserInterest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Validator;
use App\Models\UserQuiz;

class UserQuizController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = UserQuiz::with('quizQuestion')->get();

        return response()->json([
            "status" => 200,
            "data" => $data,
            "message" => "User Quiz List",
        ]);
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
            'quiz_question_id' => 'required|array',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }



        $request->quiz_question_id= [];


                foreach ($request->quiz_question_id as $interestIdKey => $userQuizValue) {
                  
                    $userQuiz = UserQuiz::create(['user_id' => $request->user_id, 'quiz_question_id' =>  $userQuizValue]);
                    
                }
            
        return response()->json([
            "status" => 200,
            "message" => "User Quiz Inserted Successfully",
            "data" => $userQuiz,
        ]);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = UserInterest::with('interestDetails')->where('userId', $id)->get();
        return response()->json([
            "status" => 200,
            "message" => "User wise interest list",
            "data" => $data,
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
        $validator = Validator::make($request->all(), [
            'interestId' => 'required',
            'userId' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $userInterest = UserInterest::where('id', $request->id)->update([
            'interestId' => $request->interestId,
            'userId' => $request->userId,
        ]);

        return response()->json([
            "status" => 200,
            "data" => $userInterest,
            "message" => "User Interest Edit Successful",
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        UserInterest::where('id', $id)->delete();

        return response()->json([
            "status" => 200,
            "message" => "User Interest Delete Successful",
        ]);
    }
}