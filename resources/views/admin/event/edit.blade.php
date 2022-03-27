@extends('layouts.admin.admin')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <h1 class="m-0">Edit Event</h1>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <ol class="breadcrumb float-sm-right">
                    <a href={{route('event_index')}}><button type="button" class="btn btn-primary">Back</button></a>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content p-2 ">
    <div class="container-fluid m-t-25 card p-3">
    
    {!! Form::open(['action' => ['App\Http\Controllers\Admin\EventController@update'], 'id'=>'edit_event', 'files' => true, 'class' => 'needs-validation']) !!}
        <div class="row">

          <input type="hidden" name="id" value={{$event->id}}>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label for="name">Title</label>
                    <input type="text" class="form-control" name="title" value={{$event->title}} id="title" placeholder="" required>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Venue</label>
                    <input type="text" class="form-control" name="venue" id="venue" value={{$event->venue}}  placeholder="" required>
                </div>
            </div>
            
        </div>
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
              <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="summernote" >{{$event->description}}</textarea>
              </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Time</label>
                    <input type="time" class="form-control" name="time" value={{$date}} id="time"  placeholder="">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Date</label>
                    <input type="date" class="form-control datepicker" value={{$event->date}} data-date-format="mm/dd/yyyy" name="date" id="date" autocomplete="off"  placeholder="">
                </div>
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
@endsection