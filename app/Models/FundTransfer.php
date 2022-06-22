<?php

namespace App\Models;

use Session;
use App\Models\Committee;
use App\Models\CommitteeMember;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FundTransfer extends Model
{
    use HasFactory;

    protected $fillable = [
        'committee_id',
        'transfer_from',
        'transfer_to',
        'amount',
        'remarks',
    ];

    public function transferFromUserData()
    {
        return $this->hasOne(UserDetail::class, 'user_id', 'transfer_from');
    }

    public function transferToUserData()
    {
        return $this->hasOne(UserDetail::class, 'user_id', 'transfer_to');
    }

    public static function saveOrUpdate($requestData, $id = null)
    {

        if (is_null($id)) {

            $committee = Committee::findOrFail($requestData['committee_id']);
            

            if($requestData['manager_id'] == $requestData['transfer_from'])
            {
                $committee->total_balance = $committee->total_balance - $requestData['amount'];
                $committee->save();
            } else {
                $members = CommitteeMember::where('user_id', $requestData['transfer_from'])
                ->where('committee_id', $requestData['committee_id'])->first();
                $members->balance = $members->balance - $requestData['amount'];
                $members->save();
            }

            if($requestData['manager_id'] == $requestData['transfer_to'])
            {
                $committee->total_balance = $committee->total_balance + $requestData['amount'];
                $committee->save();
            } else {
                $members = CommitteeMember::where('user_id', $requestData['transfer_to'])
                ->where('committee_id', $requestData['committee_id'])->first();
                $members->balance = $members->balance + $requestData['amount'];
                $members->save();
            }
            
            $fundTransfer = new FundTransfer;
            $fundTransfer->committee_id = $requestData['committee_id'];
            $fundTransfer->transfer_from = $requestData['transfer_from'];
            $fundTransfer->transfer_to = $requestData['transfer_to'];
            $fundTransfer->amount = $requestData['amount'];
            $fundTransfer->remarks = $requestData['remarks'];
            $fundTransfer->save();
        }

    }
}
