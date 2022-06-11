<?php

namespace App\Http\Controllers\Admin;

use DB;
use URL;
use Auth;
use Session;
use Redirect;
use validate;
use App\Models\User;
use App\Models\About;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkAdmin');
    }
    public function home()
    {
        $user = new User;
        $data = $user->userCount();
        return view('admin/dashboard.index', $data);
    }

    public function edit($id)
    {
        $data['about'] = About::findOrFail($id);
        return view('admin/about.index', $data);
    }

    public function update(Request $request, $id)
    {
        try {

            $this->validate($request, [
                'description' => 'required'

            ]);
            DB::beginTransaction();
            About::saveOrUpdate($request, $id);
            DB::commit();
            Session::flash('flashy__success', __('Updated Successfully!'));
            return back();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->withErrors($e->getMessage())
                ->withInput($request->all);
        }
    }

}
