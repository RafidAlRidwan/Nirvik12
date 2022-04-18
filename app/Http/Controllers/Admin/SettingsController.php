<?php

namespace App\Http\Controllers\Admin;

use DB;
use URL;
use Session;
use Redirect;
use validate;
use App\Models\News;
use App\Models\Album;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkAdmin');
    }
    public function index()
    {
        $data['user'] = Auth::user();
        return view('admin/settings.index', $data);
    }

    public function edit($id)
    {
        $data['album'] = Album::findOrFail($id);
        return view('admin/album.edit', $data);
    }

    public function update(Request $request)
    {
        try {
            $this->validate($request, [
                'app_name' => ['required'],
                // 'name' => ['required'],
                'password' => ['required'],
                'address' => ['required'],
                'phone' => ['required'],
                'email' => ['required'],
            ]);
            DB::beginTransaction();
            Setting::onlyUpdate($request);
            DB::commit();
            Session::flash('flashy__success', __('Updated Successfully!'));

            // Redirect to edit mode.
            return Redirect::route('setting_index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->withErrors($e->getMessage())
                ->withInput($request->all);
        }
    }

}
