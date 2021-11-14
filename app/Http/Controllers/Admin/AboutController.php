<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;
use URL;
use Session;
use Redirect;
use validate;
use Auth;
use DB;

class AboutController extends Controller
{
	public function home(){
    	return view('admin/dashboard.index');
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
