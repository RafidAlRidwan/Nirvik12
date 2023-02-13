@extends('layouts.user.landing-page.master')
@section('main-style')
<style>
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

       .picture::before {
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

       .picture::after {
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

       .picture:hover::after {
              height: 100%;
       }

       .picture:hover::before {
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
@php $data = [
'title' => "Album",
'sub-title' => "Recent Photos",
'action' => "",
'button' => "",
'isAuth' => 0,
'route-name' => "",
'button2' => ""
]
@endphp
@include('layouts.user.landing-page.secondary-header', $data)

<!--==========================Album Section============================-->
<section id="albums" class="wow fadeInUp">
       <!-- <div class="section-header">
                            <h2>Album</h2>
                     </div> -->
       @php
       $albumDetails = App\Models\Album::all();
       @endphp
       <div class="row d-flex justify-content-center">
              @isset($albumDetails)
              @foreach ($albumDetails as $item)
              <div class="col-sm-3 col-md-3 col-lg-2 col-xl-2 md-3 text-center">
                     <div class="album d-flex justify-content-center">
                            <div class="picture">
                                   @php
                                   $viewURL = URL::to('gallery' . '/' . $item->id);
                                   @endphp
                                   @if($item->attachment)
                                   <a href={{$viewURL}}><img src={{asset('/'. $item->attachment)}} alt="Album" class="img-fluid"></a>
                                   @else
                                   <a href={{$viewURL}}><img src={{asset('assets/user/landingPage/img/album.png')}} alt="Album" class="img-fluid"></a>
                                   @endif
                            </div>

                     </div>
                     <div>
                            <h5><a href={{$viewURL}}>{{$item->title}}</a></h5>
                     </div>
              </div>
              @endforeach
              @endisset
              <div class="col-sm-3 col-md-3 col-lg-2 col-xl-2 md-3 text-center">
                     <div class="album d-flex justify-content-center">
                            <div class="picture">
                                   <a href={{asset('/gallery/0')}}><img src={{asset('assets/user/landingPage/img/album.png')}} alt="Album" class="img-fluid"></a>
                            </div>
                     </div>
                     <div>
                            <h5><a href={{asset('/gallery/0')}}>Others</a></h5>
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
              rowHeight: 130,
              lastRow: 'nojustify',
              margins: 3
       });
</script>
@endsection