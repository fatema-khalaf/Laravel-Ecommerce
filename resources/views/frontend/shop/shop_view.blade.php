@extends('frontend.main_master')
@section('content')
@section('title')
shop
@endsection

<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                @if (session()->get('language') == 'arabic')
                <li><a href="{{url('/')}}">
                        الرئيسية</a></li>
                @else
                <li><a href="{{url('/')}}">
                        Home</a></li>
                @endif
            </ul>
            {{-- @endif --}}
        </div>
        <!-- /.breadcrumb-inner -->
    </div>
    <!-- /.container -->
</div>
<!-- /.breadcrumb -->
<div class="body-content outer-top-xs">
    <div class='container'>
        <form action="{{route('shop.filter')}}" method="post">
            @csrf
            <div class='row'>
                <div class='col-md-3 sidebar'>
                    @php
                    // dd($products);
                    @endphp
                    <!-- ===== == TOP NAVIGATION ======= ==== -->
                    @include('frontend.common.vertical_menu')
                    <!-- = ==== TOP NAVIGATION : END === ===== -->

                    <div class="sidebar-module-container">
                        <div class="sidebar-filter">
                            <!-- ============================================== SIDEBAR CATEGORY ============================================== -->

                            <div class="sidebar-widget wow fadeInUp">
                                <h3 class="section-title">shop by</h3>
                                <div class="widget-header">
                                    <h4 class="widget-title">Category</h4>
                                </div>
                                @if(!empty($_GET['category']))
                                @php
                                $filterCat = explode(',',$_GET['category']);
                                @endphp
                                @endif
                                <div class="sidebar-widget-body">
                                    @foreach ($categories as $category)
                                    <div class="accordion">
                                        <div class="accordion-group">
                                            <div class="accordion-heading">
                                                {{-- new idea submit form on check box video 467--}}
                                                <label class="form-check-label">
                                                    {{-- name="category[]" to select multiple category at once--}}
                                                    <input type="checkbox" class="form-check-input" name="category[]"
                                                        value="{{ $category->category_slug_en }}"
                                                        onchange="this.form.submit()" @if(!empty($filterCat) &&
                                                        in_array($category->category_slug_en,$filterCat)) checked @endif
                                                    >
                                                    @if(session()->get('language') == 'arabic') {{
                                                    $category->category_name_ar }} @else {{ $category->category_name_en
                                                    }} @endif
                                                </label>
                                            </div>
                                            <!-- /.accordion-heading -->

                                            <!-- /.accordion-body -->
                                        </div>
                                        <!-- /.accordion-group -->
                                    </div>
                                    <!-- /.accordion -->
                                    @endforeach
                                </div>
                                <!-- /.sidebar-widget-body -->
                                <!--  /////////// This is for Brand Filder /////////////// -->


                                <hr>
                                <div class="widget-header">
                                    <h4 class="widget-title">Brand Filter</h4>
                                </div>
                                <div class="sidebar-widget-body">
                                    <div class="accordion">

                                        @if(!empty($_GET['brand']))
                                        @php
                                        $filterBrand = explode(',',$_GET['brand']);
                                        @endphp
                                        @endif
                                        @foreach($brands as $brand)
                                        <div class="accordion-group">
                                            <div class="accordion-heading">

                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input" name="brand[]"
                                                        value="{{ $brand->brand_slug_en }}" @if(!empty($filterBrand) &&
                                                        in_array($brand->brand_slug_en,$filterBrand)) checked @endif
                                                    onchange="this.form.submit()">

                                                    @if(session()->get('language') == 'arabic') {{ $brand->brand_name_ar
                                                    }} @else {{ $brand->brand_name_en }} @endif

                                                </label>


                                            </div>
                                            <!-- /.accordion-heading -->


                                        </div>
                                        <!-- /.accordion-group -->
                                        @endforeach
                                    </div>

                                    <!--  /////////// This is the end for Brand Filder /////////////// -->
                                </div>
                                <!-- /.sidebar-widget -->
                            </div>
                            <!-- ============================================== SIDEBAR CATEGORY : END ============================================== -->

                            <!-- ============================================== PRICE SILDER============================================== -->
                            <div class="sidebar-widget wow fadeInUp">
                                <div class="widget-header">
                                    <h4 class="widget-title">Price Slider</h4>
                                </div>
                                <div class="sidebar-widget-body m-t-10">
                                    <div class="price-range-holder"> <span class="min-max"> <span
                                                class="pull-left">$200.00</span> <span class="pull-right">$800.00</span>
                                        </span>
                                        <input type="text" id="amount"
                                            style="border:0; color:#666666; font-weight:bold;text-align:center;">
                                        <input type="text" class="price-slider" value="">
                                    </div>
                                    <!-- /.price-range-holder -->
                                    <a href="#" class="lnk btn btn-primary">Show Now</a>
                                </div>
                                <!-- /.sidebar-widget-body -->
                            </div>
                            <!-- /.sidebar-widget -->
                            <!-- ============================================== PRICE SILDER : END ============================================== -->
                            <!-- ============================================== MANUFACTURES============================================== -->
                            <div class="sidebar-widget wow fadeInUp">
                                <div class="widget-header">
                                    <h4 class="widget-title">Manufactures</h4>
                                </div>
                                <div class="sidebar-widget-body">
                                    <ul class="list">
                                        <li><a href="#">Forever 18</a></li>
                                        <li><a href="#">Nike</a></li>
                                        <li><a href="#">Dolce & Gabbana</a></li>
                                        <li><a href="#">Alluare</a></li>
                                        <li><a href="#">Chanel</a></li>
                                        <li><a href="#">Other Brand</a></li>
                                    </ul>
                                    <!--<a href="#" class="lnk btn btn-primary">Show Now</a>-->
                                </div>
                                <!-- /.sidebar-widget-body -->
                            </div>
                            <!-- /.sidebar-widget -->
                            <!-- ============================================== MANUFACTURES: END ============================================== -->
                            <!-- ============================================== COLOR============================================== -->
                            <div class="sidebar-widget wow fadeInUp">
                                <div class="widget-header">
                                    <h4 class="widget-title">Colors</h4>
                                </div>
                                <div class="sidebar-widget-body">
                                    <ul class="list">
                                        <li><a href="#">Red</a></li>
                                        <li><a href="#">Blue</a></li>
                                        <li><a href="#">Yellow</a></li>
                                        <li><a href="#">Pink</a></li>
                                        <li><a href="#">Brown</a></li>
                                        <li><a href="#">Teal</a></li>
                                    </ul>
                                </div>
                                <!-- /.sidebar-widget-body -->
                            </div>
                            <!-- /.sidebar-widget -->
                            <!-- ============================================== COLOR: END ============================================== -->
                            <!-- ============================================== COMPARE============================================== -->
                            {{-- <div class="sidebar-widget wow fadeInUp outer-top-vs">
                                <h3 class="section-title">Compare products</h3>
                                <div class="sidebar-widget-body">
                                    <div class="compare-report">
                                        <p>You have no <span>item(s)</span> to compare</p>
                                    </div>
                                    <!-- /.compare-report -->
                                </div>
                                <!-- /.sidebar-widget-body -->
                            </div> --}}
                            <!-- /.sidebar-widget -->
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
                    <!-- ========================================== SECTION – HERO ========================================= -->

                    {{-- <div id="category" class="category-carousel hidden-xs">
                        <div class="item">
                            <div class="image"> <img src="assets/images/banners/cat-banner-1.jpg" alt=""
                                    class="img-responsive"> </div>
                            <div class="container-fluid">
                                <div class="caption vertical-top text-left">
                                    <div class="big-text"> Big Sale </div>
                                    <div class="excerpt hidden-sm hidden-md"> Save up to 49% off </div>
                                    <div class="excerpt-normal hidden-sm hidden-md"> Lorem ipsum dolor sit amet,
                                        consectetur
                                        adipiscing elit </div>
                                </div>
                                <!-- /.caption -->
                            </div>
                            <!-- /.container-fluid -->
                        </div>
                    </div> --}}


                    <div class="clearfix filters-container m-t-10">
                        <h4> {{ count($products) }} </span>products </h4>
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
                                <div class="col col-sm-3 col-md-6 no-padding">
                                    <div class="lbl-cnt"> <span class="lbl">Sort by</span>
                                        <div class="fld inline">
                                            <div class="dropdown dropdown-small dropdown-med dropdown-white inline">
                                                <button data-toggle="dropdown" type="button"
                                                    class="btn dropdown-toggle">
                                                    Position <span class="caret"></span> </button>
                                                <ul role="menu" class="dropdown-menu">
                                                    <li role="presentation"><a href="#">position</a></li>
                                                    <li role="presentation"><a href="#">Price:Lowest first</a>
                                                    </li>
                                                    <li role="presentation"><a href="#">Price:HIghest first</a>
                                                    </li>
                                                    <li role="presentation"><a href="#">Product Name:A to Z</a>
                                                    </li>
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
                                                <button data-toggle="dropdown" type="button"
                                                    class="btn dropdown-toggle"> 1
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
                                </div>

                                <!-- /.col -->
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
                                    <div class="row">
                                        @foreach ($products as $item)
                                        <div class="col-sm-6 col-md-4 wow fadeInUp" style="    height: 422px;">
                                            <div class="products">
                                                <div class="product">
                                                    <div class="product-image">
                                                        <div class="image"> <a
                                                                href="{{ url('product/details/'.$item->id.'/'.$item->product_slug_en ) }}"><img
                                                                    src="{{asset($item->product_thambnail)}}"
                                                                    alt=""></a>
                                                        </div>
                                                        <!-- /.image -->

                                                        @php
                                                        $amount = $item->selling_price - $item->discount_price;
                                                        $discount = ($amount/ $item->selling_price)*100;
                                                        @endphp
                                                        @if ($item->discount_price == NULL)
                                                        <div class="tag new"><span>new</span></div>
                                                        @else
                                                        <div class="tag sale"><span>{{round($discount)}}%</span>
                                                        </div>

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
                                                                            class="fa fa-shopping-cart"></i>
                                                                    </button>
                                                                    <button class="btn btn-primary cart-btn"
                                                                        type="button">Add to cart</button>
                                                                </li>
                                                                <li class="lnk wishlist"> <a class="add-to-cart"
                                                                        href="detail.html" title="Wishlist"> <i
                                                                            class="icon fa fa-heart"></i> </a>
                                                                </li>
                                                                <li class="lnk"> <a class="add-to-cart"
                                                                        href="detail.html" title="Compare"> <i
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
                                                                    src="{{asset($item->product_thambnail)}}" alt="">
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
                                                                                type="button">Add to
                                                                                cart</button>
                                                                        </li>
                                                                        <li class="lnk wishlist"> <a class="add-to-cart"
                                                                                href="detail.html" title="Wishlist">
                                                                                <i class="icon fa fa-heart"></i>
                                                                            </a>
                                                                        </li>
                                                                        <li class="lnk"> <a class="add-to-cart"
                                                                                href="detail.html" title="Compare">
                                                                                <i class="fa fa-signal"></i>
                                                                            </a> </li>
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

                        <!-- /.tab-content -->
                        {{-- new idea custom pagination video 644--}}
                        {{-- new idea appends ($_GET) to make the url hold the filtered categories video 468
                        --}}
                        {{ $products->appends($_GET)->links('vendor.pagination.custom') }}

                    </div>
                    <!-- /.search-result-container -->

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <!-- ============================================== BRANDS CAROUSEL ============================================== -->
            @include('frontend.body.brand')

            <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->

        </form>
    </div>
    <!-- /.container -->

</div>
<!-- /.body-content -->
@endsection