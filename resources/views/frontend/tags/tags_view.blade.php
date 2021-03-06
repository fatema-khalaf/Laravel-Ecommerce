@extends('frontend.main_master')
@section('content')
@section('title')
Products with tag
@endsection

<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="#">Home</a></li>
                <li class='active'>Handbags</li>
            </ul>
        </div>
        <!-- /.breadcrumb-inner -->
    </div>
    <!-- /.container -->
</div>
<!-- /.breadcrumb -->
<div class="body-content outer-top-xs">
    <div class='container'>
        <div class='row'>
            <div class='col-md-3 sidebar'>

                <!-- ===== == TOP NAVIGATION ======= ==== -->
                @include('frontend.common.vertical_menu')
                <!-- = ==== TOP NAVIGATION : END === ===== -->

                <div class="sidebar-module-container">
                    <div class="sidebar-filter">
                        <!-- ============================================== SIDEBAR CATEGORY ============================================== -->

                        @include('frontend.common.sidebar_category_accordion')

                        <!-- /.sidebar-widget -->
                        <!-- ============================================== SIDEBAR CATEGORY : END ============================================== -->

                        <!-- ============================================== PRICE SILDER============================================== -->

                        <!-- /.sidebar-widget -->
                        <!-- ============================================== PRICE SILDER : END ============================================== -->
                        <!-- ============================================== MANUFACTURES============================================== -->

                        <!-- /.sidebar-widget -->
                        <!-- ============================================== MANUFACTURES: END ============================================== -->
                        <!-- ============================================== COLOR============================================== -->

                        <!-- ============================================== COLOR: END ============================================== -->
                        <!-- ============================================== COMPARE============================================== -->

                        <!-- ============================================== COMPARE: END ============================================== -->
                        <!-- ============================================== PRODUCT TAGS ============================================== -->
                        @include('frontend.common.product_tags')
                        <!-- /.sidebar-widget -->
                        <!----------- NEWSLETTER------------->

                        @include('frontend.common.newsletter')

                        <!-- ============================================== NEWSLETTER: END ============================================== -->

                    </div>
                    <!-- /.sidebar-filter -->
                </div>
                <!-- /.sidebar-module-container -->
            </div>
            <!-- /.sidebar -->
            <div class='col-md-9'>
                <!-- ========================================== SECTION ??? HERO ========================================= -->


                <div class="clearfix filters-container m-t-10">
                    <h4> {{ $count }} </span>products </h4>
                    <hr>
                    <div class="row">
                        <div class="col col-sm-6 col-md-2">
                            <div class="filter-tabs">
                                <ul id="filter-tabs" class="nav nav-tabs nav-tab-box nav-tab-fa-icon">
                                    <li class="active"> <a data-toggle="tab" href="#grid-container"><i
                                                class="icon fa fa-th-large"></i>Grid</a> </li>
                                    <li><a data-toggle="tab" href="#list-container"><i
                                                class="icon fa fa-th-list"></i>List</a></li>
                                </ul>
                            </div>
                            <!-- /.filter-tabs -->
                        </div>
                        <!-- /.col -->
                        <div class="col col-sm-12 col-md-6">
                            {{-- <div class="col col-sm-3 col-md-6 no-padding">
                                <div class="lbl-cnt"> <span class="lbl">Sort by</span>
                                    <div class="fld inline">
                                        <div class="dropdown dropdown-small dropdown-med dropdown-white inline">
                                            <button data-toggle="dropdown" type="button" class="btn dropdown-toggle">
                                                Position <span class="caret"></span> </button>
                                            <ul role="menu" class="dropdown-menu">
                                                <li role="presentation"><a href="#">position</a></li>
                                                <li role="presentation"><a href="#">Price:Lowest first</a></li>
                                                <li role="presentation"><a href="#">Price:HIghest first</a></li>
                                                <li role="presentation"><a href="#">Product Name:A to Z</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- /.fld -->
                                </div>
                                <!-- /.lbl-cnt -->
                            </div>
                            <!-- /.col -->
                            <div class="col col-sm-3 col-md-6 no-padding">
                                <div class="lbl-cnt"> <span class="lbl">Show</span>
                                    <div class="fld inline">
                                        <div class="dropdown dropdown-small dropdown-med dropdown-white inline">
                                            <button data-toggle="dropdown" type="button" class="btn dropdown-toggle"> 1
                                                <span class="caret"></span> </button>
                                            <ul role="menu" class="dropdown-menu">
                                                <li role="presentation"><a href="#">1</a></li>
                                                <li role="presentation"><a href="#">2</a></li>
                                                <li role="presentation"><a href="#">3</a></li>
                                                <li role="presentation"><a href="#">4</a></li>
                                                <li role="presentation"><a href="#">5</a></li>
                                                <li role="presentation"><a href="#">6</a></li>
                                                <li role="presentation"><a href="#">7</a></li>
                                                <li role="presentation"><a href="#">8</a></li>
                                                <li role="presentation"><a href="#">9</a></li>
                                                <li role="presentation"><a href="#">10</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- /.fld -->
                                </div>
                                <!-- /.lbl-cnt -->
                            </div> --}}
                            <!-- /.col -->
                        </div>
                        <!-- /.col -->
                        {{-- custom pagination video 644--}}
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
                                <div class="row">
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
                                                <!-- /.product-info -->
                                                <div class="cart clearfix animate-effect">
                                                    <div class="action">
                                                        <ul class="list-unstyled">
                                                            <li class="add-cart-button btn-group">
                                                                <button class="btn btn-primary icon"
                                                                    data-toggle="dropdown" type="button"> <i
                                                                        class="fa fa-shopping-cart"></i> </button>
                                                                <button class="btn btn-primary cart-btn"
                                                                    type="button">Add to cart</button>
                                                            </li>
                                                            <li class="lnk wishlist"> <a class="add-to-cart"
                                                                    href="detail.html" title="Wishlist"> <i
                                                                        class="icon fa fa-heart"></i> </a> </li>
                                                            <li class="lnk"> <a class="add-to-cart" href="detail.html"
                                                                    title="Compare"> <i class="fa fa-signal"></i> </a>
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
                            <div class="category-product">
                                @foreach ($products as $item)
                                <div class="category-product-inner wow fadeInUp">
                                    <div class="products">
                                        <div class="product-list product">
                                            <div class="row product-list-row">
                                                <div class="col col-sm-4 col-lg-4">
                                                    <div class="product-image">
                                                        <div class="image"> <img
                                                                src="{{asset($item->product_thambnail)}}" alt=""> </div>
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
                                                        <div class="rating rateit-small"></div>

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
                                                                        <button class="btn btn-primary icon"
                                                                            data-toggle="dropdown" type="button"> <i
                                                                                class="fa fa-shopping-cart"></i>
                                                                        </button>
                                                                        <button class="btn btn-primary cart-btn"
                                                                            type="button">Add to cart</button>
                                                                    </li>
                                                                    <li class="lnk wishlist"> <a class="add-to-cart"
                                                                            href="detail.html" title="Wishlist"> <i
                                                                                class="icon fa fa-heart"></i> </a> </li>
                                                                    <li class="lnk"> <a class="add-to-cart"
                                                                            href="detail.html" title="Compare"> <i
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
                            </div>
                            <!-- /.category-product -->
                        </div>

                        <!-- /.tab-pane #list-container -->
                    </div>
                    {{ $products->links('vendor.pagination.custom') }}
                </div>
                <!-- /.search-result-container -->


            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <!-- ============================================== BRANDS CAROUSEL ============================================== -->
        @include('frontend.body.brand')

        <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
    </div>
    <!-- /.container -->

</div>
<!-- /.body-content -->
@endsection