<?php

use App\Products;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Admin\Cashier;
use App\Order;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
// */

Route::get('/sample', 'Frontend\FrontendController@pusher')->name('pusher');

Route::get('/','Frontend\FrontendController@index')->name('frontend.index');
Route::get('/shop','Frontend\FrontendController@shop')->name('frontend.shop');
Route::get('/categories','Frontend\FrontendController@all_categories')->name('frontend.categories');
Route::get('view-category/{slug}', 'Frontend\FrontendController@view_category')->name('frontend.view.category');
Route::get('category/{cate_slug}/{prod_slug}', 'Frontend\FrontendController@view_product')->name('frontend.view.product');
Route::get('/about-us','Frontend\FrontendController@about_us')->name('frontend.about-us');
Route::get('/privacy-policy','Frontend\FrontendController@privacy_policy')->name('frontend.policy');
Route::get('/terms-and-conditions','Frontend\FrontendController@terms')->name('frontend.terms');

// Route::get('/download/{id}', 'Frontend\FrontendController@print');

Auth::routes();
Route::post('/add-to-cart', 'Frontend\CartsController@addtocart');
Route::post('/add-to-wishlist', 'Frontend\WishlistController@addtowish');
Route::get('/contact-us', 'Frontend\ContactController@index')->name('contact-us');
Route::post('/contact-us', 'Frontend\ContactController@save_contact')->name('save-contact');

Route::get('/searchajax', 'Frontend\SearchController@searchAutoComplete')->name('searchproductajax');
Route::post("/searching", 'Frontend\SearchController@result');

Route::post('/add-rating', 'Frontend\RatingController@addRating');

Auth::routes(['verify'=>true]);

// wishlist
Route::get('wishlist', 'Frontend\WishlistController@index')->name('user.wishlist')->middleware('prevent-back-history');
Route::get('/load-wishlist-data','Frontend\WishlistController@wishlistCount')->name('user.count-wish');
Route::post('delete-wish-item', 'Frontend\WishlistController@removeWish');
Route::post('update-wish', 'Frontend\WishlistController@updateWish');
Route::post('delete-all-wishlist', 'Frontend\WishlistController@clearWishlist')->name('user.delete-all-wishlist');

// cart
Route::get('cart', 'Frontend\CartsController@viewCart')->name('user.cart')->middleware('prevent-back-history');
Route::get('/load-cart-data','Frontend\CartsController@cartCount');
Route::post('update-cart/{id}', 'Frontend\CartsController@updateCartItem');
Route::post('delete-cart-item', 'Frontend\CartsController@removeCart');
Route::post('update-cart', 'Frontend\CartsController@updateCart');
Route::post('delete-all', 'Frontend\CartsController@clearCart');

// checkout
Route::get('/checkout', 'Frontend\CheckoutController@checkout')->name('checkout')->middleware('prevent-back-history');
Route::post('insert-address', 'Frontend\CheckoutController@add_address')->name('delivery-address');
Route::post('place-order', 'Frontend\CheckoutController@placeOrder');
Route::get('paypal', 'Frontend\PaypalController@index');
Route::post('place-order-via-paypal', 'Frontend\PaypalController@store');
Route::get('gcash', 'Frontend\GCashController@index')->name('pay.gcash');
Route::get('download-qr', function () {
    // localhost
    // $file= public_path()."/frontend/assets/images/qr_code.jpg";
    // production
    $file = '/home/u903542296/domains/realvalueenterprise.online/public_html/frontend/assets/images/qr_code.jpg';
    return Response::download($file);
})->name('gcash.download');

Route::post('pay-via-gcash', 'Frontend\GCashController@store')->name('payment.gcash');

// orders
Route::get('my-orders','Frontend\UserController@index')->name('user.all.orders')->middleware('prevent-back-history');
Route::get('view-order/{id}','Frontend\UserController@view')->middleware('prevent-back-history');
Route::get('order-item/{id}/request-return-product', 'Frontend\UserController@request_return')->name('user.request-return');
Route::put('user-cancel-order/{id}','Frontend\UserController@cancel_order');
Route::post('return-order-id-{order_id}/order-item-{item_id}','Frontend\UserController@request_return_item')->name('user.order.request-return');

// orders filter
Route::get('my-orders/pending','Frontend\UserController@pending')->name('user.pending.orders')->middleware('prevent-back-history');
Route::get('my-orders/processing-orders','Frontend\UserController@processing_orders')->name('user.processing.orders')->middleware('prevent-back-history');
Route::get('my-orders/for-delivery','Frontend\UserController@delivery')->name('user.for-delivery.orders')->middleware('prevent-back-history');
Route::get('my-orders/delivered','Frontend\UserController@completed')->name('user.delivered.orders')->middleware('prevent-back-history');
Route::get('my-orders/cancelled','Frontend\UserController@cancelled')->name('user.cancelled.orders')->middleware('prevent-back-history');

Route::get('my-profile/dashboard', 'Frontend\ProfileController@dashboard')->name('user.dashboard')->middleware('prevent-back-history');
Route::get('my-profile','Frontend\ProfileController@index')->name('user.profile')->middleware('prevent-back-history');

Route::put('update-account', 'Frontend\ProfileController@update_account')->name('user.update-account');
Route::get('my-address','Frontend\ProfileController@my_address')->name('user.address')->middleware('prevent-back-history');

Route::get('edit-my-address/{id}', 'Frontend\ProfileController@edit')->name('user.edit-address')->middleware('prevent-back-history');
Route::put('update-address/{id}', 'Frontend\ProfileController@update');
Route::post('delete-address','Frontend\ProfileController@deleteAddress');


// user logout
// Route::post('users/logout', 'Auth\LoginController@userLogout')->name('users.logout');


#region ADMIN ROUTES
Route::prefix('/admin')->group(function () {
    // Login routes
    Route::get('/login', 'AuthAdmin\LoginController@formlogin')->name('authadmin.login');
    Route::post('/login', 'AuthAdmin\LoginController@login')->name('admin.login.submit');

    // Password reset routes
    Route::post('/password/email', 'AuthAdmin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset', 'AuthAdmin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset', 'AuthAdmin\ResetPasswordController@reset');
    Route::get('/password/reset/{token}', 'AuthAdmin\ResetPasswordController@showResetForm')->name('admin.password.reset');

    // routes for admin dashboard
    Route::get('/', 'Admin\AdminController@admin_index')->name('admin.dashboard')->middleware('prevent-back-history');
    // real time functions -- admin dashboard
    Route::get('/get-order-COD', 'Admin\AdminController@getCount')->name('route_for_new_data_here');
    Route::get('/get-order-OP', 'Admin\AdminController@getCountOnlinePayment')->name('route_for_new_online_payment_here');
    Route::get('/count-users', 'Admin\AdminController@countUsers')->name('admin.count.users');
    Route::get('/count-critical-stocks', 'Admin\AdminController@countCrits')->name('admin.count.crits');
    Route::get('/get-order-completed', 'Admin\AdminController@getCompleted')->name('admin.count.completed');
    Route::get('/get-product-returns', 'Admin\AdminController@countReturns')->name('admin.count.returns');
    Route::get('/get-orders-online', 'Admin\AdminController@countOnOrders')->name('admin.count.online.orders');
    Route::get('/get-online-sales', 'Admin\AdminController@getOnSales')->name('admin.count.onsales');
    Route::get('/get-walkin-transactions', 'Admin\AdminController@getWalk')->name('admin.count.walk');
    Route::get('/get-walkin-sales', 'Admin\AdminController@getWalkSales')->name('admin.count.walksales');
    Route::get('/ajax-cod', 'Admin\AdminController@ajax')->name('admin.data');
    Route::get('/ajax-op', 'Admin\AdminController@ajaxOP')->name('admin.data-op');

    // real time functions -- delivery dashboard
    Route::get('/delivery/ajax-orders', 'Admin\Delivery\DeliveryController@ajaxTable')->name('admin.ajax.table.delivery');
    Route::get('/delivery/ajax-orders-pending', 'Admin\Delivery\DeliveryController@ajaxTablePending')->name('admin.ajax.table.pending.delivery');
    Route::get('/delivery/ajax-orders-processing', 'Admin\Delivery\DeliveryController@ajaxTableProcessing')->name('admin.ajax.table.processing.delivery');
    Route::get('/delivery/ajax-orders-delivery', 'Admin\Delivery\DeliveryController@ajaxTableDelivery')->name('admin.ajax.table.delivery.delivery');
    Route::get('/delivery/ajax-orders-delivered', 'Admin\Delivery\DeliveryController@ajaxTableDelivered')->name('admin.ajax.table.delivered.delivery');
    Route::get('/delivery/ajax-orders-cancelled', 'Admin\Delivery\DeliveryController@ajaxTableCancelled')->name('admin.ajax.table.cancelled.delivery');
    Route::get('/ajax-delivery', 'Admin\Delivery\DeliveryController@ajaxDelivery')->name('admin.ajax.delivery');
    Route::get('/get-order-all', 'Admin\Delivery\DeliveryController@getCountAll')->name('admin.delivery.count-all');
    Route::get('/get-order-pending', 'Admin\Delivery\DeliveryController@getCountPending')->name('admin.delivery.count-pending');
    Route::get('/get-order-processing', 'Admin\Delivery\DeliveryController@getCountProcessing')->name('admin.delivery.count-processing');
    Route::get('/get-order-delivery', 'Admin\Delivery\DeliveryController@getCountDelivery')->name('admin.delivery.count-delivery');
    Route::get('/get-order-delivered', 'Admin\Delivery\DeliveryController@getCountCompleted')->name('admin.delivery.count-completed');
    Route::get('/get-order-cancelled', 'Admin\Delivery\DeliveryController@getCountCancelled')->name('admin.delivery.count-cancelled');
    Route::get('/count-orders-for-delivery', 'Admin\Delivery\DeliveryController@getDelivery')->name('admin.delivery.count.delivery-badge');

    // real time functions -- cashier dashboard
    Route::get('/get-products-count', 'Admin\Cashier\CashierController@getCount')->name('admin.cashier.count-prods');


    Route::post('/admin/logout', 'AuthAdmin\LoginController@logout')->name('admin.logout');

    // banners
    Route::get('banners', 'Admin\BannerController@index')->name('admin.banners')->middleware('prevent-back-history');
    Route::get('add-banners', 'Admin\BannerController@add')->name('admin.add.banner')->middleware('prevent-back-history');
    Route::post('insert/banner', 'Admin\BannerController@insert')->name('admin.insert-banner');
    Route::get('edit-banner/{id}', 'Admin\BannerController@edit')->name('admin.edit.banner')->middleware('prevent-back-history');
    Route::post('update-banner/{id}', 'Admin\BannerController@update');
    Route::post('delete-banner', 'Admin\BannerController@delete');

    // ratings
    Route::get('products-rating-and-reviews', 'Admin\RatingController@index')->name('admin.ratings')->middleware('prevent-back-history');
    Route::post('update-rating-status', 'Admin\RatingController@updateRatingStatus');


    // category crud
    Route::get('/categories','Admin\CategoryController@index')->name('admin.categories')->middleware('prevent-back-history');
    Route::get('/add-category','Admin\CategoryController@add')->name('admin.add-category')->middleware('prevent-back-history');
    Route::post('insert-category','Admin\CategoryController@insert');
    Route::get('edit-category/{id}', 'Admin\CategoryController@edit')->name('admin.edit-category')->middleware('prevent-back-history');
    Route::put('update-category/{id}', 'Admin\CategoryController@update');
    Route::get('delete-category/{id}', 'Admin\CategoryController@destroy');
    Route::post('delete-category', 'Admin\CategoryController@delete');

    // product crud
    Route::get('/products', 'Admin\ProductsController@index')->name('admin.products')->middleware('prevent-back-history');
    Route::get('/add-product','Admin\ProductsController@add')->name('admin.add-product')->middleware('prevent-back-history');
    Route::post('insert-product','Admin\ProductsController@insert');
    Route::get('edit-product/{id}', 'Admin\ProductsController@edit')->name('admin.edit-product')->middleware('prevent-back-history');
    Route::put('update-product/{id}', 'Admin\ProductsController@update');
    Route::get('delete-product/{id}', 'Admin\ProductsController@destroy');
    Route::post('delete-product', 'Admin\ProductsController@delete');

    // product unit crud
    Route::get('/products-unit', 'Admin\ProductsUnitController@index')->name('admin.products-unit')->middleware('prevent-back-history');
    Route::get('/add-product-unit','Admin\ProductsUnitController@add')->name('admin.add-product-unit')->middleware('prevent-back-history');
    Route::post('/insert-product-unit','Admin\ProductsUnitController@insert');
    Route::get('edit-product-unit/{id}', 'Admin\ProductsUnitController@edit')->name('admin.edit-product-unit')->middleware('prevent-back-history');
    Route::put('update-product-unit/{id}', 'Admin\ProductsUnitController@update');
    Route::post('delete-product-unit', 'Admin\ProductsUnitController@delete');


    // critical stocks of products
    Route::get('/products/critical-stocks', 'Admin\ProductsController@index1')->name('admin.critical-stocks')->middleware('prevent-back-history');

    // routes for customers
    Route::get('/customers', 'Admin\AdminController@customer_index')->name('admin.customers')->middleware('prevent-back-history');
    Route::get('/load-orders-data','Admin\AdminController@ordersCount');

    // Order
    Route::get('view-orders', 'Admin\OrderController@index')->name('admin.orders')->middleware('prevent-back-history');
    Route::get('view-orders/pending', 'Admin\OrderController@view_order_pending')->name('admin.view-order.pending')->middleware('prevent-back-history');
    Route::get('view-orders/processing', 'Admin\OrderController@view_order_processing')->name('admin.view-order.processing')->middleware('prevent-back-history');
    Route::get('view-orders/for-delivery', 'Admin\OrderController@view_order_for_delivery')->name('admin.view-order.for-delivery')->middleware('prevent-back-history');
    Route::get('view-orders/delivered', 'Admin\OrderController@view_order_delivered')->name('admin.view-order.delivered')->middleware('prevent-back-history');
    Route::get('view-orders/request-cancel', 'Admin\OrderController@view_order_request_cancel')->name('admin.view-order.request-cancel')->middleware('prevent-back-history');
    Route::get('view-orders/cancelled-returned', 'Admin\OrderController@view_order_cancelled_returned')->name('admin.view-order.cancelled-returned')->middleware('prevent-back-history');
    Route::get('download-proof/{id}', 'Admin\OrderController@downloadImg')->name('order.download');

    // real time table update

    Route::get('/admin/ajax-orders', 'Admin\AdminController@ajaxTable')->name('admin.ajax.table.orders');
    Route::get('/admin/ajax-orders-pending', 'Admin\AdminController@ajaxTablePending')->name('admin.ajax.table.pending.orders');
    Route::get('/admin/ajax-orders-processing', 'Admin\AdminController@ajaxTableProcessing')->name('admin.ajax.table.processing.orders');
    Route::get('/admin/ajax-orders-delivery', 'Admin\AdminController@ajaxTableDelivery')->name('admin.ajax.table.delivery.orders');
    Route::get('/admin/ajax-orders-delivered', 'Admin\AdminController@ajaxTableDelivered')->name('admin.ajax.table.delivered.orders');
    Route::get('/admin/ajax-orders-cancelled', 'Admin\AdminController@ajaxTableCancelled')->name('admin.ajax.table.cancelled.orders');

    // Walkin Order
    Route::get('/admin/ajax-walkin-orders', 'Admin\WalkinOrderController@ajaxTable')->name('admin.ajax.walkin');
    Route::get('view-walkin-orders', 'Admin\WalkinOrderController@index')->name('admin.walkin.orders')->middleware('prevent-back-history');
    Route::get('order-transaction/walkin-view-order/{id}', 'Admin\WalkinOrderController@view')->name('admin.walkin.order.view')->middleware('prevent-back-history');

    Route::get('view-update-order/{id}', 'Admin\OrderController@view')->name('admin.order.update')->middleware('prevent-back-history');


    Route::put('view-cancel-order/{id}', 'Admin\OrderController@cancel_order');
    Route::get('generate-invoice/{id}', 'Admin\OrderController@invoice');
    Route::get('generate-pdf-invoice/{id}', 'Admin\OrderController@pdfInvoice');
    Route::put('update-order/{id}', 'Admin\OrderController@updateOrder');

    // Delivery module

    Route::get('/delivery-record', 'Admin\AdminController@delivery')->name('admin.delivery')->middleware('prevent-back-history');
    Route::get('/delivery/ajax-view-delivery-records', 'Admin\AdminController@ajaxDeliveryRecordTable')->name('admin.view.delivery.record');
    Route::put('/delivery-record/edit/{id}', 'Admin\AdminController@edit_delivery');
    Route::get('/delivery-details/{id}', 'Admin\AdminController@delivery_details')->name('admin.delivery-details')->middleware('prevent-back-history');

    // Return products module
    Route::get('/return-products', 'Admin\AdminController@view_return_products')->name('admin.return-products')->middleware('prevent-back-history');
    Route::get('/admin/ajax-returns', 'Admin\AdminController@ajaxReturnTable')->name('admin.ajax.returns');
    Route::put('/return-product/{id}', 'Admin\AdminController@update');

    // routes for reports
    Route::get('/reports/orders', 'Admin\AdminController@report_orders')->name('admin.reports.orders');
    Route::get('/reports/inventory', 'Admin\AdminController@report_inventory')->name('admin.reports.inventory')->middleware('prevent-back-history');
    Route::get('generate-pdf-inventory', 'Admin\AdminController@pdfInventory')->name('admin.report.inventorypdf');

    // overall sales
    Route::get('/reports/overall-sales', 'Admin\OverallSalesController@index')->name('admin.reports.overall.sales')->middleware('prevent-back-history');
    Route::post('/reports/overall-sales/search-date', 'Admin\OverallSalesController@search')->name('admin.reports.overall.sales.search-from-date')->middleware('prevent-back-history');
    Route::get('/reports/overall-sales/filter-by-yesterday', 'Admin\OverallSalesController@report_sales_yesterday')->name('admin.reports.overall.sales.yesterday')->middleware('prevent-back-history');
    Route::get('/reports/overall-sales/filter-by-last-7-days', 'Admin\OverallSalesController@report_sales_last_7_days')->name('admin.reports.overall.sales.last-7-days')->middleware('prevent-back-history');
    Route::get('/reports/overall-sales/filter-by-this-month', 'Admin\OverallSalesController@report_sales_this_month')->name('admin.reports.overall.sales.this-month')->middleware('prevent-back-history');

    // online sales
    Route::get('/reports/online-sales', 'Admin\OnlineSalesController@report_sales')->name('admin.reports.online.sales')->middleware('prevent-back-history');
    Route::post('/reports/online-sales/search-date', 'Admin\OnlineSalesController@search')->name('admin.reports.online.sales.search-from-date')->middleware('prevent-back-history');
    Route::get('/reports/online-sales/filter-by-yesterday', 'Admin\OnlineSalesController@report_sales_yesterday')->name('admin.reports.online.sales.yesterday')->middleware('prevent-back-history');
    Route::get('/reports/online-sales/filter-by-last-7-days', 'Admin\OnlineSalesController@report_sales_last_7_days')->name('admin.reports.online.sales.last-7-days')->middleware('prevent-back-history');
    Route::get('/reports/online-sales/filter-by-this-month', 'Admin\OnlineSalesController@report_sales_this_month')->name('admin.reports.online.sales.this-month')->middleware('prevent-back-history');

    // walkin sales
    Route::get('/reports/walk-in-sales', 'Admin\WalkinSalesController@report_sales')->name('admin.reports.walkin.sales')->middleware('prevent-back-history');
    Route::post('/reports/walk-in-sales/search-date', 'Admin\WalkinSalesController@search')->name('admin.reports.walkin.sales.search-from-date')->middleware('prevent-back-history');
    Route::get('/reports/walk-in-sales/filter-by-yesterday',   'Admin\WalkinSalesController@report_sales_yesterday')->name('admin.reports.walkin.sales.yesterday')->middleware('prevent-back-history');
    Route::get('/reports/walk-in-sales/filter-by-last-7-days', 'Admin\WalkinSalesController@report_sales_last_7_days')->name('admin.reports.walkin.sales.last-7-days')->middleware('prevent-back-history');
    Route::get('/reports/walk-in-sales/filter-by-this-month',  'Admin\WalkinSalesController@report_sales_this_month')->name('admin.reports.walkin.sales.this-month')->middleware('prevent-back-history');

    // routes for user-management
    Route::get('/user-management', 'Admin\UserManagementController@index')->name('admin.user-management')->middleware('prevent-back-history');
    Route::get('/add-user-account', 'Admin\UserManagementController@add')->name('admin.add-user')->middleware('prevent-back-history');
    Route::post('insert-user','Admin\UserManagementController@insert');
    Route::get('/edit-user-account/{id}', 'Admin\UserManagementController@edit')->name('admin.edit-user')->middleware('prevent-back-history');
    Route::put('update-user-account/{id}', 'Admin\UserManagementController@update');
    Route::post('delete-user-account', 'Admin\UserManagementController@delete');

    // Trashed
    Route::get('/trashed/products-unit', 'Admin\TrashController@units_index')->name('trash.productsUnits')->middleware('prevent-back-history');
    Route::get('/trashed/restore/products-unit/{id}', 'Admin\TrashController@units_restore')->name('units.restore')->middleware('prevent-back-history');
    Route::get('/trashed/restore-all/products-unit', 'Admin\TrashController@restoreAllUnits')->name('units.restore-all')->middleware('prevent-back-history');

    Route::get('/trashed/products', 'Admin\TrashController@products_index')->name('trash.products')->middleware('prevent-back-history');
    Route::get('/trashed/restore/products/{id}', 'Admin\TrashController@products_restore')->name('products.restore')->middleware('prevent-back-history');
    Route::get('/trashed/restore-all/products', 'Admin\TrashController@restoreAllProducts')->name('products.restore-all')->middleware('prevent-back-history');

    Route::get('/trashed/banners', 'Admin\TrashController@banners_index')->name('trash.banners')->middleware('prevent-back-history');
    Route::get('/trashed/restore/banner/{id}', 'Admin\TrashController@banner_restore')->name('banner.restore')->middleware('prevent-back-history');
    Route::get('/trashed/permanent-delete-banner/{id}', 'Admin\TrashController@banner_delete')->name('banner.delete')->middleware('prevent-back-history');
    Route::get('/trashed/restore-all/banners', 'Admin\TrashController@restoreAllBanners')->name('banners.restore-all')->middleware('prevent-back-history');


    Route::get('/trashed/categories', 'Admin\TrashController@categories_index')->name('trash.categories')->middleware('prevent-back-history');
    Route::get('/trashed/restore/categories/{id}', 'Admin\TrashController@categories_restore')->name('categories.restore')->middleware('prevent-back-history');
    Route::get('/trashed/restore-all/categories', 'Admin\TrashController@restoreAllCategories')->name('categories.restore-all')->middleware('prevent-back-history');

    Route::get('/trashed/admin-user-accounts', 'Admin\TrashController@userAccounts_index')->name('trash.userAccounts')->middleware('prevent-back-history');
    Route::get('/trashed/restore/admin-user-accounts/{id}', 'Admin\TrashController@userAccounts_restore')->name('userAccounts.restore')->middleware('prevent-back-history');
    Route::get('/trashed/restore-all/admin-user-accounts', 'Admin\TrashController@restoreAllUserAccount')->name('userAccounts.restore-all')->middleware('prevent-back-history');


    // cashier
    Route::get('view-products', 'Admin\Cashier\CashierController@view_products')->name('admin.cashier.viewproducts')->middleware('prevent-back-history');
    Route::get('view-critical-stocks', 'Admin\Cashier\CashierController@view_critical_stocks')->name('admin.cashier.view.critical-stocks')->middleware('prevent-back-history');
    Route::get('point-of-sales', 'Admin\Cashier\CashierController@pos')->name('admin.cashier.pos')->middleware('prevent-back-history');
    Route::post('place-order', 'Admin\Cashier\CashierController@placeOrder')->name('admin.cashier.submit');
    // Route::get('place-order/{id}', 'Admin\Cashier\CashierController@placeOrder');

    Route::get('walk-in-transactions', 'Admin\Cashier\CashierController@walkIn')->name('admin.cashier.transaction')->middleware('prevent-back-history');
    Route::get('/cashier/walkin-view-order/{id}', 'Admin\Cashier\CashierController@view')->name('admin.cashier.view')->middleware('prevent-back-history');

    Route::get('/cashier/walkin-order-generate-pdf-invoice/{id}', 'Admin\Cashier\CashierController@pdfInvoice');

    Route::get('/cashier/reports/walk-in-sales', 'Admin\Cashier\WalkinSalesController@report_sales')->name('admin.cashier.reports.walkin.sales')->middleware('prevent-back-history');
    Route::post('/cashier/reports/walk-in-sales/search-date', 'Admin\Cashier\WalkinSalesController@search')->name('admin.cashier.reports.walkin.sales.search-from-date')->middleware('prevent-back-history');
    Route::get('/cashier/reports/walk-in-sales/filter-by-yesterday',   'Admin\Cashier\WalkinSalesController@report_sales_yesterday')->name('admin.cashier.reports.walkin.sales.yesterday')->middleware('prevent-back-history');
    Route::get('/cashier/reports/walk-in-sales/filter-by-last-7-days', 'Admin\Cashier\WalkinSalesController@report_sales_last_7_days')->name('admin.cashier.reports.walkin.sales.last-7-days')->middleware('prevent-back-history');
    Route::get('/cashier/reports/walk-in-sales/filter-by-this-month',  'Admin\Cashier\WalkinSalesController@report_sales_this_month')->name('admin.cashier.reports.walkin.sales.this-month')->middleware('prevent-back-history');

    // delivery
    Route::get('delivery/manage-orders/for-delivery', 'Admin\Delivery\DeliveryController@index')->name('admin.delivery.manage-order')->middleware('prevent-back-history');
    Route::get('delivery/view-update-order/{id}', 'Admin\Delivery\DeliveryController@view')->name('admin.delivery.view-update.order')->middleware('prevent-back-history');

    Route::get('delivery/generate-invoice/{id}', 'Admin\Delivery\DeliveryController@invoice');
    Route::get('delivery/generate-pdf-invoice/{id}', 'Admin\Delivery\DeliveryController@pdfInvoice');

    Route::put('delivery/update-order/{id}', 'Admin\Delivery\DeliveryController@updateOrder');
    Route::get('delivery/order', 'Admin\Delivery\DeliveryController@view_order')->name('admin.delivery.view-order')->middleware('prevent-back-history');
    Route::get('delivery/order/pending', 'Admin\Delivery\DeliveryController@view_order_pending')->name('admin.delivery.view-order.pending')->middleware('prevent-back-history');
    Route::get('delivery/order/processing', 'Admin\Delivery\DeliveryController@view_order_processing')->name('admin.delivery.view-order.processing')->middleware('prevent-back-history');
    Route::get('delivery/order/for-delivery', 'Admin\Delivery\DeliveryController@view_order_for_delivery')->name('admin.delivery.view-order.for-delivery')->middleware('prevent-back-history');
    Route::get('delivery/order/delivered', 'Admin\Delivery\DeliveryController@view_order_delivered')->name('admin.delivery.view-order.delivered')->middleware('prevent-back-history');
    Route::get('delivery/order/cancelled-returned', 'Admin\Delivery\DeliveryController@view_order_cancelled_returned')->name('admin.delivery.view-order.cancelled-returned')->middleware('prevent-back-history');
});
#endregion
