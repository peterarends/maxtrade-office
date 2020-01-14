<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Users as UserResource;

class UserController extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // public function __construct()
    // {
    //     $this->middleware('auth:api');
    // }

    public function logoutUser(Request $request)
    {
        Auth::logout();
        $request->session()->flush();
        return redirect('/');
    }

    public function getUsers(Request $request)
    {
        /** Get Users */
        $users = User::where('id', '!=', $request->id)->orderBy('name', 'desc')->get();

        /** Return collection of Users as resource */
        return UserResource::collection($users);
    }
}
