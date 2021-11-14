<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class UserloginController extends Controller
{
    public function login(){

    	return view ('user/user-login.index2');
    }

    public function password_reset(){

    	return view ('user/user-login.password_reset');
    }

}
