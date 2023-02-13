<!--==========================Back to top============================-->
<a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>

<!-- JavaScript Libraries -->
<!-- <script src="{{asset('assets/user/landingPage/lib/jquery/jquery.min.js')}}"></script> -->
<script src="{{asset('assets/user/landingPage/datatable/js/jquery-3.5.1.js')}}"></script>
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
<!-- Vue Js -->
<script src="{{asset('assets/user/landingPage/vue/vue@2.6.14')}}"></script>
<script src="{{asset('assets/user/landingPage/vue/vue-resource@1.5.3')}}"></script>
<!-- CUSTOM SELECT -->
<script src="{{asset('assets/user/landingPage/custom-select/js/jquery.nice-select.min.js')}}"></script>
<script src="{{asset('assets/user/landingPage/custom-select/js/fastclick.js')}}"></script>
<script src="{{asset('assets/user/landingPage/custom-select/js/prism.js')}}"></script>
<!-- Preloader -->
<script type="text/javascript">
       $(window).on('load', function() {
              $('.loading').delay(450).fadeOut('slow');
              $('body').delay(450).css({
                     'overflow': 'visible'
              });
       });
</script>

<!-- ALert -->
<script src="{{asset('assets/admin/plugins/toastr/toastr.min.js')}}"></script>
<!-- Notification -->
<script src="{{asset('assets/user/landingPage/notification/js/flashy.min.js')}}"></script>
@yield('main-script')