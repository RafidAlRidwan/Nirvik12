<?php

namespace App\Http\Controllers\User;

use URL;
use Session;
use Redirect;
use validate;
use App\Models\Gallery;
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
    public function event()
    {
        $data = Auth::user();
        if(!$data){
            $data = false;
        } else{
            $data = true;
        }
        return view('user/landing-page.event', compact('data'));
    }
    public function news()
    {
        $data = Auth::user();
        if(!$data){
            $data = false;
        } else{
            $data = true;
        }
        return view('user/landing-page.news', compact('data'));
    }
    public function album()
    {
        $data = Auth::user();
        if(!$data){
            $data = false;
        } else{
            $data = true;
        }
        return view('user/landing-page.album', compact('data'));
    }
    public function gallery($id)
    {
        $data = Auth::user();
        if(!$data){
            $data['data'] = false;
        } else{
            $data['data'] = true;
        }
        if($id != 0){
            $data['gallery'] = Gallery::where('album_id', $id)->get();
        }else{
            $data['gallery'] = Gallery::where('album_id', '=', NULL)->get();
        }
        // dd($data['gallery']);
        return view('user/landing-page.gallery', $data);
    }
}
