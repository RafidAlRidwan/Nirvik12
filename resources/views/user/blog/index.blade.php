@extends('layouts.user.landing-page.master')
@section('header')
<!-- ======= Header Assets ======= -->
@include('layouts.user.landing-page.header')
@endsection
@section('main-style')
<link rel="stylesheet" href="../../../../public/assets/blog/css/joe.blog.css">
<style>
    .card-footer {
        padding: 0.75rem 1.25rem;
        background-color: #fff;
        border-top: 1px solid #fff;
    }
</style>
<style>
    .card {
        border: 1px solid #fff;
    }

    .card:hover {
        -webkit-box-shadow: 0px 0px 25px -5px #000000;
        box-shadow: 0px 0px 25px -5px #000000;
        transform: scale(1.01);
        transition: .3s;
    }

    .blog-create:hover {
        color: #000000
    }

    .w-100 {
        width: 60% !important;
    }

    .hhh-100 {
        height: 60% !important;
    }
</style>
@endsection

@section('main-content')
<!--==========================Custom Section============================-->
@php $data = [
'title' => "Blogs",
'sub-title' => "Recent Blog List",
'action' => "",
'button' => "",
'isAuth' => Auth::user() ? 1 : 0,
'route-name' => "blogCreate",
'button2' => "Create Blog"
]
@endphp
@include('layouts.user.landing-page.secondary-header', $data)


<!--==========================Schedule Section============================-->
<div id="content_area_blog">
    <div class="container wow fadeInUp p-5">

        <div class="page-container">
            <div class="page-content">

                <hr>
                <div class="row d-flex justify-content-center">
                    @foreach ($top2Blogs as $item)
                    @php
                    $date = date('d F Y', strtotime($item->created_at));
                    @endphp
                    <div class="col-lg-6" style="padding-left:40px; padding-right:40px;">
                        <div class="card text-center mb-5">
                            <div class="card-header p-0">
                                <div class="blog-media">
                                    <img src="{{asset($item->attachment)}}" alt="" height="250" width="250">
                                </div>
                            </div>
                            <div class="card-body px-0">
                                <a class="readCount" href="{{route('blog.show', $item->id)}}" data-id="{{$item->id}}">
                                    <h5 class="card-title mb-2">{{$item->title}}</h5>
                                </a>
                                <small class="small text-muted">{{$item->likeCount()}} Likes - {{$date}}
                                    <span class="px-2">-</span>
                                    <a href="#" class="text-muted">{{$item->comment ? $item->comment->count() : 0}} Comments</a>
                                </small>
                                <!-- <p class="my-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos saepe
                                dolores et nostrum porro odit reprehenderit animi, est ratione fugit aspernatur
                                ipsum. Nostrum placeat hic saepe voluptatum dicta ipsum beatae.</p> -->
                            </div>

                            <div class="card-footer pb-2 text-center d-flex justify-content-center">
                                @php
                                $allLikes = $item->likes;
                                $like = $allLikes->where('user_id', $userId);
                                if($like->count() > 0){
                                $status = true;
                                }else{
                                $status = false;
                                }
                                @endphp
                                <div id="ControllerData{{$item->id}}">
                                    @if($status)
                                    <a style="color:#ff4d6d;" id="like{{$item->id}}" class="btn btn-outline-dark btn-sm liked" data-id="{{$item->id}}"><i style="color:#ff4d6d" class="fa fa-thumbs-up" aria-hidden="true"></i> Liked</a>
                                    @else
                                    <a id="unlike{{$item->id}}" class="btn btn-outline-dark btn-sm liked" data-id="{{$item->id}}"><i class="fa fa-thumbs-up" aria-hidden="true"></i> Like</a>
                                    @endif
                                </div>
                                <a style="color:#ff4d6d; display:none" id="like{{$item->id}}" class="btn btn-outline-dark btn-sm liked " data-id="{{$item->id}}"><i style="color:#ff4d6d" class="fa fa-thumbs-up" aria-hidden="true"></i> Liked</a>
                                <a style="display:none" id="unlike{{$item->id}}" class="btn btn-outline-dark btn-sm liked" data-id="{{$item->id}}"><i class="fa fa-thumbs-up" aria-hidden="true"></i> Like</a>

                                <a href="{{route('blog.show', $item->id)}}" class="ml-1 btn btn-outline-dark btn-sm readCount" data-id="{{$item->id}}">READ MORE</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @php
                $blog = App\Models\Blog::all();
                $totalBlog = $blog->count();
                $currentBlog = $top2Blogs->count();
                @endphp
                @if(!($totalBlog == $currentBlog))
                <div class="d-flex justify-content-center">
                    <button id="view-blogs" data-id=1 style="background-color: #ff4d6d; border: 1px solid #ff4d6d;" class="btn btn-primary my-4 btn-sm">Load More</button>
                </div>
                @endif
            </div>

        </div>
    </div>
</div>

@endsection
@section('footer')
<!-- ======= Footer ======= -->
@include('layouts.user.landing-page.footer')
@endsection
@section('main-script')
<script src="../../../../public/assets/blog/js/joeblog.js"></script>
<script>
    $(document).on("click", ".readCount", function(e) {
        var blog = $(this).attr('data-id');
        $.ajax({
            url: "{{route('blog.read.count')}}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                "blog": blog
            },
            success: function(response) {
                // table.draw();
                // toastr.success('is Featured updated!');
            },
            error: function(response) {

            },
        });
    });
    $(document).on("click", ".liked", function(e) {
        var blog = $(this).attr('data-id');
        var user_id = "{{Auth::user() ? Auth::user()->id : 0}}";
        if (user_id == 0) {
            flashy('Please login first!', {
                        type: 'flashy__danger'
                    });
            return;
        }
        $.ajax({
            url: "{{route('blog.like')}}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                "blog_id": blog,
                "user_id": user_id
            },
            success: function(response) {
                if (response.status == 1) {
                    $("#controllerData" + blog).css("display", "none");
                    $("#unlike" + blog).css("display", "none");
                    $("#like" + blog).css("display", "inline-block");
                    flashy('You Liked', {
                        type: 'flashy__success'
                    });
                }
                if (response.status == 0) {
                    $("#controllerData" + blog).css("display", "none");
                    $("#unlike" + blog).css("display", "inline-block");
                    $("#like" + blog).css("display", "none");
                    flashy('You Unliked', {
                        type: 'flashy__danger'
                    });
                }
                // toastr.success("Liked");
            },
            error: function(response) {

            },
        });
    });
    $(document).on("click", "#view-blogs", function(e) {
        var page = $(this).attr('data-id');
        e.preventDefault();
        $.get("{{route('blog.filter')}}", {
            page: page,
        }, function(data) {
            $('#content_area_blog').empty();
            $('#content_area_blog').html(data);
        });
    });
</script>
@endsection