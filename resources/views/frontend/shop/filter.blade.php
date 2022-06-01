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
                                        value="{{ $category->category_slug_en }}" onchange="dis() ; this.form.submit()"
                                        @if(!empty($filterCat) && in_array($category->category_slug_en,$filterCat))
                                    checked @endif
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

            @include('frontend.shop.filterprice')

        </div>
        <!-- /.sidebar-widget-body -->
    </div>
    <!-- /.sidebar-widget -->
    <!-- ============================================== PRICE SILDER : END ============================================== -->


</div>

<script>

</script>