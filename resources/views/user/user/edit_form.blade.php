@include('errors.validation')


<div class="row">
    <input type="hidden" name="user_details_id" value="{{$user_details->id}}">
    <div class="div-gap col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
        <label>User Name</label>
        <div class="inputBox">
            {!! Form::text('name', null, [($errors->has('name') ? 'is-invalid' : ''), 'autocomplete' => 'off', 'required' , 'readonly']) !!}

        </div>
        @if ($errors->has('name'))
        <div class="invalid-feedback">{{ $errors->first('name') }}</div>
        @endif

    </div>
    <input type="hidden" name="password" value="{{$user->password}}">

    <div class="div-gap col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
        <label>Full Name</label>
        <div class="inputBox">
            {!! Form::text('full_name', $user_details->full_name, [($errors->has('full_name') ? 'is-invalid' : ''), 'autocomplete' => 'off', 'required']) !!}
        </div>
        @if ($errors->has('full_name'))
        <div class="invalid-feedback">{{ $errors->first('full_name') }}</div>
        @endif

    </div>

    <div class="div-gap col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
        <label>Email<strong style="color: red"> *</strong></label>
        <div class="inputBox">
            {!! Form::email('email', null, [($errors->has('email') ? 'is-invalid' : ''), 'autocomplete' => 'off', 'required']) !!}

        </div>
        @if ($errors->has('email'))
        <div class="invalid-feedback">{{ $errors->first('email') }}</div>
        @endif

    </div>

    <div class="div-gap col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
        <label>Designation</label>
        <div class="inputBox">
            {!! Form::text('designation', $user_details->designation, [($errors->has('designation') ? 'is-invalid' : ''), 'autocomplete' => 'off', 'required']) !!}

        </div>
        @if ($errors->has('designation'))
        <div class="invalid-feedback">{{ $errors->first('designation') }}</div>
        @endif

    </div>

    <div class="div-gap col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
        <label>Company</label>
        <div class="inputBox">
            {!! Form::text('office_name', $user_details->office_name, [($errors->has('office_name') ? 'is-invalid' : ''), 'autocomplete' => 'off', 'required']) !!}

        </div>
        @if ($errors->has('office_name'))
        <div class="invalid-feedback">{{ $errors->first('office_name') }}</div>
        @endif

    </div>

    <div class="div-gap col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
        <label>Current City</label>
        <div class="inputBox">
            {!! Form::text('current_city', $user_details->current_city, [($errors->has('current_city') ? 'is-invalid' : ''), 'autocomplete' => 'off', 'required']) !!}
        </div>
        @if ($errors->has('current_city'))
        <div class="invalid-feedback">{{ $errors->first('current_city') }}</div>
        @endif

    </div>

    <div class="div-gap col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
        <label>Class Roll No.</label>
        <div class="inputBox">
            {!! Form::number('roll_no', $user_details->roll_no, [($errors->has('roll_no') ? 'is-invalid' : ''), 'autocomplete' => 'off', 'required']) !!}

        </div>
        @if ($errors->has('roll_no'))
        <div class="invalid-feedback">{{ $errors->first('roll_no') }}</div>
        @endif

    </div>

    <div class="div-gap col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">

        <label>Section</label>
        {!! Form::select('section', $section, $user_details->section, ['placeholder'=>__('Select a Section') , 'class'=>'wide', ($errors->has('section') ? 'is-invalid' : ''), 'required']) !!}
        @if ($errors->has('religion'))
        <div class="invalid-feedback">{{ $errors->first('section') }}</div>
        @endif

    </div>

    <div class="div-gap col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">

        <label>Shift</label>
        {!! Form::select('shift', $shift, $user_details->shift, ['placeholder'=>__('Select a Shift') , 'class'=>'wide', ($errors->has('shift') ? 'is-invalid' : ''), 'required']) !!}
        @if ($errors->has('shift'))
        <div class="invalid-feedback">{{ $errors->first('shift') }}</div>
        @endif

    </div>

    <div class="div-gap col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
        <label>Religion</label>
        {!! Form::select('religion', $religion, $user_details->religion, ['placeholder'=>__('Select a Religion') , 'class'=>'wide', ($errors->has('religion') ? 'is-invalid' : ''), 'required']) !!}
        @if ($errors->has('religion'))
        <div class="invalid-feedback">{{ $errors->first('religion') }}</div>
        @endif

    </div>

    <div class="div-gap col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
        <label>Currrent Address</label>
        <div class="inputTextArea">
            {!! Form::textarea('current_address', $user_details->current_address, ['rows'=>2, ($errors->has('current_address') ? 'is-invalid' : ''), 'class'=>'custom-textarea' ,'required']) !!}
            @if ($errors->has('current_address'))
            <div class="invalid-feedback">{{ $errors->first('current_address') }}</div>
            @endif

        </div>
    </div>
    <div class="div-gap col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
        <label>Marital Status</label>
        {!! Form::select('marital_status', $marital_status, $user_details->marital_status, ['placeholder'=>__('Select a Status') , 'class'=>'wide changeStatus', ($errors->has('marital_status') ? 'is-invalid' : ''), 'required']) !!}
        @if ($errors->has('marital_status'))
        <div class="invalid-feedback">{{ $errors->first('marital_status') }}</div>
        @endif

    </div>
</div>

<div class="row">
    <div class="field_wrapper">

        @if(!isset($mobile_details))
        <div class="div-gap col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
            <label>Mobile No</label>
            <div class="inputMobile" style="display: flex;">
                <input type="number" class="custom-add" name="mobile[]" />
                <span class="add_button" title="Add field"><i class="fa fa-plus"></i></span>
            </div>
        </div>
        @endif

        @foreach($mobile_details as $key => $item )
        @if($key == 0)
        <div class="div-gap col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
            <label>Mobile No</label>
            <div class="inputMobile" style="display: flex;">
                <input type="number" class="custom-add" name="mobile[]" value="{{$item->mobile}}" />
                <span class="add_button" title="Add field"><i class="fa fa-plus"></i></span>
            </div>
        </div>
        @else
        <article>
            <div class="div-gap col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                <label>Mobile No</label>
                <div class="inputMobile" style="display: flex;">
                    <input type="number" class="custom-add" name="mobile[]" value="{{$item->mobile}}" />
                    <span class="remove_button" title="Add field"><i class="fa fa-minus-circle"></i></span>
                </div>
            </div>
        </article>
        @endif

        @endforeach
        <input type="hidden" name="attachment" id="upload_images">

    </div>
</div>
<div class="row mt-4">
    <div class="div-gap col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
        <div class="image_area">
            @if(!empty($user_details->attachment))
            <label for="upload_image">
                <img id="uploaded_image" src="{{asset('')}}{{ ($user_details->attachment) }}" class="img-fluid" />
            </label>
            <input type="file" name="image" id="upload_image" class="image" style="display:none">

            <div class="overlay">
                <div class="text">Change Image</div>
            </div>
            @endif
        </div>
    </div>
</div>


<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Crop Image Before Upload</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">??</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="img-container">
                    <div class="row">
                        <div class="col-md-8">
                            <img src="" id="sample_image" />
                        </div>
                        <div class="col-md-4">
                            <div class="preview"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="crop">Crop</button>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="inputfield div-gap">
        <button type="submit" class=" btn btn-primary">Update Profile</button>
    </div>
</div>