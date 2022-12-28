@foreach ($comments as $item)
<div class="media mt-5">
    <img src="{{asset($item->userDetails->attachment ?? '/assets/blog/imgs/ava.png')}}" class="mr-3 thumb-sm rounded-circle" alt="...">
    <div class="media-body">
        <h6 class="mt-0">{{$item->userDetails->full_name}}</h6>
        <p class="mb-3">{{$item->comment}}</p>
        <textarea cols="20" id="reply_body{{$item->id}}" rows="2" class="form-control mb-2 d-none " placeholder="Enter Your Reply Here"></textarea>
        <a href="#" id="btn_reply{{$item->id}}" class="text-dark small font-weight-bold btn_reply" data-id="{{$item->id}}"><i class="ti-back-right"></i> <button class="btn btn-outline-dark btn-sm"><i class="fa fa-reply" aria-hidden="true"></i> Reply</button></a>
        <a href="#" id="reply_submit{{$item->id}}" class="text-dark small font-weight-bold btn_reply_submit d-none" data-id="{{$item->id}}"><i class="ti-back-right"></i> <button class="btn btn-outline-dark btn-sm"><i class="fa fa-paper-plane" aria-hidden="true"></i></button></a>
        <a href="#" id="reply_close{{$item->id}}" class="text-dark small font-weight-bold d-none btn_reply_close" data-id="{{$item->id}}"><i class="ti-back-right"></i> <button class="btn btn-outline-dark btn-sm"><i class="fa fa-window-close" aria-hidden="true"></i></button></a>
        @foreach ($item->children as $child)
        <div class="media mt-3 mb-0">
            <a class="mr-3" href="#">
                <img src="{{asset($child->userDetails->attachment ?? '/assets/blog/imgs/ava.png')}}" class="thumb-sm rounded-circle" alt="...">
            </a>
            <div class="media-body align-items-center">
                <h6 class="mt-0">{{$child->userDetails->full_name}}</h6>
                <p class="mb-3">{{$child->comment}}</p>
                <!-- <a href="#" class="text-dark small font-weight-bold"><i class="ti-back-right"></i> Replay</a> -->
            </div>
        </div>
        @endforeach
    </div>
</div>
@endforeach