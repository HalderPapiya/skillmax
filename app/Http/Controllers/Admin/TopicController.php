<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Hash;
use App\Models\Module;
use App\Models\ProCourse;
use App\Models\Topic;

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
        return view('admin.topic.index', compact('data'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = Topic::get();
        // $ = ProCourse::get();
        return view('admin.topic.add', compact('courses'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        // dd($request->all());
        $this->validate($request, [
            'title' => 'required',
            'module_id' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:img,jpeg,jpg,svg',
        ]);
        $data = new Topic;
        // $team->premium_id = $request->premium_id;
        $data->module_id = $request->module_id;
        $data->title = $request->title;
        $data->description = $request->description;

        if ($request->hasFile('image')) {
            $fileName = uniqid() . '' . date('ymdhis') . '' . uniqid() . '.' . strtolower($request->icon->extension());
            $request->image->move(public_path( env('APP_URL') . '/' .'uploads/topic/'), $fileName);
            $image = 'uploads/topic/' . $fileName;
        }
        $data->image =  $image;
        $data->save();

        return $this->responseRedirect('admin.topic.index', 'Topic has been created successfully', 'success', false, false);
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
    // public function edit($id)
    // {
    //     $users = ProCourse::get();
    //     $team = Team::find($id);
    //     return view('admin.team.edit', compact('team', 'users'));
    // }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request)
    {


        $topicId = $request->id;

        $topic = Topic::where('id', $topicId)->update([
            'status' => $request->status,
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
        $modules = Module::get();
        $data = Topic::find($id);
        return view('admin.topic.edit', compact('data','modules'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'module_id' => 'required',
            'description' => 'required',
            'image' => 'mimes:img,jpeg,jpg,svg',
        ]);

        if ($request->hasFile('image')) {
            $fileName = uniqid() . '' . date('ymdhis') . '' . uniqid() . '.' . strtolower($request->icon->extension());
            $request->image->move(public_path( env('APP_URL') . '/' .'uploads/topic/'), $fileName);
            $image = 'uploads/topic/' . $fileName;
            Topic::where('id', $id)->update([
                'image' => $image,
            ]);
        }
        

        Topic::where('id', $id)->update([
            'module_id' => $request->module_id,
            'title' => $request->title,
            'description' => $request->description,
        ]);
        return $this->responseRedirect('admin.topic.index', 'Topic has been updated successfully', 'success', false, false);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Module::where('id', $id)->delete();
        return $this->responseRedirect('admin.topic.index', 'Topic has been deleted successfully', 'success', false, false);
    }
}