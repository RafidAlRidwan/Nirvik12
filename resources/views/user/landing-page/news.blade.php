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
'title' => "News",
'sub-title' => "Recent News",
'action' => "",
'button' => "",
'isAuth' => 0,
'route-name' => "",
'button2' => ""
]
@endphp
@include('layouts.user.landing-page.secondary-header', $data)

<!--==========================News Section============================-->
<section id="faq" class="wow fadeInUp">
       <div class="container">
              <div class="section-header">
                     <h2>NEWS</h2>
              </div>
              <div class="row justify-content-center">
                     <div class="col-lg-9">
                            <ul id="faq-list">
                                   @isset($news)
                                   @foreach ($news as $item)
                                   <li>
                                          <a data-toggle="collapse" class="collapsed" href="#faq{{$item->id}}">{{$item->heading}}<i class="fa fa-minus-circle"></i></a>
                                          <div style="text-align: justify;" id="faq{{$item->id}}" class="collapse" data-parent="#faq-list">
                                                 {!!$item->body!!}
                                          </div>
                                   </li>
                                   @endforeach
                                   @endisset

                                   <a style="text-align: center;" class="text-danger pt-1 mb-0 {{ isset($news) && !$news->isEmpty() ? "d-none" : "" }}" id="notice-tools-technology-info" role="notice">
                                          <i class="icon-info22 mr-1" aria-hidden="true"></i> {!! __("No news has been added!") !!}
                                   </a>
                            </ul>
                     </div>
              </div>

       </div>
       <div class="d-flex justify-content-center">
              {!! $news->links() !!}
       </div>
</section>
@endsection

@section('footer')
<!-- ======= Footer ======= -->
@include('layouts.user.landing-page.footer')
@endsection