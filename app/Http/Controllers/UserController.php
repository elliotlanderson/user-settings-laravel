<?php

namespace App\Http\Controllers;

use App\User;
use App\User\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

/**
 * Controls the business logic for any modifications
 * or interfaces regarding the App\User model object
 *
 * Class UserController
 * @package App\Http\Controllers
 */

class UserController extends AuthController
{

    /**
     * instance of the UserRepository
     *
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * Create UserController instance
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->userRepository = new UserRepository();
    }

    /**
     * Show the settings for the user's dashboard
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $userObject = $this->userRepository;

        $profile_picture_url = url('default_user_icon.png');

        if ($userObject->hasProfilePicture())
        {
            $profile_picture_url = $userObject->getProfilePictureUrl();
        }

        return view('user.profile')->with('user', Auth::user())->with('profile_img', $profile_picture_url);
    }

    /**
     * Uploads the profile picture and persists
     * the location of storage to the database
     *
     * @param Request $request
     * @return Redirect
     */
    public function uploadProfilePicture(Request $request)
    {
        $this->userRepository->uploadAndStoreProfilePicture($request);

        return redirect()->route('user.profile');
    }

    /**
     * Shows the Activation Screen
     */
    public function activate()
    {
        return view('user.activate')->with('user', $this->getUser());
    }

    public function handleActivate(Request $request)
    {
        $user = auth()->user();
        $activation_code = $request->get('activation_code');

        if ($activation_code == $user->activation_code) {
            $user->activated = true;
            $user->save();

            return redirect()->route('dashboard.home');
        }

        return redirect()->back()->withErrors();
    }
}
