<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

//installation route
Route::get('/', [
  'uses' => 'Admin\InstallationController@installationCheck',
  'as'   => 'root'
]);

Route::get('/installation', [
  'uses' => 'Auth\RegisterController@redirectToInstallationProcess',
  'as'   => 'installation-process'
]);

Route::post('/installation', [
  'uses' => 'Auth\RegisterController@installationDataSave',
  'as'   => 'admin-data-save'
]);

//admin login route
Route::get( '/admin/login', [
  'uses' => 'Auth\LoginController@goToAdminLoginPage',
  'as'   => 'admin.login'
]);

Route::post( '/admin/login' , [
  'uses' => 'Auth\LoginController@postAdminLogin',
  'as'   => 'admin.post_login'
]);

//admin logout route
Route::post( '/admin/logout', [
  'uses' => 'Auth\LoginController@logoutFromLogin',
  'as'   => 'admin.logout'
]);

//admin forgot password route 
Route::get( '/admin/forgot-password', [
  'uses' => 'Auth\ForgotPasswordController@redirectForgotPassword',
  'as' => 'forgotPassword'
]);

Route::post( '/admin/forgot-password', [
  'uses' => 'Auth\ForgotPasswordController@postForgotPassword',
  'as' => 'forgotPasswordUpdate'
]);

//frontend user login route
Route::get( '/user/login', [
  'uses' => 'Auth\LoginController@goToFrontendLoginPage',
  'as'   => 'user-login-page'
]);

Route::post( '/user/login', [
  'uses' => 'Auth\LoginController@postFrontendLogin',
  'as'   => 'user-login-post'
]);
  
//frontend user registration route
Route::get( '/user/registration', [
  'uses' => 'Auth\RegisterController@redirectToUserRegistrationProcess',
  'as'   => 'user-registration-page'
]);

Route::post( '/user/registration', [
  'uses' => 'Auth\RegisterController@userRegistration',
  'as'   => 'user-registration-post'
]);

//frontend forgot password route
Route::get( '/user/forgot-password', [
  'uses' => 'Auth\ForgotPasswordController@redirectForgotPassword',
  'as'   => 'user-forgot-password-page' 
]);

Route::post( '/user/forgot-password', [
  'uses' => 'Auth\ForgotPasswordController@manageFrontendUserForgotPassword',
  'as'   => 'user-forgot-password-post'
]);



//admin menu route
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
  
  //cache clear route 
  Route::get('/clear-cache', [
    'uses' => 'AdminDashboardController@clearDesignCache',
    'as'   => 'admin.clearCache'
  ]);
  
  
  //admin user menu
  Route::get('users/roles/list', [
    'uses' => 'AdminDashboardController@redirectToAdminDashboard',
    'as'   => 'admin.users_roles_list'
  ]);
  
  Route::get('users/roles/add', [
    'uses' => 'AdminDashboardController@redirectToAdminDashboard',
    'as'   => 'admin.add_roles'
  ]);
   
  Route::get('users/roles/update/{roles_id}', [
    'uses' => 'AdminDashboardController@redirectToAdminDashboard',
    'as'   => 'admin.update_roles'
  ]);
  
  Route::get('users/list', [
    'uses' => 'AdminDashboardController@redirectToAdminDashboard',
    'as'   => 'admin.users_list'
  ]);
  
  Route::get('user/add', [
    'uses' => 'AdminDashboardController@redirectToAdminDashboard',
    'as'   => 'admin.add_new_user'
  ]);
  
  Route::get('user/update/{user_id}', [
    'uses' => 'AdminDashboardController@redirectToAdminDashboard',
    'as'   => 'admin.update_new_user'
  ]);
  
  Route::get('user/profile', [
    'uses' => 'AdminDashboardController@redirectToAdminDashboard',
    'as'   => 'admin.user_profile'
  ]);
  
 
  //admin blog menu
  Route::get('pages/list', [
    'uses' => 'AdminDashboardController@redirectToAdminDashboard',
    'as'   => 'admin.all_pages'
  ]);
  
  Route::get('page/add', [
    'uses' => 'AdminDashboardController@redirectToAdminDashboard',
    'as'   => 'admin.add_page'
  ]);
  
  Route::get('page/update/{page_slug}', [
    'uses' => 'AdminDashboardController@redirectToAdminDashboard',
    'as'   => 'admin.update_page'
  ]);
  
  Route::get('blog/list', [
    'uses' => 'AdminDashboardController@redirectToAdminDashboard',
    'as'   => 'admin.all_blogs'
  ]);
  
  Route::get('blog/add', [
    'uses' => 'AdminDashboardController@redirectToAdminDashboard',
    'as'   => 'admin.add_blog'
  ]);
  
  Route::get('blog/categories/list', [
    'uses' => 'AdminDashboardController@redirectToAdminDashboard',
    'as'   => 'admin.blog_categories_list'
  ]);
  
  Route::get('blog/comments-list', [
    'uses' => 'AdminDashboardController@redirectToAdminDashboard',
    'as'   => 'admin.all_blog_comments'
  ]);
  
  Route::get('blog/update/{blog_slug}', [
    'uses' => 'AdminDashboardController@redirectToAdminDashboard',
    'as'   => 'admin.update_blog'
  ]);
  
  
  //admin dashboard menu
  Route::get('dashboard', [
    'uses' => 'AdminDashboardController@redirectToAdminDashboard',
    'as'   => 'admin.dashboard'
  ]);

  Route::post('dashboard', [
    'uses' => 'AdminDashboardController@sendQuickMail',
    'as'   => 'admin.quick_mail_dashboard'
  ]);
  
  
  //admin products menu
  Route::get('product/list', [
    'uses' => 'AdminDashboardController@redirectToAdminDashboard',
    'as'   => 'admin.product_list'
  ]);
  
  Route::get('product/add', [
    'uses' => 'AdminDashboardController@redirectToAdminDashboard',
    'as'   => 'admin.add_product'
  ]);
  
  Route::get('product/tags/list', [
    'uses' => 'AdminDashboardController@redirectToAdminDashboard',
    'as'   => 'admin.product_tags_list'
  ]);
  
  Route::get('product/categories/list', [
    'uses' => 'AdminDashboardController@redirectToAdminDashboard',
    'as'   => 'admin.product_categories_list'
  ]);
  
  Route::get('product/attributes/list', [
    'uses' => 'AdminDashboardController@redirectToAdminDashboard',
    'as'   => 'admin.product_attributes_list'
  ]);
  
  Route::get('product/colors/list', [
    'uses' => 'AdminDashboardController@redirectToAdminDashboard',
    'as'   => 'admin.product_colors_list'
  ]);
  
  Route::get('product/sizes/list', [
    'uses' => 'AdminDashboardController@redirectToAdminDashboard',
    'as'   => 'admin.product_sizes_list'
  ]);
  
  Route::get('product/comments-list', [
    'uses' => 'AdminDashboardController@redirectToAdminDashboard',
    'as'   => 'admin.all_products_comments'
  ]);
  
  Route::get('product/update/{slug}', [
    'uses' => 'AdminDashboardController@redirectToAdminDashboard',
    'as'   => 'admin.update_product_content'
  ]);
  
  
  //admin shipping menu
  Route::get('shipping-method/options', [
    'uses' => 'AdminDashboardController@redirectToAdminDashboard',
    'as'   => 'admin.shipping_method_options_content'
  ]);
  
  Route::get('shipping-method/flat-rate', [
    'uses' => 'AdminDashboardController@redirectToAdminDashboard',
    'as'   => 'admin.shipping_method_flat_rate_content'
  ]);
  
  Route::get('shipping-method/free-shipping', [
    'uses' => 'AdminDashboardController@redirectToAdminDashboard',
    'as'   => 'admin.shipping_method_free_shipping_content'
  ]);
  
  Route::get('shipping-method/local-delivery', [
    'uses' => 'AdminDashboardController@redirectToAdminDashboard',
    'as'   => 'admin.shipping_method_local_delivery_content'
  ]);
  
  
  //admin payment menu
  Route::get('payment-method/options', [
    'uses' => 'AdminDashboardController@redirectToAdminDashboard',
    'as'   => 'admin.payment_method_options_content'
  ]);
  
  Route::get('payment-method/direct-bank', [
    'uses' => 'AdminDashboardController@redirectToAdminDashboard',
    'as'   => 'admin.payment_method_direct_bank_content'
  ]);
  
  Route::get('payment-method/cash-on-delivery', [
    'uses' => 'AdminDashboardController@redirectToAdminDashboard',
    'as'   => 'admin.payment_method_cash_on_delivery_content'
  ]);
  
  Route::get('payment-method/paypal', [
    'uses' => 'AdminDashboardController@redirectToAdminDashboard',
    'as'   => 'admin.payment_method_paypal_content'
  ]);
  
  Route::get('payment-method/stripe', [
    'uses' => 'AdminDashboardController@redirectToAdminDashboard',
    'as'   => 'admin.payment_method_stripe_content'
  ]);
  
 
  //admin manufacturer menu
  Route::get('manufacturers/list', [
    'uses' => 'AdminDashboardController@redirectToAdminDashboard',
    'as'   => 'admin.manufacturers_list_content'
  ]);
  
  Route::get('manufacturers/add', [
    'uses' => 'AdminDashboardController@redirectToAdminDashboard',
    'as'   => 'admin.add_manufacturers_content'
  ]);
  
  Route::get('manufacturers/update/{manufacturers_id}', [
    'uses' => 'AdminDashboardController@redirectToAdminDashboard',
    'as'   => 'admin.update_manufacturers_content'
  ]);
  
  
  //Extra features
	Route::get('extra-features/product-compare-fields', [
    'uses' => 'AdminDashboardController@redirectToAdminDashboard',
    'as'   => 'admin.extra_features_compare_products_content'
  ]);
		
	Route::get('extra-features/color-filter', [
    'uses' => 'AdminDashboardController@redirectToAdminDashboard',
    'as'   => 'admin.extra_features_color_filter_content'
  ]);
  	
	
	Route::post('extra-features/color-filter', [
    'uses' => 'AdminDashboardController@saveProductFilterColorData',
    'as'   => 'admin.save_extra_features_color_filter_content'
  ]);
		
  
  //admin settings menu
  Route::get('settings/general', [
    'uses' => 'AdminDashboardController@redirectToAdminDashboard',
    'as'   => 'admin.general_settings_content'
  ]);
  
  Route::get('settings/languages', [
    'uses' => 'AdminDashboardController@redirectToAdminDashboard',
    'as'   => 'admin.languages_settings_content'
  ]);
  
  Route::get('settings/languages/update/{update_id}', [
    'uses' => 'AdminDashboardController@redirectToAdminDashboard',
    'as'   => 'admin.update_languages_settings_content'
  ]);
  
  Route::get('settings/appearance', [
    'uses' => 'AdminDashboardController@redirectToAdminDashboard',
    'as'   => 'admin.frontend_layout_settings_content'
  ]);
  
  
  //admin custom designer clipart menu
  Route::get('designer/clipart/categories/list', [
    'uses' => 'AdminDashboardController@redirectToAdminDashboard',
    'as'   => 'admin.art_categories_list_content'
  ]);
  
  Route::get('designer/clipart/list', [
    'uses' => 'AdminDashboardController@redirectToAdminDashboard',
    'as'   => 'admin.clipart_list_content'
  ]);
  
  Route::get('designer/clipart/category/add', [
    'uses' => 'AdminDashboardController@redirectToAdminDashboard',
    'as'   => 'admin.art_new_category_content'
  ]);
  
  Route::get('designer/clipart/add', [
    'uses' => 'AdminDashboardController@redirectToAdminDashboard',
    'as'   => 'admin.add_new_art_content'
  ]);
  
  Route::get('designer/settings', [
    'uses' => 'AdminDashboardController@redirectToAdminDashboard',
    'as'   => 'admin.designer_settings_content'
  ]);
  
  
  //admin manage orders menu  
  Route::get('orders', [
    'uses' => 'AdminDashboardController@redirectToAdminDashboard',
    'as'   => 'admin.shop_orders_list'
  ]);
  
  Route::get('orders/current-date', [
    'uses' => 'AdminDashboardController@redirectToAdminDashboard',
    'as'   => 'admin.shop_current_date_orders_list'
  ]);
  
  Route::get('orders/details/{order_id}', [
    'uses' => 'AdminDashboardController@redirectToAdminDashboard',
    'as'   => 'admin.view_order_details'
  ]);
  
  Route::post('orders/details/{order_id}', [
    'uses' => 'AdminDashboardController@updateOrderStatus',
    'as'   => 'admin.uppdate_order_status'
  ]);
  
  Route::get('reports', [
    'uses' => 'AdminDashboardController@redirectToAdminDashboard',
    'as'   => 'admin.reports_list'
  ]);
  
  Route::get('reports/sales-by-product-title', [
    'uses' => 'AdminDashboardController@redirectToAdminDashboard',
    'as'   => 'admin.reports_sales_by_product_title'
  ]);
  
  Route::get('reports/sales-by-month', [
    'uses' => 'AdminDashboardController@redirectToAdminDashboard',
    'as'   => 'admin.reports_sales_by_month'
  ]);
  
  Route::get('reports/sales-by-last-7-days', [
    'uses' => 'AdminDashboardController@redirectToAdminDashboard',
    'as'   => 'admin.reports_sales_by_last_7_days'
  ]);
  
  Route::get('reports/sales-by-custom-days', [
    'uses' => 'AdminDashboardController@redirectToAdminDashboard',
    'as'   => 'admin.reports_sales_by_custom_days'
  ]);
  
  Route::get('reports/sales-by-payment-method', [
    'uses' => 'AdminDashboardController@redirectToAdminDashboard',
    'as'   => 'admin.reports_sales_by_payment_method'
  ]);
  
  Route::get('product/attribute/update/{attr_id}', [
    'uses' => 'AdminDashboardController@redirectToAdminDashboard',
    'as'   => 'admin.update_attr_content'
  ]);
  
  Route::post('product/attribute/update/{attr_id}', [
    'uses' => 'AdminDashboardController@updateAttrDetails',
    'as'   => 'admin.update_post_attr_content'
  ]);
  
  Route::get('designer/clipart/category/update/{art_cat_id}', [
    'uses' => 'AdminDashboardController@redirectToAdminDashboard',
    'as'   => 'admin.update_art_category_content'
  ]);
  
  Route::get('designer/clipart/update/{clipart_slug}', [
    'uses' => 'AdminDashboardController@redirectToAdminDashboard',
    'as'   => 'admin.update_clipart_content'
  ]);
  
  
  //admin coupon menu 
  Route::get('coupon-manager/coupon/list', [
    'uses' => 'AdminDashboardController@redirectToAdminDashboard',
    'as'   => 'admin.coupon_manager_list'
  ]);
  
  Route::get('coupon-manager/coupon/add', [
    'uses' => 'AdminDashboardController@redirectToAdminDashboard',
    'as'   => 'admin.coupon_manager_content'
  ]);
  
  Route::get('coupon-manager/coupon/update/{coupon_id}', [
    'uses' => 'AdminDashboardController@redirectToAdminDashboard',
    'as'   => 'admin.update_coupon_manager_content'
  ]);
  
 
  //admin seo settings menu
  Route::get('manage/seo', [
    'uses' => 'AdminDashboardController@redirectToAdminDashboard',
    'as'   => 'admin.manage_seo_content'
  ]);
  
  //admin request product menu
  Route::get('customer/request-product', [
    'uses' => 'AdminDashboardController@redirectToAdminDashboard',
    'as'   => 'admin.request_product_content'
  ]);
  
  //admin subscription manager menu
  Route::get('subscription/custom', [
    'uses' => 'AdminDashboardController@redirectToAdminDashboard',
    'as'   => 'admin.custom_subscription_content'
  ]);
  
  Route::get('subscription/mailchimp', [
    'uses' => 'AdminDashboardController@redirectToAdminDashboard',
    'as'   => 'admin.mailchimp_subscription_content'
  ]);
  
  Route::get('subscription/settings', [
    'uses' => 'AdminDashboardController@redirectToAdminDashboard',
    'as'   => 'admin.settings_subscription_content'
  ]);
  
  Route::post('subscription/mailchimp', [
    'uses' => 'AdminDashboardController@updateSubscriptionData',
    'as'   => 'admin.update_mailchimp_subscription_content'
  ]);
  
  Route::post('subscription/settings', [
    'uses' => 'AdminDashboardController@updateSubscriptionSettings',
    'as'   => 'admin.update_subscription_settings_content'
  ]);
  
  
  //admin testimonial menu
  Route::get('testimonial/list', [
    'uses' => 'AdminDashboardController@redirectToAdminDashboard',
    'as'   => 'admin.testimonial_post_list_content'
  ]);
  
  Route::get('testimonial/add', [
    'uses' => 'AdminDashboardController@redirectToAdminDashboard',
    'as'   => 'admin.testimonial_post_content'
  ]);
  
  Route::get('testimonial/update/{testimonial_slug}', [
    'uses' => 'AdminDashboardController@redirectToAdminDashboard',
    'as'   => 'admin.update_testimonial_post_content'
  ]);
});


// menu post
Route::group(['prefix' => 'admin'], function () {
  Route::post('manufacturers/add', [
    'uses' => 'ProductsController@saveManufacturersData',
    'as'   => 'admin.save_manufacturers_content'
  ]);
  
  Route::post('manufacturers/update/{manufacturers_id}', [
    'uses' => 'ProductsController@saveManufacturersData',
    'as'   => 'admin.update_post_manufacturers_content'
  ]);
  
  Route::post('product/add', [
    'uses' => 'ProductsController@saveProduct',
    'as'   => 'admin.save_product'
  ]);
  
  Route::post('product/update/{slug}', [
    'uses' => 'ProductsController@saveProduct',
    'as'   => 'admin.update_product'
  ]);
  
  Route::post('page/add', [
    'uses' => 'CMSController@savePagesData',
    'as'   => 'admin.save_page_data'
  ]);
  
  Route::post('page/update/{page_slug}', [
    'uses' => 'CMSController@savePagesData',
    'as'   => 'admin.update_page_content'
  ]);
  
  Route::post('blog/add', [
    'uses' => 'CMSController@blogPostSave',
    'as'   => 'admin.add_blog_post'
  ]);
  
  Route::post('blog/update/{blog_slug}', [
    'uses' => 'CMSController@blogPostSave',
    'as'   => 'admin.update_blog_post'
  ]);
  
  Route::post('testimonial/add', [
    'uses' => 'CMSController@saveTestimonialPost',
    'as'   => 'admin.save_testimonial_post_content'
  ]);
  
  Route::post('testimonial/update/{testimonial_slug}', [
    'uses' => 'CMSController@saveTestimonialPost',
    'as'   => 'admin.save_update_testimonial_post_content'
  ]);
  
  Route::post('shipping-method/options', [
    'uses' => 'ShippingMethodController@saveShippingMethod',
    'as'   => 'admin.save_shipping_method_option'
  ]);
  
  Route::post('shipping-method/flat-rate', [
    'uses' => 'ShippingMethodController@saveShippingMethod',
    'as'   => 'admin.save_shipping_method_flat_rate'
  ]);
  
  Route::post('shipping-method/free-shipping', [
    'uses' => 'ShippingMethodController@saveShippingMethod',
    'as'   => 'admin.save_shipping_method_free_shipping'
  ]);
  
  Route::post('shipping-method/local-delivery', [
    'uses' => 'ShippingMethodController@saveShippingMethod',
    'as'   => 'admin.save_shipping_method_local_delivery'
  ]);
  
  Route::post('payment-method/options', [
    'uses' => 'PaymentMethodController@savePaymentData',
    'as'   => 'admin.save_payment_method_options'
  ]);
  
  Route::post('payment-method/direct-bank', [
    'uses' => 'PaymentMethodController@savePaymentData',
    'as'   => 'admin.save_direct_bank_content'
  ]);
  
  Route::post('payment-method/cash-on-delivery', [
    'uses' => 'PaymentMethodController@savePaymentData',
    'as'   => 'admin.save_cash_on_delivery_content'
  ]);
  
  Route::post('payment-method/paypal', [
    'uses' => 'PaymentMethodController@savePaymentData',
    'as'   => 'admin.save_paypal_content'
  ]);
  
  Route::post('payment-method/stripe', [
    'uses' => 'PaymentMethodController@savePaymentData',
    'as'   => 'admin.save_stripe_content'
  ]);
  
  Route::post('designer/clipart/category/add', [
    'uses' => 'DesignerElementsController@saveArtCategoryData',
    'as'   => 'admin.save_art_category_content'
  ]);
  
  Route::post('designer/clipart/category/update/{art_cat_slug}', [
    'uses' => 'DesignerElementsController@updateArtCatDetails',
    'as'   => 'admin.update_post_art_category_content'
  ]);
  
  Route::post('designer/clipart/add', [
    'uses' => 'DesignerElementsController@saveArtData',
    'as'   => 'admin.save_art_content'
  ]);
  
  Route::post('designer/clipart/update/{clipart_slug}', [
    'uses' => 'DesignerElementsController@updateArtData',
    'as'   => 'admin.update_post_clipart_content'
  ]);
  
  Route::post('designer/settings', [
    'uses' => 'DesignerElementsController@updateDesignerSettings',
    'as'   => 'admin.update_designer_settings_content'
  ]);
		
	Route::post('coupon-manager/coupon/add', [
    'uses' => 'FeaturesController@saveCoupon',
    'as'   => 'admin.save_coupon_manager_content'
  ]);
		
	Route::post('coupon-manager/coupon/update/{coupon_slug}', [
    'uses' => 'FeaturesController@saveCoupon',
    'as'   => 'admin.update_post_coupon_manager_content'
  ]);
		
	Route::post('manage/seo', [
    'uses' => 'FeaturesController@updateSeoData',
    'as'   => 'admin.update_manage_seo_content'
  ]);
  
  Route::post('extra-features/product-compare-fields', [
    'uses' => 'FeaturesController@saveProductCompareMoreFields',
    'as'   => 'admin.save_product_compare_more_fields'
  ]);
  
  Route::post('user/add', [
    'uses' => 'Admin\UserController@postUserCreate',
    'as'   => 'admin.create_new_user'
  ]);
  
  Route::post('user/update/{user_id}', [
    'uses' => 'Admin\UserController@postUserCreate',
    'as'   => 'admin.update_post_new_user'
  ]);
  
  Route::post('users/roles/add', [
    'uses' => 'Admin\UserController@postUserRole',
    'as'   => 'admin.save_roles'
  ]);
  
  Route::post('users/roles/update/{roles_id}', [
    'uses' => 'Admin\UserController@postUserRole',
    'as'   => 'admin.update_roles'
  ]);
	
  Route::post('user/profile', [
    'uses' => 'Admin\UserController@updateUserProfile',
    'as'   => 'admin.update_user_profile'
  ]);
  
  Route::post('settings/general', [
    'uses' => 'SettingsController@updateSettingsData',
    'as'   => 'admin.update_general_settings_content'
  ]);
  
  Route::post('settings/languages', [
    'uses' => 'SettingsController@manageLangFile',
    'as'   => 'admin.manage_languages_file'
  ]);
  
  Route::post('settings/languages/update/{update_id}', [
    'uses' => 'SettingsController@manageLangFile',
    'as'   => 'admin.update_post_languages_settings_content'
  ]);
  
  Route::post('settings/appearance', [
    'uses' => 'SettingsController@saveAppearanceSettingsData',
    'as'   => 'admin.update_frontend_settings_data'
  ]);
});



//admin upload product related image route
Route::post('/upload/product-related-image', [
  'uses' => 'Admin\AdminAjaxController@saveRelatedImage',
  'as'   => 'save-product-image'
]);

Route::post('/upload/product-gallery-images', [
  'uses' => 'Admin\AdminAjaxController@saveProductGalleryImages',
  'as'   => 'save-product-gallery-images'
]);

Route::post('/upload/art-all-images', [
  'uses' => 'Admin\AdminAjaxController@saveArtAllImages',
  'as'   => 'save-art-images'
]);

Route::post('/upload/product-video-file', [
  'uses' => 'Admin\AdminAjaxController@saveProductVideo',
  'as'   => 'save-product-video'
]);

Route::post('/upload/designer-images', [
  'uses' => 'Common\CommonAjaxController@uploadDesignerImage',
  'as'   => 'upload-designer-images'
]);

Route::post('/upload/upload-downloadable-file', [
  'uses' => 'Admin\AdminAjaxController@uploadDownloadableFiles',
  'as'   => 'upload-downloadable-files'
]);

Route::post('/upload/upload-variable-product-downloadable-file', [
  'uses' => 'Admin\AdminAjaxController@uploadVariableProductDownloadableFiles',
  'as'   => 'upload-variable-products-downloadable-files'
]);


//admin ajax post route
Route::post('/ajax/add-cat', [
  'uses' => 'Admin\AdminAjaxController@saveCategoriesDetails',
  'as'   => 'save-categories-details'
]);

Route::post('/ajax/add-tag', [
  'uses' => 'Admin\AdminAjaxController@saveTagsDetails',
  'as'   => 'save-tags-details'
]);

Route::post('/ajax/add-attribute', [
  'uses' => 'Admin\AdminAjaxController@saveAttributesDetails',
  'as'   => 'save-attr-details'
]);

Route::post('/ajax/add-color', [
  'uses' => 'Admin\AdminAjaxController@saveColorDetails',
  'as'   => 'save-color-details'
]);

Route::post('/ajax/add-size', [
  'uses' => 'Admin\AdminAjaxController@saveSizeDetails',
  'as'   => 'save-size-details'
]);

Route::post('/ajax/edit-data', [
  'uses' => 'Admin\AdminAjaxController@getSpecificDetailsById',
  'as'   => 'get-specific-details'
]);

Route::post('/ajax/delete-item', [
  'uses' => 'Admin\AdminAjaxController@selectedItemDeleteById',
  'as'   => 'selected-item-delete'
]);

Route::post('/ajax/comments-status-change', [
  'uses' => 'Admin\AdminAjaxController@selectedCommentsStatusChange',
  'as'   => 'selected-comments-status-change'
]);

Route::post('/ajax/add-variation', [
  'uses' => 'Admin\AdminAjaxController@saveProductsVariations',
  'as'   => 'save-products-variations'
]);

Route::post('/ajax/get-variation-view-data', [
  'uses' => 'Admin\AdminAjaxController@getProductsVariationsDataById',
  'as'   => 'get-products-variations-data'
]);

Route::post('/ajax/add-attributes-by-product', [
  'uses' => 'Admin\AdminAjaxController@addAttributeByProductId',
  'as'   => 'add-attribute'
]);

Route::post('/ajax/get-available-attributes-with-html', [
  'uses' => 'Admin\AdminAjaxController@getAvailableAttributesWithHtml',
  'as'   => 'get-available-attribute'
]);

Route::post('/ajax/get-clipart-categories-images-with-html', [
  'uses' => 'Common\CommonAjaxController@getAvailableClipartCategoriesImagesWithHtml',
  'as'   => 'get-available-cat-images'
]);

Route::post('/ajax/save_custom_data', [
  'uses' => 'Common\CommonAjaxController@saveCustomDesign',
  'as'   => 'save-custom-design'
]);

Route::post('/ajax/remove_custom_data', [
  'uses' => 'Common\CommonAjaxController@removeCustomDesign',
  'as'   => 'remove-custom-design'
]);

Route::post('/ajax/report_data_by_filter', [
  'uses' => 'Common\CommonAjaxController@getReportDataByFilter',
  'as'   => 'report-data-by-filter'
]);

Route::post('/ajax/appearance_data_manage', [
  'uses' => 'Admin\AdminAjaxController@appearanceDataSave',
  'as'   => 'appearance-data-save'
]);

Route::post('/upload/frontend-images', [
  'uses' => 'Admin\AdminAjaxController@uploadFrontendImages',
  'as'   => 'upload-frontend-images'
]);

Route::post('/ajax/import_product_file', [
  'uses' => 'Admin\AdminAjaxController@manageImportProductFile',
  'as'   => 'import-product-file'
]);

Route::get('/export_products', [
  'uses' => 'ProductsController@manageExportProducts',
  'as'   => 'export-products'
]);

Route::get('/ajax/get_products_for_linked_type', [
  'uses' => 'Admin\AdminAjaxController@getProductsForLinkedType',
  'as'   => 'linked-type-products'
]);


//frontend ajax route
Route::post('/ajax/filter_products', [
  'uses' => 'Frontend\FrontendAjaxController@getProductsByFilterWithName',
  'as'   => 'get-products-by-filter'
]);

Route::post('/ajax/add-to-cart', [
  'uses' => 'Frontend\FrontendAjaxController@productAddToCart',
  'as'   => 'product-add-to-cart'
]);

Route::post('/ajax/customize-product-add-to-cart', [
  'uses' => 'Frontend\FrontendAjaxController@customizeProductAddToCart',
  'as'   => 'customize-product-add-to-cart'
]);

Route::post('/ajax/cart-total-update-by-shipping-method', [
  'uses' => 'Frontend\FrontendAjaxController@cartTotalUpdateUsingShippingMethod',
  'as'   => 'cart-total-update-by-shipping'
]);

Route::post('/ajax/save_custom_design_img', [
  'uses' => 'Frontend\FrontendAjaxController@saveCustomDesignImage',
  'as'   => 'save-custom-design-image'
]);

Route::post('/ajax/requested_product_data', [
  'uses' => 'Frontend\FrontendAjaxController@storeRequestedProductData',
  'as'   => 'save-request-product-data'
]);

Route::post('/ajax/subscription_data', [
  'uses' => 'Frontend\FrontendAjaxController@storeSubscriptionData',
  'as'   => 'save-subscription-data'
]);

Route::post('/ajax/set_subscription_popup_cookie', [
  'uses' => 'Frontend\FrontendAjaxController@setCookieForSubscriptionPopup',
  'as'   => 'set-cookie-subscription'
]);

Route::post('/ajax/frontend-user-logout', [
  'uses' => 'Frontend\FrontendAjaxController@logoutFromFrontendUserLogin',
  'as'   => 'frontend-user-logout'
]);

Route::post('/ajax/user-wishlist-data-process', [
  'uses' => 'Frontend\FrontendAjaxController@userWishlistDataSaved',
  'as'   => 'wishlist-data-save'
]);

Route::post('/ajax/product-compare-data-process', [
  'uses' => 'Frontend\FrontendAjaxController@productCompareDataSaved',
  'as'   => 'product-compare-data-save'
]);

Route::post('/ajax/applyCoupon', [
  'uses' => 'Frontend\FrontendAjaxController@applyUserCoupon',
  'as'   => 'user-coupon-apply'
]);

Route::post('/ajax/removeCoupon', [
  'uses' => 'Frontend\FrontendAjaxController@removeUserCoupon',
  'as'   => 'user-coupon-remove'
]);

Route::post('/ajax/multi-lang-processing', [
  'uses' => 'Frontend\FrontendAjaxController@multiLangProcessing',
  'as'   => 'multi-lang-processing'
]);

Route::post('/ajax/multi-currency-processing', [
  'uses' => 'Frontend\FrontendAjaxController@multiCurrencyProcessing',
  'as'   => 'multi-currency-processing'
]);

Route::post('/ajax/get-quick-view-data-by-product-id', [
  'uses' => 'Frontend\FrontendAjaxController@getQuickViewProductData',
  'as'   => 'product-quick-view-data'
]);

Route::post('/ajax/delete-item-from-wishlist', [
  'uses' => 'Frontend\FrontendAjaxController@deleteItemFromWishlist',
  'as'   => 'wishlist-item-delete'
]);

Route::post('/ajax/get-mini-cart-data', [
  'uses' => 'Frontend\FrontendAjaxController@getMiniCartData',
  'as'   => 'mini-cart-data'
]);




//frontend route
Route::get( '/home', [
  'uses' => 'Frontend\FrontendManagerController@goToDifferentPages',
  'as'   => 'home-page'
]);

Route::get( '/shop', [
  'uses' => 'Frontend\FrontendManagerController@goToDifferentPages',
  'as'   => 'shop-page'
]);

Route::get( '/product/details/{details_slug}', [
  'uses' => 'Frontend\FrontendManagerController@goToDifferentPages',
  'as'   => 'details-page'
]);

Route::get( '/product/customize/{details_id}', [
  'uses' => 'Frontend\FrontendManagerController@goToDifferentPages',
  'as'   => 'customize-page'
]);

Route::get( '/product/categories/{cat_slug}', [
  'uses' => 'Frontend\FrontendManagerController@goToDifferentPages',
  'as'   => 'categories-page'
]);

Route::get('/cart', [
  'uses' => 'Frontend\FrontendManagerController@goToDifferentPages',
  'as'   => 'cart-page'
]);

Route::get('/checkout', [
  'uses' => 'Frontend\FrontendManagerController@goToDifferentPages',
  'as'   => 'checkout-page'
]);

Route::get( '/page/{page_slug}', [
  'uses' => 'Frontend\FrontendManagerController@goToDifferentPages',
  'as'   => 'custom-page-content'
]);

Route::post('/cart', [
              'uses' => 'Frontend\FrontendManagerController@doActionFromCartPage',
              'as'   => 'cart-page-post'
]);

$router->get('/remove_item/{cart_id}', ['uses' => 'Frontend\FrontendManagerController@doActionForRemoveItem', 'as' => 'removed-item-from-cart']);
$router->get('/remove_compare_product/{product_id}', ['uses' => 'Frontend\FrontendManagerController@doActionForRemoveCompareProduct', 'as' => 'remove-compare-product-from-list']);

Route::post('/checkout', [
  'uses' => 'CheckoutController@doCheckoutProcess',
  'as'   => 'checkout-process'
]);

$router->get( '/checkout/order-received/{order_id}/{order_key}', ['uses' => 'Frontend\FrontendManagerController@goToDifferentPages', 'as' => 'frontend-order-received'])->where('order_id', '[0-9]+');

// this is after make the payment, PayPal redirect back to your site
Route::get('/checkout/status', array(
  'as' => 'payment.status',
  'uses' => 'CheckoutController@getPaymentStatus',
));

Route::get( '/brand/{brands_name}', [
  'uses' => 'Frontend\FrontendManagerController@goToDifferentPages',
  'as'   => 'brands-single-page'
]);

Route::get( '/testimonial/{testimonial_slug}', [
  'uses' => 'Frontend\FrontendManagerController@goToDifferentPages',
  'as'   => 'testimonial-single-page'
]);

Route::get( '/blogs', [
  'uses' => 'Frontend\FrontendManagerController@goToDifferentPages',
  'as'   => 'blogs-page-content'
]);

Route::get( '/blog/{blog_slug}', [
  'uses' => 'Frontend\FrontendManagerController@goToDifferentPages',
  'as'   => 'blog-single-page'
]);

Route::get( '/categories/blog/{blog_cat_slug}', [
  'uses' => 'Frontend\FrontendManagerController@goToDifferentPages',
  'as'   => 'blog-cat-page'
]);

Route::get( '/product/tag/{tag_slug}', [
  'uses' => 'Frontend\FrontendManagerController@goToDifferentPages',
  'as'   => 'tag-single-page'
]);

Route::get( '/product/comparison', [
  'uses' => 'Frontend\FrontendManagerController@goToDifferentPages',
  'as'   => 'product-comparison-page'
]);

Route::post( '/product/details/{details_slug}', [
  'uses' => 'Frontend\UserCommentsController@saveUserComments',
  'as'   => 'save-user-comments'
]);

Route::post( '/blog/{blog_slug}', [
  'uses' => 'Frontend\UserCommentsController@saveUserComments',
  'as'   => 'save-user-blog-comments'
]);



// frontend user account route
Route::group(['prefix' => 'user', 'namespace' => 'Frontend'], function () {
  Route::get( 'account', [
    'uses' => 'UserAccountManageController@goToDifferentPages',
    'as'   => 'user-account-page'
  ]);
  
  Route::get( 'account/dashboard', [
    'uses' => 'UserAccountManageController@goToDifferentPages',
    'as'   => 'user-dashboard-page'
  ]);
  
  Route::get( 'account/my-address', [
    'uses' => 'UserAccountManageController@goToDifferentPages',
    'as'   => 'my-address-page'
  ]);
  
  Route::get( 'account/my-address/add', [
    'uses' => 'UserAccountManageController@goToDifferentPages',
    'as'   => 'my-address-add-page'
  ]);
  
  Route::get( 'account/my-address/edit', [
    'uses' => 'UserAccountManageController@goToDifferentPages',
    'as'   => 'my-address-edit-page'
  ]);
  
  Route::get( 'account/my-orders', [
    'uses' => 'UserAccountManageController@goToDifferentPages',
    'as'   => 'my-orders-page'
  ]);
  
  Route::get( 'account/view-orders-details/{user_order_id}', [
    'uses' => 'UserAccountManageController@goToDifferentPages',
    'as'   => 'user-order-details-page'
  ]);
  
  Route::get( 'account/my-saved-items', [
    'uses' => 'UserAccountManageController@goToDifferentPages',
    'as'   => 'my-saved-items-page'
  ]);
  
  Route::get( 'account/my-coupons', [
    'uses' => 'UserAccountManageController@goToDifferentPages',
    'as'   => 'my-coupons-page'
  ]);
  
  Route::get( 'account/download', [
    'uses' => 'UserAccountManageController@goToDifferentPages',
    'as'   => 'download-page'
  ]);
  
  Route::get( 'account/my-profile', [
    'uses' => 'UserAccountManageController@goToDifferentPages',
    'as'   => 'my-profile-page'
  ]);
  
  Route::get( 'account/order-details/{order_id}/{order_process_id}', [
    'uses' => 'UserAccountManageController@goToDifferentPages',
    'as'   => 'account-order-details-page'
  ]);
  
  Route::post( 'account/my-address/add', [
    'uses' => 'UserAccountManageController@saveUserAccountData',
    'as'   => 'my-address-add-post'
  ]);
  
  Route::post( 'account/my-address/edit', [
    'uses' => 'UserAccountManageController@saveUserAccountData',
    'as'   => 'my-address-edit-post'
  ]);
  
  Route::post( 'account/my-profile', [
    'uses' => 'UserAccountManageController@updateFrontendUserProfile',
    'as'   => 'update-profile-post'
  ]);
  
  Route::post( 'account/logout', [
    'uses' => 'UserAccountManageController@userLogout',
    'as'   => 'user-logout'
  ]);
});

Route::get( '/download/file/{product_id}/{order_id}/{file_id}/{target}', [
  'uses' => 'Frontend\FrontendManagerController@forceDownload',
  'as'   => 'downloadable-product-download'
]);