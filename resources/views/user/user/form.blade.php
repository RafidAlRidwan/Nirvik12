@include('errors.validation')     

    
    <div class="row">
         <div class="div-gap col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
            <label>User Name</label>
                <div class="inputBox">
                    {!! Form::text('name', null, [($errors->has('name') ? 'is-invalid' : ''), 'autocomplete' => 'off', 'required']) !!}

                </div>
                @if ($errors->has('name'))
                <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                @endif

        </div>

        <!-- <div class="div-gap col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
            <label>Password<strong style="color: red"> *</strong></label>
            <div class="inputBox">
                <input type="password" name="password" value="" autocomplete="off" required="">
            </div>
            @if ($errors->has('password'))
            <div class="invalid-feedback">{{ $errors->first('password') }}</div>
            @endif

        </div> -->

        <div class="div-gap col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
            <label>Full Name</label>
                <div class="inputBox">
                    {!! Form::text('full_name', null, [($errors->has('full_name') ? 'is-invalid' : ''), 'autocomplete' => 'off', 'required']) !!}
                </div>
                @if ($errors->has('full_name'))
                <div class="invalid-feedback">{{ $errors->first('full_name') }}</div>
                @endif

        </div>

        

        

        <div class="div-gap col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
            <label>Email</label>
            <div class="inputBox">
                {!! Form::email('email',  null, [($errors->has('email') ? 'is-invalid' : ''),  'autocomplete' => 'off', 'required']) !!}

            </div>
            @if ($errors->has('email'))
            <div class="invalid-feedback">{{ $errors->first('email') }}</div>
            @endif

        </div>

 
         <div class="div-gap col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
            <label>Designation</label>
                <div class="inputBox">
                    {!! Form::text('designation', null, [($errors->has('designation') ? 'is-invalid' : ''), 'autocomplete' => 'off', 'required']) !!}
                    
                </div>
                @if ($errors->has('designation'))
                <div class="invalid-feedback">{{ $errors->first('designation') }}</div>
                @endif

        </div>

        <div class="div-gap col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
            <label>Company</label>
                <div class="inputBox">
                    {!! Form::text('office_name', null, [($errors->has('office_name') ? 'is-invalid' : ''), 'autocomplete' => 'off', 'required']) !!}

                </div>
                @if ($errors->has('office_name'))
                <div class="invalid-feedback">{{ $errors->first('office_name') }}</div>
                @endif

        </div>
        
    
    
         <div class="div-gap col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
            <label>Current City</label>
            <div class="inputBox">
                {!! Form::text('current_city', null, [($errors->has('current_city') ? 'is-invalid' : ''), 'autocomplete' => 'off', 'required']) !!}
            </div>
            @if ($errors->has('current_city'))
            <div class="invalid-feedback">{{ $errors->first('current_city') }}</div>
            @endif

        </div>

        

        <div class="div-gap col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                    <label>Class Roll No.</label>
                    <div class="inputBox">
                        {!! Form::number('roll_no', null, [($errors->has('roll_no') ? 'is-invalid' : ''), 'autocomplete' => 'off', 'required']) !!}

                    </div>
                    @if ($errors->has('roll_no'))
                    <div class="invalid-feedback">{{ $errors->first('roll_no') }}</div>
                    @endif

        </div>

         <div class="div-gap col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">

          <label>Section</label>
          {!! Form::select('section', $section, null, ['placeholder'=>__('Select a Section') , 'class'=>'wide', ($errors->has('section') ? 'is-invalid' : ''), 'required']) !!}
          @if ($errors->has('religion'))
                <div class="invalid-feedback">{{ $errors->first('section') }}</div>
          @endif
          
        </div>

        <div class="div-gap col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">

          <label>Shift</label>
          {!! Form::select('shift', $shift, null, ['placeholder'=>__('Select a Shift') , 'class'=>'wide', ($errors->has('shift') ? 'is-invalid' : ''), 'required']) !!}
          @if ($errors->has('shift'))
                <div class="invalid-feedback">{{ $errors->first('shift') }}</div>
          @endif
          
        </div>

        <div class="div-gap col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
            @php
                $religion = [1 => 'Islam' , 2 => 'Hinduism' , 3 =>'Buddhism' , 4 => 'Christianity' ];    
            @endphp
          <label>Religion</label>
          {!! Form::select('religion', $religion, null, ['placeholder'=>__('Select a Religion') , 'class'=>'wide', ($errors->has('religion') ? 'is-invalid' : ''), 'required']) !!}
          @if ($errors->has('religion'))
                <div class="invalid-feedback">{{ $errors->first('religion') }}</div>
          @endif
          
        </div>

        <div class="div-gap col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                <label>Currrent Address</label>
                <div class="inputTextArea">         
                {!! Form::textarea('current_address', null, ['rows'=>2, ($errors->has('current_address') ? 'is-invalid' : ''), 'class'=>'custom-textarea' ,'required']) !!}
                @if ($errors->has('current_address'))
                    <div class="invalid-feedback">{{ $errors->first('current_address') }}</div>
                @endif

            </div>
        </div>
     </div>
  
     <div class="row">
        <div class="field_wrapper">
        
        
            
                <div class="div-gap col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                            <label>Mobile No</label>                       
                        <div class="inputMobile" style="display: flex;">                    
                            <input type="number" class="custom-add" name="mobile[]" value="null"/>
                            <span class="add_button" title="Add field"><i class="fa fa-plus"></i></span>
                        </div>
                </div>
             
        
           
        </div>
     </div>
  
    <div class="row">


        

        <div class="div-gap col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
            @php
                $marital_status = [1 => 'Bachelor' , 2 => 'Married'];    
            @endphp
          <label>Marital Status</label>
          {!! Form::select('marital_status', $marital_status, null, ['placeholder'=>__('Select a Status') , 'class'=>'wide changeStatus', ($errors->has('marital_status') ? 'is-invalid' : ''), 'required']) !!}
          @if ($errors->has('marital_status'))
                <div class="invalid-feedback">{{ $errors->first('marital_status') }}</div>
          @endif
          
        </div>
     <div id="marital-status">
        
        <div class="div-gap col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                    <label>Spouse Name</label>
                    <div class="inputBox">
                        {!! Form::text('spouse_name', null, [($errors->has('spouse_name') ? 'is-invalid' : ''), 'autocomplete' => 'off', 'required']) !!}

                    </div>
                    @if ($errors->has('spouse_name'))
                    <div class="invalid-feedback">{{ $errors->first('spouse_name') }}</div>
                    @endif
        </div>

        <div class="div-gap col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                    <label>No of Children</label>
                    <div class="inputBox">
                        {!! Form::number('no_of_children', null, [($errors->has('no_of_children') ? 'is-invalid' : ''), 'autocomplete' => 'off', 'required']) !!}

                    </div>
                    @if ($errors->has('no_of_children'))
                    <div class="invalid-feedback">{{ $errors->first('no_of_children') }}</div>
                    @endif
        </div>
        
       </div> 


    </div>

    <div class="row">
        <div class="div-gap col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
            <label>Profile Picture</label>
            <div class="tower-file">
                <input type="file" id="demoInput5" name="attachment" value="" />
                <label for="demoInput5" class="btn btn-primary">
                    <span class="mdi mdi-upload"></span>Select Files
                </label>
                <button type="button" class="btn btn-secondary tower-file-clear align-top">Clear</button>
            </div>
        @if(!empty($value->attachment))
            <div id="edit-img" class="tower-file">
                <div class=" tower-file-details">
                    <div class="tower-input-preview-container">
                        <img class="null" src="{{asset('assets/user/landingPage/img/profilePicture')}}/{{ ($value->attachment) }}">
                    </div>
                </div> 
            </div>
        @endif

        </div>
    </div>

<div class="row">
  <div class="inputfield div-gap">
    <button type="submit" class="btn btn-primary">Save</button>
 </div>
</div>



 

