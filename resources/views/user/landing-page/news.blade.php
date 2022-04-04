@extends('layouts.user.landing-page.master')
@section('main-style')
<style>
       .page-header .container {
       padding-top: 36px;
       padding-bottom: 36px;
       position: relative;
       animation: pop-in 2.5s ease-out;
       }
       
       .container {
       max-width: 1140px;
       padding-right: 30px;
       padding-left: 30px;
       margin-right: auto;
       margin-left: auto;
       }
       .custom-section {
       width: 100%;
       height: auto;
       background: linear-gradient( rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5) ), url(/nirvik12/assets/user/landingPage/img/map.jpg) center;
       background-size: cover;
       overflow: hidden;
       position: relative;
       }
       @media (min-width: 768px){
       .page-header .container {
       padding-top: 100px;
       /* padding-bottom: 48px; */
       }
       }
       @media (max-width: 768px){
       .page-header .container {
       padding-top: 100px;
       /* padding-bottom: 48px; */
       }
       }
       
</style>
@endsection
@section('header')
       <!-- ======= Header Assets ======= -->
       @include('layouts.user.landing-page.header')
@endsection

@section('main-content')

       <!--==========================Custom Section============================-->
       <section>
       <div class="page-header custom-section">
              <div class="backdrop-gradient"></div>
              <div class="container">
                     <div class="breadcrumb-wrap"></div>
                            <h1 style="color: #fff;" class="page-title">News</h1>
                                   <p style="color: #fff;" class="lead">Recent News</p>
                                   <p>
                                          <a class="btn btn-primary" href="#">View All</a>
                                   </p>
                            </div>
              </div>
       </div>
       </section>

       <!--==========================News Section============================-->
       <section id="faq" class="wow fadeInUp">
              <div class="container">
                     <div class="section-header">
                            <h2>NEWS</h2>
                     </div>
                     <div class="row justify-content-center">
                            <div class="col-lg-9">
                                   <ul id="faq-list">
                                          @php
                                                 $newsDetails = App\Models\News::all();
                                          @endphp
                                          @isset($newsDetails)
                                                 @foreach ($newsDetails as $item)
                                                        <li>
                                                               <a data-toggle="collapse" class="collapsed" href="#faq{{$item->id}}">{{$item->heading}}<i class="fa fa-minus-circle"></i></a>
                                                               <div id="faq{{$item->id}}" class="collapse" data-parent="#faq-list">
                                                                      {!!$item->body!!}
                                                               </div>
                                                        </li>
                                                 @endforeach
                                          @endisset

                                          <a style="text-align: center;" class="text-danger pt-1 mb-0 {{ isset($newsDetails) && !$newsDetails->isEmpty() ? "d-none" : "" }}" id="notice-tools-technology-info" role="notice">
                                                 <i class="icon-info22 mr-1" aria-hidden="true"></i> {!! __("No news has been added!") !!}
                                          </a>
                                   </ul>
                            </div>
                     </div>
              </div>
       </section>
@endsection

@section('footer')
       <!-- ======= Footer ======= -->
       @include('layouts.user.landing-page.footer')
@endsection
