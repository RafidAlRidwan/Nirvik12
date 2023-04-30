@extends('layouts.admin.admin')

@section('content')

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
        <h1 class="m-0">Event Details</h1>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
        <ol class="breadcrumb float-sm-right">
          <a href={{route('event_index')}}><button type="button" class="btn btn-primary">Back</button></a>
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
                    <div>{{$event->title ?? '-'}}</div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label for="name">Venue</label>
                    <div>{{$event->venue ?? '-'}}</div>
                </div>
            </div>
        </div>
        <!-- <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="form-group">
                    <label for="full_name">Description</label>
                    <div>{!! $event->description ?? '-' !!}</div>
                </div>
            </div>
        </div> -->
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label for="name">Time</label>
                    <div>{{$time ?? '-'}}</div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label for="name">Date</label>
                    <div>{{$date ?? '-'}}</div>
                </div>
            </div>
            
        </div>

    </div>
</section>


@endsection

@section('script')

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