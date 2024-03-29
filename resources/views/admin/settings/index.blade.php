@extends('layouts.admin.admin')
@section('style')
<style>
  .tower-input-preview-container img {
    vertical-align: middle;
    border-style: none;
    width: 300px;
    margin-bottom: 10px;
  }

  .tower-file input[type="file"] {
    height: 0.1px;
    width: 0.1px;
    opacity: 0;
  }

  #demoInput5-error {
    color: red;
  }

  /*
    CSS for the main interaction
    */
  .tabset>input[type="radio"] {
    position: absolute;
    left: -200vw;
  }

  .tabset .tab-panel {
    display: none;
  }

  .tabset>input:first-child:checked~.tab-panels>.tab-panel:first-child,
  .tabset>input:nth-child(3):checked~.tab-panels>.tab-panel:nth-child(2),
  .tabset>input:nth-child(5):checked~.tab-panels>.tab-panel:nth-child(3),
  .tabset>input:nth-child(7):checked~.tab-panels>.tab-panel:nth-child(4),
  .tabset>input:nth-child(9):checked~.tab-panels>.tab-panel:nth-child(5),
  .tabset>input:nth-child(11):checked~.tab-panels>.tab-panel:nth-child(6) {
    display: block;
  }

  /*
    Styling
    */

  .tabset>label {
    position: relative;
    display: inline-block;
    padding: 15px 15px 25px;
    border: 1px solid transparent;
    border-bottom: 0;
    cursor: pointer;
    font-weight: 600;
  }

  .tabset>label::after {
    content: "";
    position: absolute;
    left: 15px;
    bottom: 10px;
    width: 22px;
    height: 4px;
    background: #8d8d8d;
  }

  .tabset>label:hover,
  .tabset>input:focus+label {
    color: #06c;
  }

  .tabset>label:hover::after,
  .tabset>input:focus+label::after,
  .tabset>input:checked+label::after {
    background: #06c;
  }

  .tabset>input:checked+label {
    border-color: #ccc;
    border-bottom: 1px solid #fff;
    margin-bottom: -1px;
  }

  .tab-panel {
    padding: 30px 0;
    border-top: 1px solid #ccc;
  }

  /*
    Demo purposes only
    */
  *,
  *:before,
  *:after {
    box-sizing: border-box;
  }

  .tabset {
    max-width: 65em;
  }
</style>
@endsection

@section('content')
{!! Form::open(['action' => ['App\Http\Controllers\Admin\SettingsController@update'], 'id'=>'from', 'files' => true, 'class' => 'needs-validation']) !!}
@include('errors.validation')

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
        <h1 class="m-0">Global Settings</h1>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
        <ol class="breadcrumb float-sm-right">
          <button type="submit" class="btn btn-primary">Update</button>
        </ol>
      </div>
    </div>
  </div>
</div>


<section class="content p-2">
  <div class="container-fluid m-t-25 card p-3">
    <section>
      <div class="tabset">
        <!-- Tab 1 -->
        <input type="radio" name="tabset" id="tab1" aria-controls="general" checked>
        <label for="tab1">General</label>

        <!-- Tab 2 -->
        <input type="radio" name="tabset" id="tab2" aria-controls="profile">
        <label for="tab2">Profile</label>

        <!-- Tab 3 -->
        <input type="radio" name="tabset" id="tab3" aria-controls="footer">
        <label for="tab3">Footer</label>

        <!-- Tab 4 -->
        <input type="radio" name="tabset" id="tab4" aria-controls="donote">
        <label for="tab4">Donate</label>
        @php
        $cache = Cache::get('settings');
        $app_name = $cache->where('key', 'app_name')->first();
        $banner = $cache->where('key', 'banner')->first();
        $description = $cache->where('key', 'description')->first();
        $address = $cache->where('key', 'address')->first();
        $phone = $cache->where('key', 'phone')->first();
        $email = $cache->where('key', 'email')->first();
        $bkash = $cache->where('key', 'bkash')->first();
        $nagad = $cache->where('key', 'nagad')->first();
        $rocket = $cache->where('key', 'rocket')->first();
        $helpLine = $cache->where('key', 'help_line')->first();
        @endphp
        <div class="tab-panels">
          <section id="general" class="tab-panel">
            <h4>General Settings</h4>
            <hr>
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                  <label for="name">App Name</label>
                  <input type="text" class="form-control" name="app_name" value={{$app_name->value}} placeholder="" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="div-gap col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                <label>Banner</label>
                <div class="tower-file">
                  <input type="hidden" name="image" id="image" value='' />
                  <input type="file" id="demoInput5" name="attachment" />
                  <label for="demoInput5" class="update-button btn btn-primary">
                    <span class=" mdi mdi-upload"></span>Select Files
                  </label>
                  <button type="button" class="btn btn-secondary tower-file-clear align-top">Clear</button>
                </div>
                @if(!empty($banner->value))
                <div id="edit-img" class="tower-file">
                  <div class=" tower-file-details">
                    <div class="tower-input-preview-container">
                      <img class="null" src="{{asset($banner->value)}}">
                    </div>
                  </div>
                </div>
                @endif
              </div>
            </div>
          </section>

          <section id="profile" class="tab-panel">
            <h4>Profile</h4>
            <hr>
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                  <label for="name">Username</label>
                  @if($user->type == 1)
                  <input type="text" class="form-control" name="username" value={{$user->name}} placeholder="" required disabled>
                  @else
                  <input type="text" class="form-control" name="username" value={{$user->name}} placeholder="" required>
                  @endif
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                  <label for="name">Password</label>
                  <input type="password" class="form-control" name="password" value='1234' placeholder="" required>
                </div>
              </div>
            </div>
          </section>

          <section id="footer" class="tab-panel">
            <h4>Footer Settings</h4>
            <hr>
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                  <label for="name">Address</label>
                  <input type="text" class="form-control" name="address" value='{{$address->value}}' placeholder="" required>
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                  <label for="name">Phone</label>
                  <input type="text" class="form-control" name="phone" value={{$phone->value}} placeholder="" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                  <label for="name">Email</label>
                  <input type="email" class="form-control" name="email" value={{$email->value}} placeholder="" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="form-group">
                  <label for="description">Description</label>
                  <textarea name="description" id="summernote">{{$description->value}}</textarea>
                </div>
              </div>
            </div>

          </section>

          <section id="donate" class="tab-panel">
            <h4>Donate Settings</h4>
            <hr>
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                  <label for="name">Bkash</label>
                  <input type="text" class="form-control" name="bkash" value='{{$bkash ? $bkash->value : ""}}' placeholder="" required>
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                  <label for="name">Nagad</label>
                  <input type="text" class="form-control" name="nagad" value="{{$nagad ? $nagad->value : ''}}" placeholder="" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                  <label for="name">DBBL Rocket</label>
                  <input type="text" class="form-control" name="rocket" value="{{$rocket ? $rocket->value : ''}}" placeholder="" required>
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                  <label for="name">Help Line Number</label>
                  <input type="text" class="form-control" name="help_line" value="{{$helpLine ? $helpLine->value : ''}}" placeholder="" required>
                </div>
              </div>
            </div>

          </section>

        </div>

      </div>
    </section>
</section>

{!! Form::close() !!}

@endsection

@section('script')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script>
  $('#summernote').summernote({
    placeholder: '',
    tabsize: 2,
    height: 250
  });
</script>

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