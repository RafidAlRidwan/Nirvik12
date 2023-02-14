@extends('layouts.user.landing-page.master')

@section('main-style')
<link rel="stylesheet" href="{{asset('assets/user/landingPage/profile/css/style.css')}}">
<link rel="stylesheet" href="{{asset('assets/user/landingPage/profile/css/slick.css')}}">
<link rel="stylesheet" href="{{ asset('assets/user/landingPage/crop/ijaboCropTool.min.css') }}">
<style>
  .universal-h2-bckg {
    background-image: url("{{ asset('assets/user/landingPage/profile/images/double-line.svg') }}");
    background-repeat: no-repeat;
    background-position: center bottom;
  }
</style>
<style>
  .avatar-upload {
    position: relative;
    /* max-width: 205px; */
    /* margin: 50px auto;  */

  }

  .avatar-upload .avatar-edit {
    position: absolute;
    right: 165px;
    z-index: 1;
    top: 350px;
  }

  @media (max-width: 620px) {
    .avatar-upload .avatar-edit {
      right: 97px;
      top: 216px;
    }
  }

  .avatar-upload .avatar-edit input {
    display: none;
  }

  .avatar-upload .avatar-edit input+label {
    display: inline-block;
    width: 50px;
    height: 50px;
    margin-bottom: 0;
    border-radius: 100%;
    background: #FFFFFF;
    border: 1px solid transparent;
    box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
    cursor: pointer;
    font-weight: normal;
    transition: all 0.2s ease-in-out;
  }

  @media (max-width: 620px) {
    .avatar-upload .avatar-edit input+label {
      width: 35px;
      height: 35px;
    }
  }

  .avatar-upload .avatar-edit input+label:hover {
    background: #f1f1f1;
    border-color: #d6d6d6;
  }

  .avatar-upload .avatar-edit input+label:after {
    content: "\f083";
    font-family: 'FontAwesome';
    color: #757575;
    position: absolute;
    top: 15px;
    left: 0;
    right: 0;
    text-align: center;
    margin: auto;
  }

  @media (max-width: 620px) {
    .avatar-upload .avatar-edit input+label:after {
      top: 7px;
      left: 0;
      right: 0;
    }
  }
</style>
@endsection
@section('header')
<!-- ======= Header Assets ======= -->
@include('layouts.user.landing-page.header')
@endsection
@section('main-content')
@php
$url = URL::to('/user/my-profile/edit'.'/'.Auth::user()->id);
$urlPassword = URL::to('/user/my-profile/edit-password'.'/'.Auth::user()->id);
@endphp
<main id="home" style="padding-top: 80px;padding-bottom: 36px;position: relative;animation: pop-in 2.5s ease-out;">

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
        <div class="avatar-upload">
          @if((Auth::user()->id) == $value->user_id)
          <div class="avatar-edit">
            <input type='file' name="file" id="imageUpload" accept=".png, .jpg, .jpeg" />
            <label for="imageUpload" data-toggle="tooltip" data-placement="top" title="Change Profile Picture"></label>
          </div>
          @endif
          @if(!empty($value->attachment))
          <div class="portfolio__img">
            <img id="imagePreview" src="{{asset('assets/user/landingPage/img/profilePicture')}}{{ '/'.($value->attachment) }}" class="about-me__profile" alt="about me profile picture">
          </div>
          @else
          <div class="portfolio__img">
            <img id="imagePreview" src="{{asset('assets/user/landingPage/img/profilePicture/demo.jpg')}}" class="about-me__profile" alt="about me profile picture">
          </div>
          @endif
        </div>

        <div class="portfolio__bottom">
          <div class="portfolio__name">
            <!-- <span>J</span> -->
            <h2 class="universal-h2">{{$value->full_name}}</h2>
          </div>
          <p>{{$value->designation}}</p>
          <div style="margin-top: 5px;" class="details">
            <div class="social">
              @if((Auth::user()->id) == $value->user_id)
              <a href={{$url}} data-toggle="tooltip" data-placement="top" title="Edit Profile"><i class="fa fa-pencil"></i></a>
              <a href={{$urlPassword}} data-toggle="tooltip" data-placement="top" title="Change Password"><i class="fa fa-key"></i></a>
              <a href="" data-toggle="tooltip" data-placement="top" title="Sync Facebook for Social Login"><i class="fa fa-facebook" aria-hidden="true"></i></a>
              <a href="" data-toggle="tooltip" data-placement="top" title="Sync Google for Social Login"><i class="fa fa-google" aria-hidden="true"></i></a>
              @endif
              <!-- <a href="" data-toggle="tooltip" data-placement="top" title="Facebook"><i class="fa fa-facebook"></i></a> -->
              <!-- <a href="" data-toggle="tooltip" data-placement="top" title="Instagram"><i class="fa fa-instagram"></i></a> -->

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
            <p class="text-dark"><strong>{{$value->designation}}</strong> at {{$value->office_name}}</p>
            <p class="text-dark">Lives in <strong>{{$value->current_city}}, Bangladesh</strong></p>
            <p class="text-dark">Mobile: <strong>{{collect($value->mobile)->implode('mobile', ',')}}</strong></p>
            <p class="text-dark">Email: <strong>{{$value->user->email}}</strong></p>
          </div>
          <div class="about-me-single-slide">
            <h2 class="universal-h2 universal-h2-bckg">DETAILS</h2>
            <p><strong>Name:</strong> {{$value->full_name}}</p>
            <p><strong>Designation:</strong> {{$value->designation}}</p>
            <p><strong>Office:</strong> {{$value->office_name}}</p>
            <p><strong>Mobile:</strong> {{collect($value->mobile)->implode('mobile', ',')}}</p>
            <p><strong>Email:</strong> {{$value->user->email}}</p>

            <p><strong>Shift:</strong> {{$value->shiftData ? $value->shiftData->name : ''}}</p>
            <p><strong>Section:</strong> {{$value->sectionData ? $value->sectionData->name : ''}}</p>
            <p><strong>Roll:</strong> {{$value->roll_no}}</p>

            <p><strong>Marital Status:</strong> {{$value->marital_status == 1 ? 'Bachelor' : 'Married'}}</p>

            <p><strong>Present Address:</strong> {{$value->current_address}}</p>


          </div>
        </div>
      </div>
    </div>
    <div class="about-me-bckg"></div>
  </section>
</main>

@endforeach

@endsection

@section('main-script')
<script src="{{ asset('assets/user/landingPage/crop/ijaboCropTool.min.js') }}"></script>

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
<script>
  $('#imageUpload').ijaboCropTool({
    preview: '.image-previewer',
    setRatio: 1,
    allowedExtensions: ['jpg', 'jpeg', 'png'],
    buttonsText: ['CROP', 'QUIT'],
    buttonsColor: ['#30bf7d', '#ee5155', -15],
    processUrl: '{{route("profile.image.upload")}}',
    withCSRF: ['_token', '{{ csrf_token() }}'],
    onSuccess: function(message, name, status) {
      console.log(message);
      if (status == 1) {
        $('#imagePreview').attr('src', message);
        toastr.success('Image Uploaded');

      } else {
        toastr.danger('Image Upload Failed!');
      }
    },
    onError: function(message, status) {
      alert(message);
    }
  });
</script>

<!-- <script>
  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#imagePreview').attr('src', e.target.result);
        // $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
        // $('#imagePreview').hide();
        // $('#imagePreview').fadeIn(650);
      }
      reader.readAsDataURL(input.files[0]);
    }
  }
  $("#imageUpload").change(function() {
    readURL(this);
  });
</script> -->

@endsection