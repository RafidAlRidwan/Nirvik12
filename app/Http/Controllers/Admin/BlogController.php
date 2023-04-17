<?php

namespace App\Http\Controllers\Admin;

use DB;
use URL;
use Auth;
use Session;
use Redirect;
use validate;
use App\Models\Blog;
use App\Models\News;
use App\Models\Album;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\Section;
use App\Models\Sponsor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('admin/blog.index');
    }

    public function create()
    {
        return view('admin/blog.create');
    }

    public function blog_datatable(Request $request)
    {
        $searchString = $request->search['value'];
        $product_data = Blog::query();

        $data['recordsTotal'] = $product_data->count();
        $data['recordsFiltered'] = $product_data->count();
        $product_data->limit($request->length)->offset($request->start);
        $product_data_list = $product_data->get();
        $data['draw'] = $request->draw;
        $data['data'] = array();
        $sl = 0;
        $serial = 1;

        foreach ($product_data_list as $item) {
            if ($item->status == 1) {
                $button = "<span status='$item->id' class='actionStatus badge badge-info'>Active</span>";
            } else {
                $button = "<span status='$item->id' class='actionStatus badge badge-danger'>Inactive</span>";
            }
            $html = "<a class='sponsor_delete' href='$item->id' data-toggle='modal' data-target='#gallery_delete_modal' style='border: none; background: none;' > <i class='fa fa-trash'></i> </a>";

            $data['data'][$sl]['serial'] = $serial;
            $data['data'][$sl]['title'] = $item->title;
            $data['data'][$sl]['created'] = $item->user ? $item->user->name : '';
            $data['data'][$sl]['status'] = $button;
            $data['data'][$sl]['action'] = $html;
            $sl++;
            $serial++;
        }
        echo json_encode($data);
        die();
    }



    public function destroy(Request $request)
    {
        try {
            $id = $request->id;
            DB::beginTransaction();

            $sponsor = Blog::findOrFail($id);
            
            $sponsor->delete();

            DB::commit();
            return redirect()->back()->with('flashy__success', __('Deleted Successfully!'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withErrors($e->getMessage())
                ->withInput();
        }
    }

    public function modifyStatus(Request $request)
    {
        $blog = Blog::find($request->blog_id);
        if ($blog->status == 1) {
            $blog->status = 0;
        } elseif ($blog->status == 0) {
            $blog->status = 1;
        }
        $blog->save();

        return response()->json(['status' => true]);
    }
}
