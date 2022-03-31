@extends('layouts.admin.admin')

@section('style')
<style>
    .tower-input-preview-container img {
    vertical-align: middle;
    border-style: none;
    width: 300px;
    margin-bottom: 10px;
    }
</style>
@endsection

@section('content')

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
        <h1 class="m-0">Picture Details</h1>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
        <ol class="breadcrumb float-sm-right">
          <a href={{route('gallery_index')}}><button type="button" class="btn btn-primary">Back</button></a>
        </ol>
      </div>
    </div>
  </div>
</div>

<hr>

<section class="content p-2 ">
    <div class="container-fluid m-t-25 card p-3">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label for="name">Title</label>
                    <div>{{$gallery->title ?? '-'}}</div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label for="name">Album</label>
                    <div>{{$album_details[0]['title'] ?? 'Others'}}</div>
                </div>
            </div>
        </div>

        @if(!empty($gallery->attachment))
          <div class="row">
              <div class="div-gap col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                  <label>Picture</label>
                  <div id="edit-img" class="tower-file">
                      <div class=" tower-file-details">
                          <div class="tower-input-preview-container">
                              <img class="null" src="{{asset($gallery->attachment)}}">
                          </div>
                      </div>
                  </div>
              </div>
          </div>
        @endif

    </div>
</section>


@endsection

@section('script')

@endsection