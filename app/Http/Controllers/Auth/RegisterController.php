<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use App\Property;
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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
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
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        Property::create([
            'name' => 'theme',
            'value' => 'dark',
            'description' => 'Choose theme',
            'help' => 'Change program theme',
            'category' => 'visual',
            'user_id' => $user->id
        ]);
        Property::create([
            'name' => 'projectfilter',
            'value' => 'act',
            'description' => 'Change project filter',
            'help' => 'Select a default project filter between, Show All, Show Active, Show Ended',
            'category' => 'other',
            'user_id' => $user->id
        ]);
        Property::create([
            'name' => 'taskfilter',
            'value' => 'all',
            'description' => 'Change task filter',
            'help' => 'Select a default task filter between, Show All, Show Active, Show Ended',
            'category' => 'other',
            'user_id' => $user->id
        ]);
        Property::create([
            'name' => 'language',
            'value' => 'en_US',
            'description' => 'Choose language',
            'help' => 'Choose the language in which the program will work',
            'category' => 'other',
            'user_id' => $user->id
        ]);

        return $user;
    }
}