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
<link rel="stylesheet" href="{{asset('assets/user/landingPage/custom-select/css/style.css')}}">

<link rel="stylesheet" href="{{asset('assets/user/landingPage/custom-css/custom-select-field.css')}}">

@endsection
@section('header')
<!-- ======= Header Assets ======= -->
@include('layouts.user.landing-page.header')
@endsection
@section('main-content')
<main id="home" style=" padding-top: 0px; padding-bottom: 36px; position: relative; animation: pop-in 2.5s ease-out;">
    <section id="speakers-details" class="wow fadeIn">
        <div class="container">
            <div class="section-header">
                <canvas id="celebration"></canvas>
                <h2>List of Mates</h2>
            </div>
            <div id="app">
                <div class="boxes">
                    <div class="row">
                        <div class="col-lg-3 col-md-5 col-12 fixme">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">

                                <div class="containerr">
                                    <div class="search_wrap search_wrap_4 mb-2">
                                        <div class="search_box">
                                            <div class="btn btn_common">
                                                <i class="fa fa-search"></i>
                                            </div>
                                            <input type="text" name="search" id="search" class="input" placeholder="Search..." autocomplete="off">
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">

                                <select id="section" class="wide mb-3" aria-label="Default select example">
                                    <option value="0" selected>Select Section</option>
                                    @foreach ($section_all as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>

                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <select id="shift" class="wide mb-3" aria-label="Default select example">
                                    <option value="0" selected>Select Shift</option>
                                    @foreach ($shift_all as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>


                        </div>
                        <div class="col-lg-9 col-md-8 col-12" id="content_area">

                        </div>


                    </div>

                </div>
            </div>
        </div>
    </section>
</main>

@endsection

@section('main-script')
<!-- CUSTOM SELECT -->
<script src="{{asset('assets/user/landingPage/custom-select/js/jquery.nice-select.min.js')}}"></script>
<script src="{{asset('assets/user/landingPage/custom-select/js/fastclick.js')}}"></script>
<script src="{{asset('assets/user/landingPage/custom-select/js/prism.js')}}"></script>
<script>
    $(document).ready(function() {
        $('select:not(.ignore)').niceSelect();
        FastClick.attach(document.body);
    });
</script>

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

<script>
    getItems();
    // $(".btn_common").click(function(e) {
    //     e.preventDefault();
    //     var search = $('#search').val();
    //     getItems(search, null, null, null);
    // })
    $('#search').on("keyup change", function(e) {
        e.preventDefault();
        getItems(null, null, null, null);
    })

    $("#section").on('change', function(e) {
        e.preventDefault()
        var section = $(this).val();
        if (section == 0) {
            getItems(null, null, null, null);
        } else {
            getItems(null, section, null, null, );
        }
    });

    $("#shift").on('change', function(e) {
        e.preventDefault()
        var shift = $(this).val();
        if (shift == 0) {
            getItems(null, null, null, null);
        } else {
            getItems(null, null, shift, null, );
        }
    });

    $(document).on("click", ".page-link", function(e) {
        e.preventDefault();
        var page = $(this).attr("data-page");
        getItems(null, null, null, page);
    });

    function getItems(search = null, section = null, shift = null, page = null) {
        // $('.loading').show();
        var search = $('#search').val();
        if (search !== null) {
            var search = search;
        } else {
            var search = null;
        }

        var section = $('#section').val();
        if (section !== null) {
            if (section == 0) {
                var section = null;
            } else {
                var section = section;
            }
        } else {
            var section = null;
        }

        var shift = $('#shift').val();
        if (shift !== null) {
            if (shift == 0) {
                var shift = null;
            } else {
                var shift = shift;
            }
        } else {
            var shift = null;
        }

        let url = '{{ route("load.data") }}';
        $.ajax({
                url: url,
                type: "get",
                data: {
                    search,
                    section,
                    shift,
                    page
                },
            })
            .done(function(response) {
                document.body.scrollTop = 0;
                document.documentElement.scrollTop = 0;
                $('#content_area').html(response);
            })
            .fail(function(jqXHR, ajaxOptions, thrownError) {
                // $('.loading').hide();
                alert('server not responding...');
                $('#content_area').empty();
            });
    }
</script>
@endsection