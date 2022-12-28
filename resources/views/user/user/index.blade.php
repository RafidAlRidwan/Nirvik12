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

    canvas {
        display: block;
        width: 200px;
        height: 200px;
        margin: 0 auto;
    }

    #speakers-details {
        padding: 0px 0;
    }
</style>

@endsection

@section('content')
<main id="home">
    <section id="speakers-details" class="wow fadeIn">
        <div class="container">
            <div class="section-header">
                <canvas id="celebration"></canvas>
                <h2>List of Mates</h2>
            </div>

            <div id="app">
                <div class="box">
                    <div class="row">

                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">

                            <div class="containerr">
                                <div class="search_wrap search_wrap_4 mb-2">
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
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <table id="index_datatable" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Profile Picture</th>
                                        <th>Name</th>
                                        <th>Mobile Number</th>
                                        <th>Current City</th>
                                        <th>Section</th>
                                        <th>Shift</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>



                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Profile Picture</th>
                                        <th>Name</th>
                                        <th>Mobile Number</th>
                                        <th>Current City</th>
                                        <th>Section</th>
                                        <th>Shift</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
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
                    "buttons": ['pageLength'],
                    // "buttons": ['pageLength', 'copy', 'csv', 'excel', 'pdf', 'print'],
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
                            "data": "mobile"
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
<script>
    /* 
     *
     * Modified and customized version of Szenia Zadvornykh’s work, “Party
     * Preloader,” on Codepen: https://codepen.io/zadvorsky/pen/CoDes
     * 
     */
    Point = function(x, y) {
        this.x = x || 0;
        this.y = y || 0;
    };

    Particle = function(ctx, p0, p1, p2, p3) {
        this.ctx = ctx;
        this.p0 = p0;
        this.p1 = p1;
        this.p2 = p2;
        this.p3 = p3;

        this.time = 0;
        this.duration = 3 + Math.random() * 1;
        this.color = '#' + Math.floor((Math.random() * 0xffffff)).toString(16);

        this.w = 8;
        this.h = 6;

        this.complete = false;
    };

    Particle.prototype = {
        update: function() {
            // (1/60) is timeStep
            this.time = Math.min(this.duration, this.time + (1 / 60));

            var f = Ease.outCubic(this.time, .0125, 1, this.duration);
            var p = cubeBezier(this.p0, this.p1, this.p2, this.p3, f);

            var dx = p.x - this.x;
            var dy = p.y - this.y;

            this.r = Math.atan2(dy, dx) + (Math.PI * 0.5);
            this.sy = Math.sin(Math.PI * f * 10);
            this.x = p.x;
            this.y = p.y;

            this.complete = this.time === this.duration;
        },
        draw: function() {
            this.ctx.save();
            this.ctx.translate(this.x, this.y);
            this.ctx.rotate(this.r);
            this.ctx.scale(1, this.sy);

            this.ctx.fillStyle = this.color;
            this.ctx.fillRect(-this.w * 0.5, -this.h * 0.5, this.w, this.h);

            this.ctx.restore();
        }
    };

    function CelebrationCanvas(canvas, width, height) {
        var particles = [];
        var ctx = canvas.getContext('2d');

        canvas.width = width;
        canvas.height = height;
        createParticles();

        function animate() {
            requestAnimationFrame(loop);
        }

        function createParticles() {
            for (var i = 0; i < 128; i++) {
                var p0 = new Point(width * 0.5, height * 0.5);
                var p1 = new Point(Math.random() * width, Math.random() * height);
                var p2 = new Point(Math.random() * width, Math.random() * height);
                var p3 = new Point(Math.random() * width, height + 64);

                particles.push(new Particle(ctx, p0, p1, p2, p3));
            }
        }

        function update() {
            particles.forEach(function(p) {
                p.update();
            });
        }

        function draw() {
            ctx.clearRect(0, 0, width, height);
            particles.forEach(function(p) {
                p.draw();
            });
        }

        function loop() {
            update();
            draw();

            if (checkParticlesComplete()) {
                // reset
                particles.length = 0;
                createParticles();
                setTimeout(function() {
                    animate();
                }, (Math.random() * 2000));
            } else {
                animate();
            }
        }

        function checkParticlesComplete() {
            for (var i = 0; i < particles.length; i++) {
                if (particles[i].complete === false) return false;
            }
            return true;
        }

        return {
            animate: animate
        };
    }

    var celebrationCanvas = new CelebrationCanvas(document.getElementById('celebration'), 600, 600);

    celebrationCanvas.animate();

    /**
     * easing equations from http://gizma.com/easing/
     * t = current time
     * b = start value
     * c = delta value
     * d = duration
     */
    var Ease = {
        inCubic: function(t, b, c, d) {
            t /= d;
            return c * t * t * t + b;
        },
        outCubic: function(t, b, c, d) {
            t /= d;
            t--;
            return c * (t * t * t + 1) + b;
        },
        inOutCubic: function(t, b, c, d) {
            t /= d / 2;
            if (t < 1) return c / 2 * t * t * t + b;
            t -= 2;
            return c / 2 * (t * t * t + 2) + b;
        },
        inBack: function(t, b, c, d, s) {
            s = s || 1.70158;
            return c * (t /= d) * t * ((s + 1) * t - s) + b;
        }
    };

    function cubeBezier(p0, c0, c1, p1, t) {
        var p = new Point();
        var nt = (1 - t);

        p.x = nt * nt * nt * p0.x + 3 * nt * nt * t * c0.x + 3 * nt * t * t * c1.x + t * t * t * p1.x;
        p.y = nt * nt * nt * p0.y + 3 * nt * nt * t * c0.y + 3 * nt * t * t * c1.y + t * t * t * p1.y;

        return p;
    }
</script>
@endsection