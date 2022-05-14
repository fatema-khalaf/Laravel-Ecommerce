@extends('admin.admin_master')
@section('admin')
<div class="container-full">
    <x-address title='Manage Blog' route='admin/dashboard' page='Blog Categories' subpage='All Categories' />
    <section class="content">
        <div class="row">
            <div class="col-8">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Blog Category List</h3>
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
                                                        style="width: 144.63px;">Blog Category Name En</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Position: activate to sort column ascending"
                                                        style="width: 144.63px; ">Blog Category Name Ar</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Age: activate to sort column ascending"
                                                        style="width: 100.7361px;">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($categories as $category)
                                                <tr role="row" class="odd">
                                                    <td class="sorting_1">{{$category->blog_category_name_en}}</td>
                                                    <td>{{$category->blog_category_name_ar}}</td>
                                                    </td>
                                                    <td>
                                                        <div style="display: flex;justify-content: space-evenly;">
                                                            <a href="{{route('blog.category.edit',$category->id)}}"
                                                                class="btn btn-info" title="Edit"><i
                                                                    class="fa fa-pencil "></i></a>
                                                            <a id="delete"
                                                                href="{{route('blog.category.delete',$category->id)}}"
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
            {{-- Add category form --}}
            <div class="col-4">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add Blog Category</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <div id="example1_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <form method="post" action="{{route('blog.category.store')}}">
                                            @csrf
                                            <div class="form-group">
                                                <h5>Blog Category name English <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="blog_category_name_en"
                                                        class="form-control">
                                                    @error('blog_category_name_en')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <h5>Blog Category name arabic <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="blog_category_name_ar"
                                                        class="form-control">
                                                    @error('blog_category_name_ar')
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