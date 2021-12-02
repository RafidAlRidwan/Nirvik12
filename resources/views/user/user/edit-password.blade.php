@extends('layouts.user.user_navbar')

@section('style')
<link rel="stylesheet" href="{{asset('assets/user/landingPage/custom-select/css/style.css')}}">
<link href="{{asset('assets/user/landingPage/file-select/tower-file-input.css')}}" rel="stylesheet" />
<link href="{{asset('assets/user/landingPage/custom-css/edit.css')}}" rel="stylesheet">
@endsection

@section('content')
<section id="speakers-details" class="wow fadeIn">
    <div class="container">
        <div class="section-header">
            <h2>Edit Password</h2>
        </div>

        <div class="wrapper">
            <div class="card">
                <div class="card-body">
                    {!! Form::model($user, ['route' => ['user.update_password', $user->id],'method'=>'put', 'files' => true, 'class' => 'needs-validation', 'novalidate']) !!}


                    <div class="div-gap col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                        <label>Old Password<strong style="color: red"> *</strong></label>
                        <div class="inputBox">
                            <input type="password" id="old-password" name="old_password" value="" autocomplete="off" required>
                        </div>
                        @if ($errors->has('old_password'))
                        <div style="margin-top: 20px;" class="invalid-feedback">{{ $errors->first('old_password') }}</div>
                        @endif

                    </div>

                    <div class="div-gap col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                        <label>New Password<strong style="color: red"> *</strong></label>
                        <div class="inputBox">
                            <input type="password" id="new-password" name="new_password" value="" autocomplete="off" required>
                        </div>
                        @if ($errors->has('new_password'))
                        <div style="margin-top: 20px;" class="invalid-feedback">{{ $errors->first('new_password') }}</div>
                        @endif

                    </div>

                    <div class="div-gap col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                        <label>Confirmed Password<strong style="color: red"> *</strong></label>
                        <div class="inputBox">
                            <input type="password" id="confirmed-password" name="password" value="" autocomplete="off" required>
                        </div>
                        @if ($errors->has('password'))
                        <div style="margin-top: 20px;" class="invalid-feedback">{{ $errors->first('password') }}</div>
                        @endif
                        <div style="margin-top: 20px;">
                            <span style="font-weight: bold;" id="message"> </span>
                        </div>

                    </div>


                    <div class="inputfield div-gap">
                        <button type="submit" class=" btn btn-primary">Update</button>
                    </div>


                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('script')

<script>
    $(document).ready(function() {
        $("#confirmed-password").keyup(function() {
            var cPassword = $(this).val();
            var nPassword = $("#new-password").val();
            if (cPassword === nPassword) {
                $("#message").removeClass('text-danger');
                $("#message").addClass('text-success');
                $("#message").text("**Password Matched");
            } else {
                $("#message").removeClass('text-success');
                $("#message").addClass('text-danger');
                $("#message").text("**Password Not Match");
            }
        });
    });
</script>


@endsection