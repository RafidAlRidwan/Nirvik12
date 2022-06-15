<?php

namespace App\Http\Controllers\User;

use URL;
use Redirect;
use validate;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class LandingPageController extends Controller
{
    public function index()
    {   
        return view('user/landing-page.index');
    }
    public function event()
    {
        return view('user/landing-page.event');
    }
    public function news()
    {
        return view('user/landing-page.news');
    }
    public function album()
    {
        return view('user/landing-page.album');
    }
    public function committee()
    {
        return view('user/landing-page.committee-details');
    }
    public function gallery($id)
    {
        if($id != 0){
            $data['gallery'] = Gallery::where('album_id', $id)->get();
        }else{
            $data['gallery'] = Gallery::where('album_id', '=', NULL)->get();
        }
        // dd($data['gallery']);
        return view('user/landing-page.gallery', $data);
    }
}
