@extends('frontend.main_master')
@section('content')
@section('title')
{{$product->product_name_en}}
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

                @if (session()->get('language') == 'arabic')
                <li><a href="#">
                        {{$product['category']['category_name_ar']}}</a></li>
                @else
                <li><a href="#">
                        {{$product['category']['category_name_en']}}</a></li>
                @endif
                <li class="active">
                    @if (session()->get('language') == 'arabic')
                    {{$product->product_name_ar}}
                    @else
                    {{$product->product_name_en}}
                    @endif</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div>

<div class="body-content outer-top-xs">
    <div class="container">
        <div class="row single-product">
            <div class="col-md-3 sidebar">
                <div class="sidebar-module-container">

                    <!-- ============================================== HOT DEALS ============================================== -->
                    @include('frontend.common.hot_deals')

                    <!-- ============================================== HOT DEALS: END ============================================== -->

                    <!-- ============================================== NEWSLETTER ============================================== -->
                    <div class="sidebar-widget newsletter wow fadeInUp outer-bottom-small outer-top-vs animated"
                        style="visibility: visible; animation-name: fadeInUp;">
                        <h3 class="section-title">Newsletters</h3>
                        <div class="sidebar-widget-body outer-top-xs">
                            <p>Sign Up for Our Newsletter!</p>
                            <form>
                                <div class="form-group">
                                    <label class="sr-only" for="exampleInputEmail1">Email address</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1"
                                        placeholder="Subscribe to our newsletter">
                                </div>
                                <button class="btn btn-primary">Subscribe</button>
                            </form>
                        </div><!-- /.sidebar-widget-body -->
                    </div><!-- /.sidebar-widget -->
                    <!-- ============================================== NEWSLETTER: END ============================================== -->

                    <!-- ============================================== Testimonials============================================== -->
                    <div class="sidebar-widget  wow fadeInUp outer-top-vs  animated"
                        style="visibility: visible; animation-name: fadeInUp;">
                        <div id="advertisement" class="advertisement owl-carousel owl-theme"
                            style="opacity: 1; display: block;">
                            <div class="owl-wrapper-outer">
                                <div class="owl-wrapper"
                                    style="width: 1338px; left: 0px; display: block; transition: all 0ms ease 0s; transform: translate3d(0px, 0px, 0px);">
                                    <div class="owl-item" style="width: 223px;">
                                        <div class="item">
                                            <div class="avatar"><img src="assets/images/testimonials/member1.png"
                                                    alt="Image"></div>
                                            <div class="testimonials"><em>"</em> Vtae sodales aliq uam morbi non sem
                                                lacus port mollis. Nunc condime tum metus eud molest sed
                                                consectetuer.<em>"</em></div>
                                            <div class="clients_author">John Doe <span>Abc Company</span> </div>
                                            <!-- /.container-fluid -->
                                        </div>
                                    </div>
                                    <div class="owl-item" style="width: 223px;">
                                        <div class="item">
                                            <div class="avatar"><img src="assets/images/testimonials/member3.png"
                                                    alt="Image"></div>
                                            <div class="testimonials"><em>"</em>Vtae sodales aliq uam morbi non sem
                                                lacus port mollis. Nunc condime tum metus eud molest sed
                                                consectetuer.<em>"</em></div>
                                            <div class="clients_author">Stephen Doe <span>Xperia Designs</span> </div>
                                        </div>
                                    </div>
                                    <div class="owl-item" style="width: 223px;">
                                        <div class="item">
                                            <div class="avatar"><img src="assets/images/testimonials/member2.png"
                                                    alt="Image"></div>
                                            <div class="testimonials"><em>"</em> Vtae sodales aliq uam morbi non sem
                                                lacus port mollis. Nunc condime tum metus eud molest sed
                                                consectetuer.<em>"</em></div>
                                            <div class="clients_author">Saraha Smith <span>Datsun &amp; Co</span> </div>
                                            <!-- /.container-fluid -->
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /.item -->
                        </div><!-- /.owl-carousel -->
                    </div>

                    <!-- ============================================== Testimonials: END ============================================== -->



                </div>
            </div><!-- /.sidebar -->
            <div class="col-md-9">
                <div class="detail-block">
                    <div class="row  wow fadeInUp animated">

                        <div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
                            <div class="product-item-holder size-big single-product-gallery small-gallery">

                                <div id="owl-single-product">
                                    @foreach($multiImg as $img)
                                    <div class="single-product-gallery-item" id="slide{{$img->id}}">
                                        <a data-lightbox="image-1" data-title="Gallery"
                                            href="{{ asset($img->photo_name ) }} ">
                                            <img class="img-responsive" alt="" src="{{ asset($img->photo_name ) }} "
                                                data-echo="{{ asset($img->photo_name ) }} ">
                                        </a>
                                    </div>

                                    <!-- /.single-product-gallery-item -->
                                    @endforeach

                                </div><!-- /.single-product-slider -->


                                <div class="single-product-gallery-thumbs gallery-thumbs">

                                    <div id="owl-single-product-thumbnails">
                                        @foreach($multiImg as $img)

                                        <div class="item">
                                            <a class="horizontal-thumb active" data-target="#owl-single-product"
                                                data-slide="1" href="#slide{{$img->id}}">
                                                <img class="img-responsive" width="85" alt=""
                                                    src="{{ asset($img->photo_name ) }} ">
                                            </a>
                                        </div>
                                        @endforeach

                                    </div><!-- /#owl-single-product-thumbnails -->



                                </div><!-- /.gallery-thumbs -->

                            </div><!-- /.single-product-gallery -->
                        </div><!-- /.gallery-holder -->
                        <div class="col-sm-6 col-md-7 product-info-block">
                            <div class="product-info">
                                <h1 class="name" id='pname'>@if(session()->get('language') == 'arabic')
                                    {{$product->product_name_ar}}
                                    @else
                                    {{$product->product_name_en}}
                                    @endif</a></h1>

                                @php
                                $reviewcount =
                                App\Models\Review::where('product_id',$product->id)->where('status',1)->latest()->get();
                                $avarage =
                                App\Models\Review::where('product_id',$product->id)->where('status',1)->avg('rating');
                                @endphp

                                <div class="rating-reviews m-t-20">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            @if($avarage == 0)
                                            <span class="fa fa-star-o"></span>
                                            <span class="fa fa-star-o"></span>
                                            <span class="fa fa-star-o"></span>
                                            <span class="fa fa-star-o"></span>
                                            <span class="fa fa-star-o"></span>
                                            @else
                                            <span class="fa fa-star {{$avarage >= 1 ? 'checked' : ''}} "></span>
                                            <span class="fa fa-star {{$avarage >= 2 ? 'checked' : ''}}"></span>
                                            <span class="fa fa-star {{$avarage >= 3 ? 'checked' : ''}}"></span>
                                            <span class="fa fa-star {{$avarage >= 4 ? 'checked' : ''}}"></span>
                                            <span class="fa fa-star {{$avarage >= 5 ? 'checked' : ''}}"></span>
                                            @endif
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="reviews">
                                                <a href="#" class="lnk">({{ count($reviewcount) }} Reviews)</a>
                                            </div>
                                        </div>
                                    </div><!-- /.row -->
                                </div><!-- /.rating-reviews -->




                                <div class="stock-container info-container m-t-10">
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <div class="stock-box">
                                                <span class="label">Availability :</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="stock-box">
                                                <span class="value">In Stock</span>
                                            </div>
                                        </div>
                                    </div><!-- /.row -->
                                </div><!-- /.stock-container -->

                                <div class="description-container m-t-20">
                                    @if(session()->get('language') == 'arabic')
                                    {{$product->short_descp_ar}}
                                    @else
                                    {{$product->short_descp_en}}
                                    @endif</a>

                                </div><!-- /.description-container -->

                                <div class="price-container info-container m-t-20">
                                    <div class="row">
                                        @php
                                        $amount = $product->selling_price - $product->discount_price;
                                        $discount = ($amount/ $product->selling_price)*100;
                                        @endphp

                                        <div class="col-sm-6">
                                            <div class="price-box">
                                                @if ($product->discount_price == NULL)
                                                <span class="price">${{ $product->selling_price }}</span>
                                                @else
                                                <span class="price">${{ $product->discount_price }}</span>
                                                <span class="price-strike">${{ $product->selling_price }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="favorite-button m-t-10">
                                                <a class="btn btn-primary" data-toggle="tooltip" data-placement="right"
                                                    title="" href="#" data-original-title="Wishlist">
                                                    <i class="fa fa-heart"></i>
                                                </a>
                                                <a class="btn btn-primary" data-toggle="tooltip" data-placement="right"
                                                    title="" href="#" data-original-title="Add to Compare">
                                                    <i class="fa fa-signal"></i>
                                                </a>
                                                <a class="btn btn-primary" data-toggle="tooltip" data-placement="right"
                                                    title="" href="#" data-original-title="E-mail">
                                                    <i class="fa fa-envelope"></i>
                                                </a>
                                            </div>
                                        </div>


                                    </div><!-- /.row -->
                                    <!-- ====================================== color and size: START -->
                                    <div class="row">
                                        <div class="col-sm-6">
                                            @if ($product->product_color_en == Null)
                                            @else
                                            <div class="form-group">
                                                @if (session('language')=='arabic')
                                                <label class="info-title control-label">اختر اللون <span>
                                                    </span></label>
                                                <select class="form-control unicase-form-control selectpicker"
                                                    style="display: none;" id="color">
                                                    <option selected="" disabled="">--اختر اللون--</option>
                                                    @foreach($product_color_ar as $color)
                                                    <option value="{{ $color }}">{{ $color }}</option>
                                                    @endforeach
                                                </select>
                                                @else
                                                <label class="info-title control-label">Choose Color <span>
                                                    </span></label>
                                                <select class="form-control unicase-form-control selectpicker"
                                                    style="display: none;" id="color">
                                                    <option selected="" disabled="">--Choose Color--</option>
                                                    @foreach($product_color_en as $color)
                                                    <option value="{{ $color }}">{{ ucwords($color) }}</option>
                                                    @endforeach
                                                </select>
                                                @endif
                                            </div> <!-- // end form group -->
                                            @endif

                                        </div> <!-- // end col 6 -->
                                        <div class="col-sm-6">
                                            @if ($product->product_size_en == Null)
                                            @else
                                            <div class="form-group">
                                                @if (session('language')== 'arabic')

                                                <label class="info-title control-label">اختر القياس <span>
                                                    </span></label>
                                                <select class="form-control unicase-form-control selectpicker"
                                                    style="display: none;" id="size">
                                                    <option selected="" disabled="">--اختر القياس--</option>
                                                    @foreach($product_size_ar as $size)
                                                    <option value="{{ $size }}">{{ $size }}</option>
                                                    @endforeach
                                                </select>
                                                @else
                                                <label class="info-title control-label">choose size <span>
                                                    </span></label>
                                                <select class="form-control unicase-form-control selectpicker"
                                                    style="display: none;" id="size">
                                                    <option selected="" disabled="">--choose size--</option>
                                                    @foreach($product_size_ar as $size)
                                                    <option value="{{ $size }}">{{ ucwords($size) }}</option>
                                                    @endforeach
                                                </select>

                                                @endif
                                            </div> <!-- // end form group -->
                                            @endif
                                        </div> <!-- // end col 6 -->
                                        <!-- ====================================== color and size: END -->
                                    </div><!-- /.row -->
                                </div><!-- /.price-container -->

                                <div class="quantity-container info-container">
                                    <div class="row">

                                        <div class="col-sm-2">
                                            <span class="label">Qty :</span>
                                        </div>

                                        <div class="col-sm-2">
                                            <div class="cart-quantity">
                                                <div class="quant-input">
                                                    <div class="arrows">
                                                        <div class="arrow plus gradient"><span class="ir"><i
                                                                    class="icon fa fa-sort-asc"></i></span></div>
                                                        <div class="arrow minus gradient"><span class="ir"><i
                                                                    class="icon fa fa-sort-desc"></i></span></div>
                                                    </div>
                                                    <input type="text" id='qty' min="1" value="1">
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" id="product_id" value="{{$product->id}}">
                                        <div class="col-sm-7">
                                            <button type="submit" onclick="addToCart()" class="btn btn-primary"><i
                                                    class="fa fa-shopping-cart inner-right-vs"></i>
                                                ADD TO CART</button>
                                        </div>


                                    </div><!-- /.row -->
                                </div><!-- /.quantity-container -->

                                {{-- new idea share buttons--}}

                                <!-- Go to www.addthis.com/dashboard to customize your tools -->
                                <p>Share this product on:</p>
                                <div class="addthis_inline_share_toolbox"></div>




                            </div><!-- /.product-info -->
                        </div><!-- /.col-sm-7 -->
                    </div><!-- /.row -->
                </div>

                <div class="product-tabs inner-bottom-xs  wow fadeInUp animated"
                    style="visibility: visible; animation-name: fadeInUp;">
                    <div class="row">
                        <div class="col-sm-3">
                            <ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
                                <li class="active"><a data-toggle="tab" href="#description">DESCRIPTION</a></li>
                                <li><a data-toggle="tab" href="#review">REVIEW</a></li>
                                <li><a data-toggle="tab" href="#tags">TAGS</a></li>
                            </ul><!-- /.nav-tabs #product-tabs -->
                        </div>
                        <div class="col-sm-9">

                            <div class="tab-content">

                                <div id="description" class="tab-pane in active">
                                    <div class="product-tab">
                                        <p class="text">

                                            @if(session()->get('language') == 'arabic')
                                            {{-- NEW idea to avoid display html tags on the website use 👇👇👇--}}
                                            {!!$product->long_descp_ar!!}
                                            @else
                                            {!!$product->long_descp_en!!}
                                            @endif
                                        </p>
                                    </div>
                                </div><!-- /.tab-pane -->

                                <div id="review" class="tab-pane">
                                    <div class="product-tab">

                                        <div class="product-reviews">
                                            <h4 class="title">Customer Reviews</h4>
                                            @php
                                            $reviews =
                                            App\Models\Review::where('product_id',$product->id)->latest()->get();
                                            @endphp
                                            {{-- <h4 class="title">There are no reviews yet, Please add the first!</h4>
                                            --}}
                                            <div class="reviews">
                                                @foreach($reviews as $item)
                                                @if($item->status == 0)
                                                @else
                                                <div class="review">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <img style="border-radius: 50%"
                                                                src="{{ (!empty($item->user->profile_photo_path))? url('upload/user_images/'.$item->user->profile_photo_path):url('upload/no_image.jpg') }}"
                                                                width="40px;" height="40px;"><b> {{
                                                                $item->user->name }}</b>
                                                            @if($item->rating == Null)
                                                            @else
                                                            <span
                                                                class="fa fa-star {{$item->rating >= 1 ? 'checked' : ''}} "></span>
                                                            <span
                                                                class="fa fa-star {{$item->rating >= 2 ? 'checked' : ''}}"></span>
                                                            <span
                                                                class="fa fa-star {{$item->rating >= 3 ? 'checked' : ''}}"></span>
                                                            <span
                                                                class="fa fa-star {{$item->rating >= 4 ? 'checked' : ''}}"></span>
                                                            <span
                                                                class="fa fa-star {{$item->rating >= 5 ? 'checked' : ''}}"></span>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-9">
                                                        </div>
                                                    </div> <!-- // end row -->
                                                    <div class="review-title"><span
                                                            class="summary">{{$item->summary}}</span><span
                                                            class="date"><i
                                                                class="fa fa-calendar"></i><span>{{Carbon\Carbon::parse($item->created_at)->diffForHumans()}}</span></span>
                                                    </div>
                                                    <div class="text">"{{$item->comment}}"</div>
                                                </div>
                                                @endif

                                                @endforeach
                                            </div><!-- /.reviews -->
                                        </div><!-- /.product-reviews -->



                                        <div class="product-add-review">

                                            <div class="review-form">
                                                @guest
                                                <p><b>To add a review you need to <a href="{{route('login')}}">Login</a>
                                                        first.</b></p>
                                                @else
                                                <h4 class="title">Write your own review</h4>
                                                <div class="form-container">
                                                    <form role="form" class="cnt-form" method="post"
                                                        action="{{route('add.review')}}">
                                                        @csrf
                                                        <input type="hidden" name="product_id" value="{{$product->id}}">
                                                        <input type="hidden" name="user_id" value="{{Auth::id()}}">

                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th class="cell-label">&nbsp;</th>
                                                                    <th>1star</th>
                                                                    <th>2stars</th>
                                                                    <th>3stars</th>
                                                                    <th>4stars</th>
                                                                    <th>5stars</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td class="cell-label">Quality</td>
                                                                    <td><input type="radio" name="rating" class="radio"
                                                                            value="1"></td>
                                                                    <td><input type="radio" name="rating" class="radio"
                                                                            value="2"></td>
                                                                    <td><input type="radio" name="rating" class="radio"
                                                                            value="3"></td>
                                                                    <td><input type="radio" name="rating" class="radio"
                                                                            value="4"></td>
                                                                    <td><input type="radio" name="rating" class="radio"
                                                                            value="5"></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>

                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="exampleInputSummary">Summary <span
                                                                            class="astk">*</span></label>
                                                                    <input type="text" class="form-control txt"
                                                                        id="exampleInputSummary" placeholder=""
                                                                        name="summary">
                                                                </div><!-- /.form-group -->
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="exampleInputReview">Review <span
                                                                            class="astk">*</span></label>
                                                                    <textarea class="form-control txt txt-review"
                                                                        id="exampleInputReview" rows="4" placeholder=""
                                                                        name="comment"></textarea>
                                                                </div><!-- /.form-group -->
                                                            </div>
                                                        </div><!-- /.row -->

                                                        <div class="action text-right">
                                                            <button class="btn btn-primary btn-upper"
                                                                type="submit">SUBMIT
                                                                REVIEW</button>
                                                        </div><!-- /.action -->

                                                    </form><!-- /.cnt-form -->
                                                </div><!-- /.form-container -->
                                                @endguest

                                            </div><!-- /.review-form -->

                                        </div><!-- /.product-add-review -->

                                    </div><!-- /.product-tab -->
                                </div><!-- /.tab-pane -->

                                <div id="tags" class="tab-pane">
                                    <div class="product-tag">

                                        <h4 class="title">Product Tags</h4>
                                        <form role="form" class="form-inline form-cnt">
                                            <div class="form-container">

                                                <div class="form-group">
                                                    <label for="exampleInputTag">Add Your Tags: </label>
                                                    <input type="email" id="exampleInputTag" class="form-control txt">


                                                </div>

                                                <button class="btn btn-upper btn-primary" type="submit">ADD
                                                    TAGS</button>
                                            </div><!-- /.form-container -->
                                        </form><!-- /.form-cnt -->

                                        <form role="form" class="form-inline form-cnt">
                                            <div class="form-group">
                                                <label>&nbsp;</label>
                                                <span class="text col-md-offset-3">Use spaces to separate tags. Use
                                                    single quotes (') for phrases.</span>
                                            </div>
                                        </form><!-- /.form-cnt -->

                                    </div><!-- /.product-tab -->
                                </div><!-- /.tab-pane -->

                            </div><!-- /.tab-content -->
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.product-tabs -->

                <!-- ============================================== Related PRODUCTS ============================================== -->
                <section class="section featured-product wow fadeInUp animated"
                    style="visibility: visible; animation-name: fadeInUp;">
                    <h3 class="section-title">
                        @if (session()->get('language') == 'arabic')
                        منتجات مماثلة
                        @else
                        Related products
                        @endif
                    </h3>
                    <div class="owl-carousel home-owl-carousel upsell-product custom-carousel owl-theme outer-top-xs"
                        style="opacity: 1; display: block;">

                        @foreach ($relatedProduct as $item)
                        <div class="item item-carousel">
                            <div class="products">
                                <div class="product">
                                    <div class="product-image">
                                        <div class="image">
                                            <a
                                                href="{{ url('product/details/'.$item->id.'/'.$item->product_slug_en ) }}"><img
                                                    src="{{asset($item->product_thambnail)}}" alt=""></a>
                                        </div><!-- /.image -->

                                        @php
                                        $amount = $item->selling_price - $item->discount_price;
                                        $discount = ($amount/ $item->selling_price)*100;
                                        @endphp
                                        @if ($item->discount_price == NULL)
                                        <div class="tag new"><span>new</span></div>
                                        @else
                                        <div class="tag hot"><span>{{round($discount)}}%</span></div>

                                        @endif
                                    </div><!-- /.product-image -->


                                    <div class="product-info text-left">
                                        <h3 class="name">
                                            <a
                                                href="{{ url('product/details/'.$item->id.'/'.$item->product_slug_en ) }}">
                                                @if (session()->get('language') == 'arabic')
                                                {{$item->product_name_ar}}
                                                @else
                                                {{$item->product_name_en}}
                                                @endif
                                            </a>
                                        </h3>
                                        <div class="rating rateit-small rateit"><button id="rateit-reset-6"
                                                data-role="none" class="rateit-reset" aria-label="reset rating"
                                                aria-controls="rateit-range-6" style="display: none;"></button>
                                            <div id="rateit-range-6" class="rateit-range" tabindex="0" role="slider"
                                                aria-label="rating" aria-owns="rateit-reset-6" aria-valuemin="0"
                                                aria-valuemax="5" aria-valuenow="4" aria-readonly="true"
                                                style="width: 70px; height: 14px;">
                                                <div class="rateit-selected" style="height: 14px; width: 56px;">
                                                </div>
                                                <div class="rateit-hover" style="height:14px"></div>
                                            </div>
                                        </div>
                                        <div class="description"></div>

                                        @if ($item->discount_price == NULL)
                                        <div class="product-price"> <span class="price">
                                                ${{$item->selling_price}} </span>
                                        </div>
                                        @else
                                        <div class="product-price"> <span class="price">
                                                ${{$item->discount_price}}
                                            </span>
                                            <span class="price-before-discount">$
                                                {{$item->selling_price}} </span>
                                        </div>
                                        @endif
                                        <!-- /.product-price -->

                                    </div><!-- /.product-info -->
                                    <div class="cart clearfix animate-effect">
                                        <div class="action">
                                            <ul class="list-unstyled">
                                                <li class="add-cart-button btn-group">
                                                    <button class="btn btn-primary icon" data-toggle="dropdown"
                                                        type="button">
                                                        <i class="fa fa-shopping-cart"></i>
                                                    </button>
                                                    <button class="btn btn-primary cart-btn" type="button">Add
                                                        to cart</button>

                                                </li>

                                                <li class="lnk wishlist">
                                                    <a class="add-to-cart" href="detail.html" title="Wishlist">
                                                        <i class="icon fa fa-heart"></i>
                                                    </a>
                                                </li>

                                                <li class="lnk">
                                                    <a class="add-to-cart" href="detail.html" title="Compare">
                                                        <i class="fa fa-signal"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div><!-- /.action -->
                                    </div><!-- /.cart -->
                                </div><!-- /.product -->

                            </div><!-- /.products -->
                        </div>
                        @endforeach
                        <!-- /.item -->
                        <div class="owl-controls clickable">
                            <div class="owl-buttons">
                                <div class="owl-prev"></div>
                                <div class="owl-next"></div>
                            </div>
                        </div>
                    </div><!-- /.home-owl-carousel -->
                </section><!-- /.section -->
                <!-- ============================================== RELATED PRODUCTS : END ============================================== -->

            </div><!-- /.col -->
            <div class="clearfix"></div>
        </div><!-- /.row -->

























        <!-- ==== ================== BRANDS CAROUSEL ============================================== -->
        <div id="brands-carousel" class="logo-slider wow fadeInUp animated"
            style="visibility: visible; animation-name: fadeInUp;">

            <div class="logo-slider-inner">
                <div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme"
                    style="opacity: 1; display: block;">
                    <div class="owl-wrapper-outer">
                        <div class="owl-wrapper"
                            style="width: 3800px; left: 0px; display: block; transition: all 0ms ease 0s; transform: translate3d(0px, 0px, 0px);">
                            <div class="owl-item" style="width: 190px;">
                                <div class="item m-t-15">
                                    <a href="#" class="image">
                                        <img src="assets/images/brands/brand1.png" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="owl-item" style="width: 190px;">
                                <div class="item m-t-10">
                                    <a href="#" class="image">
                                        <img src="assets/images/brands/brand2.png" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="owl-item" style="width: 190px;">
                                <div class="item">
                                    <a href="#" class="image">
                                        <img src="assets/images/brands/brand3.png" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="owl-item" style="width: 190px;">
                                <div class="item">
                                    <a href="#" class="image">
                                        <img src="assets/images/brands/brand4.png" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="owl-item" style="width: 190px;">
                                <div class="item">
                                    <a href="#" class="image">
                                        <img src="assets/images/brands/brand5.png" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="owl-item" style="width: 190px;">
                                <div class="item">
                                    <a href="#" class="image">
                                        <img src="assets/images/brands/brand6.png" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="owl-item" style="width: 190px;">
                                <div class="item">
                                    <a href="#" class="image">
                                        <img src="assets/images/brands/brand2.png" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="owl-item" style="width: 190px;">
                                <div class="item">
                                    <a href="#" class="image">
                                        <img src="assets/images/brands/brand4.png" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="owl-item" style="width: 190px;">
                                <div class="item">
                                    <a href="#" class="image">
                                        <img data-echo="assets/images/brands/brand1.png" src="assets/images/blank.gif"
                                            alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="owl-item" style="width: 190px;">
                                <div class="item">
                                    <a href="#" class="image">
                                        <img data-echo="assets/images/brands/brand5.png" src="assets/images/blank.gif"
                                            alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/.item-->

                    <!--/.item-->

                    <!--/.item-->

                    <!--/.item-->

                    <!--/.item-->

                    <!--/.item-->

                    <!--/.item-->

                    <!--/.item-->

                    <!--/.item-->

                    <!--/.item-->
                    <div class="owl-controls clickable">
                        <div class="owl-buttons">
                            <div class="owl-prev"></div>
                            <div class="owl-next"></div>
                        </div>
                    </div>
                </div><!-- /.owl-carousel #logo-slider -->
            </div><!-- /.logo-slider-inner -->

        </div><!-- /.logo-slider -->
        <!-- == = BRANDS CAROUSEL : END = -->
    </div><!-- /.container -->
</div>


{{-- new idea shar buttons --}}
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-6284db9d254f7cc9"></script>
{{-- <script>
    $('a.horizontal-thumb').click(function(e) {
        e.preventDefault();
        $('a.someclass').append(e.target);
        console.log(e.target);
    });
</script> --}}
@endsection