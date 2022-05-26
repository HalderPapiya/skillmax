<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Http\Controllers\BaseController;
use App\Models\ProCourse;

class ProCourseController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $data = ProCourse::get();
        return view('admin.pro-course.index', compact('data'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $ = ProCourse::get();
        return view('admin.pro-course.add');
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
            'name' => 'required',
            'mentor' => 'required',
            'image' => 'required|mimes:img,jpeg,jpg,svg',
            'description' => 'required',
        ]);

        $data = new ProCourse;
        // $team->premium_id = $request->premium_id;
        $data->mentor = $request->mentor;
        $data->name = $request->name;
        $data->description = $request->description;

        if ($request->hasFile('image')) {
            $fileName = uniqid() . '' . date('ymdhis') . '' . uniqid() . '.' . strtolower($request->image->extension());
            $request->image->move(public_path('uploads/pro-course/'), $fileName);
            $image = 'uploads/pro-course/' . $fileName;
        }
        $data->image =  $image;
        $data->save();

        return $this->responseRedirect('admin.pro-course.index', 'Pro-course has been created successfully', 'success', false, false);
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


        $teamId = $request->id;

        $team = Team::where('id', $teamId)->update([
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
        $data = ProCourse::find($id);
        return view('admin.pro-course.edit', compact('data'));
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
            'name' => 'required',
            'mentor' => 'required',
            'image' => 'mimes:img,jpeg,jpg,svg',
            'description' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $fileName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/pro-course/'), $fileName);
            $image = 'uploads/pro-course/' . $fileName;
            ProCourse::where('id', $id)->update([
                'image' => $image,
            ]);
        }


        ProCourse::where('id', $id)->update([
            'mentor' => $request->mentor,
            'name' => $request->name,
            'description' => $request->description,


        ]);
        return $this->responseRedirectBack('admin.pro-course.index', 'Pro-course has been updated successfully', 'success', false, false);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ProCourse::where('id', $id)->delete();
        return $this->responseRedirect('admin.pro-course.index', 'Pro-course has been deleted successfully', 'success', false, false);
    }
}