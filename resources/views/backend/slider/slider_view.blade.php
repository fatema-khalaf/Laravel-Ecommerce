@extends('admin.admin_master')
@section('admin')
<div class="container-full">
    <x-address title='Manage Slider' route='admin/dashboard' page='Slider' subpage='All Slider' />

    <section class="content">
        <div class="row">
            <div class="col-8">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Slider List</h3>
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
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Office: activate to sort column ascending"
                                                        style="width: 104.016px;">Image</th>
                                                    <th class="sorting_asc" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1" aria-sort="ascending"
                                                        aria-label="Name: activate to sort column descending"
                                                        style="width: 144.63px;">Slider Title</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Position: activate to sort column ascending"
                                                        style="width: 144.63px;">Slider Description</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Office: activate to sort column ascending"
                                                        style="width: 104.016px;">Status</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Age: activate to sort column ascending"
                                                        style="width: 100.7361px;">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($sliders as $slider)
                                                <tr role="row" class="odd">
                                                    <td><img src="{{asset($slider->slider_img)}}"
                                                            style="height: 70px; width:70px;"></td>
                                                    <td class="sorting_1">
                                                        @if($slider->title == NULL)
                                                        <span class="badge badge-pill badge-danger"> No Title </span>
                                                        @else
                                                        {{ $slider->title }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($slider->description == NULL)
                                                        <span class="badge badge-pill badge-danger"> No Description
                                                        </span>
                                                        @else
                                                        {{ $slider->description }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($slider->status == 1)
                                                        <span class="badge badge-pill badge-success"> Active </span>
                                                        @else
                                                        <span class="badge badge-pill badge-danger"> InActive </span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div style="display: flex;justify-content: space-evenly;">
                                                            <a href="{{route('slider.edit',$slider->id)}}"
                                                                class="btn btn-info" title="Edit"><i
                                                                    class="fa fa-pencil "></i></a>
                                                            <a id="delete" href="{{route('slider.delete',$slider->id)}}"
                                                                class="btn btn-danger" title="Delete"><i
                                                                    class="fa fa-trash"></i></a>
                                                            @if ($slider->status == 1)
                                                            <a href="{{ route('slider.inactivate',$slider->id) }}"
                                                                class="btn btn-danger" title="Inactivate">
                                                                <i class="fa fa-arrow-down"></i></a>
                                                            @else
                                                            <a href="{{ route('slider.activate',$slider->id) }}"
                                                                class="btn btn-success" title="Activate">
                                                                <i class="fa fa-arrow-up"></i></a>
                                                            @endif

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
            {{-- Add Slider form --}}
            <div class="col-4">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add Slider</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <div id="example1_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <form method="post" action="{{route('slider.store')}}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <h5>Slider title</h5>
                                                <div class="controls">
                                                    <input type="text" name="title" class="form-control">
                                                    @error('slider_name_en')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <h5>Slider description</h5>
                                                <div class="controls">
                                                    <input type="text" name="description" class="form-control">
                                                    @error('slider_name_ar')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <h5>Slider image <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="file" name="slider_img" class="form-control">
                                                    @error('slider_img')
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