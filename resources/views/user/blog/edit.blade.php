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
      <h2>Edit Blog</h2>
    </div>

    <div class="wrapper d-flex justify-content-center">
      <div class="card">
        <div class="card-body">
          {!! Form::open(['action' => ['App\Http\Controllers\User\BlogPageController@store'], 'files' => true, 'class' => 'needs-validation', 'novalidate']) !!}

          @include('errors.validation')

          <input type="hidden" name="id" value="{{$blog->id}}">
          <div class="row">
            <div class="div-gap col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
              <label>Title</label>
              <div class="inputBox">
                {!! Form::text('title', $blog->title, [($errors->has('title') ? 'is-invalid' : ''), 'autocomplete' => 'off', 'required']) !!}
              </div>
              @if ($errors->has('title'))
              <div class="invalid-feedback">{{ $errors->first('title') }}</div>
              @endif
            </div>
          </div>
          <div class="row">
            <div class="div-gap col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
              <label>Description</label>
              <textarea name="description" id="default">{{$errors->has('description') ? old('description') : $blog->description}}</textarea>
            </div>
            @if ($errors->has('description'))
            <div class="invalid-feedback">{{ $errors->first('description') }}</div>
            @endif
          </div>
          <div class="row">
            <div class="form-group div-gap col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
              <label>Tags</label>
              <select class="form-control tag" name="tags[]" multiple="multiple">
                @foreach($tags as $item)
                <option value={{$item->id}} {{ in_array($item->id, $arrTags) ? 'selected' : '' }}>{{$item->name}}</option>
                @endforeach
              </select>
            </div>
          </div>



          <div class="row">
            <div class="div-gap col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
              <label>Blog Picture</label>
              <div class="tower-file">
                <input type="file" id="demoInput5" name="attachment" value="" />
                <label for="demoInput5" class="btn btn-primary mb-1">
                  <span class="mdi mdi-upload"></span>Select Files
                </label>
                <button type="button" class="btn btn-secondary tower-file-clear align-top">Clear</button>
              </div>
              @if(!empty($blog->attachment))
              <div id="edit-img" class="tower-file">
                <div class=" tower-file-details">
                  <div class="tower-input-preview-container">
                    <img class="null" src="{{asset($blog->attachment)}}">
                  </div>
                </div>
              </div>
              @endif

            </div>
          </div>

          <div class="row">
            <div class="inputfield div-gap">
              <button type="submit" class="btn btn-primary btn-sm">Save</button>
            </div>
          </div>

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