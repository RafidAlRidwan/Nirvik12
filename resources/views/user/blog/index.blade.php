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
</style>
@endsection

@section('main-content')
<!--==========================Custom Section============================-->
<section>
    <div class="page-header custom-section">
        <div class="backdrop-gradient"></div>
        <div class="container">
            <div class="breadcrumb-wrap"></div>
            <h2 style="font-weight: bold;" class="page-title">#Blogs</h1>
                <div class="content">
                    <p style="font-weight: bold;" class="lead">Recent Blog List</p>
                    @if(Auth::user())
                    <p>
                        <a href="{{route('blog.create')}}" style="background-color: #ff4d6d; border: 1px solid #ff4d6d;" class="blog-create -btn btn-info btn-sm">Create Blog</a>
                    </p>
                    @endif
                </div>
        </div>
    </div>
</section>

<!--==========================Schedule Section============================-->
<div class="container wow fadeInUp p-5">

    <div class="page-container">
        <div class="page-content">

            <hr>
            <div class="row">
                @foreach ($blog as $item)
                @php
                $date = date('d F Y', strtotime($item->created_at));
                @endphp
                <div class="col-lg-6">
                    <div class="card text-center mb-5">
                        <div class="card-header p-0">
                            <div class="blog-media">
                                <img src="{{asset($item->attachment)}}" alt="" class="w-100">
                            </div>
                        </div>
                        <div class="card-body px-0">
                            <h5 class="card-title mb-2">{{$item->title}}</h5>
                            <small class="small text-muted">{{$date}}
                                <span class="px-2">-</span>
                                <a href="#" class="text-muted">{{$item->comment ? $item->comment->count() : 0}} Comments</a>
                            </small>
                            <!-- <p class="my-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos saepe
                                dolores et nostrum porro odit reprehenderit animi, est ratione fugit aspernatur
                                ipsum. Nostrum placeat hic saepe voluptatum dicta ipsum beatae.</p> -->
                        </div>

                        <div class="card-footer pb-2 text-center">
                            <a href="{{route('blog.show', $item->id)}}" class="btn btn-outline-dark btn-sm">READ MORE</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-center">
                <button style="background-color: #ff4d6d; border: 1px solid #ff4d6d;" class="btn btn-primary my-4 btn-sm">Load More</button>
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
@endsection