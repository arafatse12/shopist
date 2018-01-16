<meta charset="UTF-8">
<title><?php echo $__env->yieldContent('title'); ?></title>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

<?php if((Request::is('product/details/*') || Request::is('product/customize/*')) && !empty($single_product_details['meta_keywords'])): ?>
<meta name="keywords" content="<?php echo e($single_product_details['meta_keywords']); ?>">
<?php elseif( Request::is('blog/*') && !empty($blog_details_by_slug['meta_keywords'])): ?>
<meta name="keywords" content="<?php echo e($blog_details_by_slug['meta_keywords']); ?>">
<?php elseif(!empty($seo_data) && $seo_data['meta_tag']['meta_keywords']): ?>
<meta name="keywords" content="<?php echo e($seo_data['meta_tag']['meta_keywords']); ?>">
<?php endif; ?>

<?php if(!empty($seo_data) && $seo_data['meta_tag']['meta_description']): ?>
<meta name="description" content="<?php echo e($seo_data['meta_tag']['meta_description']); ?>">
<?php endif; ?>

<?php if((Request::is('product/details/*') || Request::is('product/customize/*')) && !empty($single_product_details['_product_seo_description'])): ?>
<meta name="description" content="<?php echo e($single_product_details['_product_seo_description']); ?>">
<?php endif; ?>

<?php if((Request::is('product/details/*') || Request::is('product/customize/*')) && !empty($single_product_details['post_slug'])): ?>
<link rel="canonical" href="<?php echo e(route('details-page', $single_product_details['post_slug'])); ?>">
<?php endif; ?>

<?php if(Request::is('blog/*') && !empty($blog_details_by_slug['blog_seo_description'])): ?>
<meta name="description" content="<?php echo e($blog_details_by_slug['blog_seo_description']); ?>">
<?php endif; ?>

<?php if(Request::is('blog/*') && !empty($blog_details_by_slug['blog_seo_url'])): ?>
<link rel="canonical" href="<?php echo e(route('blog-single-page', $blog_details_by_slug['blog_seo_url'])); ?>">
<?php endif; ?>

<?php echo HTML::style('resources/assets/frontend/css/bootstrap.min.css'); ?>

<?php echo HTML::style('resources/assets/font-awesome-4.6.3/css/font-awesome.min.css'); ?>

<?php echo HTML::style('resources/assets/plugins/datatables/dataTables.bootstrap.css'); ?>

<?php echo HTML::style('resources/assets/frontend/css/font-awesome.min.css'); ?>

<?php echo HTML::style('resources/assets/sweetalert/sweetalert.css'); ?>

<?php echo HTML::style('resources/assets/plugins/select2/select2.min.css'); ?>

<?php echo HTML::style('resources/assets/dropzone/css/dropzone.css'); ?>

<?php echo HTML::style('resources/assets/designer/designer.css'); ?>

<?php echo HTML::style('resources/assets/designer/scroll/jquery.mCustomScrollbar.css'); ?>

<?php echo HTML::style('resources/assets/plugins/ionslider/ion.rangeSlider.css'); ?>

<?php echo HTML::style('resources/assets/plugins/ionslider/ion.rangeSlider.skinModern.css'); ?>

<?php echo HTML::style('resources/assets/plugins/bootstrap-slider/slider.css'); ?>

<?php echo HTML::style('resources/assets/frontend/css/common.css'); ?>

<?php echo HTML::style('resources/assets/frontend/css/price-range.css'); ?>

<?php echo HTML::style('resources/assets/plugins/iCheck/square/purple.css'); ?>

<?php echo HTML::style('resources/assets/modal/css/modal.css'); ?>

<?php echo HTML::style('resources/assets/modal/css/modal-extra.css'); ?>

<?php echo HTML::style('resources/assets/slick/slick.css'); ?>

<?php echo HTML::style('resources/assets/slick/slick-theme.css'); ?>


<?php echo HTML::style('resources/views/frontend-templates/footer/black-crazy/style.css'); ?>


<!--load header style-->
<?php echo HTML::style('resources/views/frontend-templates/header/'. $appearance_settings['header'] .'/style.css'); ?>


<!--load home style-->
<?php echo HTML::style('resources/views/frontend-templates/home/'. $appearance_settings['home'] .'/style.css'); ?>


<!--load blogs style-->
<?php echo HTML::style('resources/views/frontend-templates/blog/'. $appearance_settings['blogs'] .'/style.css'); ?>


<!--load products style-->
<?php echo HTML::style('resources/views/frontend-templates/product/'. $appearance_settings['products'] .'/style.css'); ?>


<!--load single products style-->
<?php echo HTML::style('resources/views/frontend-templates/single-product/'. $appearance_settings['single_product'] .'/style.css'); ?>



<?php echo HTML::script('resources/assets/jquery/jquery-1.10.2.js'); ?>

<?php echo HTML::script('resources/assets/jquery/jquery-ui-1.11.4.js'); ?>

<?php echo HTML::script('resources/assets/dropzone/dropzone.js'); ?>

<?php echo HTML::script('resources/assets/frontend/js/bootstrap.min.js'); ?>

<?php echo HTML::script('resources/assets/plugins/datatables/jquery.dataTables.min.js'); ?>

<?php echo HTML::script('resources/assets/plugins/datatables/dataTables.bootstrap.min.js'); ?>

<?php echo HTML::script('resources/assets/frontend/js/jquery.scrollUp.min.js'); ?>

<?php echo HTML::script('resources/assets/sweetalert/sweetalert.min.js'); ?>

<?php echo HTML::script('resources/assets/plugins/select2/select2.full.min.js'); ?>

<?php echo HTML::script('resources/assets/designer/fabric-1.5.0.min.js'); ?>

<?php echo HTML::script('resources/assets/designer/fabric.curvedText.js'); ?>

<?php echo HTML::script('resources/assets/designer/customiseControls.min.js'); ?>

<?php echo HTML::script('resources/assets/designer/colorpicker/jscolor.js'); ?>

<?php echo HTML::script('resources/assets/designer/scroll/jquery.mCustomScrollbar.concat.min.js'); ?>

<?php echo HTML::script('resources/assets/designer/jsPDF.min.js'); ?>

<?php echo HTML::script('resources/assets/plugins/ionslider/ion.rangeSlider.min.js'); ?>

<?php echo HTML::script('resources/assets/plugins/bootstrap-slider/bootstrap-slider.js'); ?>

<?php echo HTML::script('resources/assets/designer/designer.js'); ?>

<?php echo HTML::script('resources/assets/designer/designerControl.js'); ?>

<?php echo HTML::script('resources/assets/frontend/js/products-variation.js'); ?>

<?php echo HTML::script('resources/assets/frontend/js/products-add-to-cart.js'); ?>

<?php echo HTML::script('resources/assets/frontend/js/price-range.js'); ?>

<?php echo HTML::script('resources/assets/plugins/iCheck/icheck.min.js'); ?>

<?php echo HTML::script('resources/assets/modal/js/modal.js'); ?>

<?php echo HTML::script('resources/assets/frontend/js/jquery.validate.js'); ?>


<?php echo HTML::script('resources/views/frontend-templates/footer/black-crazy/script.js'); ?>


<!--load header scripts-->
<?php echo HTML::script('resources/views/frontend-templates/header/'. $appearance_settings['header'] .'/script.js'); ?>


<!--load home scripts-->
<?php echo HTML::script('resources/views/frontend-templates/home/'. $appearance_settings['home'] .'/script.js'); ?>


<!--load blogs scripts-->
<?php echo HTML::script('resources/views/frontend-templates/blog/'. $appearance_settings['blogs'] .'/script.js'); ?>


<!--load products scripts-->
<?php echo HTML::script('resources/views/frontend-templates/product/'. $appearance_settings['products'] .'/script.js'); ?>


<!--load single products scripts-->
<?php echo HTML::script('resources/views/frontend-templates/single-product/'. $appearance_settings['single_product'] .'/script.js'); ?>

<?php echo HTML::script('resources/views/frontend-templates/single-product/'. $appearance_settings['single_product'] .'/jquery.elevatezoom.js'); ?>


<?php echo HTML::script('resources/assets/frontend/js/common.js'); ?>

<?php echo HTML::script('resources/assets/frontend/js/social-network.js'); ?>

<?php echo HTML::script('resources/assets/slick/slick.min.js'); ?>

