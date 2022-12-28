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
       @media (min-width: 768px){
       .page-header .container {
       padding-top: 100px;
       /* padding-bottom: 48px; */
       }
       }
       @media (max-width: 768px){
       .page-header .container {
       padding-top: 100px;
       /* padding-bottom: 48px; */
       }
       }

       .custom-section {
       width: 100%;
       height: auto;
       background: linear-gradient( rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5) ), url(/nirvik12/assets/user/landingPage/img/map.jpg) center;
       background-size: cover;
       overflow: hidden;
       position: relative;
       backdrop-filter: blur(59px);
       }

       img:hover {
              transform: scale(1.1);
       }
                     
</style>
<link rel="stylesheet" href="{{asset('assets/user/landingPage/gallery/justifiedGallery.min.css')}}">
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
                            <h1 style="color: #fff;" class="page-title">Gallery</h1>
                            <div class="content">
                                   <p style="color: #fff;" class="lead">Recent Photos</p>

                                   <p>
                                          <a class="btn btn-primary" href="{{URL::to('/album')}}">Back</a>
                                   </p>
                            </div>
              </div>
       </div>
       </section>

       <!--==========================Schedule Section============================-->
       <section id="schedule" class="section-with-bg">
              <div class="container wow fadeInUp">
                     <!-- <div class="section-header">
                     <h2>Photo Gallery</h2>
                     <p>Here is our event schedule</p>
                     </div> -->
                     <div id="basicExample">
                            @isset($gallery)
                                   @foreach ($gallery as $item)
                                          <a href="{{asset($item->attachment)}}" target=”_blank”>
                                                 <img style="transition: 0.3s" alt="Photo" src="{{asset($item->attachment)}}"/>
                                          </a>
                                   @endforeach
                            @endisset

                     </div>

              </div>
       </section>
@endsection

@section('footer')
       <!-- ======= Footer ======= -->
       @include('layouts.user.landing-page.footer')
@endsection

@section('main-script')
<script src="{{asset('assets/user/landingPage/gallery/jquery.justifiedGallery.min.js')}}"></script>

<script>
       $('#basicExample').justifiedGallery({
       rowHeight : 130,
       lastRow : 'nojustify',
       margins : 3
       });
</script>
@endsection