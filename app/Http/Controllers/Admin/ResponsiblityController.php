<?php

namespace App\Http\Controllers\Admin;

use DB;
use URL;
use Auth;
use Session;
use Redirect;
use validate;
use App\Models\News;
use App\Models\Event;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ResponsiblitySection;
use Intervention\Image\Facades\Image;

class ResponsiblityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('admin.responsiblity.index');
    }

    public function create()
    {
        return view('admin.responsiblity.create');
    }

    public function responsiblity_datatable(Request $request)
    {
        $searchString = $request->search['value'];
        $product_data = ResponsiblitySection::query();

        $data['recordsTotal'] = $product_data->count();
        $data['recordsFiltered'] = $product_data->count();
        $product_data->limit($request->length)->offset($request->start);
        $product_data_list = $product_data->get();
        $data['draw'] = $request->draw;
        $data['data'] = array();
        $sl = 0;
        $serial = 1;



        foreach ($product_data_list as $item) {

            $editURL = URL::to('admin/responsiblity-section/edit' . '/' . $item->id);
            $img = URL::to($item->file);
            $data['data'][$sl]['serial'] = $serial;
            $data['data'][$sl]['title'] = $item->title ?? "";
            $data['data'][$sl]['body'] = $item->short_description ?? "";
            $data['data'][$sl]['img'] = "<img style='border-radius:5px; width: 45px; height:45px;' src='$img' alt='image' class='responsive'>";
            $data['data'][$sl]['action'] = "<a class='event_edit' href='$editURL'><i class='fa fa-edit' style='font-size:14px; ''></i></a>
                |<a class='event_delete' href='$item->id' data-toggle='modal' data-target='#event_delete_modal' style='border: none; background: none;' > <i class='fa fa-trash'></i> </a>";

            $sl++;
            $serial++;
        }
        echo json_encode($data);
        die();
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => ['required'],
            'short_description' => ['required'],
            'file' => ['required']
        ]);
        $requestData = $request->all();
        if (!empty($request->file)) {
            $image = $request->file;
            $unique_date = date_timestamp_get(date_create());
            $filename = $unique_date . $image->getClientOriginalName();
            $path = ('assets/user/landingPage/img/');
            $image_resize = Image::make($image->getRealPath());
            // $image_resize->resize(800, 600);
            $main_path = $path . $filename;
            $image_resize->save($main_path);
            $requestData['file'] = $main_path ?? NULL;
        }
        ResponsiblitySection::create($requestData);
        Session::flash('flashy__success', __('Saved Successfully!'));

        // Redirect to edit mode.
        return Redirect::back();
    }

    public function edit($id)
    {
        $res = ResponsiblitySection::findOrFail($id);
        $data['responsiblity'] = $res;
        return view('admin/responsiblity.edit', $data);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $this->validate($request, [
            'title' => ['required'],
            'short_description' => ['required'],
        ]);
        $responsible = ResponsiblitySection::find($id);

        if (!empty($request->file)) {
            $image = $request->file;
            $unique_date = date_timestamp_get(date_create());
            $filename = $unique_date . $image->getClientOriginalName();
            $path = ('assets/user/landingPage/img/responsiblity/');
            $image_resize = Image::make($image->getRealPath());
            // $image_resize->resize(800, 600);
            $main_path = $path . $filename;
            $image_resize->save($main_path);
            $responsible['file'] = $main_path ?? NULL;
        }
        $responsible->title = $request->title;
        $responsible->short_description = $request->short_description;
        $responsible->save();
        Session::flash('flashy__success', __('Updated Successfully!'));

        // Redirect to edit mode.
        return Redirect::route('responsiblity_index');
    }

    public function destroy(Request $request)
    {
        try {
            $id = $request->id;
            DB::beginTransaction();
            ResponsiblitySection::where('id', $id)->delete();
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
