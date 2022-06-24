<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image;
use File;

class UserDetail extends Model
{
    use HasFactory;
    protected $table = 'user_details';
    public function sectionData()
    {
        return $this->hasOne(Section::class, 'id', 'section');
    }
    protected $fillable = [
        'full_name', 'user_id', 'designation',
        'office_name', 'current_city', 'attachment',
        'current_address', 'section', 'shift', 'roll_no',
        'religion', 'marital_status', 'spouse_name', 'no_of_children',
        'created_at',
        'updated_at'
    ];

    public static function saveUserInfo($inputData, $userId)
    {
        if (!isset($inputData['name']) || empty($inputData['name'])) {
            return;
        }

        if (!empty($inputData['user_details_id'])) {
            $user_details_id = $inputData['user_details_id'];
            $input = UserDetail::findOrFail($user_details_id);
            $input->user_id = $userId;
            $input->full_name = $inputData['full_name'];
            $input->designation = $inputData['designation'];
            $input->office_name = $inputData['office_name'];
            $input->current_city = $inputData['current_city'];
            $input->current_address = $inputData['current_address'];
            $input->section = $inputData['section'];
            $input->shift = $inputData['shift'];
            $input->roll_no = $inputData['roll_no'];
            $input->religion = $inputData['religion'];
            if ($inputData['marital_status'] == 1) {
                $input->marital_status = $inputData['marital_status'];
                $input->spouse_name = NULL;
                $input->number_of_child = NULL;
            } else {
                $input->marital_status = $inputData['marital_status'];
                $input->spouse_name = $inputData['spouse_name'] ?? NULL;
                $input->number_of_child = $inputData['no_of_children'] ?? NULL;
            }

            if (!empty($inputData['attachment'])) {
                $image_path = $input->attachment;
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
                $image = $inputData['attachment'];
                // $unique_date = date_timestamp_get(date_create());
                // $filename = $unique_date . $image->getClientOriginalName();
                // $image_resize = Image::make($image->getRealPath());
                // $image_resize->resize(400, 400);
                // $path = ('assets/user/landingPage/img/profilePicture/');
                $filename = $inputData['attachment'];
                $inputData['attachment'] = $filename;
                $input->attachment = $filename ?? NULL;
            }
            $input->save();

            return;
        } else {

            if (isset($inputData['attachment']) && !empty($inputData['attachment'])) {
                $image = $inputData['attachment'];
                $unique_date = date_timestamp_get(date_create());
                $filename = $unique_date . $image->getClientOriginalName();
                $image_resize = Image::make($image->getRealPath());
                $path = ('assets/user/landingPage/img/profilePicture/');
                $main_path = $path . $filename;
                $image_resize->resize(400, 400);
                $image_resize->save($main_path);
                $inputData['attachment'] = $filename;
            }

            UserDetail::create([
                'user_id' => $userId,
                'full_name' => $inputData['full_name'] ?? NULL,
                'designation' => $inputData['designation'] ?? NULL,
                'office_name' => $inputData['office_name'] ?? NULL,
                'current_city' => $inputData['current_city'] ?? NULL,
                'current_address' => $inputData['current_address'] ?? NULL,
                'section' => $inputData['section'] ?? NULL,
                'shift' => $inputData['shift'] ?? NULL,
                'roll_no' => $inputData['roll_no'] ?? NULL,
                'religion' => $inputData['religion'] ?? NULL,
                'marital_status' => $inputData['marital_status'] ?? NULL,
                'spouse_name' => $inputData['spouse_name'] ?? NULL,
                'number_of_child' => $inputData['no_of_children'] ?? NULL,
                'attachment' => $filename ?? NULL
            ]);
        }
    }
}
