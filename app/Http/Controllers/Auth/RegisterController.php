<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Admin;
use App\Address;
use App\Http\Controllers\Controller;
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
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest',['except' => 'logout']);
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
            'email' => ['required', 'email', 'max:255', 'unique:users','unique:admins'],
            'username' => ['required', 'string', 'max:255','unique:users','unique:admins'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'phone_no' => ['required', 'string', 'max:13'],
            'city' => ['required', 'string', 'max:255'],
            'barangay' => ['required', 'string', 'max:255'],
            'postal_code' => ['required', 'string', 'max:255'],
            'detailed_address' => ['required', 'string', 'max:255'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $var = $data['detailed_address'];
        $string = rtrim($var, ',');
        return User::create([
            'email' => $data['email'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'fname' => $data['fname'],
            'lname' => $data['lname'],
            'phone_no' => $data['phone_no'],
            'city' => $data['city'],
            'barangay' => $data['barangay'],
            'postal_code' => $data['postal_code'],
            'detailed_address' => $string,
        ]);


    }
}
