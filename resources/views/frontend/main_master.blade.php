<!DOCTYPE html>
@if (session()->get('language') == 'arabic')
<html lang="ar" dir="rtl">
@else
<html lang="en">
@endif
@php
$seo = App\Models\Seo::find(1);
Session::put('language', 'arabic');
@endphp

<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="title" content=" {{ $seo->meta_title }}">
    <meta name="description" content="{{ $seo->meta_description }}">
    {{-- wseet alert --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400&family=Noto+Kufi+Arabic:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    {{-- 👇new idea related to ajax script in the of this file --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- 👆👆👆👆--}}
    <meta name="author" content="{{ $seo->meta_author }}">
    <meta name="keywords" content="{{ $seo->meta_keyword }}">
    <meta name="robots" content="all">
    <!-- /// Google Analytics Code // -->
    <script>
        {{ $seo->google_analytics }}
    </script>
    <!-- /// Google Analytics Code // -->

    <title>@yield('title')</title>

    <!-- Bootstrap Core CSS -->
    {{--
    <link rel="stylesheet" href="{{asset('frontend/assets/css/bootstrap.min.css')}}"> --}}
    <link rel="stylesheet" href="{{asset('frontend/assets/css/bootstrap.css')}}">

    <!-- Customizable CSS -->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/main.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/blue.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/owl.transitions.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/rateit.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/bootstrap-select.min.css')}}">
    {{-- Note: add toster cdn --}}
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <!-- Icons/Glyphs -->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/font-awesome.css')}}">
    <link rel="icon" href=" {{asset('frontend/assets/images/fav-icon1.png')}}">

    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800'
        rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <script src="https://js.stripe.com/v3/"></script>

</head>
<style>
    .checked {
        color: orange;
    }
</style>

<body class="cnt-home">
    <!-- ============================================== HEADER ============================================== -->
    @include('frontend.body.header')
    <!-- ============================================== HEADER : END ============================================== -->
    @yield('content')
    <!-- /#top-banner-and-menu -->

    <!-- ============================================================= FOOTER ============================================================= -->
    @include('frontend.body.footer')
    <!-- ============================================================= FOOTER : END============================================================= -->

    <!-- For demo purposes – can be removed on production -->

    <!-- For demo purposes – can be removed on production : End -->

    <!-- JavaScripts placed at the end of the document so the pages load faster -->
    <script src="{{asset('frontend/assets/js/jquery-1.11.1.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/bootstrap-hover-dropdown.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/echo.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/jquery.easing-1.3.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/bootstrap-slider.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/jquery.rateit.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('frontend/assets/js/lightbox.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/wow.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/scripts.js')}}"></script>
    <script src="{{asset('frontend/assets/js/advance-search-options.js')}}"></script>
    {{-- NOTE: this script for errors messages --}}
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        @if(Session::has('message'))
  var type = "{{ Session::get('alert-type','info') }}"
  switch(type){
     case 'info':
     toastr.info(" {{ Session::get('message') }} ");
     break;
 
     case 'success':
     toastr.success(" {{ Session::get('message') }} ");
     break;
 
     case 'warning':
     toastr.warning(" {{ Session::get('message') }} ");
     break;
 
     case 'error':
     toastr.error(" {{ Session::get('message') }} ");
     break; 
  }
  @endif 
    </script>



    <!-- Add to Cart Product Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><strong><span id="pname"></span> </strong></h5>
                    <button id='closeModel' type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card" style="width: 18rem; margin: 0 auto;">
                                <img src=" " class="card-img-top" alt="..." style="height: 200px; width: 200px;"
                                    id="pimage">
                            </div>
                        </div><!-- // end col md -->
                        <div class="col-md-4">
                            <ul class="list-group">
                                <li class="list-group-item">Product Price: <strong class="text-danger">$<span
                                            id="pprice"></span></strong>
                                    <del id="oldprice">$</del>
                                </li>
                                <li class="list-group-item">Product Code: <strong id="pcode"></strong></li>
                                <li class="list-group-item">Category: <strong id="pcategory"></strong></li>
                                <li class="list-group-item">Brand: <strong id="pbrand"></strong></li>
                                <li class="list-group-item">Stock: <span class="badge badge-pill badge-success"
                                        id="aviable" style="background: green; color: white;"></span>
                                    <span class="badge badge-pill badge-danger" id="stockout"
                                        style="background: red; color: white;"></span>

                                </li>
                            </ul>
                        </div><!-- // end col md -->
                        <div class="col-md-4">

                            <div class="form-group" id="colorArea">
                                <label for="color">Choose Color</label>
                                <select class="form-control" id="color" name='color'>
                                </select>
                            </div>
                            <div class="form-group" id='sizeArea'>
                                <label for="size">Choose Size</label>
                                <select class="form-control" id="size" name='size'>
                                </select>
                            </div> <!-- // end form group -->

                            <div class="form-group">
                                <label for="qty">Quantity</label>
                                <input type="number" class="form-control" id="qty" value="1" min="1">
                            </div> <!-- // end form group -->
                            <input type="hidden" id='product_id' />
                            <button id="addToCart" type="submit" class="btn btn-primary mb-2" onclick="addToCart()">Add
                                to
                                Cart</button>
                        </div><!-- // end col md -->


                    </div> <!-- // end row -->
                </div> <!-- // end modal Body -->
            </div>
        </div>
    </div>
    <!-- End Add to Cart Product Modal -->
    {{-- New idea --}}
    <script type="text/javascript">
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        })
    // Start Product View with Modal 
    function productView(id){
        // alert(id)
        $.ajax({
            type: 'GET',
            url: '/product/view/modal/'+id,
            dataType:'json',
            success:function(data){
                $('#pname').text(data.product.product_name_en);
                $('#price').text(data.product.selling_price);
                $('#pcode').text(data.product.product_code);
                $('#pcategory').text(data.product.category.category_name_en);
                $('#pbrand').text(data.product.brand.brand_name_en);
                $('#pimage').attr('src','/'+data.product.product_thambnail)
                // Product id and quantity
                $('#product_id').val(id);
                $("#qty").attr({"max" : data.product.product_qty});
                $('#qty').val(1);
                // Product Price 
                if (data.product.discount_price == null) {
                    $('#pprice').text('');
                    $('#oldprice').text('');
                    $('#pprice').text(data.product.selling_price);
                }else{
                    $('#pprice').text(data.product.discount_price);
                    $('#oldprice').text(data.product.selling_price);
                } // end prodcut price 
                // Start Stock opiton
                if (data.product.product_qty > 0) {
                    $('#aviable').text('');
                    $('#stockout').text('');
                    $('#aviable').text('aviable');
                }else{
                    $('#addToCart').prop('disabled', true);
                    $('#qty').val(0);
                    $("#qty").attr({"min" : 0});
                    $('#aviable').text('');
                    $('#stockout').text('');
                    $('#stockout').text('stockout');
                } // end Stock Option 

                // color
                $('select[name="color"]').empty();        
                $.each(data.color,function(key,value){
                    $('select[name="color"]').append('<option value=" '+value+' ">'+value+' </option>')
                    if (data.color == "") {
                        $('#colorArea').hide();
                    }else{
                        $('#colorArea').show();
                    }
                }) // end color
                // Size
                $('select[name="size"]').empty();        
                $.each(data.size,function(key,value){
                    $('select[name="size"]').append('<option value=" '+value+' ">'+value+' </option>')
                    if (data.size == "") {
                        $('#sizeArea').hide();
                    }else{
                        $('#sizeArea').show();
                    }
                }) // end size
            }
        })
    }

// End Product View Model

// Add to cart button
function addToCart(){
    var product_name = $('#pname').text();
    var id = $('#product_id').val();
    var color = $('#color option:selected').text();
    var size = $('#size option:selected').text();
    var quantity = $('#qty').val();
    $.ajax({
        type: 'POST',
        dataType:'json',
        data:{
            color:color,size:size,quantity:quantity,product_name:product_name
        },
        url: "/cart/data/store/"+id,
        success:function(data){
            $('#closeModel').click();
            miniCart(); // run this method to update cart items
            // console.log(data);
            // alert message
            // Start Message 
            const Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      icon: 'success',
                      showConfirmButton: false,
                      timer: 3000
                    })
            if ($.isEmptyObject(data.error)) {
                Toast.fire({
                    type: 'success',
                    title: data.success
                })
            }else{
                Toast.fire({
                    type: 'error',
                    title: data.error
                })
            }

        }
    })
}
// End add to cart button
    </script>
    {{-- new idea --}}
    {{-- view cart items --}}
    <script type="text/javascript">
        function miniCart(){
       $.ajax({
           type: 'GET',
           url: '/product/mini/cart',
           dataType:'json',
           success:function(response){
               $('span[id="cartSubTotal"]').text(response.cartTotal) //there are many spans with the same id -choose them all-
               $('#cartQty').text(response.cartQty) // only on span has cartQty id
               var miniCart = ''
               $.each(response.carts, function(key,value){
                miniCart +=`<div class="cart-item product-summary">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <div class="image"> <a href="detail.html"><img
                                                        src="/${value.options.image}" alt=""></a>
                                            </div>
                                        </div>
                                        <div class="col-xs-7">
                                            <h3 class="name"><a href="index.php?page-detail">${value.name}</a></h3>
                                            <div class="price">Quantity: ${value.qty}</div>
                                            <div class="price">Total: $${value.price * value.qty}</div>
                                        </div>
                                        <div class="col-xs-1 action"> 
                                            <!-- note: must use rowId not id -->
                                            <button type="submit" id="${value.rowId}" onclick="miniCartRemove(this.id)"><i class="fa fa-trash"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.cart-item -->
                                <div class="clearfix"></div>
                                <hr>`
               });
               $('#miniCart').html(miniCart);
           }
       })
    }
    miniCart();
// remove mini cart item
// mini cart remove Start 
 function miniCartRemove(rowId){
        $.ajax({
            type: 'GET',
            url: '/minicart/product-remove/'+rowId,
            dataType:'json',
            success:function(data){
            miniCart();
            mycart(); // update the items in my cart without the need to refresh the page
             // Start Message 
                const Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      icon: 'success',
                      showConfirmButton: false,
                      timer: 3000
                    })
                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        title: data.success
                    })
                }else{
                    Toast.fire({
                        type: 'error',
                        title: data.error
                    })
                }
                // End Message 
            }
        });
    }
 //  end mini cart remove 
    </script>

    <script type="text/javascript">
        // Add to wishlist 
        function AddToWishlist(product_id){
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url :'/add-to-wishlist/'+product_id,
                success:function(data) {
                     // Start Message 
                const Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      showConfirmButton: false,
                      timer: 3000
                    })
                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        icon: 'success',
                        type: 'success',
                        title: data.success
                    })
                }else{
                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error
                    })
                }
                // End Message
                }
            })
        }
    </script>
    {{-- new idea --}}
    {{-- view wishlist items --}}
    <script type="text/javascript">
        function wishlist(){
       $.ajax({
           type: 'GET',
           url: '/user/view-wishlist-products',
           dataType:'json',
           success:function(response){
               var rows = ''
               $.each(response, function(key,value){
                   //new idea
                rows +=`<tr>
                            <td class="col-md-2"><img src="/${value.product.product_thambnail}" alt="imga"></td>
                            <td class="col-md-7">
                                <div class="product-name"><a href="#">
                                    @if (session()->get('language') == 'arabic')
                                        ${value.product.product_name_ar}
                                        @else
                                        ${value.product.product_name_en}
                                        @endif
                                    </a></div>
                                <div class="price">
                                    ${value.product.discount_price == null
                            ? `${value.product.selling_price}`
                            :
                            `${value.product.discount_price} <span>${value.product.selling_price}</span>`
                        }
                                </div>
                            </td>
                            <td class="col-md-2">
                                <button class="btn btn-primary icon" type="button" title="Add Cart" data-toggle="modal" data-target="#exampleModal" id="${value.product_id}" onclick="productView(this.id)"> Add to Cart </button>
                            </td>
                            <td class="col-md-1 close-btn">
                                <button class="" type='submit' id="${value.id}" onclick='wishlistRemove(this.id)'><i class="fa fa-times"></i></button>
                            </td>
                        </tr>`
               });
               $('#wishlist').html(rows);
           }
       })
    }
    wishlist();
// remove wishlist item
 function wishlistRemove(id){
        $.ajax({
            type: 'GET',
            url: '/user/wishlist/product-remove/'+id,
            dataType:'json',
            success:function(data){
            wishlist();
             // Start Message 
                const Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      showConfirmButton: false,
                      timer: 3000
                    })
                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        icon: 'success',
                        type: 'success',
                        title: data.success
                    })
                }else{
                    Toast.fire({
                        icon: 'error',
                        type: 'error',
                        title: data.error
                    })
                }
                // End Message 
            }
        });
    }
 //  end wishlist remove
    </script>

    {{-- view mycart items --}}
    <script type="text/javascript">
        function mycart(){
       $.ajax({
           type: 'GET',
           url: '/view-my-cart-products',
           dataType:'json',
           success:function(response){
               var rows = ''
               $.each(response.carts, function(key,value){
                rows +=`<tr>
                            <td class="col-md-2"><img src="/${value.options.image}" alt="imga" style="width:60px; height:60px"></td>
                            <td class="col-md-3">
                                <div class="product-name"><a href="#">
                                        ${value.name}                       
                                    </a></div>
                                <div class="price">
                                ${value.price}
                                </div>
                            </td>
                            <td class="col-md-2">
                                ${value.options.color == null
                                    ?`
                                    <strong>-</strong>`
                                    :`
                                    <strong>${value.options.color}</strong>`
                                }
                            </td>
                            <td class="col-md-2">
                                ${value.options.size == null
                                    ?`<strong>-</strong>`
                                    :`<strong>${value.options.size}</strong>`
                                }
                            </td>
                            <td class="col-md-2">
                                ${value.qty > 1 
                                    ?`<button type="submit" class="btn btn-danger btn-sm" id="${value.rowId}" onclick='cartDecrement(this.id)'>-</button>`  
                                    :`<button disabled type="submit" class="btn btn-danger btn-sm" id="${value.rowId}" onclick='cartDecrement(this.id)'>-</button>`  
                                
                                }
                                <input type="text" value="${value.qty}" min="1" max="100" disabled="" style="width:25px;" >      
                                <button type="submit" class="btn btn-success btn-sm" id="${value.rowId}" onclick='cartIncrement(this.id)'>+</button>     
                            </td>
                            <td class="col-md-2">
                            <strong>$${value.subtotal} </strong> 
                            </td>
                           
                            <td class="col-md-1 close-btn">
                                <button class="" type='submit' id="${value.rowId}" onclick='mycartRemove(this.id)'><i class="fa fa-times"></i></button>
                            </td>
                        </tr>`
               });
               $('#mycart').html(rows);
           }
       })
    }
    mycart();
// remove mycart item
 function mycartRemove(id){
        $.ajax({
            type: 'GET',
            url: '/my-cart/product-remove/'+id,
            dataType:'json',
            success:function(data){
            mycart(); // update the items in my cart without the need to refresh the page
            miniCart(); // update the items in mini cart without the need to refresh the page
            couponCalculation();
            $('#couponField').show();
            $('#coupon_name').val('');

            // Start Message 
                const Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      showConfirmButton: false,
                      timer: 3000
                    })
                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        icon: 'success',
                        type: 'success',
                        title: data.success
                    })
                }else{
                    Toast.fire({
                        icon: 'error',
                        type: 'error',
                        title: data.error
                    })
                }
                // End Message 
            }
        });
    }
 //  end mycart remove

 // cart increment 
 function cartIncrement(rowId){
     $.ajax({
        type: 'GET',
        url: '/cart-increment/'+rowId,
        dataType:'json',
        success:function(data){
            mycart(); // update the items in my cart without the need to refresh the page
            miniCart(); // update the items in mini cart without the need to refresh the page
            couponCalculation();
        }
     });
 }

 // cart decrement 
 function cartDecrement(rowId){
     $.ajax({
        type: 'GET',
        url: '/cart-decrement/'+rowId,
        dataType:'json',
        success:function(data){
            mycart(); // update the items in my cart without the need to refresh the page
            miniCart(); // update the items in mini cart without the need to refresh the page
            couponCalculation();
        }
     });
 }
    </script>

    {{-- Cooupon apply --}}
    <script type='text/javascript'>
        function applyCoupon(){
            var coupon_name = $('#coupon_name').val();
            $.ajax({
                type:'POST',
                dataType: 'json',
                data: {coupon_name:coupon_name},
                url:'{{url('/coupon-apply')}}',
                success:function(data){
                    if(data.validity == true){
                        $('#couponField').hide();
                    }
                    couponCalculation();
                    const Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      showConfirmButton: false,
                      timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            icon: 'success',
                            type: 'success',
                            title: data.success
                        })
                    }else{
                        Toast.fire({
                            icon: 'error',
                            type: 'error',
                            title: data.error
                        })
                    }
                    // End Message 
                }
            })
        }

        function couponCalculation(){
            $.ajax({
                type:'GET',
                url: '{{url('/coupon-calculation')}}',
                dataType:'json',
                success:function(data){
                    if(data.total){
                        $('#couponCalField').html(
                            `<tr>
                                <th>
                                    <div class="cart-sub-total">
                                        Subtotal<span class="inner-left-md">$${data.total}</span>
                                    </div>
                                    <div class="cart-grand-total">
                                        Grand Total<span class="inner-left-md">$${data.total}</span>
                                    </div>
                                </th>
                            </tr>`
                        )
                    }else{
                        $('#couponCalField').html(
                            `<tr>
                                <th>
                                    <div class="cart-sub-total">
                                        Subtotal<span class="inner-left-md">$${data.subtotal}</span>
                                    </div>
                                    <div class="cart-sub-total">
                                        Coupon name<span class="inner-left-md">${data.coupon_name}</span>
                                        <button type='submit' onclick='couponRemove()'><i class='fa fa-times'></i> </button>
                                        </div>
                                    <div class="cart-sub-total">
                                        You Saved<span class="inner-left-md">$${data.discount_amount}</span>
                                    </div>
                                    <div class="cart-grand-total">
                                        Grand Total<span class="inner-left-md">$${data.total_amount}</span>
                                    </div>
                                </th>
                            </tr>`
                        )

                    }
                }
            });
        }
        couponCalculation();
        // remove coupon
        function couponRemove(){
            $.ajax({
                type: 'GET',
                url: "{{ url('/coupon-remove') }}",
                dataType: 'json',
                success:function(data){
                    couponCalculation();
                    $('#couponField').show();
                    $('#coupon_name').val('');
                    // Start Message 
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        
                        showConfirmButton: false,
                        timer: 3000
                        });
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: data.success
                        });
                    }else{
                        Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: data.error
                        });
                    }
                    // End Message 
                }
            });
        
        }
  
    </script>
</body>

</html>