<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Models\Quiz;
use Carbon\Carbon;

class QuizController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $data = Quiz::get();
        if ($data) {
           
            return response()->json([
                "message" => "Quiz List",
                "status" => 200,
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