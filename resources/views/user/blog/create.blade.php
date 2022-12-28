@extends('layouts.user.user-dashboard-master')

@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/user/landingPage/css/datepicker.min.css') }}">
<link rel="stylesheet" href="{{asset('assets/user/landingPage/custom-select/css/style.css')}}">
<link href="{{asset('assets/user/landingPage/file-select/tower-file-input.css')}}" rel="stylesheet" />
<link href="{{asset('assets/user/landingPage/custom-css/edit.css')}}" rel="stylesheet">
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
</style>
@endsection

@section('content')
<section id="speakers-details" class="wow fadeIn">
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

@section('script')
<script type="text/javascript" src='https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js' referrerpolicy="origin"></script>
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
@endsection