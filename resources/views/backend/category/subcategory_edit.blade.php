@extends('admin.admin_master')
@section('admin')
<div class="container-full">
    <x-address title='Manage Subcategories' route='admin/dashboard' page='Categories' subpage='Update Subcategory' />
    <section class="content">
        <div class="row">
            {{-- Update subcategory form --}}
            <div class="col-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Update Subcategory</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <div id="example1_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <form method="post" action="{{route('subcategory.update')}}">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$subcategory->id}}">
                                            <div class="form-group">
                                                <h5>Select Category<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="category_id" id="select" class="form-control"
                                                        required>
                                                        <option value="" selected='' disabled=''>Select Category
                                                        </option>
                                                        @foreach ($categories as $item)
                                                        <option value='{{$item->id}}' {{$item->id ==
                                                            $subcategory->category_id? 'selected': ''}}>
                                                            {{$item->category_name_en}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('category_id')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <h5>Subcategory name English <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="subcategory_name_en"
                                                        value="{{$subcategory->subcategory_name_en}}"
                                                        class="form-control" required>
                                                    @error('subcategory_name_en')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <h5>Subcategory name arabic <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="subcategory_name_ar"
                                                        value="{{$subcategory->subcategory_name_ar}}"
                                                        class="form-control" required>
                                                    @error('subcategory_name_ar')
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