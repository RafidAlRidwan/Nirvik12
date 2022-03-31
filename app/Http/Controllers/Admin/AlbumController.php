<?php

namespace App\Http\Controllers\Admin;

use DB;
use URL;
use Auth;
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

class AlbumController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkAdmin');
    }
    public function index()
    {
        $data['album'] = Album::paginate(5);
        return view('admin/album.index', $data);
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'title' => ['required']
            ]);
            DB::beginTransaction();
            Album::saveOrUpdate($request);
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

    public function update(Request $request)
    {
        // dd($request->all());
        try {
            $id = $request->id;
            $this->validate($request, [
                'title' => ['required'],
            ]);
            DB::beginTransaction();
            Album::saveOrUpdate($request, $id);
            DB::commit();
            Session::flash('flashy__success', __('Updated Successfully!'));

            // Redirect to edit mode.
            return Redirect::route('album_index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->withErrors($e->getMessage())
                ->withInput($request->all);
        }
    }

    public function destroy(Request $request)
    {
        try 
        {
            $id = $request->id;
            DB::beginTransaction();

            Album::where('id', $id)->delete();

            DB::commit();
            return redirect()->back()->with('flashy__success', __('Deleted Successfully!'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withErrors($e->getMessage())
                ->withInput();
        }
    }
}
