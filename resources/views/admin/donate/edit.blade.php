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
</style>
@endsection

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <h1 class="m-0">Edit Donate</h1>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <ol class="breadcrumb float-sm-right">
                    <a href={{route('donate_index')}}><button type="button" class="btn btn-primary">Back</button></a>
                </ol>
            </div>
        </div>
    </div>
</div>
@include('errors.validation')
<section class="content p-2 ">
    <div class="container-fluid m-t-25 card p-3">

        {!! Form::open(['action' => ['App\Http\Controllers\Admin\DonateController@update'], 'id'=>'edit_event', 'files' => true, 'class' => 'needs-validation']) !!}
        <div class="row">
            <div class="inputfield div-gap">
                <button type="submit" class="btn btn-primary">Update</button>
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

<script type="text/javascript">
    $(document).on('click', '#demoInput5', function() {
        $('#edit-img').hide();
    });
</script>
@endsection