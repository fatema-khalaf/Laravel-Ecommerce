@extends('frontend.main_master')
@section('content')
@section('title')
Blog Page
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
                <li class="active">
                    @if (session()->get('language') == 'arabic')
                    المدونة
                    @else
                    Blog
                    @endif</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div>

<div class="body-content">
    <div class="container">
        <div class="row">
            <div class="blog-page">
                <div class="col-md-9">

                    @foreach($blogPosts as $item)
                    <div class="blog-post  wow fadeInUp">
                        <a href="{{route('post.details',$item->id)}}"><img class="img-responsive"
                                src="{{asset($item->post_image)}}" alt=""></a>
                        <h1><a href="{{route('post.details',$item->id)}}">
                                @if (session()->get('language') == 'arabic')
                                {{$item->post_title_ar}}
                                @else
                                {{$item->post_title_en}}
                                @endif
                            </a></h1>
                        {{-- <span class="author">John Doe</span> --}}
                        {{-- <span class="review">6 Comments</span> --}}
                        <span class="date-time">
                            {{ $item->created_at}}
                            {{-- {{Carbon\Carbon::parse($item->created_at)->diffForHumen()}} --}}
                        </span>
                        <p>
                            {{-- new idea limit the long text --}}
                            @if (session()->get('language') == 'arabic')
                            {!! Str::limit($item->post_details_ar,600) !!}
                            @else
                            {!! Str::limit($item->post_details_en,600) !!}
                            @endif
                        </p>
                        <a href="{{route('post.details',$item->id)}}" class="btn btn-upper btn-primary read-more">read
                            more</a>
                    </div>
                    @endforeach
                    {{ $blogPosts->links('vendor.pagination.custom') }}
                    {{--
                    <div class="clearfix blog-pagination filters-container  wow fadeInUp"
                        style="padding:0px; background:none; box-shadow:none; margin-top:15px; border:none">

                        <div class="text-right">
                            <div class="pagination-container">
                                <ul class="list-inline list-unstyled">
                                    <li class="prev"><a href="#"><i class="fa fa-angle-left"></i></a></li>
                                    <li><a href="#">1</a></li>
                                    <li class="active"><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">4</a></li>
                                    <li class="next"><a href="#"><i class="fa fa-angle-right"></i></a></li>
                                </ul><!-- /.list-inline -->
                            </div><!-- /.pagination-container -->
                        </div><!-- /.text-right -->

                    </div><!-- /.filters-container --> --}}
                </div>
                <div class="col-md-3 sidebar">



                    <div class="sidebar-module-container">
                        <div class="search-area outer-bottom-small">
                            <form>
                                <div class="control-group">
                                    <input placeholder="Type to search" class="search-field">
                                    <a href="#" class="search-button"></a>
                                </div>
                            </form>
                        </div>

                        <!-- ==============================================CATEGORY============================================== -->
                        @include('frontend.blog.blog_categories')
                        <!-- ============================================== CATEGORY : END ============================================== -->
                        @include('frontend.blog.blog_tab_widget')
                    </div>
                </div>
            </div>
        </div>

    </div>


    @endsection