@extends('layouts.user.landing-page.master')

@section('header')
       <!-- ======= Header Assets ======= -->
       @include('layouts.user.landing-page.header')
@endsection

@section('main-content')
       <!--==========================Cover Page Section============================-->
       <section class="home">
              <div class="media-icons">
                     <a href="#"><i class="fa fa-facebook"></i></a>
                     <a href="#"><i class="fa fa-instagram"></i></a>
                     <a href="#"><i class="fa fa-twitter"></i></a>
              </div>

              <div class="swiper bg-slider">
                     <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                   <img src={{asset('assets/user/landingPage/slider/images/bg1.jpg')}} alt="">
                                   <div class="text-content">
                                          <h2 class="title">Autumn <span>Season</span></h2>
                                          <p>Autumn, also known as fall in North American English, is one of the four temperate
                                                 seasons. Outside the tropics, autumn marks the transition from summer to winter,
                                                 in September or March. Autumn is the season when the duration of daylight becomes
                                                 noticeably shorter and the temperature cools considerably.</p>
                                   </div>
                            </div>
                            <div class="swiper-slide dark-layer">
                                   <img src={{asset('assets/user/landingPage/slider/images/bg2.jpg')}} alt="">
                                   <div class="text-content">
                                          <h2 class="title">Winter <span>Season</span></h2>
                                          <p>Winter is the coldest season of the year in polar and temperate zones. It occurs
                                                 between autumn and spring.The tilt of Earth's axis causes seasons; winter occurs
                                                 when a hemisphere is oriented away from the Sun. Different cultures define different
                                                 dates as the start of winter, and some use a definition based on weather.</p>
                                   </div>
                            </div>
                            <div class="swiper-slide dark-layer">
                                   <img src={{asset('assets/user/landingPage/slider/images/bg3.jpg')}} alt="">
                                   <div class="text-content">
                                          <h2 class="title">Summer <span>Season</span></h2>
                                          <p>Summer is the hottest of the four temperate seasons, occurring after spring and
                                                 before autumn. At or aroundthe summer solstice, the earliest sunrise and latest
                                                 sunset occurs, daylight hours are longest and dark hours are shortest, with day
                                                 length decreasing as the season progresses after the solstice.</p>
                                   </div>
                            </div>
                            <div class="swiper-slide">
                                   <img src={{asset('assets/user/landingPage/slider/images/bg4.jpg')}} alt="">
                                   <div class="text-content">
                                          <h2 class="title">Spring <span style="color: #fff;">Season</span></h2>
                                          <p>Spring, also known as springtime, is one of the four temperate seasons, succeeding
                                                 winter and preceding summer. There are various technical definitions of spring, but
                                                 local usage of the term varies according to local climate, cultures and customs. When
                                                 it is spring in the Northern Hemisphere, it is autumn in the Southern Hemisphere and
                                                 vice versa.</p>
                                   </div>
                            </div>
                            <div class="swiper-slide">
                                   <img src={{asset('assets/user/landingPage/slider/images/bg5.jpg')}} alt="">
                                   <div class="text-content">
                                          <h2 class="title">Ifter <span style="color: #fff;">2021</span></h2>
                                          <p>The only reason why we love school is because it's the place where all my friends are!</p>
                                   </div>
                            </div>
                     </div>
              </div>

              <div class="bg-slider-thumbs">
                     <div class="swiper-wrapper thumbs-container">
                            <img src={{asset('assets/user/landingPage/slider/images/bg1.jpg')}} class="swiper-slide" alt="">
                            <img src={{asset('assets/user/landingPage/slider/images/bg2.jpg')}} class="swiper-slide" alt="">
                            <img src={{asset('assets/user/landingPage/slider/images/bg3.jpg')}} class="swiper-slide" alt="">
                            <img src={{asset('assets/user/landingPage/slider/images/bg4.jpg')}} class="swiper-slide" alt="">
                            <img src={{asset('assets/user/landingPage/slider/images/bg5.jpg')}} class="swiper-slide" alt="">
                     </div>
              </div>
       </section>
       <!--==========================About Section============================-->
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
                     </div>
              </div>
       </section>

       <!--==========================News Section============================-->
       <section id="faq" class="wow fadeInUp">
              <div class="container">
                     <div class="section-header">
                            <h2>NEWS</h2>
                            <p><a style="color: blue;" href={{URL::to('/news')}}>See All</a></p>
                     </div>
                     <div class="row justify-content-center">
                            <div class="col-lg-9">
                                   <ul id="faq-list">
                                          @php
                                                 $newsDetails = App\Models\News::all();
                                          @endphp
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
       <!--==========================Event Section============================-->
       <section id="schedule" class="section-with-bg">
              <div class="container wow fadeInUp">
                     <div class="section-header">
                     <h2>Event & Program Schedule</h2>
                     <p><a style="color: blue;" href={{URL::to('/events')}}>See All</a></p>
                     </div>
                     @php
                            $current_month = date('F');
                            $next_month_1 = date('F', strtotime('first day of +1 month'));
                            $next_month_2 = date('F', strtotime('first day of +2 month'));
                     @endphp
                     <ul class="nav nav-tabs" role="tablist">
                     <li class="nav-item">
                     <a class="nav-link active" href="#day-1" role="tab" data-toggle="tab">{{$current_month}}</a>
                     </li>
                     <li class="nav-item">
                     <a class="nav-link" href="#day-2" role="tab" data-toggle="tab">{{$next_month_1}}</a>
                     </li>
                     <li class="nav-item">
                     <a class="nav-link" href="#day-3" role="tab" data-toggle="tab">{{$next_month_2}}</a>
                     </li>
                     </ul>

                     <div class="tab-content row justify-content-center">

                     <!-- Schdule Day 1 -->
                     <div role="tabpanel" class="col-lg-9 tab-pane fade show active" id="day-1">

                     <div class="row schedule-item">
                            <div class="date col-md-2">
                                   <time datetime="23th feb">
                                          <span>02</span><span>MAY</span>
                                   </time>
                            </div>
                            <div class="col-md-10">
                            <div class="speaker">
                            </div>
                            
                            <h4><a href="#" data-toggle='modal' data-target='#event-details' title='' body=''>Registration</a></h4>
                            <p><i class="fa fa-map-marker"></i> Bogura Zilla School</p>
                            </div>
                     </div>

                     <div class="row schedule-item">
                            <div class="date col-md-2">
                                   <time datetime="23th feb">
                                          <span>02</span><span>MAY</span>
                                   </time>
                            </div>
                            <div class="col-md-10">
                            <div class="speaker">
                            </div>
                            <h4>Ifter 2022</h4>
                            <p><i class="fa fa-map-marker"></i> Momo Inn</p>
                            </div>
                     </div>


                     </div>
                     <!-- End Schdule Day 1 -->

                     <!-- Schdule Day 2 -->
                     <div role="tabpanel" class="col-lg-9  tab-pane fade" id="day-2">

                     <div class="row schedule-item">
                            <div class="date col-md-2">
                                   <time datetime="23th feb">
                                          <span>02</span><span>MAY</span>
                                   </time>
                            </div>
                            <div class="col-md-10">
                            <div class="speaker">
                            </div>
                            <h4>Libero corrupti explicabo itaque. <span>Brenden Legros</span></h4>
                            <p>Facere provident incidunt quos voluptas.</p>
                            </div>
                     </div>

                     <div class="row schedule-item">
                            <div class="date col-md-2">
                                   <time datetime="23th feb">
                                          <span>22</span><span>MAY</span>
                                   </time>
                            </div>
                            <div class="col-md-10">
                            <div class="speaker">
                            </div>
                            <h4>Et voluptatem iusto dicta nobis. <span>Hubert Hirthe</span></h4>
                            <p>Maiores dignissimos neque qui cum accusantium ut sit sint inventore.</p>
                            </div>
                     </div>

                     </div>
                     <!-- End Schdule Day 2 -->

                     <!-- Schdule Day 3 -->
                     <div role="tabpanel" class="col-lg-9  tab-pane fade" id="day-3">

                     <div class="row schedule-item">
                            <div class="date col-md-2">
                                   <time datetime="23th feb">
                                          <span>22</span><span>MAY</span>
                                   </time>
                            </div>
                            <div class="col-md-10">
                            <div class="speaker">
                            </div>
                            <h4>Et voluptatem iusto dicta nobis. <span>Hubert Hirthe</span></h4>
                            <p>Maiores dignissimos neque qui cum accusantium ut sit sint inventore.</p>
                            </div>
                     </div>

                     <div class="row schedule-item">
                            <div class="date col-md-2">
                                   <time datetime="23th feb">
                                          <span>22</span><span>MAY</span>
                                   </time>
                            </div>
                            <div class="col-md-10">
                            <div class="speaker">
                            </div>
                            <h4>Explicabo et rerum quis et ut ea. <span>Cole Emmerich</span></h4>
                            <p>Veniam accusantium laborum nihil eos eaque accusantium aspernatur.</p>
                            </div>
                     </div>

                     </div>
                     <!-- End Schdule Day 3 -->

                     </div>

              </div>
       </section>

       <!--==========================Members Section============================-->
       <section id="speakers" class="wow fadeInUp">
              <div class="container">
                     <div class="section-header">
                     <h2>Members</h2>
                     <p><a style="color: blue;" href={{URL::to('/news')}}>See All</a></p>
                     </div>

                     <div class="row">
                     <div class="col-lg-4 col-md-6">
                     <div class="speaker">
                            <img src={{asset('assets/user/landingPage/img/speakers/1.jpg')}} alt="Speaker 1" class="img-fluid">
                            <div class="details">
                            <h3><a href="speaker-details.html">Brenden Legros</a></h3>
                            <p>Quas alias incidunt</p>
                            <div class="social">
                            <a href=""><i class="fa fa-twitter"></i></a>
                            <a href=""><i class="fa fa-facebook"></i></a>
                            <a href=""><i class="fa fa-linkedin"></i></a>
                            </div>
                            </div>
                     </div>
                     </div>
                     <div class="col-lg-4 col-md-6">
                     <div class="speaker">
                            <img src={{asset('assets/user/landingPage/img/speakers/2.jpg')}} alt="Speaker 2" class="img-fluid">
                            <div class="details">
                            <h3><a href="speaker-details.html">Hubert Hirthe</a></h3>
                            <p>Consequuntur odio aut</p>
                            <div class="social">
                            <a href=""><i class="fa fa-twitter"></i></a>
                            <a href=""><i class="fa fa-facebook"></i></a>
                            <a href=""><i class="fa fa-linkedin"></i></a>
                            </div>
                            </div>
                     </div>
                     </div>
                     <div class="col-lg-4 col-md-6">
                     <div class="speaker">
                            <img src={{asset('assets/user/landingPage/img/speakers/3.jpg')}} alt="Speaker 3" class="img-fluid">
                            <div class="details">
                            <h3><a href="speaker-details.html">Cole Emmerich</a></h3>
                            <p>Fugiat laborum et</p>
                            <div class="social">
                            <a href=""><i class="fa fa-twitter"></i></a>
                            <a href=""><i class="fa fa-facebook"></i></a>
                            <a href=""><i class="fa fa-linkedin"></i></a>
                            </div>
                            </div>
                     </div>
                     </div>
                     <div class="col-lg-4 col-md-6">
                     <div class="speaker">
                            <img src={{asset('assets/user/landingPage/img/speakers/4.jpg')}} alt="Speaker 4" class="img-fluid">
                            <div class="details">
                            <h3><a href="speaker-details.html">Jack Christiansen</a></h3>
                            <p>Debitis iure vero</p>
                            <div class="social">
                            <a href=""><i class="fa fa-twitter"></i></a>
                            <a href=""><i class="fa fa-facebook"></i></a>
                            <a href=""><i class="fa fa-linkedin"></i></a>
                            </div>
                            </div>
                     </div>
                     </div>
                     <div class="col-lg-4 col-md-6">
                     <div class="speaker">
                            <img src={{asset('assets/user/landingPage/img/speakers/5.jpg')}} alt="Speaker 5" class="img-fluid">
                            <div class="details">
                            <h3><a href="speaker-details.html">Alejandrin Littel</a></h3>
                            <p>Qui molestiae natus</p>
                            <div class="social">
                            <a href=""><i class="fa fa-twitter"></i></a>
                            <a href=""><i class="fa fa-facebook"></i></a>
                            <a href=""><i class="fa fa-linkedin"></i></a>
                            </div>
                            </div>
                     </div>
                     </div>
                     <div class="col-lg-4 col-md-6">
                     <div class="speaker">
                            <img src={{asset('assets/user/landingPage/img/speakers/6.jpg')}} alt="Speaker 6" class="img-fluid">
                            <div class="details">
                            <h3><a href="speaker-details.html">Willow Trantow</a></h3>
                            <p>Non autem dicta</p>
                            <div class="social">
                            <a href=""><i class="fa fa-twitter"></i></a>
                            <a href=""><i class="fa fa-facebook"></i></a>
                            <a href=""><i class="fa fa-linkedin"></i></a>
                            </div>
                            </div>
                     </div>
                     </div>
                     </div>
              </div>
       </section>

       <!--==========================Sponsors Section============================-->
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

@endsection

@section('footer')
       <!-- ======= Footer ======= -->
       @include('layouts.user.landing-page.footer')
@endsection
@section('main-script')
<script>
       // Event
       $(".eventData").click(function(){
       var title = $(this).attr('title');
       var body = $(this).attr('body');
       var bodyData = body.replace(/<[^>]+>/g, '').replace(/<\/p>/gi, "\n").replace(/<br\/?>/gi, "\n").replace(/<\/?[^>]+(>|$)/g, "");;

       $('.title').text(title);
       $('.body').text(bodyData);
       
       });
</script>
@endsection