<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Donate;
use App\Models\Setting;

class DonateController extends Controller
{
    public function index()
    {
        $settings = Setting::all();
        return view('user/donate.index', compact('settings'));
    }

    public function store(Request $request)
    {
        Donate::create($request->all());
        return response()->json(['status' => 1]);
    }
}
