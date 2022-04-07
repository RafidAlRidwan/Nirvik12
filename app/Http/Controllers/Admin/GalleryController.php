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

class GalleryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkAdmin');
    }
    public function index()
    {
        return view('admin/gallery.index');
    }

    public function create()
    {
        $data['albumList'] = Album::pluck('title','id');
        return view('admin/gallery.create', $data);
    }

    public function news_datatable(Request $request)
    {
        $searchString = $request->search['value'];
        $product_data = Gallery::query()
                        ->leftJoin('albums', 'galleries.album_id', '=', 'albums.id')
                        ->select(
                "galleries.*",
                'albums.title as album',
            );

        $data['recordsTotal'] = $product_data->count();
        $data['recordsFiltered'] = $product_data->count();
        $product_data->limit($request->length)->offset($request->start);
        $product_data_list = $product_data->get();
        $data['draw'] = $request->draw;
        $data['data'] = array();
        $sl = 0;
        $serial = 1;



        foreach ($product_data_list as $item) {

            $editURL = URL::to('admin/gallery/edit' . '/' . $item->id);
            $viewURL = URL::to('admin/gallery/show' . '/' . $item->id);
            $img = URL::to($item->attachment);

            $data['data'][$sl]['serial'] = $serial;
            $data['data'][$sl]['title'] = $item->title ?? "";
            $data['data'][$sl]['album'] = $item->album ?? "Others";
            $data['data'][$sl]['image'] = "<img style='border: 1px solid #ddd; border-radius:5px; width: 45px; height:45px; ' src='$img' alt='image' class='responsive'>";
            $data['data'][$sl]['action'] = "<a class='event_edit' href='$editURL'><i class='fa fa-edit' style='font-size:14px; ''></i></a>
                | <a href='$viewURL'><i class='fa fa-eye' style='font-size:14px; ''></i></a>
                |<a class='gallery_delete' href='$item->id' data-toggle='modal' data-target='#gallery_delete_modal' style='border: none; background: none;' > <i class='fa fa-trash'></i> </a>";

            $sl++;
            $serial++;
        }
        echo json_encode($data);
        die();
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'attachment' => ['required']
            ]);
            DB::beginTransaction();
            Gallery::saveOrUpdate($request);
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

    public function edit($id)
    {
        $gallery = Gallery::findOrFail($id);
        $data['gallery'] = $gallery;
        $data['albumList'] = Album::pluck('title','id');
        $album_details = $gallery->albumDetails()->get();
        $data['album_details'] = $album_details;
        return view('admin/gallery.edit', $data);
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
            Gallery::saveOrUpdate($request, $id);
            DB::commit();
            Session::flash('flashy__success', __('Updated Successfully!'));

            // Redirect to edit mode.
            return Redirect::route('gallery_index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->withErrors($e->getMessage())
                ->withInput($request->all);
        }
    }

    public function show($id)
    {
        $gallery = Gallery::findOrFail($id);
        $data['gallery'] = $gallery;
        $album_details = $gallery->albumDetails()->get();
        $data['album_details'] = $album_details;
        return view('admin/gallery.view', $data);
    }

    public function destroy(Request $request)
    {
        try 
        {
            $id = $request->id;
            DB::beginTransaction();

            $gallery = Gallery::findOrFail($id);
            $image_path = $gallery->attachment; 
            if (file_exists($image_path)) {
                unlink($image_path);
            }
            Gallery::where('id', $id)->delete();

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
