@extends('frontend.main_master')
@section('content')
@section('title')
Home| Pro-Ecommerce
@endsection

<div class="body-content outer-top-xs" id="top-banner-and-menu">
    <div class="container">
        <div class="row">
            <!-- ============================================== SIDEBAR ============================================== -->
            <div class="col-xs-12 col-sm-12 col-md-3 sidebar">

                <!-- ================================== TOP NAVIGATION ================================== -->
                @include('frontend.common.vertical_menu')
                <!-- /.side-menu -->
                <!-- ================================== TOP NAVIGATION : END ================================== -->

                <!-- ============================================== HOT DEALS ============================================== -->
                @include('frontend.common.hot_deals')
                <!-- ============================================== HOT DEALS: END ============================================== -->

                <!-- ============================================== SPECIAL OFFER ============================================== -->

                <div class="sidebar-widget outer-bottom-small wow fadeInUp">
                    <h3 class="section-title">
                        @if (session('language')== 'arabic')
                        عروض خاصة
                        @else
                        Special Offer
                        @endif
                    </h3>
                    <div class="sidebar-widget-body outer-top-xs">
                        <div class="owl-carousel sidebar-carousel special-offer custom-carousel owl-theme outer-top-xs">
                            <div class="item">
                                <div class="products special-product">
                                    @foreach ($special_offer as $item)
                                    <div class="product">
                                        <div class="product-micro">
                                            <div class="row product-micro-row">
                                                <div class="col col-xs-5" style="float: left">
                                                    <div class="product-image">
                                                        <div class="image"> <a
                                                                href="{{ url('product/details/'.$item->id.'/'.$item->product_slug_en ) }}">
                                                                <img src="{{asset($item->product_thambnail)}}" alt="">
                                                            </a> </div>
                                                        <!-- /.image -->
                                                    </div>
                                                    <!-- /.product-image -->
                                                </div>
                                                <!-- /.col -->
                                                <div class="col col-xs-7">
                                                    <div class="product-info">
                                                        <h3 class="name"><a
                                                                href="{{ url('product/details/'.$item->id.'/'.$item->product_slug_en ) }}">
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
                                                                    <span
                                                                        class="fa fa-star {{$avarage >= 1 ? 'checked' : ''}} "></span>
                                                                    <span
                                                                        class="fa fa-star {{$avarage >= 2 ? 'checked' : ''}}"></span>
                                                                    <span
                                                                        class="fa fa-star {{$avarage >= 3 ? 'checked' : ''}}"></span>
                                                                    <span
                                                                        class="fa fa-star {{$avarage >= 4 ? 'checked' : ''}}"></span>
                                                                    <span
                                                                        class="fa fa-star {{$avarage >= 5 ? 'checked' : ''}}"></span>
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
                                                            <span
                                                                class="price-before-discount">${{$item->selling_price}}</span>
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
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.sidebar-widget-body -->
                </div>
                <!-- /.sidebar-widget -->
                <!-- ============================================== SPECIAL OFFER : END ============================================== -->
                <!-- ============================================== PRODUCT TAGS ============================================== -->
                @include('frontend.common.product_tags')
                <!-- /.sidebar-widget -->
                <!-- ============================================== PRODUCT TAGS : END ============================================== -->
                <!-- ============================================== SPECIAL DEALS ============================================== -->

                <div class="sidebar-widget outer-bottom-small wow fadeInUp">
                    <h3 class="section-title">
                        @if (session('language')== 'arabic')
                        صفقات خاصة
                        @else
                        Special Deals
                        @endif
                    </h3>
                    <div class="sidebar-widget-body outer-top-xs">
                        <div class="owl-carousel sidebar-carousel special-offer custom-carousel owl-theme outer-top-xs">
                            <div class="item">
                                <div class="products special-product">
                                    @foreach ($special_deals as $item)
                                    <div class="product">
                                        <div class="product-micro">
                                            <div class="row product-micro-row">
                                                <div class="col col-xs-5">
                                                    <div class="product-image">
                                                        <div class="image"> <a
                                                                href="{{ url('product/details/'.$item->id.'/'.$item->product_slug_en ) }}">
                                                                <img src="{{asset($item->product_thambnail)}}" alt="">
                                                            </a> </div>
                                                        <!-- /.image -->

                                                    </div>
                                                    <!-- /.product-image -->
                                                </div>
                                                <!-- /.col -->
                                                <div class="col col-xs-7">
                                                    <div class="product-info">
                                                        <h3 class="name"><a
                                                                href="{{ url('product/details/'.$item->id.'/'.$item->product_slug_en ) }}">
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
                                                                    <span
                                                                        class="fa fa-star {{$avarage >= 1 ? 'checked' : ''}} "></span>
                                                                    <span
                                                                        class="fa fa-star {{$avarage >= 2 ? 'checked' : ''}}"></span>
                                                                    <span
                                                                        class="fa fa-star {{$avarage >= 3 ? 'checked' : ''}}"></span>
                                                                    <span
                                                                        class="fa fa-star {{$avarage >= 4 ? 'checked' : ''}}"></span>
                                                                    <span
                                                                        class="fa fa-star {{$avarage >= 5 ? 'checked' : ''}}"></span>
                                                                    @endif
                                                                </div>
                                                            </div><!-- /.row -->
                                                        </div><!-- /.rating-reviews --> @if ($item->discount_price ==
                                                        Null)
                                                        <div class="product-price"> <span class="price">
                                                                ${{$item->selling_price}}</span>
                                                        </div>
                                                        @else
                                                        <div class="product-price"> <span class="price">
                                                                ${{$item->discount_price}}</span>
                                                            <span
                                                                class="price-before-discount">${{$item->selling_price}}</span>
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
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.sidebar-widget-body -->
                </div>
                <!-- /.sidebar-widget -->
                <!-- ============================================== SPECIAL DEALS : END ============================================== -->
                <!-- ============================================== NEWSLETTER ============================================== -->
                @include('frontend.common.newsletter')
                <!-- ============================================== NEWSLETTER: END ============================================== -->

                <!-- ============================================== Testimonials============================================== -->

                {{-- @include('frontend.common.testmonial') --}}


                <!-- ============================================== Testimonials: END ============================================== -->
            </div>
            <!-- /.sidemenu-holder -->
            <!-- ============================================== SIDEBAR : END ============================================== -->

            <!-- ============================================== CONTENT ============================================== -->
            <div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder">
                <!-- ========================================== SECTION – HERO ========================================= -->

                <div id="hero">
                    <div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">
                        @foreach ($sliders as $item)

                        <div class="item" style="background-image: url({{asset($item->slider_img)}});">
                            <div class="container-fluid">
                                <div class="caption bg-color vertical-center text-left">
                                    <div class="big-text fadeInDown-1" style="width:70%;"> {{$item->title}}</span>
                                    </div>
                                    <div class="excerpt fadeInDown-2 hidden-xs"> <span>{{$item->description}}</span>
                                    </div>
                                    <div class="button-holder fadeInDown-3"> <a href="{{route('shop-page')}}"
                                            class="btn-lg btn btn-uppercase btn-primary shop-now-button">Shop
                                            Now</a> </div>
                                </div>
                                <!-- /.caption -->
                            </div>
                            <!-- /.container-fluid -->
                        </div>
                        <!-- /.item -->
                        @endforeach

                    </div>
                    <!-- /.owl-carousel -->
                </div>

                <!-- ========================================= SECTION – HERO : END ========================================= -->

                <!-- ============================================== INFO BOXES ============================================== -->
                <div class="info-boxes wow fadeInUp">
                    <div class="info-boxes-inner">
                        <div class="row">
                            <div class="col-md-6 col-sm-4 col-lg-4">
                                <div class="info-box">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <h4 class="info-box-heading green">money back</h4>
                                        </div>
                                    </div>
                                    <h6 class="text">30 Days Money Back Guarantee</h6>
                                </div>
                            </div>
                            <!-- .col -->

                            <div class="hidden-md col-sm-4 col-lg-4">
                                <div class="info-box">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <h4 class="info-box-heading green">free shipping</h4>
                                        </div>
                                    </div>
                                    <h6 class="text">Shipping on orders over $99</h6>
                                </div>
                            </div>
                            <!-- .col -->

                            <div class="col-md-6 col-sm-4 col-lg-4">
                                <div class="info-box">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <h4 class="info-box-heading green">Special Sale</h4>
                                        </div>
                                    </div>
                                    <h6 class="text">Extra $5 off on all items </h6>
                                </div>
                            </div>
                            <!-- .col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.info-boxes-inner -->

                </div>
                <!-- /.info-boxes -->
                <!-- ============================================== INFO BOXES : END ============================================== -->
                <!-- ============================================== SCROLL TABS ============================================== -->
                <div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
                    <div class="more-info-tab clearfix ">
                        <h3 class="new-product-title pull-left">
                            @if (session()->get('language') == 'arabic')
                            المنتجات الجديدة
                            @else
                            New Products
                            @endif
                        </h3>
                        <ul class="nav nav-tabs nav-tab-line pull-right" id="new-products-1">
                            <li class="active"><a data-transition-type="backSlide" href="#all" data-toggle="tab">
                                    @if (session()->get('language') == 'arabic')
                                    الكل
                                    @else
                                    All
                                    @endif
                                </a>
                            </li>
                            @foreach ($categories as $item)
                            <li><a data-transition-type="backSlide" href="#category{{ $item->id}}" data-toggle="tab">
                                    @if (session()->get('language') == 'arabic')
                                    {{$item->category_name_ar}}
                                    @else
                                    {{$item->category_name_en}}
                                    @endif
                                </a>
                            </li>
                            @endforeach
                            {{-- <li><a data-transition-type="backSlide" href="#laptop"
                                    data-toggle="tab">Electronics</a>
                            </li>
                            <li><a data-transition-type="backSlide" href="#apple" data-toggle="tab">Shoes</a></li> --}}
                        </ul>
                        <!-- /.nav-tabs -->
                    </div>
                    <div class="tab-content outer-top-xs">


                        <div class="tab-pane in active" id="all">
                            <div class="product-slider">
                                <div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">
                                    @foreach($products as $product)
                                    <div class="item item-carousel">
                                        <div class="products">
                                            <div class="product">
                                                <div class="product-image">
                                                    <div class="image"> <a
                                                            href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}"><img
                                                                src="{{ asset($product->product_thambnail) }}"
                                                                alt=""></a> </div>
                                                    <!-- /.image -->
                                                    @php
                                                    $amount = $product->selling_price - $product->discount_price;
                                                    $discount = ($amount/ $product->selling_price)*100;
                                                    @endphp
                                                    @if ($product->discount_price == NULL)
                                                    <div class="tag new"><span>new</span></div>
                                                    @else
                                                    <div class="tag hot"><span>{{round($discount)}}%</span></div>

                                                    @endif
                                                </div>
                                                <!-- /.product-image -->

                                                <div class="product-info text-left">
                                                    <h3 class="name"><a
                                                            href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}">
                                                            @if (session()->get('language') == 'arabic')
                                                            {{$product->product_name_ar}}
                                                            @else
                                                            {{$product->product_name_en}}
                                                            @endif
                                                        </a></h3>
                                                    @php
                                                    $reviewcount =
                                                    App\Models\Review::where('product_id',$product->id)->where('status',1)->latest()->get();
                                                    $avarage =
                                                    App\Models\Review::where('product_id',$product->id)->where('status',1)->avg('rating');
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
                                                                <span
                                                                    class="fa fa-star {{$avarage >= 1 ? 'checked' : ''}} "></span>
                                                                <span
                                                                    class="fa fa-star {{$avarage >= 2 ? 'checked' : ''}}"></span>
                                                                <span
                                                                    class="fa fa-star {{$avarage >= 3 ? 'checked' : ''}}"></span>
                                                                <span
                                                                    class="fa fa-star {{$avarage >= 4 ? 'checked' : ''}}"></span>
                                                                <span
                                                                    class="fa fa-star {{$avarage >= 5 ? 'checked' : ''}}"></span>
                                                                @endif
                                                            </div>

                                                        </div><!-- /.row -->
                                                    </div><!-- /.rating-reviews -->
                                                    @if ($product->discount_price == NULL)
                                                    <div class="product-price"> <span class="price">
                                                            ${{$product->selling_price}} </span>
                                                    </div>
                                                    @else
                                                    <div class="product-price"> <span class="price">
                                                            ${{$product->discount_price}}
                                                        </span>
                                                        <span class="price-before-discount">$
                                                            {{$product->selling_price}} </span>
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
                                                                <button class="btn btn-primary icon" type="button"
                                                                    title="Add Cart" data-toggle="modal"
                                                                    data-target="#exampleModal" id="{{$product->id}}"
                                                                    onclick="productView(this.id)">
                                                                    <i class="fa fa-shopping-cart"></i> </button>
                                                                <button class="btn btn-primary cart-btn"
                                                                    type="button">Add to
                                                                    cart</button>
                                                            </li>
                                                            <li class="add-cart-button btn-group">
                                                                <button class="btn btn-primary"
                                                                    style="background: #0f6cb2;" type="button"
                                                                    title="Wishlist" id='{{$product->id}}'
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
                                            <!-- /.product -->

                                        </div>
                                        <!-- /.products -->
                                    </div>
                                    <!-- /.item -->
                                    @endforeach
                                    <!--  // end all optionproduct foreach  -->
                                </div>
                            </div>
                        </div>

                        @foreach ($categories as $category)
                        {{-- new idea --}}
                        <div class="tab-pane" id="category{{ $category->id}}">
                            <div class="product-slider">
                                <div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">
                                    @php
                                    $catwiseProduct = App\Models\Product::where('category_id',
                                    $category->id)->orderBy('id','DESC')->get();
                                    @endphp
                                    @forelse($catwiseProduct as $item)
                                    <div class="item item-carousel">
                                        <div class="products">
                                            <div class="product">
                                                <div class="product-image">
                                                    <div class="image"> <a href="detail.html"><img
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
                                                    <div class="tag hot"><span>{{round($discount)}}%</span></div>

                                                    @endif
                                                </div>
                                                <!-- /.product-image -->

                                                <div class="product-info text-left">
                                                    <h3 class="name">
                                                        <a
                                                            href="{{ url('product/details/'.$item->id.'/'.$item->product_slug_en ) }}">
                                                            @if (session()->get('language') == 'arabic')
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
                                                                <span
                                                                    class="fa fa-star {{$avarage >= 1 ? 'checked' : ''}} "></span>
                                                                <span
                                                                    class="fa fa-star {{$avarage >= 2 ? 'checked' : ''}}"></span>
                                                                <span
                                                                    class="fa fa-star {{$avarage >= 3 ? 'checked' : ''}}"></span>
                                                                <span
                                                                    class="fa fa-star {{$avarage >= 4 ? 'checked' : ''}}"></span>
                                                                <span
                                                                    class="fa fa-star {{$avarage >= 5 ? 'checked' : ''}}"></span>
                                                                @endif
                                                            </div>
                                                        </div><!-- /.row -->
                                                    </div><!-- /.rating-reviews -->

                                                    @if ($item->discount_price == NULL)
                                                    <div class="product-price"> <span class="price">
                                                            ${{$item->selling_price}} </span>
                                                    </div>
                                                    @else
                                                    <div class="product-price"> <span class="price">
                                                            ${{$item->discount_price}}
                                                        </span>
                                                        <span class="price-before-discount">$
                                                            {{$item->selling_price}} </span>
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
                                                                <button class="btn btn-primary icon" type="button"
                                                                    title="Add Cart" data-toggle="modal"
                                                                    data-target="#exampleModal" id="{{$item->id}}"
                                                                    onclick="productView(this.id)">
                                                                    <i class="fa fa-shopping-cart"></i> </button>
                                                                <button class="btn btn-primary cart-btn"
                                                                    type="button">Add to
                                                                    cart</button>
                                                            </li>
                                                            <li class="add-cart-button btn-group">
                                                                <button class="btn btn-primary"
                                                                    style="background: #0f6cb2;" type="button"
                                                                    title="Wishlist" id='{{$item->id}}'
                                                                    onclick="AddToWishlist(this.id)">
                                                                    <i class="fa fa-heart"></i>
                                                                </button>
                                                            </li>
                                                            <li class="lnk"> <a class="add-to-cart" href="detail.html"
                                                                    title="Compare"> <i class="fa fa-signal"
                                                                        aria-hidden="true"></i>
                                                                </a> </li>
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
                                    <!-- /.item -->
                                    {{-- new idea --}}
                                    @empty
                                    <h5 class="text-danger">No Product Found</h5>
                                    @endforelse
                                </div>
                                <!-- /.home-owl-carousel -->
                            </div>
                            <!-- /.product-slider -->
                        </div>
                        <!-- /.tab-pane -->
                        @endforeach
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.scroll-tabs -->
                <!-- ============================================== SCROLL TABS : END ============================================== -->
                <!-- ============================================== WIDE PRODUCTS ============================================== -->
                <div class="wide-banners wow fadeInUp outer-bottom-xs">
                    <div class="row">
                        <div class="col-md-7 col-sm-7">
                            <div class="wide-banner cnt-strip">
                                <div class="image"> <img class="img-responsive"
                                        src="{{asset('frontend/assets/images/banners/home-banner1.jpg')}}" alt="">
                                    {{-- src="{{asset('frontend/assets/images/banners/c.webp')}}" alt=""> --}}
                                </div>
                            </div>
                            <!-- /.wide-banner -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-5 col-sm-5">
                            <div class="wide-banner cnt-strip">
                                <div class="image"> <img class="img-responsive"
                                        src="{{asset('frontend/assets/images/banners/home-banner2.jpg')}}" alt="">
                                    {{-- src="{{asset('frontend/assets/images/banners/t.webp')}}" alt=""> --}}
                                </div>
                            </div>
                            <!-- /.wide-banner -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.wide-banners -->

                <!-- ============================================== WIDE PRODUCTS : END ============================================== -->
                <!-- ============================================== FEATURED PRODUCTS ============================================== -->
                <section class="section featured-product wow fadeInUp">
                    <h3 class="section-title">
                        @if (session('language') == 'arabic')
                        منتجات مميزة
                        @else
                        Featured products
                        @endif
                    </h3>
                    <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
                        @foreach ($featured as $item)
                        <div class="item item-carousel">
                            <div class="products">
                                <div class="product">
                                    <div class="product-image">
                                        <div class="image"> <a
                                                href="{{ url('product/details/'.$item->id.'/'.$item->product_slug_en ) }}"><img
                                                    src="{{asset($item->product_thambnail)}}" alt=""></a> </div>
                                        <!-- /.image -->
                                        @php
                                        $amount = $item->selling_price - $item->discount_price;
                                        $discount = ($amount/ $item->selling_price)*100;
                                        @endphp
                                        @if ($item->discount_price == NULL)
                                        <div class="tag new"><span>new</span></div>
                                        @else
                                        <div class="tag hot"><span>{{round($discount)}}%</span></div>
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
                                                        data-toggle="modal" data-target="#exampleModal"
                                                        id="{{$item->id}}" onclick="productView(this.id)">
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
                                                <li class="lnk"> <a data-toggle="tooltip" class="add-to-cart"
                                                        href="detail.html" title="Compare"> <i class="fa fa-signal"
                                                            aria-hidden="true"></i> </a> </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- /.cart -->
                                </div>
                                <!-- /.product -->

                            </div>
                            <!-- /.products -->
                        </div>
                        <!-- /.item -->
                        @endforeach
                    </div>
                    <!-- /.home-owl-carousel -->
                </section>
                <!-- /.section -->
                <!-- ============================================== FEATURED PRODUCTS : END ============================================== -->

                <!-- ============================================== skip_product_0 PRODUCTS =============================================== -->
                <section class="section featured-product wow fadeInUp">
                    <h3 class="section-title">
                        @if(session()->get('language') == 'arabic') {{ $skip_category_0->category_name_ar }} @else {{
                        $skip_category_0->category_name_en }} @endif
                    </h3>
                    <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
                        @foreach($skip_product_0 as $product)
                        <div class="item item-carousel">
                            <div class="products">
                                <div class="product">
                                    <div class="product-image">
                                        <div class="image"> <a
                                                href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}"><img
                                                    src="{{ asset($product->product_thambnail) }}" alt=""></a> </div>
                                        <!-- /.image -->

                                        @php
                                        $amount = $product->selling_price - $product->discount_price;
                                        $discount = ($amount/$product->selling_price) * 100;
                                        @endphp

                                        <div>
                                            @if ($product->discount_price == NULL)
                                            <div class="tag new"><span>new</span></div>
                                            @else
                                            <div class="tag hot"><span>{{ round($discount) }}%</span></div>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- /.product-image -->

                                    <div class="product-info text-left">
                                        <h3 class="name"><a
                                                href="{{ url('product/details/'.$product->id.'/'.$product->product_slug_en ) }}">
                                                @if(session()->get('language') == 'arabic') {{ $product->product_name_ar
                                                }} @else {{ $product->product_name_en }} @endif
                                            </a></h3>
                                        @php
                                        $reviewcount =
                                        App\Models\Review::where('product_id',$product->id)->where('status',1)->latest()->get();
                                        $avarage =
                                        App\Models\Review::where('product_id',$product->id)->where('status',1)->avg('rating');
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

                                        @if ($product->discount_price == NULL)
                                        <div class="product-price"> <span class="price"> ${{ $product->selling_price }}
                                            </span> </div>
                                        @else
                                        <div class="product-price"> <span class="price"> ${{ $product->discount_price }}
                                            </span> <span class="price-before-discount">$ {{ $product->selling_price
                                                }}</span> </div>
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
                                                        data-toggle="modal" data-target="#exampleModal"
                                                        id="{{$product->id}}" onclick="productView(this.id)">
                                                        <i class="fa fa-shopping-cart"></i> </button>
                                                    <button class="btn btn-primary cart-btn" type="button">Add to
                                                        cart</button>
                                                </li>
                                                <li class="add-cart-button btn-group">
                                                    <button class="btn btn-primary" style="background: #0f6cb2;"
                                                        type="button" title="Wishlist" id='{{$product->id}}'
                                                        onclick="AddToWishlist(this.id)">
                                                        <i class="fa fa-heart"></i>
                                                    </button>
                                                </li>
                                                <li class="lnk"> <a data-toggle="tooltip" class="add-to-cart"
                                                        href="detail.html" title="Compare"> <i class="fa fa-signal"
                                                            aria-hidden="true"></i> </a> </li>
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
                        <!-- /.item -->
                        @endforeach


                    </div>
                    <!-- /.home-owl-carousel -->
                </section>
                <!-- /.section -->
                <!-- == ==== skip_product_0 PRODUCTS : END ==== === -->

                <!-- ============================================== BRAND PRODUCTS ============================================= -->
                <section class="section featured-product wow fadeInUp">
                    <h3 class="section-title">
                        @if (session('language') == 'arabic')
                        {{$skip_brand_1->brand_name_ar}}
                        @else
                        {{$skip_brand_1->brand_name_en}}
                        @endif
                    </h3>
                    <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
                        @foreach ($skip_brand_product_1 as $item)
                        <div class="item item-carousel">
                            <div class="products">
                                <div class="product">
                                    <div class="product-image">
                                        <div class="image"> <a
                                                href="{{ url('product/details/'.$item->id.'/'.$item->product_slug_en ) }}"><img
                                                    src="{{asset($item->product_thambnail)}}" alt=""></a> </div>
                                        <!-- /.image -->
                                        @php
                                        $amount = $item->selling_price - $item->discount_price;
                                        $discount = ($amount/ $item->selling_price)*100;
                                        @endphp
                                        @if ($item->discount_price == NULL)
                                        <div class="tag new"><span>new</span></div>
                                        @else
                                        <div class="tag hot"><span>{{round($discount)}}%</span></div>
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
                                                        data-toggle="modal" data-target="#exampleModal"
                                                        id="{{$item->id}}" onclick="productView(this.id)">
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
                                                <li class="lnk"> <a class="add-to-cart" href="detail.html"
                                                        title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i>
                                                    </a> </li>
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
                        <!-- /.item -->
                        @endforeach
                    </div>
                    <!-- /.home-owl-carousel -->
                </section>
                <!-- /.section -->
                <!-- ============================================== BRAND PRODUCTS : END ============================================== -->

                <!-- ============================================== WIDE PRODUCTS ============================================== -->
                <div class="wide-banners wow fadeInUp outer-bottom-xs">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="wide-banner cnt-strip">
                                <div class="image"> <img class="img-responsive"
                                        src="assets/images/banners/home-banner.jpg" alt=""> </div>
                                <div class="strip strip-text">
                                    <div class="strip-inner">
                                        <h2 class="text-right">New Mens Fashion<br>
                                            <span class="shopping-needs">Save up to 40% off</span>
                                        </h2>
                                    </div>
                                </div>
                                <div class="new-label">
                                    <div class="text">NEW</div>
                                </div>
                                <!-- /.new-label -->
                            </div>
                            <!-- /.wide-banner -->
                        </div>
                        <!-- /.col -->

                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.wide-banners -->
                <!-- ============================================== WIDE PRODUCTS : END ============================================== -->
                <!-- ============================================== BEST SELLER ============================================== -->

                <!-- /.sidebar-widget -->
                <!-- ============================================== BEST SELLER : END ============================================== -->
                @include('frontend.home.bestseller')
                <!-- ============================================== BLOG SLIDER ============================================== -->
                <section class="section latest-blog outer-bottom-vs wow fadeInUp">
                    <h3 class="section-title">
                        @if (session()->get('language') == 'arabic')
                        أحدث الأخبار
                        @else
                        latest news
                        @endif
                    </h3>
                    <div class="blog-slider-container outer-top-xs">
                        <div class="owl-carousel blog-slider custom-carousel">
                            @foreach($blogPosts as $item)
                            <div class="item">
                                <div class="blog-post">
                                    <div class="blog-post-image">
                                        <div class="image"> <a href="{{route('post.details',$item->id)}}"><img
                                                    src="{{asset($item->post_image)}}" alt=""></a>
                                        </div>
                                    </div>
                                    <!-- /.blog-post-image -->

                                    <div class="blog-post-info text-left">
                                        <h3 class="name"><a href="{{route('post.details',$item->id)}}">
                                                @if (session()->get('language') == 'arabic')
                                                {{$item->post_title_ar}}
                                                @else
                                                {{$item->post_title_en}}
                                                @endif
                                            </a></h3>
                                        {{-- <span class="info">By Jone Doe &nbsp;|&nbsp; {{$item->created_at}} </span>
                                        --}}
                                        <span class="info">Posted at &nbsp;|&nbsp; {{$item->created_at}} </span>
                                        <hr>
                                        <p class="text">
                                            @if (session()->get('language') == 'arabic')
                                            {!! Str::limit($item->post_details_ar,100) !!}
                                            @else
                                            {!! Str::limit($item->post_details_en,100) !!}
                                            @endif
                                        </p>
                                        <a href="{{route('post.details',$item->id)}}" class="lnk btn btn-primary">Read
                                            more</a>
                                    </div>
                                    <!-- /.blog-post-info -->

                                </div>
                                <!-- /.blog-post -->
                            </div>
                            <!-- /.item -->
                            @endforeach
                        </div>
                        <!-- /.owl-carousel -->
                    </div>
                    <!-- /.blog-slider-container -->
                </section>
                <!-- /.section -->
                <!-- ============================================== BLOG SLIDER : END ============================================== -->

                <!-- ============================================== New Arrivals PRODUCTS ============================================== -->
                {{-- <section class="section wow fadeInUp new-arriavls">
                    <h3 class="section-title">New Arrivals</h3>
                    <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
                        <div class="item item-carousel">
                            <div class="products">
                                <div class="product">
                                    <div class="product-image">
                                        <div class="image"> <a href="detail.html"><img
                                                    src="assets/images/products/p19.jpg" alt=""></a> </div>
                                        <!-- /.image -->

                                        <div class="tag new"><span>new</span></div>
                                    </div>
                                    <!-- /.product-image -->

                                    <div class="product-info text-left">
                                        <h3 class="name"><a href="detail.html">Floral Print Buttoned</a>
                                        </h3>
                                        <div class="rating rateit-small"></div>
                                        <div class="description"></div>
                                        <div class="product-price"> <span class="price"> $450.99 </span>
                                            <span class="price-before-discount">$ 800</span>
                                        </div>
                                        <!-- /.product-price -->

                                    </div>
                                    <!-- /.product-info -->
                                    <div class="cart clearfix animate-effect">
                                        <div class="action">
                                            <ul class="list-unstyled">
                                                <li class="add-cart-button btn-group">
                                                    <button class="btn btn-primary icon" data-toggle="dropdown"
                                                        type="button"> <i class="fa fa-shopping-cart"></i> </button>
                                                    <button class="btn btn-primary cart-btn" type="button">Add to
                                                        cart</button>
                                                </li>
                                                <li class="lnk wishlist"> <a class="add-to-cart" href="detail.html"
                                                        title="Wishlist"> <i class="icon fa fa-heart"></i> </a>
                                                </li>
                                                <li class="lnk"> <a class="add-to-cart" href="detail.html"
                                                        title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i>
                                                    </a> </li>
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
                        <!-- /.item -->

                        <div class="item item-carousel">
                            <div class="products">
                                <div class="product">
                                    <div class="product-image">
                                        <div class="image"> <a href="detail.html"><img
                                                    src="assets/images/products/p28.jpg" alt=""></a> </div>
                                        <!-- /.image -->

                                        <div class="tag new"><span>new</span></div>
                                    </div>
                                    <!-- /.product-image -->

                                    <div class="product-info text-left">
                                        <h3 class="name"><a href="detail.html">Floral Print Buttoned</a>
                                        </h3>
                                        <div class="rating rateit-small"></div>
                                        <div class="description"></div>
                                        <div class="product-price"> <span class="price"> $450.99 </span>
                                            <span class="price-before-discount">$ 800</span>
                                        </div>
                                        <!-- /.product-price -->

                                    </div>
                                    <!-- /.product-info -->
                                    <div class="cart clearfix animate-effect">
                                        <div class="action">
                                            <ul class="list-unstyled">
                                                <li class="add-cart-button btn-group">
                                                    <button class="btn btn-primary icon" data-toggle="dropdown"
                                                        type="button"> <i class="fa fa-shopping-cart"></i> </button>
                                                    <button class="btn btn-primary cart-btn" type="button">Add to
                                                        cart</button>
                                                </li>
                                                <li class="lnk wishlist"> <a class="add-to-cart" href="detail.html"
                                                        title="Wishlist"> <i class="icon fa fa-heart"></i> </a>
                                                </li>
                                                <li class="lnk"> <a class="add-to-cart" href="detail.html"
                                                        title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i>
                                                    </a> </li>
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
                        <!-- /.item -->

                        <div class="item item-carousel">
                            <div class="products">
                                <div class="product">
                                    <div class="product-image">
                                        <div class="image"> <a href="detail.html"><img
                                                    src="assets/images/products/p30.jpg" alt=""></a> </div>
                                        <!-- /.image -->

                                        <div class="tag hot"><span>hot</span></div>
                                    </div>
                                    <!-- /.product-image -->

                                    <div class="product-info text-left">
                                        <h3 class="name"><a href="detail.html">Floral Print Buttoned</a>
                                        </h3>
                                        <div class="rating rateit-small"></div>
                                        <div class="description"></div>
                                        <div class="product-price"> <span class="price"> $450.99 </span>
                                            <span class="price-before-discount">$ 800</span>
                                        </div>
                                        <!-- /.product-price -->

                                    </div>
                                    <!-- /.product-info -->
                                    <div class="cart clearfix animate-effect">
                                        <div class="action">
                                            <ul class="list-unstyled">
                                                <li class="add-cart-button btn-group">
                                                    <button class="btn btn-primary icon" data-toggle="dropdown"
                                                        type="button"> <i class="fa fa-shopping-cart"></i> </button>
                                                    <button class="btn btn-primary cart-btn" type="button">Add to
                                                        cart</button>
                                                </li>
                                                <li class="lnk wishlist"> <a class="add-to-cart" href="detail.html"
                                                        title="Wishlist"> <i class="icon fa fa-heart"></i> </a>
                                                </li>
                                                <li class="lnk"> <a class="add-to-cart" href="detail.html"
                                                        title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i>
                                                    </a> </li>
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
                        <!-- /.item -->

                        <div class="item item-carousel">
                            <div class="products">
                                <div class="product">
                                    <div class="product-image">
                                        <div class="image"> <a href="detail.html"><img
                                                    src="assets/images/products/p1.jpg" alt=""></a> </div>
                                        <!-- /.image -->

                                        <div class="tag hot"><span>hot</span></div>
                                    </div>
                                    <!-- /.product-image -->

                                    <div class="product-info text-left">
                                        <h3 class="name"><a href="detail.html">Floral Print Buttoned</a>
                                        </h3>
                                        <div class="rating rateit-small"></div>
                                        <div class="description"></div>
                                        <div class="product-price"> <span class="price"> $450.99 </span>
                                            <span class="price-before-discount">$ 800</span>
                                        </div>
                                        <!-- /.product-price -->

                                    </div>
                                    <!-- /.product-info -->
                                    <div class="cart clearfix animate-effect">
                                        <div class="action">
                                            <ul class="list-unstyled">
                                                <li class="add-cart-button btn-group">
                                                    <button class="btn btn-primary icon" data-toggle="dropdown"
                                                        type="button"> <i class="fa fa-shopping-cart"></i> </button>
                                                    <button class="btn btn-primary cart-btn" type="button">Add to
                                                        cart</button>
                                                </li>
                                                <li class="lnk wishlist"> <a class="add-to-cart" href="detail.html"
                                                        title="Wishlist"> <i class="icon fa fa-heart"></i> </a>
                                                </li>
                                                <li class="lnk"> <a class="add-to-cart" href="detail.html"
                                                        title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i>
                                                    </a> </li>
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
                        <!-- /.item -->

                        <div class="item item-carousel">
                            <div class="products">
                                <div class="product">
                                    <div class="product-image">
                                        <div class="image"> <a href="detail.html"><img
                                                    src="assets/images/products/p2.jpg" alt=""></a> </div>
                                        <!-- /.image -->

                                        <div class="tag sale"><span>sale</span></div>
                                    </div>
                                    <!-- /.product-image -->

                                    <div class="product-info text-left">
                                        <h3 class="name"><a href="detail.html">Floral Print Buttoned</a>
                                        </h3>
                                        <div class="rating rateit-small"></div>
                                        <div class="description"></div>
                                        <div class="product-price"> <span class="price"> $450.99 </span>
                                            <span class="price-before-discount">$ 800</span>
                                        </div>
                                        <!-- /.product-price -->

                                    </div>
                                    <!-- /.product-info -->
                                    <div class="cart clearfix animate-effect">
                                        <div class="action">
                                            <ul class="list-unstyled">
                                                <li class="add-cart-button btn-group">
                                                    <button class="btn btn-primary icon" data-toggle="dropdown"
                                                        type="button"> <i class="fa fa-shopping-cart"></i> </button>
                                                    <button class="btn btn-primary cart-btn" type="button">Add to
                                                        cart</button>
                                                </li>
                                                <li class="lnk wishlist"> <a class="add-to-cart" href="detail.html"
                                                        title="Wishlist"> <i class="icon fa fa-heart"></i> </a>
                                                </li>
                                                <li class="lnk"> <a class="add-to-cart" href="detail.html"
                                                        title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i>
                                                    </a> </li>
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
                        <!-- /.item -->

                        <div class="item item-carousel">
                            <div class="products">
                                <div class="product">
                                    <div class="product-image">
                                        <div class="image"> <a href="detail.html"><img
                                                    src="assets/images/products/p3.jpg" alt=""></a> </div>
                                        <!-- /.image -->

                                        <div class="tag sale"><span>sale</span></div>
                                    </div>
                                    <!-- /.product-image -->

                                    <div class="product-info text-left">
                                        <h3 class="name"><a href="detail.html">Floral Print Buttoned</a>
                                        </h3>
                                        <div class="rating rateit-small"></div>
                                        <div class="description"></div>
                                        <div class="product-price"> <span class="price"> $450.99 </span>
                                            <span class="price-before-discount">$ 800</span>
                                        </div>
                                        <!-- /.product-price -->

                                    </div>
                                    <!-- /.product-info -->
                                    <div class="cart clearfix animate-effect">
                                        <div class="action">
                                            <ul class="list-unstyled">
                                                <li class="add-cart-button btn-group">
                                                    <button class="btn btn-primary icon" data-toggle="dropdown"
                                                        type="button"> <i class="fa fa-shopping-cart"></i> </button>
                                                    <button class="btn btn-primary cart-btn" type="button">Add to
                                                        cart</button>
                                                </li>
                                                <li class="lnk wishlist"> <a class="add-to-cart" href="detail.html"
                                                        title="Wishlist"> <i class="icon fa fa-heart"></i> </a>
                                                </li>
                                                <li class="lnk"> <a class="add-to-cart" href="detail.html"
                                                        title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i>
                                                    </a> </li>
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
                        <!-- /.item -->
                    </div>
                    <!-- /.home-owl-carousel -->
                </section> --}}
                <!-- /.section -->
                <!-- ============================================== New Arrivals PRODUCTS : END ============================================== -->

            </div>
            <!-- /.homebanner-holder -->
            <!-- ============================================== CONTENT : END ============================================== -->
        </div>
        <!-- /.row -->
        <!-- ============================================== BRANDS CAROUSEL ============================================== -->
        @include('frontend.body.brand')
        <!-- /.logo-slider -->
        <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
    </div>
    <!-- /.container -->
</div>
@endsection