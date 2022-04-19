@extends('admin.admin_master')
@section('admin')


<!-- Content Wrapper. Contains page content -->

<div class="container-full">
    <!-- Content Header (Page header) -->
    <x-address title='Manage Products' route='admin/dashboard' page='Products' subpage='All Products' />
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Product List</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Image </th>
                                        <th>Name English</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Discount</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $item)
                                    <tr>
                                        <td> <img src="{{ asset($item->product_thambnail) }}"
                                                style="width: 60px; height: 50px;"> </td>
                                        <td>{{ $item->product_name_en }}</td>
                                        <td>{{ $item->selling_price }}$</td>
                                        <td>{{ $item->product_qty }} items</td>
                                        <td>
                                            @if($item->discount_price == NULL)
                                            <span class="badge badge-pill badge-danger">No Discount</span>
                                            @else
                                            @php
                                            $amount = $item->selling_price - $item->discount_price;
                                            $discount = ($amount/$item->selling_price) * 100;
                                            @endphp
                                            <span class="badge badge-pill badge-danger">{{ round($discount) }} %</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->status == 1)
                                            <span class="badge badge-pill badge-success">Active</span>
                                            @else
                                            <span class="badge badge-pill badge-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{-- TODO: creat view page to display all product data --}}
                                            <a href="{{ route('product.edit',$item->id) }}" class="btn btn-primary"
                                                title="Product Details">
                                                <i class="fa fa-eye"></i></a>
                                            <a href="{{ route('product.edit',$item->id) }}" class="btn btn-info"
                                                title="Edit Data"><i class="fa fa-pencil"></i> </a>
                                            <a href="{{ route('product.delete',$item->id) }}" class="btn btn-danger"
                                                title="Delete Data" id="delete">
                                                <i class="fa fa-trash"></i></a>
                                            @if ($item->status == 1)
                                            <a href="{{ route('product.inactivate',$item->id) }}" class="btn btn-danger"
                                                title="Inactivate">
                                                <i class="fa fa-arrow-down"></i></a>
                                            @else
                                            <a href="{{ route('product.activate',$item->id) }}" class="btn btn-success"
                                                title="Activate">
                                                <i class="fa fa-arrow-up"></i></a>
                                            @endif
                                        </td>

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