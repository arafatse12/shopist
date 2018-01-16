<?php $__env->startSection('shop-content'); ?>
<div id="shop_page">
  <?php echo $__env->make( 'frontend-templates.product.' .$appearance_settings['products']. '.' .$appearance_settings['products'] , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>	
<?php $__env->stopSection(); ?>  