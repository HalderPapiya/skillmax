<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\InterestRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use App\Models\User;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::get();
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.add');
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
            'fName' => 'required',
            'lName' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'password' => 'required',
            'college' => 'required',
            'subject' => 'required',
        ]);

        $user = new User();
        $user->fName = $request->fName;
        $user->lName = $request->lName;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->college = $request->college;
        $user->subject = $request->subject;
        $user->save();

        // dd('done');

        return $this->responseRedirect('admin.user.index', 'User has been created successfully', 'success', false, false);
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

        $userId = $request->id;

        User::where('id', $userId)->update([
            'status' => $request->status,
        ]);

        return response()->json(array('message' => 'User status has been successfully updated'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.user.edit', compact('user'));
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


        User::where('id', $id)->update([
            'fName' => $request->fName,
            'lName' => $request->lName,
            'email' => $request->email,
            'phone' => $request->phone,
            // 'password' => $request->fName,
            'college' => $request->college,
            'subject' => $request->subject,
        ]);
        return $this->responseRedirectBack('User has been updated successfully', 'success', false, false);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::where('id', $id)->delete();
        return $this->responseRedirect('admin.user.index', 'User has been deleted successfully', 'success', false, false);
    }
}