@extends('layouts.user.user-dashboard-master')
@section('style')
<link rel="stylesheet" href="{{asset('assets/user/landingPage/profile/css/style.css')}}">
<link rel="stylesheet" href="{{asset('assets/user/landingPage/profile/css/slick.css')}}">
<style>
  .universal-h2-bckg {
    background-image: url("{{ asset('assets/user/landingPage/profile/images/double-line.svg') }}");
    background-repeat: no-repeat;
    background-position: center bottom;
  }
</style>
@endsection
@section('content')
@php
$url = URL::to('/user/my-profile/edit'.'/'.Auth::user()->id);
$urlPassword = URL::to('/user/my-profile/edit-password'.'/'.Auth::user()->id);
@endphp
<section id="speakers-details" class="wow fadeIn">
  <div class="container">
    <div class="section-header">
      <a href={{$url}}></a>
      <h2 class="p-0">Profile</h2>
      </a>
    </div>
  </div>
</section>

<!-- About me -->
@foreach($user_details as $key => $value)

<section class="fh5co-about-me">
  <div class="about-me-inner site-container">
    <article class="portfolio-wrapper">
      @if(!empty($value->attachment))
      <div class="portfolio__img">
        <img src="{{asset('')}}{{ ($value->attachment) }}" class="about-me__profile" alt="about me profile picture">
      </div>
      @else
      <div class="portfolio__img">
        <img src="{{asset('assets/user/landingPage/img/profilePicture/demo.jpg')}}" class="about-me__profile" alt="about me profile picture">
      </div>
      @endif
      <div class="portfolio__bottom">
        <div class="portfolio__name">
          <!-- <span>J</span> -->
          <h2 class="universal-h2">{{$value->full_name}}</h2>
        </div>
        <p>{{$value->designation}}</p>
        <div style="margin-top: 5px;" class="details">
          <div class="social">
            @if((Auth::user()->id) == $value->user_id)
            <a href={{$url}} data-toggle="tooltip" data-placement="top" title="Edit Profile"><i class="fa fa-pen-square"></i></a>
            <a href={{$urlPassword}} data-toggle="tooltip" data-placement="top" title="Change Password"><i class="fa fa-key"></i></a>
            @endif
            <a href="" data-toggle="tooltip" data-placement="top" title="Facebook"><i class="fa fa-facebook"></i></a>
            <a href="" data-toggle="tooltip" data-placement="top" title="Instagram"><i class="fa fa-instagram"></i></a>
            <a href="" data-toggle="tooltip" data-placement="top" title="Twitter"><i class="fa fa-twitter"></i></a>

          </div>
        </div>
      </div>
    </article>
    <div class="about-me__text">
      <div class="about-me-slider">
        <div class="about-me-single-slide">
          <h2 class="universal-h2 universal-h2-bckg">ABOUT</h2>
          <a href="">
            <h3>{{$value->full_name}}</h3>
          </a>
          <p class="text-dark">{{$value->designation}} at {{$value->office_name}}</p>
          <p class="text-dark">Lives in {{$value->current_city}}, Bangladesh</p>
          <p class="text-dark">From Bogra</p>
        </div>
        <div class="about-me-single-slide">
          <h2 class="universal-h2 universal-h2-bckg">DETAILS</h2>
          <p><span>H</span> e has work appearing or forthcoming in over a dozen venues, including Buzzy
            Mag, The Spirit of Poe, and the British Fantasy Society journal Dark Horizons. He is also
            CEO of a company, specializing in custom book publishing and social media marketing
            services, have created a community for authors to learn and connect.He has work appearing or
            forthcoming in over a dozen venues, including Buzzy Mag, The Spirit of Poe, and have created
            a community for authors to learn and connect.</p>
          <h4>Author</h4>
          <p class="p-white">See me</p>
        </div>
      </div>
    </div>
  </div>
  <div class="about-me-bckg"></div>
</section>

@endforeach

@endsection

@section('script')

<script>
  $(function() {
    $('[data-toggle="tooltip"]').tooltip()
  })
</script>
<script src="{{asset('assets/user/landingPage/profile/js/slick.min.js')}}"></script>

<script>
  /* About me slider */
  $('.about-me-slider').slick({
    slidesToShow: 1,
    prevArrow: '<span class="span-arrow slick-prev"><</span>',
    nextArrow: '<span class="span-arrow slick-next">></span>'
  });
</script>

@endsection