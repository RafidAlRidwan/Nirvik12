@if(!empty($users) && $users->count() > 0)
<div class="row influencer-list wow fadeInUp">
  @foreach ($users as $item)
  @php
  $rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
  $color = '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];
  @endphp
  <!-- card one -->
  <div class="col-lg-4 col-6 col-12" style="border-color: 1px solid black;">
    <div class="influencer_card">
      @if($item->userDetails && !empty($item->userDetails->attachment))
      <div class="cover_image">
        <!-- <img src="{{asset('assets/user/landingPage/img/profilePicture/'.$item->userDetails->attachment)}}" alt="cover"> -->
        <p class="img" style="background-color: <?php echo $color ?>;"></p>
      </div>
      <div class="profile_image">
        <img src="{{asset('assets/user/landingPage/img/profilePicture/'.$item->userDetails->attachment)}}" alt="profile">
      </div>
      @else
      <div class="cover_image">
        <!-- <img src="{{asset('assets/user/landingPage/img/profilePicture/demo.jpg')}}" alt="cover"> -->
        <p class="img" style="background-color: <?php echo $color ?>;"></p>
      </div>
      <div class="profile_image">
        <img src="{{asset('assets/user/landingPage/img/profilePicture/demo.jpg')}}" alt="profile">
      </div>
      @endif

      <div class="influencer_name">
        <h2>{{$item->userDetails ? $item->userDetails->full_name : 'No Name'}}</h2>
        <p>{{$item->userDetails ? ($item->userDetails->shiftData ? $item->userDetails->shiftData->name : 'No Shift') : 'No Shift'}}</p>
      </div>
      <div class="socila_links">
        <a href="{{route('myProfile',$item->id)}}"><button class="btn btn-sm" id="btnReset">View</button></a>
      </div>
    </div>
  </div>
  @endforeach
</div>
@if ($users->lastPage() > 1)
<nav style="display: grid; justify-content:center">
  <ul class="pagination" style="display: flex;">
    <li class="page-item {{ ($users->currentPage() == 1) ? ' disabled' : '' }}">
      <a class="page-link" data-page="{{$users->currentPage()-1}}"><</a>
    </li>
    @for ($i = 1; $i <= $users->lastPage(); $i++)
      <li class="page-item {{ ($users->currentPage() == $i) ? ' active' : '' }}">
        @if($users->currentPage() !== 1 && $users->currentPage() !== 2 && $i == 1)
        <a class="page-link" data-page="{{$i}}">{{ $i }}</a>
        @endif
        @if($users->currentPage() + 1 == $i)
        <a class="page-link" data-page="{{$i}}">{{ $i }}</a>
        @endif
        @if($users->currentPage() == $i)
        <a class="page-link" data-page="{{$i}}">{{ $i }}</a>
        @endif
        @if($users->currentPage() -1 == $i)
        <a class="page-link" data-page="{{$i}}">{{ $i }}</a>
        @endif
        @if($users->currentPage() !== $users->lastPage() && $users->currentPage() !== $users->lastPage() - 1 && $i == $users->lastPage())
        <a class="page-link" data-page="{{$i}}">{{ $i }}</a>
        @endif
      </li>
      @endfor
      <li class=" page-item {{ ($users->currentPage() == $users->lastPage()) ? ' disabled' : '' }}">
        <a class="page-link" data-page="{{$users->currentPage()+1}}">></a>
      </li>
  </ul>
</nav>
@endif





<div style="display: grid; justify-content:center">Showing {{($users->currentpage()-1)*$users->perpage()+1}} to {{$users->currentpage()*$users->perpage()}}
  of {{$users->total()}} entries
</div>

</div>

@else
<section class="nothing wow fadeInUp" style="text-align:center">
  <article>
    <h3>Found<span>Nothing</span></h3>
  </article>
</section>
@endif