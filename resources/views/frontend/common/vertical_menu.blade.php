@php
$categories = App\Models\Category::orderby('category_name_en','ASC')->get();
@endphp

<div class="side-menu animate-dropdown outer-bottom-xs">
    <div class="head"><i class="icon fa fa-align-justify fa-fw"></i>
        @if(session()->get('language')=='arabic') الفئات @else Categories
        @endif</div>
    <nav class="yamm megamenu-horizontal">
        <ul class="nav">
            @foreach ($categories as $item)

            <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                        class="icon {{$item->category_image}}" aria-hidden="true"></i>
                    @if (session()->get('language') == 'arabic')
                    {{$item->category_name_ar}}
                    @else
                    {{$item->category_name_en}}
                    @endif
                </a>
                <!-- ================================== MEGAMENU VERTICAL ================================== -->
                <ul class="dropdown-menu mega-menu">
                    <li class="yamm-content">
                        <h4><a href="{{url('shop/'.$item->id)}}"><i class="icon {{$item->category_image}}"
                                    aria-hidden="true"></i>
                                View All
                                @if (session()->get('language') == 'arabic')
                                {{$item->category_name_ar}}
                                @else
                                {{$item->category_name_en}}
                                @endif
                            </a></h4>
                        <hr>
                        <div class="row">
                            @php
                            $subcategories =
                            App\Models\Subcategory::where('category_id',$item->id)->orderBy('subcategory_name_en','ASC')->get();
                            @endphp
                            @foreach ($subcategories as $subcategory)
                            <div class="col-xs-12 col-sm-12 col-lg-4">
                                <a
                                    href="{{ url('subcategory/product/'.$subcategory->id.'/'.$subcategory->subcategory_slug_en ) }}">
                                    <h2 class="title">
                                        @if(session()->get('language') == 'arabic') {{ $subcategory->subcategory_name_ar
                                        }}
                                        @else {{ $subcategory->subcategory_name_en }} @endif
                                    </h2>
                                </a>
                                <!--   // Get SubSubCategory Table Data -->
                                @php
                                $subsubcategories =
                                App\Models\SubSubCategory::where('subcategory_id',$subcategory->id)->orderBy('subsubcategory_name_en','ASC')->get();
                                @endphp

                                @foreach($subsubcategories as $subsubcategory)
                                <ul class="links list-unstyled">
                                    <li><a
                                            href="{{ url('sub-subcategory/product/'.$subsubcategory->id.'/'.$subsubcategory->subsubcategory_slug_en ) }}">
                                            @if(session()->get('language') == 'arabic') {{
                                            $subsubcategory->subsubcategory_name_ar }} @else {{
                                            $subsubcategory->subsubcategory_name_en }} @endif</a></li>

                                </ul>
                                @endforeach
                                <!-- // End SubSubCategory Foreach -->


                                {{-- <ul>
                                    <li><a href="#">
                                            @if (session()->get('language') == 'arabic')
                                            {{$item->subcategory_name_ar}}
                                            @else
                                            {{$item->subcategory_name_en}}
                                            @endif
                                        </a></li>


                                </ul> --}}
                            </div>
                            @endforeach
                            {{-- <div class="dropdown-banner-holder"> <a href="#"><img alt=""
                                        src="{{asset('frontend/assets/images/banners/banner-side.png')}}" /></a>
                            </div> --}}
                        </div>
                        <!-- /.row -->
                    </li>
                    <!-- /.yamm-content -->
                </ul>
                <!-- /.dropdown-menu -->
                <!-- ================================== MEGAMENU VERTICAL ================================== -->
            </li>
            @endforeach
            <!-- End categories foreach -->

            <!-- /.menu-item -->

        </ul>
        <!-- /.nav -->
    </nav>
    <!-- /.megamenu-horizontal -->
</div>