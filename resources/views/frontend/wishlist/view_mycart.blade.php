@extends('frontend.main_master')
@section('content')

@section('title')
My Cart Page
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
                    عربة التسوق
                    @else
                    My Cart
                    @endif</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div>

<div class="body-content">
    <div class="container">
        <div class="row">
            <div class="shopping-cart">
                <div class="shopping-cart-table">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th colspan="4" class="heading-title">
                                        @if (session()->get('language') == 'arabic')
                                        عربة التسوق الخاصة بي
                                        @else
                                        My Cart
                                        @endif
                                    </th>
                                </tr>
                                <tr>
                                    <th class="cart-romove item">Image</th>
                                    <th class="cart-description item">Name</th>
                                    <th class="cart-product-name item">Color</th>
                                    <th class="cart-edit item">Size</th>
                                    <th class="cart-qty item">Quantity</th>
                                    <th class="cart-sub-total item">Subtotal</th>
                                    <th class="cart-total last-item">Remove</th>
                                </tr>
                            </thead>
                            <tbody id="mycart">
                            </tbody>
                        </table>
                    </div>
                </div>


                <div class="col-md-4 col-sm-12 estimate-ship-tax">
                </div>
                {{-- =================================== APPLY COUPON: START =======================================
                --}}
                @if (Session::has('coupon'))
                <div class="col-md-4 col-sm-12 estimate-ship-tax">
                </div>
                @else
                <div class="col-md-4 col-sm-12 estimate-ship-tax">
                    <table class="table" id='couponField'>
                        <thead>
                            <tr>
                                <th>
                                    <span class="estimate-title">Discount Code</span>
                                    <p>Enter your coupon code if you have one..</p>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <input type="text" class="form-control unicase-form-control text-input"
                                            placeholder="You Coupon.." id="coupon_name">
                                    </div>
                                    <div class="clearfix pull-right">
                                        <button type="submit" class="btn-upper btn btn-primary"
                                            onclick="applyCoupon()">APPLY
                                            COUPON</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody><!-- /tbody -->
                    </table><!-- /table -->
                </div><!-- /.estimate-ship-tax -->
                @endif

                {{-- =================================== APPLY COUPON: END ======================================= --}}

                <div class="col-md-4 col-sm-12 cart-shopping-total">
                    <table class="table">
                        <thead id='couponCalField'>

                        </thead><!-- /thead -->
                        <tbody>
                            <tr>
                                <td>
                                    <div class="cart-checkout-btn pull-right">
                                        <button type="submit" class="btn btn-primary checkout-btn">PROCCED TO
                                            CHEKOUT</button>

                                    </div>
                                </td>
                            </tr>
                        </tbody><!-- /tbody -->
                    </table><!-- /table -->
                </div><!-- /.cart-shopping-total -->

            </div><!-- /.row -->
        </div><!-- /.sigin-in-->



        <br>
        @include('frontend.body.brand')
    </div>







    @endsection