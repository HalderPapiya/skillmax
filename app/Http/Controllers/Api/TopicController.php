<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Models\Topic;
use Carbon\Carbon;

class TopicController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $data = Topic::get();
        if ($data) {
           
            return response()->json([
                "message" => "Topic List",
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
    // public function index($id)
    // {
    //     $moduleData = Topic::where('module_id', $id)->get();
    //     if ($moduleData) {
    //         foreach ($moduleData as $key => $dataValue) {
    //             $data[] = [
    //                 'id' => $dataValue->id,
    //                 // 'type' => ($key == 0)?'free' : 'prime',
    //                 'module_id' => $dataValue->module_id,
    //                 'title' => $dataValue->title,
    //                 'description' => $dataValue->description,
    //                 'image' => env('APP_URL') . '/' . asset($dataValue->image),
    //                 'created_at' => Carbon::parse($dataValue->created_at)->format('Y-m-d'),
    //                 'updated_at' => Carbon::parse($dataValue->updated_at)->format('Y-m-d'),
    //                 // 'course' =>$dataValue->proCourse
    //             ];
    //         }
    //         return response()->json([
    //             "message" => "Topic List",
    //             "status" => 200,
    //             "data" => $data,
    //         ]);
    //     } else {
    //         return response()->json([
    //             "status" => 400,
    //             'message' => 'Something happened'
    //         ]);
    //     }
    // }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Topic::where('id', $id)->where('status', '=', 1)->get();
        // $data=
        if ($data) {
            return response()->json([
                "status" => 200,
                "message" => "Topic Details",
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