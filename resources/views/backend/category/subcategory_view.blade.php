@extends('admin.admin_master')
@section('admin')
<div class="container-full">
    <x-address title='Manage Subcategories' route='admin/dashboard' page='Categories' subpage='All Subcategories' />
    <section class="content">
        <div class="row">
            <div class="col-8">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Subategory List</h3>
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
                                                        style="width: 144.63px;">Category</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Position: activate to sort column ascending"
                                                        style="width: 144.63px; ">Subcategory Name En</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Office: activate to sort column ascending"
                                                        style="width: 104.016px;">Subcategory Name Ar</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Age: activate to sort column ascending"
                                                        style="width: 100.7361px;">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($subcategories as $subcategory)
                                                <tr role="row" class="odd">
                                                    <td class="sorting_1">{{$subcategory->category_id}}</td>
                                                    <td class="sorting_1">{{$subcategory->subcategory_name_en}}</td>
                                                    <td>{{$subcategory->subcategory_name_ar}}</td>
                                                    <td>
                                                        <div style="display:flex;justify-content: space-evenly;">
                                                            <a href="{{route('subcategory.edit',$subcategory->id)}}"
                                                                class="btn btn-info" title="Edit"><i
                                                                    class="fa fa-pencil "></i></a>
                                                            <a id="delete"
                                                                href="{{route('subcategory.delete',$subcategory->id)}}"
                                                                class="btn btn-danger" title="Delete">
                                                                <i class="fa fa-trash"></i></a>
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
            {{-- Add category form --}}
            <div class="col-4">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add Subcategory</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <div id="example1_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <form method="post" action="{{route('subcategory.store')}}">
                                            @csrf
                                            <div class="form-group">
                                                <h5>Select Category<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="category_id" id="select" class="form-control">
                                                        <option value="" selected='' disabled=''>Select Category
                                                        </option>
                                                        @foreach ($categories as $item)
                                                        <option value='{{$item->id}}'>
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
                                                    <input type="text" name="subcategory_name_en" class="form-control">
                                                    @error('subcategory_name_en')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <h5>Subcategory name arabic <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="subcategory_name_ar" class="form-control">
                                                    @error('subcategory_name_ar')
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