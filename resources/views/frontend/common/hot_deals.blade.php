@php
$hot_deals =
App\Models\Product::where('hot_deals',1)->where('discount_price','!=',NULL)->orderBy('id','DESC')->limit(3)->get();
@endphp

<div class="sidebar-widget hot-deals wow fadeInUp outer-bottom-xs">
    <h3 class="section-title">
        @if (session('language')== 'arabic')
        عروض مميزة
        @else
        hot deals
        @endif
    </h3>
    <div class="owl-carousel sidebar-carousel custom-carousel owl-theme outer-top-ss">
        @foreach ($hot_deals as $item)
        <div class="item">
            <div class="products">
                <div class="hot-deal-wrapper">
                    <div class="image"> <img src="{{asset($item->product_thambnail)}}" alt=""> </div>
                    @php
                    $amount = $item->selling_price - $item->discount_price;
                    $discount = ($amount/ $item->selling_price)*100;
                    @endphp
                    @if ($item->discount_price == NULL)
                    <div class="tag new"><span>new</span></div>
                    @else
                    <div class="sale-offer-tag"><span>{{round($discount)}}%<br>
                            off</span></div>
                    @endif
                    {{-- <div class="timing-wrapper">
                        <div class="box-wrapper">
                            <div class="date box"> <span class="key">120</span> <span class="value">DAYS</span> </div>
                        </div>
                        <div class="box-wrapper">
                            <div class="hour box"> <span class="key">20</span> <span class="value">HRS</span> </div>
                        </div>
                        <div class="box-wrapper">
                            <div class="minutes box"> <span class="key">36</span> <span class="value">MINS</span> </div>
                        </div>
                        <div class="box-wrapper hidden-md">
                            <div class="seconds box"> <span class="key">60</span> <span class="value">SEC</span> </div>
                        </div>
                    </div> --}}
                </div>
                <!-- /.hot-deal-wrapper -->

                <div class="product-info text-left m-t-20">
                    <h3 class="name"><a href="{{ url('product/details/'.$item->id.'/'.$item->product_slug_en ) }}">
                            @if(session('language') == 'arabic')
                            {{$item->product_name_ar}}
                            @else
                            {{$item->product_name_en}}
                            @endif
                        </a></h3>
                    @php
                    $reviewcount =
                    App\Models\Review::where('product_id',$item->id)->where('status',1)->latest()->get();
                    $avarage =
                    App\Models\Review::where('product_id',$item->id)->where('status',1)->avg('rating');
                    @endphp

                    <div class="rating-reviews m-t-20">
                        <div class="row">
                            <div class="col-sm-12">
                                @if($avarage == 0)
                                <span class="fa fa-star-o"></span>
                                <span class="fa fa-star-o"></span>
                                <span class="fa fa-star-o"></span>
                                <span class="fa fa-star-o"></span>
                                <span class="fa fa-star-o"></span>
                                @else
                                <span class="fa fa-star {{$avarage >= 1 ? 'checked' : ''}} "></span>
                                <span class="fa fa-star {{$avarage >= 2 ? 'checked' : ''}}"></span>
                                <span class="fa fa-star {{$avarage >= 3 ? 'checked' : ''}}"></span>
                                <span class="fa fa-star {{$avarage >= 4 ? 'checked' : ''}}"></span>
                                <span class="fa fa-star {{$avarage >= 5 ? 'checked' : ''}}"></span>
                                @endif
                            </div>
                        </div><!-- /.row -->
                    </div><!-- /.rating-reviews --> @if ($item->discount_price == Null)
                    <div class="product-price"> <span class="price">
                            ${{$item->selling_price}}</span>
                    </div>
                    @else
                    <div class="product-price"> <span class="price"> ${{$item->discount_price}}</span>
                        <span class="price-before-discount">${{$item->selling_price}}</span>
                    </div>
                    @endif
                    <!-- /.product-price -->
                </div>
                <!-- /.product-info -->

                <div class="cart clearfix animate-effect">
                    <div class="action">
                        <div class="add-cart-button btn-group">


                            {{-- new idea --}}
                            <button class="btn btn-primary icon" type="button" title="Add Cart" data-toggle="modal"
                                data-target="#exampleModal" id="{{$item->id}}" onclick="productView(this.id)">
                                <i class="fa fa-shopping-cart"></i> </button>
                            <button class="btn btn-primary cart-btn" data-toggle="modal" data-target="#exampleModal"
                                id="{{$item->id}}" onclick="productView(this.id)" type="button">Add to
                                cart</button>


                            {{-- <button class="btn btn-primary icon" data-toggle="dropdown" type="button">
                                <i class="fa fa-shopping-cart"></i> </button>
                            <button class="btn btn-primary cart-btn" type="button">Add to
                                cart</button> --}}
                        </div>
                    </div>
                    <!-- /.action -->
                </div>
                <!-- /.cart -->
            </div>
        </div>
        @endforeach
    </div>
    <!-- /.sidebar-widget -->
</div>