<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Models\ForumComment;
use App\Models\ForumLike;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\TryCatch;

class ForumLikeController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $forumLikes = ForumLike::where('forumId', $id)->count();

        return response()->json([
            "status" => 200,
            "data" => $forumLikes,
            "message" => "Forum Like",
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

        $forumLike = ForumLike::where('userId', $request->userId)->where('forumId', $request->forumId)->first();
        if ($forumLike) {
            $data = ForumLike::where('userId', $request->userId)->where('forumId', $request->forumId)->delete();
            return response()->json([
                "status" => 200,
                // "data" => $data,
                "message" => "Forum Like Deleted Succesfully",
            ]);
        } else {
            $data = ForumLike::create([
                'userId' => $request->userId,
                'forumId' => $request->forumId,
            ]);
            return response()->json([
                "status" => 200,
                "data" => $data,
                "message" => "Forum Like Add Succesfull",
            ]);
        }
        // $data = ForumComment::create([
        //     'userId' => $request->userId,
        //     'forumId' => $request->forumId,
        //     'content' => $request->content,
        // ]);
        // return response()->json([
        //     "status" => 200,
        //     "data" => $data,
        //     "message" => "Forum Comment Add Succesfull",
        // ]);
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