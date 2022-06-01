@extends('frontend.main_master')
@section('content')
@section('title')
shop
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                @if (session()->get('language') == 'arabic')
                <li><a href="{{url('/')}}">
                        الرئيسية</a></li>
                @else
                <li><a href="{{url('/')}}">
                        Home</a></li>
                @endif
            </ul>
            {{-- @endif --}}
        </div>
        <!-- /.breadcrumb-inner -->
    </div>
    <!-- /.container -->
</div>
<!-- /.breadcrumb -->
<div class="body-content outer-top-xs">
    <div class='container'>

        <div class='row'>
            <div class='col-md-3 sidebar'>
                @php
                // dd($products);
                @endphp
                <!-- ===== == TOP NAVIGATION ======= ==== -->
                @include('frontend.common.vertical_menu')
                <!-- = ==== TOP NAVIGATION : END === ===== -->
                <!-- ============================================== FILTER ============================================== -->
                @include('frontend.shop.filter')
                <!-- ============================================== FILTER ============================================== -->


                <!-- /.sidebar-filter -->
            </div>
            <!-- ============================================== PRODUCT TAGS ============================================== -->
            <div class="sidebar-module-container outer-bottom-xs ">
                @include('frontend.common.product_tags')
            </div>
            <!-- ============================================== NEWSLETTER: START ============================================== -->
            <div class="sidebar-module-container outer-bottom-xs ">
                @include('frontend.common.newsletter')
            </div>
            <!-- ============================================== NEWSLETTER: END ============================================== -->
            <!-- /.sidebar-module-container -->
        </div>
        <!-- /.sidebar -->
        <div class='col-md-9' id="all_product">
            <!-- ========================================== Products ========================================= -->

            @include('frontend.product.products')
            <!-- /.search-result-container -->

        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    <!-- ============================================== BRANDS CAROUSEL ============================================== -->
    @include('frontend.body.brand')

    <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->

</div>
<!-- /.container -->

</div>
<!-- /.body-content -->
<script>
    // disable price button when the user chek on any checkbox
    function dis(){
        $('#show').attr('disabled', true);
    }
</script>


var uno = [];
$('input[name="uno[]"]').each( function() {
uno.push(this.value);
});
and send it

$.ajax({
type: "POST",
url: "procesa.php",
data: {uno: uno}
})
$('input[name="status"]:checked').val()

<script>
    // $.ajaxSetup({
    //         headers:{
    //             'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
    //         }
    //     })
    function filter(){
        var min_price = $('#input-left').val();
        var max_price = $('#input-right').val();
        var categories = [];
        $('input[name="category[]"]:checked').each( function() {
            categories.push(this.value);
        });
        var brands = [];
        $('input[name="brand[]"]:checked').each( function() {
            brands.push(this.value);
        });
        var sort = $("#sort:checked").val();
        var paginate = $("#paginate:checked").val();
 console.log( categories);
      $.ajax({
        type: "post",
        dataType: 'json',
        url: "{{  url('/filter/ajax') }}",
        data: {        "_token": "{{ csrf_token() }}",

            max_price:max_price, min_price:min_price,categories: categories , brands:brands, paginate:paginate, sort:sort },
      })
      .done(function(data){
        //   if (data.grid_view == " " || data.list_view == " ") {
        //       return;
        //     }
        //     $('#grid_view_product').html(data.grid_view);
        //     $('#list_view_product').html(data.list_view);
          if (data.productlist == " " ) {
              return;
            }
            $('#all_product').html(data.productlist);
            // $('#list_view_product').html(data.list_view);
      })
      .fail(function(data){
        alert(data.responseJSON);
      })
    }
</script>

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