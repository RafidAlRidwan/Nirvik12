@if(!empty($users) && $users->count() > 0)
<div class="row influencer-list wow fadeInUp">
  @foreach ($users as $item)
  <!-- card one -->
  <div class="col-lg-4 col-6 col-12">
    <div class="influencer_card">
      @if($item->userDetails && !empty($item->userDetails->attachment))
      <div class="cover_image">
        <img src="{{asset('assets/user/landingPage/img/profilePicture')}}{{ '/'.($item->userDetails->attachment) }}" alt="cover">
      </div>
      <div class="profile_image">
        <img src="{{asset('assets/user/landingPage/img/profilePicture')}}{{ '/'.($item->userDetails->attachment) }}" alt="profile">
      </div>
      @else
      <div class="cover_image">
        <img src="{{asset('assets/user/landingPage/img/profilePicture/demo.jpg')}}" alt="cover">
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
<nav style="display: grid; justify-content:center" class="wow fadeInUp">
  <ul class="pagination" style="display: flex;">
    <li class="page-item {{ ($users->currentPage() == 1) ? ' disabled' : '' }}">
      <a class="page-link" data-page="{{$users->currentPage()-1}}">Previous</a>
    </li>
    @for ($i = 1; $i <= $users->lastPage(); $i++)
      <li class="page-item {{ ($users->currentPage() == $i) ? ' active' : '' }}">
        <a class="page-link" data-page="{{$i}}">{{ $i }}</a>
      </li>
      @endfor
      <li class=" page-item {{ ($users->currentPage() == $users->lastPage()) ? ' disabled' : '' }}">
        <a class="page-link" data-page="{{$users->currentPage()+1}}">Next</a>
      </li>
  </ul>
</nav>
@endif
</div>
@else
<section class="nothing wow fadeInUp" style="text-align:center">
  <article>
    <h3>Found<span>Nothing</span></h3>
  </article>
</section>
@endif