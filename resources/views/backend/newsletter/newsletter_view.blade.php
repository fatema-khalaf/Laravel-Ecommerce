@extends('admin.admin_master')
@section('admin')
<div class="container-full">
    <x-address title='Manage Newsletter' route='admin/dashboard' page='Newsletter' subpage='All Suscribers' />
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Suscribers List</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <div id="example1_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="example1" class="table table-bordered table-striped dataTable"
                                            role="grid" aria-describedby="example1_info">
                                            <thead>
                                                <tr role="row">
                                                    <th class="sorting_asc" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1" aria-sort="ascending"
                                                        aria-label="Name: activate to sort column descending"
                                                        style="width: 144.63px;">Subscriber Email</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Age: activate to sort column ascending"
                                                        style="width: 100.7361px;">Status</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Age: activate to sort column ascending"
                                                        style="width: 100.7361px;">Subscribed on</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Age: activate to sort column ascending"
                                                        style="width: 100.7361px;">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($emails as $item)
                                                <tr role="row" class="odd">
                                                    <td class="sorting_1">{{$item->email}}</td>
                                                    <td>
                                                        @if ($item->status == 1 )
                                                        <span class="badge badge-pill badge-success">active</span>
                                                        @else
                                                        <span class="badge badge-pill badge-danger">inactive</span>
                                                        @endif
                                                    </td>
                                                    <td class="sorting_1">{{
                                                        Carbon\Carbon::parse($item->created_at)->format('D, d F
                                                        Y')}}</td>
                                                    <td>
                                                        <div style="display: flex; justify-content: space-evenly;">
                                                            @if ($item->status == 1)
                                                            <a href="{{route('subscriber.inactivate',$item->id)}}"
                                                                class="btn btn-danger" title="Inactivate">
                                                                <i class="fa fa-arrow-down"></i></a>
                                                            @else
                                                            <a href="{{route('subscriber.activate',$item->id)}}"
                                                                class="btn btn-success" title="Activate">
                                                                <i class="fa fa-arrow-up"></i></a>
                                                            @endif
                                                            <a id="delete"
                                                                href="{{route('subscriber.delete',$item->id)}}"
                                                                class="btn btn-danger" title="Delete"><i
                                                                    class="fa fa-trash"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </section>
</div>
@endsection