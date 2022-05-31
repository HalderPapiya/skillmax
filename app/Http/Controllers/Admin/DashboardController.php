<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Forum;
use App\Models\Interest;
use App\Models\Team;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = (object)[];
        $data->users = User::latest()->get();
        $data->interests = Interest::latest()->get();
        $data->teams = Team::latest()->get();
        $data->events = Event::latest()->get();
        $data->forums = Forum::latest()->get();

        return view('admin.dashboard', compact('data'));
    }
}