@php
$tags_en = App\Models\Product::groupBy('product_tags_en')->select('product_tags_en')->get();
$tags_ar = App\Models\Product::groupBy('product_tags_ar')->select('product_tags_ar')->get();
$data_en = [];
foreach ($tags_en as $item){
$tags = explode(',',$item->product_tags_en);
$data_en =array_merge($data_en, $tags);
}
$data_en =array_unique($data_en);

$data_ar = [];
foreach ($tags_ar as $item){
$tags = explode(',',$item->product_tags_ar);
$data_ar =array_merge($data_ar, $tags);
}
$data_ar =array_unique($data_ar);


@endphp

<div class="sidebar-widget product-tag wow fadeInUp">
    <h3 class="section-title">Product tags</h3>
    <div class="sidebar-widget-body outer-top-xs">
        <div class="tag-list">
            @if (session('language') == 'arabic')
            @foreach ($data_ar as $tag)
            <a class="item active " title="{{$tag}}" href="{{url ('product/tag/'.$tag)}}">
                {{$tag}}</a>
            @endforeach
            @else
            @foreach ($data_en as $tag)
            <a class="item active " title="{{ $tag}}" href="{{url ('product/tag/'.$tag)}}">
                {{$tag}}</a>
            @endforeach
            @endif

        </div>
        <!-- /.tag-list -->
    </div>
    <!-- /.sidebar-widget-body -->
</div>
@php
@endphp