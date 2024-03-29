<!--==========================Header============================-->
<header id="header">
       <div class="container">
              @php
              $cache = Cache::get('settings');
              $banner = $cache->where('key', 'banner')->first();
              @endphp

              <div id="logo" class="pull-left">
                     <a href="{{url('/')}}" class="scrollto"><img src="{{asset($banner->value)}}" alt="" title=""></a>
              </div>
              @php
              $newsDetails = App\Models\News::orderBy('created_at', 'desc')->get();
              @endphp
              <nav id="nav-menu-container">
                     <ul class="nav-menu">
                            <li class="{{request()->is('/') ? 'menu-active' : ''}}">
                                   <a href={{URL::to('/')}}>Home</a>
                            </li>

                            <li>
                                   <a href="#about">About</a>
                            </li>

                            <li class="{{request()->is('news') ? 'menu-active' : ''}}">
                                   <!-- <a href={{URL::to('/news')}}>News <span class="icon-button-badge">{{count($newsDetails)}}</span></a> -->
                                   <!-- <a href={{URL::to('/news')}}>News</a>
                                   <ul>
                                          <li><a href="#">Gallery: carousel</a></li>
                                          <li><a href="#">Gallery: images</a></li>
                                          <li><a href="#">Gallery: animations</a></li>
                                          <li><a href="#">Gallery: videos</a></li>
                                   </ul> -->
                            </li>

                            <li class="{{request()->is('events') ? 'menu-active' : ''}}">
                                   <a href={{URL::to('/events')}}>Events</a>
                            </li>
                            <li class="{{request()->is('blog') ? 'menu-active' : ''}} || 
                            {{request()->is('blog/*') ? 'menu-active' : ''}}">
                                   <a href={{URL::to('/blog')}}>Blogs</a>
                            </li>

                            @if(auth()->user())
                            <li class="{{request()->is('user/committee/*') ? 'menu-active' : ''}} || {{request()->is('user/committee') ? 'menu-active' : ''}}">
                                   <a href="{{URL::to('user/committee/')}}" class="">Committee</a>
                            </li>
                            @else
                            <li class="{{request()->is('public/committee/*') ? 'menu-active' : ''}}">
                                   <a href={{URL::to('/public/committee/view')}}>Committee</a>
                            </li>
                            @endif

                            @if(auth()->user() && auth()->user()->type === 3)
                            <li class="{{(request()->is('album') ? 'menu-active' : '') }} || 
                            {{(request()->is('gallery/*') ? 'menu-active' : '')}} ">
                                   <a href={{URL::to('/album')}}>Gallary</a>
                            </li>
                            <li class="{{request()->is('user/dashboard') ? 'menu-active' : ''}}">
                                   <a href="{{URL::to('user/dashboard')}}">Class Mates</a>
                            </li>
                            <li class="{{request()->is('user/my-profile/*') ? 'menu-active' : ''}}">
                                   <a href="{{route('myProfile', auth()->user()->id)}}" class="">My Profile</a>
                            </li>
                            <li class="{{request()->is('user/donate') ? 'menu-active' : ''}}">
                                   <a href="{{URL::to('user/donate')}}">Donate</a>
                            </li>
                            @endif

                            @if(auth()->user() && (auth()->user()->type === 1 || auth()->user()->type === 2))
                            <li>
                                   <a href="{{url('/user/dashboard')}}" class="">Admin Panel</a>
                            </li>
                            @endif

                            @if(auth()->user())
                            <span class="buy-tickets"><a onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();" href="{{ route('logout') }}">logout</a></span>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                   @csrf
                            </form>
                            @else
                            <span class="buy-tickets"><a href="{{URL::to('user/login')}}">Login</a></span>
                            @endif
                            <!-- @if(Session::has('userName'))
                            
                            @else
                            @endif -->
                     </ul>
              </nav>
       </div>
</header>