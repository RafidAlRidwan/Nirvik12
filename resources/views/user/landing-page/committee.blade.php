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
                                   <a class="btn btn-info" href="#">View All</a>
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

              <div class="tab-content row justify-content-center">
                     <div role="tabpanel" class="col-lg-9 tab-pane fade show active" id="day-1">
                            <div class="row schedule-item p-3 border-0">
                                   
                                   <div class="schedule-item-row col-md-12 border d-flex justify-content-between p-3">
                                          
                                          <div class="">
                                                 <h4><a href="#" class="eventData">Ifter Mahfil Committee</a></h4>
                                                 <p><i class="fa fa-map-marker"></i> BZS</p>
                                          </div>
                                          <div class="">
                                                 <a href=""><button class="btn btn-info">Details</button></a>
                                          </div>
                                          
                                   </div>
                                   <div class="schedule-item-row col-md-12 border d-flex justify-content-between p-3">
                                          
                                          <div class="">
                                                 <h4><a href="#" class="eventData">Ifter Mahfil Committee</a></h4>
                                                 <p><i class="fa fa-map-marker"></i> BZS</p>
                                          </div>
                                          <div class="">
                                                 <button class="btn btn-info">Details</button>
                                          </div>
                                          
                                   </div>
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