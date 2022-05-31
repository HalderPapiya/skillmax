<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Models\Interest;

class InterestController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Interest::get();

        return response()->json([
            "status" => 200,
            "data" => $data,
            "message" => "User Interest List",
        ]);
    }
}