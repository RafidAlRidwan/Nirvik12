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
use App\Models\CoverPage;
use SebastianBergmann\CodeCoverage\Report\Xml\Coverage;

class CoverPageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $data['coverPage'] = CoverPage::paginate(5);
        return view('admin/cover-page.index', $data);
    }

    public function create()
    {
        return view('admin/cover-page.create');
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'attachment' => ['required']
            ]);
            DB::beginTransaction();
            $coverPage = CoverPage::saveOrUpdate($request);
            DB::commit();

            if($coverPage){
                Session::flash('flashy__success', __('Saved Successfully!'));
            } else{
                Session::flash('flashy__danger', __('Can not add more than 5'));
            }

            // Redirect to edit mode.
            return Redirect::back();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->withErrors($e->getMessage())
                ->withInput($request->all);
        }
    }

    public function edit($id)
    {
        $data['coverPage'] = CoverPage::findOrFail($id);
        // dd($data['coverPage']);
        return view('admin/cover-page.edit', $data);
    }

    public function update(Request $request)
    {
        // dd($request->all());
        try {
            $id = $request->id;
            $this->validate($request, [
                'image' => ['required'],
            ]);
            DB::beginTransaction();
            CoverPage::saveOrUpdate($request, $id);
            DB::commit();
            Session::flash('flashy__success', __('Updated Successfully!'));

            // Redirect to edit mode.
            return Redirect::route('cover_page_index');
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

            $coverPage = CoverPage::findOrFail($id);
            $image_path = $coverPage->attachment; 
            if (file_exists($image_path)) {
                unlink($image_path);
            }

            CoverPage::where('id', $id)->delete();

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
