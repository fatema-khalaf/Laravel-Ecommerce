@foreach($comments as $item)
<div class="col-md-2 col-sm-2">
    <img src="{{ (!empty($item->user->profile_photo_path))? url('upload/user_images/'.$item->user->profile_photo_path):url('upload/no_image.jpg') }}"
        alt="Responsive image" class="img-rounded img-responsive">
</div>
<div class="col-md-10 col-sm-10">
    <div class="blog-comment inner-bottom-xs">
        <h4>{{$item->user->name }}</h4>
        <span class="review-action pull-right">
            {{Carbon\Carbon::parse($item->created_at)->diffForHumans()}}
        </span>
        <p>{{$item->comment}}</p>
    </div>
</div>
@endforeach