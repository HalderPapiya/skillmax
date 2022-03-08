<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserInterest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Validator;

class UserInterestController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userInterests = UserInterest::get();

        return response()->json([
            "status" => 200,
            "data" => $userInterests,
            "message" => "User Interest List",
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
            'interestId' => 'required',
            'userId' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $interestId = $request->interestId;
        $userId = $request->userId;

        $userInterest     = UserInterest::create([
            'interestId' => $interestId,
            'userId' => $userId,


        ]);
        return response()->json([
            "status" => 200,
            "data" => $userInterest,
            "message" => "Interest Add Succesfull",
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
            "message" => "User Interest Edit Succesfull",
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
            "message" => "User Interest Delete Succesfull",
        ]);
    }
}