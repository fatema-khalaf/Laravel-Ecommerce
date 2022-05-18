@extends('admin.admin_master')
@section('admin')

@php
// new idea
$date= date('d-m-y'); // today's date
$today = App\Models\Order::where('order_date' , $date)->sum('amount');
$month= date('F'); // current month
$month_sales = App\Models\Order::where('order_month' , $month)->sum('amount');
$year= date('Y'); // current year
$year_sales = App\Models\Order::where('order_year' , $year)->sum('amount');
$pending = App\Models\Order :: where('status','pending')->get();

@endphp
<div class="container-full">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xl-3 col-6">
                <div class="box overflow-hidden pull-up">
                    <div class="box-body">
                        <div class="icon bg-primary-light rounded w-60 h-60">
                            <i class="text-primary mr-0 font-size-24 mdi mdi-account-multiple"></i>
                        </div>
                        <div>
                            <p class="text-mute mt-20 mb-0 font-size-16">Today's sales</p>
                            <h3 class=" mb-0 font-weight-500">${{$today}} <small class="text-success"><i
                                        class="fa fa-caret-up"></i> USD</small></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-6">
                <div class="box overflow-hidden pull-up">
                    <div class="box-body">
                        <div class="icon bg-warning-light rounded w-60 h-60">
                            <i class="text-warning mr-0 font-size-24 mdi mdi-car"></i>
                        </div>
                        <div>
                            <p class="text-mute mt-20 mb-0 font-size-16">Monthly sales</p>
                            <h3 class=" mb-0 font-weight-500">${{$month_sales}} <small class="text-success"><i
                                        class="fa fa-caret-up"></i> USD</small></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-6">
                <div class="box overflow-hidden pull-up">
                    <div class="box-body">
                        <div class="icon bg-info-light rounded w-60 h-60">
                            <i class="text-info mr-0 font-size-24 mdi mdi-sale"></i>
                        </div>
                        <div>
                            <p class="text-mute mt-20 mb-0 font-size-16">This Year's sales</p>
                            <h3 class=" mb-0 font-weight-500">${{$year_sales}} <small class="text-danger"><i
                                        class="fa fa-caret-down"></i> USD</small></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-6">
                <div class="box overflow-hidden pull-up">
                    <div class="box-body">
                        <div class="icon bg-danger-light rounded w-60 h-60">
                            <i class="text-danger mr-0 font-size-24 mdi mdi-phone-incoming"></i>
                        </div>
                        <div>
                            <p class="text-mute mt-20 mb-0 font-size-16">Pending Orders</p>
                            <h3 class=" mb-0 font-weight-500">{{count($pending)}} <small class="text-danger"><i
                                        class="fa fa-caret-up"></i> orders</small></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title align-items-start flex-column">
                            All Recent Orders </h4>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table no-border">
                                <thead>
                                    <tr class="text-uppercase bg-lightest">
                                        <th style="min-width: 250px"><span class="">date</span></th>
                                        <th style="min-width: 100px"><span class="text-fade">amount</span></th>
                                        <th style="min-width: 100px"><span class="text-fade">paymanet</span></th>
                                        <th style="min-width: 130px"><span class="text-fade">status</span></th>
                                        <th style="min-width: 120px">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pending as $item)
                                    <tr>
                                        <td>
                                            <span class=" font-weight-600 d-block font-size-16">
                                                {{Carbon\Carbon::parse($item->created_at)->diffForHumans()}} </span>
                                        </td>
                                        <td>
                                            <span class=" font-weight-600 d-block font-size-16">
                                                ${{$item->amount}} </span>
                                        </td>
                                        <td>
                                            <span class=" font-weight-600 d-block font-size-16">
                                                {{$item->payment_type}}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge badge-primary-light badge-lg">{{$item->status}}</span>
                                        </td>
                                        <td class="text-right">
                                            <a href="#"
                                                class="waves-effect waves-light btn btn-info btn-circle mx-5"><span
                                                    class="mdi mdi-bookmark-plus"></span></a>
                                            <a href="#"
                                                class="waves-effect waves-light btn btn-info btn-circle mx-5"><span
                                                    class="mdi mdi-arrow-right"></span></a>
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@endsection