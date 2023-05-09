@extends('layouts.user.landing-page.master')

@section('main-style')
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
                <h2>Say Something About Us</h2>
            </div>

            <div class="wrapper">
                <div class="card" style="background-color: transparent; border:none;">
                    <div class="card-body">
                        <form method="post" action="{{route('user.update_testimonial')}}">
                            @csrf
                            <div class="row">
                                <input type="hidden" name="id" value="{{$user_details['user_id']}}">
                                <div class="div-gap col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <label>Comment<strong style="color: red"> *</strong></label>
                                    <div class="inputBox">
                                        <textarea class="form-control" name="comments" id="textfield" rows="2">{{$user_details['comments']}}</textarea>
                                    </div>
                                    @if ($errors->has('comments'))
                                    <div style="margin-top: 20px; display:block" class="invalid-feedback">{{ $errors->first('comments') }}</div>
                                    @endif
                                    <br>
                                    <div id="counter"></div>


                                </div>

                            </div>

                            <div class="inputfield mt-2">
                                <button type="submit" class="btn btn-dark">Save</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@section('main-script')
<script>
    $(document).ready(function() {
        $("#textfield").on('keyup paste', function() { // <---remove ',' comma

            var Characters = $("#textfield").val().replace(/(<([^>]+)>)/ig, "").length; // '$' is missing from the selector
            if ((180 - Characters) < 0) {
                $("#counter").text("Characters left: " + (180 - Characters) + ". Limit Exceeded");
                $('#counter').addClass('text-danger');
            } else {
                $('#counter').removeClass('text-danger');
                $("#counter").text("Characters left: " + (180 - Characters));
            }

        });
    });
</script>
@endsection