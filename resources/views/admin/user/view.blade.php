@extends('layouts.admin.admin')

@section('content')

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
        <h1 class="m-0">User Details</h1>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
        <ol class="breadcrumb float-sm-right">
          <a href={{route('admin_user_index')}}><button type="button" class="btn btn-primary">Back</button></a>
        </ol>
      </div>
    </div>
  </div>
</div>

<hr>

<section class="content p-2 ">
    <div class="container-fluid m-t-25 card p-3">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <div class="form-group">
                    <label for="name">User Name</label>
                    <div>{{$user->name ?? '-'}}</div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <div class="form-group">
                    <label for="full_name">Full Name</label>
                    <div>{{$user_details['full_name'] ?? '-'}}</div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Email address</label>
                    <div>{{$user->email ?? '-'}}</div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <div class="form-group">
                    <label for="designation">Designation</label>
                    <div>{{$user_details['designation'] ?? '-'}}</div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <div class="form-group">
                    <label for="office_name">Company</label>
                    <div>{{$user_details['office_name'] ?? '-'}}</div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <div class="form-group">
                    <label for="current_city">Current City</label>
                    <div>{{$user_details['current_city'] ?? '-'}}</div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <div class="form-group">
                    <label for="roll_no">Class Roll No.</label>
                    <div>{{$user_details['roll_no'] ?? '-'}}</div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                @php
                    $sectionName = App\Models\Section::sectionInfo($user_details['section']);
                @endphp
                <div class="form-group">
                    <label for="section">Section</label>
                    <div>{{$sectionName ?? '-'}}</div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                @php
                    $shiftName = App\Models\Shift::shiftInfo($user_details['shift']);
                @endphp
                <div class="form-group">
                    <label for="shift">Shift</label>
                    <div>{{$shiftName ?? '-'}}</div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <div class="form-group">
                    <label for="religion">Religion</label>
                    @php
                        if ($user_details['religion'] == 1) {
                            $religion = 'Islam';
                        } else if ($user_details['religion'] == 2) {
                            $religion = 'Hinduism';
                        } else if ($user_details['religion'] == 3) {
                            $religion = 'Buddhism';
                        } else if ($user_details['religion'] == 4) {
                            $religion = 'Christianity';
                        } else {
                            $religion = '-';
                        }
                    @endphp
                    <div>{{$religion}}</div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <div class="form-group">
                    <label for="current_address">Currrent Address</label>
                    <div>{{$user_details['current_address'] ?? '-'}}</div>
                </div>
            </div>
        </div>
        <!--  -->
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <div class="form-group">
                    <label for="marital_status">Marital Status</label>
                    @php
                        if ($user_details['marital_status'] == 1) {
                            $marital_status = 'Bachelor';
                        } else if ($user_details['marital_status'] == 2) {
                            $marital_status = 'Married';
                        } else {
                            $marital_status = '-';
                        }
                    @endphp
                    <div>{{$marital_status}}</div>
                </div>
            </div>
            
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <label>Profile Picture</label>
                <div id="edit-img" class="tower-file">
                    <div class=" tower-file-details">
                        <div class="tower-input-preview-container">
                            <img class="null" width=125px  src="{{asset('assets/user/landingPage/img/profilePicture')}}/{{ ($user_details->attachment) }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>


@endsection

@section('script')

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