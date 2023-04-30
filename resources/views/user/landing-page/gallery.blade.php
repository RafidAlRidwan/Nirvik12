@extends('layouts.user.landing-page.master')
@section('main-style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css" integrity="sha512-nNlU0WK2QfKsuEmdcTwkeh+lhGs6uyOxuUs+n+0oXSYDok5qy0EI0lt01ZynHq6+p/tbgpZ7P+yUb+r71wqdXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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

       .custom-section {
              width: 100%;
              height: auto;
              background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(/assets/user/landingPage/img/map.jpg) center;
              background-size: cover;
              overflow: hidden;
              position: relative;
              backdrop-filter: blur(59px);
       }

       img:hover {
              transform: scale(1.1);
       }

       .fancybox-button--share {
              display: none;
       }

       .fancybox-button--thumbs {
              display: none;
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
'title' => "Gallery",
'sub-title' => "Recent Photos",
'action' => "/album",
'button' => "Back",
'isAuth' => 0,
'route-name' => "",
'button2' => ""
]
@endphp
@include('layouts.user.landing-page.secondary-header', $data)


<!--==========================Schedule Section============================-->
<section id="schedule" class="section-with-bg">
       <div class="container wow fadeInUp">
              <div class="section-header">
                     <h2>Photo Gallery</h2>
                     <!-- <p>Here is our event schedule</p> -->
              </div>
              <div id="basicExample" class="d-flex justify-content-center">
                     @isset($gallery)
                     @foreach ($gallery as $item)
                     <a data-fancybox="gallery" data-caption="{{$item->title ?? ''}}" data-src="{{asset($item->attachment)}}">
                            <img style="transition: 0.3s" src="{{asset($item->attachment)}}" />
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js" integrity="sha512-uURl+ZXMBrF4AwGaWmEetzrd+J5/8NRkWAvJx5sbPSSuOb0bZLqf+tOzniObO00BjHa/dD7gub9oCGMLPQHtQA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
       $('#basicExample').justifiedGallery({
              rowHeight: 130,
              lastRow: 'nojustify',
              margins: 3
       });
       // Fancybox Configuration

       $('[data-fancybox="gallery"]').fancybox({
              buttons: [
                     "slideShow",
                     "thumbs",
                     "zoom",
                     "fullScreen",
                     "share",
                     "close"
              ],
              loop: false,
              protect: true
       });
</script>
@endsection