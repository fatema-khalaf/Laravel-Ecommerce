@extends('admin.admin_master')
@section('admin')
<div class="container-full">
    <x-address title='Manage Coupons' route='admin/dashboard' page='Coupons' subpage='All Coupons' />
    <section class="content">
        <div class="row">
            <div class="col-8">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Coupons List</h3>
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
                                                        style="width: 144.63px;">Coupon Name</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Position: activate to sort column ascending"
                                                        style="width: 144.63px; ">Coupon Discount</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Office: activate to sort column ascending"
                                                        style="width: 104.016px;">Validity</th>
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
                                                @foreach ($coupons as $item)
                                                <tr role="row" class="odd">
                                                    <td class="sorting_1">{{$item->coupon_name}}</td>
                                                    <td>{{$item->coupon_discount}}%</td>
                                                    <td>{{ Carbon\Carbon::parse($item->coupon_validity)->format('D, d F
                                                        Y') }}
                                                    </td>
                                                    <td>
                                                        @if ($item->coupon_validity >= Carbon\Carbon::now()->
                                                        format('Y-m-d'))
                                                        <span class="badge badge-pill badge-success">Valid</span>
                                                        @else
                                                        <span class="badge badge-pill badge-danger">Invalid</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div style="display: flex; justify-content: space-evenly;">
                                                            <a href="{{route('coupon.edit',$item->id)}}"
                                                                class="btn btn-info" title="Edit"><i
                                                                    class="fa fa-pencil "></i></a>
                                                            <a id="delete" href="{{route('coupon.delete',$item->id)}}"
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
            {{-- Add coupon form --}}
            <div class="col-4">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add Coupon</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <div id="example1_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <form method="post" action="{{route('coupon.store')}}">
                                            @csrf
                                            <div class="form-group">
                                                <h5>Coupon name <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="coupon_name" class="form-control">
                                                    @error('coupon_name')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <h5>Coupon discount(%) <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="number" name="coupon_discount" class="form-control">
                                                    @error('coupon_discount')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <h5>Coupon validity date<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    {{-- new idea --}}
                                                    <input type="date" name="coupon_validity" class="form-control"
                                                        min="{{Carbon\Carbon::now()->format('Y-m-d')}}">
                                                    @error('coupon_validity')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="text-xs-right">
                                                <input type="submit" class="btn btn-rounded btn-primary mb-5"
                                                    value="Add">
                                            </div>
                                        </form>
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