@if(!empty($blogs) && $blogs->count() > 0)
<div class="container p-5">

    <hr>
    <div class="row d-flex justify-content-center">
        @foreach ($blogs as $item)
        @php
        $date = date('d F, Y', strtotime($item->created_at));
        @endphp
        <div class="col-xl-4 col-md-4 col-lg-4 col-sm-12 col-xs-12 mb-3">
            <div class="card" id="list1" onmouseenter="showButton('list1')" onmouseleave="hideButton('list1')">
                <div class="image"><img src="{{asset($item->attachment)}}" alt="" class="card__img"></div>
                <div class="card__body text-center">
                    <a class="readCount" href="{{route('blog.show', $item->id)}}" data-id="{{$item->id}}">
                        <h3 class="card__title"><i class="fa fa-map-marker-alt"></i> {{$item->title}}</h3>
                    </a>
                    <div class="card__desc">
                        <span class="card__desc__room">{{$item->likeCount()}} Likes - </span>
                        <span class="card__desc__bed">{{$item->comment ? $item->comment->count() : 0}} Comments - </span>
                        <span class="card__desc__price">Posted on: {{$date}}</span>
                    </div>
                </div>
                <div class="card__buttons">

                    @php
                    $allLikes = $item->likes;
                    $like = $allLikes->where('user_id', $userId);
                    if($like->count() > 0){
                    $status = true;
                    }else{
                    $status = false;
                    }
                    @endphp

                    @if($status)
                    <button style="width: 50%;" id="like{{$item->id}}" class="card__buttons--gray btn liked default{{$item->id}}" data-id="{{$item->id}}"><i style="color:#ff4d6d" class="fa fa-thumbs-up" aria-hidden="true"></i> Liked</button>
                    @else
                    <button style="width: 50%;" id="unlike{{$item->id}}" class="card__buttons--gray btn liked default{{$item->id}}" data-id="{{$item->id}}"><i class="fa fa-thumbs-up" aria-hidden="true"></i> Like</button>
                    @endif
                    <button style="color:#ff4d6d; display:none; width: 50%;" id="like{{$item->id}}" class="card__buttons--gray btn liked" data-id="{{$item->id}}"><i style="color:#ff4d6d" class="fa fa-thumbs-up" aria-hidden="true"></i> Liked</button>
                    <button style="display:none; width: 50%;" id="unlike{{$item->id}}" class="card__buttons--gray btn liked" data-id="{{$item->id}}"><i class="fa fa-thumbs-up" aria-hidden="true"></i> Like</button>
                    <button class="card__buttons--primary btn readCount" data-id="{{$item->id}}"><a style="color:white" href="{{route('blog.show', $item->id)}}">READ MORE</a></button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @php
    $blog = App\Models\Blog::all();
    $totalBlog = $blog->count();
    $currentBlog = $blogs->count();
    @endphp
    @if(!($totalBlog == $currentBlog))
    <div class="d-flex justify-content-center">
        <button id="view-blogs" data-id={{$pageNo + 1}} style="background-color: #ff4d6d; border: 1px solid #ff4d6d;" class="btn btn-primary my-4 btn-sm">Load More</button>
    </div>
    @endif
    @else
    <div class="all-blogs_cards lazy" data-aos="fade-up" data-aos-duration="800">
        <h3>Nothing More</h3>
    </div>
    @endif
</div>