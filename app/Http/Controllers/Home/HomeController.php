<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the home page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('pages.home.index');
    }

    /**
     * Display the dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        return view('home.dashboard');
    }
}
