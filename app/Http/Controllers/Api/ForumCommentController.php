<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Models\ForumComment;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\TryCatch;

class ForumCommentController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $forums = ForumComment::with('user')->where('forumId', $id)->get();

        return response()->json([
            "status" => 200,
            "data" => $forums,
            "message" => "Forum Comment List",
        ]);
    }
    public function noOfComment($id)
    {
        $forums = ForumComment::where('forumId', $id)->count();

        return response()->json([
            "status" => 200,
            "data" => $forums,
            "message" => "Forum Comment List",
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
            'forumId' => 'required',
            'content' => 'required',
        ]);


        $data = ForumComment::create([
            'userId' => $request->userId,
            'forumId' => $request->forumId,
            'content' => $request->content,
        ]);
        return response()->json([
            "status" => 200,
            "data" => $data,
            "message" => "Forum Comment Add Succesfull",
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
        $data = ForumComment::where('id', $id)->get();

        return response()->json([
            "status" => 200,
            "data" => $data,
            "message" => "Forum Comment Details",
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
            'forumId' => 'required',
            'content' => 'required',
        ]);

        $forumComment = ForumComment::find($id);
        $forumComment->update([
            'userId' => $request->userId,
            'forumId' => $request->forumId,
            'content' => $request->content,
        ]);

        return response()->json([
            "status" => 200,
            "data" => $forumComment,
            "message" => "Forum Comment Edit Succesfull",
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($userId, $id)
    {
        try {
            $data = ForumComment::where([['id', $id], ['userId', $userId]])->delete();

            if ($data) {
                return response()->json(["status" => 200, "message" => "Forum Comment Deleted Succesfully"]);
            } else {
                return response()->json(["status" => 400, "message" => "Something happened"]);
            }
        } catch (\Throwable $th) {
            return response()->json(["status" => 400, "message" => $th]);
        }
    }
}