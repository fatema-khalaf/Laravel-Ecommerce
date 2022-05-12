@php
$prefix = Request::route()->getPrefix();
$route = Route::current()->getName();
@endphp

<aside class="main-sidebar">
  <!-- sidebar-->
  <section class="sidebar">

    <div class="user-profile">
      <div class="ulogo">
        <a href="index.html">
          <!-- logo for regular state and mobile devices -->
          <div class="d-flex align-items-center justify-content-center">
            <img src="{{asset('backend/images/logo-dark.png')}}" alt="">
            <h3><b>Pro-</b>Ecommerce</h3>
          </div>
        </a>
      </div>
    </div>
    <!-- sidebar menu-->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="{{($route == 'dashboard')? 'active': ''}}">
        <a href="{{url('admin/dashboard')}}">
          <i data-feather="pie-chart"></i>
          <span>Dashboard</span>
        </a>
      </li>

      <li class="treeview {{($prefix == '/brand' )? 'active' : ''}}">
        <a href="#">
          <i data-feather="message-circle"></i>
          <span>Brands</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="  {{($route == 'all.brands' )? 'active' : ''}}"><a href="{{route('all.brands')}}"><i
                class="ti-more"></i>Manage
              Brands</a></li>
        </ul>
      </li>

      <li class="treeview {{($prefix == '/category' )? 'active' : ''}}">
        <a href="#">
          <i data-feather="mail"></i> <span>Categories</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{($route == 'all.categories' )? 'active' : ''}}"><a href="{{route('all.categories')}}"><i
                class="ti-more"></i>Manage Categories</a></li>
          <li class="{{($route == 'all.subcategories' )? 'active' : ''}}"><a href="{{route('all.subcategories')}}"><i
                class="ti-more"></i>Manage Subcategories</a></li>
          <li class="{{($route == 'all.subsubcategories' )? 'active' : ''}}"><a
              href="{{route('all.subsubcategories')}}"><i class="ti-more"></i>Manage Sub-subcategories</a></li>
        </ul>
      </li>

      <li class="treeview {{($prefix == '/product' )? 'active' : ''}}">
        <a href="#">
          <i data-feather="mail"></i> <span>Products</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="{{($route == 'add.product' )? 'active' : ''}}"><a href="{{route('add.product')}}"><i
                class="ti-more"></i>Add Products</a></li>
          <li class="{{($route == 'all.products' )? 'active' : ''}}"><a href="{{route('all.products')}}"><i
                class="ti-more"></i>Manage Products</a></li>
        </ul>
      </li>
      <li class="treeview {{($prefix == '/slider' )? 'active' : ''}}">
        <a href="#">
          <i data-feather="message-circle"></i>
          <span>Slider</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="  {{($route == 'all.sliders' )? 'active' : ''}}"><a href="{{route('all.sliders')}}"><i
                class="ti-more"></i>Manage
              Sliders</a></li>
        </ul>
      </li>

      <li class="treeview {{($prefix == '/coupons' )? 'active' : ''}}">
        <a href="#">
          <i data-feather="message-circle"></i>
          <span>Coupons</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="  {{($route == 'all.coupons' )? 'active' : ''}}"><a href="{{route('all.coupons')}}"><i
                class="ti-more"></i>Manage
              Coupons</a></li>
        </ul>
      </li>

      <li class="treeview {{($prefix == '/shipping' )? 'active' : ''}}">
        <a href="#">
          <i data-feather="message-circle"></i>
          <span>Shipping Area</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="  {{($route == 'all.divisions' )? 'active' : ''}}"><a href="{{route('all.divisions')}}"><i
                class="ti-more"></i>Ship division</a></li>
          <li class="  {{($route == 'all.districts' )? 'active' : ''}}"><a href="{{route('all.districts')}}"><i
                class="ti-more"></i>Ship district</a></li>
          <li class="  {{($route == 'all.states' )? 'active' : ''}}"><a href="{{route('all.states')}}"><i
                class="ti-more"></i>Ship State</a></li>
        </ul>
      </li>

      <li class="treeview {{($prefix == '/orders' )? 'active' : ''}}">
        <a href="#">
          <i data-feather="message-circle"></i>
          <span>Orders</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="  {{($route == 'pending.orders' )? 'active' : ''}}"><a href="{{route('pending.orders')}}"><i
                class="ti-more"></i>Pending orders</a></li>
          <li class="{{ ($route == 'confirmed-orders')? 'active':'' }}"><a href="{{ route('confirmed-orders') }}"><i
                class="ti-more"></i>Confirmed Orders</a></li>
          <li class="{{ ($route == 'processing-orders')? 'active':'' }}"><a href="{{ route('processing-orders') }}"><i
                class="ti-more"></i>Processing Orders</a></li>
          <li class="{{ ($route == 'picked-orders')? 'active':'' }}"><a href="{{ route('picked-orders') }}"><i
                class="ti-more"></i> Picked Orders</a></li>
          <li class="{{ ($route == 'shipped-orders')? 'active':'' }}"><a href="{{ route('shipped-orders') }}"><i
                class="ti-more"></i> Shipped Orders</a></li>
          <li class="{{ ($route == 'delivered-orders')? 'active':'' }}"><a href="{{ route('delivered-orders') }}"><i
                class="ti-more"></i> Delivered Orders</a></li>
          <li class="{{ ($route == 'canceled-orders')? 'active':'' }}"><a href="{{ route('canceled-orders') }}"><i
                class="ti-more"></i> Canceled Orders</a></li>
        </ul>
      </li>


      <li class="treeview">
        <a href="#">
          <i data-feather="file"></i>
          <span>Pages</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="profile.html"><i class="ti-more"></i>Profile</a></li>
          <li><a href="invoice.html"><i class="ti-more"></i>Invoice</a></li>
          <li><a href="gallery.html"><i class="ti-more"></i>Gallery</a></li>
          <li><a href="faq.html"><i class="ti-more"></i>FAQs</a></li>
          <li><a href="timeline.html"><i class="ti-more"></i>Timeline</a></li>
        </ul>
      </li>

      <li class="header nav-small-cap">User Interface</li>

      <li class="treeview">
        <a href="#">
          <i data-feather="grid"></i>
          <span>Components</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="components_alerts.html"><i class="ti-more"></i>Alerts</a></li>
          <li><a href="components_badges.html"><i class="ti-more"></i>Badge</a></li>
          <li><a href="components_buttons.html"><i class="ti-more"></i>Buttons</a></li>
        </ul>
      </li>

      <li class="treeview">
        <a href="#">
          <i data-feather="credit-card"></i>
          <span>Cards</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="card_advanced.html"><i class="ti-more"></i>Advanced Cards</a></li>
          <li><a href="card_basic.html"><i class="ti-more"></i>Basic Cards</a></li>
          <li><a href="card_color.html"><i class="ti-more"></i>Cards Color</a></li>
        </ul>
      </li>
    </ul>
  </section>

  <div class="sidebar-footer">
    <!-- item-->
    <a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Settings"
      aria-describedby="tooltip92529"><i class="ti-settings"></i></a>
    <!-- item-->
    <a href="mailbox_inbox.html" class="link" data-toggle="tooltip" title="" data-original-title="Email"><i
        class="ti-email"></i></a>
    <!-- item-->
    <a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Logout"><i
        class="ti-lock"></i></a>
  </div>
</aside>