<?php $__env->startSection('content'); ?>

<?php if(Request::is('home')): ?>
  <?php echo $__env->make('pages.frontend.frontend-pages.home', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php $__env->startSection('title', trans('frontend.shopist_home_title') .' - '. get_site_title() ); ?>
  <?php echo $__env->yieldContent('home-content'); ?>
  
<?php elseif(Request::is('shop')): ?>
  <?php echo $__env->make('pages.frontend.frontend-pages.shop', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php $__env->startSection('title', trans('frontend.shopist_shop_title') .' - '. get_site_title() ); ?>
  <?php echo $__env->yieldContent('shop-content'); ?>
    
<?php elseif(Request::is('product/details/*')): ?>
  <?php echo $__env->make('pages.frontend.frontend-pages.product-details', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php $__env->startSection('title', $single_product_details['_product_seo_title'] .' - '. get_site_title() ); ?>
  <?php echo $__env->yieldContent('products-details-content'); ?>
  
<?php elseif(Request::is('product/categories/*') || Request::is('product/categories/*/grid_view') || Request::is('product/categories/*/list_view')): ?>
  <?php echo $__env->make('pages.frontend.frontend-pages.categories-main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php $__env->startSection('title', trans('frontend.shopist_category_products') .' - '. get_site_title() ); ?>
  <?php echo $__env->yieldContent('categories-main-content'); ?>
  
<?php elseif(Request::is('testimonial/*')): ?>
  <?php echo $__env->make('pages.frontend.frontend-pages.testimonial-details', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php $__env->startSection('title', trans('frontend.testimonials_details_page_title') .' - '. get_site_title() ); ?>
  <?php echo $__env->yieldContent('testimonial-details-content'); ?>  
  
<?php elseif(Request::is('checkout')): ?>
  <?php echo $__env->make('pages.frontend.frontend-pages.checkout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php $__env->startSection('title', trans('frontend.shopist_checkout') .' - '. get_site_title() ); ?>
  <?php echo $__env->yieldContent('checkout-content'); ?>
  
<?php elseif(Request::is('cart')): ?>
  <?php echo $__env->make('pages.frontend.frontend-pages.cart', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php $__env->startSection('title', trans('frontend.shopist_cart_title') .' - '. get_site_title() ); ?>
  <?php echo $__env->yieldContent('cart-content'); ?>  
  
<?php elseif(Request::is('product/customize/*')): ?>
  <?php echo $__env->make('pages.frontend.frontend-pages.frontend-designer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php $__env->startSection('title',  trans('frontend.shopist_customize_page') .' - '. get_site_title() ); ?>
  <?php echo $__env->yieldContent('frontend-designer-html-content'); ?>
  
<?php elseif(Request::is('checkout/order-received/*')): ?>
  <?php echo $__env->make('pages.frontend.frontend-pages.thank-you', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php $__env->startSection('title',  trans('frontend.shopist_order_received_title') .' - '. get_site_title() ); ?>
  <?php echo $__env->yieldContent('frontend-thank-you-content'); ?> 
    
<?php elseif(Request::is('user/account') || Request::is('user/account/dashboard') || Request::is('user/account/my-address') || Request::is('user/account/my-address/add') || Request::is('user/account/my-address/edit') || Request::is('user/account/my-profile') || Request::is('user/account/my-orders') || Request::is('user/account/my-saved-items') || Request::is('user/account/view-orders-details/*') || Request::is('user/account/my-coupons') || Request::is('user/account/download') || Request::is('user/account/order-details/*')): ?>

  <?php echo $__env->make('pages.frontend.user-account.user-account-pages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  
  <?php if(Request::is('user/account')): ?>
    <?php $__env->startSection('title',  trans('frontend.frontend_user_dashboard_title') .' - '. get_site_title() ); ?>
  <?php elseif(Request::is('user/account/dashboard')): ?>
    <?php $__env->startSection('title',  trans('frontend.frontend_user_dashboard_title') .' - '. get_site_title() ); ?>
  <?php elseif(Request::is('user/account/my-address')): ?>
    <?php $__env->startSection('title',  trans('frontend.frontend_user_address_title') .' - '. get_site_title() ); ?>
  <?php elseif(Request::is('user/account/my-address/add')): ?>
    <?php $__env->startSection('title',  trans('frontend.frontend_user_address_add_title') .' - '. get_site_title() ); ?> 
  <?php elseif(Request::is('user/account/my-address/edit')): ?>
    <?php $__env->startSection('title',  trans('frontend.frontend_user_address_edit_title') .' - '. get_site_title() ); ?>
  <?php elseif(Request::is('user/account/my-profile')): ?>
    <?php $__env->startSection('title',  trans('frontend.frontend_user_profile_edit_title') .' - '. get_site_title() ); ?>
  <?php elseif(Request::is('user/account/my-orders')): ?>
    <?php $__env->startSection('title',  trans('frontend.frontend_my_order_title') .' - '. get_site_title() ); ?>
  <?php elseif(Request::is('user/account/my-saved-items')): ?>
    <?php $__env->startSection('title',  trans('frontend.frontend_wishlist_items_title') .' - '. get_site_title() ); ?> 
  <?php elseif(Request::is('user/account/my-coupons')): ?>
    <?php $__env->startSection('title',  trans('frontend.frontend_coupons_items_title') .' - '. get_site_title() ); ?>
  <?php elseif(Request::is('user/account/download')): ?>
    <?php $__env->startSection('title',  trans('frontend.frontend_download_options_title') .' - '. get_site_title() ); ?>  
  <?php elseif(Request::is('user/account/order-details/*')): ?>
    <?php $__env->startSection('title',  trans('frontend.user_order_details_page_title') .' - '. get_site_title() ); ?>  
  <?php endif; ?>
  <?php echo $__env->yieldContent('frontend-user-account'); ?>
  
<?php elseif(Request::is('blogs')): ?>
  <?php echo $__env->make('pages.frontend.frontend-pages.blogs-main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php $__env->startSection('title',  trans('frontend.blogs_page_title') .' - '. get_site_title() ); ?>
  <?php echo $__env->yieldContent('frontend-blogs-content'); ?>
  
<?php elseif(Request::is('categories/blog/*')): ?>
  <?php echo $__env->make('pages.frontend.frontend-pages.blog-categories-post', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php $__env->startSection('title',  trans('frontend.cat_post_label') .' - '. get_site_title() ); ?>
  <?php echo $__env->yieldContent('frontend-blogs-cat-post-content'); ?>
  
<?php elseif(Request::is('blog/*')): ?>
  <?php echo $__env->make('pages.frontend.frontend-pages.blog-single-page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php if(!empty($blog_details_by_slug['blog_seo_title'])): ?>
    <?php $__env->startSection('title',  $blog_details_by_slug['blog_seo_title'] .' - '. get_site_title()); ?>
  <?php else: ?>
    <?php $__env->startSection('title',  trans('frontend.blog_details_page_label') .' - '. get_site_title()); ?>
  <?php endif; ?>
  <?php echo $__env->yieldContent('frontend-blog-single-page-content'); ?>
  
<?php elseif(Request::is('brand/*')): ?>
  <?php echo $__env->make('pages.frontend.frontend-pages.brand-single-page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php $__env->startSection('title',  trans('frontend.brand_details_page_label') .' - '. get_site_title() ); ?>
  <?php echo $__env->yieldContent('frontend-brand-single-page-content'); ?>
  
<?php elseif(Request::is('product/tag/*')): ?>
  <?php echo $__env->make('pages.frontend.frontend-pages.tag-single-page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php $__env->startSection('title',  trans('frontend.tag_details_page_label') .' - '. get_site_title() ); ?>
  <?php echo $__env->yieldContent('frontend-tag-single-page-content'); ?>
		
<?php elseif(Request::is('page/*')): ?>
  <?php echo $__env->make('pages.frontend.frontend-pages.custom-single-page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php $__env->startSection('title', $page_data->post_title .' - '. get_site_title()); ?>
  <?php echo $__env->yieldContent('custom-single-page-content'); ?>
  
<?php elseif(Request::is('product/comparison')): ?>
  <?php echo $__env->make('pages.frontend.frontend-pages.product-comparison', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php $__env->startSection('title', trans('frontend.product_comparison_title_label') .' - '. get_site_title()); ?>
  <?php echo $__env->yieldContent('custom-product-comparison-page-content'); ?>  
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>