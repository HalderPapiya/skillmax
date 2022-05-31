<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Interest;
use App\Http\Controllers\BaseController;

class InterestController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $interests = Interest::get();
        return view('admin.interest.index', compact('interests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.interest.add');
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
            'name' => 'required|max:200',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg',
            'description' => 'required',
        ]);

        $interest = new Interest();
        $interest->name = $request->name;
        $interest->description = $request->description;
        if ($request->hasFile('image')) {
            $fileName = uniqid() . '' . date('ymdhis') . '' . uniqid() . '.' . strtolower($request->image->extension());
            $request->image->move(public_path('uploads/interest/'), $fileName);
            $image = 'uploads/interest/' . $fileName;
        }
        $interest->image =  $image;
        $interest->save();

        // dd('done');

        return $this->responseRedirect('admin.interest.index', 'Interest has been created successfully', 'success', false, false);
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

        $interestId = $request->id;

        Interest::where('id', $interestId)->update([
            'status' => $request->status,
        ]);

        return response()->json(array('message' => 'Interest status has been successfully updated'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $targetInterest = Interest::find($id);
        return view('admin.interest.edit', compact('targetInterest'));
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
            'name' => 'required|max:191',
            'image' => 'mimes:jpeg,png,jpg,gif,svg',
            'description' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $fileName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/interest/'), $fileName);
            $image = 'uploads/interest/' . $fileName;
            Interest::where('id', $id)->update([
                'image' => $image,
            ]);
        }


        Interest::where('id', $id)->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        return $this->responseRedirectBack('Interest has been updated successfully', 'success', false, false);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Interest::where('id', $id)->delete();
        return $this->responseRedirect('admin.interest.index', 'Interest has been deleted successfully', 'success', false, false);
    }
}