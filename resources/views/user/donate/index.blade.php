@extends('layouts.user.landing-page.master')
@section('header')
<!-- ======= Header Assets ======= -->
@include('layouts.user.landing-page.header')
@endsection
@section('main-style')
<style>
    #heading {
        text-transform: uppercase;
        color: #f82249;
        font-weight: normal
    }

    #msform {
        text-align: center;
        position: relative;
        margin-top: 20px
    }

    #msform fieldset {
        background: white;
        border: 0 none;
        border-radius: 0.5rem;
        box-sizing: border-box;
        width: 100%;
        margin: 0;
        padding-bottom: 20px;
        position: relative
    }

    .form-card {
        text-align: left
    }

    #msform fieldset:not(:first-of-type) {
        display: none
    }

    #msform input,
    #msform textarea {
        padding: 8px 15px 8px 15px;
        border: 1px solid #ccc;
        border-radius: 0px;
        margin-bottom: 25px;
        margin-top: 2px;
        width: 100%;
        box-sizing: border-box;
        font-family: montserrat;
        color: #2C3E50;
        background-color: #ECEFF1;
        font-size: 16px;
        letter-spacing: 1px
    }

    #msform input:focus,
    #msform textarea:focus {
        -moz-box-shadow: none !important;
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
        border: 1px solid #f82249;
        outline-width: 0
    }

    #msform .action-button {
        width: 100px;
        background: #f82249;
        font-weight: bold;
        color: white;
        border: 0 none;
        border-radius: 3px;
        cursor: pointer;
        padding: 10px 5px;
        margin: 10px 0px 10px 5px;
        float: right
    }

    #msform .action-button:hover,
    #msform .action-button:focus {
        background-color: #000000
    }

    #msform .action-button-previous {
        width: 100px;
        background: #ccc;
        font-weight: bold;
        color: white;
        border: 0 none;
        border-radius: 3px;
        cursor: pointer;
        padding: 10px 5px;
        margin: 10px 5px 10px 0px;
        float: right
    }

    #msform .action-button-previous:hover,
    #msform .action-button-previous:focus {
        background-color: #000000
    }

    .card {
        z-index: 0;
        border: none;
        position: relative
    }

    .fs-title {
        font-size: 25px;
        color: #f82249;
        margin-bottom: 15px;
        font-weight: normal;
        text-align: left
    }

    .purple-text {
        color: green;
        font-weight: normal
    }

    .steps {
        font-size: 25px;
        color: gray;
        margin-bottom: 10px;
        font-weight: normal;
        text-align: right
    }

    .fieldlabels {
        color: gray;
        text-align: left
    }

    #progressbar {
        margin-bottom: 30px;
        overflow: hidden;
        color: lightgrey
    }

    #progressbar .active {
        color: #f82249
    }

    #progressbar li {
        list-style-type: none;
        font-size: 15px;
        width: 25%;
        float: left;
        position: relative;
        font-weight: 400
    }

    #progressbar #account:before {
        font-family: FontAwesome;
        content: "\f0d6"
    }

    #progressbar #personal:before {
        font-family: FontAwesome;
        content: "\f007"
    }

    #progressbar #payment:before {
        font-family: FontAwesome;
        content: "\f1f0"
    }

    #progressbar #confirm:before {
        font-family: FontAwesome;
        content: "\f00c"
    }

    #progressbar li:before {
        width: 50px;
        height: 50px;
        line-height: 45px;
        display: block;
        font-size: 20px;
        color: #ffffff;
        background: lightgray;
        border-radius: 50%;
        margin: 0 auto 10px auto;
        padding: 2px
    }

    #progressbar li:after {
        content: '';
        width: 100%;
        height: 2px;
        background: lightgray;
        position: absolute;
        left: 0;
        top: 25px;
        z-index: -1
    }

    .fieldlabel {
        background: #000;
        color: white;
        padding: 6px 16px 6px 16px;
        font-size: 15px;
        border-radius: 3px;
    }

    .fieldlabel:hover {
        background-color: #f82249;
    }

    #progressbar li.active:before,
    #progressbar li.active:after {
        background: #f82249
    }

    .progress {
        height: 20px
    }

    .progress-bar {
        background-color: #f82249
    }

    .fit-image {
        width: 100%;
        object-fit: cover
    }
</style>
@endsection

@section('main-content')
<!--==========================Custom Section============================-->
@php $data = [
'title' => "Donate",
'sub-title' => "Donate to make a difference",
'action' => "",
'button' => "",
'isAuth' => 0,
'route-name' => "",
'button2' => ""
]
@endphp
@include('layouts.user.landing-page.secondary-header', $data)


<!--==========================Schedule Section============================-->
<div class="blog" id="content_area_blog">
    <div class="container wow fadeInUp p-5">
        <div class="section-header">
            <h2>GET INVOLVED</h2>
        </div>
        <hr>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-11 col-sm-10 col-md-10 col-lg-6 col-xl-5 text-center p-0 mt-3 mb-2">
                    <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                        <!-- <h2 id="heading">Donate Any Amount for Nirvik'12</h2> -->
                        <p>Please fill out the form below to complete your payment.</p>
                        <form id="msform">
                            <!-- progressbar -->
                            <ul id="progressbar">
                                <li class="active" id="account"><strong>Amount</strong></li>
                                <li id="personal"><strong>Donor Info</strong></li>
                                <li id="payment"><strong>Payment</strong></li>
                                <li id="confirm"><strong>Finish</strong></li>
                            </ul>
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                            </div> <br> <!-- fieldsets -->
                            <fieldset>
                                <div class="form-card">
                                    <div class="row">
                                        <div class="col-7">
                                            <h2 class="fs-title">Amount</h2>
                                        </div>
                                        <div class="col-5">
                                            <h2 class="steps">Step 1 - 4</h2>
                                        </div>
                                    </div>
                                    <label class="fieldlabels">Amount *</label>
                                    <input type="text" name="amount" id="amount" />
                                    <label class="fieldlabel" value="100">৳ 100</label>
                                    <label class="fieldlabel" value="500">৳ 500</label>
                                    <label class="fieldlabel" value="1000">৳ 1000</label>
                                    <label class="fieldlabel" value="2000">৳ 2000</label>

                                </div> <input type="button" name="next" class="next action-button" step="1" value="Next" />
                            </fieldset>
                            <fieldset>
                                <div class="form-card">
                                    <div class="row">
                                        <div class="col-7">
                                            <h2 class="fs-title">Personal Information:</h2>
                                        </div>
                                        <div class="col-5">
                                            <h2 class="steps">Step 2 - 4</h2>
                                        </div>
                                    </div>
                                    <label class="fieldlabels">Full Name *</label>
                                    <input type="text" id="name" name="name" placeholder="Full Name" />

                                    <label class="fieldlabels">Contact No *</label>
                                    <input type="text" id="mobile" name="mobile" placeholder="Contact No." />

                                    <label class="fieldlabels">Shift *</label>
                                    <input type="text" id="shift" name="shift" placeholder="Shift" />

                                    <label class="fieldlabels">Address</label>
                                    <input type="text" name="address" placeholder="Address" />

                                    <label class="fieldlabels">Payment Via *</label>
                                    <select name="payment_method" id="pay" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                        <option value="" selected="selected">Select</option>
                                        <option value="bkash">Bkash</option>
                                        <option value="nagad">Nagad</option>
                                        <option value="rocket">DBBL Rocket</option>
                                    </select>
                                </div> <!-- /.form-group -->
                                <input type="button" name="next" class="next action-button" step="2" value="Next" /> <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                            </fieldset>
                            <fieldset>
                                <div class="form-card">
                                    <div class="row">
                                        <div class="col-7">
                                            <h2 class="fs-title">Payment</h2>
                                        </div>
                                        <div class="col-5">
                                            <h2 class="steps">Step 3 - 4</h2>
                                        </div>
                                    </div>
                                    <p class="fieldlabels bkash m-0 d-none">Bkash: <strong>{{$settings[6]['value']}}</strong></p>
                                    <p class="fieldlabels nagad m-0 d-none">Nagad: <strong>{{$settings[7]['value']}}</strong></p>
                                    <p class="fieldlabels rocket m-0 d-none">DBBL Rocket: <strong>{{$settings[8]['value']}}</strong></p>
                                    <label class="fieldlabels"><strong>Please send money <span class="money"></span> BDT. to <span class="send"></span></strong></label>

                                    <label class="fieldlabels">Enter your Transaction No *</label>
                                    <input type="text" id="transaction" name="transaction_no" placeholder="Transaction No" />
                                </div>
                                <input type="button" name="next" class="next action-button final" step="3" value="Submit" /> <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                            </fieldset>
                            <fieldset>
                                <div class="form-card">
                                    <div class="row">
                                        <div class="col-7">
                                            <h2 class="fs-title">Finish:</h2>
                                        </div>
                                        <div class="col-5">
                                            <h2 class="steps">Step 4 - 4</h2>
                                        </div>
                                    </div> <br><br>
                                    <h2 class="purple-text text-center"><strong>SUCCESS !</strong></h2> <br>
                                    <div class="row justify-content-center">
                                        <div class="col-3"> </div>
                                    </div> <br><br>
                                    <div class="row justify-content-center">
                                        <div class="col-7 text-center">
                                            <h5 class="purple-text text-center">Thank you! We will confirmed you soon.</h5>
                                            <p class="purple-text text-center">Help Line: {{$settings[9]['value']}}</p>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</div>
</div>

</div>
@endsection
@section('footer')
<!-- ======= Footer ======= -->
@include('layouts.user.landing-page.footer')
@endsection
@section('main-script')
<script>
    var current_fs, next_fs, previous_fs; //fieldsets
    var opacity;
    var current = 1;
    var steps = $("fieldset").length;

    setProgressBar(current);

    $(".next").click(function() {
        $('.money').text($('#amount').val());

        var step = $(this).attr('step');
        if (step == 1) {
            var val = setWarn('amount');
            if (val == 0) {
                return;
            }
        }
        if (step == 2) {
            var name = setWarn('name');
            if (name == 0) {
                return;
            }
            var mobile = setWarn('mobile');
            if (mobile == 0) {
                return;
            }
            var shift = setWarn('shift');
            if (shift == 0) {
                return;
            }
            var pay = setWarn('pay');
            if (pay == 0) {
                return;
            }
        }
        if (step == 3) {
            var transaction = setWarn('transaction');
            if (transaction == 0) {
                return;
            }
            $.ajax({
                url: "{{route('store.donor')}}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "amount": $('#amount').val(),
                    "name": $('#name').val(),
                    "mobile": $('#mobile').val(),
                    "shift": $('#shift').val(),
                    "address": $('#address').val(),
                    "payment_method": $('#pay').val(),
                    "transaction_no": $('#transaction').val(),
                },
                success: function(response) {
                    if (response.status == 1) {
                        flashy('Thanks for Donating', {
                            type: 'flashy__success'
                        });
                    }
                },
                error: function(response) {

                },
            });
        }

        current_fs = $(this).parent();
        next_fs = $(this).parent().next();

        //Add Class Active
        $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

        //show the next fieldset
        next_fs.show();
        //hide the current fieldset with style
        current_fs.animate({
            opacity: 0
        }, {
            step: function(now) {
                // for making fielset appear animation
                opacity = 1 - now;

                current_fs.css({
                    'display': 'none',
                    'position': 'relative'
                });
                next_fs.css({
                    'opacity': opacity
                });
            },
            duration: 500
        });
        setProgressBar(++current);
    });

    $(".previous").click(function() {

        current_fs = $(this).parent();
        previous_fs = $(this).parent().prev();

        //Remove class active
        $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

        //show the previous fieldset
        previous_fs.show();

        //hide the current fieldset with style
        current_fs.animate({
            opacity: 0
        }, {
            step: function(now) {
                // for making fielset appear animation
                opacity = 1 - now;

                current_fs.css({
                    'display': 'none',
                    'position': 'relative'
                });
                previous_fs.css({
                    'opacity': opacity
                });
            },
            duration: 500
        });
        setProgressBar(--current);
    });

    function setProgressBar(curStep) {
        var percent = parseFloat(100 / steps) * curStep;
        percent = percent.toFixed();
        $(".progress-bar")
            .css("width", percent + "%")
    }



    function setWarn(className) {
        var field = $('#' + className).val();
        if (field == '') {
            $('#' + className).css({
                "border": "1px solid #f82249"
            });
            return 0;
        } else {
            $('#' + className).css({
                "border": "1px solid #ccc"
            });
        }

    }

    $(".submit").click(function() {
        return false;
    })


    $(".fieldlabel").click(function() {
        $('#amount').val('');
        var value = $(this).attr('value');
        $('#amount').val(value);
    });

    $("#pay").change(function() {
        var value = $(this).val();
        if (value == 'bkash') {
            $('.bkash').removeClass('d-none');
            $('.bkash').addClass('d-block');
            $('.nagad').removeClass('d-block');
            $('.nagad').addClass('d-none');
            $('.rocket').removeClass('d-block');
            $('.rocket').addClass('d-none');
            $('.send').text('');
            $('.send').text("{{$settings[6]['value']}}");
        }
        if (value == 'nagad') {
            $('.nagad').removeClass('d-none');
            $('.nagad').addClass('d-block');
            $('.bkash').removeClass('d-block');
            $('.bkash').addClass('d-none');
            $('.rocket').removeClass('d-block');
            $('.rocket').addClass('d-none');
            $('.send').text('');
            $('.send').text("{{$settings[7]['value']}}");
        }
        if (value == 'rocket') {
            $('.rocket').removeClass('d-none');
            $('.rocket').addClass('d-block');
            $('.nagad').removeClass('d-block');
            $('.nagad').addClass('d-none');
            $('.bkash').removeClass('d-block');
            $('.bkash').addClass('d-none');
            $('.send').text('');
            $('.send').text("{{$settings[8]['value']}}");
        }
    });
</script>
@endsection