@extends('admin.admin_master')
@section('admin')

<div class="container-full">
    <x-address title='Manage Sub-subcategories' route='admin/dashboard' page='Categories'
        subpage='All Sub-subcategories' />
    <section class="content">
        <div class="row">
            {{-- Edit sub sub-category form --}}
            <div class="col-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Sub-subcategory</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <div id="example1_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <form method="post" action="{{route('subsubcategory.update')}}">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$subsubcategory->id}}" />
                                            <div class="form-group">
                                                <h5>Select Category<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="category_id" id="select" class="form-control">
                                                        <option value="" selected='' disabled=''>Select Category
                                                        </option>
                                                        @foreach ($categories as $item)
                                                        <option value='{{$item->id}}' {{$item->id ==
                                                            $subsubcategory->category_id ? 'selected': ''}}>
                                                            {{$item->category_name_en}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('category_id')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <h5>Select Subcategory<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="subcategory_id" id="select" class="form-control">
                                                        <option value="" selected='' disabled=''>Select Subcategory
                                                        </option>
                                                        @foreach ($subcategories as $item)
                                                        <option value='{{$item->id}}' {{$item->id ==
                                                            $subsubcategory->subcategory_id ? 'selected': ''}}>
                                                            {{$item->subcategory_name_en}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('subcategory_id')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <h5>Sub-subcategory name English <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="subsubcategory_name_en"
                                                        class="form-control"
                                                        value="{{$subsubcategory->subsubcategory_name_en}}">
                                                    @error('subsubcategory_name_en')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <h5>Sub-subcategory name arabic <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="subsubcategory_name_ar"
                                                        class="form-control"
                                                        value="{{$subsubcategory->subsubcategory_name_ar}}">
                                                    @error('subsubcategory_name_ar')
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