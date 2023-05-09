<?php

namespace App\Http\Controllers\User;

use URL;
use Redirect;
use validate;
use App\Models\News;
use App\Models\Gallery;
use App\Models\Section;
use App\Models\Committee;
use App\Models\Collection;
use Illuminate\Http\Request;
use App\Models\CommitteeMember;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\TrendingNews;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class LandingPageController extends Controller
{
    public function index()
    {
        $news = TrendingNews::get()->first();
        $current_date = date("Y-m-d");
        $events = Event::whereDate('date', '>', $current_date)->orderBy('date', 'asc')->first();
        $eventDate = $events['date'];
        return view('user/landing-page.index', compact('news', 'eventDate'));
    }
    public function event()
    {
        $current_date = date("Y-m-d");
        $events = Event::whereDate('date', '>=', $current_date)->orderBy('date', 'asc')->latest()->paginate(5);
        return view('user/landing-page.event', compact('events'));
    }
    public function news()
    {
        $news = News::latest()->paginate(5);
        return view('user/landing-page.news', compact('news'));
    }

    public function album()
    {
        return view('user/landing-page.album');
    }
    public function gallery($id)
    {
        if ($id != 0) {
            $data['gallery'] = Gallery::where('album_id', $id)->get();
        } else {
            $data['gallery'] = Gallery::where('album_id', '=', NULL)->get();
        }
        // dd($data['gallery']);
        return view('user/landing-page.gallery', $data);
    }
    public function committee()
    {
        return view('user/landing-page.committee');
    }
    public function datatable(Request $request)
    {
        $searchString = $request->search['value'];
        $product_data = Committee::with('userData', 'eventData');

        $data['recordsTotal'] = $product_data->count();
        $data['recordsFiltered'] = $product_data->count();
        $product_data->limit($request->length)->offset($request->start);
        $product_data_list = $product_data->get();
        $data['draw'] = $request->draw;
        $data['data'] = array();
        $sl = 0;
        $serial = 1;

        foreach ($product_data_list as $item) {

            $members = CommitteeMember::where('committee_id', $item->id)->get();

            $count_member = count($members);
            if ($item->type == 1) {
                $viewURL = URL::to('public/committee/details' . '/' . $item->id);
            } else {
                $viewURL = URL::to('public/committee/others' . '/' . $item->id);
            }

            $data['data'][$sl]['serial'] = $serial;
            $data['data'][$sl]['event_name'] = $item->eventData->title ?? "";
            $data['data'][$sl]['committee_name'] = $item->name ?? "";
            $data['data'][$sl]['manager_name'] = $item->userData->full_name ?? "";
            $data['data'][$sl]['total_member'] = $count_member ?? 0;
            $data['data'][$sl]['action'] = "<a class='committee_setting' href='$viewURL' data-toggle='tooltip' data-placement='top' title='Tooltip on top'><i class='fa fa-cogs' style='font-size:14px;'></i> </a>
                ";

            $sl++;
            $serial++;
        }


        echo json_encode($data);
        die();
    }
    public function registrationDatatable(Request $request, $id)
    {
        $searchString = $request->search['value'];
        $product_data = Collection::where('committee_id', $id)->with('userData');
        if (!empty($request->section)) {
            if ($request->section == 0) {
                $product_data = $product_data;
            } else {
                $product_data->whereRelation('userData', 'section', '=', $request->section);
            }
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

            $date = date('d M, Y', strtotime($item->created_at));
            $data['data'][$sl]['serial'] = $serial;
            $data['data'][$sl]['name'] = $item->userData->full_name ?? "-";
            $data['data'][$sl]['section'] = $item->userData->sectionData->name ?? "-";
            $data['data'][$sl]['status'] = "<span class='badge badge-success'>Paid</span>";

            $sl++;
            $serial++;
        }
        echo json_encode($data);
        die();
    }
    public function collectionShow($id)
    {
        $data['committeeDetails'] = Committee::with('userData')->findOrFail($id);
        $manager_array = Committee::query()
            ->leftJoin('user_details', 'committees.manager_id', '=', 'user_details.user_id')
            ->where('committees.id', $id)
            ->select(
                DB::raw("CONCAT(user_details.full_name, ' (Manager)') AS name"),
                'user_details.user_id'
            )
            ->get();
        $sql = DB::select("
        SELECT (
            case
            when (sections.name is not null)  then
            CONCAT(user_details.full_name,' (', sections.name,')')
            when (sections.name is null) then 
            CONCAT(user_details.full_name,' (n/a)')
            end 
            )AS name,
            users.id

            FROM users
            LEFT JOIN user_details 
            ON user_details.user_id = users.id
            LEFT JOIN sections
            ON sections.id = user_details.section
            LEFT OUTER JOIN collection_histories 
            ON users.id = collection_histories.user_id
            AND collection_histories.committee_id = $id 
            WHERE collection_histories.user_id IS NULL
            AND users.type = 3
            AND user_details.full_name != 'null' ");

        $array = array_map(function ($item) {
            return (array) $item;
        }, $sql);

        $data['user'] = collect($array)->pluck('name', 'id')->toArray();

        $manager_id = $manager_array->pluck('name', 'user_id')->toArray();

        $member_ids = CommitteeMember::query()
            ->leftJoin('user_details', 'committee_members.user_id', '=', 'user_details.user_id')
            ->where('committee_members.committee_id', $id)
            ->pluck(
                'user_details.full_name',
                'user_details.user_id'
            )
            ->toArray();
        $data['comiittee_members'] = ($manager_id + $member_ids);

        return view('user/committee.collection', $data);
    }
    public function show($id)
    {
        // Member Table Values
        $memberDetails = CommitteeMember::select('committee_members.*', 'user_details.full_name')
            ->leftJoin('user_details', 'user_details.user_id', '=', 'committee_members.user_id')
            ->where('committee_members.committee_id', $id)
            ->get();
        $data['memberDetails'] = $memberDetails;
        $total_member_collection = $memberDetails->sum('balance');
        $data['committeeDetails'] = Committee::with('userData')->findOrFail($id);
        $manager_collection = $data['committeeDetails']->total_balance;

        // Total Registration Count

        $registration = Collection::where('committee_id', $id)->get();
        $data['registrationCount'] = count($registration);
        $data['totalCollection'] = $total_member_collection + $manager_collection;
        return view('user/landing-page.memberShow', $data);
    }
    public function others($id)
    {
        // Member Table Values
        $memberDetails = CommitteeMember::select('committee_members.*', 'user_details.full_name')
            ->leftJoin('user_details', 'user_details.user_id', '=', 'committee_members.user_id')
            ->where('committee_members.committee_id', $id)
            ->get();
        $data['memberDetails'] = $memberDetails;
        $data['committeeDetails'] = Committee::with('userData')->findOrFail($id);
        return view('user/landing-page.others', $data);
    }
    public function registration($id)
    {
        // Member Table Values
        $memberDetails = CommitteeMember::select('committee_members.*', 'user_details.full_name')
            ->leftJoin('user_details', 'user_details.user_id', '=', 'committee_members.user_id')
            ->where('committee_members.committee_id', $id)
            ->get();
        $data['memberDetails'] = $memberDetails;
        $total_member_collection = $memberDetails->sum('balance');
        $data['committeeDetails'] = Committee::with('userData')->findOrFail($id);
        $manager_collection = $data['committeeDetails']->total_balance;

        $data['sections'] = Section::pluck('name', 'id')->toArray();
        // Total Registration Count

        $registration = Collection::where('committee_id', $id)->get();
        $data['registrationCount'] = count($registration);
        $data['totalCollection'] = $total_member_collection + $manager_collection;
        return view('user/landing-page.registrationShow', $data);
    }
    public function albumCreate()
    {
        dd('coming soon...');
    }
}
