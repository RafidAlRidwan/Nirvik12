@extends('layouts.user.user_navbar')
@section('style')
<style>
  .tool1 {
    display: inline;
    position: absolute;
  }

  .tool1:hover:after {
    display: -webkit-flex;
    display: flex;
    -webkit-justify-content: center;
    justify-content: center;
    background: #444;
    border-radius: 8px;
    color: #fff;
    content: attr(title1);
    margin: -70px auto 0;
    font-size: 12px;
    padding: 10px;
    width: 140px;
  }

  .tool1:hover:before {
    border: solid;
    border-color: #444 transparent;
    border-width: 12px 6px 0 6px;
    content: "";
    left: 45%;
    bottom: 35px;
    position: absolute;
  }
</style>
@endsection
@section('content')
<section id="speakers-details" class="wow fadeIn">
  <div class="container">
    <div class="section-header">
      @php
      $url = URL::to('/user/my-profile/edit'.'/'.Auth::user()->id);
      $urlPassword = URL::to('/user/my-profile/edit-password'.'/'.Auth::user()->id);
      @endphp
      <a href={{$url}}>
        <h2>My Profile</h2>
      </a>
      <!-- <p>Software Engineer</p> -->
    </div>
    @foreach($user_details as $key => $value)
    <div class="row">
      <div class="col-md-4">
        @if(!empty($value->attachment))
        <img style="border: 1px solid #ddd; border-radius:4px; padding: 5px;
            width: 280px; }" src="{{asset('assets/user/landingPage/img/profilePicture')}}/{{ ($value->attachment) }}" alt="pp" class="responsive">
        @else
        <img style="border: 1px solid #ddd; border-radius:4px; padding: 5px;
            width: 280px; }" src="{{asset('assets/user/landingPage/img/profilePicture/demo.jpg')}}" alt="pp" class="responsive">
        @endif
      </div>
      <div class="col-md-8">
        <div style="margin-top: 5px;" class="details">
          <div class="social">
            @if((Auth::user()->id) == $value->user_id)
                <a href={{$url}} title1="Edit Profile" class="tool1"><i class="fa fa-pen-square"></i></a>
                <a href=""><i class="fa fa-facebook"></i></a>
                <a href=""><i class="fa fa-facebook"></i></a>
                <a href=""><i class="fa fa-instagram"></i></a>
                <a href=""><i class="fa fa-twitter"></i></a>
                <a href={{$urlPassword}} title1="Change Password" class="tool1"><i class="fa fa-key"></i></a>
            @else
                <a href=""><i class="fa fa-facebook"></i></a>
                <a href=""><i class="fa fa-instagram"></i></a>
                <a href=""><i class="fa fa-twitter"></i></a>
            @endif

          </div>
          <a href="">
            <h2>{{$value->full_name}}</h2>
          </a>
          <p>{{$value->designation}} at {{$value->office_name}}</p>
          <p>Lives in {{$value->current_city}}, Bangladesh</p>
          <p>From Bogra</p>

          <p></p>

          <p></p>
        </div>
      </div>

    </div>
    @endforeach
  </div>

</section>


@endsection

@section('script')


@endsection
