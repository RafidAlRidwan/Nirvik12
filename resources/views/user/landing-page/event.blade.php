@extends('layouts.user.landing-page.master')
@section('main-style')
@endsection
@section('header')
<!-- ======= Header Assets ======= -->
@include('layouts.user.landing-page.header')
@endsection

@section('main-content')

<!--==========================Custom Section============================-->
@php $data = [
'title' => "Events & Program",
'sub-title' => "Recent Events",
'action' => "",
'button' => "",
'isAuth' => 0,
'route-name' => "",
'button2' => ""
]
@endphp
@include('layouts.user.landing-page.secondary-header', $data)


<!--==========================Schedule Section============================-->

<section id="schedule" class="section-with-bg">
       <div class="container wow fadeInUp">
              <div class="section-header">
                     <h2>Event & Program Schedule</h2>
                     <p>Here is our event schedule</p>
              </div>

              @php
              $current_date = date('Y-m-d');
              @endphp
              @foreach ($events as $value)
              @php
              $day1 = date('d', strtotime($value['date']));
              $month1 = date('M', strtotime($value['date']));
              @endphp
              <div class="row schedule-item">
                     <div class="date col-md-2 col-sm-2 col-xl-2">
                            <time datetime="23th feb">
                                   <span>{{$day1}}</span><span>{{$month1}}</span>
                            </time>
                     </div>
                     <div class="col-md-10 col-sm-10 col-xl-10">
                            <div class="speaker">
                            </div>

                            <h4>{{$value['title']}}</h4>
                            <p style="margin-bottom: 5px;"><i class="fa fa-map-marker"></i> {{$value['venue']}}</p>
                            <button class="btn btn-sm btn-primary eventData" style="background-color: #f82249; border:none" data-toggle='modal' data-target='#event-details' title="{{$value['title']}}" body={{$value['description']}}>Details</button>
                     </div>
              </div>
              @endforeach

              <div class="d-flex justify-content-center mt-2">
                     {!! $events->links() !!}
              </div>


       </div>
       <!--==========================Modal============================-->
       <section>
              <div class="modal fade" id="event-details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                     <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content" style="border: none; background: black; background: linear-gradient( to right bottom, rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.4)); border-radius: 1rem; backdrop-filter: blur(5px);">
                                   <div class="modal-header">
                                          <h5 class="modal-title text-bold text-white title" id="exampleModalLabel"></h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                 <span style="color: #f82249; text-shadow: 0 0px 0 #fff; opacity: 1;" aria-hidden="true">&times;</span>
                                          </button>
                                   </div>
                                   <div class="modal-body body text-white">

                                   </div>
                            </div>
                     </div>
              </div>
       </section>
</section>
@endsection
@section('main-script')
<script>
       // Event
       $(".eventData").click(function() {
              var title = $(this).attr('title');
              var body = $(this).attr('body');
              var bodyData = body.replace(/<[^>]+>/g, '').replace(/<\/p>/gi, "\n").replace(/<br\/?>/gi, "\n").replace(/<\/?[^>]+(>|$)/g, "");;

              $('.title').text(title);
              $('.body').text(bodyData);

       });
</script>
@endsection
@section('footer')
<!-- ======= Footer ======= -->
@include('layouts.user.landing-page.footer')
@endsection