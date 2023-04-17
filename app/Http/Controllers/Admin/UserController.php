<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Session;
use Redirect;
use validate;
use App\Models\User;
use App\Mail\SendEmail;
use App\Models\Section;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use App\Models\MobileNumberDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $emails = User::pluck('email', 'id')->toArray();
        return view('admin/user.index', compact('emails'));
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
            $viewURL = URL::to('admin/user/show' . '/' . $item->uid);
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
            $data['data'][$sl]['shift'] = "<span style='font-size:11px;' class='$class'>$shift</span>";
            if ($item->userType == 2) {
                $data['data'][$sl]['action'] = "
                <a class='user_delete' href='$item->uid' data-toggle='modal' data-target='#user-delete' style='border: none; background: none;' ><i class='fa fa-trash'></i> </a>";
            } else {
                $data['data'][$sl]['action'] = "<a href='$editURL'><i class='fa fa-edit' style='font-size:14px; ''></i></a>
                | <a href='$viewURL'><i class='fa fa-eye' style='font-size:14px; ''></i></a>
                | <a class='user_delete' href='$item->uid' data-toggle='modal' data-target='#user-delete' style='border: none; background: none;' ><i class='fa fa-trash'></i> </a>";
            }

            $sl++;
            $serial++;
        }


        echo json_encode($data);
        die();
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:10', 'unique:users,name'],
            'password' => ['required', 'min:4']
        ]);
        $this->saveData($request);
        Session::flash('flashy__success', __('Saved Successfully!'));

        // Redirect to edit mode.
        return Redirect::back();
    }
    public static function saveData($request)
    {
        $requestData = $request->all();
        $requestData['password'] = Hash::make($requestData['password']);
        $requestData['email'] = $request->name . '@gmail.com';
        $user = User::create($requestData);
        UserDetail::create([
            'user_id' => $user->id,
            'full_name' => $request->name,
            'email' => $request->name . '@gmail.com',
        ]);
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

    public function update(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'name' => 'required',
            ]);
            User::saveOrUpdate($request, $id);
            DB::commit();
            Session::flash('flashy__success', __('Updated Successfully!'));
            return back();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->withErrors($e->getMessage())
                ->withInput($request->all);
        }
    }

    public function show($id)
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
        return view('admin/user.view', $data);
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

    public function sendEmail(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'message' => 'required',
            'type' => 'required',
        ]);
        if ($request->type == 0) {
            return redirect()->back()->with('flashy__info', __('Please Select Email type!'));
        }
        if ($request->type == 1) {
            $emails = collect(User::whereNotNull('email')->get())->map(function ($item) {
                return $item->email;
            })->toArray();
        }
        if ($request->type == 2 && !empty($request->emails)) {
            $emails = collect(User::whereNotNull('email')->whereIn('id', $request->emails)->get())->map(function ($item) {
                return $item->email;
            })->toArray();
        }
        if ($request->type == 2 && empty($request->emails)) {
            return redirect()->back()->with('flashy__info', __('Please Select Email'));
        }

        $details = [
            'title' => $request->title,
            'body' => $request->message,
        ];
        Mail::to($emails)->send(new SendEmail($details));

        return redirect()->back()->with('flashy__success', __('Email Sent!'));
    }

    public function importPost(Request $request)
    {
        dd($request->all());
        $this->validate($request, [
            'excel_file' => 'required|mimes:csv,txt'
        ]);

        $file = $_FILES["excel_file"]["tmp_name"];
        $fileLength = $_FILES["excel_file"]["size"];

        $fileOpen = fopen($file, "r");
        $row = 1;
        while (($csv = fgetcsv($fileOpen, $fileLength, ",")) !== false) {
            try {
                if ($row !== 1) {
                    if ($csv[0] != '' && $csv[4] != '') {
                        $districtName = $csv[2];
                        $districtFind = DB::table('districts')->where('name', $districtName)->first();

                        if ($districtFind) {
                            $upazilaName = $csv[3];
                            $upazilaFind = DB::table('upazilas')->where('name', $upazilaName)->first();
                            if ($upazilaFind === null) {
                                $upazilaId = DB::table('upazilas')->insertGetId([
                                    'district_id' => $districtFind->id,
                                    'name' => $upazilaName,
                                    'bn_name' => $upazilaName,
                                    'url' => $upazilaName,
                                ]);
                            } else {
                                $upazilaId = $upazilaFind->id;
                            }

                            // $checkDuplicate = DB::table('uddokta_locators')
                            //     ->where('district_id', $districtFind->id)
                            //     ->where('upazila_id', $upazilaId)
                            //     ->where('address_english', $csv[4])
                            //     ->where('title_english', $csv[0])->first();
                            // if (!$checkDuplicate) {
                            DB::table('uddokta_locators')->insert([
                                'title_english' => $csv[0],
                                'district_id'     => $districtFind->id,
                                'upazila_id'    => $upazilaId,
                                'title_bangla'    => $csv[1],
                                'address_english'    => $csv[4],
                                'address_bangla'    => $csv[5],
                                'lat'    => $csv[6] != '' ? $csv[6] : 0,
                                'lon'    => $csv[7] != '' ? $csv[7] : 0
                            ]);
                            // }
                        }
                    }
                }
                ++$row;
            } catch (\Exception $e) {
                dd($e);
            }
        }
        // return redirect()->route('administrative.distributor-locator')->with('success', 'Imported Successfully');
        return redirect()->back()->with('success', 'File has been uploaded successfully.');
    }

    public function insertData()
    {
        $section = Section::all();
        foreach ($section as $item) {
            for ($start = 1; $start <= 70; $start++) {
                if ($item->id == 1) {
                    $shift = 1;
                    $prefix = 'a';
                }
                if ($item->id == 2) {
                    $shift = 1;
                    $prefix = 'b';
                }
                if ($item->id == 3) {
                    $shift = 2;
                    $prefix = 'c';
                }
                if ($item->id == 4) {
                    $shift = 2;
                    $prefix = 'd';
                }
                $user = new User;
                $userData = [];
                $userData['name'] = $prefix . $start;
                $userData['email'] = $prefix . $start . '@gmail.com';
                $userData['password'] = bcrypt('1234');
                $userData['type'] = 3;
                $user = $user->create($userData);

                $details = new UserDetail;
                $details->user_id = $user->id;
                $details->full_name = $user->name;
                $details->email = $user->email;
                $details->section = $item->id;
                $details->shift = $shift;
                $details->roll_no = $start;
                $details->save();
            }
        }

        return back();
    }
}
