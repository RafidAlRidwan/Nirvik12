<?php

namespace App\Http\Controllers\Admin;

use DB;
use URL;
use Auth;
use Session;
use Redirect;
use validate;
use App\Models\News;
use App\Models\User;
use App\Models\Event;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Committee;
use App\Models\CommitteeMember;
use App\Models\UserDetail;

class CommitteeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkAdmin');
    }
    public function index()
    {
        return view('admin/committee.index');
    }

    public function create()
    {
        $data = Committee::getMasterData();
        return view('admin/committee.create', $data);
    }

    public function datatable(Request $request)
    {
        $searchString = $request->search['value'];
        $product_data = Committee::with('userData', 'eventData');

        $data['recordsTotal'] = $product_data->count();
        $data['recordsFiltered'] = $product_data->count();
        $product_data->limit($request->length)->offset($request->start);
        $product_data_list = $product_data->get();
        $data['draw'] = $request->draw;
        $data['data'] = array();
        $sl = 0;
        $serial = 1;

        foreach ($product_data_list as $item) {

            $editURL = URL::to('admin/committee/edit' . '/' . $item->id);
            $viewURL = URL::to('admin/committee/view' . '/' . $item->id);

            $data['data'][$sl]['serial'] = $serial;
            $data['data'][$sl]['name'] = $item->name ?? "";
            $data['data'][$sl]['event'] = $item->eventData->title ?? "";
            $data['data'][$sl]['manager'] = $item->userData->full_name ?? "";
            $data['data'][$sl]['action'] = "<a class='committee_setting' href='$viewURL'><i class='fa fa-cogs' style='font-size:14px; ''></i> </a>
                | <a class='committee_edit' href='$editURL'><i class='fa fa-edit' style='font-size:14px; ''></i></a>
                |<a class='committee_delete' href='$item->id' data-toggle='modal' data-target='#committee_delete_modal' style='border: none; background: none;' > <i class='fa fa-trash'></i> </a>";

            $sl++;
            $serial++;
        }


        echo json_encode($data);
        die();
    }

    public function store(Request $request)
    {
        try 
            {
            $this->validate($request, [
                'event_id' => ['required'],
                // 'name' => ['required|unique:committees'],
                'manager_id' => ['required'],
                'member_id' => ['required'],
            ]);
            DB::beginTransaction();
            Committee::saveOrUpdate($request);
            DB::commit();
            Session::flash('flashy__success', __('Saved Successfully!'));
            return Redirect::route('committee_index');
            } catch (\Exception $e) {
            DB::rollback();
            // Redirect to edit mode.
            return Redirect::route('committee_index')
                ->withErrors($e->getMessage())
                ->withInput($request->all);
        }
            
    }

    public function edit($id)
    {
        $committee = Committee::findOrFail($id);
        $data = $committee->getMasterData($committee);
        $data['committee'] = $committee;
        $data['members'] = $committee->getMemberData($committee);
        
        return view('admin/committee.edit', $data);
    }

    public function update(Request $request)
    {
        try 
            {
            $id = $request->id;
            $this->validate($request, [
                'event_id' => ['required'],
                // 'name' => ['required|unique:committees'.$id],
                'manager_id' => ['required'],
                'member_id' => ['required'],
            ]);
            Committee::saveOrUpdate($request, $id);
            Session::flash('flashy__success', __('Updated Successfully!'));
            return Redirect::route('committee_index');
            } catch (\Exception $e) {
            DB::rollback();
            // Redirect to edit mode.
            return Redirect::route('committee_index')
                ->withErrors($e->getMessage())
                ->withInput($request->all);
        }   
            
    }

    public function show($id)
    {
        $memberDetails = CommitteeMember::select('committee_members.*', 'user_details.full_name')
        ->leftJoin('user_details', 'user_details.user_id', '=', 'committee_members.user_id')
        ->where('committee_members.committee_id', $id)
        ->get();
        $data['memberDetails'] = $memberDetails;
        $data['committeeDetails'] = Committee::with('userData')->findOrFail($id);
        return view('admin/committee.view', $data);
    }

    public function destroy(Request $request)
    {
        try {
            $id = $request->id;
            DB::beginTransaction();
            CommitteeMember::where('committee_id', $id)->delete();
            Committee::where('id', $id)->delete();
            DB::commit();
            return redirect()->back()->with('flashy__success', __('Deleted Successfully!'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withErrors($e->getMessage())
                ->withInput();
        }
    }

    public function getUserIds($id)
    {
        return response()->json(User::getUserIds($id));
    }
}
