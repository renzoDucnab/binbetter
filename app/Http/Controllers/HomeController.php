<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Shelter;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $page =  'Dashboard';

        return view('pages.back.v_home', compact('page'));
    }
}
