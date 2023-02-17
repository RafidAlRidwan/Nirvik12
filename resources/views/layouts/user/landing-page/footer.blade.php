<!--==========================Footer============================-->
<div class="animation-area">
       <footer id="footer">

              <ul class="box-area">
                     <li><img src={{asset('assets/user/landingPage/img/box1.png')}} width="80" height="80" style="border-radius: 50%" /></li>
                     <li><img src={{asset('assets/user/landingPage/img/box1.png')}} width="30" height="30" style="border-radius: 50%" /></li>
                     <li><img src={{asset('assets/user/landingPage/img/box1.png')}} width="40" height="40" style="border-radius: 50%" /></li>
                     <li><img src={{asset('assets/user/landingPage/img/box1.png')}} width="50" height="50" style="border-radius: 50%" /></li>
                     <li><img src={{asset('assets/user/landingPage/img/box1.png')}} width="40" height="40" style="border-radius: 50%" /></li>
                     <li><img src={{asset('assets/user/landingPage/img/box1.png')}} width="45" height="45" style="border-radius: 50%" /></li>
              </ul>

              <div class="footer-top">
                     <div class="container">
                            <div class="row">
                                   @php
                                   $cache = Cache::get('settings');
                                   $app_name = $cache->where('key', 'app_name')->first();
                                   $banner = $cache->where('key', 'banner')->first();
                                   $description = $cache->where('key', 'description')->first();
                                   $address = $cache->where('key', 'address')->first();
                                   $phone = $cache->where('key', 'phone')->first();
                                   $email = $cache->where('key', 'email')->first();
                                   @endphp

                                   <div class="col-lg-6 col-md-6 footer-info">
                                          <img style="position: relative;height: 100px;left: -24px;" src="{{asset($banner->value)}}" alt="Nirvik'12">
                                          <p style="text-align:justify;">{{$description->value}}</p>
                                   </div>

                                   <div class="col-lg-6 col-md-6 footer-contact" style="text-align:end; padding-top:25px; margin-bottom:0px ">
                                          <h4>Contact Us</h4>
                                          <p>{{$address->value}}<br>
                                                 <strong>Phone:</strong> {{$phone->value}}<br>
                                                 <strong>Email:</strong> {{$email->value}}<br>
                                          </p>

                                          <div class="social-links">
                                                 <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
                                                 <a href="https://www.facebook.com/groups/138718299513425" class="facebook"><i class="fa fa-facebook"></i></a>
                                                 <a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
                                                 <a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>
                                                 <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
                                          </div>

                                   </div>

                            </div>
                     </div>
              </div>

              <div class="container">
                     <div class="copyright">
                            &copy; Copyright <strong>{{$app_name->value}}</strong>. All Rights Reserved
                     </div>
                     <div class="credits">
                            Designed & Developed by <a target="_blank" style="font-weight: 600; font-size:16px;" href="https://www.linkedin.com/in/rafidalridwan/">ᖇᗩᖴᎥᗪ ᗩᒪ ᖇᎥᗪᗯᗩᑎ</a>
                     </div>
              </div>

       </footer>
</div>