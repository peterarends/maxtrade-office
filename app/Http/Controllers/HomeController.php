<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Users as UsersResource;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        return view('index');
    }
}
