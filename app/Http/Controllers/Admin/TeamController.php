<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\InterestRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use App\Models\Team;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Hash;

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
        return view('admin.team.add');
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
            'email' => 'required',
            'phone' => 'required',
            'password' => 'required',
            'college' => 'required',
            'subject' => 'required',
        ]);

        $team = new Team();
        $team->fName = $request->fName;
        $team->lName = $request->lName;
        $team->email = $request->email;
        $team->phone = $request->phone;
        $team->password = Hash::make($request->password);
        $team->college = $request->college;
        $team->subject = $request->subject;
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
            'fName' => 'required',
            'lName' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'college' => 'required',
            'subject' => 'required',
        ]);

        // dd($request->all());


        Team::where('id', $id)->update([
            'fName' => $request->fName,
            'lName' => $request->lName,
            'email' => $request->email,
            'phone' => $request->phone,
            // 'password' => $request->fName,
            'college' => $request->college,
            'subject' => $request->subject,
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