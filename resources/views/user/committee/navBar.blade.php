<ul class="nav-tabs">
 <li class="nav-item">
  <a class="nav-link {{request()->is('user/committee/memberView/*') ? 'active' : ''}}" data-toggle="tooltip" data-placement="top" title="Committee Members" href="{{URL::to('/user/committee/memberView/'.$committeeDetails['id'])}}">Members</a>
 </li>
 <li class="nav-item">
  <a class="nav-link {{request()->is('user/committee/collectionView/*') ? 'active' : ''}}" data-toggle="tooltip" data-placement="top" title="Total Collection History" href="{{URL::to('/user/committee/collectionView/'.$committeeDetails['id'])}}">Collections</a>
 </li>
 @php
 $checkAccess = App\Models\Collection::checkAccess($committeeDetails->id);
 @endphp
 @if($checkAccess)
 <li class="nav-item">
  <a class="nav-link {{request()->is('user/committee/fundTransferView/*') ? 'active' : ''}}" data-toggle="tooltip" data-placement="top" title="Fund Transfer History" href="{{URL::to('/user/committee/fundTransferView/'.$committeeDetails['id'])}}">Fund Transfer</a>
 </li>
 @endif
 <li class="nav-item">
  <a class="nav-link mt-1 {{request()->is('user/committee/expenseView/*') ? 'active' : ''}}" data-toggle="tooltip" data-placement="top" title="Total Expenses History" href="{{URL::to('/user/committee/expenseView/'.$committeeDetails['id'])}}">Expenses</a>
 </li>
</ul>