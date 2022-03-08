<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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

    public function registerApi(Request $request)
    {
        return response()->json(["status" => 200]);
    }

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
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }


        $fName = $request->fName;
        $lName = $request->lName;
        $email    = $request->email;
        // $mobile    = $request->mobile;
        $password = $request->password;
        // $address = $request->address;
        // $landmark = $request->landmark;
        // $city = $request->city;
        // $pin = $request->pin;
        $user     = User::create([
            'fName' => $fName,
            'lName' => $lName,
            'email' => $email,
            'password' => Hash::make($password),
            // 'address' => $address,
            // 'landmark' => $landmark,
            // 'mobile' => $mobile,
            // 'city' => $city,
            // 'pin' => $pin,

        ]);
        return response()->json([
            "status" => 200,
            "data" => $user,
            "message" => "Registration Succes",
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $success['name'] =  $user->name;
            return response()->json([
                "status" => 200,
                "message" => "Login Succesfully",
            ]);
        }
        return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
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
            return $this->sendError('Product not found.');
        }

        return response()->json([
            "data" => $user,
            "status" => 200,
            "message" => "User Details",
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
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'fName' => 'required',
            'lName' => 'required',
            // 'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $user = User::where('id', $request->id)->update([
            'fName' => $request->fName,
            'lName' => $request->lName,
            // 'email' => $request->email,
            'address' => $request->address,
            'landmark' => $request->landmark,
            'city' => $request->city,
            'pin' => $request->pin,
            'mobile' => $request->mobile,
            'lName' => $request->lName,
            'lName' => $request->lName,
            'lName' => $request->lName,
        ]);

        return response()->json([
            "status" => 200,
            "data" => $user,
            "message" => "Profile Edit Succesfull",
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
                        "message" => "Please enter a password which is not similar then current password."
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
                    "message" => "Login Succesfully",
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