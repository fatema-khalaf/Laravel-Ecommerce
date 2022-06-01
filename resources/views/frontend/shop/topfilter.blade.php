{{-- <style>
    label {
        display: inline-block;
        width: 100px;
    }

    input[type="radio"] {
        display: none;
    }

    input[type="radio"]:checked+label {
        border: solid 2px green;
    }
</style> --}}

<div class="col col-sm-3 col-md-6 no-padding">
    <div class="lbl-cnt"> <span class="lbl">Sort by</span>
        <div class="fld inline">
            <div class="dropdown dropdown-small dropdown-med dropdown-white inline">
                <button data-toggle="dropdown" type="button" class="btn dropdown-toggle">
                    Position <span class="caret"></span> </button>
                <ul role="menu" class="dropdown-menu">
                    <li role="presentation"><input onchange="filter()" type="radio" id="sort" name="sort"
                            value="lowest"><label for="sort">lowest price</label>
                    </li>
                    <li role="presentation"><input onchange="filter()" type="radio" id="sort" name="sort"
                            value="heighest"><label for="sort">heighest price</label>
                    </li>

                </ul>
            </div>
        </div>
        <!-- /.fld -->
    </div>
    <!-- /.lbl-cnt -->
</div>
<!-- /.col -->
<div class="col col-sm-3 col-md-6 no-padding">
    <div class="lbl-cnt"> <span class="lbl">Show</span>
        <div class="fld inline">
            <div class="dropdown dropdown-small dropdown-med dropdown-white inline">
                <button data-toggle="dropdown" type="button" class="btn dropdown-toggle"> 1
                    <span class="caret"></span> </button>
                <ul role="menu" class="dropdown-menu">
                    <li role="presentation"><input onchange="filter()" type="radio" id="paginate" name="paginate"
                            value="10"><label for="paginate">10</label></li>
                    <li role="presentation"><input onchange="filter()" type="radio" id="paginate" name="paginate"
                            value="25"><label for="paginate">25</label></li>
                    <li role="50"><input onchange="filter()" type="radio" id="paginate" name="paginate"
                            value="lowest"><label for="paginate">50</label></li>
                    <li role="presentation"><input onchange="filter()" type="radio" id="paginate" name="paginate"
                            value="100"><label for="paginate">100</label></li>

                </ul>
            </div>
        </div>
        <!-- /.fld -->
    </div>
    <!-- /.lbl-cnt -->
</div>

<!-- /.col -->