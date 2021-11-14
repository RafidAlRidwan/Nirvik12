<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\UserDetail;
use App\Models\MobileNumberDetail;
use Illuminate\Support\Facades\Hash;
use App\Models\Shift;
use App\Models\Section;

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
        return $this->hasOne(UserDetail::class, 'user_id' , 'id');
    }

    public function mobileNumberDetails()
    {
        return $this->hasMany(MobileNumberDetail::class, 'user_id' , 'id');
    }

    public static function getMasterData($user = null)
    {

        $data['shift_all'] = Shift::all();
        $data['shift'] = Shift::pluck('name','id');
        $data['section_all'] = Section::all();
        $data['section'] = Section::pluck('name','id');
        $data['acceptedExtensions'] ='.jpg, .jpeg, .gif, .png, .pdf, .doc, .docx, .xls, .xlsx';
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
            if(!empty($requestData['password'])){
                $requestData['password'] = Hash::make($requestData['password']);
            }   
            $user->update($requestData);
        }

        UserDetail::saveUserInfo($request->all(), $user->id);
        MobileNumberDetail::saveMobileInfo($request->all(), $user->id);
    }
}