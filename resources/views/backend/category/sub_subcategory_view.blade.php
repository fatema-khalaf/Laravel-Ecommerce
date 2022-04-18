@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="container-full">
    <x-address title='Manage Sub-subcategories' route='admin/dashboard' page='Categories'
        subpage='All Sub-subcategories' />
    <section class="content">
        <div class="row">
            <div class="col-8">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Sub-subategory List</h3>
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
                                                    <th class="sorting_asc" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1" aria-sort="ascending"
                                                        aria-label="Name: activate to sort column descending"
                                                        style="width: 144.63px;">Subcategory</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Position: activate to sort column ascending"
                                                        style="width: 144.63px; ">Sub-subcategory Name En</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Office: activate to sort column ascending"
                                                        style="width: 104.016px;">Sub-subcategory Name Ar</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Age: activate to sort column ascending"
                                                        style="width: 100.7361px;">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($subsubcategories as $subsubcategory)
                                                <tr role="row" class="odd">
                                                    <td class="sorting_1">
                                                        {{$subsubcategory['category']['category_name_en']}}</td>
                                                    <td class="sorting_1">
                                                        {{$subsubcategory['subcategory']['subcategory_name_en']}}</td>
                                                    <td class="sorting_1">{{$subsubcategory->subsubcategory_name_en}}
                                                    </td>
                                                    <td>{{$subsubcategory->subsubcategory_name_ar}}</td>
                                                    <td>
                                                        <div style="display:flex;justify-content: space-evenly;">
                                                            <a href="{{route('subsubcategory.edit',$subsubcategory->id)}}"
                                                                class="btn btn-info" title="Edit"><i
                                                                    class="fa fa-pencil "></i></a>
                                                            <a id="delete"
                                                                href="{{route('subsubcategory.delete',$subsubcategory->id)}}"
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
                        <h3 class="box-title">Add Sub-subcategory</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <div id="example1_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <form method="post" action="{{route('subsubcategory.store')}}">
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
                                                <h5>Select Subcategory<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="subcategory_id" id="select" class="form-control">
                                                        <option value="" selected='' disabled=''>Select Subcategory
                                                        </option>
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
                                                        class="form-control">
                                                    @error('subsubcategory_name_en')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <h5>Sub-subcategory name arabic <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="subsubcategory_name_ar"
                                                        class="form-control">
                                                    @error('subsubcategory_name_ar')
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

<script type="text/javascript">
    $(document).ready(function() {
      $('select[name="category_id"]').on('change', function(){
          var category_id = $(this).val();
          if(category_id) {
              $.ajax({
                  url: "{{  url('/category/subcategory/ajax') }}/"+category_id,
                  type:"GET",
                  dataType:"json",
                  success:function(data) {
                     var d =$('select[name="subcategory_id"]').empty();
                        $.each(data, function(key, value){
                            $('select[name="subcategory_id"]').append('<option value="'+ value.id +'">' + value.subcategory_name_en + '</option>');
                        });
                  },
              });
          } else {
              alert('danger');
          }
      });
  });
</script>

@endsection