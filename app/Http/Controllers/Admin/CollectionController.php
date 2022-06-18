<?php

namespace App\Http\Controllers\Admin;

use URL;
use Session;
use Redirect;
use App\Models\Committee;
use Illuminate\Http\Request;
use App\Models\CommitteeMember;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Collection;
use App\Models\Expense;
use App\Models\FundTransfer;

class CollectionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkAdmin');
    }

    public function datatable(Request $request, $id)
    {
        $searchString = $request->search['value'];
        $product_data = Collection::where('committee_id',$id)->with('userData', 'memberData');

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
            $data['data'][$sl]['action'] = "
                <a class='collection_delete' href='$item->id' data-toggle='modal' data-target='#collection_delete_modal' style='border: none; background: none;' > <button class='btn btn-danger btn-sm'>Revert</button> </a>";

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
                'committee_id' => ['required'],
                'member_id' => ['required'],
                'user_id' => ['required'],
                'amount' => ['required'],
            ]);
            DB::beginTransaction();
            Collection::saveOrUpdate($request);
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

            if($committee->manager_id == $member_id)
            {
                if($committee->total_balance >= $amount){
                    $committee->total_balance = $committee->total_balance - $amount;
                    $committee->save();
                }else{
                    return redirect()->back()->with('flashy__danger', __('Insufficient Balance!'));
                }
                
            } else {
                $members = CommitteeMember::where('user_id', $member_id)
                ->where('committee_id', $committee_id)->first();
                if( $members->balance >= $amount){
                    $members->balance = $members->balance - $amount;
                    $members->save();
                }else{
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

    public function transfer(Request $request)
    {
        try {
            $requestData = $request->all();

            if($requestData['transfer_from'] == $requestData['transfer_to'])
            {
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

    public function getBalanceData($userId, $committeeId)
    {
        return response()->json(Collection::getBalanceData($userId, $committeeId));
    }

    public function transfer_datatable(Request $request, $id)
    {
        $searchString = $request->search['value'];
        $product_data = FundTransfer::where('committee_id',$id)->with('transferFromUserData', 'transferToUserData');

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

    public function fundDestroy(Request $request)
    {
        try {
            $id = $request->id;
            DB::beginTransaction();
            
            $fund = FundTransfer::findOrFail($id);
            $committeeData = Committee::findOrFail($fund->committee_id);

            if($committeeData->manager_id == $fund->transfer_from)
            {
                $committeeData->total_balance = $committeeData->total_balance + $fund->amount;
                $committeeData->save();
            } else {
                $members = CommitteeMember::where('user_id', $fund->transfer_from)
                ->where('committee_id', $fund->committee_id)->first();
                $members->balance = $members->balance + $fund->amount;
                $members->save();
            }

            if($committeeData->manager_id == $fund->transfer_to)
            {
                $committeeData->total_balance = $committeeData->total_balance - $fund->amount;
                $committeeData->save();
            } else {
                $members = CommitteeMember::where('user_id', $fund->transfer_to)
                ->where('committee_id', $fund->committee_id)->first();
                $members->balance = $members->balance - $fund->amount;
                $members->save();
            }

            $fund->delete();

            DB::commit();
            return redirect()->back()->with('flashy__success', __('Reverted Successfully!'));
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
            if($committee->total_balance >= $requestData['amount']){
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

    public function expense_datatable(Request $request, $id)
    {
        $searchString = $request->search['value'];
        $product_data = Expense::where('committee_id',$id)->with('managerData');

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
                <a class='fund_delete' href='$item->id' data-toggle='modal' data-target='#fund_transfer_delete_modal' style='border: none; background: none;' > <button disabled class='btn btn-danger btn-sm'>Revert</button> </a>";

            $sl++;
            $serial++;
        }
        echo json_encode($data);
        die();
    }
}
