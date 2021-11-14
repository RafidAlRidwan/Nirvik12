@extends('layouts.admin.admin')

@section('style')
<style type="text/css">
  .note-editor.note-airframe .note-editing-area .note-editable, .note-editor.note-frame .note-editing-area .note-editable {
    padding: 10px;
    overflow: auto;
    word-wrap: break-word;
    background: #222;
    color: #ccc;
}
</style>

@endsection

@section('content')

{!! Form::model($about, ['route' => ['about.update', $about->id],'method'=>'put', 'files' => true, 'class' => 'needs-validation', 'novalidate']) !!}

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
            <h1 class="m-0">About Setting</h1>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
            <ol class="breadcrumb float-sm-right">
              <button type="submit" class="btn btn-primary">Update</button>
            </ol>
          </div>
        </div>
      </div>
    </div>


    <section class="content p-2">
      <div class="container-fluid">
        <div class="row m-t-25">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <textarea style="background-color: #222; color: #ccc;" name="description" id="summernote">{{$about->description}}</textarea>
            </div>
        </div>
      </div>
   </section>
  

{!! Form::close() !!}                       
                        
@endsection

@section('script')


<script>
      $('#summernote').summernote({
        placeholder: '',
        tabsize: 2,
        height: 250
      });
    </script>
@endsection