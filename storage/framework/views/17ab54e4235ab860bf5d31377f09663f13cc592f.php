<?php $__env->startSection('custom-product-comparison-page-content'); ?>
<div class="container">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <div class="span12 product-comparison-list">
        <div class="page-header cm14"><h2><?php echo trans('frontend.product_comparison_title_label'); ?></h2></div>
        <div class="cm14">
          <?php if(count($compare_product_data) > 0): ?>
          <h4 class="cm14"><?php echo trans('frontend.product_comparison_details_title_label'); ?></h4>
          <table class="table table-hover table-bordered table-condensed">
            <tbody>
              <?php $__currentLoopData = $compare_product_label; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
              <tr>
                <td><?php echo $label; ?></td>
                <?php $__currentLoopData = $compare_product_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $products): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                  <?php if($label == 'Image'): ?>
                  <td><img src="<?php echo e(get_image_url($products['_product_related_images_url']->product_image)); ?>" alt="<?php echo e(basename($products['_product_related_images_url']->product_image)); ?>"></td>
                  <?php endif; ?>

                  <?php if($label == 'Product'): ?>
                  <td><a href="<?php echo e(route('details-page', $products['post_slug'])); ?>" target="_blank"><?php echo $products['post_title']; ?></a></td>
                  <?php endif; ?>

                  <?php if($label == 'Price'): ?>
                  <td><?php echo price_html( $products['_product_price'], get_frontend_selected_currency() ); ?></td>
                  <?php endif; ?>

                  <?php if(($label !== 'Image' && $label !== 'Product' && $label !== 'Price') && !empty($products['_product_compare_data'])): ?>
                  <td><?php echo $products['_product_compare_data'][$key]; ?></td>
                  <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
              </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

              <tr>
                <td></td>
                <?php $__currentLoopData = $compare_product_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $products): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                <td class="text-center"><a class="btn btn-danger" href="<?php echo e(route('remove-compare-product-from-list', $products['id'])); ?>"><i class="icon-white icon-trash"></i><span class="hidden-phone"> <?php echo trans('frontend.remove'); ?></span></a></td>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
              </tr>
            </tbody>
          </table>
          <?php else: ?>
          <div class="no-comparison-label"><?php echo trans('frontend.product_comparison_no_label'); ?></div>
          <?php endif; ?>
        </div>
      </div>
    </div>      
	</div>
</div>
<?php $__env->stopSection(); ?>