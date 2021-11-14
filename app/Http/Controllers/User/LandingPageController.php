<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use URL;
use Session;
use Redirect;
use validate;

class LandingPageController extends Controller
{
    public function index(){
    	
    	return view('user/landing-page.index');
    }
}
