<div class="best-deal wow fadeInUp outer-bottom-xs">
    <h3 class="section-title">Best seller</h3>
    <div class="sidebar-widget-body outer-top-xs">
        <div class="owl-carousel best-seller custom-carousel owl-theme outer-top-xs">
            @php
            $best_seller_1= App\Models\OrderItem::select('product_id')
            ->groupBy('product_id')
            ->orderByRaw('COUNT(*) DESC')
            ->limit(2)
            ->get();

            $best_seller_2= App\Models\OrderItem::skip(2)->select('product_id')
            ->groupBy('product_id')
            ->orderByRaw('COUNT(*) DESC')
            ->limit(2)
            ->get();
            $best_seller_3= App\Models\OrderItem::skip(4)->select('product_id')
            ->groupBy('product_id')
            ->orderByRaw('COUNT(*) DESC')
            ->limit(2)
            ->get();
            $best_seller_4= App\Models\OrderItem::skip(6)->select('product_id')
            ->groupBy('product_id')
            ->orderByRaw('COUNT(*) DESC')
            ->limit(2)
            ->get();
            @endphp
            <div class="item">
                <div class="products best-product">
                    @if ($best_seller_1)
                    @foreach ($best_seller_1 as $element)
                    @php
                    $item = App\Models\Product::where('status',1)->where('id',
                    $element->product_id)->first();
                    @endphp
                    <div class="product">
                        <div class="product-micro">
                            <div class="row product-micro-row">
                                <div class="col col-xs-5">
                                    <div class="product-image">
                                        <div class="image"> <a
                                                href="{{ url('product/details/'.$item->id.'/'.$item->product_slug_en ) }}"><img
                                                    src="{{asset($item->product_thambnail)}}" alt=""></a> </div>
                                        <!-- /.image -->
                                        @php
                                        $amount = $item->selling_price - $item->discount_price;
                                        $discount = ($amount/ $item->selling_price)*100;
                                        @endphp

                                    </div>
                                    <!-- /.product-image -->
                                </div>
                                <!-- /.col -->
                                <div class="col2 col-xs-7">
                                    <div class="product-info">
                                        <h3 class="name"><a
                                                href="{{ url('product/details/'.$item->id.'/'.$item->product_slug_en ) }}">
                                                @if(session('language') == 'arabic')
                                                {{$item->product_name_ar}}
                                                @else
                                                {{$item->product_name_en}}
                                                @endif
                                            </a>
                                        </h3>
                                        <div class="rating rateit-small"></div>
                                        @if ($item->discount_price == Null)
                                        <div class="product-price"> <span class="price">
                                                ${{$item->selling_price}}</span>
                                        </div>
                                        @else
                                        <div class="product-price"> <span class="price">
                                                ${{$item->discount_price}}</span>
                                            <span class="price-before-discount">${{$item->selling_price}}</span>
                                        </div>
                                        @endif
                                        <!-- /.product-price -->
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.product-micro-row -->
                        </div>
                        <!-- /.product-micro -->
                    </div>
                    @endforeach
                    @endif

                </div>
            </div>
            <div class="item">
                <div class="products best-product">
                    @if ($best_seller_2)
                    @foreach ($best_seller_2 as $element)
                    @php
                    $item = App\Models\Product::where('status',1)->where('id',
                    $element->product_id)->first();
                    @endphp
                    <div class="product">
                        <div class="product-micro">
                            <div class="row product-micro-row">
                                <div class="col col-xs-5">
                                    <div class="product-image">
                                        <div class="image"> <a
                                                href="{{ url('product/details/'.$item->id.'/'.$item->product_slug_en ) }}"><img
                                                    src="{{asset($item->product_thambnail)}}" alt=""></a> </div>
                                        <!-- /.image -->
                                        @php
                                        $amount = $item->selling_price - $item->discount_price;
                                        $discount = ($amount/ $item->selling_price)*100;
                                        @endphp

                                    </div>
                                    <!-- /.product-image -->
                                </div>
                                <!-- /.col -->
                                <div class="col2 col-xs-7">
                                    <div class="product-info">
                                        <h3 class="name"><a
                                                href="{{ url('product/details/'.$item->id.'/'.$item->product_slug_en ) }}">
                                                @if(session('language') == 'arabic')
                                                {{$item->product_name_ar}}
                                                @else
                                                {{$item->product_name_en}}
                                                @endif
                                            </a>
                                        </h3>
                                        <div class="rating rateit-small"></div>
                                        @if ($item->discount_price == Null)
                                        <div class="product-price"> <span class="price">
                                                ${{$item->selling_price}}</span>
                                        </div>
                                        @else
                                        <div class="product-price"> <span class="price">
                                                ${{$item->discount_price}}</span>
                                            <span class="price-before-discount">${{$item->selling_price}}</span>
                                        </div>
                                        @endif
                                        <!-- /.product-price -->
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.product-micro-row -->
                        </div>
                        <!-- /.product-micro -->
                    </div>
                    @endforeach
                    @endif

                </div>
            </div>
            <div class="item">
                <div class="products best-product">
                    @if ($best_seller_3)
                    @foreach ($best_seller_3 as $element)
                    @php
                    $item = App\Models\Product::where('status',1)->where('id',
                    $element->product_id)->first();
                    @endphp
                    <div class="product">
                        <div class="product-micro">
                            <div class="row product-micro-row">
                                <div class="col col-xs-5">
                                    <div class="product-image">
                                        <div class="image"> <a
                                                href="{{ url('product/details/'.$item->id.'/'.$item->product_slug_en ) }}"><img
                                                    src="{{asset($item->product_thambnail)}}" alt=""></a> </div>
                                        <!-- /.image -->
                                        @php
                                        $amount = $item->selling_price - $item->discount_price;
                                        $discount = ($amount/ $item->selling_price)*100;
                                        @endphp

                                    </div>
                                    <!-- /.product-image -->
                                </div>
                                <!-- /.col -->
                                <div class="col2 col-xs-7">
                                    <div class="product-info">
                                        <h3 class="name"><a
                                                href="{{ url('product/details/'.$item->id.'/'.$item->product_slug_en ) }}">
                                                @if(session('language') == 'arabic')
                                                {{$item->product_name_ar}}
                                                @else
                                                {{$item->product_name_en}}
                                                @endif
                                            </a>
                                        </h3>
                                        <div class="rating rateit-small"></div>
                                        @if ($item->discount_price == Null)
                                        <div class="product-price"> <span class="price">
                                                ${{$item->selling_price}}</span>
                                        </div>
                                        @else
                                        <div class="product-price"> <span class="price">
                                                ${{$item->discount_price}}</span>
                                            <span class="price-before-discount">${{$item->selling_price}}</span>
                                        </div>
                                        @endif
                                        <!-- /.product-price -->
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.product-micro-row -->
                        </div>
                        <!-- /.product-micro -->
                    </div>
                    @endforeach
                    @endif

                </div>
            </div>
            <div class="item">
                <div class="products best-product">
                    @if ($best_seller_4)
                    @foreach ($best_seller_4 as $element)
                    @php
                    $item = App\Models\Product::where('status',1)->where('id',
                    $element->product_id)->first();
                    @endphp
                    <div class="product">
                        <div class="product-micro">
                            <div class="row product-micro-row">
                                <div class="col col-xs-5">
                                    <div class="product-image">
                                        <div class="image"> <a
                                                href="{{ url('product/details/'.$item->id.'/'.$item->product_slug_en ) }}"><img
                                                    src="{{asset($item->product_thambnail)}}" alt=""></a> </div>
                                        <!-- /.image -->
                                        @php
                                        $amount = $item->selling_price - $item->discount_price;
                                        $discount = ($amount/ $item->selling_price)*100;
                                        @endphp

                                    </div>
                                    <!-- /.product-image -->
                                </div>
                                <!-- /.col -->
                                <div class="col2 col-xs-7">
                                    <div class="product-info">
                                        <h3 class="name"><a
                                                href="{{ url('product/details/'.$item->id.'/'.$item->product_slug_en ) }}">
                                                @if(session('language') == 'arabic')
                                                {{$item->product_name_ar}}
                                                @else
                                                {{$item->product_name_en}}
                                                @endif
                                            </a>
                                        </h3>
                                        <div class="rating rateit-small"></div>
                                        @if ($item->discount_price == Null)
                                        <div class="product-price"> <span class="price">
                                                ${{$item->selling_price}}</span>
                                        </div>
                                        @else
                                        <div class="product-price"> <span class="price">
                                                ${{$item->discount_price}}</span>
                                            <span class="price-before-discount">${{$item->selling_price}}</span>
                                        </div>
                                        @endif
                                        <!-- /.product-price -->
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.product-micro-row -->
                        </div>
                        <!-- /.product-micro -->
                    </div>
                    @endforeach
                    @endif

                </div>
            </div>

        </div>
    </div>
    <!-- /.sidebar-widget-body -->
</div>