@extends('frontend.main_master')
@section('content')
@section('title')
Blog Posts
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
                @if (session()->get('language') == 'arabic')
                <li><a href="{{url('/blog')}}">
                        المدونة</a></li>
                @else
                <li><a href="{{url('/blog')}}">
                        Blog</a></li>
                @endif
                @if (isset($blogPosts[0]))
                @if (session()->get('language') == 'arabic')
                <li class="active">
                    {{$blogPosts[0]->BlogCategory->blog_category_name_ar}}</li>
                @else
                <li class="active">
                    {{$blogPosts[0]->BlogCategory->blog_category_name_en}}</li>
                @endif
                @endif
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

                    </div><!-- /.filters-container -->
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
                        <div class="sidebar-widget outer-bottom-xs wow fadeInUp">
                            <h3 class="section-title">Blog Category</h3>
                            <div class="sidebar-widget-body m-t-10">
                                <div class="accordion">
                                    <ul class="list-group">
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
                        <!-- ============================================== CATEGORY : END ============================================== -->
                        <div class="sidebar-widget outer-bottom-xs wow fadeInUp">
                            <h3 class="section-title">tab widget</h3>
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#popular" data-toggle="tab">popular post</a></li>
                                <li><a href="#recent" data-toggle="tab">recent post</a></li>
                            </ul>
                            <div class="tab-content" style="padding-left:0">
                                <div class="tab-pane active m-t-20" id="popular">
                                    <div class="blog-post inner-bottom-30 ">
                                        <img class="img-responsive" src="assets/images/blog-post/blog_big_01.jpg"
                                            alt="">
                                        <h4><a href="blog-details.html">Simple Blog Post</a></h4>
                                        <span class="review">6 Comments</span>
                                        <span class="date-time">12/06/16</span>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>

                                    </div>
                                    <div class="blog-post">
                                        <img class="img-responsive" src="assets/images/blog-post/blog_big_02.jpg"
                                            alt="">
                                        <h4><a href="blog-details.html">Simple Blog Post</a></h4>
                                        <span class="review">6 Comments</span>
                                        <span class="date-time">23/06/16</span>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>

                                    </div>
                                </div>

                                <div class="tab-pane m-t-20" id="recent">
                                    <div class="blog-post inner-bottom-30">
                                        <img class="img-responsive" src="assets/images/blog-post/blog_big_03.jpg"
                                            alt="">
                                        <h4><a href="blog-details.html">Simple Blog Post</a></h4>
                                        <span class="review">6 Comments</span>
                                        <span class="date-time">5/06/16</span>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>

                                    </div>
                                    <div class="blog-post">
                                        <img class="img-responsive" src="assets/images/blog-post/blog_big_01.jpg"
                                            alt="">
                                        <h4><a href="blog-details.html">Simple Blog Post</a></h4>
                                        <span class="review">6 Comments</span>
                                        <span class="date-time">10/07/16</span>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection