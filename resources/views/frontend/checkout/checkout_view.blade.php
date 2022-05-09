@extends('frontend.main_master')
@section('content')

@section('title')
Checkout
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
                <li class="active">
                    @if (session()->get('language') == 'arabic')
                    الدفع
                    @else
                    Checkout
                    @endif</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div>


<div class="body-content">
    <div class="container">
        <div class="checkout-box ">
            <div class="row">
                <div class="col-md-8">
                    <div class="panel-group checkout-steps" id="accordion">
                        <!-- checkout-step-01  -->
                        <div class="panel panel-default checkout-step-01">

                            <!-- panel-heading -->

                            <!-- panel-heading -->

                            <div id="collapseOne" class="panel-collapse collapse in">

                                <!-- panel-body  -->
                                <div class="panel-body">
                                    <div class="row">

                                        <!-- Deleviry Details -->
                                        <h4 class="checkout-subtitle"><b>Delivery Details</b></h4>
                                        <hr>
                                        <div class="col-md-6 col-sm-6 already-registered-login">

                                            <form class="register-form" action="{{route('checkout.store')}}"
                                                method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <label class="info-title" for="exampleInputEmail1">Full Name
                                                        <span>*</span></label>
                                                    <input type="text" name="shipping_name"
                                                        class="form-control unicase-form-control text-input"
                                                        id="exampleInputEmail1" placeholder="Full name"
                                                        value="{{Auth::user()->name}}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="info-title" for="exampleInputEmail1">Email Address
                                                        <span>*</span></label>
                                                    <input type="Email" name="shipping_email"
                                                        class="form-control unicase-form-control text-input"
                                                        placeholder="Email" value="{{Auth::user()->email}}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="info-title" for="exampleInputEmail1">Phone Number
                                                        <span>*</span></label>
                                                    <input type="number" name="shipping_phone"
                                                        class="form-control unicase-form-control text-input"
                                                        placeholder="Phone number" value="{{Auth::user()->phone}}"
                                                        required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="info-title" for="exampleInputEmail1">Post Code
                                                        <span>*</span></label>
                                                    <input type="text" name="post_code"
                                                        class="form-control unicase-form-control text-input"
                                                        placeholder="Phone number" required>
                                                </div>

                                        </div>
                                        <div class="col-md-6 col-sm-6 already-registered-login">
                                            <div class="form-group">
                                                {{-- <h5>Select Division<span class="text-danger">*</span></h5> --}}
                                                <label class="info-title" for="exampleInputEmail1"
                                                    style="font-weight: normal;">
                                                    Select Division
                                                    <span style="color: red;">*</span>
                                                </label>
                                                <div class="controls">
                                                    <select name="division_id" id="select"
                                                        class="form-control unicase-form-control text-input">
                                                        <option value="" selected='' disabled=''>Select Division
                                                        </option>
                                                        @foreach ($divisions as $item)
                                                        <option value='{{$item->id}}'>
                                                            {{$item->division_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('division_id')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                {{-- <h5>Select District<span class="text-danger">*</span></h5> --}}
                                                <label class="info-title" for="exampleInputEmail1"
                                                    style="font-weight: normal;">
                                                    Select District
                                                    <span style="color: red;">*</span>
                                                </label>
                                                <div class="controls">
                                                    <select name="district_id" id="select"
                                                        class="form-control unicase-form-control text-input">
                                                        <option value="" selected='' disabled=''>Select District
                                                        </option>
                                                    </select>
                                                    @error('district_id')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                {{-- <h5>Select State<span class="text-danger">*</span></h5> --}}
                                                <label class="info-title" for="exampleInputEmail1"
                                                    style="font-weight: normal;">
                                                    Select State
                                                    <span style="color: red;">*</span>
                                                </label>
                                                <div class="controls">
                                                    <select name="state_id" id="select"
                                                        class="form-control unicase-form-control text-input">
                                                        <option value="" selected='' disabled=''>Select State
                                                        </option>
                                                    </select>
                                                    @error('state_id')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="info-title" for="exampleInputEmaill"
                                                    style="font-weight: normal;">Notes
                                                </label>
                                                <textarea class="form-control" cols="30" rows="5" placeholder="Notes"
                                                    name="notes"></textarea>
                                            </div>
                                            {{-- <button type="submit"
                                                class="btn-upper btn btn-primary checkout-page-button">Login</button>
                                            </form> --}}
                                        </div>
                                        <!-- Deleviry Details -->
                                    </div>
                                </div>
                                <!-- panel-body  -->
                            </div><!-- row -->
                        </div>
                        <!-- End checkout-step-01  -->
                    </div><!-- /.checkout-steps -->
                </div>

                <div class="col-md-4">
                    <!-- checkout-progress-sidebar -->
                    <div class="checkout-progress-sidebar ">
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">Your Checkout Progress</h4>
                                </div>
                                <div class="">
                                    <ul class="nav nav-checkout-progress list-unstyled">

                                        @foreach($carts as $item)
                                        <li>
                                            <strong>Image: </strong>
                                            <img src="{{ asset($item->options->image) }}"
                                                style="height: 50px; width: 50px;">
                                        </li>

                                        <li>
                                            <strong>Qty: </strong>
                                            ( {{ $item->qty }} )

                                            <strong>Color: </strong>
                                            {{ $item->options->color }}

                                            <strong>Size: </strong>
                                            {{ $item->options->size }}
                                        </li>
                                        @endforeach
                                        <hr>
                                        <li>
                                            @if(Session::has('coupon'))

                                            <strong>SubTotal: </strong> ${{ $cartTotal }}
                                            <hr>

                                            <strong>Coupon Name : </strong> {{ session()->get('coupon')['coupon_name']
                                            }}
                                            ( {{ session()->get('coupon')['coupon_discount'] }}% )
                                            <hr>

                                            <strong>Coupon Discount : </strong> ${{
                                            session()->get('coupon')['discount_amount'] }}
                                            <hr>

                                            <strong>Grand Total : </strong> ${{ session()->get('coupon')['total_amount']
                                            }}
                                            <hr>


                                            @else

                                            <strong>SubTotal: </strong> ${{ $cartTotal }}
                                            <hr>

                                            <strong>Grand Total : </strong> ${{ $cartTotal }}
                                            <hr>


                                            @endif

                                        </li>



                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- checkout-progress-sidebar -->

                    <!-- checkout-progress-sidebar -->
                    <div class="checkout-progress-sidebar ">
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">Select Payment Method</h4>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="">Stripe</label>
                                        <input type="radio" name="payment_method" value="stripe">
                                        <img src="{{ asset('frontend/assets/images/payments/4.png') }}">
                                    </div> <!-- end col md 4 -->

                                    <div class="col-md-4">
                                        <label for="">Card</label>
                                        <input type="radio" name="payment_method" value="card">
                                        <img src="{{ asset('frontend/assets/images/payments/3.png') }}">
                                    </div> <!-- end col md 4 -->

                                    <div class="col-md-4">
                                        <label for="">Cash</label>
                                        <input type="radio" name="payment_method" value="cash">
                                        <img src="{{ asset('frontend/assets/images/payments/2.png') }}">
                                    </div> <!-- end col md 4 -->


                                </div> <!-- // end row  -->
                                <hr>
                                <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Payment
                                    Step</button>


                            </div>
                        </div>
                    </div>
                    <!-- checkout-progress-sidebar -->







                    </form>
                </div>
            </div><!-- /.row -->
        </div><!-- /.checkout-box -->
    </div><!-- /.container -->
</div><!-- /.body-content -->

<script type="text/javascript">
    $(document).ready(function() {
      $('select[name="division_id"]').on('change', function(){
          var division_id = $(this).val();
          if(division_id) {
              $.ajax({
                  url: "{{  url('/division/district/ajax') }}/"+division_id,
                  type:"GET",
                  dataType:"json",
                  success:function(data) {
                      $('select[name="state_id"]').empty(); 
                     var d =$('select[name="district_id"]').empty();
                     $('select[name="district_id"]').append('<option value="" selected="" disabled="">Select District </option>');
                        $.each(data, function(key, value){
                            $('select[name="district_id"]').append('<option value="'+ value.id +'">' + value.district_name + '</option>');
                        });
                  },
              });
           } else {
              alert('danger');
          }
      });
        $('select[name="district_id"]').on('change', function(){

          var district_id = $(this).val();
          if(district_id) {
              $.ajax({
                  url: "{{ url('/district/state/ajax')  }}/"+district_id,
                  type:"GET",
                  dataType:"json",
                  success:function(data) {
                      console.log(data);
                     var d =$('select[name="state_id"]').empty();
                        $.each(data, function(key, value){
                            $('select[name="state_id"]').append('<option value="'+ value.id +'">' + value.state_name + '</option>');
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