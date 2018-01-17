<?php $__env->startSection('compare-products-content'); ?>
<form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
  <input type="hidden" name="_token" id="_token" value="<?php echo e(csrf_token()); ?>">
		
		<div class="box box-info">
    <div class="box-header">
      <h3 class="box-title"><?php echo trans('admin.more_features_add_compare_fields_label'); ?></h3>
      <div class="box-tools pull-right">
        <button class="btn btn-primary pull-right" type="submit"><?php echo trans('admin.save'); ?></button>
      </div>
    </div>
  </div>
		
		<div class="box box-solid">
				<div class="row">
						<div class="col-md-12">
								<div class="box-body">
										<div class="add-compare-fields-main clearfix">
												<button id="add_compare_fields" class="btn btn-primary pull-right" type="button"><i class="fa fa-plus"></i> <?php echo trans('admin.more_features_add_compare_more_fields_label'); ?></button>
										</div> <br>
										<div class="add-compare-fields-content">
                      <?php if(!empty($fields_name) && count($fields_name) > 0): ?>
                        <?php $__currentLoopData = $fields_name; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                        <div id="<?php echo e($key); ?>" class="product-compare-field-title clearfix"><div class="col-md-10"><input placeholder="<?php echo e(trans('admin.more_compare_field_placeholder')); ?>" name="product_compare_field_title[<?php echo $key;?>]" class="form-control" type="text" value="<?php echo e($val); ?>"></div><div class="col-md-2"><button id="remove_product_compare_fields" class="btn btn-default remove-product-compare-fields" type="button"><i class="fa fa-remove"></i> <?php echo trans('admin.remove_label'); ?></button></div></div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                      <?php endif; ?>
										</div>		
								</div>
						</div>
				</div>
		</div>		
</form>		
<?php $__env->stopSection(); ?>