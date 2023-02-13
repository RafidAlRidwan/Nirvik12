@extends('layouts.user.landing-page.master')
@section('main-style')
<!-- DATA TABLE -->
<link rel="stylesheet" href="{{asset('assets/user/landingPage/datatable/css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/user/landingPage/datatable/css/fixedHeader.bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/user/landingPage/datatable/css/responsive.bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/user/landingPage/datatable/css/buttons.dataTables.min.css')}}">

<link href="{{asset('assets/user/landingPage/custom-css/cus-data-table.css')}}" rel="stylesheet">

<style>
        .btn-custom {
                background-color: #2f3640;
        }

        .btn-custom:hover {
                background-color: #fff;
                border-color: #f82249;
        }

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

        table.dataTable {
                border-collapse: collapse;
        }

        .nice-select {
                width: 100%;
        }

        .nice-select .option:hover,
        .nice-select .option.focus,
        .nice-select .option.selected.focus {
                padding-top: 2px;
                padding-bottom: 2px;
        }
</style>
<link rel="stylesheet" href="{{asset('assets/user/landingPage/custom-select/css/style.css')}}">

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
                        <h2 style="font-weight: bold;" class="page-title">#Committees Details</h1>
                                <div class="content">
                                        <p style="font-weight: bold;" class="lead">Recent Events Registration List</p>
                                        <p>
                                                <a style="background-color: #ff4d6d; border: 1px solid #ff4d6d;" href="{{url('/public/committee/view')}}" class="btn btn-info btn-sm" href="#">Back</a>
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
                                                                        <a class="nav-link" data-toggle="tooltip" data-placement="top" title="Committee Members" href="{{URL::to('/public/committee/details/'.$committeeDetails['id'])}}">Members</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                        <a class="nav-link active" data-toggle="tooltip" data-placement="top" title="Registration Done List" href="{{URL::to('/public/committee/registration/'.$committeeDetails['id'])}}">Registrations</a>
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
                                                                        <div class="row">
                                                                                <div class="div-gap col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4 mb-2">
                                                                                        {!! Form::select('section', $sections, null, ['placeholder'=>__('All Section') ,'id'=>'changeSection', 'class'=>'wide']) !!}
                                                                                </div>
                                                                        </div>
                                                                        <div class="row">

                                                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">

                                                                                        <table id="index_datatable" class="table table-hover">
                                                                                                <thead>
                                                                                                        <tr>
                                                                                                                <th>Serial</th>
                                                                                                                <th>Name</th>
                                                                                                                <th>Section</th>
                                                                                                                <th>Status</th>
                                                                                                        </tr>
                                                                                                </thead>
                                                                                                <tbody>



                                                                                                </tbody>
                                                                                                <tfoot>
                                                                                                        <tr>
                                                                                                                <th>Serial</th>
                                                                                                                <th>Name</th>
                                                                                                                <th>Section</th>
                                                                                                                <th>Status</th>
                                                                                                        </tr>
                                                                                                </tfoot>
                                                                                        </table>
                                                                                </div>

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

@section('main-script')
<script>
        $(function() {
                $('[data-toggle="tooltip"]').tooltip()
        });
</script>
<!-- DATA TABLES -->
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
<script src="{{asset('assets/user/landingPage/custom-select/js/jquery.nice-select.min.js')}}"></script>
<script src="{{asset('assets/user/landingPage/custom-select/js/fastclick.js')}}"></script>
<script src="{{asset('assets/user/landingPage/custom-select/js/prism.js')}}"></script>
<script>
        $(document).ready(function() {
                $('#changeSection').niceSelect();
                FastClick.attach(document.body);
        });
</script>
<script>
        $(document).ready(function() {
                window.csrfToken = '<?php echo csrf_token(); ?>';
                var postData = {};
                postData._token = window.csrfToken;
                var id = <?php echo $committeeDetails->id ?>;

                var table = $('#index_datatable').DataTable({
                        "responsive": true,
                        "processing": true,
                        "serverSide": true,
                        "searching": true,
                        "dom": 'Bfrtip',
                        "lengthMenu": [
                                [10, 25, 50, 100, 200, 250],
                                ['10 rows', '25 rows', '50 rows', '100 rows', '200 rows', '250 rows']
                        ],
                        // "buttons": ['pageLength', 'copy', 'csv', 'excel', 'pdf', 'print'],
                        "buttons": ['pageLength'],
                        "ajax": {
                                "url": "{{URL::to('/public/registration/getdata')}}" + '/' + id,
                                "type": "POST",
                                "data": function(d) {
                                        $.extend(d, postData);
                                        var dt_params = $('#index_datatable').data('dt_params');
                                        if (dt_params) {
                                                $.extend(d, dt_params);
                                        }
                                }
                        },
                        "destroy": true,
                        "columns": [{
                                        "data": "serial"
                                },
                                {
                                        "data": "name"
                                },
                                {
                                        "data": "section"
                                },
                                {
                                        "data": "status"
                                },

                        ]
                });

                new $.fn.dataTable.FixedHeader(table);
        });
        $('#changeSection').on('change', function() {
                var previousFilter = $('#index_datatable').data('dt_params');
                var filterables = {};
                if (previousFilter != undefined) {
                        filterables = $('#index_datatable').data('dt_params');
                }

                var sectionSelected = $(this).val();
                if (sectionSelected != "") {
                        filterables.section = sectionSelected;
                } else {
                        filterables.section = 0;
                }
                $('#index_datatable').data('dt_params', filterables);
                $('#index_datatable').DataTable().draw();
        });
</script>
@endsection