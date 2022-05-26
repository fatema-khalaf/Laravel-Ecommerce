@foreach ($products as $item)
<div class="col-sm-6 col-md-4 wow fadeInUp" style="    height: 422px;">
    <div class="products">
        <div class="product">
            <div class="product-image">
                <div class="image"> <a href="{{ url('product/details/'.$item->id.'/'.$item->product_slug_en ) }}"><img
                            src="{{asset($item->product_thambnail)}}" alt=""></a>
                </div>
                <!-- /.image -->

                @php
                $amount = $item->selling_price - $item->discount_price;
                $discount = ($amount/ $item->selling_price)*100;
                @endphp
                @if ($item->discount_price == NULL)
                <div class="tag new"><span>new</span></div>
                @else
                <div class="tag sale"><span>{{round($discount)}}%</span></div>

                @endif
            </div>
            <!-- /.product-image -->

            <div class="product-info text-left">
                <h3 class="name"><a href="{{ url('product/details/'.$item->id.'/'.$item->product_slug_en ) }}">
                        @if(session('language') == 'arabic')
                        {{$item->product_name_ar}}
                        @else
                        {{$item->product_name_en}}
                        @endif

                    </a>
                </h3>
                <div class="rating rateit-small"></div>
                <div class="description"></div>
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
            <!-- /.product-info -->
            <div class="cart clearfix animate-effect">
                <div class="action">
                    <ul class="list-unstyled">
                        <li class="add-cart-button btn-group">
                            <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i
                                    class="fa fa-shopping-cart"></i> </button>
                            <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                        </li>
                        <li class="lnk wishlist"> <a class="add-to-cart" href="detail.html" title="Wishlist"> <i
                                    class="icon fa fa-heart"></i> </a> </li>
                        <li class="lnk"> <a class="add-to-cart" href="detail.html" title="Compare"> <i
                                    class="fa fa-signal"></i> </a>
                        </li>
                    </ul>
                </div>
                <!-- /.action -->
            </div>
            <!-- /.cart -->
        </div>
        <!-- /.product -->

    </div>
    <!-- /.products -->
</div>
@endforeach

<!-- /.item -->