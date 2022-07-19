<style>
    input[type="radio"] {
        display: none;
    }

    .radio-lable {
        width: 100%;
        margin-left: 6px;
        color: rgb(25, 23, 23)
    }

    .radio-lable:hover {
        cursor: pointer;
        color: rgba(25, 23, 23, 0.587)
    }
</style>
<div class="clearfix filters-container m-t-10">
    <div class="row">
        <div class="col col-sm-6 col-md-2">
            <div class="filter-tabs">
                <ul id="filter-tabs" class="nav nav-tabs nav-tab-box nav-tab-fa-icon">
                    <li class="active"> <a data-toggle="tab" href="#grid-container"><i
                                class="icon fa fa-th-large"></i>Grid</a> </li>
                    <li><a data-toggle="tab" href="#list-container"><i class="icon fa fa-th-list"></i>List</a></li>
                </ul>
            </div>
            <!-- /.filter-tabs -->
        </div>
        <!-- /.col -->
        <div class="col col-sm-12 col-md-6">
            <div class="col col-sm-3 col-md-6 no-padding">
                <div class="lbl-cnt"> <span class="lbl">Sort by</span>
                    <div class="fld inline">
                        <div class="dropdown dropdown-small dropdown-med dropdown-white inline">
                            <button data-toggle="dropdown" type="button" class="btn dropdown-toggle">
                                Select <span class="caret"></span> </button>
                            <ul role="menu" class="dropdown-menu">
                                <li><input onchange="filter()" type="radio" id="Newest" name="sort"
                                        value="created_at-DESC"><label class='radio-lable' for="Newest">Newest</label>
                                </li>
                                <li><input onchange="filter()" type="radio" id="Low-High" name="sort"
                                        value="selling_price-ASC"><label class='radio-lable' for="Low-High">Price
                                        [Low-High]</label>
                                </li>
                                <li><input onchange="filter()" type="radio" id="High-Low" name="sort"
                                        value="selling_price-DESC"><label class='radio-lable' for="High-Low">Price
                                        [High-Low]</label>
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
                                <li><input onchange="filter()" type="radio" id="10" name="paginate" value="10"><label
                                        class='radio-lable' for="10">10</label>
                                </li>
                                <li><input onchange="filter()" type="radio" id="25" name="paginate" value="25"><label
                                        class='radio-lable' for="25">25</label>
                                </li>
                                <li><input onchange="filter()" type="radio" id="50" name="paginate" value="50"><label
                                        class='radio-lable' for="50">50</label></li>
                                <li><input onchange="filter()" type="radio" id="100" name="paginate" value="100"><label
                                        class='radio-lable' for="100">100</label></li>

                            </ul>
                        </div>
                    </div>
                    <!-- /.fld -->
                </div>
                <!-- /.lbl-cnt -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.col -->

        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>