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
use App\Models\Sponsor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class SponsorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('admin/sponsor.index');
    }

    public function create()
    {
        return view('admin/sponsor.create');
    }

    public function sponsor_datatable(Request $request)
    {
        $searchString = $request->search['value'];
        $product_data = Sponsor::query();

        $data['recordsTotal'] = $product_data->count();
        $data['recordsFiltered'] = $product_data->count();
        $product_data->limit($request->length)->offset($request->start);
        $product_data_list = $product_data->get();
        $data['draw'] = $request->draw;
        $data['data'] = array();
        $sl = 0;
        $serial = 1;

        foreach ($product_data_list as $item) {
            $img = URL::to($item->attachment);
            $data['data'][$sl]['serial'] = $serial;
            $data['data'][$sl]['image'] = "<img style='border: 1px solid #ddd; border-radius:5px; width: 45px; height:45px; ' src='$img' alt='image' class='responsive'>";
            $data['data'][$sl]['action'] = "<a class='sponsor_delete' href='$item->id' data-toggle='modal' data-target='#gallery_delete_modal' style='border: none; background: none;' > <i class='fa fa-trash'></i> </a>";

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
            $requestData = $request->all();
            if (!empty($requestData['attachment'])) {
                $image = $requestData['attachment'];
                $unique_date = date_timestamp_get(date_create());
                $filename = $unique_date . $image->getClientOriginalName();
                $path = ('assets/user/landingPage/img/sponsor');
                $image_resize = Image::make($image->getRealPath());
                // $image_resize->resize(800, 600);
                $main_path = $path . $filename;
                $image_resize->save($main_path);
                $requestData['attachment'] = $main_path ?? NULL;
                Sponsor::create($requestData);
            }

            DB::commit();
            Session::flash('flashy__success', __('Saved Successfully!'));

            // Redirect to edit mode.
            return Redirect::back();
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            return redirect()->back()
                ->withErrors($e->getMessage())
                ->withInput($request->all);
        }
    }

    



    public function destroy(Request $request)
    {
        try {
            $id = $request->id;
            DB::beginTransaction();

            $sponsor = Sponsor::findOrFail($id);
            $image_path = $sponsor->attachment;
            if (file_exists($image_path)) {
                unlink($image_path);
            }
            Sponsor::where('id', $id)->delete();

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
