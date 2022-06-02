<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
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
        return view('admin.quiz.add', compact('modules'));
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
            'module_id' => 'required',
        ]);

        $data = new Quiz;
        $data->module_id = $request->module_id;
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

        $data = Quiz::find($id);
        return view('admin.quiz.edit', compact('data', 'modules'));
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
            'module_id' => 'required',
        ]);

        Quiz::where('id', $id)->update([
            'module_id' => $request->module_id,
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
}