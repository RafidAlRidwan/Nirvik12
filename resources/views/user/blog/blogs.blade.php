@if(!empty($blogs) && $blogs->count() > 0)
<div class="container wow fadeInUp p-5">

    <div class="page-container">
        <div class="page-content">
            <hr>
            <div class="row d-flex justify-content-center">
                @foreach ($blogs as $item)
                @php
                $date = date('d F Y', strtotime($item->created_at));
                @endphp
                <div class="col-lg-6" style="padding-left:40px; padding-right:40px;">
                    <div class="card text-center mb-5">
                        <div class="card-header p-0">
                            <div class="blog-media">
                                <img src="{{asset($item->attachment)}}" alt="" height="250" width="250">
                            </div>
                        </div>
                        <div class="card-body px-0">
                            <h5 class="card-title mb-2">{{$item->title}}</h5>
                            <small class="small text-muted">{{$date}}
                                <span class="px-2">-</span>
                                <a href="#" class="text-muted">{{$item->comment ? $item->comment->count() : 0}} Comments</a>
                            </small>
                            <!-- <p class="my-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos saepe
                                dolores et nostrum porro odit reprehenderit animi, est ratione fugit aspernatur
                                ipsum. Nostrum placeat hic saepe voluptatum dicta ipsum beatae.</p> -->
                        </div>

                        <div class="card-footer pb-2 text-center">
                            <!-- <a href="{{route('blog.show', $item->id)}}" class="btn btn-outline-dark btn-sm"><i class="fa fa-thumbs-up" aria-hidden="true"></i> 10</a> -->
                            <a href="{{route('blog.show', $item->id)}}" class="btn btn-outline-dark btn-sm readCount" data-id="{{$item->id}}">READ MORE</a>
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
    </div>
</div>