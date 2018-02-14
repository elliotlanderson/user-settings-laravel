<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Controls the business logic for any modifications
 * or interfaces regarding the App\User model object
 *
 * Class UserController
 * @package App\Http\Controllers
 */

class UserController extends Controller
{
    /**
     * Create UserController instance
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the settings for the user's dashboard
     *
     * @return \Illuminate\Http\Response
     */
    public function settings()
    {
        return view('user.settings');
    }
}
