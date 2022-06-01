<div class="clearfix filters-container m-t-10">
    <h4> {{ $priceProds->count() }} </span>products </h4>
    <hr>
    <div class="row">
        <div class="col col-sm-6 col-md-2">
            <div class="filter-tabs">
                <ul id="filter-tabs" class="nav nav-tabs nav-tab-box nav-tab-fa-icon">
                    <li class="active"> <a data-toggle="tab" href="#grid-container"><i
                                class="icon fa fa-th-large"></i>Grid</a> </li>
                    <li><a data-toggle="tab" href="#list-container"><i class="icon fa fa-th-list"></i>List</a></li>
                </ul>
            </div>
            <!-- /.filter-tabs -->
        </div>
        <!-- /.col -->
        <div class="col col-sm-12 col-md-6">
            @include('frontend.shop.topfilter')
        </div>
        <!-- /.col -->
        {{-- new idea custom pagination video 644--}}
        {{ $products->links('vendor.pagination.custom') }}
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>
<div class="search-result-container ">
    <div id="myTabContent" class="tab-content category-list">

        <!-- ============================================= GRID STYLE: SATART ============================================== -->

        <div class="tab-pane active " id="grid-container">
            <div class="category-product">
                <div class="row" id="grid_view_product">
                    @foreach ($products as $item)
                    <div class="col-sm-6 col-md-4 wow fadeInUp" style="    height: 422px;">
                        <div class="products">
                            <div class="product">
                                <div class="product-image">
                                    <div class="image"> <a
                                            href="{{ url('product/details/'.$item->id.'/'.$item->product_slug_en ) }}"><img
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
                                    <h3 class="name"><a
                                            href="{{ url('product/details/'.$item->id.'/'.$item->product_slug_en ) }}">
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

                                </div>
                                <!-- /.product-info -->
                                <div class="cart clearfix animate-effect">
                                    <div class="action">
                                        <ul class="list-unstyled">
                                            <li class="add-cart-button btn-group">
                                                {{-- new idea --}}
                                                <button class="btn btn-primary icon" type="button" title="Add Cart"
                                                    data-toggle="modal" data-target="#exampleModal" id="{{$item->id}}"
                                                    onclick="productView(this.id)">
                                                    <i class="fa fa-shopping-cart"></i> </button>
                                                <button class="btn btn-primary cart-btn" type="button">Add to
                                                    cart</button>
                                            </li>
                                            <li class="add-cart-button btn-group">
                                                <button class="btn btn-primary" style="background: #0f6cb2;"
                                                    type="button" title="Wishlist" id='{{$item->id}}'
                                                    onclick="AddToWishlist(this.id)">
                                                    <i class="fa fa-heart"></i>
                                                </button>
                                            </li>
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
                </div>
                <!-- /.row -->
            </div>
            <!-- /.category-product -->

        </div>
        <!-- /.tab-pane -->
        <!-- ============================================= GRID STYLE: END ============================================== -->


        <!-- ============================================= LIST STYLE: START ============================================== -->
        <div class="tab-pane " id="list-container">
            <div class="category-product" id="list_view_product">
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
                                        <h3 class="name"><a
                                                href="{{ url('product/details/'.$item->id.'/'.$item->product_slug_en ) }}">
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
                                                        <button class="btn btn-primary icon" type="button"
                                                            title="Add Cart" data-toggle="modal"
                                                            data-target="#exampleModal" id="{{$item->id}}"
                                                            onclick="productView(this.id)">
                                                            <i class="fa fa-shopping-cart"></i> </button>
                                                        <button class="btn btn-primary cart-btn" data-toggle="modal"
                                                            data-target="#exampleModal" id="{{$item->id}}"
                                                            onclick="productView(this.id)" type="button">Add to
                                                            cart</button>
                                                    </li>
                                                    <li class="add-cart-button btn-group">
                                                        <button class="btn btn-primary" style="background: #0f6cb2;"
                                                            type="button" title="Wishlist" id='{{$item->id}}'
                                                            onclick="AddToWishlist(this.id)">
                                                            <i class="fa fa-heart"></i>
                                                        </button>
                                                    </li>

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
            </div>

        </div>

        <!-- /.tab-pane #list-container -->
    </div>

    <!-- /.tab-content -->
    {{-- new idea custom pagination video 644--}}
    {{-- new idea appends ($_GET) to make the url hold the filtered categories video 468
    --}}
    {{ $products->links('vendor.pagination.custom') }}

</div>