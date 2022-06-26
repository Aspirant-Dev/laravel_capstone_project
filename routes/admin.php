<?php

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
    Route::get('/', 'Admin\AdminController@admin_index')->name('admin.dashboard');
    Route::post('/admin/logout', 'AuthAdmin\LoginController@logout')->name('admin.logout');

    // category crud
    Route::get('/categories','Admin\CategoryController@index')->name('admin.categories');
    Route::get('/add-category','Admin\CategoryController@add')->name('admin.add-category');
    Route::post('insert-category','Admin\CategoryController@insert');
    Route::get('edit-category/{id}', 'Admin\CategoryController@edit')->name('admin.edit-category');
    Route::put('update-category/{id}', 'Admin\CategoryController@update');
    Route::get('delete-category/{id}', 'Admin\CategoryController@destroy');
    Route::post('delete-category', 'Admin\CategoryController@delete');

    // product crud
    Route::get('/products', 'Admin\ProductsController@index')->name('admin.products');
    Route::get('/add-product','Admin\ProductsController@add')->name('admin.add-product');
    Route::post('insert-product','Admin\ProductsController@insert');
    Route::get('edit-product/{id}', 'Admin\ProductsController@edit')->name('admin.edit-product');
    Route::put('update-product/{id}', 'Admin\ProductsController@update');
    Route::get('delete-product/{id}', 'Admin\ProductsController@destroy');
    Route::post('delete-product', 'Admin\ProductsController@delete');

    // product unit crud
    Route::get('/products-unit', 'Admin\ProductsUnitController@index')->name('admin.products-unit');
    Route::get('/add-product-unit','Admin\ProductsUnitController@add')->name('admin.add-product-unit');
    Route::post('/insert-product-unit','Admin\ProductsUnitController@insert');
    Route::get('edit-product-unit/{id}', 'Admin\ProductsUnitController@edit')->name('admin.edit-product-unit');
    Route::put('update-product-unit/{id}', 'Admin\ProductsUnitController@update');
    Route::post('delete-product-unit', 'Admin\ProductsUnitController@delete');


    // critical stocks of products
    Route::get('/products/critical-stocks', 'Admin\ProductsController@index1')->name('admin.critical-stocks');

    // routes for customers
    Route::get('/customers', 'Admin\AdminController@customer_index')->name('admin.customers');

    // Order
    Route::get('view-orders', 'Admin\OrderController@index')->name('admin.orders');
    Route::get('view-orders/pending', 'Admin\OrderController@view_order_pending')->name('admin.view-order.pending');
    Route::get('view-orders/processing', 'Admin\OrderController@view_order_processing')->name('admin.view-order.processing');
    Route::get('view-orders/for-delivery', 'Admin\OrderController@view_order_for_delivery')->name('admin.view-order.for-delivery');
    Route::get('view-orders/delivered', 'Admin\OrderController@view_order_delivered')->name('admin.view-order.delivered');
    Route::get('view-orders/request-cancel', 'Admin\OrderController@view_order_request_cancel')->name('admin.view-order.request-cancel');
    Route::get('view-orders/cancelled-returned', 'Admin\OrderController@view_order_cancelled_returned')->name('admin.view-order.cancelled-returned');

    // Walkin Order
    Route::get('view-walkin-orders', 'Admin\WalkinOrderController@index')->name('admin.walkin.orders');
    Route::get('order-transaction/walkin-view-order/{id}', 'Admin\WalkinOrderController@view')->name('admin.walkin.order.view');


    Route::get('view-update-order/{id}', 'Admin\OrderController@view')->name('admin.order.update');
    Route::get('generate-invoice/{id}', 'Admin\OrderController@invoice');
    Route::get('generate-pdf-invoice/{id}', 'Admin\OrderController@pdfInvoice');
    Route::put('update-order/{id}', 'Admin\OrderController@updateOrder');

    // Delivery module
    Route::get('/delivery-record', 'Admin\AdminController@delivery')->name('admin.delivery');

    // Return products module
    Route::get('/return-products', 'Admin\AdminController@view_return_products')->name('admin.return-products');
    Route::put('/return-product/{id}', 'Admin\AdminController@update');

    // routes for reports
    Route::get('/reports/orders', 'Admin\AdminController@report_orders')->name('admin.reports.orders');
    Route::get('/reports/inventory', 'Admin\AdminController@report_inventory')->name('admin.reports.inventory');

    // online sales
    Route::get('/reports/online-sales', 'Admin\OnlineSalesController@report_sales')->name('admin.reports.online.sales');
    Route::post('/reports/online-sales/search-date', 'Admin\OnlineSalesController@search')->name('admin.reports.online.sales.search-from-date');
    Route::get('/reports/online-sales/filter-by-yesterday', 'Admin\OnlineSalesController@report_sales_yesterday')->name('admin.reports.online.sales.yesterday');
    Route::get('/reports/online-sales/filter-by-last-7-days', 'Admin\OnlineSalesController@report_sales_last_7_days')->name('admin.reports.online.sales.last-7-days');
    Route::get('/reports/online-sales/filter-by-this-month', 'Admin\OnlineSalesController@report_sales_this_month')->name('admin.reports.online.sales.this-month');

    // walkin sales
    Route::get('/reports/walk-in-sales', 'Admin\WalkinSalesController@report_sales')->name('admin.reports.walkin.sales');
    Route::post('/reports/walk-in-sales/search-date', 'Admin\WalkinSalesController@search')->name('admin.reports.walkin.sales.search-from-date');
    Route::get('/reports/walk-in-sales/filter-by-yesterday',   'Admin\WalkinSalesController@report_sales_yesterday')->name('admin.reports.walkin.sales.yesterday');
    Route::get('/reports/walk-in-sales/filter-by-last-7-days', 'Admin\WalkinSalesController@report_sales_last_7_days')->name('admin.reports.walkin.sales.last-7-days');
    Route::get('/reports/walk-in-sales/filter-by-this-month',  'Admin\WalkinSalesController@report_sales_this_month')->name('admin.reports.walkin.sales.this-month');

    // routes for user-management
    Route::get('/user-management', 'Admin\UserManagementController@index')->name('admin.user-management');
    Route::get('/add-user-account', 'Admin\UserManagementController@add')->name('admin.add-user');
    Route::post('insert-user','Admin\UserManagementController@insert');
    Route::get('/edit-user-account/{id}', 'Admin\UserManagementController@edit')->name('admin.edit-user');
    Route::put('update-user-account/{id}', 'Admin\UserManagementController@update');
    Route::post('delete-user-account', 'Admin\UserManagementController@delete');


    // cashier
    Route::get('view-products', 'Admin\Cashier\CashierController@view_products')->name('admin.cashier.viewproducts');
    Route::get('view-critical-stocks', 'Admin\Cashier\CashierController@view_critical_stocks')->name('admin.cashier.view.critical-stocks');
    Route::get('point-of-sales', 'Admin\Cashier\CashierController@pos')->name('admin.cashier.pos');
    Route::post('place-order', 'Admin\Cashier\CashierController@placeOrder')->name('admin.cashier.submit');

    Route::get('walk-in-transactions', 'Admin\Cashier\CashierController@walkIn')->name('admin.cashier.transaction');
    Route::get('walkin-view-order/{id}', 'Admin\Cashier\CashierController@view')->name('admin.cashier.view');

    Route::get('/cashier/reports/walk-in-sales', 'Admin\Cashier\WalkinSalesController@report_sales')->name('admin.cashier.reports.walkin.sales');
    Route::post('/cashier/reports/walk-in-sales/search-date', 'Admin\Cashier\WalkinSalesController@search')->name('admin.cashier.reports.walkin.sales.search-from-date');
    Route::get('/cashier/reports/walk-in-sales/filter-by-yesterday',   'Admin\Cashier\WalkinSalesController@report_sales_yesterday')->name('admin.cashier.reports.walkin.sales.yesterday');
    Route::get('/cashier/reports/walk-in-sales/filter-by-last-7-days', 'Admin\Cashier\WalkinSalesController@report_sales_last_7_days')->name('admin.cashier.reports.walkin.sales.last-7-days');
    Route::get('/cashier/reports/walk-in-sales/filter-by-this-month',  'Admin\Cashier\WalkinSalesController@report_sales_this_month')->name('admin.cashier.reports.walkin.sales.this-month');

    // delivery
    Route::get('delivery/manage-orders/for-delivery', 'Admin\Delivery\DeliveryController@index')->name('admin.delivery.manage-order');
    Route::get('delivery/view-update-order/{id}', 'Admin\Delivery\DeliveryController@view')->name('admin.delivery.view-update.order');

    Route::get('delivery/generate-invoice/{id}', 'Admin\Delivery\DeliveryController@invoice');
    Route::get('delivery/generate-pdf-invoice/{id}', 'Admin\Delivery\DeliveryController@pdfInvoice');

    Route::put('delivery/update-order/{id}', 'Admin\Delivery\DeliveryController@updateOrder');
    Route::get('delivery/order', 'Admin\Delivery\DeliveryController@view_order')->name('admin.delivery.view-order');
    Route::get('delivery/order/pending', 'Admin\Delivery\DeliveryController@view_order_pending')->name('admin.delivery.view-order.pending');
    Route::get('delivery/order/processing', 'Admin\Delivery\DeliveryController@view_order_processing')->name('admin.delivery.view-order.processing');
    Route::get('delivery/order/for-delivery', 'Admin\Delivery\DeliveryController@view_order_for_delivery')->name('admin.delivery.view-order.for-delivery');
    Route::get('delivery/order/delivered', 'Admin\Delivery\DeliveryController@view_order_delivered')->name('admin.delivery.view-order.delivered');
    Route::get('delivery/order/cancelled-returned', 'Admin\Delivery\DeliveryController@view_order_cancelled_returned')->name('admin.delivery.view-order.cancelled-returned');
});
