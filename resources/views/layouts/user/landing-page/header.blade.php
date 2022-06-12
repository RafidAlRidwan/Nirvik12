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
                            <li class="<?php if ($path == "/") {
                                                 echo "menu-active";
                                                 } else {
                                                 echo "";
                                                 } ?>"><a href={{URL::to('/')}}>Home</a></li>
                            <li><a href="#about">About</a></li>
                            <li class="<?php if ($path == 'news') {
                                                 echo "menu-active";
                                                 } else {
                                                 echo "";
                                                 } ?>"><a href={{URL::to('/news')}}>News <span class="icon-button-badge">{{count($newsDetails)}}</span></a></li>
                            <li class="<?php if ($path == 'events') {
                                                 echo "menu-active";
                                                 } else {
                                                 echo "";
                                                 } ?>"><a href={{URL::to('/events')}}>Events <span class="icon-button-badge">2</span></a></li>
                            <li class="<?php if ($path == 'album') {
                                                 echo "menu-active";
                                                 } else {
                                                 echo "";
                                                 } ?>"><a href={{URL::to('/album')}}>Gallary</a></li>
                            <li class="<?php if ($path == 'committee') {
                                                 echo "menu-active";
                                                 } else {
                                                 echo "";
                                                 } ?>"><a href={{URL::to('/committee')}}>Committee</a></li>
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