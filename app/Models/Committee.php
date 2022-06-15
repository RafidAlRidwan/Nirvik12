<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Committee extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'event_id',
        'manager_id',
        'total_balance',
        'total_expense',
    ];

    public function userData()
    {
        return $this->hasOne(UserDetail::class, 'user_id', 'manager_id');
    }

    public function eventData()
    {
        return $this->hasOne(Event::class, 'id', 'event_id');
    }

    public function memberData()
    {
        return $this->hasMany(CommitteeMember::class, 'committee_id', 'id');
    }

    public static function getMasterData($committee = null)
    {

        $data['user'] = User::query()
        ->leftJoin('user_details', 'users.id', '=', 'user_details.user_id')
        ->where('users.type', 3)
        ->whereNotNull('user_details.full_name')
        ->pluck(
            'user_details.full_name',
            'user_details.user_id'
            )
        ->toArray();
        $data['events'] = Event::whereDate('date', '>=', date('Y-m-d'))->pluck('title', 'id');
        return $data;
    }

    public static function getMemberData($committee){
        $members = $committee->memberData;
        $data = $members->pluck('user_id');
        return $data;
    }

    public static function saveOrUpdate($request, $id = null)
    {
        $requestData = $request->all();
        if (is_null($id)) {
            $committee = Committee::create($requestData);
        } else {
            $committee = Committee::findOrFail($id);
            $committee->update($requestData);
        }

        if($requestData['member_id'] > 0){
            
            // Add / Update
            $memberData = collect($requestData['member_id'])
            ->map(function ($value) use ($committee) {
                $item = [];
                $memberId = CommitteeMember::where('user_id', $value)
                ->where('committee_id', $committee->id)->first();
                $item['id'] = $memberId ? $memberId['id'] : null;
                $item['committee_id'] = $committee->id;
                $item['user_id'] = $value;
                return $item;
            })->toArray();

            $array = collect($memberData)
            ->map(function ($value) {
                $member = CommitteeMember::findOrNew($value['id']);
                $member['committee_id'] = $value['committee_id'];
                $member['user_id'] = $value['user_id'];
                $member->save();
                return $member;
            })->toArray();

            //  Delete
            if($array[0]['id'] !== null)
            {
                $delete_members = [];
                $member = $requestData['member_id'] ?? [];
                $model = new CommitteeMember;
                
                $ids = collect($member)->map(function ($value) use ($model, $committee) {
                            $item =  $model->where('committee_id', $committee->id)->where('user_id', $value)->first();
                            return $item->id;
                    })->toArray();
                
                $member_with_ids = collect($ids)->map(function ($value) {
                        $item =  [];
                        $item['id'] = $value;
                        return $item;
                    })->toArray();

                $members = CommitteeMember::where('committee_id', $committee->id)->get();
                $delete_members = collect($members)
                    ->map(function ($value) use ($member_with_ids) {
                        if (!(in_array($value['id'], array_column($member_with_ids, 'id')))) {
                            $deleteMember = CommitteeMember::where('id', $value['id'])->first();
                            $deleteMember->delete();
                        }
                    return $value;
                });
            }
        }
    }


}

