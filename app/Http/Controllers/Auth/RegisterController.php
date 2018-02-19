<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\TwilioHelper;
use App\User\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Instance of Twilio Helper
     *
     * @var TwilioHelper
     */
    protected $twilioHelper;


    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');

        $this->twilioHelper = new TwilioHelper();
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:40|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'email' => 'required|string|max:255|unique:users'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'phone_number' => $data['phone_number'],
            'password' => Hash::make($data['password']),
            'email' => $data['email'],
            'activation_code' => rand(1000000,9999999)
        ]);
    }

    public function registered(Request $request, $user)
    {
        $message = 'Thanks for signing up!  Your activation code is: ' . $user->activation_code;

        $phoneNumber = '+1' . preg_replace('/[^0-9]/', '', $user->phone_number);

        $this->twilioHelper->send($phoneNumber, $message);
    }
}
