<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Hash;
use App\Models\Module;
use App\Models\ProCourse;

class ModuleController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $data = Module::get();
        return view('admin.module.index', compact('data'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = ProCourse::get();
        // $ = ProCourse::get();
        return view('admin.module.add', compact('courses'));
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
            'course_id' => 'required',
            'icon' => 'required|mimes:img,jpeg,jpg,svg',
        ]);

        $data = new Module;
        // $team->premium_id = $request->premium_id;
        $data->course_id = $request->course_id;
        $data->name = $request->name;

        if ($request->hasFile('icon')) {
            $fileName = uniqid() . '' . date('ymdhis') . '' . uniqid() . '.' . strtolower($request->icon->extension());
            $request->icon->move(public_path( env('APP_URL') . '/' .'uploads/module/'), $fileName);
            $icon = 'uploads/module/' . $fileName;
        }
        $data->icon =  $icon;
        $data->save();

        return $this->responseRedirect('admin.module.index', 'Module has been created successfully', 'success', false, false);
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


        $moduleId = $request->id;

        $module = Module::where('id', $moduleId)->update([
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
        $courses = ProCourse::get();
        $data = Module::find($id);
        return view('admin.module.edit', compact('data','courses'));
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
            'course_id' => 'required',
            'icon' => 'mimes:img,jpeg,jpg,svg',
        ]);

        if ($request->hasFile('icon')) {
            $fileName = uniqid() . '' . date('ymdhis') . '' . uniqid() . '.' . strtolower($request->icon->extension());
            $request->icon->move(public_path( env('APP_URL') . '/' .'uploads/module/'), $fileName);
            $icon = 'uploads/module/' . $fileName;
            Module::where('id', $id)->update([
                'icon' => $icon,
            ]);
        }
        

        Module::where('id', $id)->update([
            'course_id' => $request->course_id,
            'name' => $request->name,
        ]);
        return $this->responseRedirect('admin.module.index', 'Module has been updated successfully', 'success', false, false);
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
        return $this->responseRedirect('admin.module.index', 'Module has been deleted successfully', 'success', false, false);
    }
}