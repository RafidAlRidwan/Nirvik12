@extends('layouts.user.user_navbar')

@section('style')
<link href="{{asset('assets/user/landingPage/custom-css/cus-data-table.css')}}" rel="stylesheet">

@endsection

@section('content')
<section id="speakers-details" class="wow fadeIn">
    <div class="container">
        <div class="section-header">
            <h2>List of Mates</h2>
        </div>
        <div id="app">
            <div class="box">
                <div class="row">

                    <div class="filter-box">
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">

                            <div class="containerr" style="margin-bottom: 10px;">
                                <div class="search_wrap search_wrap_4">
                                    <div class="search_box">
                                        <div class="btn btn_common">
                                            <i class="fa fa-search"></i>
                                        </div>
                                        <input type="text" name="search" v-on:keyup="changeName" id="search" class="input" placeholder="Search..." autocomplete="off">
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">

                            <div class="select-box">
                                <div v-on:click="sectionChange" class="options-container">
                                    <div class="option">
                                        <input type="radio" class="radio" id="all" name="platform" value="0" />
                                        <label for="all">Select All Section</label>
                                    </div>
                                    @foreach($section_all as $item)
                                    <div class="option">
                                        <input type="radio" class="radio" id="{{$item -> name}}" name="platform" value="{{$item -> name}}" />
                                        <label for="youtube">{{$item -> name}}</label>
                                    </div>
                                    @endforeach
                                </div>

                                <div class="selected">
                                    Select Section
                                </div>

                                <div class="search-box">
                                    <input type="text" placeholder="Start Typing..." />
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">

                            <div class="select-box">
                                <div v-on:click="shiftChange" class="options-container">
                                    <div class="option">
                                        <input type="radio" class="radio" id="all" name="platform" value="0" />
                                        <label for="all">Select All Shift</label>
                                    </div>
                                    @foreach($shift_all as $item)
                                    <div class="option">
                                        <input type="radio" class="radio" id="{{$item -> name}}" name="platform" value="{{$item -> name}}" />
                                        <label for="youtube">{{$item -> name}}</label>
                                    </div>
                                    @endforeach
                                </div>

                                <div class="selected2">
                                    Select Shift
                                </div>

                                <div class="search-box">
                                    <input type="text" placeholder="Start Typing..." />
                                </div>
                            </div>
                        </div>

                    </div>







                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">


                        <table id="index_datatable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Profile Picture</th>
                                    <th>Name</th>
                                    <th>Current City</th>
                                    <th>Section</th>
                                    <th>Shift</th>
                                </tr>
                            </thead>
                            <tbody>



                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Profile Picture</th>
                                    <th>Name</th>
                                    <th>Current City</th>
                                    <th>Section</th>
                                    <th>Shift</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>
        </div>
</section>



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
                    "buttons": ['pageLength', 'copy', 'csv', 'excel', 'pdf', 'print'],
                    "ajax": {
                        "url": "{{URL::to('/user/getdt')}}",
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
                            "data": "pp"
                        },
                        {
                            "data": "name"
                        },
                        {
                            "data": "city"
                        },
                        {
                            "data": "section"
                        },
                        {
                            "data": "shift"
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
<script type="text/javascript">
    /* custom button event print */
    // $(document).on('click', '#btnPrint', function(){
    //    $(".buttons-print")[0].click(); //trigger the click event
    // });
    // $('#index_datatable')
    //     .on( 'processing.dt', function ( e, settings, processing ) {
    //         $('#processingIndicator').css( 'display', processingg ? 'block' : 'none' );
    //     } )
    //     .dataTable();
    // $(document).on('click', '#btnReset', function(){
    //             location.reload(true);
    //         });
</script>

<script src="{{asset('assets/user/landingPage/js/cus-select.js')}}"></script>
@endsection