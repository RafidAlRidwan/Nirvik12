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
@php $data = [
'title' => "Committees Details",
'sub-title' => "Recent Events Committee List",
'action' => "/public/committee/view",
'button' => "Back",
'isAuth' => 0,
'route-name' => "",
'button2' => ""
]
@endphp
@include('layouts.user.landing-page.secondary-header', $data)

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
                                                        <div class="tab-content row justify-content-center">
                                                                <!-- TAB 1 -->
                                                                <div class="col-lg-9 tab-pane fade show active">
                                                                        <hr>
                                                                        <div class="table-responsive">
                                                                                <table class="table bg-white table-bordered table-hover collection-table" style="border: 2px solid #2f3138">
                                                                                        <thead style="background-color: #0e1b4d; color: #fff; border: 2px solid #2f3138">
                                                                                                <tr>
                                                                                                        <th style="width: 10px; border-bottom: 2px solid #2f3138;">#</th>
                                                                                                        <th style="border-bottom: 2px solid #2f3138;">Name</th>
                                                                                                        <th style="border-bottom: 2px solid #2f3138;">Role</th>
                                                                                                </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                                <tr>
                                                                                                        <td>1</td>
                                                                                                        <td><strong>{{$committeeDetails->userData->full_name}}</strong></td>
                                                                                                        <td><span class="badge bg-success text-white">Manager</span></td>
                                                                                                </tr>
                                                                                                @foreach ($memberDetails as $item)
                                                                                                <tr>
                                                                                                        <td>{{$loop->iteration + 1}}</td>
                                                                                                        <td>{{$item->full_name}}</td>
                                                                                                        <td><span class="badge bg-info text-white">Member</span></td>
                                                                                                </tr>
                                                                                                @endforeach
                                                                                        </tbody>
                                                                                </table>
                                                                        </div>

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

