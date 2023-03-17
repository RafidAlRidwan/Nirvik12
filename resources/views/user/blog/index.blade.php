@extends('layouts.user.landing-page.master')
@section('header')
<!-- ======= Header Assets ======= -->
@include('layouts.user.landing-page.header')
@endsection
@section('main-style')
<style>
    .card:hover {
        -webkit-box-shadow: 0px 0px 25px -5px #000000;
        box-shadow: 0px 0px 25px -5px #000000;
        transform: scale(1.01);
        transition: .3s;
    }

    button {
        background: #f5f5f5;
        padding: 15px 20px;
        border: none;
        cursor: pointer;
    }

    .card {
        width: 100%;
        border-radius: 5px;
        box-shadow: 0px 0px 20px 2px rgba(0, 0, 0, 0.1);
        border-radius: 5px;
        height: 100%;
        position: relative;
        margin-top: 20px;
        overflow: hidden;
    }

    .image {
        overflow: hidden;
    }

    .card__img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        -o-object-fit: cover;
        border-radius: 5px 5px 0 0;
    }

    .card__body {
        padding: 20px;
        background: #fff;
        margin-top: -4px;
        border-radius: 0 0 5px 5px;
    }

    .card__title {
        margin: 0;
        font-size: 1em;
        font-weight: normal;
    }

    .card__title i {
        color: #339AF0;
        margin-right: 5px;
        font-size: 1.1em;
    }

    .card__desc {
        margin-top: 20px;
        font-size: 1em;
    }

    .card__desc>span>i {
        color: #339AF0;
        margin-right: 5px;
    }

    .card__desc__room,
    .card__desc__bed {
        margin-right: 20px;
        font-size: 1em;
    }

    .card__desc__price {
        font-size: 1em;
        /* font-weight: bold; */
        /* float: right;
        text-align: right; */
    }

    .card__desc__price--small {
        font-size: 0.8em;
    }

    .card__buttons {
        display: flex;
        transform-origin: top;
        transform: scaleY(0);
        width: 100%;
        position: absolute;
        box-shadow: 0px 10px 20px -5px rgba(0, 0, 0, 0.1);
        z-index: 2;
        transition: transform 0.2s ease-out;
    }

    .card__buttons--gray,
    .card__buttons--primary {
        width: 50%;
        display: inline-block;
    }

    .card__buttons--primary {
        background: #339AF0;
        color: white;
    }

    .card:hover .card__body {
        border-radius: 0;
    }

    .card:hover .card__img {
        transform: scale(1.2);
        -webkit-transition: .5s ease-in-out;
        transition: .5s ease-in-out;
    }

    .card:hover .card__buttons {
        transform: scaleY(1);
        transition: transform 0.2s ease-in;
    }

    .card:hover .card__buttons--gray {
        border-radius: 0 0 0 5px;
    }

    .card:hover .card__buttons--gray:hover {
        background: #e5e5e5;
    }

    .card:hover .card__buttons--primary {
        border-radius: 0 0 5px 0;
    }

    .card:hover .card__buttons--primary:hover {
        background: #008cff;
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

        <hr>
        <div class="row d-flex justify-content-between">
            @foreach ($top2Blogs as $item)
            @php
            $date = date('d F, Y', strtotime($item->created_at));
            @endphp
            <div class="col-xl-4 col-md-4 col-lg-4 col-sm-12 col-xs-12 mb-3">
                <div class="card" id="list1" onmouseenter="showButton('list1')" onmouseleave="hideButton('list1')">
                    <div class="image"><img src="{{asset($item->attachment)}}" alt="" class="card__img"></div>
                    <div class="card__body text-center">
                        <a class="readCount" href="{{route('blog.show', $item->id)}}" data-id="{{$item->id}}">
                            <h3 class="card__title"><i class="fa fa-map-marker-alt"></i> {{$item->title}}</h3>
                        </a>
                        <div class="card__desc">
                            <span class="card__desc__room">{{$item->likeCount()}} Likes</span>
                            <span class="card__desc__bed"> - {{$item->comment ? $item->comment->count() : 0}} Comments</span>
                            <span class="card__desc__price">Posted on: {{$date}}</span>
                        </div>
                    </div>
                    <div class="card__buttons">

                        @php
                        $allLikes = $item->likes;
                        $like = $allLikes->where('user_id', $userId);
                        if($like->count() > 0){
                        $status = true;
                        }else{
                        $status = false;
                        }
                        @endphp

                        @if($status)
                        <button style="width: 50%;" id="like{{$item->id}}" class="card__buttons--gray btn liked default{{$item->id}}" data-id="{{$item->id}}"><i style="color:#ff4d6d" class="fa fa-thumbs-up" aria-hidden="true"></i> Liked</button>
                        @else
                        <button style="width: 50%;" id="unlike{{$item->id}}" class="card__buttons--gray btn liked default{{$item->id}}" data-id="{{$item->id}}"><i class="fa fa-thumbs-up" aria-hidden="true"></i> Like</button>
                        @endif
                        <button style="color:#ff4d6d; display:none; width: 50%;" id="like{{$item->id}}" class="card__buttons--gray btn liked" data-id="{{$item->id}}"><i style="color:#ff4d6d" class="fa fa-thumbs-up" aria-hidden="true"></i> Liked</button>
                        <button style="display:none; width: 50%;" id="unlike{{$item->id}}" class="card__buttons--gray btn liked" data-id="{{$item->id}}"><i class="fa fa-thumbs-up" aria-hidden="true"></i> Like</button>
                        <button class="card__buttons--primary btn readCount" data-id="{{$item->id}}"><a style="color:white" href="{{route('blog.show', $item->id)}}">READ MORE</a></button>
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
                    $(".default" + blog).css("display", "none");
                    $("#unlike" + blog).css("display", "none");
                    $("#like" + blog).css("display", "inline-block");
                    flashy('You Liked', {
                        type: 'flashy__success'
                    });
                }
                if (response.status == 0) {
                    $(".default" + blog).css("display", "none");
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