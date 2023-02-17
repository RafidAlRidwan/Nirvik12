<!DOCTYPE html>
<html lang="en">

<!-- ======= Header Assets ======= -->
@include('layouts.user.landing-page.header-assets')
<style>
       /*animation*/
       .loading {
              /* background: rgba(255, 255, 255, 0.1); */
              background: rgba(0, 0, 0, 0);
              backdrop-filter: blur(20px);
       }

       svg {
              position: absolute;
              top: 50%;
              left: 50%;
              right: 50%;
              transform: translate(-50%, -50%);

       }

       .path {
              animation: draw 2.5s infinite;
              animation-timing-function: linear;
       }

       @keyframes draw {
              0% {}

              100% {
                     stroke-dashoffset: 0;
                     stroke-opacity: 1;
              }
       }
</style>

<body>

       @yield('header')
       @php
       $cache = Cache::get('settings');
       $banner = $cache->where('key', 'banner')->first();
       @endphp
       <div class="main-scope">
              <!-- Preloader -->
              <div class="loading">
                     <svg width="300px" height="300px" viewBox="0 0 300 300" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <g id="circuit" class="path" stroke-width="1" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round" stroke-opacity="1" stroke-dasharray="45, 45" stroke-dashoffset="180" fill="#fff" stroke="#FFFFFF">
                                   <polyline style="fill:none;stroke:#f82249;stroke-miterlimit:10;" points="28.651,131.726 56.151,131.726 56.151,145.726 249.645,145.726 249.645,128.226     " />
                                   <circle style="fill:#FFFFFF;stroke:#f82249;stroke-miterlimit:10;" cx="28.651" cy="131.726" r="3.057" />
                                   <path style="fill:#FFFFFF;stroke:#f82249;stroke-miterlimit:10;" d="M246.588,128.226c0-1.688,1.369-3.057,3.057-3.057s3.057,1.369,3.057,3.057c0,1.688-1.369,3.057-3.057,3.057S246.588,129.914,246.588,128.226z" />
                                   <line style="fill:none;stroke:#f82249;stroke-miterlimit:10;" x1="96.151" y1="148.118" x2="96.151" y2="241.02" />
                                   <line style="fill:none;stroke:#f82249;stroke-miterlimit:10;" x1="127.221" y1="148.118" x2="127.221" y2="241.02" />
                                   <line style="fill:none;stroke:#f82249;stroke-miterlimit:10;" x1="173.151" y1="145.726" x2="173.151" y2="203.726" />

                                   <line style="fill:none;stroke:#f82249;stroke-width:3;stroke-miterlimit:10;" x1="207.651" y1="145.726" x2="207.651" y2="241.02" />
                                   <path style="fill:#FFFFFF;stroke:#f82249;stroke-width:3;stroke-miterlimit:10;" d="M104.651,184.476c0-1.688,1.369-3.057,3.057-3.057s3.057,1.369,3.057,3.057s-1.369,3.057-3.057,3.057S104.651,186.164,104.651,184.476z" />
                                   <path style="fill:#FFFFFF;stroke:#f82249;stroke-miterlimit:10;" d="M93.721,145.725c0,1.342,1.088,2.431,2.43,2.431s2.43-1.089,2.43-2.431c0-1.341-1.088-2.43-2.43-2.43S93.721,144.385,93.721,145.725z" />
                                   <path style="fill:#FFFFFF;stroke:#f82249;stroke-miterlimit:10;" d="M124.79,145.725c0,1.342,1.089,2.431,2.431,2.431s2.43-1.089,2.43-2.431c0-1.341-1.088-2.43-2.43-2.43S124.79,144.385,124.79,145.725z" />
                                   <path style="fill:#f82249;stroke:#f82249;stroke-width:0.8121;stroke-miterlimit:10;" d="M214.543,81.409c0-2.761,2.238-4.999,4.999-4.999c2.761,0,4.999,2.238,4.999,4.999c0,2.761-2.238,4.999-4.999,4.999C216.782,86.408,214.543,84.17,214.543,81.409z" />
                                   <polyline style="fill:none;stroke:#f82249;stroke-miterlimit:10;" points="96.151,174.226 78.651,187.226 78.651,209.726     " />
                                   <polyline style="fill:none;stroke:#f82249;stroke-miterlimit:10;" points="96.151,209.726 104.651,220.226 104.651,236.726     " />
                                   <circle style="fill:#FFFFFF;stroke:#f82249;stroke-miterlimit:10;" cx="78.651" cy="209.726" r="3.057" />
                                   <circle style="fill:#FFFFFF;stroke:#f82249;stroke-miterlimit:10;" cx="104.651" cy="236.726" r="3.057" />
                                   <circle style="fill:#FFFFFF;stroke:#f82249;stroke-miterlimit:10;" cx="173.151" cy="202.476" r="3.057" />
                                   <path style="fill:#FFFFFF;stroke:#f82249;stroke-miterlimit:10;" d="M170.094,171.17c0-1.688,1.369-3.057,3.057-3.057s3.057,1.369,3.057,3.057s-1.369,3.057-3.057,3.057S170.094,172.857,170.094,171.17z" />
                                   <path style="fill:#f82249;" d="M93.357,241.02c0-1.543,1.251-2.794,2.794-2.794s2.794,1.251,2.794,2.794c0,1.543-1.251,2.794-2.794,2.794S93.357,242.563,93.357,241.02z" />
                                   <circle style="fill:#f82249;" cx="96.151" cy="250.976" r="2.794" />
                                   <circle style="fill:#f82249;" cx="96.151" cy="163.726" r="2.794" />
                                   <path style="fill:#f82249;" d="M124.426,241.02c0-1.543,1.252-2.794,2.795-2.794s2.793,1.251,2.793,2.794c0,1.543-1.25,2.794-2.793,2.794S124.426,242.563,124.426,241.02z" />
                                   <path style="fill:#f82249;" d="M124.426,202.476c0-1.543,1.252-2.794,2.795-2.794s2.793,1.251,2.793,2.794s-1.25,2.794-2.793,2.794S124.426,204.019,124.426,202.476z" />
                                   <polyline style="fill:none;stroke:#f82249;stroke-width:3;stroke-miterlimit:10;" points="135.318,145.726 135.318,178.559 144.984,191.976 144.984,223.226     " />
                                   <line style="fill:none;stroke:#f82249;stroke-width:3;stroke-miterlimit:10;" x1="107.707" y1="145.726" x2="107.707" y2="182.227" />
                                   <circle style="fill:#FFFFFF;stroke:#f82249;stroke-width:3;stroke-miterlimit:10;" cx="144.984" cy="223.226" r="5.834" />
                                   <path style="fill:#FFFFFF;stroke:#f82249;stroke-width:3;stroke-miterlimit:10;" d="M201.817,241.02c0-3.221,2.611-5.834,5.834-5.834s5.834,2.613,5.834,5.834c0,3.221-2.611,5.834-5.834,5.834S201.817,244.241,201.817,241.02z" />
                                   <line style="fill:none;stroke:#f82249;stroke-width:3;stroke-miterlimit:10;" x1="207.651" y1="186.476" x2="231.401" y2="209.726" />
                                   <circle style="fill:#FFFFFF;stroke:#f82249;stroke-width:3;stroke-miterlimit:10;" cx="231.401" cy="209.726" r="4.193" />
                                   <line style="fill:none;stroke:#f82249;stroke-miterlimit:10;" x1="90.876" y1="81.409" x2="144.21" y2="81.409" />
                                   <path style="fill:#FFFFFF;stroke:#f82249;stroke-miterlimit:10;" d="M139.146,81.409c0-2.797,2.268-5.064,5.064-5.064c2.797,0,5.064,2.268,5.064,5.064c0,2.797-2.268,5.064-5.064,5.064C141.414,86.473,139.146,84.206,139.146,81.409z" />
                                   <path style="fill:#FFFFFF;stroke:#f82249;stroke-miterlimit:10;" d="M87.246,81.409c0-2.005,1.625-3.631,3.631-3.631c2.006,0,3.631,1.625,3.631,3.631c0,2.005-1.625,3.631-3.631,3.631C88.871,85.04,87.246,83.414,87.246,81.409z" />
                                   <polyline style="fill:none;stroke:#f82249;stroke-miterlimit:10;" points="117.543,68.876 160.542,68.876 177.042,81.409 219.542,81.409    " />
                                   <path style="fill:#FFFFFF;stroke:#f82249;stroke-miterlimit:10;" d="M113.913,68.876c0-2.005,1.626-3.631,3.631-3.631s3.631,1.626,3.631,3.631c0,2.005-1.626,3.631-3.631,3.631S113.913,70.881,113.913,68.876z" />
                                   <polyline style="fill:none;stroke:#f82249;stroke-width:3;stroke-miterlimit:10;" points="81.542,59.966 198.542,59.966 224.875,40.518    " />
                                   <path style="fill:none;stroke:#f82249;stroke-width:3;stroke-miterlimit:10;" d="M103.265,59.966" />
                                   <path style="fill:#f82249;" d="M232.428,40.52c0,4.17-3.383,7.551-7.553,7.551c-4.171,0-7.553-3.381-7.553-7.551c0-4.171,3.382-7.554,7.553-7.554C229.045,32.966,232.428,36.349,232.428,40.52z" />
                                   <path style="fill:#f82249;" d="M87.246,59.967c0,2.411-1.956,4.366-4.367,4.366c-2.411,0-4.366-1.955-4.366-4.366c0-2.412,1.955-4.368,4.366-4.368C85.29,55.599,87.246,57.555,87.246,59.967z" />
                                   <path style="fill:#f82249;" d="M81.412,81.41c0,2.411-1.955,4.366-4.367,4.366c-2.41,0-4.365-1.955-4.365-4.366c0-2.412,1.955-4.368,4.365-4.368C79.457,77.042,81.412,78.998,81.412,81.41z" />
                                   <img style="position: relative; top: -43px" src="{{asset('assets/user/landingPage/img/logoB.png')}}" width="150">
                            </g>
                     </svg>

              </div>
              <!-- Preloader -->
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