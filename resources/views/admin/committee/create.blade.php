@extends('layouts.admin.admin')

@section('style')
<style>
    .select2-container .select2-selection--single {
        height: 39px;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 40px;
    }
    .callout.callout-info {
        border-left-color: #f82249;
    }
</style>
@endsection

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <h1 class="m-0">Create Committee</h1>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <ol class="breadcrumb float-sm-right">
                    <a href={{route('committee_index')}}><button type="button" class="btn btn-primary">Back</button></a>
                </ol>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="callout callout-info ">
                <h5><i class="fas fa-info"></i> Note:</h5>
                Every Event may have only one Committee!
            </div>
        </div>
    </div>
    </div>
</section>
    <!-- /.content -->
<section class="content p-2 ">
    <div class="container-fluid m-t-25 card p-3">
        {!! Form::open(['action' => ['App\Http\Controllers\Admin\CommitteeController@store'], 'files' => true, 'class' => 'needs-validation']) !!}
        
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Event</label>
                    {!! Form::select('event_id', $events, null, ['placeholder'=>__('Select Event') ,'id'=>'event_id', 'class'=>'form-control', 'style'=>'width: 100%', 'required']) !!}
                </div>
            </div>    
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label for="name">Committee Name</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Manager</label>
                    {!! Form::select('manager_id', $user, null, ['placeholder'=>__('Select Manager') ,'id'=>'manager_id', 'class'=>'form-control select2', 'style'=>'width: 100%', 'required']) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label>Members</label>
                    {!! Form::select('member_id[]', $user, null, ['data-placeholder'=>__('Search Multiple Members') ,'multiple'=>'multiple','id'=>'member_id', 'class'=>'select2', 'style'=>'width: 100%', 'required']) !!}
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
<script>
    //Initialize Select2 Elements
    $('.select2').select2();
    
    // AJAX LOAD
    $("body").on("change","#manager_id",function () {
    var value = $(this).val();
    $("#member_id").empty()
    $.ajax({
        url : 'getUserData/'+value,
        data : '_token = <?php echo csrf_token() ?>',
        type : 'GET',
        dataType : 'json',
        success : function(result){
            var len = 0;
            if(result != null){
                len = result.length;
            }
            // console.log(result.length);
            if(len > 0){
                for(var i = 0; i<len; i++){
                    var id = result[i].user_id;
                    var name = result[i].full_name;

                    var option = "<option value = '"+id+"'>"+name+"</option>";
                    $("#member_id").append(option);
                }
            }
        }
    });
  });
</script>
@endsection