<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\BaseController;
use App\Models\Prime;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\Input;

class PrimeController extends BaseController
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
    public function store(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'fName' => 'required',
        //     'lName' => 'required',
        //     'email' => 'required|email|unique:users',
        //     'password' => 'required',
        //     'phone' => 'required|digits:10|integer|unique:users,phone',
        //     // 'college' => 'required',
        //     // 'subject' => 'required',
        //     'gender' =>  'required',
        //     'higher_education_id' =>  'required',
        //     // 'refer_code' => 'required',
        // ]);

        // if ($validator->fails()) {
        //     return $this->sendError('Validation Error.', $validator->errors());
        // }

        // $user = User::create([
        //     'fName' => $request->fName,
        //     'lName' => $request->lName,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        //     'refer_code' => "WZI" .  random_int(100, 999),
        //     // 'address' => $address,
        //     // 'landmark' => $landmark,
        //     'phone' => $request->phone,
        //     'college' => $request->college,
        //     'subject' => $request->subject,
        //     'passing_year' => $request->passing_year,
        //     'gender' => $request->gender,
        //     'higher_education_id' => $request->higher_education_id,
        //     'used_refer_code' => $request->used_refer_code,
        //     // 'pin' => $pin,

        // ]);
        // $refCode = User::where('refer_code', $request->used_refer_code)->first();
        // $refUser = $refCode->id;
        // if ($user->used_refer_code != null) {
            $userExist = Prime::where('user_id', $request->user_id)->latest()->first();
            // $userExist = Prime::first();
            // return $userExist;
            // $userExist = Subscription::where('user_id', '=', Input::get('user_id'))->first();
            if (!isset($userExist)){
                $subscription = Prime::create([
                    'user_id' => $request->user_id,
                    'start_date' => Carbon::now()->format('Y-m-d'),
                    'end_date' => date('Y-m-d', strtotime("+30 days"))
                ]);
            } else {
                $subscription = Prime::where('id', $userExist->id)->update([
                    'user_id' => $request->user_id,
                    'start_date' => $userExist->end_date,
                    // 'end_date' => Carbon::parse($userExist->end_date)->addDays(60),
                    'end_date' => date('Y-m-d', strtotime($userExist->end_date . "+30 days"))
                ]);
            }
           
        // }
        
        if ($subscription) {
            return response()->json([
                "status" => 200,
                "subscription" =>  $subscription,
                "message" => "Subscription Success",
            ]);
        } else {
            return response()->json(['status' => 400, 'message' => 'Something happened', 'data' => 'Data update failure']);
        }
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|digits:10|integer|exists:users',
            'password' => 'required|string',
        ]);
        // $request->validate([
        //     'phone' => 'required|digits:10|integer|exists:users',
        //     'password' => 'required|string|exists:users',
        // ]);

        if ($validator->fails()) {
            return response()->json(['status' => 400, 'message' => 'Something happened', 'data' => $validator->errors()->first()]);
        }
        $user = User::where('phone', $request->phone)->first();
        if ((Hash::check(request('password'), $user->password)) == false) {
            return response()->json([
                "status" => 400,
                // "data" => array(),
                "message" => "Password miss match."
            ]);
        }

        if (Auth::attempt(['phone' => $request->phone, 'password' => $request->password])) {
            $user = Auth::user();
            $success['name'] =  $user->name;
            return response()->json([
                "data" => $user,
                "status" => 200,
                "message" => "Login Succesfully",
            ]);
        }
        // return response()->json([
        //     "status" => 400,
        //     "message" => "Unauthorised",
        // ]);
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
    public function showReferCode($id)
    {
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
            'phone' => 'nullable|digits:10|integer'
        ]);

        // validation check
        if ($validator->fails()) {
            return response()->json(['status' => 400, 'message' => 'Something happened', 'data' => $validator->errors()->first()]);
        } else {
            // error handling
            try {

                if ($request->hasFile('resume')) {
                    $fileName = time() . '.' . $request->resume->extension();
                    $request->resume->move(public_path('uploads/user/'), $fileName);
                    $resume = 'uploads/user/' . $fileName;
                    // User::where('id', $request->id)->update([
                    //     'resume' => $resume,
                    // ]);
                }

                if ($request->hasFile('image')) {
                    $fileName = time() . '.' . $request->image->extension();
                    $request->image->move(public_path('uploads/user/'), $fileName);
                    $image = 'uploads/user/' . $fileName;
                    // User::where('id', $request->id)->update([
                    //     'resume' => $resume,
                    // ]);
                }

                $data = User::where('id', $request->id)->update([
                    'id' => $request->id,
                    'fName' => $request->fName,
                    'lName' => $request->lName,
                    'email' => $request->email,
                    'phone' =>  $request->phone,
                    'college' => $request->college,
                    'subject' => $request->subject,
                    'passing_year' => $request->passing_year,
                    // '$refer_code' => "WZI" .  Str::random(9),
                    'country_code_id' => $request->country_code_id,
                    'dob' => $request->dob,
                    'type' => $request->type,
                    'industry_id' => $request->industry_id,
                    'city' => $request->city,
                    'country' => $request->country,
                    'prime_status' => $request->prime_status,
                    'expire_date' => $request->expire_date,
                    'certificate' => $request->certificate,
                    'subscribe_to_newsletter' => $request->subscribe_to_newsletter,
                    'study_abroad' => $request->study_abroad,
                    'agree_term_condition' => $request->agree_term_condition,
                    'resume' => $resume,
                    'image' => $image,
                    // 'passing_year' => $request->passing_year,

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

        // Password::sendResetLink($request->only('email'));

        // return response()->json(["msg" => 'Reset password link sent on your email id.', 'request' => $request->only('email')]);

        $input = $request->all();
        $rules = array(
            'email' => "required|email",
        );
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            $arr = array("status" => 400, "message" => $validator->errors()->first(), "data" => array());
        } else {
            try {
                $response = Password::sendResetLink($request->only('email'), function (Message $message) {
                    $message->subject($this->getEmailSubject());
                });
                switch ($response) {
                    case Password::RESET_LINK_SENT:
                        return \Response::json(array("status" => 200, "message" => trans($response), "data" => array()));
                    case Password::INVALID_USER:
                        return \Response::json(array("status" => 400, "message" => trans($response), "data" => array()));
                }
            } catch (\Swift_TransportException $ex) {
                $arr = array("status" => 400, "message" => $ex->getMessage(), "data" => []);
            } catch (Exception $ex) {
                $arr = array("status" => 400, "message" => $ex->getMessage(), "data" => []);
            }
        }
        return \Response::json($arr);
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