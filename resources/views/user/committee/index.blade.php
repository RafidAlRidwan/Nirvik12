@extends('layouts.user.landing-page.master')

@section('main-style')
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
        /* background: #e6fbf6; */
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
            <h2 style="font-weight: bold;" class="page-title">#Events & Program Committees</h1>
                <div class="content">
                    <p style="font-weight: bold;" class="lead">Recent Events Committee List</p>
                    <!-- <p>
                                          <a class="btn btn-info" href="#">View All</a>
                                   </p> -->
                </div>
        </div>
    </div>
</section>
<section id="schedule" class="wow fadeUp">
    <div class="container">
        <div class="section-header">
            <h2>Event Committees</h2>
        </div>
        <div id="app">
            <div class="box">
                <div class="row">

                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">

                        <table id="index_datatable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Serial</th>
                                    <th>Event</th>
                                    <th>Committee Name</th>
                                    <th>Manager</th>
                                    <th>Total Member</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>



                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Serial</th>
                                    <th>Event</th>
                                    <th>Committee Name</th>
                                    <th>Manager</th>
                                    <th>Total Member</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>
        </div>
</section>

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
<script src="{{asset('assets/user/landingPage/custom-select/js/jquery.nice-select.min.js')}}"></script>
<script src="{{asset('assets/user/landingPage/custom-select/js/fastclick.js')}}"></script>
<script src="{{asset('assets/user/landingPage/custom-select/js/prism.js')}}"></script>
<script src="{{asset('assets/user/landingPage/js/cus-select.js')}}"></script>

<script type="text/javascript">
    var app = new Vue({
        el: '#app',
        created: function() {
            $(document).ready(function() {
                window.csrfToken = '<?php echo csrf_token(); ?>';
                var postData = {};
                postData._token = window.csrfToken;

                var table = $('#index_datatable').DataTable({
                    "responsive": true,
                    "processing": true,
                    "serverSide": true,
                    "dom": 'Bfrtip',
                    "lengthMenu": [
                        [10, 25, 50, 100, 200, 250],
                        ['10 rows', '25 rows', '50 rows', '100 rows', '200 rows', '250 rows']
                    ],
                    // "buttons": ['pageLength', 'copy', 'csv', 'excel', 'pdf', 'print'],
                    "buttons": ['pageLength'],
                    "ajax": {
                        "url": "{{URL::to('/user/committee/getdata')}}",
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
                            "data": "event_name"
                        },
                        {
                            "data": "committee_name"
                        },
                        {
                            "data": "manager_name"
                        },
                        {
                            "data": "total_member"
                        },
                        {
                            "data": "action"
                        },


                    ]
                });

                new $.fn.dataTable.FixedHeader(table);
            });


        },
        methods: {
            sectionChange: function(evt) {
                var previousFilter = $('#index_datatable').data('dt_params');
                var filterables = {};
                if (previousFilter != undefined) {
                    filterables = $('#index_datatable').data('dt_params');
                }

                var sectionSelected = $(".selected").text();
                if (sectionSelected != "") {
                    filterables.section = sectionSelected;
                } else {
                    filterables.section = 0;
                }
                $('#index_datatable').data('dt_params', filterables);
                $('#index_datatable').DataTable().draw();
            },

            shiftChange: function(evt) {
                var previousFilter = $('#index_datatable').data('dt_params');
                var filterables = {};
                if (previousFilter != undefined) {
                    filterables = $('#index_datatable').data('dt_params');
                }

                var shiftSelected = $(".selected2").text();
                if (shiftSelected != "") {
                    filterables.shift = shiftSelected;
                } else {
                    filterables.shift = 0;
                }
                $('#index_datatable').data('dt_params', filterables);
                $('#index_datatable').DataTable().draw();
            },

            changeName: function(evt) {

                var previousFilter = $('#index_datatable').data('dt_params');
                var filterables = {};
                if (previousFilter != undefined) {
                    filterables = $('#index_datatable').data('dt_params');
                }

                var nameSelected = $("#search").val();
                if (nameSelected != "") {
                    filterables.name = nameSelected;
                } else {
                    filterables.name = 0;
                }
                $('#index_datatable').data('dt_params', filterables);
                $('#index_datatable').DataTable().draw();
            }
        }



    })
</script>
<script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>

@endsection