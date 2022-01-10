<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MobileNumberDetail extends Model
{
    use HasFactory;
    protected $table = 'mobile_number_details';

    protected $fillable = [
        'user_id',
        'mobile',
        'created_at',
        'updated_at'
    ];

    public static function saveMobileInfo($inputData, $userId)
    {
        if (!isset($inputData['mobile']) || empty($inputData['mobile'])) {
            return;
        }
        MobileNumberDetail::where('user_id', $userId)->delete();

        foreach ($inputData['mobile'] as $key => $item) {
            MobileNumberDetail::create([
                'user_id' => $userId,
                'mobile' => $item

            ]);
        }
    }
}
