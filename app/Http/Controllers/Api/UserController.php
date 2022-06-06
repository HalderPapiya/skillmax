<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\BaseController;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\Input;

class UserController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    // public function registerApi(Request $request)
    // {
    //     return response()->json(["status" => 200]);
    // }

    /**
     * Register a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fName' => 'required',
            'lName' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'phone' => 'required|digits:10|integer|unique:users,phone',
            'college' => 'required',
            'subject' => 'required',
            // 'refer_code' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
     
        $user = User::create([
            'fName' => $request->fName,
            'lName' => $request->lName,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'refer_code' => "WZI" .  random_int(100, 999),
            // 'address' => $address,
            // 'landmark' => $landmark,
            'phone' => $request->phone,
            'college' => $request->college,
            'subject' => $request->subject,
            'passing_year' => $request->passing_year,
            'used_refer_code' => $request->used_refer_code,
            // 'pin' => $pin,
            
        ]);
        if($user->used_refer_code != null){
            $userExist = Subscription::where('user_id',$request->user_id)->latest()->first();
            // return $userExist;
            // $userExist = Subscription::where('user_id', '=', Input::get('user_id'))->first();
            if (!count([$userExist])) {
                $subscription= Subscription::create([
                    'user_id' => $request->user_id,
                    'start_date' => $userExist->end_date,
                    // 'end_date' => Carbon::parse($userExist->end_date)->addDays(60),
                    'end_date' => date('Y-m-d', strtotime($userExist->end_date."+60 days"))
                ]);
             }else{
                $subscription= Subscription::create([
                    'user_id' => $request->user_id,
                    'start_date' => Carbon::now()->format('Y-m-d'),
                    'end_date' => date('Y-m-d', strtotime("+60 days"))
                ]);
             }
             return response()->json([
                "status" => 200,
                "subscription" =>  [$user,$subscription],
                "message" => "Registration Success",
            ]);
        }
        // $user= User::where('used_refer_code')
        
            // return response()->json([
            //     "status" => 200,
            //     "data" => $user,
            //     "message" => "Registration Success",
            // ]); 

            // if($user && $subscription){
            //     return response()->json([
            //         "status" => 200,
            //         "subscription" => [$user,$subscription],
            //         "message" => "Registration Success",
            //     ]); 
            // }elseIf
            if($user){
                return response()->json([
                    "status" => 200,
                    "subscription" =>  [$user],
                    "message" => "Registration Success",
                ]);
            }else{
                return response()->json(['status' => 400, 'message' => 'Something happened', 'data' => 'Data update failure']);
            }
        
       
        
    }

    public function login(Request $request)
    {
        $request->validate([
            'phone' => 'required|digits:10|integer',
            'password' => 'required|string',
        ]);

        if (Auth::attempt(['phone' => $request->phone, 'password' => $request->password])) {
            $user = Auth::user();
            $success['name'] =  $user->name;
            return response()->json([
                "data" => $user,
                "status" => 200,
                "message" => "Login Succesfully",
            ]);
        }
        return response()->json([
            "status" => 400,
            "message" => "Unauthorised",
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
        $user = User::find($id);

        if (is_null($user)) {
            return $this->sendError('User not found.');
        }

        return response()->json([
            "data" => $user,
            "status" => 200,
            "message" => "User Details",
        ]);
    }

     /**
     * Show the form for refer code.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showReferCode($id){
        $data = User::where('id', $id)->first('refer_code');
        
        
        if (is_null($data)) {
            return $this->sendError('User refer-code not found.');
        }

        return response()->json([
            "data" => $data,
            "status" => 200,
            "message" => "User Refer-Code",
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
    public function update(Request $request)
    {
        // validate response
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            // 'fName' => 'required',
            // 'lName' => 'required',
            // 'lName' => 'required',
            'phone' => 'nullable|digits:10|integer|unique:users,phone'
        ]);

        // validation check
        if ($validator->fails()) {
            return response()->json(['status' => 400, 'message' => 'Something happened', 'data' => $validator->errors()->first()]);
        } else {
            // error handling
            try {
                $data = User::where('id', $request->id)->update([
                    'id' => $request->id,
                    'fName' => $request->fName,
                    'lName' => $request->lName,
                    'email' => $request->email,
                    'phone' =>  $request->phone,
                    'college' => $request->college,
                    'subject' => $request->subject,
                    'passing_year' => $request->passing_year,
                    '$refer_code' => "WZI" .  Str::random(9),
                ]);

                if ($data) {
                    return response()->json(['status' => 200, 'message' => 'Profile updated successfully', 'data' => $request->all()]);
                } else {
                    return response()->json(['status' => 400, 'message' => 'Something happened', 'data' => 'Data update failure']);
                }
            } catch (\Throwable $error) {
                return response()->json(['status' => 400, 'message' => 'Something happened', 'data' => $error]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function changePassword(Request $request)
    {
        $input = $request->all();

        $user = User::where('id', $request->id)->first();


        $validator = Validator::make(
            $request->all(),
            [
                'old_password' => 'required',
                'new_password' => 'required|min:6',
                'confirm_password' => 'required|same:new_password',
            ]
        );

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        } else {
            try {
                if ((Hash::check(request('old_password'), $user->password)) == false) {
                    return response()->json([
                        "status" => 400,
                        "data" => array(),
                        "message" => "Please enter right password."
                    ]);
                } else if ((Hash::check(request('new_password'), $user->password)) == true) {
                    return response()->json([
                        "status" => 400,
                        "data" => array(),
                        "message" => "Please enter a password which is not similar then current password."
                    ]);
                } else {
                    User::where('id', $user->id)->update(['password' => Hash::make($input['new_password'])]);
                    return response()->json([
                        "status" => 200,
                        "data" => array(),
                        "message" => "Password updated successfully."
                    ]);
                }
            } catch (\Exception $ex) {
                if (isset($ex->errorInfo[2])) {
                    $msg = $ex->errorInfo[2];
                } else {
                    $msg = $ex->getMessage();
                }
                return response()->json([
                    "status" => 400,
                    "data" => array(),
                    "message" => $msg
                ]);
            }
        }
        // return Response::json($arr);
    }
    // forget password
    public function forgot(Request $request)
    {
        // $credentials = request()->validate(['phone' => 'required|digits:10|integer']);

        Password::sendResetLink($request->only('email'));

        return response()->json(["msg" => 'Reset password link sent on your email id.', 'request' => $request->only('email')]);
    }

    public function socialLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $userEmail = User::where('email', $request->email)->first();
        if ($userEmail) {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $user = Auth::user();
                $success['name'] =  $user->name;
                return response()->json([
                    "status" => 200,
                    "message" => "Login Successfully",
                ]);
            }
        } else {

            $fName = $request->fName;
            $lName = $request->lName;
            $email    = $request->email;
            $password = $request->password;

            $user     = User::create([
                'fName' => $fName,
                'lName' => $lName,
                'email' => $email,
                'password' => Hash::make($password),
            ]);

            if (Auth::attempt(['email' => $email, 'password' => $password, 'fName' => $fName,  'lName' => $lName,])) {
                $user = Auth::user();
                $success['name'] =  $user->name;
                return response()->json([
                    "status" => 200,
                    "message" => "Login Succesfully",
                ]);
            }
        }

        return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
    }
}