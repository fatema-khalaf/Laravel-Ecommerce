@foreach ($products as $item)
<div class="category-product-inner wow fadeInUp">
    <div class="products">
        <div class="product-list product">
            <div class="row product-list-row">
                <div class="col col-sm-4 col-lg-4">
                    <div class="product-image">
                        <div class="image"> <img src="{{asset($item->product_thambnail)}}" alt="">
                        </div>
                    </div>
                    <!-- /.product-image -->
                </div>
                <!-- /.col -->
                <div class="col col-sm-8 col-lg-8">
                    <div class="product-info">
                        <h3 class="name"><a href="{{ url('product/details/'.$item->id.'/'.$item->product_slug_en ) }}">
                                @if(session('language') == 'arabic')
                                {{$item->product_name_ar}}
                                @else
                                {{$item->product_name_en}}
                                @endif
                            </a>
                        </h3>
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
                        </div><!-- /.rating-reviews -->
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
                        <div class="description m-t-10">
                            @if(session('language') == 'arabic')
                            {{$item->short_descp_ar}}
                            @else
                            {{$item->short_descp_en}}
                            @endif
                        </div>
                        <div class="cart clearfix animate-effect">
                            <div class="action">
                                <ul class="list-unstyled">
                                    <li class="add-cart-button btn-group">
                                        <button class="btn btn-primary icon" data-toggle="dropdown" type="button">
                                            <i class="fa fa-shopping-cart"></i>
                                        </button>
                                        <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                                    </li>
                                    <li class="lnk wishlist"> <a class="add-to-cart" href="detail.html"
                                            title="Wishlist"> <i class="icon fa fa-heart"></i> </a>
                                    </li>
                                    <li class="lnk"> <a class="add-to-cart" href="detail.html" title="Compare"> <i
                                                class="fa fa-signal"></i> </a> </li>
                                </ul>
                            </div>
                            <!-- /.action -->
                        </div>
                        <!-- /.cart -->

                    </div>
                    <!-- /.product-info -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.product-list-row -->
            <div class="tag new"><span>new</span></div>
        </div>
        <!-- /.product-list -->
    </div>
    <!-- /.products -->
</div>
@endforeach
<!-- /.category-product-inner -->