<?php $__env->startSection('products-details-content'); ?>
  <div id="product_single_page">
    <?php echo $__env->make( 'frontend-templates.single-product.' .$appearance_settings['single_product']. '.' .$appearance_settings['single_product'] , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  </div>
<?php $__env->stopSection(); ?>