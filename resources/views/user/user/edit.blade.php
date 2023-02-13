@extends('layouts.user.landing-page.master')

@section('main-style')
<link rel="stylesheet" href="{{asset('assets/user/landingPage/custom-select/css/style.css')}}">
<link href="{{asset('assets/user/landingPage/file-select/tower-file-input.css')}}" rel="stylesheet" />
<link href="{{asset('assets/user/landingPage/custom-css/edit.css')}}" rel="stylesheet">

<link href="{{asset('assets/user/landingPage/upload/css/dropzone.css')}}" rel="stylesheet">
<link href="{{asset('assets/user/landingPage/upload/css/cropper.css')}}" rel="stylesheet">

<style>
  .image_area {
    position: relative;
  }

  img {
    display: block;
    max-width: 100%;
  }

  .preview {
    overflow: hidden;
    width: 160px;
    height: 160px;
    margin: 10px;
    border: 1px solid red;
  }

  .modal-lg {
    max-width: 1000px !important;
  }

  .overlay {
    position: absolute;
    bottom: 10px;
    left: 0;
    right: 0;
    background-color: rgba(255, 255, 255, 0.5);
    overflow: hidden;
    height: 0;
    transition: .5s ease;
    width: 100%;
  }

  .image_area:hover .overlay {
    height: 20%;
    cursor: pointer;
  }

  .text {
    color: #333;
    font-size: 13px;
    position: absolute;
    font-weight: 600;
    top: 50%;
    left: 50%;
    -webkit-transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
    text-align: center;
  }
</style>


@endsection
@section('header')
<!-- ======= Header Assets ======= -->
@include('layouts.user.landing-page.header')
@endsection
@section('main-content')

<main id="home" style="padding-top: 80px;padding-bottom: 36px;position: relative;animation: pop-in 2.5s ease-out;">

  <section id="speakers-details" class="wow fadeIn">
    <div class="container">
      <div class="section-header">
        <h2>Edit Profile</h2>
      </div>

      <div class="wrapper">
        <div class="card" style="background: transparent; border:none;">
          <div class="card-body">
            {!! Form::model($user, ['route' => ['user.update', $user->id],'method'=>'put', 'files' => true, 'class' => 'needs-validation', 'novalidate']) !!}

            @include ('user.user.edit_form')

            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
@endsection

@section('main-script')
<script type="text/javascript">
  $(document).ready(function() {
    var maxField = 1; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var x = 1; //Initial field counter is 1           
    //Once add button is clicked
    $(addButton).click(function() {
      //Check maximum number of input fields
      x++; //Increment field counter
      var fieldHTML = '<article><div class="div-gap col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4"><label>Mobile No</label><div class="inputMobile" style="display: flex;"><input type="number" class="custom-add" name="mobile[]" value=""/><span class="remove_button"><i class="fa fa-minus-circle"></i></span></div></div></article>'; //New input field html 
      $(wrapper).append(fieldHTML); //Add field html

    });

    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e) {
      e.preventDefault();
      $(this).closest('article > div').remove(); //Remove field html
      flashy('<?php echo " Removed" ?>', {
        type: 'flashy__danger'
      });
      x--; //Decrement field counter
    });
  });
</script>

<script type="text/javascript">
  $('.changeStatus').on('change', function() {
    var field = $(this).val();

    if (field == 2) {

      $('#marital-status').show();
    } else {
      $('#marital-status').hide();
    }
  });
</script>
<!-- CUSTOM SELECT -->
<script src="{{asset('assets/user/landingPage/custom-select/js/jquery.nice-select.min.js')}}"></script>
<script src="{{asset('assets/user/landingPage/custom-select/js/fastclick.js')}}"></script>
<script src="{{asset('assets/user/landingPage/custom-select/js/prism.js')}}"></script>

<script>
  $(document).ready(function() {
    $('select:not(.ignore)').niceSelect();
    FastClick.attach(document.body);
  });
</script>
<script type="text/javascript">
  $('.changeStatus').on('change', function() {
    var field = $(this).val();

    if (field == 2) {

      $('#marital-status').show();
    } else {
      $('#marital-status').hide();
    }
  });
</script>

@endsection