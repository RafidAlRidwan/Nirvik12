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
       background: linear-gradient( rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5) ), url(/nirvik12/assets/user/landingPage/img/bzs.jpg) center;
       background-size: cover;
       overflow: hidden;
       position: relative;
       }
       #albums {
              width: 90%;
              margin: auto;
              padding: 60px 0 60px 0;

       }
       .picture {
              position: relative;
              height: 120px;
              width: 120px;
              border-radius: 10px;
              box-shadow: 3px 3px 5px lightgray;
              margin-bottom: 10px;
       }
       .picture img {
              width: 100%;
              height: 100%;
              border-radius: 10px;
              transition: .5s;
       }
       .picture::before{
              content: "";
              position: absolute;
              top: 50%;
              left: 55%;
              transform: translate(-50%, -50%);
              color: white;
              font-size: 22px;
              font-weight: bold;
              width: 100%;
              margin-top: -100px;
              opacity: 0;
              transition: .3s;
              transition-delay: .2s;
              z-index: 1;
       }
       .picture::after{
              content: "";
              position: absolute;
              width: 100%;
              bottom: 0;
              left: 0;
              border-radius: 10px;
              height: 0;
              background-color: rgba(0, 0, 0, 0.4);
              transition: .3s;
       }
       .picture:hover::after{
              height: 100%;
       }
       .picture:hover::before{
              margin-top: 0;
              opacity: 1;
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
                            <h1 style="color: #fff;" class="page-title">Album</h1>
                            <div class="content">
                                   <p class="lead">Bla bla bla</p>
                                   <p>
                                          <a class="btn btn-primary" href="#">View All</a>
                                   </p>
                            </div>
              </div>
       </div>
       </section>

       <!--==========================Album Section============================-->
       <section id="albums" class="wow fadeInUp">
                     <div class="section-header">
                            <h2>Album</h2>
                     </div>
                     @php
                            $albumDetails = App\Models\Album::all();
                     @endphp
                     <div class="row">
                            @isset($albumDetails)
                                   @foreach ($albumDetails as $item)
                                          <div class="col-sm-3 col-md-3 col-lg-2 col-xl-2 md-3">
                                                 <div  class="album">
                                                        <div class="picture">
                                                               @php
                                                                      $viewURL = URL::to('gallery' . '/' . $item->id);
                                                               @endphp
                                                               @if($item->attachment)
                                                                      <img src={{asset('/'. $item->attachment)}} alt="Album" class="img-fluid">
                                                               @else
                                                                      <img src={{asset('assets/user/landingPage/img/album.png')}} alt="Album" class="img-fluid">
                                                               @endif
                                                        </div>
                                                        <div >
                                                               <h5><a href={{$viewURL}}>{{$item->title}}</a></h5>
                                                        </div>
                                                 </div>
                                          </div>
                                   @endforeach
                            @endisset
                            <div class="col-sm-3 col-md-3 col-lg-2 col-xl-2 md-3">
                                   <div  class="album">
                                          <div class="picture">
                                                 <img src={{asset('assets/user/landingPage/img/album.png')}} alt="Album" class="img-fluid">
                                          </div>
                                          <div >
                                                 <h5><a href={{asset('/gallery/0')}}>Others</a></h5>
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
<script src="{{asset('assets/user/landingPage/gallery/jquery.justifiedGallery.min.js')}}"></script>

<script>
       $('#basicExample').justifiedGallery({
       rowHeight : 130,
       lastRow : 'nojustify',
       margins : 3
       });
</script>
@endsection