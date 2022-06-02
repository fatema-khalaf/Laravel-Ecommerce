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

        {{-- {{$products->lastPage()}} --}}
        <div class='row'>
            <div class='col-md-3 sidebar'>
                @php
                // dd($products);
                @endphp
                <!-- ===== == TOP NAVIGATION ======= ==== -->
                @include('frontend.common.vertical_menu')
                <!-- = ==== TOP NAVIGATION : END === ===== -->
                <!-- ============================================== SIDE FILTER ============================================== -->
                @include('frontend.shop.filter')
                <!-- ============================================== SIDE FILTER ============================================== -->


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

        <!-- ========================================== PRODUCTS BOX ========================================= -->
        <div class='col-md-9'>
            {{-- NOTE: top filter should not be inside product.products as "product.products" rerended after each filter
            change --}}
            @include('frontend.shop.topfilter')
            <div class="search-result-container " id="all_product">
                @include('frontend.product.products')
            </div>
        </div>
        <!-- ========================================== PRODUCTS BOX : END ========================================= -->
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
    function filter(page){
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
      $.ajax({
        type: "post",
        dataType: 'json',
        url: "{{  url('/filter/ajax') }}",
        data: {       
            "_token": "{{ csrf_token() }}",
            page:page,
            max_price:max_price,
            min_price:min_price,
            categories: categories,
            brands:brands,
            paginate:paginate,
            sort:sort
            },
      })
      .done(function(data){
          if (data.productlist == " " ) {
              return;
            }
            $('#all_product').html(data.productlist); // update product.products page
      })
      .fail(function(data){
        alert('Some Thing Went Wrong!');
      })
    }
    // new idea:👇👇👇This is the solution to jaxa pagination links that dose not render the
    // result as it was view the source code instade so I create 
    // this function to update a tag href value to make request on the next page of ajax result
    // and re render the correct page 
    $(document).on('click', '.pagenate', function(event){
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
    filter(page);
 });
</script>

@endsection