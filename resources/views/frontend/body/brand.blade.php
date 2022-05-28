@php
$brands = App\Models\Brand::orderBy('id', 'DESC')->limit(6)->get();
@endphp

<div id="brands-carousel" class="logo-slider wow fadeInUp">
    <div class="logo-slider-inner">
        <div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">
            @foreach ($brands as $item)

            <div class="item m-t-15"> <a href="#" class="image">
                    <img style=" width: 120px; height: 120px;" data-echo="{{asset($item->brand_image)}}"
                        src="{{asset('frontend/assets/images/blank.gif')}}" alt="{{asset($item->brand_name_en)}}">
                </a> </div>
            @endforeach
        </div>
        <!-- /.owl-carousel #logo-slider -->
    </div>
    <!-- /.logo-slider-inner -->

</div>