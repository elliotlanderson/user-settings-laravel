<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * After the user is logged in,
 * they will be redirected from the Welcome page
 * to their dashboard.
 *
 * Class DashboardController
 * @package App\Http\Controllers
 */
class DashboardController extends Controller
{
    /**
     * Instantiate DashboardController
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function home()
    {
        return view('home');
    }
}
