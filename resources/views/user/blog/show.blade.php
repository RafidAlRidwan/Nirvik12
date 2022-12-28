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
    .page-header .container {
        padding-top: 36px;
        padding-bottom: 36px;
        position: relative;
        animation: pop-in 2.5s ease-out;
    }

    .container {
        max-width: 1140px;
        padding-right: 30px;
        padding-left: 30px;
        margin-right: auto;
        margin-left: auto;
    }

    .custom-section {
        width: 100%;
        height: auto;
        background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(/assets/user/landingPage/img/map.jpg) center;
        background-size: cover;
        overflow: hidden;
        position: relative;
    }

    @media (min-width: 768px) {
        .page-header .container {
            padding-top: 100px;
            /* padding-bottom: 48px; */
        }
    }

    @media (max-width: 768px) {
        .page-header .container {
            padding-top: 100px;
            /* padding-bottom: 48px; */
        }
    }

    .thumb-sm {
        width: 55px;
    }

    .card {
        border: 1px solid #fff;
    }

    .badge-primary {
        color: #fff;
        background-color: #ff4d6d;
    }

    .w-100 {
        width: 80% !important;
    }

    .message-count {
        position: relative;
        display: block;
        font: bold 14px/13px Helvetica, Verdana, Tahoma;
        text-align: center;
        margin: 0;
        top: 9px;
        width: 26px;
        left: -15px;
    }
</style>
@endsection

@section('main-content')
<!--==========================Custom Section============================-->
<section>
    <div class="page-header custom-section">
        <div class="backdrop-gradient"></div>
        <div class="container">
            <div class="breadcrumb-wrap"></div>
            <h2 style="font-weight: bold;" class="page-title">#Blogs Details</h1>
                <div class="content">
                    <p style="font-weight: bold;" class="lead">Recent Blog List</p>
                    <p>
                        <!-- <a class="btn btn-info" href="#">View All</a> -->
                    </p>
                </div>
        </div>
    </div>
</section>

<section class="container wow fadeInUp pt-5">
    <div class="page-container">
        <div class="row">
            <div class="col-sm-12 col-md-9">
                <div class="page-content">
                    <div class="card">
                        <div class="card-header pt-2" style="border: 1px solid #fff!important; background: #fff">
                            <h3 class="card-title mb-4">{{$blog->title}}</h3>
                            <div class="blog-media mb-4">
                                <img src="{{asset($blog->attachment)}}" alt="" class="w-100">
                                <!-- <a href="#" class="badge badge-primary">#Salupt</a> -->
                            </div>
                            <small class="small text-muted">
                                <a href="#" class="text-muted">BY {{$blog->userDetails ? $blog->userDetails->full_name : 'Guest'}}</a>
                                <span class="px-2">·</span>
                                <span>{{$blog->date}}</span>
                                <span class="px-2">·</span>
                                <a href="#" class="text-muted">{{$blog->comment ? $blog->comment->count() : 0}} Comments</a>
                            </small>
                        </div>
                        <div class="card-body border-top" style="text-align: justify">
                            <p class="my-3">{!! $blog->description !!}</p>
                        </div>

                        <div class="card-footer">
                            <h6 class="mt-5 mb-3 text-center"><a href="#" class="text-dark">Comments {{$blog->comment ? $blog->comment->count() : 0}}</a></h6>
                            <hr>
                            <div id="content_expand">

                                @foreach ($blog->comment->sortByDesc('created_at') as $item)
                                <div class="media mt-5">
                                    <img src="{{asset($item->userDetails->attachment ?? '/assets/blog/imgs/ava.png')}}" class="mr-3 thumb-sm rounded-circle" alt="...">
                                    <div class="media-body">
                                        <h6 class="mt-0">{{$item->userDetails->full_name}}</h6>
                                        <p class="mb-3">{{$item->comment}}</p>
                                        <textarea cols="20" id="reply_body{{$item->id}}" rows="2" class="form-control mb-2 d-none " placeholder="Enter Your Reply Here"></textarea>
                                        <!-- <span class="badge badge-primary message-count">12</span>
                                        <a href="#" id="btn_like{{$item->id}}" class="text-dark small font-weight-bold btn_like" data-id="{{$item->id}}"><i class="ti-back-right"></i> <button class="btn btn-outline-dark btn-sm"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></button></a> -->
                                        <a href="#" id="btn_reply{{$item->id}}" class="text-dark small font-weight-bold btn_reply" data-id="{{$item->id}}"><i class="ti-back-right"></i> <button class="btn btn-outline-dark btn-sm"><i class="fa fa-reply" aria-hidden="true"></i> Reply</button></a>
                                        <a href="#" id="reply_submit{{$item->id}}" class="text-dark small font-weight-bold btn_reply_submit d-none" data-id="{{$item->id}}"><i class="ti-back-right"></i> <button class="btn btn-outline-dark btn-sm"><i class="fa fa-paper-plane" aria-hidden="true"></i></button></a>
                                        <a href="#" id="reply_close{{$item->id}}" class="text-dark small font-weight-bold btn_reply_close d-none" data-id="{{$item->id}}"><i class="ti-back-right"></i> <button class="btn btn-outline-dark btn-sm"><i class="fa fa-window-close" aria-hidden="true"></i></button></a>
                                        @foreach ($item->children as $child)
                                        <div class="media mt-3 mb-0">
                                            <a class="mr-3" href="#">
                                                <img src="{{asset($child->userDetails->attachment ?? '/assets/blog/imgs/ava.png')}}" class="thumb-sm rounded-circle" alt="...">
                                            </a>
                                            <div class="media-body align-items-center">
                                                <h6 class="mt-0">{{$child->userDetails->full_name}}</h6>
                                                <p class="mb-3">{{$child->comment}}</p>
                                                <!-- <a href="#" class="text-dark small font-weight-bold"><i class="ti-back-right"></i> Replay</a> -->
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <h6 class="mt-5 mb-3 text-center"><a href="#" class="text-dark">Write Your Comment</a></h6>
                            <hr>
                            <form>
                                <div class="form-row">
                                    <div class="col-12 form-group">
                                        <textarea id="comment_body" cols="30" rows="3" class="form-control" placeholder="Enter Your Comment Here"></textarea>
                                    </div>
                                    <div class="form-group col-12">
                                        <button id="btn_post" style="background-color: #ff4d6d; border: 1px solid #ff4d6d;" class="btn btn-primary btn-block">Post Comment</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <h6 class="mt-5 text-center">Related Posts</h6>
                    <hr>
                    <div class="row">
                        <div class="col-md-6 col-lg-4">
                            <div class="card mb-5">
                                <div class="card-header p-0">
                                    <div class="blog-media">
                                        <img src="{{asset('assets/blog/imgs/blog-2.jpg')}}" alt="" class="w-100">
                                        <a href="#" class="badge badge-primary">#Placeat</a>
                                    </div>
                                </div>
                                <div class="card-body px-0">
                                    <h6 class="card-title mb-2"><a href="#" class="text-dark">Voluptates Corporis Placeat</a></h6>
                                    <small class="small text-muted">January 20 2019
                                        <span class="px-2">-</span>
                                        <a href="#" class="text-muted">34 Comments</a>
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="card mb-5">
                                <div class="card-header p-0">
                                    <div class="blog-media">
                                        <img src="{{asset('assets/blog/imgs/blog-3.jpg')}}" alt="" class="w-100">
                                        <a href="#" class="badge badge-primary">#dolores</a>
                                    </div>
                                </div>
                                <div class="card-body px-0">
                                    <h6 class="card-title mb-2"><a herf="#" class="text-dark">Dolorum Dolores Itaque</a></h6>
                                    <small class="small text-muted">January 19 2019
                                        <span class="px-2">-</span>
                                        <a href="#" class="text-muted">64 Comments</a>
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 d-none d-lg-block">
                            <div class="card mb-5">
                                <div class="card-header p-0">
                                    <div class="blog-media">
                                        <img src="{{asset('assets/blog/imgs/blog-4.jpg')}}" alt="" class="w-100">
                                        <a href="#" class="badge badge-primary">#amet</a>
                                    </div>
                                </div>
                                <div class="card-body px-0">
                                    <h6 class="card-title mb-2">Quisquam Dignissimos</h6>
                                    <small class="small text-muted">January 17 2019
                                        <span class="px-2">-</span>
                                        <a href="#" class="text-muted">93 Comments</a>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-3 pb-4">
                <div class="page-sidebar">
                    <h6 class=" ">Tags</h6>
                    <a href="javascript:void(0)" class="badge badge-primary m-1">#iusto</a>
                    <a href="javascript:void(0)" class="badge badge-primary m-1">#quibusdam</a>
                    <a href="javascript:void(0)" class="badge badge-primary m-1">#officia</a>
                    <a href="javascript:void(0)" class="badge badge-primary m-1">#animi</a>
                    <a href="javascript:void(0)" class="badge badge-primary m-1">#mollitia</a>
                    <a href="javascript:void(0)" class="badge badge-primary m-1">#quod</a>
                    <a href="javascript:void(0)" class="badge badge-primary m-1">#ipsa at</a>
                    <a href="javascript:void(0)" class="badge badge-primary m-1">#dolor</a>
                    <a href="javascript:void(0)" class="badge badge-primary m-1">#incidunt</a>
                    <a href="javascript:void(0)" class="badge badge-primary m-1">#possimus</a>

                    <!-- <div class="ad-card d-flex text-center align-items-center justify-content-center mt-4">
                    <span href="#" class="font-weight-bold">ADS</span>
                </div> -->
                </div>
            </div>
        </div>

        <!-- Sidebar -->

    </div>
</section>
@endsection
@section('footer')
<!-- ======= Footer ======= -->
@include('layouts.user.landing-page.footer')
@endsection
@section('main-script')
<script src="../../../../public/assets/blog/js/joeblog.js"></script>

<script>
    $(function() {
        $('#btn_post').click(function(e) {
            e.preventDefault();
            var commentBody = $('#comment_body').val();
            var blog_id = "{{$blog->id}}";
            var user_id = "{{Auth::user()->id}}";
            var comment = $.trim($("#comment_body").val());
            if (comment == "") {
                alert("Please Comment first!");
                return;
            }
            $.post("{{route('comment.store')}}", {
                "_token": "{{ csrf_token() }}",
                body: commentBody,
                blog_id: blog_id,
                user_id: user_id,
            }, function(data) {
                $('#comment_body').val("");
                $('#content_expand').html('');
                $('#content_expand').html(data);
            });

        });
    });
    $(document).on("click", ".btn_reply", function(e) {
        e.preventDefault();
        var parent_id = $(this).attr('data-id');
        $('#reply_body' + parent_id).removeClass('d-none');
        $(this).addClass('d-none');
        $('#reply_submit' + parent_id).removeClass('d-none');
        $('#reply_close' + parent_id).removeClass('d-none');
        $('#reply_body' + parent_id).focus();

    });
    $(document).on("click", ".btn_reply_submit", function(e) {
        e.preventDefault();
        var parent_id = $(this).attr('data-id');
        var blog_id = "{{$blog->id}}";
        var user_id = "{{Auth::user()->id}}";
        var replyBody = $.trim($('#reply_body' + parent_id).val());
        if (replyBody == "") {
            alert("Please Comment");
            return;
        }
        $.post("{{route('comment.store')}}", {
            "_token": "{{ csrf_token() }}",
            body: replyBody,
            blog_id: blog_id,
            user_id: user_id,
            parent_id: parent_id,
        }, function(data) {
            $('#comment_body').val("");
            $('#content_expand').html('');
            $('#content_expand').html(data);
        });
    });
    $(document).on("click", ".btn_reply_close", function(e) {
        e.preventDefault();
        var parent_id = $(this).attr('data-id');
        $('#reply_body' + parent_id).addClass('d-none');
        $('#btn_reply' + parent_id).removeClass('d-none');
        $('#reply_submit' + parent_id).addClass('d-none');
        $('#reply_close' + parent_id).addClass('d-none');

    });
</script>
@endsection