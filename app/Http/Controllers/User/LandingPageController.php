<?php

namespace App\Http\Controllers\User;

use URL;
use Session;
use Redirect;
use validate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LandingPageController extends Controller
{
    public function index()
    {
        $data = Auth::user();
        if(!$data){
            $data = false;
        } else{
            $data = true;
        }
        return view('user/landing-page.index', compact('data'));
    }
}
