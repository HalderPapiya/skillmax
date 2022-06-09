<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Models\Course;
use App\Models\Module;
use App\Models\Quiz;
use Facade\FlareClient\Stacktrace\File;

class QuizController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $data = Quiz::get();
        return view('admin.quiz.index', compact('data'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $modules = Module::get();
        $courses = Course::get();
        return view('admin.quiz.add', compact('modules', 'courses'));
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
            'module_id' => 'required|unique:quizzes,module_id',
        ]);

        $data = new Quiz;
        $data->module_id = $request->module_id;
        $data->course_id = $request->course_id;
        $data->save();

        return $this->responseRedirect('admin.module-quiz.index', 'Quiz has been created successfully', 'success', false, false);
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $modules = Module::get();
        $courses = Course::get();
        
        $data = Quiz::find($id);
        return view('admin.quiz.edit', compact('data', 'modules', 'courses'));
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
            'module_id' => 'required|unique:quizzes,module_id',
        ]);

        Quiz::where('id', $id)->update([
            'module_id' => $request->module_id,
            'course_id' => $request->course_id,
        ]);
        return $this->responseRedirect('admin.module-quiz.index', 'Quiz has been updated successfully', 'success', false, false);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Quiz::where('id', $id)->delete();
        return $this->responseRedirect('admin.module-quiz.index', 'Quiz has been deleted successfully', 'success', false, false);
    }

    public function manage(Request $request)
    {
        $courseId = $request->val;
        // dd($categoryid);
        $modules = Module::where('course_id', $courseId)->get();
        return response()->json(['sub' => $modules]);
    }
}