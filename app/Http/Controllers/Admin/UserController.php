<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use URL;
use Session;
use Redirect;
use validate;
use Auth;
use DB;

class UserController extends Controller
{
    public function index(){
        return view('admin/user.index');
    }

    public function user_datatable(Request $request){

            $searchString = $request->search['value'];
            $product_data = User::query()
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
            $data['data'][$sl]['serial'] = $seriel ;
            $data['data'][$sl]['pp'] = "<img style='border: 1px solid #ddd; border-radius:50%; width: 45px; height:45px; ' src='$img' alt='pp' class='responsive'>";
            $data['data'][$sl]['name'] = "<b class='text-primary'>$item->name</b>" ;
            $data['data'][$sl]['city'] = $item->current_city ?? "" ;
            $data['data'][$sl]['section'] =$item->section_name ;
            $data['data'][$sl]['shift'] ="<span class='$class'>$shift</span>";
            
             $sl++;
             $seriel++;
           }


           echo json_encode($data);
           die();

    }
}
