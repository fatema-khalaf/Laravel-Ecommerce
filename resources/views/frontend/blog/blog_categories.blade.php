<div class="sidebar-widget outer-bottom-xs wow fadeInUp">
    <h3 class="section-title">Blog Category</h3>
    <div class="sidebar-widget-body m-t-10">
        <div class="accordion">
            <ul class="list-group">
                <li class="1ist-group-item">
                    <a href="{{url('/blog')}}">
                        @if (session()->get('language') == 'arabic')
                        كل الفئات
                        @else
                        All Categories
                        @endif
                    </a>
                    <hr>
                </li>
                @foreach($blogCategories as $item )
                <li class="1ist-group-item">
                    <a href="{{url('/blog/category/'.$item->id)}}">
                        @if (session()->get('language') == 'arabic')
                        {{$item->blog_category_name_ar}}
                        @else
                        {{$item->blog_category_name_en}}
                        @endif
                    </a>
                    <hr>
                </li>
                @endforeach
            </ul>
        </div><!-- /.accordion -->
    </div><!-- /.sidebar-widget-body -->
</div><!-- /.sidebar-widget -->