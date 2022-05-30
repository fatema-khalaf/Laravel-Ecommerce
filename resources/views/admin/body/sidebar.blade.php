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
      {{-- new idea --}}
      @php
      // the same as $admin = (Auth::user()->brand == 1);
      // use this 👇 line not this 👆 to avoid conflict when user and admin login in the same browser
      $brand = (auth()->guard('admin')->user()->brand == 1);
      $category = (auth()->guard('admin')->user()->category == 1);
      $product = (auth()->guard('admin')->user()->product == 1);
      $slider = (auth()->guard('admin')->user()->slider == 1);
      $coupons = (auth()->guard('admin')->user()->coupons == 1);
      $shipping = (auth()->guard('admin')->user()->shipping == 1);
      $blog = (auth()->guard('admin')->user()->blog == 1);
      $setting = (auth()->guard('admin')->user()->setting == 1);
      $returnOrders = (auth()->guard('admin')->user()->returnOrders == 1);
      $review = (auth()->guard('admin')->user()->review == 1);
      $orders = (auth()->guard('admin')->user()->orders == 1);
      $reports = (auth()->guard('admin')->user()->reports == 1);
      $users = (auth()->guard('admin')->user()->users == 1);
      $newsletter = (auth()->guard('admin')->user()->newsletter == 1);
      $adminRole = (auth()->guard('admin')->user()->adminRole == 1);

      @endphp
      @if($brand == true)
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
      @endif

      @if($category == true)
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
      @endif

      @if($product == true)
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
      @endif

      @if($newsletter == true)
      <li class="treeview {{($prefix == '/newsletter' )? 'active' : ''}}">
        <a href="#">
          <i data-feather="message-circle"></i>
          <span>Newsletter</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="  {{($route == 'all.subscribers' )? 'active' : ''}}"><a href="{{route('all.subscribers')}}"><i
                class="ti-more"></i>Manage
              Newsletter</a></li>
        </ul>
      </li>
      @endif
      @if($slider == true)
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
      @endif

      @if($coupons == true)
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
      @endif

      @if($shipping == true)
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
      @endif

      @if($orders == true)
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
      @endif

      @if($returnOrders == true)
      <li class="treeview {{($prefix == '/return' )? 'active' : ''}}">
        <a href="#">
          <i data-feather="message-circle"></i>
          <span>Return order</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="  {{($route == 'return.request' )? 'active' : ''}}"><a href="{{route('return.request')}}"><i
                class="ti-more"></i>Return Requests</a></li>
          <li class="  {{($route == 'all.requests' )? 'active' : ''}}"><a href="{{route('all.requests')}}"><i
                class="ti-more"></i>All Approved Requests</a></li>
        </ul>
      </li>
      @endif

      @if($review == true)
      <li class="treeview {{($prefix == '/review' )? 'active' : ''}}">
        <a href="#">
          <i data-feather="message-circle"></i>
          <span>Manage Reviews</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="  {{($route == 'pending.reviews' )? 'active' : ''}}"><a href="{{route('pending.reviews')}}"><i
                class="ti-more"></i>Pending Reviews</a></li>
          <li class="  {{($route == 'published.reviews' )? 'active' : ''}}"><a href="{{route('published.reviews')}}"><i
                class="ti-more"></i>Published Reviews</a></li>
        </ul>
      </li>
      @endif

      @if($blog == true)
      <li class="treeview {{($prefix == '/blog' )? 'active' : ''}}">
        <a href="#">
          <i data-feather="message-circle"></i>
          <span>Manage Blog</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="  {{($route == 'blog.category' )? 'active' : ''}}"><a href="{{route('blog.category')}}"><i
                class="ti-more"></i>Blog Categories</a></li>
          <li class="  {{($route == 'blog.posts' )? 'active' : ''}}"><a href="{{route('blog.posts')}}"><i
                class="ti-more"></i>Blog Posts</a></li>
          <li class="  {{($route == 'add.post' )? 'active' : ''}}"><a href="{{route('add.post')}}"><i
                class="ti-more"></i>Add Posts</a></li>
        </ul>
      </li>
      @endif

      @if($setting == true)
      <li class="treeview {{($prefix == '/setting' )? 'active' : ''}}">
        <a href="#">
          <i data-feather="message-circle"></i>
          <span>Site Settings</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="  {{($route == 'site.setting' )? 'active' : ''}}"><a href="{{route('site.setting')}}"><i
                class="ti-more"></i>Update Settings</a></li>
          <li class="  {{($route == 'seo.setting' )? 'active' : ''}}"><a href="{{route('seo.setting')}}"><i
                class="ti-more"></i>Update SEO Settings</a></li>
        </ul>
      </li>
      @endif
      <li class="header nav-small-cap">User Interface</li>

      @if($reports == true)
      <li class="treeview {{($prefix == '/reports' )? 'active' : ''}}">
        <a href="#">
          <i data-feather="message-circle"></i>
          <span>All Reports</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="  {{($route == 'all.reports' )? 'active' : ''}}"><a href="{{route('all.reports')}}"><i
                class="ti-more"></i>All reports</a></li>
        </ul>
      </li>
      @endif

      @if($users == true)
      <li class="treeview {{($prefix == '/users' )? 'active' : ''}}">
        <a href="#">
          <i data-feather="message-circle"></i>
          <span>All Users</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="  {{($route == 'all.users' )? 'active' : ''}}"><a href="{{route('all.users')}}"><i
                class="ti-more"></i>All Users</a></li>
        </ul>
      </li>
      @endif

      @if($adminRole == true)
      <li class="treeview {{($prefix == '/adminRole' )? 'active' : ''}}">
        <a href="#">
          <i data-feather="message-circle"></i>
          <span>Manage Admins</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-right pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="  {{($route == 'all.admins' )? 'active' : ''}}"><a href="{{route('all.admins')}}"><i
                class="ti-more"></i>All Admins</a></li>
        </ul>
      </li>
      @endif
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