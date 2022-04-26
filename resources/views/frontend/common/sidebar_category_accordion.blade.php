@php
$categories = App\Models\Category::orderby('category_name_en','ASC')->get();
@endphp


<div class="sidebar-widget wow fadeInUp">
    <h3 class="section-title">shop by</h3>
    <div class="widget-header">
        <h4 class="widget-title">Category</h4>
    </div>
    <div class="sidebar-widget-body">
        @foreach ($categories as $item)
        <div class="accordion">
            <div class="accordion-group">
                <div class="accordion-heading"> <a href="#cat{{$item->id}}" data-toggle="collapse"
                        class="accordion-toggle collapsed">
                        @if(session('language') == 'arabic')
                        {{$item->category_name_ar}}
                        @else
                        {{$item->category_name_en}}
                        @endif
                    </a> </div>
                <!-- /.accordion-heading -->
                <div class="accordion-body collapse" id="cat{{$item->id}}" style="height: 0px;">
                    <div class="accordion-inner">
                        @php
                        $subcategories =
                        App\Models\Subcategory::where('category_id',$item->id)->orderBy('subcategory_name_en','ASC')->get();
                        @endphp
                        @foreach($subcategories as $item)
                        <ul>
                            <li><a href="{{ url('subcategory/product/'.$item->id.'/'.$item->subcategory_slug_en ) }}">
                                    @if(session('language') == 'arabic')
                                    {{$item->subcategory_name_ar}}
                                    @else
                                    {{$item->subcategory_name_en}}
                                    @endif</a></li>
                        </ul>
                        @endforeach
                    </div>
                    <!-- /.accordion-inner -->
                </div>
                <!-- /.accordion-body -->
            </div>
            <!-- /.accordion-group -->
        </div>
        <!-- /.accordion -->
        @endforeach
    </div>
    <!-- /.sidebar-widget-body -->
</div