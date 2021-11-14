<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\News;
use URL;
use Session;
use Redirect;
use validate;
use Auth;
use DB;

class NewsController extends Controller
{
    public function index(){
    	return view('admin/news.index');
    }

    public function store(Request $request){
          
          try {
            $this->validate($request, [
            'heading' => ['required'],
            'body' => ['required']
            
            ]);
                DB::beginTransaction();
                News::saveOrUpdate($request);
                DB::commit();
                Session::flash('flashy__success', __('Saved Successfully!'));

                // Redirect to edit mode.
                return Redirect::back();
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()
                    ->withErrors($e->getMessage())
                    ->withInput($request->all);
            }
          
    }
}
