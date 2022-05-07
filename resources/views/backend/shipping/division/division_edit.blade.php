@extends('admin.admin_master')
@section('admin')
<div class="container-full">
    <x-address title='Manage Divisions' route='admin/dashboard' page='Divisions' subpage='All Divisions' />
    <section class="content">
        <div class="row">
            {{-- Edit division form --}}
            <div class="col-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Division</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <div id="example1_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <form method="post" action="{{route('division.update', $division->id)}}">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$division->id}}">
                                            <div class="form-group">
                                                <h5>Division name <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="division_name" class="form-control"
                                                        value="{{$division->division_name}}" required>
                                                    @error('division_name')
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