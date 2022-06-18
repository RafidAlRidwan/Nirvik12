<?php

namespace App\Models;

use App\Models\Shift;
use App\Models\Section;
use App\Models\UserDetail;
use App\Models\MobileNumberDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'type',
        'password',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userDetails()
    {
        return $this->hasOne(UserDetail::class, 'user_id', 'id');
    }

    public function mobileNumberDetails()
    {
        return $this->hasMany(MobileNumberDetail::class, 'user_id', 'id');
    }

    public static function getMasterData($user = null)
    {

        $data['shift_all'] = Shift::all();
        $data['religion'] = [1 => 'Islam', 2 => 'Hinduism', 3 => 'Buddhism', 4 => 'Christianity'];
        $data['marital_status'] = [1 => 'Bachelor', 2 => 'Married'];
        $data['shift'] = Shift::pluck('name', 'id');
        $data['section_all'] = Section::all();
        $data['section'] = Section::pluck('name', 'id');
        $data['acceptedExtensions'] = '.jpg, .jpeg, .gif, .png, .pdf, .doc, .docx, .xls, .xlsx';
        return $data;
    }

    public static function saveOrUpdate($request, $id = null)
    {
        $requestData = $request->all();

        if (is_null($id)) {
            $requestData['password'] = Hash::make($requestData['password']);
            $user = User::create($requestData);
        } else {
            $user = User::findOrFail($id);
            if ($user->exists && (string)$requestData['password'] === $user->password) {
                unset($requestData['password']);
            } else {
                $requestData['password'] = Hash::make($requestData['password']);
            }

            $user->update($requestData);
        }

        UserDetail::saveUserInfo($request->all(), $user->id);
        MobileNumberDetail::saveMobileInfo($request->all(), $user->id);
    }

    public function userCount()
    {
        $data['a'] = User::select('user_details.section as connections')
        ->leftJoin('user_details', 'user_details.user_id', '=', 'users.id')
        ->where('section', 1)
        ->groupBy('users.id')
        ->get();
        $data['b'] = User::select('user_details.section as connections')
        ->leftJoin('user_details', 'user_details.user_id', '=', 'users.id')
        ->where('section', 2)
        ->groupBy('users.id')
        ->get();
        $data['c'] = User::select('user_details.section as connections')
        ->leftJoin('user_details', 'user_details.user_id', '=', 'users.id')
        ->where('section', 3)
        ->groupBy('users.id')
        ->get();
        $data['d'] = User::select('user_details.section as connections')
        ->leftJoin('user_details', 'user_details.user_id', '=', 'users.id')
        ->where('section', 4)
        ->groupBy('users.id')
        ->get();

        return $data;
    }

    public static function getUserIds($id)
    {
        $sql = DB::select("
        SELECT (
            case
            when (sections.name is not null)  then
            CONCAT(user_details.full_name,' (', sections.name,')')
            when (sections.name is null) then 
            CONCAT(user_details.full_name,' (n/a)')
            end 
            )AS full_name,
            users.id as user_id

            FROM users
            LEFT JOIN user_details 
            ON user_details.user_id = users.id
            LEFT JOIN sections
            ON sections.id = user_details.section
            WHERE users.type = 3 AND user_details.user_id != $id
            AND user_details.full_name != 'null' ");
        
        $array=array_map(function($item){
            return (array) $item;
        },$sql);
        $data['user'] = $array;

        return $data['user'];
    }
}
