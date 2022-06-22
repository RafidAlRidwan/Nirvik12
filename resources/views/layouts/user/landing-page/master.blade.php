<!DOCTYPE html>
<html lang="en">

<!-- ======= Header Assets ======= -->
@include('layouts.user.landing-page.header-assets')

<body>

       @yield('header')

       <div class="main-scope">
              <!-- Preloader -->
              <div class="loading">
                     <span class="loader"><span class="loader-inner"></span></span>
              </div>
              <main id="main">
                     @yield('main-content')
              </main>
       </div>

       @yield('footer')

       <!-- ======= Footer Assets ======= -->
       @include('layouts.user.landing-page.footer-assets')

       <!-- Turn Off Inspect -->
       <!-- <script>
              $(document).bind("contextmenu", function(e) {
                     e.preventDefault();

              });
       </script> -->
</body>

</html>