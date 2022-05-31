<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Http\Controllers\BaseController;
use App\Models\User;

class TeamController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teams = Team::get();
        return view('admin.team.index', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::get();
        return view('admin.team.add', compact('users'));
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
            'userId' => 'required',
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required|digits:10|integer',
        ]);

        $team = new Team();
        $team->userId = $request->userId;
        $team->name = $request->name;
        $team->email = $request->email;
        $team->phone = $request->phone;
        $team->save();

        // dd('done');

        return $this->responseRedirect('admin.team.index', 'team has been created successfully', 'success', false, false);
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

        Team::where('id', $teamId)->update([
            'status' => $request->status,
        ]);

        return response()->json(array('message' => 'Team status has been successfully updated'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::get();
        $team = Team::find($id);
        return view('admin.team.edit', compact('team', 'users'));
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
            'email' => 'required',
            'phone' => 'required|digits:10|integer',
        ]);

        // dd($request->all());


        Team::where('id', $id)->update([
            'userId' => $request->userId,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone
        ]);
        return $this->responseRedirectBack('Team has been updated successfully', 'success', false, false);
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
        return $this->responseRedirect('admin.team.index', 'Team has been deleted successfully', 'success', false, false);
    }
}