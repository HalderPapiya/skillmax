<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Http\Controllers\BaseController;
use App\Models\Module;
use App\Models\Quiz;

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
        // dd($request->all());
        $this->validate($request, [
            'hint_image' => 'mimes:img,jpeg,jpg,svg',
            'module_id' => 'required',
            'image' => 'mimes:img,jpeg,jpg,svg',
        ]);

        $data = new Quiz;
        // $team->premium_id = $request->premium_id;
        $data->module_id = $request->module_id;
        $data->question = $request->question;
        $data->hint = $request->hint;

        if ($request->hasFile('image')) {
            $fileName = uniqid() . '' . date('ymdhis') . '' . uniqid() . '.' . strtolower($request->image->extension());
            $request->image->move(public_path('uploads/quiz/'), $fileName);
            $path = env('APP_URL') . '/'  . 'uploads/quiz/' . $fileName;
            $questionImage = 'uploads/quiz/' . $fileName;
           
        }
        if ($request->hasFile('hint_image')) {
            $fileName = uniqid() . '' . date('ymdhis') . '' . uniqid() . '.' . strtolower($request->hint_image->extension());
            $request->hint_image->move(public_path('uploads/quiz/'), $fileName);
            $hintPath = env('APP_URL') . '/'  . 'uploads/quiz/' . $fileName;
            $hintImage = 'uploads/quiz/' . $fileName;
            
        }
        if($request->hasFile('image')){

            $data->image =  $questionImage;
            $data->path =  $path;
        }
        if($request->hasFile('hint_image')){

            $data->hint_image =  $hintImage;
            $data->hint_image_path =  $hintPath;
        }
        $data->save();

        return $this->responseRedirect('admin.quiz.index', 'Quiz has been created successfully', 'success', false, false);
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
    // public function edit($id)
    // {
    //     $users = Quiz::get();
    //     $team = Team::find($id);
    //     return view('admin.team.edit', compact('team', 'users'));
    // }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus(Request $request)
    {


        $teamId = $request->id;

        $team = Quiz::where('id', $teamId)->update([
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
        $modules = Module::get();

        $data = Quiz::find($id);
        return view('admin.quiz.edit', compact('data', 'modules'));
    }
    protected function deleteOldQuestionImage($id)
    {
        $modules = Module::get();
        // $data = Quiz::find($id);
        Quiz::where('id', $id)->delete('image');
    //   if (auth()->user()->image){
    //     if($data){
    //         @unlink( public_path('uploads/quiz/').$data->image);
    //         return view('admin.quiz.edit', compact('data', 'modules'));
    //   }
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
            'hint_image' => 'mimes:img,jpeg,jpg,svg',
            'module_id' => 'required',
            'image' => 'mimes:img,jpeg,jpg,svg',
        ]);

        if ($request->hasFile('image')) {
            $fileName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/quiz/'), $fileName);
            $image = 'uploads/quiz/' . $fileName;
            $path = env('APP_URL') . '/'  . 'uploads/quiz/' . $fileName;
            Quiz::where('id', $id)->update([
                'image' => $image,
                'path' => $path,
            ]);
        }

        if ($request->hasFile('hint_image')) {
            $fileName = time() . '.' . $request->image->extension();
            $request->hint_image->move(public_path('uploads/quiz/'), $fileName);
            $hintImage = 'uploads/quiz/' . $fileName;
            $hintImagePath = env('APP_URL') . '/'  . 'uploads/quiz/' . $fileName;
            Quiz::where('id', $id)->update([
                'hint_image' => $hintImage,
                'hint_image_path' => $hintImagePath,
            ]);
        }


        Quiz::where('id', $id)->update([
            'question' => $request->question,
            'hint' => $request->hint,
            'module_id' => $request->module_id,



        ]);
        return $this->responseRedirect('admin.quiz.index', 'Quiz has been updated successfully', 'success', false, false);
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
        return $this->responseRedirect('admin.quiz.index', 'Quiz has been deleted successfully', 'success', false, false);
    }
}