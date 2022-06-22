@extends('layouts.user.user-dashboard-master')

@section('style')
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

@endsection

@section('content')
<main id="home">
    <section id="speakers-details" class="wow fadeIn">
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
</main>




@endsection

@section('script')

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

<script src="{{asset('assets/user/landingPage/js/cus-select.js')}}"></script>
@endsection