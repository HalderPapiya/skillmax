<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Models\Forum;
use App\Models\ForumComment;
use Illuminate\Support\Facades\Validator;

class ForumController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $forums = Forum::with('commentDetails', 'likeDetails')->get();
        // $forumCount = ForumComment::where('forumId', $request->id)->count();
        $data = [];
        foreach ($forums as $eventKey => $forumValue) {
            $data[] = [
                'id' => $forumValue->id,
                'userId' => $forumValue->user->fName . ' ' . $forumValue->user->lName,
                'title' => $forumValue->title,
                'image' => $forumValue->image,
                'content' => $forumValue->content,
                'status' => $forumValue->status,
                'likeCount' => $forumValue->likeDetails->count(),
                'commentCount' => $forumValue->commentDetails->count(),
                'created_at' => $forumValue->created_at,
                'updated_at' => $forumValue->updated_at,
            ];
        }

        return response()->json([
            "status" => 200,
            "message" => "Forum List",
            "data" => $data,
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
            'userId' => 'required',
            'title' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg',
            'content' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        // if ($files = $request->file('image')) {
        //     //store file into document folder
        //     $image = $request->image->store(public_path('uploads/forum'));
        // }
        if ($request->hasFile('image')) {
            $fileName = uniqid() . '' . date('ymdhis') . '' . uniqid() . '.' . strtolower($request->image->extension());
            $request->image->move(public_path('uploads/forum/'), $fileName);
            $image = 'uploads/forum/' . $fileName;
        }

        $forum = Forum::create([
            'userId' => $request->userId,
            'title' => $request->title,
            'image' => $image,
            'content' => $request->content,
            'no_of_likes' => $request->no_of_likes,
            'no_of_comment' => $request->no_of_comment,

        ]);
        return response()->json([
            "status" => 200,
            "data" => $forum,
            "message" => "Forum Add Succesfull",
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
        $data = Forum::where('id', $id)->where('status', '=', 1)->get();

        return response()->json([
            "status" => 200,
            "data" => $data,
            "message" => "Forum Details",
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
            'userId' => 'required',
            'title' => 'required',
            'image' => 'mimes:jpeg,png,jpg,gif,svg',
            'content' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        // if ($request->file('image')) {
        //     //store file into document folder
        //     $image = $request->image->store(public_path('uploads/forum'));
        // }

        if ($request->hasFile('image')) {
            $fileName = uniqid() . '' . date('ymdhis') . '' . uniqid() . '.' . strtolower($request->image->extension());
            $request->image->move(public_path('uploads/forum/'), $fileName);
            $image = 'uploads/forum/' . $fileName;
        }
        $forum = Forum::find($id);
        $forum->update([
            'userId' => $request->userId,
            'title' => $request->title,
            'image' => $image,
            'content' => $request->content,
            'no_of_likes' => $request->no_of_likes,
            'no_of_comment' => $request->no_of_comment,
        ]);

        return response()->json([
            "status" => 200,
            "data" => $forum,
            "message" => "Forum Edit Succesfull",
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
        Forum::where('id', $id)->delete();

        return response()->json([
            "status" => 200,
            "message" => "Forum Delete Succesfull",
        ]);
    }
}