<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Http\Controllers\BaseController;

class ProCourseController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $teams = Team::where('userId', $id)->get();
        return response()->json([
            "status" => 200,
            "data" => $teams,
            "message" => "Team List",
        ]);
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
            // 'premium_id' => 'required',
            'name' => 'required',
            'mentor' => 'required',
            'image' => 'required|mimes:img,jpeg,jpg,svg',
            'description' => 'required',
        ]);

        $data = new Team();
        // $team->premium_id = $request->premium_id;
        $data->mentor = $request->mentor;
        $data->name = $request->name;
        $data->description = $request->description;

        if ($request->hasFile('image')) {
            $fileName = uniqid() . '' . date('ymdhis') . '' . uniqid() . '.' . strtolower($request->image->extension());
            $request->image->move(public_path('uploads/banner/'), $fileName);
            $image = 'uploads/banner/' . $fileName;
        }
        $data->image =  $image;
        $data->save();

        return response()->json([
            "status" => 200,
            "data" => $data,
            "message" => "Pro-course Created",
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
        $team = Team::find($id);
        return view('admin.team.edit', compact('team'));
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
            'userId' => 'required',
            'name' => 'required',
            'email' => 'required|unique:teams',
            'phone' => 'required|digits:10|integer|unique:teams',
        ]);

        // dd($request->all());
        $team = Team::find($id);

        $team->update([
            'userId' => $request->userId,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone
        ]);
        return response()->json([
            "status" => 200,
            "data" => $team,
            "message" => "Team Update Successfull",
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
        Team::where('id', $id)->delete();

        return response()->json([
            "status" => 200,
            "message" => "Team Delete Successfull",
        ]);
    }
}