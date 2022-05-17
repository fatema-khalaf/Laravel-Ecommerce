@extends('admin.admin_master')
@section('admin')
<!-- Content Wrapper. Contains page content -->
<div class="container-full">
    <!-- Content Header (Page header) -->
    <x-address title='Manage Return Requests' route='admin/dashboard' page='Return Orders'
        subpage='All approved return requests' />
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Return Order Requsts</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Date </th>
                                        <th>Invoice </th>
                                        <th>Amount </th>
                                        <th>Payment </th>
                                        <th>Status </th>
                                        {{-- <th>Action</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $item)
                                    <tr>
                                        <td> {{ $item->order_date }} </td>
                                        <td> {{ $item->invoice_no }} </td>
                                        <td> ${{ $item->amount }} </td>
                                        <td> {{ $item->payment_type }} </td>
                                        <td>
                                            <span class="badge badge-pill badge-success">Success </span>
                                            {{-- @if ($item->return_order == 1)
                                            <span class="badge badge-pill badge-primary">Pending </span>
                                            @elseif($item->return_order == 2)
                                            @endif --}}
                                        </td>
                                        {{-- <td width="25%">
                                            <a href="{{ route('order.details',$item->id) }}" class="btn btn-info"
                                                title="Edit Data"><i class="fa fa-eye"></i> </a>
                                            <a href="{{ route('return.approve',$item->id) }}" class="btn btn-danger"
                                                title="Approve request">
                                                Approve</a>
                                        </td> --}}
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
@endsection