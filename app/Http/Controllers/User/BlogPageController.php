<?php

namespace App\Http\Controllers\User;

use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class BlogPageController extends Controller
{
    public function index()
    {
        $blog = Blog::orderBy('created_at', 'DESC')->latest()->limit(2)->get();
        return view('user/blog.index', compact('blog'));
    }
    public function create()
    {
        return view('user/blog.create');
    }
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'title' => ['required'],
                'description' => ['required'],
                'attachment' => ['required'],
            ]);
            DB::beginTransaction();
            $this->save($request);
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
        return view('user/blog.show', compact('blog'));
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
    }
    public function storeComment(Request $request)
    {
        $blog = Blog::find($request->blog_id);
        $comment = Comment::create(
            [
                'comment_by' => $request->user_id,
                'blog_id' => $request->blog_id,
                'comment' => $request->body,
                'parent_id' => $request->parent_id ?? 0,
            ]
        );
        $comments = Comment::where('blog_id', $request->blog_id)
            ->where('parent_id', 0)
            ->orderBy('created_at', 'DESC')
            ->get();
        return view('user.blog.comments', compact('comments'))->render();
    }
}
