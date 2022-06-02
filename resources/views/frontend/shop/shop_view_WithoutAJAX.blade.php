@extends('frontend.main_master')
@section('content')
@section('title')
shop
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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

        <div class='row'>
            <div class='col-md-3 sidebar'>
                @php
                // dd($products);
                @endphp
                <!-- ===== == TOP NAVIGATION ======= ==== -->
                @include('frontend.common.vertical_menu')
                <!-- = ==== TOP NAVIGATION : END === ===== -->

                <div class="sidebar-module-container outer-bottom-xs">
                    <form id="cat" action="{{route('shop.filter')}}" method="post" onsubmit="dis()">
                        @csrf
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
                                                        onchange="dis() ; this.form.submit()" @if(!empty($filterCat) &&
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
                                                    onchange="dis() ;this.form.submit()">

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
                    </form>

                    <!-- ============================================== SIDEBAR CATEGORY : END ============================================== -->
                    {{-- @php
                    dd($minPrice);
                    @endphp --}}
                    <!-- ============================================== PRICE SILDER============================================== -->
                    <div class="sidebar-widget wow fadeInUp">
                        <div class="widget-header">
                            <h4 class="widget-title">Price Slider</h4>
                        </div>
                        <div class="sidebar-widget-body m-t-10">

                            @include('frontend.shop.priceSlider')

                        </div>
                        <!-- /.sidebar-widget-body -->
                    </div>
                    <!-- /.sidebar-widget -->
                    <!-- ============================================== PRICE SILDER : END ============================================== -->


                </div>
                <!-- /.sidebar-filter -->
            </div>
            <!-- ============================================== PRODUCT TAGS ============================================== -->
            <div class="sidebar-module-container outer-bottom-xs ">
                @include('frontend.common.product_tags')
            </div>
            <!-- ============================================== NEWSLETTER: START ============================================== -->
            <div class="sidebar-module-container outer-bottom-xs ">
                @include('frontend.common.newsletter')
            </div>
            <!-- ============================================== NEWSLETTER: END ============================================== -->
            <!-- /.sidebar-module-container -->
        </div>
        <!-- /.sidebar -->
        <div class='col-md-9'>
            <!-- ========================================== SECTION – HERO ========================================= -->

            {{-- <div id="category" class="category-carousel hidden-xs">
                <div class="item">
                    <div class="image"> <img src="assets/images/banners/cat-banner-1.jpg" alt="" class="img-responsive">
                    </div>
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
                <h4> {{ $priceProds->count() }} </span>products </h4>
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
                                        <button data-toggle="dropdown" type="button" class="btn dropdown-toggle">
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
                            <div class="row" id="grid_view_product">
                                @include('frontend.product.grid_view_product')
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
                            @include('frontend.product.list_view_product')
                        </div>

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

</div>
<!-- /.container -->

</div>
<!-- /.body-content -->
<script>
    // disable price button when the user chek on any checkbox
    function dis(){
        $('#show').attr('disabled', true);
    }
</script>
@endsection