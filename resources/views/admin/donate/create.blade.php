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
</style>
@endsection

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <h1 class="m-0">Add Donate</h1>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <ol class="breadcrumb float-sm-right">
                    <a href={{route('sponsor_index')}}><button type="button" class="btn btn-primary">Back</button></a>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content p-2 ">
    <div class="container-fluid m-t-25 card p-3">
        {!! Form::open(['action' => ['App\Http\Controllers\Admin\SponsorController@store'], 'files' => true, 'class' => 'needs-validation', 'id' =>'form']) !!}
        <div class="row">
            <div class="mb-3 col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                <label>Upload Sponsor Image</label>
                <div class="tower-file">
                    <input type="file" id="demoInput5" name="attachment" value="" required />
                    <label for="demoInput5" class="btn btn-primary">
                        <span class="mdi mdi-upload"></span>Select Files
                    </label>
                    <button type="button" class="btn btn-secondary tower-file-clear align-top">Clear</button>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="inputfield div-gap">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
        {!! Form::close() !!}
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

<script>
    $.validator.addMethod('filesize', function(value, element, param) {
        return this.optional(element) || (element.files[0].size <= param)
    });

    $('#form').validate({
        rules: {

            file: {
                required: true,
                extension: "png|jpeg|jpg",
                filesize: 1048576,
            }
        },
        messages: {
            file: "File must be JPEG or PNG, less than 1MB"
        },
        highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error');
        },

        errorPlacement: function(error, element) {
            if (element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
    });
</script>
@endsection