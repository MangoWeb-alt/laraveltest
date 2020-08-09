<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Home
Route::get('/','Home_Controller@index');
Route::get('/Home','Home_Controller@index');
Route::get('/404','Home_Controller@errors_page');

//search
Route::get('/show-search','Home_Controller@show_search');
Route::post('/search','Home_Controller@search');

//admin
Route::get('/dashboard','Admin_Controller@show_dashboard');
Route::get('/admin','Admin_Controller@admin');
Route::post('/admin-login','Admin_Controller@admin_login');
Route::get('/logout','Admin_Controller@logout');
//category
Route::get('/add-category','Category_Controller@add_category');
Route::post('/save-category','Category_Controller@save_category');
Route::get('/category-list','Category_Controller@category_list');
Route::get('/non-active-category/{category_id}','Category_Controller@non_active_category');
Route::get('/active-category/{category_id}','Category_Controller@active_category');
Route::get('/edit-category/{category_id}','Category_Controller@show_edit_category');
Route::post('/update-category/{category_id}','Category_Controller@update_category');
Route::get('/delete-category/{category_id}','Category_Controller@delete_category');
Route::get('/show-category/{category_id}','Category_Controller@show_category');
Route::post('/export-csv','Category_Controller@export_csv');
Route::post('/import-csv','Category_Controller@import_csv');

//brand
Route::get('/add-brand','Brand_Controller@add_brand');
Route::post('/save-brand','Brand_Controller@save_brand');
Route::get('/brand-list','Brand_Controller@brand_list');
Route::get('/non-active-brand/{brand_id}','Brand_Controller@non_active_brand');
Route::get('/active-brand/{brand_id}','Brand_Controller@active_brand');
Route::get('/edit-brand/{brand_id}','Brand_Controller@show_edit_brand');
Route::post('/update-brand/{brand_id}','Brand_Controller@update_brand');
Route::get('/delete-brand/{brand_id}','Brand_Controller@delete_brand');
Route::get('/show-brand/{brand_id}','Brand_Controller@show_brand');

//product
Route::get('/add-product','Product_Controller@add_product');
Route::post('/save-product','Product_Controller@save_product');
Route::get('/product-list','Product_Controller@all_product');
Route::get('/non-active-product/{product_id}','Product_Controller@non_active_product');
Route::get('/active-product/{product_id}','Product_Controller@active_product');
Route::get('/edit-product/{product_id}','Product_Controller@edit_product');
Route::post('/update-product/{product_id}','Product_Controller@update_product');
Route::get('/delete-product/{product_id}','Product_Controller@delete_product');
Route::get('/product-details/{product_id}','Product_Controller@product_details');

//cart
Route::get('/add-to-cart','Cart_Controller@add_to_cart');
Route::get('/show-cart-ajax','Cart_Controller@show_cart_ajax');
Route::post('/add-cart-ajax','Cart_Controller@add_cart_ajax');
Route::post('/save-cart','Cart_Controller@save_cart');
Route::post('/update-quantity/{rowId}','Cart_Controller@update_quantity');
Route::post('/update-cart-ajax','Cart_Controller@update_cart_ajax');
Route::get('/delete-cart-ajax/{session_id}','Cart_Controller@delete_cart_ajax');
Route::get('/delete-cart/{rowId}','Cart_Controller@delete_cart');
Route::get('/unset-discount-code','Cart_Controller@unset_discount_code');

//Coupon
Route::post('/check-coupon','Cart_Controller@Check_coupon');
Route::get('/insert-coupon','Coupon_Controller@insert_coupon');
Route::post('/add-coupon','Coupon_Controller@add_coupon');
Route::get('/coupon-list','Coupon_Controller@coupon_list');
Route::get('/delete-coupon/{coupon_id}','Coupon_Controller@delete_coupon');


//customer
Route::get('/login-checkout','Customer_Controller@login_checkout');
Route::post('/login-customer','Customer_Controller@login_customer');
Route::post('/save-checkout','Customer_Controller@save_checkout');
Route::get('/logout-customer','Customer_Controller@logout');

//checkout
Route::get('/checkout','Checkout_Controller@checkout');
Route::post('/save-checkout','Checkout_Controller@save_checkout');
Route::post('/select-delivery-checkout','Checkout_Controller@select_delivery_checkout');
Route::post('/delivery-cost-checkout','Checkout_Controller@delivery_cost_checkout');
Route::post('/update-cart-ajax-checkout','Checkout_Controller@update_cart_ajax_checkout');
Route::get('/delete-cart-ajax-checkout/{session_id}','Checkout_Controller@delete_cart_ajax_checkout');
Route::get('/unset-discount-code-checkout','Checkout_Controller@unset_discount_code_checkout');
Route::post('/confirm-order','Checkout_Controller@confirm_order');
Route::post('/calculate-fee','Checkout_Controller@calculate_fee');
Route::get('/del-fee','Checkout_Controller@del_fee');

//payment
Route::get('/payment','Payment_Controller@payment');
Route::post('/order-place','Payment_Controller@order_place');
Route::get('/success','Payment_Controller@success');

Route::get('/manage-order','Manager_Controller@manage_order');
Route::get('/delete-order/{order_id}','Manager_Controller@delete_order');
Route::get('/view-order','Manager_Controller@view_order');

//send-mail
Route::get('/send-mail','Home_Controller@send_mail');
//Login facebook
Route::get('/login-facebook','Admin_Controller@login_facebook');
Route::get('/admin/callback','Admin_Controller@callback_facebook');
//Login  google
Route::get('/login-google','Admin_Controller@login_google');
Route::get('/google/callback','Admin_Controller@callback_google');
//delivery
//delivery-ajax
Route::get('/add-delivery','Delivery_Controller@add_delivery');
Route::post('/select-delivery','Delivery_Controller@select_delivery');
Route::post('/insert-delivery','Delivery_Controller@insert_delivery');
Route::post('/load-delivery','Delivery_Controller@load_delivery');
Route::post('/update-delivery-ajax','Delivery_Controller@update_delivery_ajax');
//normal-delivery
Route::post('/insert-delivery','Delivery_Controller@insert_delivery');
Route::get('/delivery-list','Delivery_Controller@show_delivery');
Route::get('/edit-delivery/{delivery_id}','Delivery_Controller@edit_delivery');
Route::post('/update-delivery/{delivery_Id}','Delivery_Controller@update_delivery');
Route::get('/delete-delivery/{delivery_id}','Delivery_Controller@delete_delivery');

//order
Route::get('/print-order/{checkout_code}','Order_Controller@print_order');
Route::get('/manage-order','Order_Controller@manage_order');
Route::get('/view-order/{order_code}','Order_Controller@view_order');
Route::post('/update-order-quantity','Order_Controller@update_order_quantity');
Route::post('/update-quantity-order','Order_Controller@update_quantity_order');
//Banner
Route::get('/manage-slider','Banner_Controller@manage_slider');
Route::get('/add-slider','Banner_Controller@add_slider');
Route::post('/save-slider','Banner_Controller@save_slider');
Route::get('/non-active-slider/{slider_id}','Banner_Controller@non_active_slider');
Route::get('/active-slider/{slider_id}','Banner_Controller@active_slider');
Route::get('/delete-slider/{slider_id}','Banner_Controller@delete_slider');
