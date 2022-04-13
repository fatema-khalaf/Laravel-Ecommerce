@extends('admin.admin_master')
@section('admin')
<div class="container-full">
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">Manage Categories</h3>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}"><i
                                        class="mdi mdi-home-outline"></i></a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Categories</li>
                            <li class="breadcrumb-item active" aria-current="page">All Categories</li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Category</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="row">
            {{-- Edit category form --}}
            <div class="col-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit category</h3>
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
                                                <h5>category name English <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="category_name_en" class="form-control"
                                                        value="{{$category->category_name_en}}" required>
                                                    @error('category_name_en')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <h5>category name arabic <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="category_name_ar" class="form-control"
                                                        value="{{$category->category_name_ar}}" required>
                                                    @error('category_name_ar')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <h5>category image <span class="text-danger">*</span></h5>
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