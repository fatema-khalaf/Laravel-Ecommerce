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
            </div><!-- /.row -->
        </div><!-- /.sigin-in-->



        <br>
        @include('frontend.body.brand')
    </div>







    @endsection