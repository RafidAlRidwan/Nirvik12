@extends('layouts.user.landing-page.master')

@section('header')
<!-- ======= Header Assets ======= -->
@include('layouts.user.landing-page.header')
@endsection

@section('main-content')
<!--==========================Cover Page Section============================-->
<section class="home" style="background-attachment: fixed !important;">
       <div class="media-icons">
              <a href="https://www.facebook.com/groups/138718299513425"><i class="fa fa-facebook"></i></a>
              <a href="#"><i class="fa fa-instagram"></i></a>
              <a href="#"><i class="fa fa-twitter"></i></a>
       </div>

       <div class="swiper bg-slider">
              <div class="swiper-wrapper">
                     @php
                     $coverPhotos = App\Models\CoverPage::all();
                     @endphp
                     @foreach ($coverPhotos as $value)
                     <div class="swiper-slide">
                            <img src="{{asset($value->attachment)}}" alt="">
                            <div class="text-content">
                                   <!-- <h2 class="title">{{$value->title}} <span style="color: #fff;">2022</span></h2> -->
                                   <h2 class="title">{{$value->title}}</h2>
                                   <!-- <p></p> -->
                            </div>
                     </div>
                     @endforeach
              </div>
       </div>

       <div class="bg-slider-thumbs">
              <div class="swiper-wrapper thumbs-container">
                     @foreach ($coverPhotos as $value)
                     <img src="{{asset($value->attachment)}}" class="swiper-slide" alt="">
                     @endforeach
              </div>
       </div>
</section>

<!--========================== Trending News Section ==========================-->
@if(!empty($news->news))
<div class="ticker-wrapper-h">
       <div class="heading">Trending Now</div>

       <ul class="news-ticker-h">
              <li><a href="">{{$news->news}}</a></li>
       </ul>
</div>
@endif

<!--==========================About Section============================-->
<section id="about">
       <div class="container wow fadeInUp">
              <div class="section-header">
                     <h2 style="color: #f82249">About Nirvik'12</h2>
              </div>
              <div class="row">
                     <div class="col-lg-12" style="justify-content: center; text-align:justify;">
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
                                   @php
                                   $newsDetails = App\Models\News::orderBy('created_at','desc')->latest()->take(5)->get();
                                   @endphp
                                   @if(!empty($newsDetails))
                                   @foreach ($newsDetails as $item)
                                   <li>
                                          <a data-toggle="collapse" class="collapsed" href="#faq{{$item->id}}">{{$item->heading}}<i class="fa fa-minus-circle"></i></a>
                                          <div style="text-align:justify" id="faq{{$item->id}}" class="collapse" data-parent="#faq-list">
                                                 {!!$item->body!!}
                                          </div>
                                   </li>
                                   @endforeach
                                   @endif

                                   <a style="text-align: center;" class="text-danger pt-1 mb-0 {{ isset($newsDetails) && !$newsDetails->isEmpty() ? "d-none" : "" }}" id="notice-tools-technology-info" role="notice">
                                          <i class="icon-info22 mr-1" aria-hidden="true"></i> {!! __("No news has been added!") !!}
                                   </a>
                            </ul>
                     </div>
              </div>
              <div class="d-flex justify-content-center">
                     <p class="readMore">
                            <a style="color: rgba(202, 206, 221, 0.8);" href={{URL::to('/news')}}>
                                   <button class="btn btn-sm btn-info" style="background-color: #ff4d6d; border: 1px solid #ff4d6d;">More</button>
                            </a>
                     </p>
              </div>


       </div>
</section>
<!--==========================Event Section============================-->
<section id="schedule" class="section-with-bg" style="background-attachment:fixed !important;background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),url('/assets/user/landingPage/img/about-bg2.jpg') center center no-repeat; background-size: cover;">
       <div class="container wow fadeInUp">
              <div class="section-header">
                     <h2>Upcoming Events</h2>
              </div>
              <!-- Custom Events -->
              <div id="kagepisuceng" class="kagepisuceng">

                     <div class="kagepisuceng__items">
                            @php
                            $current_date = date("Y-m-d");
                            $events = App\Models\Event::whereDate('date', '>=', $current_date)->orderBy('date', 'ASC')->take(5)->get();
                            @endphp


                            <ol class="kagepisuceng__indicators">
                                   @foreach ($events as $ev)
                                   <li class="kagepisuceng__indicator {{$loop->iteration == 1 ?  'kagepisuceng__indicator_active' : ''}} " data-slide-to="{{$loop->iteration - 1}}"></li>
                                   @endforeach
                            </ol>
                            @foreach ($events as $event)

                            @php
                            $day = date('d', strtotime($event['date']));
                            $month = date('M', strtotime($event['date']));

                            $now = time();
                            $target_date = strtotime($event['date']);
                            $datediff = $target_date - $now;
                            $day_count = round($datediff / (60 * 60 * 24));
                            @endphp
                            <div class="kagepisuceng__item kagepisuceng__item_1 {{$loop->iteration == 1 ? 'kagepisuceng__item_active' : ''}} ">
                                   <div class="kagepisuceng__item_inner">
                                          <span class="kagepisuceng__item_img">
                                                 <div class="date col-md-2">
                                                        <time datetime="23th feb" style="border: 2px solid black;padding: 5px;">
                                                               <span>{{$day}}</span><span>{{$month}}</span>
                                                        </time>
                                                 </div>
                                          </span>
                                          <span class="kagepisuceng__item_testimonial">
                                                 <span class="kagepisuceng__item_text" style="align-items: center;display: flex;font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen-Sans, Ubuntu, Cantarell, 'Helvetica Neue', sans-serif;">
                                                        <div id="countdown" style="color: #000;text-align: center;">
                                                               @if($loop->iteration == 1)
                                                               <ul style="margin-bottom: 0rem">
                                                                      <li style="display: inline-block;font-size: 12px;list-style-type: none;padding: 1em;text-transform: uppercase;"><span style="display: block;font-size: 19px; color:#fff" id="days"></span><strong>days</strong></li>
                                                                      <li style="display: inline-block;font-size: 12px;list-style-type: none;padding: 1em;text-transform: uppercase;"><span style="display: block;font-size: 19px; color:#fff" id="hours"></span><strong>Hr</strong></li>
                                                                      <li style="display: inline-block;font-size: 12px;list-style-type: none;padding: 1em;text-transform: uppercase;"><span style="display: block;font-size: 19px; color:#fff" id="minutes"></span><strong>Min</strong></li>
                                                                      <li style="display: inline-block;font-size: 12px;list-style-type: none;padding: 1em;text-transform: uppercase;"><span style="display: block;font-size: 19px; color:#fff" id="seconds"></span><strong>Sec</strong></li>
                                                               </ul>
                                                               @else
                                                               <span class="kagepisuceng__item_name" style="padding-left:0.7em;margin-bottom:5px"><strong>{{$day_count}}</strong> Days Remaining</span>
                                                               @endif
                                                        </div>
                                                 </span>
                                                 <span class="kagepisuceng__item_name" style="font-weight:800px !important;padding-left: 0.6em; color: #fff;"><strong>{{$event['title']}}</strong></span>
                                                 <span class="kagepisuceng__item_post" style="padding-left: 0.7em;  color: #fff;">
                                                        <p style="margin-bottom: 0px;"><i class="fa fa-map-marker"></i> {{$event['venue']}}</p>
                                                 </span>

                                          </span>
                                   </div>
                            </div>
                            @endforeach
                     </div>
                     <a class="kagepisuceng__control kagepisuceng__control_prev" href="#" role="button"></a>
                     <a class="kagepisuceng__control kagepisuceng__control_next" href="#" role="button"></a>
              </div>

              <div class="d-flex justify-content-center mt-2">
                     <p class="readMore">
                            <a style="color: rgba(202, 206, 221, 0.8);" href={{URL::to('/events')}}>
                                   <button class="btn btn-sm btn-info" style="background-color: #ff4d6d; border: 1px solid #ff4d6d;">More</button>
                            </a>
                     </p>
              </div>

       </div>
</section>

<!--================Responsibility=================-->
<section id="responsibility-area" class="section-padding pt-5">
       <div class="container">
              <!--== Section Title Start ==-->
              <div class="section-header">
                     <h2>Our Responsiblity</h2>
              </div>
              <!--== Section Title End ==-->

              <!--== Responsibility Content Wrapper ==-->
              <div class="row" style="text-align: center!important; padding-bottom: 50px">
                     @php
                     $resposiblity = App\Models\ResponsiblitySection::orderBy('id', 'ASC')->take(4)->get();
                     @endphp
                     <!--== Single Responsibility Start ==-->
                     @foreach ($resposiblity as $res)
                     <div class="col-lg-3 col-sm-6">
                            <div class="single-responsibility">
                                   <img src="{{asset($res->file)}}" alt="Responsibility">
                                   <h4>{{$res->title}}</h4>
                                   <p>{{$res->short_description}}</p>
                            </div>
                     </div>
                     @endforeach

                     <!--== Single Responsibility End ==-->
              </div>
              <!--== Responsibility Content Wrapper ==-->
       </div>
</section>

<!--================Fun Fact================-->
<section id="funfact-area" style="background-attachment:fixed !important;background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),url('/assets/user/landingPage/img/about-bg2.jpg') center center no-repeat; background-size: cover;">
       <div class=" container-fluid">
              <div class="row text-center">
                     <!--== Single FunFact Start ==-->
                     <div class="col-lg-3 col-sm-6">
                            <div class="single-funfact-wrap">
                                   <div class="funfact-icon">
                                          <img src="assets/user/landingPage/img/fun-fact/user.svg" alt="Funfact">
                                   </div>
                                   <div class="funfact-info">
                                          <h5 class="funfact-count" style="color: #fff;">{{App\Models\User::countAllUsers()}}</h5>
                                          <p style="font-size: 20px;">Members</p>
                                   </div>
                            </div>
                     </div>
                     <!--== Single FunFact End ==-->

                     <!--== Single FunFact Start ==-->
                     <div class="col-lg-3 col-sm-6">
                            <div class="single-funfact-wrap">
                                   <div class="funfact-icon">
                                          <img src="assets/user/landingPage/img/fun-fact/picture.svg" alt="Funfact">
                                   </div>
                                   <div class="funfact-info">
                                          <h5 class="funfact-count" style="color: #fff;">{{App\Models\Gallery::countAllPhotos()}}</h5>
                                          <p style="font-size: 20px;">Photos</p>
                                   </div>
                            </div>
                     </div>
                     <!--== Single FunFact End ==-->

                     <!--== Single FunFact Start ==-->
                     <div class="col-lg-3 col-sm-6">
                            <div class="single-funfact-wrap">
                                   <div class="funfact-icon">
                                          <img src="assets/user/landingPage/img/fun-fact/event.svg" alt="Funfact">
                                   </div>
                                   <div class="funfact-info">
                                          <h5><span class="funfact-count" style="color: #fff;">{{App\Models\Event::countAllEvents()}}</span></h5>
                                          <p style="font-size: 20px;">Events</p>
                                   </div>
                            </div>
                     </div>
                     <!--== Single FunFact End ==-->

                     <!--== Single FunFact Start ==-->
                     <div class="col-lg-3 col-sm-6">
                            <div class="single-funfact-wrap">
                                   <div class="funfact-icon">
                                          <img src="assets/user/landingPage/img/fun-fact/medal.svg" alt="Funfact">
                                   </div>
                                   <div class="funfact-info">
                                          <h5><span class="funfact-count" style="color: #fff;">5</span></h5>
                                          <p style="font-size: 20px;">Awards</p>
                                   </div>
                            </div>
                     </div>
                     <!--== Single FunFact End ==-->
              </div>
       </div>
</section>
<!-- TESTIMONIALS -->
<section class="testimonials pt-5">
       <div class="container wow fadeInUp">
              <div class="section-header">
                     <h2>What we says</h2>
              </div>
              <div class="row">
                     <div class="col-sm-12">
                            <div id="customers-testimonials" class="owl-carousel">

                                   <!--TESTIMONIAL 1 -->
                                   @php
                                   $testi = App\Models\UserDetail::whereNotNull('comments')->orderBy('id', 'ASC')->get();
                                   @endphp
                                   @foreach ($testi as $test)
                                   <div class="item">
                                          <div class="shadow-effect">
                                                 @if(!empty($test->attachment))
                                                 <img class="img-circle" src="{{asset('assets/user/landingPage/img/profilePicture/'.$test->attachment)}}" alt="">
                                                 @else
                                                 <img class="img-circle" src="{{asset('assets/user/landingPage/img/profilePicture/demo.jpg')}}" alt="">
                                                 @endif
                                                 <p>{{$test->comments}}</p>
                                          </div>
                                          <div class="testimonial-name">{{$test->full_name}}</div>
                                   </div>
                                   @endforeach

                                   <!--END OF TESTIMONIAL 1 -->
                            </div>
                     </div>
              </div>
       </div>
</section>
<!-- END OF TESTIMONIALS -->
<!--==========================Sponsors Section============================-->
<section id="supporters" class="section-with-bg wow ">
       <div class="container">
              @php
              $sponsorDetails = App\Models\Sponsor::orderBy('created_at','desc')->latest()->take(5)->get();
              @endphp
              @if((count($sponsorDetails) > 0))
              <div class="section-header">
                     <h2>Sponsors</h2>
              </div>
              <div style="justify-content: center" class="row no-gutters supporters-wrap clearfix">

                     @foreach ($sponsorDetails as $item)
                     <div class="col-lg-3 col-md-4 col-xs-6">
                            <div class="supporter-logo">
                                   <img src="{{asset($item->attachment)}}" class="img-fluid" alt="">
                            </div>
                     </div>
                     @endforeach
              </div>
              @endif
       </div>
</section>
<section class="wow fadeInUp mt-5">
       <div class="container">
              <div class="section-header">
                     <h2>Google Map</h2>
              </div>
       </div>
       <div class="mapouter">
              <div class="gmap_canvas"><iframe class="gmap_iframe" width="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=600&amp;height=400&amp;hl=en&amp;q=Bogra Zilla School&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe><a href="https://capcuttemplate.org/">Capcut Template</a></div>
              <style>
                     .mapouter {
                            position: relative;
                            text-align: right;
                            width: 100%;
                            height: 400px;
                     }

                     .gmap_canvas {
                            overflow: hidden;
                            background: none !important;
                            width: 100%;
                            height: 400px;
                     }

                     .gmap_iframe {
                            height: 400px !important;
                     }
              </style>
       </div>
</section>
<!--==========================Modal============================-->
<section>
       <div class="modal fade" id="event-details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                     <div class="modal-content" style="border: none; background: black; background: linear-gradient( to right bottom, rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.4)); border-radius: 1rem; backdrop-filter: blur(5px);">
                            <div class="modal-header">
                                   <h5 class="modal-title text-bold text-white title" id="exampleModalLabel"></h5>
                                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span style="color: #f82249; text-shadow: 0 0px 0 #fff; opacity: 1;" aria-hidden="true">&times;</span>
                                   </button>
                            </div>
                            <div class="modal-body body text-white">

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
       $(".eventData").click(function() {
              var title = $(this).attr('title');
              var body = $(this).attr('body');
              var bodyData = body.replace(/<[^>]+>/g, '').replace(/<\/p>/gi, "\n").replace(/<br\/?>/gi, "\n").replace(/<\/?[^>]+(>|$)/g, "");;

              $('.title').text(title);
              $('.body').text(bodyData);

       });

       /*================================================================= 
</script>
<script>
       jQuery(document).ready(function($) {
              "use strict";
              //  TESTIMONIALS CAROUSEL HOOK
              $('#customers-testimonials').owlCarousel({
                     loop: true,
                     center: true,
                     items: 3,
                     margin: 0,
                     autoplay: true,
                     dots: false,
                     autoplayTimeout: 8500,
                     smartSpeed: 450,
                     responsive: {
                            0: {
                                   items: 1
                            },
                            768: {
                                   items: 2
                            },
                            1170: {
                                   items: 3
                            }
                     }
              });
       });
</script>
@endsection