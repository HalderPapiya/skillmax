<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Models\Event;
use Illuminate\Support\Facades\Validator;

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

        $data = [];
        foreach ($events as $eventKey => $eventValue) {
            $data[] = [
                'title' => $eventValue->title,
                'start_date' => $eventValue->start_date,
                'pretty_start_date' => date('jS F, Y', strtotime($eventValue->start_date)),
                'end_date' => $eventValue->end_date,
                'pretty_end_date' => date('jS F, Y', strtotime($eventValue->end_date)),
                'image' => $eventValue->image,
                'description' => $eventValue->description,
                'email' => $eventValue->email,
                'phone' => $eventValue->phone,
                'website' => $eventValue->website,
                'address' => $eventValue->address,
                'price' => $eventValue->price,
                'registration_link' => $eventValue->registration_link,
                'deleted_at' => $eventValue->deleted_at,
                'status' => $eventValue->status,
                'created_at' => $eventValue->created_at,
                'updated_at' => $eventValue->title,
            ];
        }



        return response()->json([
            "status" => 200,
            "data" => $data,
            "message" => "Event Comment List",
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Event::where('id', $id)->get();

        return response()->json([
            "status" => 200,
            "data" => $data,
            "message" => "Event Details",
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}