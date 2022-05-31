<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Forum;
use App\Http\Controllers\BaseController;
use App\Models\User;

class ForumController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $forums = Forum::get();
        return view('admin.forum.index', compact('forums'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::get();
        return view('admin.forum.add', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'userId' => 'required',
            'title' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg',
            'content' => 'required',
        ]);
        // if ($validator->fails()) {
        //     return $this->sendError('Validation Error.', $validator->errors());
        // }
        // if ($files = $request->file('image')) {
        //     //store file into document folder
        //     $image = $request->image->store(public_path('uploads/forum'));
        // }
        if ($request->hasFile('image')) {
            $fileName = uniqid() . '' . date('ymdhis') . '' . uniqid() . '.' . strtolower($request->image->extension());
            $request->image->move(public_path('uploads/forum/'), $fileName);
            $image = 'uploads/forum/' . $fileName;
        }
        // $forumComments= ForumComment
        $forum = Forum::create([
            'userId' => $request->userId,
            'title' => $request->title,
            'registration_link' => $request->registration_link,
            'image' => $image,
            'content' => $request->content,
            // 'no_of_likes' => $request->no_of_likes,
            // 'no_of_comment' => $request->no_of_comment,

        ]);
        return $this->responseRedirect('admin.forum.index', 'Forum has been created successfully', 'success', false, false);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $forum = Forum::where('id', $id)->first();
        // dd($forum);
        return view('admin.forum.show', compact('forum'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request)
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
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
    public function destroy($id)
    {
    }
}