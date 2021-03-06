@extends('layouts.user.landing-page.master')
@section('main-style')
<style>
        .btn-custom {
                background-color: #2f3640;
        }

        .btn-custom:hover {
                background-color: #fff;
                border-color: #f82249;
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
                background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(/nirvik12/assets/user/landingPage/img/map.jpg) center;
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
</style>
<style>
        .section-with-bg {
                background-color: transparent;
        }

        #schedule .nav-tabs a.active {
                background-color: #0e1b4d;
                color: #f82249;
                border: 2px solid #f82249;
        }

        #schedule .nav-tabs a {
                border: 2px solid #0e1b4d;
                border-radius: 20px;
        }

        .btn-custom {
                background-color: #2f3640;
                color: #f82249;
        }

        .btn-custom:hover {
                background-color: #fff;
                border-color: #f82249;
                color: #f82249;
        }

        .selected::after {
                display: none;
        }

        #schedule .nav-tabs {
                padding: 0px;
        }
</style>
@endsection
@section('header')
<!-- ======= Header Assets ======= -->
@include('layouts.user.landing-page.header')
@endsection
@section('main-content')
<!--==========================Custom Section============================-->
<section>
        <div class="page-header custom-section">
                <div class="backdrop-gradient"></div>
                <div class="container">
                        <div class="breadcrumb-wrap"></div>
                        <h2 style="color: #fff;" class="page-title">Committees Details</h1>
                                <div class="content">
                                        <p style="color: #fff;" class="lead">Recent Events Committee List</p>
                                        <p>
                                                <a class="btn btn-info" href="#">View All</a>
                                        </p>
                                </div>
                </div>
        </div>
</section>
<main id="home">
        <section id="speakers-details" class="wow fadeIn">
                <div class="container">
                        <div class="section-header">
                                <h2>{{$committeeDetails->name}} - Committee Details</h2>
                        </div>

                        <div class="row">

                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        <section id="schedule" class="section-with-bg">
                                                <div class="container wow fadeInUp">
                                                        <ul class="nav-tabs">
                                                                <li class="nav-item">
                                                                        <a class="nav-link active" data-toggle="tooltip" data-placement="top" title="Committee Members" href="{{URL::to('/public/committee/details/'.$committeeDetails['id'])}}">Members</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                        <a class="nav-link" data-toggle="tooltip" data-placement="top" title="Registration Done List" href="{{URL::to('/public/committee/registration/'.$committeeDetails['id'])}}">Registrations</a>
                                                                </li>
                                                        </ul>
                                                        <div class="tab-content row justify-content-center">
                                                                <!-- TAB 1 -->
                                                                <div class="col-lg-9 tab-pane fade show active">
                                                                        <hr>

                                                                        <div class="row d-flex justify-content-between" style="padding-left: 12px; padding-right: 12px">
                                                                                <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4 mb-3 p-0 matrix">
                                                                                        <div class="d-flex align-items-center shadow-sm h-100 px-1 ">
                                                                                                <div class="h-100 d-flex justify-content-left align-items-center p-3" style="min-width: 10em; flex-basis: 100%; background-color: #EAEDED; border-left: 2px solid #5F6A6A; border-top-left-radius: 5px; border-bottom-left-radius: 5px; border-top: 2px solid #5F6A6A; border-bottom: 2px solid #5F6A6A;">
                                                                                                        <span style="color: #5F6A6A ">Total Registration</span>
                                                                                                </div>
                                                                                                <div class="d-flex h-100 justify-content-center align-items-center p-3" style="width:calc(100% - 10em); background-color: #BFC9CA; border-top-right-radius: 5px; border-bottom-right-radius: 5px; border-top: 2px solid #5F6A6A; border-bottom: 2px solid #5F6A6A; border-top: 2px solid #5F6A6A; border-right: 2px solid #5F6A6A;">
                                                                                                        <span class="text-dark"><strong>{{$registrationCount}}</strong></span>
                                                                                                </div>

                                                                                        </div>
                                                                                </div>
                                                                                <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4 mb-3 p-0 matrix">
                                                                                        <div class="d-flex align-items-center shadow-sm h-100 px-1">
                                                                                                <div class="h-100 d-flex justify-content-left align-items-center p-3" style="min-width: 10em; flex-basis: 100%; background-color: #EAEDED; border-left: 2px solid #5F6A6A; border-top-left-radius: 5px; border-bottom-left-radius: 5px; border-top: 2px solid #5F6A6A; border-bottom: 2px solid #5F6A6A;">
                                                                                                        <span style="color: #5F6A6A">Total Collection</span>
                                                                                                </div>
                                                                                                <div class="d-flex h-100 justify-content-center align-items-center p-3" style="width:calc(100% - 10em); background-color: #BFC9CA; border-top-right-radius: 5px; border-bottom-right-radius: 5px; border-bottom: 2px solid #5F6A6A; border-top: 2px solid #5F6A6A; border-right: 2px solid #5F6A6A;">
                                                                                                        <span class="text-dark"><strong>{{$totalCollection}}</strong></span>
                                                                                                </div>

                                                                                        </div>
                                                                                </div>
                                                                                <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4 mb-3 p-0 matrix">
                                                                                        <div class="d-flex align-items-center shadow-sm h-100 px-1">
                                                                                                <div class="p-2 h-100 d-flex justify-content-left align-items-center" style="min-width: 10em; flex-basis: 100%; background-color: #EAEDED; border-left: 2px solid #5F6A6A; border-top-left-radius: 5px; border-bottom-left-radius: 5px; border-top: 2px solid #5F6A6A; border-bottom: 2px solid #5F6A6A;">
                                                                                                        <span style="color: #5F6A6A">Expenses</span>
                                                                                                </div>
                                                                                                <div class="d-flex p-2 h-100 justify-content-center align-items-center" style="width:calc(100% - 10em); background-color: #BFC9CA; border-top-right-radius: 5px; border-bottom-right-radius: 5px; border-bottom: 2px solid #5F6A6A; border-top: 2px solid #5F6A6A; border-right: 2px solid #5F6A6A;">
                                                                                                        <span class="text-dark">0</span>
                                                                                                </div>

                                                                                        </div>
                                                                                </div>
                                                                        </div>
                                                                        <table class="table bg-white table-bordered table-hover collection-table" style="border: 2px solid #2f3138">
                                                                                <thead style="background-color: #0e1b4d; color: #fff; border: 2px solid #2f3138">
                                                                                        <tr>
                                                                                                <th style="width: 10px; border-bottom: 2px solid #2f3138;">#</th>
                                                                                                <th style="border-bottom: 2px solid #2f3138;">Name</th>
                                                                                                <th style="border-bottom: 2px solid #2f3138;">Role</th>
                                                                                                <th style="border-bottom: 2px solid #2f3138;">Balance</th>
                                                                                        </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                        <tr>
                                                                                                <td>1</td>
                                                                                                <td><strong>{{$committeeDetails->userData->full_name}}</strong></td>
                                                                                                <td><span class="badge bg-success text-white">Manager</span></td>
                                                                                                <td>{{$committeeDetails->total_balance}}</td>
                                                                                        </tr>
                                                                                        @foreach ($memberDetails as $item)
                                                                                        <tr>
                                                                                                <td>{{$loop->iteration + 1}}</td>
                                                                                                <td>{{$item->full_name}}</td>
                                                                                                <td><span class="badge bg-info text-white">Member</span></td>
                                                                                                <td>{{$item->balance}}</td>
                                                                                        </tr>
                                                                                        @endforeach
                                                                                </tbody>
                                                                        </table>
                                                                </div>
                                                        </div>
                                                </div>
                                        </section>
                                </div>
                        </div>
                </div>
        </section>
</main>

@endsection

@section('footer')
<!-- ======= Footer ======= -->
@include('layouts.user.landing-page.footer')
@endsection

@section('main-script')
<script>
        $(function() {
                $('[data-toggle="tooltip"]').tooltip()
        })
</script>
@endsection