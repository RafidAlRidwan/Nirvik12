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
              background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(/nirvik12/assets/user/landingPage/img/map.jpg) center;
              background-size: cover;
              overflow: hidden;
              position: relative;
       }
       .matrix:hover
       {
              -webkit-box-shadow: 3px 5px 5px -2px #000000; 
              box-shadow: 3px 5px 5px -2px #000000;
              transition: 0.3s;
       }

       .collection-table:hover
       {
              -webkit-box-shadow: 3px 5px 5px -2px #000000; 
              box-shadow: 3px 5px 5px -2px #000000;
              transition: 0.3s;
       }

       @media (min-width: 768px) {
              .page-header .container {
                     padding-top: 100px;
                     /* padding-bottom: 48px; */
              }
       }

       @media (max-width: 768px) {
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
                     <h1 style="color: #fff;" class="page-title">Committees Details</h1>
                     <div class="content">
                            <p style="color: #fff;" class="lead">Recent Events Details</p>
                            <p>
                                   <a class="btn btn-primary" href="#">View All</a>
                            </p>
                     </div>
              </div>
       </div>
</section>

<!--==========================Schedule Section============================-->
<section id="schedule" class="section-with-bg">
       <div class="container wow fadeInUp">
              <div class="section-header">
                     <h2>Event & Program Committee Details</h2>
                     <p>Here is our event Committee Details</p>
              </div>

              <ul class="nav nav-tabs" role="tablist">
                     <li class="nav-item">
                            <a class="nav-link active" href="#day-1" role="tab" data-toggle="tab">Members</a>
                     </li>
                     <li class="nav-item">
                            <a class="nav-link" href="#day-2" role="tab" data-toggle="tab">Collection History</a>
                     </li>
                     <li class="nav-item">
                            <a class="nav-link mt-1" href="#day-3" role="tab" data-toggle="tab">Expenses</a>
                     </li>
              </ul>
              <div class="tab-content row justify-content-center">
                            <!-- Schdule Day 1 -->
                     <div role="tabpanel" class="col-lg-9 tab-pane fade show active" id="day-1">
                     <table class="table table-bordered bg-white table-hover collection-table">
                            <thead style="background-color: #0e1b4d; color: #fff">
                                   <tr>
                                          <th scope="col">#</th>
                                          <th scope="col">Name</th>
                                          <th scope="col">Date</th>
                                          <th scope="col">Amount</th>
                                   </tr>
                            </thead>
                            <tbody>
                                   <tr>
                                          <th scope="row">1</th>
                                          <td>Mark</td>
                                          <td>Manager</td>
                                          <td>1200</td>
                                   </tr>
                                   <tr>
                                          <th scope="row">2</th>
                                          <td>Jacob</td>
                                          <td>Member</td>
                                          <td>2000</td>
                                   </tr>
                                   <tr>
                                          <th scope="row">3</th>
                                          <td>Larry</td>
                                          <td>Member</td>
                                          <td>2332</td>
                                   </tr>
                            </tbody>
                     </table>
                     </div>
                     <div role="tabpanel" class="col-lg-9 tab-pane fade " id="day-2">
                            <div class="row d-flex justify-content-between">
                                   <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4 mb-3 p-0 matrix" >
                                          <div class="d-flex align-items-center shadow-sm h-100">
                                                 <div class="h-100 d-flex justify-content-left align-items-center p-3" style="min-width: 10em; flex-basis: 100%; background-color: #B2BABB; border-left: 5px solid #515A5A;">
                                                        <span style="color: #515A5A ">Total Collection</span>
                                                 </div>
                                                 <div class="d-flex h-100 justify-content-center align-items-center p-3" style="width:calc(100% - 10em); background-color: #E5E8E8;">
                                                        <span class="text-dark">12200</span>
                                                 </div>
                                                 
                                          </div>
                                   </div>
                                   <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4 mb-3 p-0 matrix" >
                                          <div class="d-flex align-items-center shadow-sm h-100">
                                                 <div class="p-2 h-100 d-flex justify-content-left align-items-center" style="min-width: 10em; flex-basis: 100%; background-color: #F1948A; border-left: 5px solid #B03A2E;">
                                                        <span style="color: #B03A2E ">Expenses</span>
                                                 </div>
                                                 <div class="d-flex p-2 h-100 justify-content-center align-items-center" style="width:calc(100% - 10em); background-color: #F5B7B1;">
                                                        <span class="text-dark">0</span>
                                                 </div>
                                                 
                                          </div>
                                   </div>
                            </div>
                            <div class="row">
                            <table class="table table-bordered bg-white table-hover collection-table">
                                   <thead style="background-color: #0e1b4d; color: #fff">
                                          <tr>
                                                 <th scope="col">#</th>
                                                 <th scope="col">Name</th>
                                                 <th scope="col">Role</th>
                                                 <th scope="col">Balance</th>
                                                 <th scope="col">Remarks</th>
                                          </tr>
                                   </thead>
                                   <tbody>
                                          <tr>
                                                 <th scope="row">1</th>
                                                 <td>Mark</td>
                                                 <td>Manager</td>
                                                 <td>1200</td>
                                                 <td>Done</td>
                                          </tr>
                                          <tr>
                                                 <th scope="row">2</th>
                                                 <td>Jacob</td>
                                                 <td>Member</td>
                                                 <td>2000</td>
                                                 <td>Pending</td>
                                          </tr>
                                          <tr>
                                                 <th scope="row">3</th>
                                                 <td>Larry</td>
                                                 <td>Member</td>
                                                 <td>2332</td>
                                                 <td>Process</td>
                                          </tr>
                                   </tbody>
                            </table>
                            </div>
                     </div>
                     <div role="tabpanel" class="col-lg-9 tab-pane fade " id="day-3">
                            <div class="row d-flex justify-content-between">
                                   <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4 mb-3 p-0 matrix" >
                                          <div class="d-flex align-items-center shadow-sm h-100">
                                                 <div class="h-100 d-flex justify-content-left align-items-center p-3" style="min-width: 10em; flex-basis: 100%; background-color: #B2BABB; border-left: 5px solid #515A5A;">
                                                        <span style="color: #515A5A ">Total Collection</span>
                                                 </div>
                                                 <div class="d-flex h-100 justify-content-center align-items-center p-3" style="width:calc(100% - 10em); background-color: #E5E8E8;">
                                                        <span class="text-dark">12200</span>
                                                 </div>
                                                 
                                          </div>
                                   </div>
                                   <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4 mb-3 p-0 matrix" >
                                          <div class="d-flex align-items-center shadow-sm h-100">
                                                 <div class="p-2 h-100 d-flex justify-content-left align-items-center" style="min-width: 10em; flex-basis: 100%; background-color: #F1948A; border-left: 5px solid #B03A2E;">
                                                        <span style="color: #B03A2E ">Expenses</span>
                                                 </div>
                                                 <div class="d-flex p-2 h-100 justify-content-center align-items-center" style="width:calc(100% - 10em); background-color: #F5B7B1;">
                                                        <span class="text-dark">0</span>
                                                 </div>
                                                 
                                          </div>
                                   </div>
                            </div>
                            <div class="row">
                            <table class="table table-bordered bg-white table-hover collection-table">
                                   <thead style="background-color: #0e1b4d; color: #fff">
                                          <tr>
                                                 <th scope="col">#</th>
                                                 <th scope="col">Amount</th>
                                                 <th scope="col">Date</th>
                                                 <th scope="col">Remarks</th>
                                          </tr>
                                   </thead>
                                   <tbody>
                                          <tr>
                                                 <th scope="row">1</th>
                                                 <td>1200</td>
                                                 <td>12 Feb, 2022</td>
                                                 <td>Rice 15kg</td>
                                          </tr>
                                          <tr>
                                                 <th scope="row">2</th>
                                                 <td>2000</td>
                                                 <td>14 March, 2022</td>
                                                 <td>Chicken</td>
                                          </tr>
                                          <tr>
                                                 <th scope="row">3</th>
                                                 <td>8322</td>
                                                 <td>4 May, 2022</td>
                                                 <td>Mutton</td>
                                          </tr>
                                   </tbody>
                            </table>
                            </div>
                     </div>
              </div>
       </div>
</section>
@endsection

@section('footer')
<!-- ======= Footer ======= -->
@include('layouts.user.landing-page.footer')
@endsection