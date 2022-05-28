@extends('frontend.main_master')
@section('content')
@section('title')
{{ $post->post_title_en }}
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
                <li class="active">
                    @if (session()->get('language') == 'arabic')
                    {{$post->post_title_ar}}
                    @else
                    {{$post->post_title_en}}
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
                    <div class="blog-post wow fadeInUp">
                        <img class="img-responsive" src="{{ asset($post->post_image) }}" alt="">
                        <h1>@if(session()->get('language') == 'arabic') {{ $post->post_title_ar }} @else {{
                            $post->post_title_en }} @endif</h1>
                        <span class="date-time">{{ Carbon\Carbon::parse($post->created_at)->diffForHumans()
                            }}</span>
                        <!-- Go to www.addthis.com/dashboard to customize your tools -->
                        <div class="addthis_inline_share_toolbox_dm8p"></div>
                        <p> @if(session()->get('language') == 'arabic') {!! $post->post_details_ar !!} @else {!!
                            $post->post_details_en !!} @endif
                        </p>
                        <div class="social-media">
                            <span>share post:</span>
                            <hr>
                            <!-- Go to www.addthis.com/dashboard to customize your tools -->
                            <div class="addthis_inline_share_toolbox_dm8p"></div>

                        </div>
                    </div>
                    <div class="blog-write-comment outer-bottom-xs outer-top-xs">
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Leave A Comment</h4>
                            </div>
                            <div class="col-md-4">
                                <form class="register-form" role="form">
                                    <div class="form-group">
                                        <label class="info-title" for="exampleInputName">Your Name
                                            <span>*</span></label>
                                        <input type="email" class="form-control unicase-form-control text-input"
                                            id="exampleInputName" placeholder="">
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-4">
                                <form class="register-form" role="form">
                                    <div class="form-group">
                                        <label class="info-title" for="exampleInputEmail1">Email Address
                                            <span>*</span></label>
                                        <input type="email" class="form-control unicase-form-control text-input"
                                            id="exampleInputEmail1" placeholder="">
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-4">
                                <form class="register-form" role="form">
                                    <div class="form-group">
                                        <label class="info-title" for="exampleInputTitle">Title <span>*</span></label>
                                        <input type="email" class="form-control unicase-form-control text-input"
                                            id="exampleInputTitle" placeholder="">
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-12">
                                <form class="register-form" role="form">
                                    <div class="form-group">
                                        <label class="info-title" for="exampleInputComments">Your Comments
                                            <span>*</span></label>
                                        <textarea class="form-control unicase-form-control"
                                            id="exampleInputComments"></textarea>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-12 outer-bottom-small m-t-20">
                                <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Submit
                                    Comment</button>
                            </div>
                        </div>
                    </div>
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
                        @include('frontend.blog.blog_tab_widget')

                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Share buttons --}}
    <!-- Go to www.addthis.com/dashboard to customize your tools -->
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-6284db9d254f7cc9"></script>

    @endsection