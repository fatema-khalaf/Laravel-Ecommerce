@extends('admin.admin_master')
@section('admin')
<div class="container-full">
    <x-address title='Manage Coupons' route='admin/dashboard' page='Coupons' subpage='All Coupons' />
    <section class="content">
        <div class="row">
            {{-- Edit coupon form --}}
            <div class="col-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Coupon</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <div id="example1_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <form method="post" action="{{route('coupon.update', $coupon->id)}}">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$coupon->id}}">
                                            <div class="form-group">
                                                <h5>Coupon name <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="coupon_name" class="form-control"
                                                        value="{{$coupon->coupon_name}}" required>
                                                    @error('coupon_name')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <h5>Coupon discount<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="number" name="coupon_discount" class="form-control"
                                                        value="{{$coupon->coupon_discount}}" required>
                                                    @error('coupon_discount')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <h5>Coupon validity date<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="date" name="coupon_validity" class="form-control"
                                                        min="{{Carbon\Carbon::now()->format('Y-m-d')}}"
                                                        value="{{$coupon->coupon_validity}}" required>
                                                    @error('coupon_validity')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="text-xs-right">
                                                <input type="submit" class="btn btn-rounded btn-primary mb-5"
                                                    value="Update">
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