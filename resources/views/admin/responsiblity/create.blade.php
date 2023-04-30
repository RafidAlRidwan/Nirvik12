@extends('layouts.admin.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <h1 class="m-0">Create</h1>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <ol class="breadcrumb float-sm-right">
                    <a href={{route('responsiblity_index')}}><button type="button" class="btn btn-primary">Back</button></a>
                </ol>
            </div>
        </div>
    </div>
</div>
@if($errors->any())
{{ implode('', $errors->all('<div>:message</div>')) }}
@endif
<section class="content p-2 ">
    <div class="container-fluid m-t-25 card p-3">
        {!! Form::open(['action' => ['App\Http\Controllers\Admin\ResponsiblityController@store'], 'files' => true, 'class' => 'needs-validation']) !!}
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label for="name">Title</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="form-group">
                    <label for="description">Short Description</label>
                    <textarea name="short_description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label for="description">Image Upload</label>
                    <input type="file" name="file" class="form-control-file" id="exampleFormControlFile1">
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

@endsection