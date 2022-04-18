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
    #demoInput5-error{
        color: red;
    }
</style>
@endsection
@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <h1 class="m-0">Edit Cover Page</h1>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <ol class="breadcrumb float-sm-right">
                    <a href={{route('cover_page_index')}}><button type="button" class="btn btn-primary">Back</button></a>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content p-2 ">
    <div class="container-fluid m-t-25 card p-3">
    
    {!! Form::open(['action' => ['App\Http\Controllers\Admin\CoverPageController@update'], 'id'=>'from', 'files' => true, 'class' => 'needs-validation']) !!}
        <div class="row">

          <input type="hidden" name="id" value={{$coverPage->id}}>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label for="name">Title</label>
                    <input type="text" class="form-control" name="title" value='{{$coverPage->title}}' id="title" placeholder="" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="summernote" >{{$coverPage->description}}</textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="div-gap col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                <label>Cover Photo</label>
                <div class="tower-file">
                    <input type="hidden" name="image" id="image" value={{$coverPage->attachment}}/>
                    <input type="file" id="demoInput5" name="attachment" />
                    <label for="demoInput5" class="update-button btn btn-primary">
                        <span class=" mdi mdi-upload"></span>Select Files
                    </label>
                    <button type="button" class="btn btn-secondary tower-file-clear align-top">Clear</button>
                </div>
                @if(!empty($coverPage->attachment))
                <div id="edit-img" class="tower-file">
                    <div class=" tower-file-details">
                        <div class="tower-input-preview-container">
                            <img class="null" src="{{asset($coverPage->attachment)}}">
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>        
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
<script>
  $('#summernote').summernote({
    placeholder: '',
    tabsize: 2,
    height: 250
  });
</script>
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