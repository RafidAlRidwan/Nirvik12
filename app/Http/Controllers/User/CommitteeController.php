<?php

namespace App\Http\Controllers\User;

use Redirect;
use validate;
use App\Models\User;
use App\Models\Shift;
use App\Models\Expense;
use App\Models\Section;
use App\Models\Committee;
use App\Models\Collection;
use App\Models\UserDetail;
use App\Models\FundTransfer;
use Illuminate\Http\Request;
use App\Models\CommitteeMember;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class CommitteeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('user/committee.index');
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'committee_id' => ['required'],
                'member_id' => ['required'],
                'user_id' => ['required'],
                'amount' => ['required'],
            ]);
            DB::beginTransaction();
            Collection::saveOrUpdate($request);
            DB::commit();
            Session::flash('flashy__success', 'Added Successfully!');
            return back();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withErrors($e->getMessage())
                ->withInput();
        }
    }

    public function expenseStore(Request $request)
    {
        try {
            $this->validate($request, [
                'committee_id' => ['required'],
                'manager_id' => ['required'],
                'amount' => ['required'],
            ]);
            DB::beginTransaction();

            $requestData = $request->all();

            $committee = Committee::findOrFail($requestData['committee_id']);
            if ($committee->total_balance >= $requestData['amount']) {
                $committee->total_balance = $committee->total_balance - $requestData['amount'];
                $committee->save();
            } else {
                Session::flash('flashy__danger', __('Insufficient Balance!'));
                return back();
            }

            Expense::create($requestData);

            DB::commit();
            Session::flash('flashy__success', __('Added Successfully!'));
            return back();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withErrors($e->getMessage())
                ->withInput();
        }
    }

    public function transfer(Request $request)
    {
        try {
            $requestData = $request->all();
            if ($requestData['amount'] == 0) {
                Session::flash('flashy__danger', __('Fund Transfer Failed! Invalid Balance!'));
                return back();
            }

            if ($requestData['transfer_from'] == $requestData['transfer_to']) {
                Session::flash('flashy__danger', __('Fund Transfer Failed!'));
                return back();
            }

            $this->validate($request, [
                'transfer_from' => ['required'],
                'transfer_to' => ['required'],
                'amount' => ['required'],
            ]);
            DB::beginTransaction();
            FundTransfer::saveOrUpdate($request);
            DB::commit();
            Session::flash('flashy__success', __('Fund Transferred Successfully!'));
            return back();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withErrors($e->getMessage())
                ->withInput();
        }
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

            $members = CommitteeMember::where('committee_id', $item->id)->get();

            $count_member = count($members);
            if ($item->type == 1) {
                $viewURL = URL::to('user/committee/memberView' . '/' . $item->id);
            } else {
                $viewURL = URL::to('user/committee/others' . '/' . $item->id);
            }

            $data['data'][$sl]['serial'] = $serial;
            $data['data'][$sl]['event_name'] = $item->eventData->title ?? "";
            $data['data'][$sl]['committee_name'] = $item->name ?? "";
            $data['data'][$sl]['manager_name'] = $item->userData->full_name ?? "";
            $data['data'][$sl]['total_member'] = $count_member ?? 0;
            $data['data'][$sl]['action'] = "<a class='committee_setting' href='$viewURL' data-toggle='tooltip' data-placement='top' title='Tooltip on top'><i class='fa fa-cogs' style='font-size:14px;'></i> </a>
                ";

            $sl++;
            $serial++;
        }


        echo json_encode($data);
        die();
    }

    public function collectionDatatable(Request $request, $id)
    {
        $searchString = $request->search['value'];
        $product_data = Collection::where('committee_id', $id)->with('userData', 'memberData');

        if (!empty($request->member)) {
            if ($request->member == 0) {
                $product_data = $product_data;
            } else {
                $product_data->where('collection_histories.member_id', $request->member);
            }
        }

        $data['recordsTotal'] = $product_data->count();
        $data['recordsFiltered'] = $product_data->count();
        $product_data->limit($request->length)->offset($request->start);
        $product_data_list = $product_data->get();
        $data['draw'] = $request->draw;
        $data['data'] = array();
        $sl = 0;
        $serial = 1;

        foreach ($product_data_list as $item) {

            $date = date('d M, Y', strtotime($item->created_at));
            $data['data'][$sl]['serial'] = $serial;
            $data['data'][$sl]['recieved_by'] = $item->memberData->full_name ?? "";
            $data['data'][$sl]['collected_from'] = $item->userData->full_name ?? "";
            $data['data'][$sl]['amount'] = $item->amount ?? "0";
            $data['data'][$sl]['date'] = $date ?? '-';
            if ($item->member_id == Auth::user()->id) {
                $data['data'][$sl]['action'] = "
                <a class='collection_delete' href='$item->id' data-toggle='modal' data-target='#collection_delete_modal' style='border: none; background: none;' > <button class='btn btn-secondary btn-sm btn-custom'>Revert</button> </a>";
            } else {
                $data['data'][$sl]['action'] = "
                <a class='collection_delete' href='$item->id' data-toggle='modal' data-target='#collection_delete_modal' style='border: none; background: none;' > <button style='text-decoration: line-through'  disabled class='btn btn-custom btn-sm btn-custom'>Revert</button> </a>";
            }


            $sl++;
            $serial++;
        }
        echo json_encode($data);
        die();
    }

    public function expenseDatatable(Request $request, $id)
    {
        $searchString = $request->search['value'];
        $product_data = Expense::where('committee_id', $id)->with('managerData');

        $data['recordsTotal'] = $product_data->count();
        $data['recordsFiltered'] = $product_data->count();
        $product_data->limit($request->length)->offset($request->start);
        $product_data_list = $product_data->get();
        $data['draw'] = $request->draw;
        $data['data'] = array();
        $sl = 0;
        $serial = 1;

        foreach ($product_data_list as $item) {

            $date = date('d M, Y', strtotime($item->created_at));
            $data['data'][$sl]['serial'] = $serial;
            $data['data'][$sl]['manager_id'] = $item->managerData->full_name ?? "";
            $data['data'][$sl]['amount'] = $item->amount ?? "0";
            $data['data'][$sl]['date'] = $date ?? '-';
            $data['data'][$sl]['remarks'] = $item->remarks ?? "-";
            $data['data'][$sl]['action'] = "
                <a class='fund_delete' href='$item->id' data-toggle='modal' data-target='#fund_transfer_delete_modal' style='border: none; background: none;' > <button disabled style='text-decoration: line-through'  class='btn btn-custom btn-sm'>Revert</button> </a>";

            $sl++;
            $serial++;
        }
        echo json_encode($data);
        die();
    }
    public function fundTransferDatatable(Request $request, $id)
    {
        $searchString = $request->search['value'];
        $product_data = FundTransfer::where('committee_id', $id)->with('transferFromUserData', 'transferToUserData');

        $data['recordsTotal'] = $product_data->count();
        $data['recordsFiltered'] = $product_data->count();
        $product_data->limit($request->length)->offset($request->start);
        $product_data_list = $product_data->get();
        $data['draw'] = $request->draw;
        $data['data'] = array();
        $sl = 0;
        $serial = 1;

        foreach ($product_data_list as $item) {

            $date = date('d M, Y', strtotime($item->created_at));
            $data['data'][$sl]['serial'] = $serial;
            $data['data'][$sl]['transfer_from'] = $item->transferFromUserData->full_name ?? "";
            $data['data'][$sl]['transfer_to'] = $item->transferToUserData->full_name ?? "";
            $data['data'][$sl]['amount'] = $item->amount ?? "0";
            $data['data'][$sl]['date'] = $date ?? '-';
            $data['data'][$sl]['remarks'] = $item->remarks ?? "-";
            $data['data'][$sl]['action'] = "
                <a class='fund_delete' href='$item->id' data-toggle='modal' data-target='#fund_transfer_delete_modal' style='border: none; background: none;' > <button disabled class='btn btn-danger btn-sm'>Revert</button> </a>";

            $sl++;
            $serial++;
        }
        echo json_encode($data);
        die();
    }
    public function memberShow($id)
    {
        // Member Table Values
        $memberDetails = CommitteeMember::select('committee_members.*', 'user_details.full_name')
            ->leftJoin('user_details', 'user_details.user_id', '=', 'committee_members.user_id')
            ->where('committee_members.committee_id', $id)
            ->get();
        $data['memberDetails'] = $memberDetails;
        $total_member_collection = $memberDetails->sum('balance');
        $data['committeeDetails'] = Committee::with('userData')->findOrFail($id);
        $manager_collection = $data['committeeDetails']->total_balance;

        // Total Registration Count

        $registration = Collection::where('committee_id', $id)->get();
        $data['registrationCount'] = count($registration);
        $data['totalCollection'] = $total_member_collection + $manager_collection;
        return view('user/committee.member', $data);
    }

    public function others($id)
    {
        // Member Table Values
        $memberDetails = CommitteeMember::select('committee_members.*', 'user_details.full_name')
            ->leftJoin('user_details', 'user_details.user_id', '=', 'committee_members.user_id')
            ->where('committee_members.committee_id', $id)
            ->get();
        $data['memberDetails'] = $memberDetails;
        $data['committeeDetails'] = Committee::with('userData')->findOrFail($id);
        return view('user/committee.others', $data);
    }

    public function collectionShow($id)
    {
        $data['committeeDetails'] = Committee::with('userData')->findOrFail($id);
        $manager_array = Committee::query()
            ->leftJoin('user_details', 'committees.manager_id', '=', 'user_details.user_id')
            ->where('committees.id', $id)
            ->select(
                DB::raw("CONCAT(user_details.full_name, ' (Manager)') AS name"),
                'user_details.user_id'
            )
            ->get();
        $sql = DB::select("
        SELECT (
            case
            when (sections.name is not null)  then
            CONCAT(user_details.full_name,' (', sections.name,')')
            when (sections.name is null) then 
            CONCAT(user_details.full_name,' (n/a)')
            end 
            )AS name,
            users.id

            FROM users
            LEFT JOIN user_details 
            ON user_details.user_id = users.id
            LEFT JOIN sections
            ON sections.id = user_details.section
            LEFT OUTER JOIN collection_histories 
            ON users.id = collection_histories.user_id
            AND collection_histories.committee_id = $id 
            WHERE collection_histories.user_id IS NULL
            AND users.type = 3
            AND user_details.full_name != 'null' ");

        $array = array_map(function ($item) {
            return (array) $item;
        }, $sql);

        $data['user'] = collect($array)->pluck('name', 'id')->toArray();

        $manager_id = $manager_array->pluck('name', 'user_id')->toArray();

        $member_ids = CommitteeMember::query()
            ->leftJoin('user_details', 'committee_members.user_id', '=', 'user_details.user_id')
            ->where('committee_members.committee_id', $id)
            ->pluck(
                'user_details.full_name',
                'user_details.user_id'
            )
            ->toArray();
        $data['comiittee_members'] = ($manager_id + $member_ids);

        return view('user/committee.collection', $data);
    }

    public function expenseShow($id)
    {
        $data['committeeDetails'] = Committee::with('userData')->findOrFail($id);
        $manager_array = Committee::query()
            ->leftJoin('user_details', 'committees.manager_id', '=', 'user_details.user_id')
            ->where('committees.id', $id)
            ->select(
                DB::raw("CONCAT(user_details.full_name, ' (Manager)') AS name"),
                'user_details.user_id'
            )
            ->get();
        $manager_id = $manager_array->pluck('name', 'user_id')->toArray();

        $member_ids = CommitteeMember::query()
            ->leftJoin('user_details', 'committee_members.user_id', '=', 'user_details.user_id')
            ->where('committee_members.committee_id', $id)
            ->pluck(
                'user_details.full_name',
                'user_details.user_id'
            )
            ->toArray();
        $data['comiittee_members'] = ($manager_id + $member_ids);
        return view('user/committee.expense', $data);
    }

    public function fundTransferShow($id)
    {
        $data['committeeDetails'] = Committee::with('userData')->findOrFail($id);
        $manager_array = Committee::query()
            ->leftJoin('user_details', 'committees.manager_id', '=', 'user_details.user_id')
            ->where('committees.id', $id)
            ->select(
                DB::raw("CONCAT(user_details.full_name, ' (Manager)') AS name"),
                'user_details.user_id'
            )
            ->get();
        $manager_id = $manager_array->pluck('name', 'user_id')->toArray();

        $member_ids = CommitteeMember::query()
            ->leftJoin('user_details', 'committee_members.user_id', '=', 'user_details.user_id')
            ->where('committee_members.committee_id', $id)
            ->pluck(
                'user_details.full_name',
                'user_details.user_id'
            )
            ->toArray();
        $data['comiittee_members'] = ($manager_id + $member_ids);
        return view('user/committee.fundTransfer', $data);
    }

    public function destroy(Request $request)
    {
        try {
            $id = $request->id;
            DB::beginTransaction();

            $collection = Collection::findOrFail($id);
            $member_id = $collection->member_id;
            $committee_id = $collection->committee_id;
            $amount = $collection->amount;
            $committee = Committee::findOrFail($committee_id);

            if ($committee->manager_id == $member_id) {
                if ($committee->total_balance >= $amount) {
                    $committee->total_balance = $committee->total_balance - $amount;
                    $committee->save();
                } else {
                    return redirect()->back()->with('flashy__danger', __('Insufficient Balance!'));
                }
            } else {
                $members = CommitteeMember::where('user_id', $member_id)
                    ->where('committee_id', $committee_id)->first();
                if ($members->balance >= $amount) {
                    $members->balance = $members->balance - $amount;
                    $members->save();
                } else {
                    return redirect()->back()->with('flashy__danger', __('Insufficient Balance!'));
                }
            }

            $collection->delete();

            DB::commit();
            Session::flash('flashy__success', __('Reverted Successfully!'));
            return back();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withErrors($e->getMessage())
                ->withInput();
        }
    }
    public function getBalanceData($userId, $committeeId)
    {
        return response()->json(Collection::getBalanceData($userId, $committeeId));
    }
}
