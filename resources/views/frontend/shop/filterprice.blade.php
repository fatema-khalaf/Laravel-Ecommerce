<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<style>
    .middle {
        position: relative;
        max-width: 500px;
        margin: 40px 0;

    }

    .slider {
        position: relative;
        z-index: 1;
        height: 10px;
        margin: 0 15px;
    }

    .slider>.track {
        position: absolute;
        z-index: 1;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        border-radius: 5px;
        background-color: #aecce7;
    }

    .slider>.range {
        position: absolute;
        z-index: 2;
        left: 25%;
        right: 25%;
        top: 0;
        bottom: 0;
        border-radius: 5px;
        background-color: #108bea;
    }

    .slider>.thumb {
        position: absolute;
        z-index: 3;
        width: 30px;
        height: 30px;
        background-color: #108bea;
        border-radius: 50%;
        box-shadow: 0 0 0 0 rgba(0, 123, 238, 0.1);
        transition: box-shadow .3s ease-in-out;
    }

    .slider>.thumb.left {
        left: 25%;
        transform: translate(-15px, -10px);
    }

    .slider>.thumb.right {
        right: 25%;
        transform: translate(15px, -10px);
    }

    .slider>.thumb.hover {
        box-shadow: 0 0 0 20px rgba(0, 127, 238, 0.1);
    }

    .slider>.thumb.active {
        box-shadow: 0 0 0 40px rgba(0, 107, 238, 0.2);
    }

    input[type=range] {
        position: absolute;
        pointer-events: none;
        -webkit-appearance: none;
        z-index: 2;
        height: 10px;
        width: 100%;
        opacity: 0;
    }

    input[type=range]::-webkit-slider-thumb {
        pointer-events: all;
        width: 30px;
        height: 30px;
        border-radius: 0;
        border: 0 none;
        background-color: red;
        -webkit-appearance: none;
    }


    /*--- /.price-range-slider ---*/
</style>

<span id="min">Min:</span>
<span id="max">Max:</span>
<div class="middle">
    <div class="multi-range-slider">

        <input name="min_p" type="range" id="input-left" min="{{$priceProds->min('selling_price')}}"
            max="{{$priceProds->max('selling_price')}}" value="{{$priceProds->min('selling_price')}}">
        <input name="max_p" type="range" id="input-right" min="{{$priceProds->min('selling_price')}}"
            max="{{$priceProds->max('selling_price')}}" value="{{$priceProds->max('selling_price')}}">

        <div class="slider">
            <div class="track"></div>
            <div class="range"></div>
            <div class="thumb left"></div>
            <div class="thumb right"></div>
        </div>
    </div>
</div>
<a id='submit' href="#/" class="lnk btn btn-primary">Show Now</a>


<script>
    var inputLeft = document.getElementById("input-left");
    var inputRight = document.getElementById("input-right");

    var thumbLeft = document.querySelector(".slider > .thumb.left");
    var thumbRight = document.querySelector(".slider > .thumb.right");
    var range = document.querySelector(".slider > .range");

    function setLeftValue() {
        var _this = inputLeft,
            min = parseInt(_this.min),
            max = parseInt(_this.max);

        _this.value = Math.min(parseInt(_this.value), parseInt(inputRight.value) - 1);

        var percent = ((_this.value - min) / (max - min)) * 100;

        thumbLeft.style.left = percent + "%";
        range.style.left = percent + "%";
    }
    setLeftValue();

    function setRightValue() {
        var _this = inputRight,
            min = parseInt(_this.min),
            max = parseInt(_this.max);

        _this.value = Math.max(parseInt(_this.value), parseInt(inputLeft.value) + 1);

        var percent = ((_this.value - min) / (max - min)) * 100;

        thumbRight.style.right = (100 - percent) + "%";
        range.style.right = (100 - percent) + "%";
    }
    setRightValue();

    inputLeft.addEventListener("input", setLeftValue);
    inputRight.addEventListener("input", setRightValue);

    inputLeft.addEventListener("mouseover", function() {
        thumbLeft.classList.add("hover");
    });
    inputLeft.addEventListener("mouseout", function() {
        thumbLeft.classList.remove("hover");
    });
    inputLeft.addEventListener("mousedown", function() {
        thumbLeft.classList.add("active");
    });
    inputLeft.addEventListener("mouseup", function() {
        thumbLeft.classList.remove("active");
    });

    inputRight.addEventListener("mouseover", function() {
        thumbRight.classList.add("hover");
    });
    inputRight.addEventListener("mouseout", function() {
        thumbRight.classList.remove("hover");
    });
    inputRight.addEventListener("mousedown", function() {
        thumbRight.classList.add("active");
    });
    inputRight.addEventListener("mouseup", function() {
        thumbRight.classList.remove("active");
    });
</script>

{{-- control spans min and max price --}}
<script type="text/javascript">
    $(document).ready(function() {
      $('#input-left').on('change', function(){
          var min_p = $(this).val();
          $('#min').text('Min: $'+min_p);   
      });
      $('#input-right').on('change', function(){
          var max_p = $(this).val();
          $('#max').text('Max: $'+max_p);   
      });
    });
</script>

<script>
    //  this is for ajax this function is NOT inuse 
    function loadProduct(){
        var min_price = $('#input-left').val();
        var max_price = $('#input-right').val();
      $.ajax({
        type: "post",
        dataType: 'json',
        url: "?min_price="+min_price+"?max_price="+max_price,
        data: {max_price:max_price, min_price:min_price},
      })
      .done(function(data){
          if (data.grid_view == " " || data.list_view == " ") {
              return;
            }
            $('#grid_view_product').html(data.grid_view);
            $('#list_view_product').html(data.list_view);
      })
      .fail(function(data){
        alert(data.responseText);
      })
    }
    // disable the button while the page is loading
    $(document).ready(function(){
    $('#show').attr('disabled',false);
});

</script>