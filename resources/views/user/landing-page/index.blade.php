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

       <!--==========================Event Section============================-->
       <section id="hotels" class="section-with-bg wow">
              <div class="container">
                     <div class="section-header">
                            <h2>UPCOMING EVENTS</h2>
                            <!-- <p>Her are some nearby hotels</p> -->
                     </div>
                     <div style="justify-content: center" class="row">
                            <div class="col-lg-6 col-md-6 mb-4">
                                   <article style="margin-bottom: 10px;" class="hotel event-card">
                                          <section class="date">
                                                 <time datetime="23th feb">
                                                        <span>23</span><span>feb</span>
                                                 </time>
                                          </section>
                                          <section class="card-cont">
                                                 <small>dj khaled</small>
                                                 <h3>live in sydney</h3>
                                                 <div class="even-date">
                                                        <i class="fa fa-calendar"></i>
                                                        <time>
                                                               <span>wednesday 28 december 2014</span>
                                                               <span>08:55pm to 12:00 am</span>
                                                        </time>
                                                 </div>
                                                 <div class="even-info">
                                                        <i class="fa fa-map-marker"></i>
                                                        <p>
                                                               nexen square for people australia, sydney
                                                        </p>
                                                 </div>
                                                 <a href="#" data-toggle='modal' data-target='#exampleModalCenter'>Details</a>
                                          </section>
                                   </article>
                            </div>

                            <div class="col-lg-6 col-md-6 mb-4">
                                   <article class="hotel event-card">
                                          <section class="date">
                                                 <time datetime="23th feb">
                                                        <span>05</span><span>March</span>
                                                 </time>
                                          </section>
                                          <section class="card-cont">
                                                 <small>dj khaled</small>
                                                 <h3>live in Seaol</h3>
                                                 <div class="even-date">
                                                        <i class="fa fa-calendar"></i>
                                                        <time>
                                                               <span>wednesday 28 december 2014</span>
                                                               <span>08:55pm to 12:00 am</span>
                                                        </time>
                                                 </div>
                                                 <div class="even-info">
                                                        <i class="fa fa-map-marker"></i>
                                                        <p>
                                                               nexen square for people australia, sydney
                                                        </p>
                                                 </div>
                                                 <a href="#" data-toggle='modal' data-target='#exampleModalCenter'>Details</a>
                                          </section>
                                   </article>
                            </div>

                            <div class="col-lg-6 col-md-6 mb-4">
                                   <article class="hotel event-card">
                                          <section class="date">
                                                 <time datetime="23th feb">
                                                        <span>16</span><span>June</span>
                                                 </time>
                                          </section>
                                          <section class="card-cont">
                                                 <small>dj khaled</small>
                                                 <h3>live in Canada</h3>
                                                 <div class="even-date">
                                                        <i class="fa fa-calendar"></i>
                                                        <time>
                                                               <span>wednesday 28 december 2014</span>
                                                               <span>08:55pm to 12:00 am</span>
                                                        </time>
                                                 </div>
                                                 <div class="even-info">
                                                        <i class="fa fa-map-marker"></i>
                                                        <p>
                                                               nexen square for people australia, sydney
                                                        </p>
                                                 </div>
                                                 <a href="#" data-toggle='modal' data-target='#exampleModalCenter'>Details</a>
                                          </section>
                                   </article>
                            </div>
                     </div>
              </div>

              <!-- Button trigger modal -->
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

       <!--==========================Gallery Section============================-->
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