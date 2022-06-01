<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Hash;
use App\Models\Module;
use App\Models\ProCourse;
use App\Models\Topic;
use League\CommonMark\Delimiter\Delimiter;

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
        $modules = Module::get();
        // dd($modules);
        // $ = ProCourse::get();
        return view('admin.topic.add', compact('modules'));
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
            // 'image' => 'required|mimes:img,jpeg,jpg,svg',
        ]);
        $data = new Topic;
        // $team->premium_id = $request->premium_id;
        $data->module_id = $request->module_id;
        $data->title = $request->title;
        $data->description = implode('*', $request->description);
        // dd($data);
        foreach ($request->image as $key => $value) {
            // if ($request->hasFile('image')) {
            $fileName = uniqid() . '' . date('ymdhis') . '' . uniqid() . '.' . strtolower($value->extension());
            $value->move(public_path('uploads/topic/'), $fileName);
            $image = 'uploads/topic/' . $fileName;
            $path = env('APP_URL') . '/'  . 'uploads/topic/' . $fileName;
            $delimeter = '';
            if ((count($request->image) - 1) > $key) {
                $delimeter = ',';
            }

            $data->image .=  $image . $delimeter;
            $data->path .=  $path . $delimeter;
            // }
            // echo $path;
        }
        // dd($data);
        // exit;
        // dd($data->image);
        // $data->image .=  $image;
        // $data->path .=  $path;
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
        // $data = Topic::find($id);
        $data = Topic::where('id', $id)->first();
        // dd($data);
        // $description = $data->description;
        // dd($description);
        $dataDesc = explode('*', $data->description);
        $dataImg = explode(',', $data->image);

        // dd($dataImg);
        // $data = $data->image ;
        return view('admin.topic.edit', compact('data', 'modules', 'dataDesc', 'dataImg'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $this->validate($request, [
            'title' => 'required',
            'module_id' => 'required',
            'description' => 'required',
            // 'image' => 'mimes:img,jpeg,jpg,svg',
        ]);
        $uploadedImages = '';
        $uploadedPaths = '';
        if ($request->image) {
            foreach ($request->image as $key => $value) {
                // if ($request->hasFile('image')) {
                $fileName = uniqid() . '' . date('ymdhis') . '' . uniqid() . '.' . strtolower($value->extension());
                $value->move(public_path('uploads/topic/'), $fileName);
                $image = 'uploads/topic/' . $fileName;
                $path = env('APP_URL') . '/'  . 'uploads/topic/' . $fileName;

                $delimeter = '';
                if ((count($request->image) - 1) > $key) {
                    $delimeter = ',';
                }
                $uploadedImages .= $image . $delimeter;
                $uploadedPaths .=  $path . $delimeter;
            }
            Topic::where('id', $id)->update([
                'image' => $uploadedImages,
                'path' => $uploadedPaths
            ]);
            // echo $image;
        }

        // dd($uploadedImages, $uploadedPaths);
        // exit;

        $data = Topic::where('id', $id)->update([
            'module_id' => $request->module_id,
            'title' => $request->title,
            'description' => implode('*', $request->description),
            // 'image' => $uploadedImages,
            // 'path' => $uploadedPaths
           
        ]);
        // dd($data);
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
        Topic::where('id', $id)->delete();
        return $this->responseRedirect('admin.topic.index', 'Topic has been deleted successfully', 'success', false, false);
    }
}