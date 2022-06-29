<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Http\Controllers\BaseController;

class EventController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::get();
        return view('admin.event.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.event.add');
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
            'title' => 'required|max:200',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg',
            'description' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'phone' => 'required|integer|digits:10',
            'email' => 'required',
            'website' => 'required',
            'address' => 'required',
            'price' => 'required',
            'registration_link' => 'required',
        ]);

        $event = new Event();
        $event->title = $request->title;
        $event->description = $request->description;
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
        $event->email = $request->email;
        $event->phone = $request->phone;
        $event->website = $request->website;
        $event->address = $request->address;
        $event->price = $request->price;
        $event->registration_link = $request->registration_link;
        if ($request->hasFile('image')) {
            $fileName = uniqid() . '' . date('ymdhis') . '' . uniqid() . '.' . strtolower($request->image->extension());
            $request->image->move(public_path('uploads/event/'), $fileName);
            $image = 'uploads/event/' . $fileName;
        }
        $event->image =  $image;
        $event->save();

        // dd('done');

        return $this->responseRedirect('admin.event.index', 'Event has been created successfully', 'success', false, false);
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

        $eventId = $request->id;

        Event::where('id', $eventId)->update([
            'status' => $request->status,
        ]);

        return response()->json(array('message' => 'Event status has been successfully updated'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::find($id);
        return view('admin.event.edit', compact('event'));
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
            'title' => 'required|max:200',
            'image' => 'mimes:jpeg,png,jpg,gif,svg',
            'description' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'phone' => 'required|integer|digits:10',
            'email' => 'required',
            'website' => 'required',
            'address' => 'required',
            'price' => 'required',
            'registration_link' => 'required',
        ]);

        
        if ($request->hasFile('image')) {
            $fileName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/event/'), $fileName);
            $image = 'uploads/event/' . $fileName;
            Event::where('id', $id)->update([
                'image' => $image,
            ]);
        }


        event::where('id', $id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'email' => $request->email,
            'phone' => $request->phone,
            'website' => $request->website,
            'address' => $request->address,
            'price' => $request->price,
            'registration_link' => $request->registration_link
        ]);
        return $this->responseRedirectBack('Event has been updated successfully', 'success', false, false);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Event::where('id', $id)->delete();
        return $this->responseRedirect('admin.event.index', 'Event has been deleted successfully', 'success', false, false);
    }
}