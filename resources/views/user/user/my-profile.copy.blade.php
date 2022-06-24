@extends('layouts.user.user-dashboard-master')

@section('content')
<section id="speakers-details" class="wow fadeIn">
  <div class="container">
    <div class="section-header">
      @php
      $url = URL::to('/user/my-profile/edit'.'/'.Auth::user()->id);
      $urlPassword = URL::to('/user/my-profile/edit-password'.'/'.Auth::user()->id);
      @endphp
      <a href={{$url}}>
        <h2>Profile</h2>
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
            <a href={{$url}} data-toggle="tooltip" data-placement="top" title="Edit Profile"><i class="fa fa-pen-square"></i></a>
            <a href={{$urlPassword}} data-toggle="tooltip" data-placement="top" title="Change Password"><i class="fa fa-key"></i></a>
            @endif
            <a href="" data-toggle="tooltip" data-placement="top" title="Facebook"><i class="fa fa-facebook"></i></a>
            <a href="" data-toggle="tooltip" data-placement="top" title="Instagram"><i class="fa fa-instagram"></i></a>
            <a href="" data-toggle="tooltip" data-placement="top" title="Twitter"><i class="fa fa-twitter"></i></a>

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

<script>
  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })
</script>


@endsection