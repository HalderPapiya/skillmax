<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Announcement;
use App\Http\Controllers\BaseController;

class AnnouncementController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $announcements = Announcement::get();
        return view('admin.announcement.index', compact('announcements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.announcement.add');
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
            'title' => 'required',
            'description' => 'required',
        ]);

        $announcement = new Announcement;
        $announcement->title = $request->title;
        $announcement->description = $request->description;
        $announcement->save();
        return $this->responseRedirect('admin.announcement.index', 'Announcement has been created successfully', 'success', false, false);
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
        $announcementId = $request->id;

        Announcement::where('id', $announcementId)->update([
            'status' => $request->status,
        ]);

        return response()->json(array('message' => 'Announcement status has been successfully updated'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $targetAnnouncement = Announcement::find($id);
        return view('admin.announcement.edit', compact('targetAnnouncement'));
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
            'description' => 'required',
        ]);


        Announcement::where('id', $id)->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return $this->responseRedirectBack('Announcement has been updated successfully', 'success', false, false);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Announcement::where('id', $id)->delete();

        return $this->responseRedirect('admin.announcement.index', 'updateAnnouncementhas been deleted successfully', 'success', false, false);
    }
}