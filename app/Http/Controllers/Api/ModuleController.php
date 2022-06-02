<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Http\Controllers\BaseController;
use App\Models\Module;
use App\Models\ProCourse;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use Carbon\Carbon;

class ModuleController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $moduleData = Module::with('topics')->with('quiz')->where('course_id', $id)->get();
        // $quizData = QuizQuestion::where('module_id', $id)->get();
        // foreach ($quizData as $key => $quizValue){
        //     $quizValue[]=[
        //     'quizQuestion' => count($quizValue->quizQuestion),
        //     ];
        // }
        // return $quizData;
        
        // $moduleData = Module::with('proCourse')->get();
        if ($moduleData) {
            // $resp = [];
            foreach ($moduleData as $moduleKey => $moduleValue) {
                // $moduleValue->topics[]=[
                //     'id' => $moduleValue->id,
                //     // 'type' => ($key == 0)?'free' : 'prime',
                //     'module_id' => $moduleValue->module_id,
                //     'title' => $moduleValue->title,
                //     'description' => $moduleValue->description,
                //     'image' => env('APP_URL') . '/' . asset($moduleValue->image),
                //     'created_at' => Carbon::parse($moduleValue->created_at)->format('Y-m-d'),
                //     'updated_at' => Carbon::parse($moduleValue->updated_at)->format('Y-m-d'), 
                // ];
                // $question =Quiz::with('quizQuestion')->where('module_id', $moduleValue->id)->get();
                $resp[] = [
                    'id' => $moduleValue->id,
                    'type' => ($moduleKey == 0) ? 'free' : 'prime',
                    'course_id' => $moduleValue->course_id,
                    'name' => $moduleValue->name,
                    'icon' => asset($moduleValue->icon),
                    'path' => asset($moduleValue->path),
                    'created_at' => Carbon::parse($moduleValue->created_at)->format('Y-m-d'),
                    'updated_at' => Carbon::parse($moduleValue->updated_at)->format('Y-m-d'),
                    'topic' => $moduleValue->topics,
                    'Quiz' => $moduleValue->quiz,
                    // 'Quiz_questions' => $moduleValue->quiz,
                    // 'Quiz_questions' => count($question->quizQuestion)
                    // 'Quiz_questions' =>  
                ];
            }
            return response()->json([
                "message" => "Module List",
                "status" => 200,
                "data" => $resp,
            ]);
        } else {
            return response()->json([
                "status" => 400,
                'message' => 'Something happened'
            ]);
        }
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
            "message" => "Pro-course Created",

            "data" => $data,
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
        $data = Module::where('id', $id)->where('status', '=', 1)->get();
        // $data=
        if ($data) {
            return response()->json([
                "status" => 200,
                "message" => "Module Details",
                // "data" =>   $data[$dataValue->id,],

            ]);
        } else {
            return response()->json([
                "status" => 400,
                'message' => 'Something happened'
            ]);
        }
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
            "message" => "Team Update Successful",
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
            "message" => "Team Delete Successful",
        ]);
    }
}