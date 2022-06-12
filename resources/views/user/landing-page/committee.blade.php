@extends('layouts.user.landing-page.master')
@section('main-style')
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
              background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(/nirvik12/assets/user/landingPage/img/map.jpg) center;
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
                     <h1 style="color: #fff;" class="page-title">Events & Program Committees</h1>
                     <div class="content">
                            <p style="color: #fff;" class="lead">Recent Events Committee List</p>
                            <p>
                                   <a class="btn btn-primary" href="#">View All</a>
                            </p>
                     </div>
              </div>
       </div>
</section>

<!--==========================Schedule Section============================-->
<section id="schedule" class="section-with-bg">
       <div class="container wow fadeInUp">
              <div class="section-header">
                     <h2>Event & Program Committee</h2>
                     <p>Here is our event committee</p>
              </div>

              @php
                     $current_date = date('Y-m-d');
                     $events = App\Models\Event::whereDate('date', '>=', $current_date)->get();
              @endphp
              @foreach ($events as $value)
                     @php
                            $day1 = date('d', strtotime($value['date']));
                            $month1 = date('M', strtotime($value['date']));
                     @endphp
                     <div class="row schedule-item">
                            <div class="date col-md-2 col-sm-2 col-xl-2">
                                   <time datetime="23th feb">
                                          <span>{{$day1}}</span><span>{{$month1}}</span>
                                   </time>
                            </div>
                            <div class="col-md-10 col-sm-10 col-xl-10">
                            <div class="speaker">
                            </div>
                            
                            <h4><a href="#" class="eventData" data-toggle='modal' data-target='#event-details' title={{$value['title']}} body={{$value['description']}}>{{$value['title']}}</a></h4>
                            <p><i class="fa fa-map-marker"></i> {{$value['venue']}}</p>
                            </div>
                     </div>
              @endforeach
              

       </div>
</section>
@endsection

@section('footer')
<!-- ======= Footer ======= -->
@include('layouts.user.landing-page.footer')
@endsection