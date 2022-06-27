<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Collection extends Model
{
    use HasFactory;
    protected $table = 'collection_histories';

    protected $fillable = [
        'committee_id',
        'member_id',
        'user_id',
        'amount',
        'remarks',
    ];

    public function userData()
    {
        return $this->hasOne(UserDetail::class, 'user_id', 'user_id');
    }

    public function memberData()
    {
        return $this->hasOne(UserDetail::class, 'user_id', 'member_id');
    }

    public static function saveOrUpdate($request, $id = null)
    {
        $requestData = $request->all();
        $amounts = $requestData['amount'];
        $count = count($requestData['user_id']);
        $amount = $amounts / $count;

        if (is_null($id)) {
            if ($requestData['user_id'] > 0) {
                collect($requestData['user_id'])
                    ->map(function ($value) use ($requestData, $amount) {
                        $collection = new Collection;
                        $collection->committee_id = $requestData['committee_id'];
                        $collection->member_id = $requestData['member_id'];
                        $collection->user_id = $value;
                        $collection->amount = $amount;
                        $collection->remarks = $requestData['remarks'];
                        $collection->save();
                    });
                if ($requestData['manager_id'] == $requestData['member_id']) {
                    $committee = Committee::findOrFail($requestData['committee_id']);
                    $committee->total_balance = $committee->total_balance + $requestData['amount'];
                    $committee->save();
                } else {
                    $members = CommitteeMember::where('user_id', $requestData['member_id'])
                        ->where('committee_id', $requestData['committee_id'])->first();
                    $members->balance = $members->balance + $requestData['amount'];
                    $members->save();
                }
            }
        }
    }

    public static function transfer($request, $id = null)
    {
        $requestData = $request->all();

        if (is_null($id)) {

            $committee = Committee::findOrFail($requestData['committee_id']);


            if ($requestData['manager_id'] == $requestData['transfer_from']) {
                $committee->total_balance = $committee->total_balance - $requestData['amount'];
                $committee->save();
            } else {
                $members = CommitteeMember::where('user_id', $requestData['transfer_from'])
                    ->where('committee_id', $requestData['committee_id'])->first();
                $members->balance = $members->balance - $requestData['amount'];
                $members->save();
            }

            if ($requestData['manager_id'] == $requestData['transfer_to']) {
                $committee->total_balance = $committee->total_balance - $requestData['amount'];
                $committee->save();
            } else {
                $members = CommitteeMember::where('user_id', $requestData['transfer_to'])
                    ->where('committee_id', $requestData['committee_id'])->first();
                $members->balance = $members->balance - $requestData['amount'];
                $members->save();
            }
        }
    }

    public static function getBalanceData($userId, $committeeId)
    {
        $committee = Committee::findOrFail($committeeId);
        $member = CommitteeMember::where('user_id', $userId)->where('committee_id', $committeeId)->first();
        if ($committee->manager_id == $userId) {
            $amount = $committee->total_balance;
        } elseif (!empty($member)) {
            $amount = $member->balance;
        }
        return $data['amount'] = $amount;
    }

    public static function checkAccess($id)
    {
        $manager_array = Committee::query()
            ->leftJoin('user_details', 'committees.manager_id', '=', 'user_details.user_id')
            ->where('committees.id', $id)
            ->select(
                DB::raw("CONCAT(user_details.full_name, ' (Manager)') AS name"),
                'user_details.user_id'
            )
            ->get();
        $manager_id = $manager_array->pluck('name', 'user_id')->toArray();

        $member_ids = CommitteeMember::query()
            ->leftJoin('user_details', 'committee_members.user_id', '=', 'user_details.user_id')
            ->where('committee_members.committee_id', $id)
            ->pluck(
                'user_details.full_name',
                'user_details.user_id'
            )
            ->toArray();
        $comiittee_members = ($manager_id + $member_ids);

        $checkAccess = collect($comiittee_members)
            ->contains(function ($value, $key) {
                return $key == Auth::user()->id;
            });
        return $checkAccess;
    }
}
