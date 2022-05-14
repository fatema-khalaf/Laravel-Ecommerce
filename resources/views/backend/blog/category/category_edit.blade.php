@extends('admin.admin_master')
@section('admin')
<div class="container-full">
    <x-address title='Manage Blog' route='admin/dashboard' page='Blog Categories' subpage='Edit Blog Category' />
    <section class="content">
        <div class="row">
            {{-- Edit category form --}}
            <div class="col-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Blog Category</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <div id="example1_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <form method="post" action="{{route('blog.category.update')}}">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$category->id}}">
                                            <div class="form-group">
                                                <h5>Blog Category name English <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="blog_category_name_en" class="form-control"
                                                        value="{{$category->blog_category_name_en}}" required>
                                                    @error('blog_category_name_en')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <h5>Blog Category name arabic <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="blog_category_name_ar" class="form-control"
                                                        value="{{$category->blog_category_name_ar}}" required>
                                                    @error('blog_category_name_ar')
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