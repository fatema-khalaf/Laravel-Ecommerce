@extends('frontend.main_master')
@section('content')

@section('title')
Wish List Page
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
                    قائمة الرغبات
                    @else
                    Wishlist
                    @endif</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div>

<div class="body-content">
    <div class="container">
        <div class="my-wishlist-page">
            <div class="row">
                <div class="col-md-12 my-wishlist">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th colspan="4" class="heading-title">
                                        @if (session()->get('language') == 'arabic')
                                        قائمة الرغبات
                                        @else
                                        My Wishlist
                                        @endif
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="wishlist">
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