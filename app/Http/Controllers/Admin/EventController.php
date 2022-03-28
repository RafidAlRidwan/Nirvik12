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

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkAdmin');
    }
    public function index()
    {
        return view('admin/event.index');
    }

    public function create()
    {
        return view('admin/event.create');
    }

    public function news_datatable(Request $request)
    {
        $searchString = $request->search['value'];
        $product_data = Event::query()
            ->select(
                "events.*",
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

            $editURL = URL::to('admin/event/edit' . '/' . $item->id);
            $viewURL = URL::to('admin/event/show' . '/' . $item->id);

            $data['data'][$sl]['serial'] = $serial;
            $data['data'][$sl]['title'] = $item->title ?? "";
            $data['data'][$sl]['body'] = $item->description ?? "";
            $data['data'][$sl]['venue'] = $item->venue ?? "";
            $data['data'][$sl]['time'] = date('h:i A', strtotime($item->time ?? ''));
            $data['data'][$sl]['date'] = date('d, F, Y', strtotime($item->date ?? '')); 
            $data['data'][$sl]['action'] = "<a class='event_edit' href='$editURL'><i class='fa fa-edit' style='font-size:14px; ''></i></a>
                | <a href='$viewURL'><i class='fa fa-eye' style='font-size:14px; ''></i></a>
                |<a class='event_delete' href='$item->id' data-toggle='modal' data-target='#event_delete_modal' style='border: none; background: none;' > <i class='fa fa-trash'></i> </a>";

            $sl++;
            $serial++;
        }


        echo json_encode($data);
        die();
    }

    public function store(Request $request)
    {
        // dd($request->all());
        try {
            $this->validate($request, [
                'title' => ['required'],
                'venue' => ['required']
            ]);
            DB::beginTransaction();
            Event::saveOrUpdate($request);
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
        $event = Event::findOrFail($id);
        $data['event'] = $event;
        $data['date'] = date('h:i:s', strtotime($event->time));
        return view('admin/event.edit', $data);
    }

    public function update(Request $request)
    {
        try {
            $id = $request->id;
            $this->validate($request, [
                'title' => ['required'],
                'venue' => ['required']
            ]);
            DB::beginTransaction();
            Event::saveOrUpdate($request, $id);
            DB::commit();
            Session::flash('flashy__success', __('Updated Successfully!'));

            // Redirect to edit mode.
            return Redirect::route('event_index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->withErrors($e->getMessage())
                ->withInput($request->all);
        }
    }

    public function show($id)
    {
        $event = Event::findOrFail($id);
        $data['event'] = $event;
        $data['time'] = date('h:i A', strtotime($event->time ?? ''));
        $data['date'] = date('F, Y', strtotime($event->date ?? '')); 
        return view('admin/event.view', $data);
    }

    public function destroy(Request $request)
    {
        try {
            $id = $request->id;
            DB::beginTransaction();
            Event::where('id', $id)->delete();
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
