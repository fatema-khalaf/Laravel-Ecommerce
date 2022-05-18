@extends('admin.admin_master')
@section('admin')
<!-- Content Wrapper. Contains page content -->
<div class="container-full">
    <!-- Content Header (Page header) -->
    <x-address title='Manage Reviews' route='admin/dashboard' page='Published Reviews'
        subpage='All Published Reviews' />
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Published Reviews</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Product</th>
                                        <th>Summary </th>
                                        <th>comment </th>
                                        <th>Status </th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($reviews as $item)
                                    <tr>
                                        <td> {{ $item->user->name }} </td>
                                        <td> {{ $item->product->product_name_en }} </td>
                                        <td> ${{ $item->summary }} </td>
                                        <td> {{ $item->comment }} </td>
                                        <td>
                                            <span class="badge badge-pill badge-primary">Published </span>
                                        </td>
                                        <td width="25%">
                                            <a href="{{ route('review.delete',$item->id) }}" class="btn btn-danger"
                                                title="Delete Review" id="delete">
                                                Delete</a>
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