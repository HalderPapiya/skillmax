<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use Carbon\Carbon;

class QuizController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index($id)
    {
        $quizData = QuizQuestion::with('quizAnswer')->where('module_id', $id)->get();
        // return $quizData;
        if ($quizData) {
           foreach ($quizData as $quizKey => $quizValue) {
           
            $resp[] = [
                'id' => $quizValue->id,
                // 'type' => ($quizKey == 0) ? 'free' : 'prime',
                'module_id' => $quizValue->module_id,
                'question' => $quizValue->question,
                'image' => asset($quizValue->image),
                'path' => $quizValue->path,
                'hint' => $quizValue->hint,
                'hint_image' => asset($quizValue->hint_image),
                'hint_image_path' => $quizValue->hint_image_path,
                'position' => $quizValue->position,
                'created_at' => Carbon::parse($quizValue->created_at)->format('Y-m-d'),
                'updated_at' => Carbon::parse($quizValue->updated_at)->format('Y-m-d'),
                'quiz_answer' => $quizValue->quizAnswer,
            ];
        }
            return response()->json([
                "message" => "Quiz List",
                "status" => 200,
                "data" => $resp,
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
        $data = Quiz::where('id', $id)->where('status', '=', 1)->get();
        // $data=
        if ($data) {
            return response()->json([
                "status" => 200,
                "message" => "Quiz Details",
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
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request)
    {


        // $teamId = $request->id;

        // $team = Team::where('id', $teamId)->update([
        //     'status' => $request->status,
        // ]);
    }
}