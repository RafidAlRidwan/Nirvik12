@extends('layouts.admin.admin')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <h1 class="m-0">Edit User</h1>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <ol class="breadcrumb float-sm-right">
                <!-- <button type="submit" data-toggle="modal" data-target="#exampleModalCenter" class="btn btn-primary">Add New</button> -->
                </ol>
            </div>
            </div>
        </div>
    </div>

    <section class="content p-2 ">
        <div class="container-fluid m-t-25 card p-3">
        {!! Form::model($user, ['route' => ['user.update', $user->id],'method'=>'put', 'files' => true, 'class' => 'needs-validation', 'novalidate']) !!}
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">          
                    <div class="form-group">
                        <label for="name">User Name</label>
                        <input type="text" class="form-control" name="name" value="{{$user->name}}" id="name" placeholder="">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">          
                    <div class="form-group">
                        <label for="full_name">Full Name</label>
                        <input type="text" class="form-control" id="full_name" name="full_name" value="{{$user_details[0]['full_name']}}" placeholder="">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">          
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Email address</label>
                        <input type="email" class="form-control" name="email" id="email" value="{{$user->email}}" placeholder="">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">          
                    <div class="form-group">
                        <label for="designation">Designation</label>
                        <input type="text" class="form-control" name="designation" id="designation" value="{{$user_details[0]['designation']}}" placeholder="">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">          
                    <div class="form-group">
                        <label for="office_name">Company</label>
                        <input type="text" class="form-control" id="office_name" name="office_name" value="{{$user_details[0]['office_name']}}" placeholder="">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">          
                    <div class="form-group">
                        <label for="current_city">Current City</label>
                        <input type="text" class="form-control" id="current_city" placeholder="" value="{{$user_details[0]['current_city']}}" name="current_city">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">          
                    <div class="form-group">
                        <label for="roll_no">Class Roll No.</label>
                        <input type="text" name="roll_no" class="form-control" id="roll_no" value="{{$user_details[0]['roll_no']}}"  placeholder="">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">          
                    <div class="form-group">
                        <label for="section">Section</label>
                        {!! Form::select('section', $section, ($user_details[0]['section']) ,['placeholder'=>__('Select a Section') , 'class'=>'form-control', ($errors->has('section') ? 'is-invalid' : ''), 'required']) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">          
                    <div class="form-group">
                            <label for="shift">Shift</label>
                            {!! Form::select('shift', $shift, ($user_details[0]['shift']) ,['placeholder'=>__('Select a Shift') , 'class'=>'form-control', ($errors->has('shift') ? 'is-invalid' : ''), 'required']) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">          
                    <div class="form-group">
                        <label for="religion">Religion</label>
                        {!! Form::select('religion', $religion, ($user_details[0]['religion']) ,['placeholder'=>__('Select a Religion') , 'class'=>'form-control', ($errors->has('religion') ? 'is-invalid' : ''), 'required']) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">          
                    <div class="form-group">
                            <label for="current_address">Currrent Address</label>
                            <input type="text" class="form-control" id="current_address" placeholder="" name="current_address" value="{{$user_details[0]['current_address']}}">
                    </div>
                </div>
            </div>
            <div class="row">
            @if(!empty($mobile_details))
            @foreach($mobile_details as $key => $value)
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">          
                    <div class="form-group">
                            <label for="mobile">Mobile No. {{$key + 1}}</label>
                            <input type="text" class="form-control" id="current_address" placeholder="" name="mobile[]" value="{{$value->mobile}}">
                    </div>
                </div>
            @endforeach
            @endif
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">          
                    <div class="form-group">
                            <label for="marital_status">Marital Status</label>
                            {!! Form::select('marital_status', $marital_status,($user_details[0]['marital_status']) , ['placeholder'=>__('Select a Status') , 'class'=>'form-control', ($errors->has('marital_status') ? 'is-invalid' : ''), 'required']) !!}
                    </div>
                </div>
                @if(!empty($user_details[0]['spouse_name']))
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4"> 
                    <div class="form-group">
                                <label for="spouse_name">Spouse Name</label>
                                <input type="text" class="form-control" id="spouse_name" placeholder="" name="spouse_name" value="{{$user_details[0]['spouse_name']}}">
                    </div>
                </div>
                @endif
                @if(!empty($user_details[0]['number_of_child']))
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4"> 
                    <div class="form-group">
                                <label for="number_of_child">No of Children</label>
                                <input type="number" class="form-control" id="number_of_child" placeholder="" name="number_of_child" value="{{$user_details[0]['number_of_child']}}">
                    </div>
                </div>
                @endif
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">   
                <label>Profile Picture</label>       
                    <div class="tower-file">
                        <input type="file" id="demoInput5" name="attachment" value="" />
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