@extends('layouts.user.landing-page.master')
@section('main-style')
<link rel="stylesheet" href="{{asset('assets/user/landingPage/datatable/css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/user/landingPage/datatable/css/fixedHeader.bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/user/landingPage/datatable/css/responsive.bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/user/landingPage/datatable/css/buttons.dataTables.min.css')}}">
<link href="{{asset('assets/user/landingPage/custom-css/cus-data-table.css')}}" rel="stylesheet">
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
<main id="home" style=" padding-top: 80px; padding-bottom: 36px; position: relative; animation: pop-in 2.5s ease-out;">
        <section id="speakers-details" class="wow fadeIn">
                <div class="container">
                        <div class="section-header">
                                <h2>{{$committeeDetails->name}} - Committee Details</h2>
                        </div>

                        <div class="row">

                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        <section id="schedule" class="section-with-bg">
                                                <div class="container wow fadeInUp">
                                                        @include('user.committee.navBar')
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

@section('main-script')
<script src="{{asset('assets/user/landingPage/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/user/landingPage/datatable/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('assets/user/landingPage/datatable/js/dataTables.fixedHeader.min.js')}}"></script>
<script src="{{asset('assets/user/landingPage/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/user/landingPage/datatable/js/responsive.bootstrap.min.js')}}"></script>
<script src="{{asset('assets/user/landingPage/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/user/landingPage/datatable/js/jszip.min.js')}}"></script>
<script src="{{asset('assets/user/landingPage/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{asset('assets/user/landingPage/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{asset('assets/user/landingPage/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/user/landingPage/datatable/js/buttons.print.min.js')}}"></script>
<script>
        $(function() {
                $('[data-toggle="tooltip"]').tooltip()
        })
</script>
@endsection