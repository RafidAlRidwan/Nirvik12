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
    #demoInput5-error{
        color: red;
    }
    /*
    CSS for the main interaction
    */
    .tabset > input[type="radio"] {
      position: absolute;
      left: -200vw;
    }

    .tabset .tab-panel {
      display: none;
    }

    .tabset > input:first-child:checked ~ .tab-panels > .tab-panel:first-child,
    .tabset > input:nth-child(3):checked ~ .tab-panels > .tab-panel:nth-child(2),
    .tabset > input:nth-child(5):checked ~ .tab-panels > .tab-panel:nth-child(3),
    .tabset > input:nth-child(7):checked ~ .tab-panels > .tab-panel:nth-child(4),
    .tabset > input:nth-child(9):checked ~ .tab-panels > .tab-panel:nth-child(5),
    .tabset > input:nth-child(11):checked ~ .tab-panels > .tab-panel:nth-child(6) {
      display: block;
    }

    /*
    Styling
    */

    .tabset > label {
      position: relative;
      display: inline-block;
      padding: 15px 15px 25px;
      border: 1px solid transparent;
      border-bottom: 0;
      cursor: pointer;
      font-weight: 600;
    }

    .tabset > label::after {
      content: "";
      position: absolute;
      left: 15px;
      bottom: 10px;
      width: 22px;
      height: 4px;
      background: #8d8d8d;
    }

    .tabset > label:hover,
    .tabset > input:focus + label {
      color: #06c;
    }

    .tabset > label:hover::after,
    .tabset > input:focus + label::after,
    .tabset > input:checked + label::after {
      background: #06c;
    }

    .tabset > input:checked + label {
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

{!! Form::open(['action' => ['App\Http\Controllers\Admin\AlbumController@update'], 'id'=>'from', 'files' => true, 'class' => 'needs-validation']) !!}

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
      
      <div class="tab-panels">

        <section id="general" class="tab-panel">
          <h2>General Settings</h2>
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label for="name">App Name</label>
                    <input type="text" class="form-control" name="app_name" value='' id="app_name" placeholder="" required>
                </div>
            </div>
          </div>
          <div class="row">
              <div class="div-gap col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                  <label>Banner</label>
                  <div class="tower-file">
                      <input type="hidden" name="image" id="image" value=''/>
                      <input type="file" id="demoInput5" name="attachment" />
                      <label for="demoInput5" class="update-button btn btn-primary">
                          <span class=" mdi mdi-upload"></span>Select Files
                      </label>
                      <button type="button" class="btn btn-secondary tower-file-clear align-top">Clear</button>
                  </div>
                  @if(!empty($album->attachment))
                  <div id="edit-img" class="tower-file">
                      <div class=" tower-file-details">
                          <div class="tower-input-preview-container">
                              <img class="null" src="{{asset($album->attachment)}}">
                          </div>
                      </div>
                  </div>
                  @endif
              </div>
            </div>
        </section>

        <section id="profile" class="tab-panel">
          <h2>Profile</h2>
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label for="name">Username</label>
                    <input type="text" class="form-control" name="app_name" value='' id="app_name" placeholder="" required>
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label for="name">Password</label>
                    <input type="text" class="form-control" name="app_name" value='' id="app_name" placeholder="" required>
                </div>
            </div>
          </div>
          </section>

        <section id="footer" class="tab-panel">
          <h2>6C. Dunkles Bock</h2>
          <p><strong>Overall Impression:</strong> A dark, strong, malty German lager beer that emphasizes the malty-rich and somewhat toasty qualities of continental malts without being sweet in the finish.</p>
          <p><strong>History:</strong> Originated in the Northern German city of Einbeck, which was a brewing center and popular exporter in the days of the Hanseatic League (14th to 17th century). Recreated in Munich starting in the 17th century. The name “bock” is based on a corruption of the name “Einbeck” in the Bavarian dialect, and was thus only used after the beer came to Munich. “Bock” also means “Ram” in German, and is often used in logos and advertisements.</p>
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