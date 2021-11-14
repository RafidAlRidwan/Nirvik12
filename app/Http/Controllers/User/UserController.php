<?php

namespace App\Http\Controllers\User;

use URL;
use Auth;
use Redirect;
use validate;
use App\Models\User;
use App\Models\Shift;
use App\Models\Section;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function __construct(){
    $this->middleware('auth');
  }
    public function index(){
        if(Auth::user()->type == 3){
            $data = User::getMasterData();
            return view ('user/user.index', $data);
        }
        elseif(Auth::user()->type == 1){
            return view('admin/dashboard.index');
        }
        else{
            $data = User::getMasterData();
            return view('user/user.index' , $data);
        }
        
    }

    

    public function create(){
        $data = User::getMasterData();
    	return view ('user/user.create' , $data);
    }

    public function store(Request $request){
          
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

    public function contact_datatable(Request $request){

            $searchString = $request->search['value'];
            $product_data = User::where('type', '>', 2)
                        ->leftJoin('user_details AS ud', 'ud.user_id', '=', 'users.id')
                        ->leftJoin('sections', 'ud.section', '=', 'sections.id')
                        ->leftJoin('shifts', 'ud.shift', '=', 'shifts.id')
                        ->select('ud.*',
                            "users.type",
                            "sections.name AS section_name",
                            "shifts.name AS shift_name",
                        );
            // dd($product_data->get());

            if (isset($request->section) && $request->section > 0) {
                if($request->section == "Select All Section" ){
                     $product_data->where('users.type', '>' , 2);
                }
                else{
                    $product_data->where('sections.name', $request->section);
                }
            
            }
            if (isset($request->shift) && $request->shift > 0) {
                if($request->shift == "Select All Shift" ){
                     $product_data->where('users.type', '>' , 2);
                }
                else{
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
            $sl=0;
            $seriel=1;



           foreach($product_data_list as $item){
                
                if($item['shift_name'] == 'Morning'){
                    $class = "badge-danger";
                    $shift = 'Morning';
                }else{
                   $class = "badge-success";
                   $shift = 'Day';
              }
            if(!empty($item->attachment)){
                $img = URL::to('assets/user/landingPage/img/profilePicture'.'/'.$item->attachment);
            }
            else{
                $img = URL::to('assets/user/landingPage/img/profilePicture/demo.jpg');
            }
            
            $data['data'][$sl]['pp'] = "<img style='border: 1px solid #ddd; border-radius:50%; width: 45px; height:45px; ' src='$img' alt='pp' class='responsive'>";
            $data['data'][$sl]['name'] = "<b class='text-primary'>$item->full_name</b>" ;
            $data['data'][$sl]['city'] = $item->current_city ?? "" ;
            $data['data'][$sl]['section'] =$item->section_name ;
            $data['data'][$sl]['shift'] ="<span class='$class'>$shift</span>";
            
             $sl++;
           }


           echo json_encode($data);
           die();

    }

    public function show($id){
        $user = User::findOrFail($id);
        $data = User::getMasterData($user);
        $data['user'] = $user;
        
        $data['user_details'] = $user->userDetails()->get();
        $data['mobile_details'] = $user->mobileNumberDetails()->get();
        return view ('user/user.my-profile' , $data);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $data = User::getMasterData($user);
        $data['user'] = $user;
        
        $data['user_details'] = $user->userDetails()->get();
        $data['mobile_details'] = $user->mobileNumberDetails()->get();

        
        // dd($data['user']);

        return view('user/user.edit', $data);
    }

    public function edit_password($id)
    {
        $user = User::findOrFail($id);
        $data = User::getMasterData($user);
        $data['user'] = $user;
        
        $data['user_details'] = $user->userDetails()->get();

        
        // dd($data['user']);

        return view('user/user.edit-password', $data);
    }

    public function update(Request $request, $id)
    {
        // return $request->all();
        try {

            $this->validate($request, [
            'name' => 'required',
            'password' => 'required'
                
        ]);
            DB::beginTransaction();
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

    public function update_password(Request $request, $id)
    {
        // return $request->all();
            $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required | max:8'
                
        ]);
            $requestData = $request->all();
            DB::beginTransaction();
            $user = User::findOrFail($id);
            
            if(!empty($requestData['old_password'])){
                
                if (!Hash::check($requestData['old_password'], $user->password)) {
                    Session::flash('flashy__danger', __('Old Password Incorrect!'));
                    return back();
                }else{
                    $requestData['password'] = Hash::make($requestData['password']);
                    $user->update($requestData);
                    DB::commit();
                    Session::flash('flashy__success', __('Password Updated Successfully!'));
                    return back();
                }

            }
    }

    public function admin_index(){

            return view('admin/user.index');
        }
    

}