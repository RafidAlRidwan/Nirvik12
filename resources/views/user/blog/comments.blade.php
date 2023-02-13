@foreach ($comments as $item)
<div class="media mt-5">
    <img src="{{asset($item->userDetails->attachment ?? '/assets/blog/imgs/ava.png')}}" class="mr-3 thumb-sm rounded-circle" alt="...">
    <div class="media-body">
        <h6 class="mt-0">{{$item->userDetails ? $item->userDetails->full_name : 'Guest'}}</h6>
        <p class="mb-3" id="comment{{$item->id}}">{{$item->comment}}</p>
        <textarea cols="20" id="reply_body{{$item->id}}" rows="2" class="form-control mb-2 d-none " placeholder="Enter Your Reply Here"></textarea>
        @if(auth()->user() && auth()->user()->id == $userId)
        <a data-toggle="modal" data-target="#commentEditModal" href="#" id="btn_edit{{$item->id}}" class="text-dark small font-weight-bold btn_edit" data-id="{{$item->id}}"><i class="ti-back-right"></i> <button class="btn btn-outline-dark btn-sm"><i class="fa fa-pencil-square" aria-hidden="true"></i></button></a>
        @endif
        <a href="#" id="btn_reply{{$item->id}}" class="text-dark small font-weight-bold btn_reply" data-id="{{$item->id}}"><i class="ti-back-right"></i> <button class="btn btn-outline-dark btn-sm"><i class="fa fa-reply" aria-hidden="true"></i></button></a>
        <a href="#" id="reply_submit{{$item->id}}" class="text-dark small font-weight-bold btn_reply_submit d-none" data-id="{{$item->id}}"><i class="ti-back-right"></i> <button class="btn btn-outline-dark btn-sm"><i class="fa fa-paper-plane" aria-hidden="true"></i></button></a>
        <a href="#" id="reply_close{{$item->id}}" class="text-dark small font-weight-bold d-none btn_reply_close" data-id="{{$item->id}}"><i class="ti-back-right"></i> <button class="btn btn-outline-dark btn-sm"><i class="fa fa-window-close" aria-hidden="true"></i></button></a>
        @foreach ($item->children as $child)
        <div class="media mt-3 mb-0">
            <a class="mr-3" href="#">
                <img src="{{asset($child->userDetails->attachment ?? '/assets/blog/imgs/ava.png')}}" class="thumb-sm rounded-circle" alt="...">
            </a>
            <div class="media-body align-items-center">
                <h6 class="mt-0">{{$child->userDetails ? $child->userDetails->full_name : 'Guest'}}</h6>
                <p class="mb-3" id="comment{{$child->id}}">{{$child->comment}}</p>
                @if(auth()->user() && auth()->user()->id == $userId)
                <a href="#" id="btn_edit{{$child->id}}" class="text-dark small font-weight-bold btn_edit" data-id="{{$child->id}}"><i class="ti-back-right"></i> <button class="btn btn-outline-dark btn-sm"><i class="fa fa-pencil-square" aria-hidden="true"></i></button></a>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</div>
@endforeach