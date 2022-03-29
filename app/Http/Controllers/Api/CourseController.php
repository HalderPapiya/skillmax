<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Models\Course;
use Illuminate\Support\Facades\Validator;

class CourseController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Course::get();

        return response()->json([
            "status" => 200,
            "data" => $data,
            "message" => "Course List",
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
        $course = Course::with('coursePricingPlan', 'courseMentor')->where('id', $id)->first();

        $pricingPlans = $course->coursePricingPlan;
        $pricingData = [];
        foreach ($pricingPlans as $pricingPlan) {
            $pricingData[] = [
                'name' => $pricingPlan->pricingDetails->name,
                'short_description' => $pricingPlan->pricingDetails->short_description,
            ];
        }

        $mentors = $course->courseMentor;
        $mentorData = [];
        foreach ($mentors as $mentor) {
            $mentorData[] = [
                'name' => $mentor->name,
            ];
        }

        $data = [
            'id' => $course->id,
            'name' => $course->name,
            'start_date' => $course->start_date,
            'pretty_start_date' => date('jS F, Y', strtotime($course->start_date)),
            'image' => $course->image,
            'description' => $course->description,
            'pricing_plan' => $pricingData,
            'mentor' => $mentorData,

        ];


        return response()->json([
            "status" => 200,
            "data" => $data,
            "message" => "Course Details",
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