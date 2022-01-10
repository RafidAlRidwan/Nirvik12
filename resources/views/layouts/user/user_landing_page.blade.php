<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Nirvik'12</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicons -->
    <link href="{{asset('assets/user/landingPage/img/favicon.png')}}" rel="icon">
    <link href="{{asset('assets/user/landingPage/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="{{asset('assets/user/landingPage/css/googleFont.css')}}" rel="stylesheet">

    <!-- Bootstrap CSS File -->
    <link href="{{asset('assets/user/landingPage/lib/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Libraries CSS Files -->
    <link href="{{asset('assets/user/landingPage/lib/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/user/landingPage/lib/animate/animate.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/user/landingPage/lib/venobox/venobox.css')}}" rel="stylesheet">
    <link href="{{asset('assets/user/landingPage/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">

    <!-- Main Stylesheet File -->
    <link href="{{asset('assets/user/landingPage/css/style.css')}}" rel="stylesheet">

    <!-- Notification -->
    <link rel="stylesheet" href="{{asset('assets/user/landingPage/notification/css/jquery.notification.css')}}">
    <!-- Preloader -->
    <style type="text/css">
        ::-webkit-scrollbar {
            width: 0px;
            background: #000;
        }

        ::-webkit-scrollbar-track {
            border-radius: 5px;
            box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.25);
        }

        ::-webkit-scrollbar-thumb {
            border-radius: 5px;
            background-color: #f82249;
        }

        ::-webkit-scrollbar-thumb:hover {
            background-color: #f82249;
        }

        .loading {
            width: 100%;
            height: 100%;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #242f3f;
            z-index: 999999;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .loader {
            display: inline-block;
            width: 30px;
            height: 30px;
            position: relative;
            border: 4px solid #fff;
            animation: loader 2s infinite ease;
        }

        .loader-inner {
            vertical-align: top;
            display: inline-block;
            width: 100%;
            background-color: #f82249;
            animation: loader-inner 2s infinite ease-in;
        }

        @keyframes loader {
            0% {
                transform: rotate(0deg);
            }

            25% {
                transform: rotate(180deg);
            }

            50% {
                transform: rotate(180deg);
            }

            75% {
                transform: rotate(360deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        @keyframes loader-inner {
            0% {
                height: 0%;
            }

            25% {
                height: 0%;
            }

            50% {
                height: 100%;
            }

            75% {
                height: 100%;
            }

            100% {
                height: 0%;
            }
        }
    </style>




    <!-- =======================================================
    Theme Name: TheEvent
    Theme URL: https://bootstrapmade.com/theevent-conference-event-bootstrap-template/
    Author: BootstrapMade.com
    License: https://bootstrapmade.com/license/
  ======================================================= -->
</head>

<body>

    <div class="main-scope">

        <!-- Preloader -->
        <div class="loading">
            <span class="loader"><span class="loader-inner"></span></span>
        </div>
        <!--==========================
    Header
  ============================-->
        <header id="header">
            <div class="container">

                <div id="logo" class="pull-left">
                    <!-- Uncomment below if you prefer to use a text logo -->
                    <!-- <h1><a href="#main">C<span>o</span>nf</a></h1>-->
                    <a href="#intro" class="scrollto"><img src="{{asset('assets/user/landingPage/img/logo.png')}}" alt="" title=""></a>
                </div>
                @php
                $newsDetails = App\Models\News::orderBy('created_at', 'desc')->get();
                @endphp
                <nav id="nav-menu-container">
                    <ul class="nav-menu">
                        <li class="menu-active"><a href="#intro">Home</a></li>
                        <li><a href="#about">About</a></li>
                        <li><a href="#faq">News <span class="icon-button-badge">{{count($newsDetails)}}</span></a></li>
                        <li><a href="#hotels">Events <span class="icon-button-badge">2</span></a></li>
                        <li><a href="#gallery">Gallary</a></li>
                        <li class="buy-tickets"><a href="{{URL::to('user/login')}}">Login</a></li>
                    </ul>
                </nav><!-- #nav-menu-container -->
            </div>
        </header><!-- #header -->

        <!--==========================
    Intro Section
  ============================-->
        <section id="intro">
            <div class="intro-container wow fadeIn">
                <!-- <h1 class="mb-4 pb-0">The Annual<br><span>Marketing</span> Conference</h1> -->
                <!-- <p class="mb-4 pb-0">10-12 December, Downtown Conference Center, New York</p> -->
                <!-- <a href="https://www.youtube.com/watch?v=jDDaplaOz7Q" class="venobox play-btn mb-4" data-vbtype="video"
        data-autoplay="true"></a>
       <a href="#about" class="about-btn scrollto">About The Event</a> -->
                <span class="text1">Welcome In</span>
                <span class="text2">নির্ভীক' ১২</span>
            </div>
        </section>

        <main id="main">

            <!--==========================
      About Section
    ============================-->
            <section id="about">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <h2>About Nirvik'12</h2>
                            @php
                            $about = App\Models\About::where('id' , 1)->first();
                            @endphp
                            <p>{!! $about->description !!}</p>
                        </div>
                        <!-- <div class="col-lg-3">
            <h3>Where</h3>
            <p>Downtown Conference Center, New York</p>
          </div>
          <div class="col-lg-3">
            <h3>When</h3>
            <p>Monday to Wednesday<br>10-12 December</p>
          </div> -->
                    </div>
                </div>
            </section>



            <!--==========================
      Speakers Section
    ============================-->


            <!--==========================
      Schedule Section
    ============================-->


            <!--==========================
      Venue Section
    ============================-->


            <!--==========================
      Hotels Section
    ============================-->

            <!--==========================
      F.A.Q Section
    ============================-->
            <section id="faq" class="wow">

                <div class="container">

                    <div class="section-header">
                        <h2>NEWS</h2>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-9">
                            <ul id="faq-list">
                                @isset($newsDetails)
                                @foreach ($newsDetails as $item)
                                <li>
                                    <a data-toggle="collapse" class="collapsed" href="#faq{{$item->id}}">{{$item->heading}}<i class="fa fa-minus-circle"></i></a>
                                    <div id="faq{{$item->id}}" class="collapse" data-parent="#faq-list">
                                        {!!$item->body!!}
                                    </div>
                                </li>
                                @endforeach
                                @endisset

                                <a style="text-align: center;" class="text-danger pt-1 mb-0 {{ isset($newsDetails) && !$newsDetails->isEmpty() ? "d-none" : "" }}" id="notice-tools-technology-info" role="notice">
                                    <i class="icon-info22 mr-1" aria-hidden="true"></i> {!! __("No news has been added!") !!}
                                </a>
                            </ul>
                        </div>
                    </div>

                </div>

            </section>
            <section id="hotels" class="section-with-bg wow">

                <div class="container">
                    <div class="section-header">
                        <h2>UPCOMING EVENTS</h2>
                        <!-- <p>Her are some nearby hotels</p> -->
                    </div>

                    <div style="justify-content: center" class="row">

                        <div class="col-lg-4 col-md-6">
                            <div class="hotel">
                                <div class="hotel-img">
                                    <img src="{{asset('assets/user/landingPage/img/hotels/1.jpg')}}" alt="Hotel 1" class="img-fluid">
                                </div>
                                <h3><a href="#">Event 1</a></h3>

                                <p>0.4 Mile from the Venue</p>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="hotel">
                                <div class="hotel-img">
                                    <img src="{{asset('assets/user/landingPage/img/hotels/2.jpg')}}" alt="Hotel 2" class="img-fluid">
                                </div>
                                <h3><a href="#">Event 2</a></h3>

                                <p>0.5 Mile from the Venue</p>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="hotel">
                                <div class="hotel-img">
                                    <img src="{{asset('assets/user/landingPage/img/hotels/3.jpg')}}" alt="Hotel 3" class="img-fluid">
                                </div>
                                <h3><a href='#' data-toggle='modal' data-target='#exampleModalCenter'><button class='btn_edit' style='background:none; border: none; font-weight: bold; color: #152b79;'>Event 3</i></button> </a></h3>


                                <p>0.6 Mile from the Venue</p>
                            </div>
                        </div>




                    </div>
                </div>
                <!-- MODAL -->
                <!-- Button trigger modal -->
                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div style="background: white; background: linear-gradient( to right bottom,
                    rgba(255, 255, 255, 0.7), rgba(255, 255, 255, 0.3)); border-radius: 1rem; z-index: 2; backdrop-filter: blur(2rem);" class="modal-content">
                            <div class="modal-header">
                                <h5 style="color: #f82249; font-weight: bold;" class="modal-title" id="exampleModalCenterTitle">Event title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div style="color: #000;" class="modal-body">

                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. </div>
                            <div class="modal-footer">

                            </div>
                        </div>
                    </div>
                </div>
                <!-- END MODAL -->
            </section>

            <!--==========================
      Gallery Section
    ============================-->
            <!-- fadeInUp -->
            <section id="gallery" class="wow">

                <div class="container">
                    <div class="section-header">
                        <h2>Gallery</h2>
                        <p>Check our gallery from the recent events</p>
                    </div>
                </div>

                <div class="owl-carousel gallery-carousel">
                    <a href="{{asset('assets/user/landingPage/img/gallery/1.jpg')}}" class="venobox" data-gall="gallery-carousel"><img src="{{asset('assets/user/landingPage/img/gallery/1.jpg')}}" alt=""></a>
                    <a href="{{asset('assets/user/landingPage/img/gallery/2.jpg')}}" class="venobox" data-gall="gallery-carousel"><img src="{{asset('assets/user/landingPage/img/gallery/2.jpg')}}" alt=""></a>
                    <a href="{{asset('assets/user/landingPage/img/gallery/3.jpg')}}" class="venobox" data-gall="gallery-carousel"><img src="{{asset('assets/user/landingPage/img/gallery/3.jpg')}}" alt=""></a>
                    <a href="{{asset('assets/user/landingPage/img/gallery/4.jpg')}}" class="venobox" data-gall="gallery-carousel"><img src="{{asset('assets/user/landingPage/img/gallery/4.jpg')}}" alt=""></a>
                    <a href="{{asset('assets/user/landingPage/img/gallery/5.jpg')}}" class="venobox" data-gall="gallery-carousel"><img src="{{asset('assets/user/landingPage/img/gallery/5.jpg')}}" alt=""></a>
                    <a href="{{asset('assets/user/landingPage/img/gallery/6.jpg')}}" class="venobox" data-gall="gallery-carousel"><img src="{{asset('assets/user/landingPage/img/gallery/6.jpg')}}" alt=""></a>
                    <a href="{{asset('assets/user/landingPage/img/gallery/7.jpg')}}" class="venobox" data-gall="gallery-carousel"><img src="{{asset('assets/user/landingPage/img/gallery/7.jpg')}}" alt=""></a>
                    <a href="{{asset('assets/user/landingPage/img/gallery/8.jpg')}}" class="venobox" data-gall="gallery-carousel"><img src="{{asset('assets/user/landingPage/img/gallery/8.jpg')}}" alt=""></a>
                </div>

            </section>

            <!--==========================
      Sponsors Section
    ============================-->
            <!-- fadeInUp -->
            <section id="supporters" class="section-with-bg wow ">

                <div class="container">
                    <div class="section-header">
                        <h2>Sponsors</h2>
                    </div>

                    <div style="justify-content: center" class="row no-gutters supporters-wrap clearfix">

                        <div class="col-lg-3 col-md-4 col-xs-6">
                            <div class="supporter-logo">
                                <img src="{{asset('assets/user/landingPage/img/supporters/1.png')}}" class="img-fluid" alt="">
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-xs-6">
                            <div class="supporter-logo">
                                <img src="{{asset('assets/user/landingPage/img/supporters/2.png')}}" class="img-fluid" alt="">
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-xs-6">
                            <div class="supporter-logo">
                                <img src="{{asset('assets/user/landingPage/img/supporters/3.png')}}" class="img-fluid" alt="">
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-4 col-xs-6">
                            <div class="supporter-logo">
                                <img src="{{asset('assets/user/landingPage/img/supporters/4.png')}}" class="img-fluid" alt="">
                            </div>
                        </div>




                    </div>

                </div>

            </section>



            <!--==========================
      Subscribe Section
    ============================-->


            <!--==========================
      Buy Ticket Section
    ============================-->


            <!--==========================
      Contact Section
    ============================-->


            <!--==========================
    Footer
  ============================-->
            <div class="animation-area">
                <footer id="footer">

                    <ul class="box-area">
                        <li><img src={{asset('assets/user/landingPage/img/box1.png')}} width="80" height="80" style="border-radius: 50%" /></li>
                        <li><img src={{asset('assets/user/landingPage/img/box1.png')}} width="30" height="30" style="border-radius: 50%" /></li>
                        <li><img src={{asset('assets/user/landingPage/img/box1.png')}} width="40" height="40" style="border-radius: 50%" /></li>
                        <li><img src={{asset('assets/user/landingPage/img/box1.png')}} width="50" height="50" style="border-radius: 50%" /></li>
                        <li><img src={{asset('assets/user/landingPage/img/box1.png')}} width="40" height="40" style="border-radius: 50%" /></li>
                        <li><img src={{asset('assets/user/landingPage/img/box1.png')}} width="45" height="45" style="border-radius: 50%" /></li>
                    </ul>

                    <div class="footer-top">
                        <div class="container">
                            <div class="row">

                                <div class="col-lg-6 col-md-6 footer-info">
                                    <img src="{{asset('assets/user/landingPage/img/logo.png')}}" alt="TheEvenet">
                                    <p>In alias aperiam. Placeat tempore facere. Officiis voluptate ipsam vel eveniet est dolor et totam porro. Perspiciatis ad omnis fugit molestiae recusandae possimus. Aut consectetur id quis. In inventore consequatur ad voluptate cupiditate debitis accusamus repellat cumque.</p>
                                </div>

                                <div class="col-lg-6 col-md-6 footer-contact">
                                    <h4>Contact Us</h4>
                                    <p>
                                        A108 Adam Street <br>
                                        New York, NY 535022<br>
                                        United States <br>
                                        <strong>Phone:</strong> +1 5589 55488 55<br>
                                        <strong>Email:</strong> info@example.com<br>
                                    </p>

                                    <div class="social-links">
                                        <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
                                        <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
                                        <a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
                                        <a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>
                                        <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="container">
                        <div class="copyright">
                            &copy; Copyright <strong>Nirvik'12</strong>. All Rights Reserved
                        </div>
                        <div class="credits">
                            <!--
          All the links in the footer should remain intact.
          You can delete the links only if you purchased the pro version.
          Licensing information: https://bootstrapmade.com/license/
          Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=TheEvent
        -->
                            Designed by <a href="www.nirvik12.com/">Nirvik'12 TEAM</a>
                        </div>
                    </div>

                </footer><!-- #footer -->
            </div>
            <a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>

            <!-- JavaScript Libraries -->
            <script src="{{asset('assets/user/landingPage/lib/jquery/jquery.min.js')}}"></script>
            <script src="{{asset('assets/user/landingPage/lib/jquery/jquery-migrate.min.js')}}"></script>
            <script src="{{asset('assets/user/landingPage/lib/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
            <script src="{{asset('assets/user/landingPage/lib/easing/easing.min.js')}}"></script>
            <script src="{{asset('assets/user/landingPage/lib/superfish/hoverIntent.js')}}"></script>
            <script src="{{asset('assets/user/landingPage/lib/superfish/superfish.min.js')}}"></script>
            <script src="{{asset('assets/user/landingPage/lib/wow/wow.min.js')}}"></script>
            <script src="{{asset('assets/user/landingPage/lib/venobox/venobox.min.js')}}"></script>
            <script src="{{asset('assets/user/landingPage/lib/owlcarousel/owl.carousel.min.js')}}"></script>

            <!-- Contact Form JavaScript File -->
            <script src="{{asset('assets/user/landingPage/contactform/contactform.js')}}"></script>



            <!-- Template Main Javascript File -->
            <script src="{{asset('assets/user/landingPage/js/main.js')}}"></script>

            <!-- Preloader -->
            <script type="text/javascript">
                $(window).on('load', function() {
                    $('.loading').delay(450).fadeOut('slow');
                    $('body').delay(450).css({
                        'overflow': 'visible'
                    });
                });
            </script>





    </div>
</body>

</html>
