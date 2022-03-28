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
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkAdmin');
    }
    public function index()
    {
        return view('admin/news.index');
    }

    public function news_datatable(Request $request)
    {

        $searchString = $request->search['value'];
        $product_data = News::query()
            ->select(
                "news.*",
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

            if ($item['status'] == 0) {
                $class = "badge-danger rounded p-1";
                $status = 'Disable';
            } elseif ($item['status'] == 1) {
                $class = "badge-success rounded p-1";
                $status = 'Active';
            } else {
                $class = "";
                $status = '';
            }
            $viewURL = URL::to('admin/news/show' . '/' . $item->id);
            
            $data['data'][$sl]['serial'] = $serial;
            $data['data'][$sl]['heading'] = $item->heading ?? "";
            $data['data'][$sl]['body'] = $item->body ?? "";
            $data['data'][$sl]['status'] = "<span style='font-size:11px;' class='$class'>$status</span>";
            $data['data'][$sl]['action'] = "<a class='news_edit' href='$item->id' data-toggle='modal' data-target='#news_edit_modal' heading=' $item->heading' body='$item->body' status_val='$item->status'><i class='fa fa-edit' style='font-size:14px; ''></i></a>
                |
                <a href='$viewURL'><i class='fa fa-eye' style='font-size:14px; ''></i></a>
                | <a class='news_delete' href='$item->id' data-toggle='modal' data-target='#news_delete_modal' style='border: none; background: none;' > <i class='fa fa-trash'></i> </a>";

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
                'heading' => ['required'],
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

    public function update(Request $request)
    {
        try {
            $id = $request->id;
            $this->validate($request, [
                'heading' => ['required'],
            ]);
            DB::beginTransaction();
            News::saveOrUpdate($request, $id);
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

    public function show($id)
    {
        $news = News::findOrFail($id);
        $data['news'] = $news;

        return view('admin/news.view', $data);
    }

    public function destroy(Request $request)
    {
        try {
            $id = $request->id;
            DB::beginTransaction();
            News::where('id', $id)->delete();
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
