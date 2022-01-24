<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Session;
use Redirect;
use validate;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkAdmin');
    }
    public function index()
    {
        return view('admin/user.index');
    }

    public function user_datatable(Request $request)
    {

        $searchString = $request->search['value'];
        $product_data = User::query()
            ->leftJoin('user_details AS ud', 'ud.user_id', '=', 'users.id')
            ->leftJoin('sections', 'ud.section', '=', 'sections.id')
            ->leftJoin('shifts', 'ud.shift', '=', 'shifts.id')
            ->whereNotIn('users.type', [1])
            ->select(
                'ud.*',
                "users.id as uid",
                "users.type",
                "users.name",
                "users.type as userType",
                "sections.name AS section_name",
                "shifts.name AS shift_name",
            );
        // dd($product_data->get());

        if (isset($request->section) && $request->section > 0) {
            if ($request->section == "Select All Section") {
                $product_data->where('users.type', '>', 2);
            } else {
                $product_data->where('sections.name', $request->section);
            }
        }
        if (isset($request->shift) && $request->shift > 0) {
            if ($request->shift == "Select All Shift") {
                $product_data->where('users.type', '>', 2);
            } else {
                $product_data->where('shifts.name', $request->shift);
            }
        }

        if (isset($request->name) && $request->name > 0) {
            $product_data->where('full_name', 'LIKE', '%' . $request->name . '%');
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

            if ($item['shift_name'] == 'Morning') {
                $class = "badge-danger rounded p-1";
                $shift = 'Morning';
            } elseif ($item['shift_name'] == 'Day') {
                $class = "badge-success rounded p-1";
                $shift = 'Day';
            } else {
                $class = "";
                $shift = '';
            }
            $editURL = URL::to('admin/user/edit' . '/' . $item->uid);
            if (!empty($item->attachment)) {
                $img = URL::to('assets/user/landingPage/img/profilePicture' . '/' . $item->attachment);
            } else {
                $img = URL::to('assets/user/landingPage/img/profilePicture/demo.jpg');
            }
            $data['data'][$sl]['serial'] = $serial;
            $data['data'][$sl]['pp'] = "<img style='border: 1px solid #ddd; border-radius:50%; width: 45px; height:45px; ' src='$img' alt='pp' class='responsive'>";
            $data['data'][$sl]['username'] = "<b class='text-primary'>$item->name</b>";
            $data['data'][$sl]['name'] = "<b class='text-primary'>$item->full_name</b>";
            $data['data'][$sl]['city'] = $item->current_city ?? "";
            $data['data'][$sl]['section'] = $item->section_name;
            $data['data'][$sl]['shift'] = "<span class='$class'>$shift</span>";
            if ($item->userType == 2) {
                $data['data'][$sl]['action'] = "
                <a class='user_delete' href='$item->uid' data-toggle='modal' data-target='#user-delete' style='border: none; background: none;' ><i class='fa fa-trash'></i> </a>";
            } else {
                $data['data'][$sl]['action'] = "<a href='$editURL'><i class='fa fa-edit' style='font-size:14px; ''></i></a>
                |
                <a class='user_delete' href='$item->uid' data-toggle='modal' data-target='#user-delete' style='border: none; background: none;' ><i class='fa fa-trash'></i> </a>";
            }

            $sl++;
            $serial++;
        }


        echo json_encode($data);
        die();
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $data = User::getMasterData($user);
        $data['user'] = $user;

        $user_details = $user->userDetails()->get();
        $data['user_details'] = $user_details;
        $data['mobile_details'] = $user->mobileNumberDetails()->get();
        if (!$data['user_details']->isEmpty()) {
            $data['user_details'] = $user_details[0];
        }
        return view('admin/user.edit', $data);
    }

    public function destroy(Request $request)
    {
        // dd($request->all());
        try {
            $id = $request->user_id;
            // dd($id);
            DB::beginTransaction();
            UserDetail::where('user_id', $id)->delete();
            User::where('id', $id)->delete();
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
