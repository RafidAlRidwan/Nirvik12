@extends('layouts.user.landing-page.master')

@section('main-style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/user/landingPage/css/datepicker.min.css') }}">
<link rel="stylesheet" href="{{asset('assets/user/landingPage/custom-select/css/style.css')}}">
<link href="{{asset('assets/user/landingPage/file-select/tower-file-input.css')}}" rel="stylesheet" />
<link href="{{asset('assets/user/landingPage/custom-css/edit.css')}}" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
  .tox-notifications-container {
    display: none;
  }

  .tox-statusbar__branding {
    display: none;
  }

  .card {
    width: 700px;
  }

  .inputBox input {
    background: #fff;
    color: #000;
    border: 2px solid #eee;
  }
</style>
@endsection
@section('header')
<!-- ======= Header Assets ======= -->
@include('layouts.user.landing-page.header')
@endsection
@section('main-content')
<section id="speakers-details" class="wow fadeIn m-5">
  <div class="container">
    <div class="section-header">
      <h2>Create Blog</h2>
    </div>

    <div class="wrapper d-flex justify-content-center">
      <div class="card">
        <div class="card-body">
          {!! Form::open(['action' => ['App\Http\Controllers\User\BlogPageController@store'], 'files' => true, 'class' => 'needs-validation', 'novalidate']) !!}

          @include ('user.blog.add_form')

          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

@section('main-script')
<script type="text/javascript" src='https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js' referrerpolicy="origin"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
  tinymce.init({
    selector: 'textarea', // change this value according to your HTML
    plugins: 'a_tinymce_plugin',
    a_plugin_option: true,
    a_configuration_option: 400
  });
</script>
<script>
  $(document).ready(function() {
    $('select:not(.ignore)').niceSelect();
    FastClick.attach(document.body);
  });
</script>

<!-- File SELECT -->
<script src="{{asset('assets/user/landingPage/file-select/tower-file-input.js')}}"></script>

<script type="text/javascript">
  $('#demoInput5').fileInput({
    iconClass: 'mdi mdi-fw mdi-upload'
  });
</script>

<script type="text/javascript">
  $(document).on('click', '#demoInput5', function() {
    $('#edit-img').hide();
  });
</script>
<script>
  $(".tag").select2({
    tags: true,
    tokenSeparators: [',', ' ']
  })
</script>
@endsection