@extends('admin.admin_master')
@section('admin')
<div class="container-full">
    <x-address title='Manage Categories' route='admin/dashboard' page='Categories' subpage='Edit Category' />
    <section class="content">
        <div class="row">
            {{-- Edit category form --}}
            <div class="col-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Category</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <div id="example1_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <form method="post" action="{{route('category.update', $category->id)}}">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$category->id}}">
                                            <input type="hidden" name="old_image" value="{{$category->category_image}}">
                                            <div class="form-group">
                                                <h5>Category name English <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="category_name_en" class="form-control"
                                                        value="{{$category->category_name_en}}" required>
                                                    @error('category_name_en')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <h5>Category name arabic <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="category_name_ar" class="form-control"
                                                        value="{{$category->category_name_ar}}" required>
                                                    @error('category_name_ar')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <h5>Category icon <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="category_image" class="form-control"
                                                        value="{{$category->category_image}}" required>
                                                    @error('category_image')
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