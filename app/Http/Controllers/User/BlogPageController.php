<?php

namespace App\Http\Controllers\User;

use App\Models\Tag;
use App\Models\Blog;
use App\Models\Comment;
use App\Models\BlogLike;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
        $top2Blogs = Blog::orderBy('created_at', 'DESC')->latest()->limit(2)->get();
        $userId = Auth::user() ? Auth::user()->id  : '0';
        return view('user/blog.index', compact('top2Blogs', 'userId'));
    }
    public function create()
    {
        $tags = Tag::all();
        return view('user/blog.create', compact('tags'));
    }
    public function edit(Blog $blog)
    {
        $tags = Tag::all();
        $arrTags = collect($blog->tags)->map(function ($item) {
            return $item->id;
        })->toArray();
        return view('user/blog.edit', compact('tags', 'arrTags', 'blog'));
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
        $userId = Auth::user() ? Auth::user()->id  : '0';
        return view('user.blog.comments', compact('comments', 'userId'))->render();
    }

    public function editComment(Request $request)
    {
        $comment = Comment::find($request->comment_id);
        return response()->json(['comment' => $comment->comment]);
    }

    public function updateComment(Request $request)
    {
        $comment = Comment::find($request->comment_id);
        if ($comment->comment == $request->comment_body) {
            return response()->json(['comment' => $comment->comment, 'status' => 0]);
        }
        if ($request->comment_body == null) {
            if ($comment->parent_id == 0) {
                Comment::where('parent_id', $request->comment_id)->delete();
            }
            Comment::find($request->comment_id)->delete();
            $comments = Comment::where('blog_id', $comment->blog_id)
                ->where('parent_id', 0)
                ->orderBy('created_at', 'DESC')
                ->get();
            $userId = Auth::user() ? Auth::user()->id  : '0';
            return view('user.blog.comments', compact('comments', 'userId'))->render();
        }


        $comment->comment = $request->comment_body;
        $comment->save();
        if ($comment->parent_id != 0) {
            return response()->json(['comment' => $comment->comment, 'status' => 2]);
        }
        return response()->json(['comment' => $comment->comment, 'status' => 1]);
    }

    public function countRead(Request $request)
    {
        $blog = Blog::find($request->blog);
        $count = $blog->read_count + 1;
        $blog->read_count = $count;
        $blog->save();
    }

    public function liked(Request $request)
    {
        $blog = BlogLike::where('blog_id', $request->blog_id);
        if ($blog->count() > 0) {
            $blog->delete();
            $status = 0;
        } else {
            $blog = BlogLike::create($request->all());
            $status = 1;
        }
        return response()->json(['status' => $status]);
    }

    public function blogsFilter(Request $request)
    {
        $pageNo = $request->page;
        if ($pageNo == 1) {
            $pageNo = 2;
        }
        $total = $pageNo * 2;

        $blogs = Blog::take($total)->orderBy('created_at', 'DESC')->get();
        $userId = Auth::user() ? Auth::user()->id  : '0';

        return view('user.blog.blogs', compact('blogs', 'pageNo', 'userId'))->render();
    }

    
}
