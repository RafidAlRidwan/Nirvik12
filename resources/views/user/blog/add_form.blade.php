@include('errors.validation')


<div class="row">
    <div class="div-gap col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <label>Title</label>
        <div class="inputBox">
            {!! Form::text('title', null, [($errors->has('title') ? 'is-invalid' : ''), 'autocomplete' => 'off', 'required']) !!}
        </div>
        @if ($errors->has('title'))
        <div class="invalid-feedback">{{ $errors->first('title') }}</div>
        @endif
    </div>
</div>
<div class="row">
    <div class="div-gap col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <label>Description</label>
        <textarea name="description" id="default">{{$errors->has('description') ? old('description') : ''}}</textarea>
    </div>
    @if ($errors->has('description'))
    <div class="invalid-feedback">{{ $errors->first('description') }}</div>
    @endif
</div>



<div class="row">
    <div class="div-gap col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
        <label>Blog Picture</label>
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
        <button type="submit" class="btn btn-primary btn-sm">Save</button>
    </div>
</div>