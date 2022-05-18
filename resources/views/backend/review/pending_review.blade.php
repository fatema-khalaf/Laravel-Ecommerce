@extends('admin.admin_master')
@section('admin')
<!-- Content Wrapper. Contains page content -->
<div class="container-full">
    <!-- Content Header (Page header) -->
    <x-address title='Manage Reviews' route='admin/dashboard' page='Pending Reviews' subpage='All Pending Reviews' />
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Pending Reviews</h3>
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
                                            <span class="badge badge-pill badge-primary">Pending </span>
                                        </td>
                                        <td width="25%">
                                            <a href="{{ route('review.approve',$item->id) }}" class="btn btn-success"
                                                title="Publish review">
                                                publish</a>
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