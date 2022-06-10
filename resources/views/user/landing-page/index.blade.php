@extends('layouts.user.landing-page.master')
namespace App;

@section('header')
       <!-- ======= Header Assets ======= -->
       @include('layouts.user.landing-page.header')
@endsection

@section('main-content')
       <!--==========================Cover Page Section============================-->
       <section class="home">
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
       <!--==========================About Section============================-->
       <section id="about">
              <div class="container">
                     <div class="section-header">
                            <h2 style="color: #f82249">About Nirvik'12</h2>
                     </div>
                     <div class="row">
                            <div class="col-lg-12">
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
                                   @php
                                          $current_date = date('m');
                                          $events = App\Models\Event::whereMonth('date', $current_date)->get();
                                   @endphp
                                   @foreach ($events as $value)
                                          @php
                                                 $day1 = date('d', strtotime($value['date']));
                                                 $month1 = date('M', strtotime($value['date']));
                                          @endphp
                                          <div class="row schedule-item">
                                                 <div class="date col-md-2">
                                                        <time datetime="23th feb">
                                                               <span>{{$day1}}</span><span>{{$month1}}</span>
                                                        </time>
                                                 </div>
                                                 <div class="col-md-10">
                                                 <div class="speaker">
                                                 </div>
                                                 
                                                 <h4><a href="#" class="eventData" data-toggle='modal' data-target='#event-details' title={{$value['title']}} body={{$value['description']}}>{{$value['title']}}</a></h4>
                                                 <p><i class="fa fa-map-marker"></i> {{$value['venue']}}</p>
                                                 </div>
                                          </div>
                                   @endforeach


                            </div>
                            <!-- End Schdule Day 1 -->

                            <!-- Schdule Day 2 -->
                            <div role="tabpanel" class="col-lg-9  tab-pane fade" id="day-2">

                                   @php
                                          $current_date2 = date('m', strtotime('first day of +1 month'));
                                          $events2 = App\Models\Event::whereMonth('date', $current_date2)->get();
                                   @endphp
                                   @foreach ($events2 as $value)
                                          @php
                                                 $day2 = date('d', strtotime($value['date']));
                                                 $month2 = date('M', strtotime($value['date']));
                                          @endphp
                                          <div class="row schedule-item">
                                                 <div class="date col-md-2">
                                                        <time datetime="23th feb">
                                                               <span>{{$day2}}</span><span>{{$month2}}</span>
                                                        </time>
                                                 </div>
                                                 <div class="col-md-10">
                                                 <div class="speaker">
                                                 </div>
                                                 
                                                 <h4><a href="#" class="eventData" data-toggle='modal' data-target='#event-details' title={{$value['title']}} body={{$value['description']}}>{{$value['title']}}</a></h4>
                                                 <p><i class="fa fa-map-marker"></i> {{$value['venue']}}</p>
                                                 </div>
                                          </div>
                                   @endforeach

                            </div>
                            <!-- End Schdule Day 2 -->

                            <!-- Schdule Day 3 -->
                            <div role="tabpanel" class="col-lg-9  tab-pane fade" id="day-3">

                                   @php
                                          $current_date3 = date('m', strtotime('first day of +2 month'));
                                          $events3 = App\Models\Event::whereMonth('date', $current_date3)->get();
                                   @endphp
                                   @foreach ($events3 as $value)
                                          @php
                                                 $day3 = date('d', strtotime($value['date']));
                                                 $month3 = date('M', strtotime($value['date']));
                                          @endphp
                                          <div class="row schedule-item">
                                                 <div class="date col-md-2">
                                                        <time datetime="23th feb">
                                                               <span>{{$day3}}</span><span>{{$month3}}</span>
                                                        </time>
                                                 </div>
                                                 <div class="col-md-10">
                                                 <div class="speaker">
                                                 </div>
                                                 
                                                 <h4><a href="#" class="eventData" data-toggle='modal' data-target='#event-details' title={{$value['title']}} body={{$value['description']}}>{{$value['title']}}</a></h4>
                                                 <p><i class="fa fa-map-marker"></i> {{$value['venue']}}</p>
                                                 </div>
                                          </div>
                                   @endforeach
                            </div>
                            <!-- End Schdule Day 3 -->

                     </div>

              </div>
       </section>

       <!--==========================Members Section============================-->
       <!-- <section id="speakers" class="wow fadeInUp">
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
       </section> -->

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
       <!--==========================Modal============================-->
       <section>
              <div class="modal fade" id="event-details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                     <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                   <div class="modal-header">
                                          <h5 class="modal-title text-bold title" id="exampleModalLabel"></h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                          </button>
                                   </div>
                                   <div class="modal-body body">
                                   
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