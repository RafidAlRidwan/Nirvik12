<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\Blog;
use App\Models\Donate;
use App\Models\Comment;
use App\Models\BlogLike;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class DonateController extends Controller
{
    public function index()
    {
        return view('admin/donate.index');
    }
    public function edit(Donate $donate)
    {
        return view('admin/donate.edit', compact('donate'));
    }
    public function store(Request $request)
    {
        try {
            if (!empty($request->id)) {
                $this->validate($request, [
                    'title' => ['required'],
                    'description' => ['required'],
                ]);
            } else {
                $this->validate($request, [
                    'title' => ['required'],
                    'description' => ['required'],
                    'attachment' => ['required'],
                ]);
            }

            DB::beginTransaction();
            if (!empty($request->id)) {
                $this->update($request);
            } else {
                $this->save($request);
            }
            DB::commit();
            Session::flash('flashy__success', __('Blog Posted Successfully!'));

            // Redirect to edit mode.
            return Redirect::route('blog');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->withErrors($e->getMessage())
                ->withInput($request->all);
        }
    }
    public function show(Blog $blog)
    {
        $blog['date'] = date('d F Y', strtotime($blog->created_at));
        $tags = $blog->tags->pluck('id')->toArray();
        $userId = Auth::user() ? Auth::user()->id  : '0';
        $match_blogs = Blog::whereHas('tags', function ($q) use ($tags) {
            $q->whereIN('tags.id', $tags);
        })
            ->where('blogs.id', '!=', $blog->id)
            ->get();
        return view('user.blog.show', compact('blog', 'match_blogs', 'userId'));
    }
    public static function save($request)
    {
        $requestData = $request->all();
        $requestData['posted_by'] = Auth::user()->id;

        if (!empty($requestData['attachment'])) {
            $image = $requestData['attachment'];
            $unique_date = date_timestamp_get(date_create());
            $filename = $unique_date . $image->getClientOriginalName();
            $path = ('assets/blog/imgs/');
            $image_resize = Image::make($image->getRealPath());
            // $image_resize->resize(120, 120);
            $main_path = $path . $filename;
            $image_resize->save($main_path);
            $requestData['attachment'] = $main_path ?? NULL;
        }
        $blog = Blog::create($requestData);

        return collect($request->tags)->map(function ($item) use ($blog) {
            if (!(int)$item) {
                $newArray = [
                    'id' => null,
                    'name' => $item
                ];
                $tag = Tag::updateOrCreate(['name' => $newArray['name'], 'slugs' => Tag::createSlug($newArray['name'])]);
                $blog->tags()->attach($tag);
            } else {
                $blog->tags()->attach($item);
            }
        });
    }

    public static function update($request)
    {
        $blog = Blog::find($request->id);
        $requestData = $request->all();

        if (($request->hasFile('attachment'))) {
            $image = $requestData['attachment'];
            $unique_date = date_timestamp_get(date_create());
            $filename = $unique_date . $image->getClientOriginalName();
            $path = ('assets/blog/imgs/');
            $image_resize = Image::make($image->getRealPath());
            // $image_resize->resize(120, 120);
            $main_path = $path . $filename;
            $image_resize->save($main_path);
            $blog['attachment'] = $main_path ?? NULL;
        }
        $blog['title'] = $requestData['title'];
        $blog['description'] = $requestData['description'];
        $blog['posted_by'] = Auth::user()->id;

        $blog->save();

        $arrTags = collect($blog->tags)->map(function ($item) {
            return $item->id;
        })->toArray();
        $blog->tags()->detach($arrTags);

        return collect($request->tags)->map(function ($item) use ($blog) {
            if (!(int)$item) {
                $newArray = [
                    'id' => null,
                    'name' => $item
                ];
                $tag = Tag::updateOrCreate(['name' => $newArray['name'], 'slugs' => Tag::createSlug($newArray['name'])]);
                if ($tag->wasRecentlyCreated) {
                    $blog->tags()->attach($tag);
                }
            } else {
                $blog->tags()->attach($item);
            }
        });
    }


    public function donate_datatable(Request $request)
    {
        $searchString = $request->search['value'];
        $product_data = Donate::query();

        $data['recordsTotal'] = $product_data->count();
        $data['recordsFiltered'] = $product_data->count();
        $product_data->limit($request->length)->offset($request->start);
        $product_data_list = $product_data->get();
        $data['draw'] = $request->draw;
        $data['data'] = array();
        $sl = 0;
        $serial = 1;

        foreach ($product_data_list as $item) {
            $editURL = URL::to('admin/donate/edit' . '/' . $item->id);
            $data['data'][$sl]['serial'] = $serial;
            $data['data'][$sl]['amount'] = $item->amount;
            $data['data'][$sl]['name'] = $item->name;
            $data['data'][$sl]['mobile'] = $item->mobile;
            $data['data'][$sl]['shift'] = $item->shift;
            $data['data'][$sl]['payment'] = $item->payment_method;
            if ($item->payment_method == 'bkash') {
                $img = URL::to('assets/user/landingPage/img/bkash.png');
            }
            if ($item->payment_method == 'nagad') {
                $img = URL::to('assets/user/landingPage/img/nagad.png');
            }
            if ($item->payment_method == 'rocket') {
                $img = URL::to('assets/user/landingPage/img/rocket.png');
            }
            $data['data'][$sl]['payment'] = "<img style='border: 1px solid #ddd; border-radius:5px; width: 90px; height:45px;' src='$img' alt='image' class='responsive'>";
            $data['data'][$sl]['transaction_id'] = $item->transaction_no;
            $data['data'][$sl]['status'] = $item->status == 0 ? '<span class="badge badge-danger status" id="' . $item->id . '">Pending</span>' : '<span class="badge badge-success status" id="' . $item->id . '">Confirmed</span>';
            $data['data'][$sl]['action'] = "<a class='event_edit' href='$editURL'><i class='fa fa-edit' style='font-size:14px; ''></i></a>
            |<a class='sponsor_delete' href='$item->id' data-toggle='modal' data-target='#gallery_delete_modal' style='border: none; background: none;' > <i class='fa fa-trash'></i> </a>";

            $sl++;
            $serial++;
        }
        echo json_encode($data);
        die();
    }

    public function modifyStatus(Request $request)
    {
        $donate = Donate::find($request->donate_id);
        if ($donate->status == 0) {
            $donate->status = 1;
        }
        $donate->save();

        return response()->json(['status' => true]);
    }
}
