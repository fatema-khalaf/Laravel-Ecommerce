<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubcategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\ShippingAreaController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\ReturnController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\LanguageController; 
use App\Http\Controllers\Frontend\CartController; 
use App\Http\Controllers\Frontend\HomeBlogController; 
use App\Http\Controllers\User\WishlistController; 
use App\Http\Controllers\User\CartPageController; 
use App\Http\Controllers\User\CheckoutController; 
use App\Http\Controllers\User\StripeController; 
use App\Http\Controllers\User\CashController; 
use App\Http\Controllers\User\AllUserController; 
use App\Http\Controllers\User\ReviewController; 
use App\Models\User;

// Route::get("/", function () {
//     return view("welcome");
// });

//NOTE: Admin Route
Route::group(
    ["prefix" => "admin", "middleware" => ["admin:admin"]],
    function () {
        Route::get("/login", [AdminController::class, "loginForm"]);
        Route::post("/login", [AdminController::class, "store"])->name(
            "admin.login"
        );
    }
);

Route::get("/admin/logout", [AdminController::class, "destroy"])->name("admin.logout");

Route::middleware(['auth:admin'])->group(function(){

// View profile
Route::get("/admin/profile", [
    AdminProfileController::class,
    "AdminProfile",
])->name("admin.profile");
// View Edit profile
Route::get("/admin/profile/edit", [
    AdminProfileController::class,
    "AdminProfileEdit",
])->name("admin.profile.edit");

// Store Edit profile data
Route::post("/admin/profile/edit", [
    AdminProfileController::class,
    "AdminProfileStore",
])->name("admin.profile.store");

// View Change admin password 
Route::get("/admin/change/password", [
    AdminProfileController::class,
    "AdminChangePassword",
    ])->name("admin.change.password");
    
// Store new password    
Route::post("/update/change/password", [
    AdminProfileController::class,
    "AdminUpdateChangePassword",
])->name("update.change.password");

// Login Admin
Route::middleware([
    "auth:sanctum,admin",
    config("jetstream.auth_session"),
    "verified",
])->group(function () {
    Route::get("admin/dashboard", function () {
        return view("admin.index");
    })->name("dashboard")->middleware('auth:admin');
});
});
// Note: Brands All routes
Route::prefix('brand')->group(function(){
    // View All Brands
    Route::get("/view", [BrandController::class, "BrandView"])->name('all.brands');
    // Add new brand
    Route::post("/store", [BrandController::class, "BrandStore"])->name('brand.store');
    // View Edit brand
    Route::get("/edit/{id}", [BrandController::class, "BrandEdite"])->name('brand.edit');
    // Store updated data
    Route::post("/update", [BrandController::class, "BrandUpdate"])->name('brand.update');
    // Delete brand
    Route::get("/delete/{id}", [BrandController::class, "BrandDelete"])->name('brand.delete');
});

// Note: Categories All routes
Route::prefix('category')->group(function(){
    // View all Catigories
    Route::get('/view', [CategoryController::class , 'CatigoryView'])->name('all.categories');
    // Add new category
    Route::post("/store", [CategoryController::class, "CategoryStore"])->name('category.store');
    // View Edit category
    Route::get("/edit/{id}", [CategoryController::class, "CategoryEdite"])->name('category.edit');
    // Store updated data
    Route::post("/update", [CategoryController::class, "CategoryUpdate"])->name('category.update');
    // Delete category
    Route::get("/delete/{id}", [CategoryController::class, "CategoryDelete"])->name('category.delete');
    
//Subcategories All routes

    // View all subcatigories
    Route::get('/sub/view', [SubcategoryController::class , 'SubcatigoryView'])->name('all.subcategories');
    // Add new subcategory
    Route::post("/sub/store", [SubcategoryController::class, "SubcategoryStore"])->name('subcategory.store');
    // View Edit subcategory
    Route::get("/sub/edit/{id}", [SubcategoryController::class, "SubcategoryEdite"])->name('subcategory.edit');
    // Store updated data
    Route::post("/sub/update", [SubcategoryController::class, "SubcategoryUpdate"])->name('subcategory.update');
    // Delete subcategory
    Route::get("/sub/delete/{id}", [SubcategoryController::class, "SubcategoryDelete"])->name('subcategory.delete');
    
//Sub Subcategories All routes

    // View all sub-subcatigories
    Route::get('/sub/sub/view', [SubcategoryController::class , 'SubSubcatigoryView'])->name('all.subsubcategories');
    //Note: ajax route
    Route::get('/subcategory/ajax/{category_id}', [SubcategoryController::class, 'GetSubCategory']);
    Route::get('/sub-subcategory/ajax/{subcategory_id}', [SubCategoryController::class, 'GetSubSubCategory']);
    // Add new sub-subcategory
    Route::post("/sub/sub/store", [SubcategoryController::class, "SubSubcategoryStore"])->name('subsubcategory.store');
    // View Edit sub-subcategory
    Route::get("/sub/sub/edit/{id}", [SubcategoryController::class, "SubSubcategoryEdite"])->name('subsubcategory.edit');
    // Store updated data
    Route::post("/sub/sub/update", [SubcategoryController::class, "SubSubcategoryUpdate"])->name('subsubcategory.update');
    // Delete sub-subcategory
    Route::get("/sub/sub/delete/{id}", [SubcategoryController::class, "SubSubcategoryDelete"])->name('subsubcategory.delete');
});

// Note: Products All routes
Route::prefix('product')->group(function(){

    // View add Product page
    Route::get('/add', [ProductController::class , 'AddProduct'])->name('add.product');
    // Add new Product
    Route::post("/store", [ProductController::class, "ProductStore"])->name('product.store');
    // View all Products
    Route::get('/view', [ProductController::class , 'ProductView'])->name('all.products');
    // View Edit product
    Route::get("/edit/{id}", [ProductController::class, "ProductEdite"])->name('product.edit');
    // Store updated data
    Route::post("/update", [ProductController::class, "ProductUpdate"])->name('product.update');
    // Store updated multi images
    Route::post("/image/update", [ProductController::class, "MultiImageUpdate"])->name('product.image.update');
    // Store updated thumbnail image
    Route::post("/thambnail/update", [ProductController::class, "ThambnailImageUpdate"])->name('product.thambnail.update');
    // Delete image from multi images
    Route::get('/image/delete/{id}', [ProductController::class, 'MultiImageDelete'])->name('product.multiImg.delete');
    // Activate product
    Route::get('/activate/product/{id}', [ProductController::class, 'ActivateProduct'])->name('product.activate');
    // Inactivate product
    Route::get('/inactivate/product/{id}', [ProductController::class, 'InactivateProduct'])->name('product.inactivate');
    // Delete product
    Route::get("/delete/{id}", [ProductController::class, "ProductDelete"])->name('product.delete');
});


// Note: Slider All routes
Route::prefix('slider')->group(function(){
    // View All Sliders
    Route::get("/view", [SliderController::class, "SliderView"])->name('all.sliders');
    // Add new slider
    Route::post("/store", [SliderController::class, "SliderStore"])->name('slider.store');
    // View Edit slider
    Route::get("/edit/{id}", [SliderController::class, "SliderEdite"])->name('slider.edit');
    // Store updated data
    Route::post("/update", [SliderController::class, "SliderUpdate"])->name('slider.update');
    // Delete slider
    Route::get("/delete/{id}", [SliderController::class, "SliderDelete"])->name('slider.delete');
    // Activate slider
    Route::get('/activate/slider/{id}', [SliderController::class, 'SliderActivate'])->name('slider.activate');
    // Inactivate slider
    Route::get('/inactivate/slider/{id}', [SliderController::class, 'SliderInactivate'])->name('slider.inactivate');
});

// Note: Coupons All routes
Route::prefix('coupons')->group(function(){
    // View All Coupons
    Route::get("/view", [CouponController::class, "CouponView"])->name('all.coupons');
    // Add new coupon
    Route::post("/store", [CouponController::class, "CouponStore"])->name('coupon.store');
    // View Edit coupon
    Route::get("/edit/{id}", [CouponController::class, "CouponEdit"])->name('coupon.edit');
    // Store updated data
    Route::post("/update", [CouponController::class, "CouponUpdate"])->name('coupon.update');
    // Delete coupon
    Route::get("/delete/{id}", [CouponController::class, "CouponDelete"])->name('coupon.delete');
});

// Note: Shipping divisions All routes
Route::prefix('shipping')->group(function(){
    // View All Coupons
    Route::get("/division/view", [ShippingAreaController::class, "DivisionView"])->name('all.divisions');
    // Add new coupon
    Route::post("/division/store", [ShippingAreaController::class, "DivisionStore"])->name('division.store');
    // View Edit coupon
    Route::get("/division/edit/{id}", [ShippingAreaController::class, "DivisionEdit"])->name('division.edit');
    // Store updated data
    Route::post("/division/update", [ShippingAreaController::class, "DivisionUpdate"])->name('division.update');
    // Delete division
    Route::get("/division/delete/{id}", [ShippingAreaController::class, "DivisionDelete"])->name('division.delete');
});
// Note: Shipping districts All routes
Route::prefix('shipping')->group(function(){
    // View All Coupons
    Route::get("/district/view", [ShippingAreaController::class, "DistrictView"])->name('all.districts');
    // Add new coupon
    Route::post("/district/store", [ShippingAreaController::class, "DistrictStore"])->name('district.store');
    // View Edit coupon
    Route::get("/district/edit/{id}", [ShippingAreaController::class, "DistrictEdit"])->name('district.edit');
    // Store updated data
    Route::post("/district/update", [ShippingAreaController::class, "DistrictUpdate"])->name('district.update');
    // Delete division
    Route::get("/district/delete/{id}", [ShippingAreaController::class, "DistrictDelete"])->name('district.delete');
});
// Note: Shipping states All routes
Route::prefix('shipping')->group(function(){
    // View All Coupons
    Route::get("/state/view", [ShippingAreaController::class, "StateView"])->name('all.states');
    // Add new coupon
    Route::post("/state/store", [ShippingAreaController::class, "StateStore"])->name('state.store');
    // View Edit coupon
    Route::get("/state/edit/{id}", [ShippingAreaController::class, "StateEdit"])->name('state.edit');
    // Store updated data
    Route::post("/state/update", [ShippingAreaController::class, "StateUpdate"])->name('state.update');
    // Delete division
    Route::get("/state/delete/{id}", [ShippingAreaController::class, "StateDelete"])->name('state.delete');
});

//NOTE: User Route 
//View user account
Route::middleware([
    "auth:sanctum,web",
    config("jetstream.auth_session"),
    "verified",
])->group(function () {
    Route::get("/dashboard", function () {
        $id= Auth::user()->id;
        $user = User::find($id);
        return view("dashboard",compact('user'));
    })->name("dashboard");
});
// View Home page
Route::get("/", [IndexController::class, "index"]);
// Log out user
Route::get("/user/logout", [IndexController::class, "UserLogout"])->name('user.logout');
// View user profile
Route::get("/user/profile", [IndexController::class, "UserProfile"])->name('user.profile');
// Store updated user data
Route::post("/user/profile/store", [IndexController::class, "UserProfileStore"])->name('user.profile.store');
// View Change passwrod
Route::get("/user/change/password", [IndexController::class, "UserChangePassword"])->name('change.password');
// Store new password
Route::post("/user/password/update", [IndexController::class, "UserUpdateChangePassword"])->name('user.password.update');

//  ============================================== FRONT END : ROUTES ============================================== -->

//NOTE: Multi language Routes

Route::get("/english/language", [LanguageController::class, "English"])->name('english.language');
Route::get("/arabic/language", [LanguageController::class, "Arabic"])->name('arabic.language');
// View product details
Route::get('/product/details/{id}/{slug}', [IndexController::class, 'ProductDetails']); 
// View product with tag
Route::get('/product/tag/{tag}', [IndexController::class, 'ProductWithTag']); 
// View product wise subcategory
Route::get('/subcategory/product/{subcat_id}/{slug}', [IndexController::class, 'SubCatWiseProduct']); 
// View product wise subcategory
Route::get('/sub-subcategory/product/{subsubcat_id}/{slug}', [IndexController::class, 'SubSubCatWiseProduct']); 
// Product View Modal with Ajax
Route::get('/product/view/modal/{id}', [IndexController::class, 'ProductViewAjax']); 
// Add to cart store data with Ajax
Route::post('/cart/data/store/{id}', [CartController::class, 'AddToCart']); 
// Get cart items 
Route::get('/product/mini/cart/', [CartController::class, 'AddMiniCart']); 
// Remove mini cart
Route::get('/minicart/product-remove/{rowId}', [CartController::class, 'RemoveMiniCart']); 
// Add to wishlist data with Ajax
Route::post('/add-to-wishlist/{id}', [WishlistController::class, 'AddToWishlist']); 

// new idea protected route only logged in user
// Frontend Routes 👇👇
Route::group(['prefix' => 'user' , 'middleware' =>['user','auth'],'namespace' => 'User'],
function(){
    // View wishlist
    Route::get('/wishlist', [WishlistController::class, 'ViewWishlist'])->name('wishlist'); 
    // Get wishlist data
    Route::get('/view-wishlist-products', [WishlistController::class, 'GetWishlistProduct']); 
    // Remove wishlist
    Route::get('/wishlist/product-remove/{id}', [WishlistController::class, 'RemoveWishlist']); 
    
    // note: Stripe payment
    Route::post('/stripe/order', [StripeController::class, 'StripeOrder'])->name('stripe.order'); 
    // note: Cash payment
    Route::post('/cash/order', [CashController::class, 'CashOrder'])->name('cash.order'); 
    
    // Note: user order route
    Route::get('/my/orders', [AllUserController::class, 'MyOrders'])->name('my.orders'); 
    //  user order route
    Route::get('/order-details/{id}', [AllUserController::class, 'OrderDetails']); 
    // user order download invoice  route
    Route::get('/invoice-download/{id}', [AllUserController::class, 'InvoiceDownload']); 
    // return order Request
    Route::post('/return/order/{id}', [AllUserController::class, 'ReturnOrder'])->name('return.order'); 
    // View return orders list
    Route::get('/return/order/list', [AllUserController::class, 'ReturnOrdersList'])->name('return.orders.list'); 
    // View cancled order list
    Route::get('/canceled/order/list', [AllUserController::class, 'CanceledOrdersList'])->name('cancel.orders'); 

});
// note: my cart routes
// View my cart
Route::get('/my-cart', [CartPageController::class, 'ViewMyCart'])->name('mycart'); 
// Get mycart data
Route::get('/view-my-cart-products', [CartPageController::class, 'GetMyCartProduct']); 
// Remove mycart
Route::get('/my-cart/product-remove/{rowId}', [CartPageController::class, 'RemoveMyCart']); 
// cart increment
Route::get('/cart-increment/{rowId}', [CartPageController::class, 'IncrementCart']); 
// cart decrement 
Route::get('/cart-decrement/{rowId}', [CartPageController::class, 'DecrementCart']); 

// Note: frontend coupon Route
// apply coupon
Route::post('/coupon-apply', [CartController::class, 'ApplyCoupon']); 
// calculate coupon 
Route::get('/coupon-calculation', [CartController::class, 'CouponCalculation']); 
// Remove coupon 
Route::get('/coupon-remove', [CartController::class, 'CouponRemove']); 

// Note: checkout route
// View Checkout
Route::get('/checkout', [CheckoutController::class, 'ViewCheckout'])->name('checkout'); 
// Get district ajax
Route::get('/division/district/ajax/{id}', [CheckoutController::class, 'GetDistricts']); 
// Get state ajax
Route::get('/district/state/ajax/{id}', [CheckoutController::class, 'GetStates']); 
//  store checkout data
Route::post('/checkout/store', [CheckoutController::class, 'CheckoutStore'])->name('checkout.store'); 

// Note: Orders backend All routes
Route::prefix('orders')->group(function(){
    // View All pending orders
    Route::get("/pending/orders", [OrderController::class, "PendingOrders"])->name('pending.orders');
    // View pending order details 
    Route::get("/order/details/{order_id}", [OrderController::class, "OrdersDetails"])->name('order.details');
    // View All confirmed orders
    Route::get('/confirmed/orders', [OrderController::class, 'ConfirmedOrders'])->name('confirmed-orders');
    // View All processing orders
    Route::get('/processing/orders', [OrderController::class, 'ProcessingOrders'])->name('processing-orders');
    // View All picked orders
    Route::get('/picked/orders', [OrderController::class, 'PickedOrders'])->name('picked-orders');
    // View All shipped orders
    Route::get('/shipped/orders', [OrderController::class, 'ShippedOrders'])->name('shipped-orders');
    // View All delivered orders
    Route::get('/delivered/orders', [OrderController::class, 'DeliveredOrders'])->name('delivered-orders');
    // View All canceled orders
    Route::get('/canceled/orders', [OrderController::class, 'CanceledOrders'])->name('canceled-orders');
    // Confirm order status
    Route::get('/confirm/order/{id}', [OrderController::class, 'PendingToConfirm'])->name('confirm.order');
    // Processing order status
    Route::get('/processing/order/{id}', [OrderController::class, 'ConfirmToProcessing'])->name('processing.order');
    // picked order status
    Route::get('/picked/order/{id}', [OrderController::class, 'ProcessingToPicked'])->name('picked.order');
    // shipped order status
    Route::get('/shipped/order/{id}', [OrderController::class, 'PickedToShipped'])->name('shipped.order');
    // delivered order status
    Route::get('/delivered/order/{id}', [OrderController::class, 'ShippedToDelivered'])->name('delivered.order');
    // Download invoice
    Route::get('/invoice/download/{order_id}', [OrderController::class, 'AdminInvoiceDownload'])->name('invoice.download');
});


// Note: Admin Reports All routes
Route::prefix('reports')->group(function(){
    // View All Reports
    Route::get("/view", [ReportController::class, "ReportView"])->name('all.reports');
    // View All specific date orders
    Route::post("/search/by/date", [ReportController::class, "ReportByDate"])->name('search.by.date');
    // View All specific year and month orders
    Route::post("/search/by/month", [ReportController::class, "ReportByMonth"])->name('search.by.month');
    // View All specific year orders
    Route::post("/search/by/year", [ReportController::class, "ReportByYear"])->name('search.by.year');
});
// Note: Admin All Users routes
Route::prefix('users')->group(function(){
    // View All Users
    Route::get("/view", [AdminProfileController::class, "UsersView"])->name('all.users');
    // View All specific date orders
    Route::post("/search/by/date", [ReportController::class, "ReportByDate"])->name('search.by.date');
    // View All specific year and month orders
    Route::post("/search/by/month", [ReportController::class, "ReportByMonth"])->name('search.by.month');
    // View All specific year orders
    Route::post("/search/by/year", [ReportController::class, "ReportByYear"])->name('search.by.year');
});


// Note: Dashboard blog all routes
Route::prefix('blog')->group(function(){
    // Bolg categories dashboard
    // View All Blog category
    Route::get("/category/view", [BlogController::class, "BlogCatigoryView"])->name('blog.category');
    // Add new blog category
    Route::post("/category/store", [BlogController::class, "BlogCategoryStore"])->name('blog.category.store');
    // View Edit blog category
    Route::get("/category/edit/{id}", [BlogController::class, "BlogCategoryEdite"])->name('blog.category.edit');
    // Store updated data
    Route::post("/category/update", [BlogController::class, "BlogCategoryUpdate"])->name('blog.category.update');
    // Delete blog category
    Route::get("/category/delete/{id}", [BlogController::class, "BlogCategoryDelete"])->name('blog.category.delete');
    
    // Blog posts dashboard
    Route::get("/view", [BlogController::class, "BlogPostView"])->name('blog.posts');
    // View add post page
    Route::get("/add/post", [BlogController::class, "BlogPostAdd"])->name('add.post');
    // store new post
    Route::post("/post/store", [BlogController::class, "BlogPostStore"])->name('post.store');
     // View Edit blog post
     Route::get("/post/edit/{id}", [BlogController::class, "BlogPostEdite"])->name('post.edit');
     // Store updated data
     Route::post("/post/update", [BlogController::class, "BlogPostUpdate"])->name('post.update');
     // Delete blog post
     Route::get("/post/delete/{id}", [BlogController::class, "BlogPostDelete"])->name('post.delete');
    });
    
    // Note: Frontend blog routs
    // View blog Page
    Route::get("/blog", [HomeBlogController::class, "BlogView"])->name('home.blog');
    // View blog Post details
    Route::get("/blog/details/{id}", [HomeBlogController::class, "BlogPostDetailsView"])->name('post.details');
    // Get blog Post of a category
    Route::get("/blog/category/{category_id}", [HomeBlogController::class, "BlogCatPost"]);
    
// Note: Dashboard Settings all routes
Route::prefix('setting')->group(function(){
    // View Update setting page
    Route::get("/site", [SettingController::class, "SiteSetting"])->name('site.setting');
    // store updated site setting data
    Route::post("/site/update", [SettingController::class, "SiteSettingUpdate"])->name('update.setting');
    // View Update SEO setting page
    Route::get("/seo", [SettingController::class, "SEOSetting"])->name('seo.setting');
    // store updated seo setting data
    Route::post("/seo/update", [SettingController::class, "SEOSettingUpdate"])->name('update.seo');
});

// Note: Dashboard Return orders all routes
Route::prefix('return')->group(function(){
    // View all return requests
    Route::get("/requests", [ReturnController::class, "ReturnRequestView"])->name('return.request');
    // Approve return requests
    Route::get("/approve/{id}", [ReturnController::class, "ReturnRequestApprove"])->name('return.approve');
    // View all approved return requests
    Route::get("/approved/requests", [ReturnController::class, "RequestApprovedView"])->name('all.requests');
});

// Note: product review all routes
// frontend add review 
Route::post('/add/review',[ReviewController::class, "AddReview"])->name('add.review');
// dashboard view pending reviews page
Route::get('/pending/reviews',[ReviewController::class, "PendingReviewsView"])->name('pending.reviews');
// dashboard approve to publish review 
Route::get("/review/publish/{id}", [ReviewController::class, "PublishReview"])->name('review.approve');
// dashboard view published reviews page
Route::get('/published/reviews',[ReviewController::class, "PublishedReviewsView"])->name('published.reviews');
// dashboard approve to publish review 
Route::get("/review/delete/{id}", [ReviewController::class, "DeleteReview"])->name('review.delete');