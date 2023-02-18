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
        width: 50% !important;
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

    .btn-info {
        color: #fff;
        background-color: #f82249;
        border-color: #f82249;
    }

    .btn-info:hover {
        color: #fff;
        background-color: #282f4e;
        border-color: #282f4e;
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
                    @if(Auth::user() && Auth::user()->id == $blog->posted_by)
                    <p>
                        <a href="{{route('blogEdit', $blog->id)}}" style="background-color: #ff4d6d; border: 1px solid #ff4d6d;" class="blog-create -btn btn-info btn-sm">Edit Blog</a>
                    </p>
                    @endif
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
                                <span>{{$blog->likeCount()}} Likes</span>
                                <span class="px-2">·</span>
                                <a href="#" class="text-muted">{{$blog->comment ? $blog->comment->count() : 0}} Comments</a>
                                <span class="px-2">·</span>
                                <a href="#" class="text-muted">{{$blog->read_count}} Views</a>
                                <span class="px-2">·</span>
                                <span>{{$blog->date}}</span>
                            </small>
                            <small>
                                <br><a href="#" class="text-muted">BY {{$blog->userDetails ? $blog->userDetails->full_name : 'Guest'}}</a>
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
                                        <h6 class="mt-0">{{$blog->userDetails ? $blog->userDetails->full_name : 'Guest'}}</h6>
                                        <p class="mb-3" id="comment{{$item->id}}">{{$item->comment}}</p>
                                        <textarea cols="20" id="reply_body{{$item->id}}" rows="2" class="form-control mb-2 d-none " placeholder="Enter Your Reply Here"></textarea>
                                        <!-- <span class="badge badge-primary message-count">12</span>
                                        <a href="#" id="btn_like{{$item->id}}" class="text-dark small font-weight-bold btn_like" data-id="{{$item->id}}"><i class="ti-back-right"></i> <button class="btn btn-outline-dark btn-sm"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></button></a> -->
                                        @if(auth()->user() && auth()->user()->id == $item->comment_by)
                                        <a href="#" id="btn_edit{{$item->id}}" class="text-dark small font-weight-bold btn_edit" data-id="{{$item->id}}"><i class="ti-back-right"></i> <button class="btn btn-outline-dark btn-sm"><i class="fa fa-pencil-square" aria-hidden="true"></i></button></a>
                                        @endif
                                        <a href="#" id="btn_reply{{$item->id}}" class="text-dark small font-weight-bold btn_reply" data-id="{{$item->id}}"><i class="ti-back-right"></i> <button class="btn btn-outline-dark btn-sm"><i class="fa fa-reply" aria-hidden="true"></i></button></a>
                                        <a href="#" id="reply_submit{{$item->id}}" class="text-dark small font-weight-bold btn_reply_submit d-none" data-id="{{$item->id}}"><i class="ti-back-right"></i> <button class="btn btn-outline-dark btn-sm"><i class="fa fa-paper-plane" aria-hidden="true"></i></button></a>
                                        <a href="#" id="reply_close{{$item->id}}" class="text-dark small font-weight-bold btn_reply_close d-none" data-id="{{$item->id}}"><i class="ti-back-right"></i> <button class="btn btn-outline-dark btn-sm"><i class="fa fa-window-close" aria-hidden="true"></i></button></a>
                                        @foreach ($item->children as $child)
                                        <div class="media mt-3 mb-0">
                                            <a class="mr-3" href="#">
                                                <img src="{{asset($child->userDetails->attachment ?? '/assets/blog/imgs/ava.png')}}" class="thumb-sm rounded-circle" alt="...">
                                            </a>
                                            <div class="media-body align-items-center">
                                                <h6 class="mt-0">{{$child->userDetails ? $child->userDetails->full_name : 'Guest'}}</h6>
                                                <p class="mb-3" id="comment{{$child->id}}"> {{$child->comment}}</p>
                                                @if(auth()->user() && auth()->user()->id == $child->comment_by)
                                                <a href="#" id="btn_edit{{$child->id}}" class="text-dark small font-weight-bold btn_edit" data-id="{{$child->id}}"><i class="ti-back-right"></i> <button class="btn btn-outline-dark btn-sm"><i class="fa fa-pencil-square" aria-hidden="true"></i></button></a>
                                                @endif
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
                        @forelse($match_blogs as $item)
                        @php
                        $date = date('d F Y', strtotime($item->created_at));
                        $singleTag = $item->tags->first();
                        @endphp
                        <div class="col-md-6 col-lg-4">
                            <div class="card mb-5">
                                <div class="card-header p-0">
                                    <div class="blog-media">
                                        <img src="{{asset($item->attachment)}}" alt="" class="w-100">
                                        <a href="{{route('blog.show', $item->id)}}" class="badge badge-primary readCount" data-id="{{$item->id}}">{{$singleTag->slugs}}</a>
                                    </div>
                                </div>
                                <div class="card-body px-0">
                                    <h6 class="card-title mb-2"><a href="{{route('blog.show', $item->id)}}" class="text-dark readCount" data-id="{{$item->id}}">{{$item->title}}</a></h6>
                                    <small class="small text-muted">{{$date}}
                                        <span class="px-2">-</span>
                                        <a href="#" class="text-muted">{{$item->comment ? $item->comment->count() : 0}} Comments</a>
                                    </small>
                                </div>
                            </div>
                        </div>
                        @empty
                        <p>No Related Blogs</p>
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-3 pb-4">
                <div class="page-sidebar">
                    <h6 class=" ">Tags</h6>
                    @forelse($blog->tags as $tag)
                    <a href="javascript:void(0)" class="badge badge-primary m-1">{{$tag->slugs}}</a>
                    @empty
                    <p>#empty_tags</p>
                    @endforelse
                    <!-- <div class="ad-card d-flex text-center align-items-center justify-content-center mt-4">
                    <span href="#" class="font-weight-bold">ADS</span>
                </div> -->
                </div>
            </div>
        </div>

        <!-- Sidebar -->

    </div>

    <!-- Modal -->
    <div class="modal fade" id="commentEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Comment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="comment_id" id="comment_id">
                        <textarea cols="20" id="comment" rows="2" class="form-control mb-2 comment"></textarea>
                        <small id="emailHelp" class="form-text text-danger">*if comment box is empty, we will consider as delete comment</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info btn-sm update">Update</button>
                </div>
            </div>
        </div>
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
            var user_id = "{{Auth::user() ? Auth::user()->id : 0}}";
            if (user_id == 0) {
                flashy('Please login first!', {
                        type: 'flashy__danger'
                    });
                $('#comment_body').val("");
                return;
            }
            var comment = $.trim($("#comment_body").val());
            if (comment == "") {
                flashy('Please Comment first!', {
                        type: 'flashy__danger'
                    });
                $('#comment_body').val("");
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
    $(document).on("click", ".btn_edit", function(e) {
        e.preventDefault();
        $('#commentEditModal').modal('show');
        var commentId = $(this).attr('data-id');
        $('#comment_id').val(commentId);
        $.post("{{route('comment.edit')}}", {
            "_token": "{{ csrf_token() }}",
            comment_id: commentId,
        }, function(data) {
            $('#comment').val("");
            $('#comment').val(data.comment);
        });
    });
    $(document).on("click", ".update", function(e) {
        e.preventDefault();
        var comment_body = $('.comment').val();
        var commentId = $('#comment_id').val();
        $.post("{{route('comment.update')}}", {
            "_token": "{{ csrf_token() }}",
            comment_id: commentId,
            comment_body: comment_body,
        }, function(data) {
            if (data.status == 0) {
                $('#commentEditModal').modal('hide');
                return;
            }
            if (data.status == 1) {
                $('#comment' + commentId).text(data.comment);
                $('#commentEditModal').modal('hide');
                flashy('Your Comment updated', {
                        type: 'flashy__success'
                    });
                return;
            }
            if (data.status == 2) {
                $('#comment' + commentId).text(data.comment);
                $('#commentEditModal').modal('hide');
                flashy('Your Reply updated', {
                        type: 'flashy__success'
                    });
                return;
            }

            $('#commentEditModal').modal('hide');
            $('#comment_body').val("");
            $('#content_expand').html('');
            $('#content_expand').html(data);
            flashy('Your Comment deleted', {
                        type: 'flashy__success'
                    });
        });
    });
    $("#commentEditModal").on("hidden.bs.modal", function() {
        $(".modal-body input").val("");
    });
    $(document).on("click", ".btn_reply", function(e) {
        e.preventDefault();
        var parent_id = $(this).attr('data-id');
        $('#btn_edit' + parent_id).addClass('d-none');
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
        var user_id = "{{Auth::user() ? Auth::user()->id : 0}}";
        var replyBody = $.trim($('#reply_body' + parent_id).val());
        if (replyBody == "") {
            flashy('Please Comment', {
                        type: 'flashy__danger'
                    });

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
        $('#btn_edit' + parent_id).removeClass('d-none');

    });

    $(".readCount").click(function() {
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
</script>
@endsection