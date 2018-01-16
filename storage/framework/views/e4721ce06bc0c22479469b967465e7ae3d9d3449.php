<?php $__env->startSection('home-content'); ?>
  <div id="home_page">
    <?php echo $__env->make( 'frontend-templates.home.' .$appearance_settings['home']. '.' .$appearance_settings['home'] , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  </div>
<?php $__env->stopSection(); ?>

 