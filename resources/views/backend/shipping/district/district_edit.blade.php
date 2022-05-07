@extends('admin.admin_master')
@section('admin')
<div class="container-full">
    <x-address title='Manage Districts' route='admin/dashboard' page='Districts' subpage='All Districts' />
    <section class="content">
        <div class="row">
            {{-- Edit district form --}}
            <div class="col-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit District</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <div id="example1_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <form method="post" action="{{route('district.update', $district->id)}}">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$district->id}}">
                                            <div class="form-group">
                                                <h5>Division name <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="division_id" class="form-control">
                                                        <option value="" selected="" disabled="">Select Division
                                                        </option>
                                                        @foreach($divisions as $div)
                                                        <option value="{{ $div->id }}" {{$div->id ==
                                                            $district->division_id ? 'selected' : ''}}>{{
                                                            $div->division_name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    @error('division_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <h5>District name <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="district_name" class="form-control"
                                                        value="{{$district->district_name}}" required>
                                                    @error('district_name')
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