<!--==========================Header============================-->
<header id="header">
       <div class="container">
              @php
              $cache = Cache::get('settings');
              $banner = $cache->where('key', 'banner')->first();
              @endphp

              <div id="logo" class="pull-left">
                     <a href="#intro" class="scrollto"><img src="{{asset($banner->value)}}" alt="" title=""></a>
              </div>
              @php
              $newsDetails = App\Models\News::orderBy('created_at', 'desc')->get();
              $path = Request::path();
              @endphp
              <nav id="nav-menu-container">
                     <ul class="nav-menu">
                            <li class="{{request()->is('/') ? 'menu-active' : ''}}">
                                   <a href={{URL::to('/')}}>Home</a>
                            </li>

                            <li><a href="#about">About</a></li>

                            <li class="{{request()->is('news') ? 'menu-active' : ''}}">
                                   <a href={{URL::to('/news')}}>News <span class="icon-button-badge">{{count($newsDetails)}}</span></a>
                            </li>

                            <li class="{{request()->is('events') ? 'menu-active' : ''}}">
                                   <a href={{URL::to('/events')}}>Events <span class="icon-button-badge">2</span></a></li>
                            </li>

                            <li class="{{request()->is('album') ? 'menu-active' : ''
                                   || request()->is('gallery/*') ? 'menu-active' : ''}}
                            "><a href={{URL::to('/album')}}>Gallary</a></li>

                            <li class="{{request()->is('public/committee/*') ? 'menu-active' : ''}}">
                                   <a href={{URL::to('/public/committee/view')}}>Committee</a>
                            </li>

                            @if(Session::has('userName'))
                            <li class="buy-tickets"><a onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();" href="{{ route('logout') }}">logout</a></li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                   @csrf
                            </form>
                            @else
                            <li class="buy-tickets"><a href="{{URL::to('user/login')}}">Login</a></li>
                            @endif
                     </ul>
              </nav>
       </div>
</header>