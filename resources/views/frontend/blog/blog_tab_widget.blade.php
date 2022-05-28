@php
$popular = App\Models\Blog\BlogComment::select('post_id')
->groupBy('post_id')
->orderByRaw('COUNT(*) DESC')
->limit(3)
->with('post', 'user')
->get();
$recents = App\Models\Blog\BlogPost::orderBy('id','DESC')->limit(2)->get();
@endphp
<div class="sidebar-widget outer-bottom-xs wow fadeInUp">
    <h3 class="section-title">tab widget</h3>
    <ul class="nav nav-tabs">
        <li class="active"><a href="#popular" data-toggle="tab">popular post</a></li>
        <li><a href="#recent" data-toggle="tab">recent post</a></li>
    </ul>
    <div class="tab-content" style="padding-left:0">
        <div class="tab-pane active m-t-20" id="popular">
            @foreach ($popular as $item)
            @php
            $count = App\Models\Blog\BlogComment::where('post_id' ,$item->post->id)->count();
            @endphp
            <div class="blog-post inner-bottom-30 ">
                <img class="img-responsive" src="{{asset($item->post->post_image)}}" alt="">
                <h4><a href="blog-details.html">{{$item->post->post_title_en}}</a></h4>
                <span class="review">{{$count}} Comments</span>
                <span class="date-time">
                    {{ Carbon\Carbon::parse($item->post->created_at)->format('d F Y') }}
                </span>
                <p>{!! Str::limit($item->post->post_details_en,60) !!}</p>

            </div>
            @endforeach
        </div>

        <div class="tab-pane m-t-20" id="recent">
            @foreach ($recents as $item)
            @php
            $count = App\Models\Blog\BlogComment::where('post_id' ,$item->id)->count();
            @endphp
            <div class="blog-post inner-bottom-30 ">
                <img class="img-responsive" src="{{asset($item->post_image)}}" alt="">
                <h4><a href="blog-details.html">{{$item->post_title_en}}</a></h4>
                <span class="review">{{$count}} Comments</span>
                <span class="date-time">
                    {{ Carbon\Carbon::parse($item->created_at)->format('d F Y') }}
                </span>
                <p>{!! Str::limit($item->post_details_en,60) !!}</p>

            </div>
            @endforeach
        </div>
    </div>
</div>