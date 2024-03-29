<?php

namespace App\Http\Controllers\Api;

use Auth;
use Redirect;
use validate;
use Response;
use App\Models\User;
use App\Models\Shift;
use App\Models\Section;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        Session::put('userName', $user->name);
        // dd(Session::get('userName'));

        $cache = Cache::get('settings');
        if (empty($cache)) {
            Cache::rememberForever('settings', function () {
                return DB::table('settings')->get();
            });
        }

        if ($user->type == 3) {
            $data = User::getMasterData();
            return view('user/user.index', $data);
        } else {
            $user = new User;
            $data = $user->userCount();
            return view('admin/dashboard.index', $data);
        }
    }



    public function create()
    {
        $data = User::getMasterData();
        return view('user/user.create', $data);
    }

    public function store(Request $request)
    {

        try {
            $this->validate($request, [
                'name' => ['required', 'string', 'max:10', 'unique:users,name'],
                'password' => ['required', 'min:4']

            ]);
            DB::beginTransaction();
            User::saveOrUpdate($request);
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

    public function contact_datatable(Request $request)
    {
        $searchString = $request->search['value'];
        $product_data = User::where('type', '>', 2)
            ->leftJoin('user_details AS ud', 'ud.user_id', '=', 'users.id')
            ->leftJoin('sections', 'ud.section', '=', 'sections.id')
            ->leftJoin('shifts', 'ud.shift', '=', 'shifts.id')
            ->leftJoin('mobile_number_details as mn', 'mn.user_id', '=', 'users.id')
            ->where('ud.full_name', '!=', '')
            ->select(
                DB::raw(DB::raw('group_concat(mn.mobile) as mobiles')),
                'ud.full_name',
                'ud.current_city',
                'ud.user_id',
                'users.type',
                'users.id',
                "sections.name AS section_name",
                "shifts.name AS shift_name",
            )
            ->groupBy('users.id');

        if (!empty($request->section)) {
            if ($request->section == "Select All Section") {
                $product_data->where('users.type', '>', 2);
            } else {
                $product_data->where('sections.name', $request->section);
            }
        }
        if (!empty($request->shift)) {
            if ($request->shift == "Select All Shift") {
                $product_data->where('users.type', '>', 2);
            } else {
                $product_data->where('shifts.name', $request->shift);
            }
        }

        if (!empty($request->name)) {
            $product_data->where('ud.full_name', 'LIKE', '%' . $request->name . '%');
        }



        $data['recordsTotal'] = $product_data->count();
        $data['recordsFiltered'] = $product_data->count();
        $product_data->limit($request->length)->offset($request->start);
        $product_data_list = $product_data->get();
        $data['draw'] = $request->draw;
        $data['data'] = array();
        $sl = 0;
        $seriel = 1;



        foreach ($product_data_list as $item) {

            if ($item['shift_name'] == 'Morning') {
                $class = "badge-danger";
                $shift = 'Morning';
            } else {
                $class = "badge-success";
                $shift = 'Day';
            }
            $viewURL = URL::to('user/my-profile/show' . '/' . $item->id);
            if (!empty($item->attachment)) {
                $img = URL::to('assets/user/landingPage/img/profilePicture' . '/' . $item->attachment);
            } else {
                $img = URL::to('assets/user/landingPage/img/profilePicture/demo.jpg');
            }

            $data['data'][$sl]['pp'] = "<img style='border: 1px solid #ddd; border-radius:50%; width: 45px; height:45px; ' src='$img' alt='pp' class='responsive'>";
            $data['data'][$sl]['name'] = "<a href='$viewURL'><b class='text-primary'>$item->full_name</b></a>";
            $data['data'][$sl]['mobile'] = $item->mobiles;
            $data['data'][$sl]['city'] = $item->current_city ?? "";
            $data['data'][$sl]['section'] = $item->section_name;
            $data['data'][$sl]['shift'] = "<span class='$class'>$shift</span>";
            $data['data'][$sl]['action'] = "<button class='btn btn-sm btn-custom'><a href='$viewURL'>View</a></button>";

            $sl++;
        }

        return response()->json($data);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        $data = User::getMasterData($user);
        $data['user'] = $user;

        $data['user_details'] = $user->userDetails()->get();
        $data['mobile_details'] = $user->mobileNumberDetails()->get();

        return view('user/user.my-profile', $data);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $data = User::getMasterData($user);
        $data['user'] = $user;

        $data['user_details'] = $user->userDetails()->first();
        $data['mobile_details'] = $user->mobileNumberDetails()->get();

        return view('user/user.edit', $data);
    }

    public function edit_password($id)
    {
        $user = User::findOrFail($id);
        $data = User::getMasterData($user);
        $data['user'] = $user;
        $data['user_details'] = $user->userDetails()->get();

        return view('user/user.edit-password', $data);
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        try {

            $this->validate($request, [
                'name' => 'required',

            ]);
            DB::beginTransaction();

            User::saveOrUpdate($request, $id);
            DB::commit();
            Session::flash('flashy__success', __('Updated Successfully!'));
            return redirect()->route('myProfile', Auth::user()->id);
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->withErrors($e->getMessage())
                ->withInput($request->all);
        }
    }

    public function update_password(Request $request, $id)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required | max:8',
            'new_password' => 'required | max:8'

        ]);
        $requestData = $request->all();
        DB::beginTransaction();
        $user = User::findOrFail($id);

        if (!empty($requestData['old_password'])) {

            if (!Hash::check($requestData['old_password'], $user->password)) {
                Session::flash('flashy__danger', __('Old Password Incorrect!'));
                return back();
            } else {
                $requestData['password'] = Hash::make($requestData['password']);
                $user->update($requestData);
                DB::commit();
                Session::flash('flashy__success', __('Password Updated Successfully!'));
                return redirect()->route('myProfile', Auth::user()->id);
            }
        }
    }

    public function admin_index()
    {
        return view('admin/user.index');
    }

    public function imageUpload(Request $request)
    {
        if (!empty($request->image)) {

            $image_array_1 = explode(";", $request->image);

            $image_array_2 = explode(",", $image_array_1[1]);

            $data = base64_decode($image_array_2[1]);

            $imageName = 'assets/user/landingPage/img/profilePicture/' . time() . '.jpg';
            file_put_contents($imageName, $data);

            return $imageName;
        }
    }

    public function getData()
    {
        return datatables(User::all())->make(true);
    }
}
