<?php

namespace App\Http\Controllers;

use App\User\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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


        return view('home')->with('user', Auth::user());
    }
}
