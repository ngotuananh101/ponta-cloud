<?php

namespace App\Http\Controllers\Home;

use App\Enums\CloudType;
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
        $clouds = CloudType::asArray();
        return view('pages.home.add', [
            'clouds' => $clouds,
        ]);
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
