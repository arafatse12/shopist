<?php $__env->startSection('content'); ?>

<?php if(Request::is('admin/dashboard')): ?>
  <?php echo $__env->make('pages.admin.dashboard-content', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php $__env->startSection('title', trans('admin.dashboard') .' < '. get_site_title()); ?>
  <?php echo $__env->yieldContent('dashboard-content'); ?>

<?php elseif(Request::is('admin/pages/list')): ?>
  <?php echo $__env->make('pages.admin.cms.pages-list-content', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php $__env->startSection('title', trans('admin.pages_list_title') .' < '. get_site_title()); ?>
  <?php echo $__env->yieldContent('page-list-content'); ?>
  
<?php elseif(Request::is('admin/page/add')): ?>
  <?php echo $__env->make('pages.admin.cms.add-page-content', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php $__env->startSection('title', trans('admin.add_page_title') .' < '. get_site_title()); ?>
  <?php echo $__env->yieldContent('add-page-content'); ?>  
  
<?php elseif(Request::is('admin/page/update/*')): ?>
  <?php echo $__env->make('pages.admin.cms.update-page-content', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php $__env->startSection('title', trans('admin.update_page_title') .' < '. get_site_title()); ?>
  <?php echo $__env->yieldContent('update-page-content'); ?>    
  
<?php elseif(Request::is('admin/blog/add')): ?>
  <?php echo $__env->make('pages.admin.cms.add-blog-content', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php $__env->startSection('title', trans('admin.add_post_page_title') .' < '. get_site_title()); ?>
  <?php echo $__env->yieldContent('add-blog-post-content'); ?>
  
<?php elseif(Request::is('admin/blog/update/*')): ?>
  <?php echo $__env->make('pages.admin.cms.update-blog-content', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php $__env->startSection('title', trans('admin.update_post_page_title') .' < '. get_site_title()); ?>
  <?php echo $__env->yieldContent('update-blog-post-content'); ?>  
  
<?php elseif(Request::is('admin/blog/list')): ?>
  <?php echo $__env->make('pages.admin.cms.blogs-list-content', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php $__env->startSection('title', trans('admin.posts_list') .' < '. get_site_title()); ?>
  <?php echo $__env->yieldContent('blogs-post-list-content'); ?>

<?php elseif(Request::is('admin/blog/comments-list')): ?>
  <?php echo $__env->make('pages.admin.cms.blog-comments-list', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php $__env->startSection('title', trans('admin.comments_list') .' < '. get_site_title()); ?>
  <?php echo $__env->yieldContent('blogs-post-comments-list-content'); ?>  
  
<?php elseif(Request::is('admin/testimonial/add')): ?>
  <?php echo $__env->make('pages.admin.cms.add-testimonial-content', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php $__env->startSection('title', trans('admin.add_post_page_title') .' < '. get_site_title()); ?>
  <?php echo $__env->yieldContent('add-testimonial-post-content'); ?>
  
<?php elseif(Request::is('admin/testimonial/update/*')): ?>
  <?php echo $__env->make('pages.admin.cms.update-testimonial-content', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php $__env->startSection('title', trans('admin.update_post_page_title') .' < '. get_site_title()); ?>
  <?php echo $__env->yieldContent('update-testimonial-post-content'); ?>
  
<?php elseif(Request::is('admin/testimonial/list')): ?>
  <?php echo $__env->make('pages.admin.cms.testimonial-list-content', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php $__env->startSection('title', trans('admin.posts_list') .' < '. get_site_title()); ?>
  <?php echo $__env->yieldContent('testimonial-post-list-content'); ?>  
  
<?php elseif(Request::is('admin/user/profile')): ?>
  <?php echo $__env->make('pages.admin.users.user-profile', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php $__env->startSection('title', trans('admin.user_profile') .' < '. get_site_title()); ?>
  <?php echo $__env->yieldContent('user-profile-content'); ?>
  
<?php elseif(Request::is('admin/product/add')): ?>
  <?php echo $__env->make('pages.admin.product.add-product-content', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php $__env->startSection('title', trans('admin.add_product') .' < '. get_site_title()); ?>
  <?php echo $__env->yieldContent('add-new-product-content'); ?>
  
<?php elseif(Request::is('admin/product/categories/list') || Request::is('admin/blog/categories/list')): ?>
  <?php echo $__env->make('pages.admin.categories-list', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php if(Request::is('admin/product/categories/list')): ?>
      <?php $__env->startSection('title', trans('admin.product_categories_list') .' < '. get_site_title()); ?>
    <?php elseif(Request::is('admin/blog/categories/list')): ?>
      <?php $__env->startSection('title', trans('admin.blog_categories_list') .' < '. get_site_title()); ?>
    <?php endif; ?>
  <?php echo $__env->yieldContent('categories-list-content'); ?>
  
<?php elseif(Request::is('admin/product/tags/list')): ?>
  <?php echo $__env->make('pages.admin.product.product-tags-list', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php $__env->startSection('title', trans('admin.product_tags_list') .' < '. get_site_title()); ?>
  <?php echo $__env->yieldContent('product-tags-list-content'); ?>
  
<?php elseif(Request::is('admin/product/attributes/list')): ?>
  <?php echo $__env->make('pages.admin.product.product-attribute-list', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php $__env->startSection('title', trans('admin.product_attributes_list') .' < '. get_site_title()); ?>
  <?php echo $__env->yieldContent('product-attributes-list-content'); ?>
  
<?php elseif(Request::is('admin/product/colors/list')): ?>
  <?php echo $__env->make('pages.admin.product.product-colors-list', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php $__env->startSection('title', trans('admin.product_color_list') .' < '. get_site_title()); ?>
  <?php echo $__env->yieldContent('product-colors-list-content'); ?>  
  
<?php elseif(Request::is('admin/product/sizes/list')): ?>
  <?php echo $__env->make('pages.admin.product.product-sizes-list', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php $__env->startSection('title', trans('admin.product_sizes_list') .' < '. get_site_title()); ?>
  <?php echo $__env->yieldContent('product-sizes-list-content'); ?>    
 
<?php elseif(Request::is('admin/shipping-method/options')): ?>
  <?php echo $__env->make('pages.admin.shipping.shipping-options', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php $__env->startSection('title', trans('admin.shipping_options') .' < '. get_site_title()); ?>
  <?php echo $__env->yieldContent('shipping-options-content'); ?>

<?php elseif(Request::is('admin/shipping-method/flat-rate')): ?>
  <?php echo $__env->make('pages.admin.shipping.shipping-method-flat-rate', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php $__env->startSection('title', trans('admin.update_flat_rate') .' < '. get_site_title()); ?>
  <?php echo $__env->yieldContent('shipping-method-flat-rate-content'); ?>

<?php elseif(Request::is('admin/shipping-method/free-shipping')): ?>
  <?php echo $__env->make('pages.admin.shipping.shipping-method-free-shipping', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php $__env->startSection('title', trans('admin.update_free_shipping') .' < '. get_site_title()); ?>
  <?php echo $__env->yieldContent('shipping-method-free-shipping-content'); ?>

<?php elseif(Request::is('admin/shipping-method/local-delivery')): ?>
  <?php echo $__env->make('pages.admin.shipping.shipping-method-local-delivery', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php $__env->startSection('title', trans('admin.update_local_delivery') .' < '. get_site_title()); ?>
  <?php echo $__env->yieldContent('shipping-method-local-delivery-content'); ?>

<?php elseif(Request::is('admin/manufacturers/list')): ?>
  <?php echo $__env->make('pages.admin.product.manufacturers-list-content', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php $__env->startSection('title', trans('admin.manufacturers_list') .' < '. get_site_title()); ?>
  <?php echo $__env->yieldContent('manufacturers-list-content'); ?>

<?php elseif(Request::is('admin/manufacturers/add')): ?>
  <?php echo $__env->make('pages.admin.product.add-manufacturers-content', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php $__env->startSection('title', trans('admin.add_manufacturers') .' < '. get_site_title()); ?>
  <?php echo $__env->yieldContent('manufacturers-add-content'); ?>

<?php elseif(Request::is('admin/manufacturers/update/*')): ?>
  <?php echo $__env->make('pages.admin.product.update-manufacturers-content', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php $__env->startSection('title', trans('admin.update_manufacturers') .' < '. get_site_title()); ?>
  <?php echo $__env->yieldContent('manufacturers-update-content'); ?>

<?php elseif(Request::is('admin/settings/general')): ?>
  <?php echo $__env->make('pages.admin.settings.general-content', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php $__env->startSection('title', trans('admin.update_general_settings') .' < '. get_site_title()); ?>
  <?php echo $__env->yieldContent('settings-general-content'); ?>

<?php elseif(Request::is('admin/settings/languages') || Request::is('admin/settings/languages/update/*')): ?>
  <?php echo $__env->make('pages.admin.settings.languages-content', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php $__env->startSection('title', trans('admin.manage_languages') .' < '. get_site_title()); ?>
  <?php echo $__env->yieldContent('manage-languages-content'); ?>

<?php elseif(Request::is('admin/designer/clipart/categories/list')): ?>
  <?php echo $__env->make('pages.admin.custom-designer.art-categories-list', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php $__env->startSection('title', trans('admin.clipart_categories_list') .' < '. get_site_title()); ?>
  <?php echo $__env->yieldContent('art-categories-lists-content'); ?>

<?php elseif(Request::is('admin/designer/clipart/list')): ?>
  <?php echo $__env->make('pages.admin.custom-designer.clipart-list', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php $__env->startSection('title', trans('admin.clipart_list') .' < '. get_site_title()); ?>
  <?php echo $__env->yieldContent('clipart-lists-content'); ?>

<?php elseif(Request::is('admin/designer/clipart/category/add')): ?>
  <?php echo $__env->make('pages.admin.custom-designer.add-art-category-content', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php $__env->startSection('title', trans('admin.add_clipart_category') .' < '. get_site_title()); ?>
  <?php echo $__env->yieldContent('art-new-category-content'); ?>

<?php elseif(Request::is('admin/designer/clipart/category/update/*')): ?>
  <?php echo $__env->make('pages.admin.custom-designer.update-art-category-content', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php $__env->startSection('title', trans('admin.update_clipart_category') .' < '. get_site_title()); ?>
  <?php echo $__env->yieldContent('art-category-update-content'); ?>

<?php elseif(Request::is('admin/designer/clipart/add')): ?>
  <?php echo $__env->make('pages.admin.custom-designer.add-new-art-content', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php $__env->startSection('title', trans('admin.add_new_art') .' < '. get_site_title()); ?>
  <?php echo $__env->yieldContent('add-new-art-content'); ?>

<?php elseif(Request::is('admin/designer/clipart/update/*')): ?>
  <?php echo $__env->make('pages.admin.custom-designer.update-art-content', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php $__env->startSection('title', trans('admin.update_art') .' < '. get_site_title()); ?>
  <?php echo $__env->yieldContent('update-art-content'); ?>

<?php elseif(Request::is('admin/product/update/*')): ?>
  <?php echo $__env->make('pages.admin.product.update-product-content', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php $__env->startSection('title', trans('admin.update_product') .' < '. get_site_title()); ?>
  <?php echo $__env->yieldContent('update-product-content'); ?>

<?php elseif(Request::is('admin/product/list')): ?>
  <?php echo $__env->make('pages.admin.product.product-list', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php $__env->startSection('title', trans('admin.products_list') .' < '. get_site_title()); ?>
  <?php echo $__env->yieldContent('product-list-content'); ?>
  
<?php elseif(Request::is('admin/product/comments-list')): ?>
  <?php echo $__env->make('pages.admin.product.comments-list', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php $__env->startSection('title', trans('admin.comments_list') .' < '. get_site_title()); ?>
  <?php echo $__env->yieldContent('product-comments-list-content'); ?>  
  
<?php elseif(Request::is('admin/orders') || Request::is('admin/orders/current-date')): ?>
  <?php echo $__env->make('pages.admin.orders.order-list', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
  <?php $__env->startSection('title', trans('admin.orders_list') .' < '. get_site_title()); ?>
  <?php echo $__env->yieldContent('orders-list-content'); ?>
  
<?php elseif(Request::is('admin/orders/details/*')): ?>
  <?php echo $__env->make('pages.admin.orders.order-details', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>  
  <?php $__env->startSection('title', trans('admin.orders_details') .' < '. get_site_title()); ?>
  <?php echo $__env->yieldContent('orders-details-content'); ?>
  
<?php elseif(Request::is('admin/designer/settings')): ?>
  <?php echo $__env->make('pages.admin.custom-designer.settings', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
  <?php $__env->startSection('title', trans('admin.designer_settings') .' < '. get_site_title()); ?>
  <?php echo $__env->yieldContent('custom-designer-settings-content'); ?> 
  
<?php elseif(Request::is('admin/payment-method/options')): ?>
  <?php echo $__env->make('pages.admin.payment.payment-options', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
  <?php $__env->startSection('title', trans('admin.update_payment_options') .' < '. get_site_title()); ?>
  <?php echo $__env->yieldContent('payment-options-content'); ?>
  
<?php elseif(Request::is('admin/payment-method/direct-bank')): ?>
  <?php echo $__env->make('pages.admin.payment.payment-direct-bank', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
  <?php $__env->startSection('title', trans('admin.update_bacs_payment') .' < '. get_site_title()); ?>
  <?php echo $__env->yieldContent('payment-direct-bank-content'); ?>
  
<?php elseif(Request::is('admin/payment-method/cash-on-delivery')): ?>
  <?php echo $__env->make('pages.admin.payment.payment-cash-on-delivery', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>  
  <?php $__env->startSection('title', trans('admin.update_cod_payment') .' < '. get_site_title()); ?>
  <?php echo $__env->yieldContent('payment-cash-on-delivery-content'); ?> 
  
<?php elseif(Request::is('admin/payment-method/paypal')): ?>
  <?php echo $__env->make('pages.admin.payment.payment-paypal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
  <?php $__env->startSection('title', trans('admin.update_paypal_payment') .' < '. get_site_title()); ?>
  <?php echo $__env->yieldContent('payment-paypal-content'); ?>
  
<?php elseif(Request::is('admin/payment-method/stripe')): ?>
  <?php echo $__env->make('pages.admin.payment.payment-stripe', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
  <?php $__env->startSection('title', trans('admin.update_stripe_payment') .' < '. get_site_title()); ?>
  <?php echo $__env->yieldContent('payment-stripe-content'); ?>  
  
<?php elseif(Request::is('admin/reports')): ?>
  <?php echo $__env->make('pages.admin.reports.reports-main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php $__env->startSection('title', trans('admin.reports') .' < '. get_site_title()); ?>
  <?php echo $__env->yieldContent('reports-content'); ?> 
  
<?php elseif(Request::is('admin/users/roles/add')): ?>
  <?php echo $__env->make('pages.admin.users.add-users-roles', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php $__env->startSection('title', trans('admin.add_roles_page_title') .' < '. get_site_title()); ?>
  <?php echo $__env->yieldContent('user-roles-add-content'); ?>
  
<?php elseif(Request::is('admin/users/roles/update/*')): ?>
  <?php echo $__env->make('pages.admin.users.update-users-roles', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php $__env->startSection('title', trans('admin.update_roles_page_title') .' < '. get_site_title()); ?>
  <?php echo $__env->yieldContent('user-roles-update-content'); ?>  
  
<?php elseif(Request::is('admin/user/add')): ?>
  <?php echo $__env->make('pages.admin.users.add-users', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php $__env->startSection('title', trans('admin.add_user_page_title') .' < '. get_site_title()); ?>
  <?php echo $__env->yieldContent('user-add-content'); ?>  

<?php elseif(Request::is('admin/user/update/*')): ?>
  <?php echo $__env->make('pages.admin.users.update-users', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php $__env->startSection('title', trans('admin.update_user_page_title') .' < '. get_site_title()); ?>
  <?php echo $__env->yieldContent('user-update-content'); ?>
  
<?php elseif(Request::is('admin/users/list')): ?>
  <?php echo $__env->make('pages.admin.users.user-list', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php $__env->startSection('title', trans('admin.user_list_title') .' < '. get_site_title()); ?>
  <?php echo $__env->yieldContent('user-list-content'); ?>  
  
<?php elseif(Request::is('admin/users/roles/list')): ?>
  <?php echo $__env->make('pages.admin.users.user-role-list', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php $__env->startSection('title', trans('admin.user_role_list_title') .' < '. get_site_title()); ?>
  <?php echo $__env->yieldContent('user-role-list-content'); ?>    
  
<?php elseif(Request::is('admin/settings/appearance')): ?>
  <?php echo $__env->make('pages.admin.settings.appearance-content', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php $__env->startSection('title', trans('admin.appearance_page_title') .' < '. get_site_title()); ?>
  <?php echo $__env->yieldContent('appearance-content'); ?>
  
<?php elseif(Request::is('admin/reports/sales-by-product-title') || Request::is('admin/reports/sales-by-month') || Request::is('admin/reports/sales-by-last-7-days') || Request::is('admin/reports/sales-by-custom-days') || Request::is('admin/reports/sales-by-payment-method')): ?>
  <?php echo $__env->make('pages.admin.reports.reports-content', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php $__env->startSection('title', trans('admin.reports') .' < '. get_site_title()); ?> 
  <?php echo $__env->yieldContent('reports-details'); ?> 

<?php elseif(Request::is('admin/coupon-manager/coupon/list')): ?>
  <?php echo $__env->make('pages.admin.coupon.coupons-list', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php $__env->startSection('title', trans('admin.coupon_manager_list_page_title') .' < '. get_site_title()); ?>
  <?php echo $__env->yieldContent('coupon-manager-list-content'); ?>
  
<?php elseif(Request::is('admin/coupon-manager/coupon/add')): ?>
  <?php echo $__env->make('pages.admin.coupon.coupon-content', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php $__env->startSection('title', trans('admin.coupon_manager_page_title') .' < '. get_site_title()); ?>
  <?php echo $__env->yieldContent('coupon-manager-content'); ?>
  
<?php elseif(Request::is('admin/coupon-manager/coupon/update/*')): ?>
  <?php echo $__env->make('pages.admin.coupon.update-coupon-content', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php $__env->startSection('title', trans('admin.update_coupon_page_title') .' < '. get_site_title()); ?>
  <?php echo $__env->yieldContent('update-coupon-manager-content'); ?>
  
<?php elseif(Request::is('admin/manage/seo')): ?>
  <?php echo $__env->make('pages.admin.seo.seo-content', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php $__env->startSection('title', trans('admin.manage_seo_page_title') .' < '. get_site_title()); ?>
  <?php echo $__env->yieldContent('manage-seo-content'); ?>

<?php elseif(Request::is('admin/customer/request-product')): ?>
  <?php echo $__env->make('pages.admin.request-product.request-product-content', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php $__env->startSection('title', trans('admin.request_product_page_title') .' < '. get_site_title()); ?>
  <?php echo $__env->yieldContent('request-product-content'); ?>  
		
<?php elseif(Request::is('admin/extra-features/product-compare-fields')): ?>
  <?php echo $__env->make('pages.admin.extra-features.compare-products-content', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php $__env->startSection('title', trans('admin.compare_products_page_title') .' < '. get_site_title()); ?>
  <?php echo $__env->yieldContent('compare-products-content'); ?>
		
<?php elseif(Request::is('admin/extra-features/color-filter')): ?>
  <?php echo $__env->make('pages.admin.extra-features.color-filter-content', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php $__env->startSection('title', trans('admin.color_filter_page_title') .' < '. get_site_title()); ?>
  <?php echo $__env->yieldContent('color-filter-content'); ?>
   
<?php elseif(Request::is('admin/subscription/custom')): ?>
  <?php echo $__env->make('pages.admin.subscriptions.custom-subscriptions-content', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php $__env->startSection('title', trans('admin.custom_subscriptions_page_title') .' < '. get_site_title()); ?>
  <?php echo $__env->yieldContent('custom-subscriptions-content'); ?>
  
<?php elseif(Request::is('admin/subscription/mailchimp')): ?>
  <?php echo $__env->make('pages.admin.subscriptions.mailchimp-subscriptions-content', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php $__env->startSection('title', trans('admin.mailchimp_subscriptions_page_title') .' < '. get_site_title()); ?>
  <?php echo $__env->yieldContent('mailchimp-subscriptions-content'); ?>
  
<?php elseif(Request::is('admin/subscription/settings')): ?>
  <?php echo $__env->make('pages.admin.subscriptions.subscription-settings-content', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php $__env->startSection('title', trans('admin.subscription_settings_page_title') .' < '. get_site_title()); ?>
  <?php echo $__env->yieldContent('subscription-settings-content'); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>