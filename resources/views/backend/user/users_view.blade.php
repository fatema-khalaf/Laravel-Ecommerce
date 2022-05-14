@extends('admin.admin_master')
@section('admin')
<div class="container-full">
    <x-address title='Manage Users' route='admin/dashboard' page='Users' subpage='All Users' />

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Users List</h3>
                        <h4 class="box-title float-right">Total User: <span class="badge badge-pill
                            badge-danger"> {{ count ($users) }} </span> </h4>
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
                                                        style="width: 144.63px;">Image</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Position: activate to sort column ascending"
                                                        style="width: 144.63px;">Name</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Office: activate to sort column ascending"
                                                        style="width: 104.016px;">Email</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Office: activate to sort column ascending"
                                                        style="width: 104.016px;">Phone</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Office: activate to sort column ascending"
                                                        style="width: 104.016px;">Status</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Age: activate to sort column ascending"
                                                        style="width: 100.7361px;">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($users as $item)
                                                <tr role="row" class="odd">
                                                    <td><img src="{{(!empty($item->profile_photo_path))? url('upload/user_images/'.$item->profile_photo_path): url('upload/no_image.jpg')}}"
                                                            style="height: 70px; width:70px;">
                                                    </td>
                                                    <td class="sorting_1">{{$item->name}}</td>
                                                    <td>{{$item->email}}</td>
                                                    <td>{{$item->phone}}</td>
                                                    <td>
                                                        @if($item->UserIsOnline())
                                                        <span class="badge badge-pill badge-success">Active Now</span>
                                                        @else
                                                        {{-- new idea video 405--}}
                                                        <span
                                                            class="badge badge-pill badge-danger">{{Carbon\Carbon::parse($item->last_seen)->diffForHumans()}}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div style="display: flex;justify-content: space-evenly;">
                                                            <a href="#" class="btn btn-info" title="Edit"><i
                                                                    class="fa fa-pencil "></i></a>
                                                            <a id="delete" href="#" class="btn btn-danger"
                                                                title="Delete"><i class="fa fa-trash"></i></a>
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