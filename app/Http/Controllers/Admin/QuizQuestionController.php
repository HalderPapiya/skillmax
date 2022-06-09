<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Http\Controllers\BaseController;
use App\Models\Module;
use App\Models\Quiz;
use App\Models\QuizAnswer;
use App\Models\QuizQuestion;
use Facade\FlareClient\Stacktrace\File;

class QuizQuestionController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index($id)
    {
        $quizzes = Quiz::where('id', $id)->first();
        $data = QuizQuestion::where('quiz_id',$quizzes->id)->get();
        return view('admin.quiz-question.index', compact('data','quizzes'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $quizzes = Quiz::where('id', $id)->first();
        // $quizOptions = QuizAnswer::get();
        // $modules = Module::get();
        return view('admin.quiz-question.add', compact('quizzes'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request )
    {
        // $data = QuizQuestion::where('quiz_id', $id);
        // $quizzes = Quiz::where('id', $id)->first();
        // $quizId = $quizzes->id;
        // dd($request->all());
        $this->validate($request, [
            'hint_image' => 'mimes:img,jpeg,jpg,svg',
            'quiz_id' => 'required',
            // 'module_id' => 'required',
            // 'position' => 'digit:10',
            'image' => 'mimes:img,jpeg,jpg,svg',
            'hint_image' => 'mimes:img,jpeg,jpg,svg',
            'answer_image' => 'mimes:img,jpeg,jpg,svg',
        ]);



        $data = new QuizQuestion;
        // $team->premium_id = $request->premium_id;
        // $data->module_id = $request->module_id;
        $data->quiz_id = $request->quiz_id;
        $data->question = $request->question;
        $data->hint = $request->hint;
        $data->answer = $request->answer;
        $data->position = $request->position;

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

        if ($request->hasFile('answer_image')) {
            $fileName = uniqid() . '' . date('ymdhis') . '' . uniqid() . '.' . strtolower($request->answer_image->extension());
            $request->answer_image->move(public_path('uploads/quiz_answer/'), $fileName);
            $answerPath = env('APP_URL') . '/'  . 'uploads/quiz_answer/' . $fileName;
            $answerImage = 'uploads/quiz_answer/' . $fileName;
        }
        if ($request->hasFile('image')) {

            $data->image =  $questionImage;
            $data->path =  $path;
            // $data->question = $path;
        }
        if ($request->hasFile('hint_image')) {

            $data->hint_image =  $hintImage;
            $data->hint_image_path =  $hintPath;
            $data->hint = $hintPath;
        }
        if ($request->hasFile('answer_image')) {

            $data->answer_image =  $answerImage;
            $data->answer_image_path =  $answerPath;
            // $data->answer = $answerPath;
        }
        $data->save();
        $images = $request->addMore;
    //    dd($images);
        
        // for ($i=0; $i < count($images); $i++) { 
            
    //    if($request->file('option_answer_image'));
       
           
        
     // Handle multiple file upload
    //  $images = $request->file('option_answer_image');
    //  $images = $request->option_answer;
     foreach($images as $key => $image) {
         
         if ($request->hasFile('option_answer_image')) {
             // store image to directory.
             $fileName = uniqid() . '' . date('ymdhis') . '' . uniqid() . '.' . strtolower($request->option_answer_image[$key]->extension());
             $request->option_answer_image[$key]->move(public_path('uploads/quiz_answer/'), $fileName);
             $path = env('APP_URL') . '/'  . 'uploads/quiz_answer/' . $fileName;
             $answerImage = 'uploads/quiz_answer/' . $fileName;
  
            $dataAns = new QuizAnswer();
            $dataAns->question_id = $data->id;
            // $dataAns->is_right = json_encode($request->is_right[$key]);
            $dataAns->answer =json_encode($request->option_answer[$key]);
            $dataAns->answer_image = json_encode($answerImage);
                // $dataAns->answer_image_path = $path;
            //  dd($dataAns);
                
            $dataAns->save();
         }else{
            $dataAns = new QuizAnswer();
            $dataAns->question_id = $data->id;
            $dataAns->answer =json_encode($request->option_answer[$key]);
            // $dataAns->is_right = json_encode($request->is_right[$key]);
            // $dataAns->answer_image_path = $path;
            $dataAns->save();
         }

        }
        // foreach ($request->option_answer_image as $key => $value) {
        //     // if ($request->hasFile('image')) {
        //     $fileName = uniqid() . '' . date('ymdhis') . '' . uniqid() . '.' . strtolower($value->extension());
        //     $value->move(public_path('uploads/quiz/'), $fileName);
        //     $ansImage = 'uploads/quiz/' . $fileName;
        //     $path = env('APP_URL') . '/'  . 'uploads/quiz/' . $fileName;
        //     $delimeter = '';
        //     if ((count($request->option_answer_image) - 1) > $key) {
        //         $delimeter = ',';
        //     }

        //     $dataAns->answer_image .=  $ansImage . $delimeter;
        //     $dataAns->answer_image_path .=  $path . $delimeter;
        //     // }
        //     // echo $path;
        
        // $dataAns->save();
    
        return $this->responseRedirectBack( 'Quiz has been created successfully', 'success', false, false);
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

        $team = QuizQuestion::where('id', $teamId)->update([
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
        // $quizzes = Quiz::get();
        // $modules = Module::get();
        // $quizzes = Quiz::where('id', $id)->first();
        $data = QuizQuestion::find($id);
        $dataOption = QuizAnswer::where('question_id',$data->id)->get();
        // dd($dataOption);
        // $dataOptionAns = explode(',', $dataOption->answer);
        // $dataOptionImg = explode(',', $dataOption->answer_image);
        // dd($dataOptionAns);
        return view('admin.quiz-question.edit', compact('data','dataOption'));
    }
    // protected function deleteOldQuestionImage($id)
    // {
    //     $modules = Module::get();
    //     // $data = Quiz::find($id);
    //     QuizQuestion::where('id', $id)->delete('image');
    //     //   if (auth()->user()->image){
    //     //     if($data){
    //     //         @unlink( public_path('uploads/quiz/').$data->image);
    //     //         return view('admin.quiz.edit', compact('data', 'modules'));
    //     //   }
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $quizId= QuizQuestion::where('id', $id)->first();
        $data = QuizQuestion::where('id', $id)->update([
            'question' => $request->question,
            'hint' => $request->hint,
            'answer' => $request->answer,
            'quiz_id' => $quizId->quiz_id,
            // 'module_id' => $request->module_id,
            'position' => $request->position,
        ]);
        // dd($request->all());
        $this->validate($request, [
            'answer_image' => 'mimes:img,jpeg,jpg,svg',
            'quiz_id' => 'required',
            // 'module_id' => 'required',
            // 'position' => 'digit:10',
            'image' => 'mimes:img,jpeg,jpg,svg',
            'hint_image' => 'mimes:img,jpeg,jpg,svg',
        ]);
        if ($request->hasFile('image')) {
            $fileName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/quiz/'), $fileName);
            $image = 'uploads/quiz/' . $fileName;
            $path = env('APP_URL') . '/'  . 'uploads/quiz/' . $fileName;
            QuizQuestion::where('id', $id)->update([
                'image' => $image,
                'path' => $path,
                // 'question' => $path,
            ]);
        } else {
            QuizQuestion::where('id', $id)->update([
                'image' => '',
                'path' => '',

            ]);
        }

        if ($request->hasFile('hint_image')) {
            $fileName = time() . '.' . $request->hint_image->extension();
            $request->hint_image->move(public_path('uploads/quiz/'), $fileName);
            $hintImage = 'uploads/quiz/' . $fileName;
            $hintImagePath = env('APP_URL') . '/'  . 'uploads/quiz/' . $fileName;
            QuizQuestion::where('id', $id)->update([
                'hint_image' => $hintImage,
                'hint_image_path' => $hintImagePath,
                'hint' => $hintImagePath,
            ]);
        } else {
            QuizQuestion::where('id', $id)->update([
                'hint_image' => '',
                'hint_image_path' => '',
            ]);
        }
        if ($request->hasFile('answer_image')) {
            $fileName = time() . '.' . $request->answer_image->extension();
            $request->answer_image->move(public_path('uploads/quiz_answer/'), $fileName);
            $answerImage = 'uploads/quiz_answer/' . $fileName;
            $answerImagePath = env('APP_URL') . '/'  . 'uploads/quiz_answer/' . $fileName;
            QuizQuestion::where('id', $id)->update([
                'answer_image' => $answerImage,
                'answer_image_path' => $answerImagePath,
                // 'answer' => $answerImagePath,
            ]);
        } else {
            QuizQuestion::where('id', $id)->update([
                'answer_image' => '',
                'answer_image_path' => '',
            ]);
        }
        $images = $request->addMore;
        foreach($images as $key => $image) {
         
            if ($request->hasFile('option_answer_image')) {
                // store image to directory.
                $fileName = uniqid() . '' . date('ymdhis') . '' . uniqid() . '.' . strtolower($request->option_answer_image[$key]->extension());
                $request->option_answer_image[$key]->move(public_path('uploads/quiz_answer/'), $fileName);
                $path = env('APP_URL') . '/'  . 'uploads/quiz_answer/' . $fileName;
                $answerImage = 'uploads/quiz_answer/' . $fileName;
     
                QuizAnswer::where('question_id', $data->id)->update([
            //    $dataAns = new QuizAnswer();
            //    $dataAns->question_id => $data->id,
               // $dataAns->is_right = json_encode($request->is_right[$key]);
               'answer' =>json_encode($request->option_answer[$key]),
               'answer_image' => json_encode($answerImage),
                   // $dataAns->answer_image_path = $path;
               //  dd($dataAns);
                ]);
            }else{
                QuizAnswer::where('question_id', $quizId->id)->update([
            //    $dataAns->question_id = $data->id;
                'answer' =>json_encode($request->option_answer[$key]),
               // $dataAns->is_right = json_encode($request->is_right[$key]);
               // $dataAns->answer_image_path = $path;
                ]);
            }
   
        
       
           return $this->responseRedirectBack( 'Quiz has been created successfully', 'success', false, false);
       }



        // dd($data);
        // return $this->responseRedirect('admin.quiz.index', 'Quiz has been updated successfully', 'success', false, false);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    //    dd('here');
// dd($option_answer);
      
        $data = QuizQuestion::where('id', $id)->get();
        // dd($data);
        foreach($data as $data){
        QuizAnswer::where('question_id',$data->id)->delete();
            
        }
        QuizQuestion::where('id', $id)->delete();
        
        return $this->responseRedirectBack( 'Quiz has been deleted successfully', 'success', false, false);
        // return $this->responseRedirect('admin.quiz.index', 'Quiz has been deleted successfully', 'success', false, false);
    }
}