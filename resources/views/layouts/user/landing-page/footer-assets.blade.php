<!--==========================Back to top============================-->
<a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>

<!-- JavaScript Libraries -->
<script src="{{asset('assets/user/landingPage/lib/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/user/landingPage/lib/jquery/jquery-migrate.min.js')}}"></script>
<script src="{{asset('assets/user/landingPage/lib/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/user/landingPage/lib/easing/easing.min.js')}}"></script>
<script src="{{asset('assets/user/landingPage/lib/superfish/hoverIntent.js')}}"></script>
<script src="{{asset('assets/user/landingPage/lib/superfish/superfish.min.js')}}"></script>
<script src="{{asset('assets/user/landingPage/lib/wow/wow.min.js')}}"></script>
<script src="{{asset('assets/user/landingPage/lib/venobox/venobox.min.js')}}"></script>
<script src="{{asset('assets/user/landingPage/lib/owlcarousel/owl.carousel.min.js')}}"></script>

<!-- Slider -->
<script src="{{asset('assets/user/landingPage/slider/js/swiper.min.js')}}"></script>
<script src="{{asset('assets/user/landingPage/slider/js/main.js')}}"></script>

<!-- Contact Form JavaScript File -->
<script src="{{asset('assets/user/landingPage/contactform/contactform.js')}}"></script>

<!-- Template Main Javascript File -->
<script src="{{asset('assets/user/landingPage/js/main.js')}}"></script>

<!-- Preloader -->
<script type="text/javascript">
       $(window).on('load', function() {
              $('.loading').delay(450).fadeOut('slow');
              $('body').delay(450).css({
                     'overflow': 'visible'
              });
       });
</script>
@yield('main-script')
