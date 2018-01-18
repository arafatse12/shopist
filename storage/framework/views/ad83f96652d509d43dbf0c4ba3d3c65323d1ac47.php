<?php $__env->startSection('manufacturers-update-content'); ?>
<?php if($manufacturers_update_data): ?>

<?php echo $__env->make('pages-message.notify-msg-success', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('pages-message.form-submit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
  <input type="hidden" name="_token" id="_token" value="<?php echo e(csrf_token()); ?>">
  
  <div class="box box-info">
    <div class="box-header">
      <h3 class="box-title"><?php echo e(trans('admin.update_manufacturers')); ?> &nbsp;&nbsp;&nbsp;&nbsp;<a class="btn btn-default btn-xs" href="<?php echo e(route('admin.manufacturers_list_content')); ?>"><?php echo e(trans('admin.manufacturers_list')); ?></a>&nbsp;&nbsp;<a class="btn btn-default btn-xs" href="<?php echo e(route('admin.add_manufacturers_content')); ?>"><?php echo e(trans('admin.add_more_manufacturers')); ?></a></h3>
      <div class="box-tools pull-right">
        <button class="btn btn-primary pull-right" type="submit"><?php echo e(trans('admin.update')); ?></button>
      </div>
    </div>
  </div>
  
<div class="box box-solid">
 <div class="row">
    <div class="col-md-12">
      <div class="box-body">
        <div class="form-group">
          <label class="col-sm-3 control-label" for="inputManufacturersName"><?php echo e(trans('admin.manufacturers_name')); ?></label>
          <div class="col-sm-9">
            <input type="text" placeholder="<?php echo e(trans('admin.manufacturers_name')); ?>" id="inputManufacturersName" name="inputManufacturersName" class="form-control" value="<?php echo e($manufacturers_update_data['name']); ?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 control-label" for="inputCountryName"><?php echo e(trans('admin.country_name')); ?></label>
          <div class="col-sm-9">
            <input type="text" placeholder="<?php echo e(trans('admin.country_name')); ?>" id="inputCountryName" name="inputCountryName" class="form-control" value="<?php echo e($manufacturers_update_data['brand_country_name']); ?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 control-label" for="inputShortDescription"><?php echo e(trans('admin.short_description')); ?></label>
          <div class="col-sm-9">
            <textarea id="inputShortDescription" name="inputShortDescription" class="dynamic-editor" placeholder="<?php echo e(trans('admin.short_description')); ?>">
             <?php echo string_decode( $manufacturers_update_data['brand_short_description'] ); ?>

            </textarea>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 control-label" for="inputStatus"><?php echo e(trans('admin.status')); ?></label>
          <div class="col-sm-9">
            <select class="form-control select2" name="inputStatus" style="width: 100%;">
              
              <?php if($manufacturers_update_data['status'] == 1): ?>
              <option selected="selected" value="1"><?php echo e(trans('admin.enable')); ?></option>
              <?php else: ?>
              <option value="1"><?php echo e(trans('admin.enable')); ?></option>
              <?php endif; ?>
              
              <?php if($manufacturers_update_data['status'] == 0): ?>
              <option selected="selected" value="0"><?php echo e(trans('admin.disable')); ?></option>
              <?php else: ?>
              <option value="0"><?php echo e(trans('admin.disable')); ?></option>
              <?php endif; ?>
              
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 control-label" for="inputUploadLogo"><?php echo e(trans('admin.upload_logo')); ?></label>
          <div class="col-sm-9">
            <div class="uploadform dropzone no-margin dz-clickable upload-manufacturers-logo" id="inputUploadLogo" name="inputUploadLogo">
              <div class="dz-default dz-message">
                <span><?php echo e(trans('admin.drop_your_cover_picture_here')); ?></span>
              </div>
            </div>
            <br>
            <div class="manufacturers-img-content">
              <div class="manufacturers-sample-img" <?php echo $manufacturers_logo_control['sample_img']; ?>><img class="img-responsive" src="<?php echo e(default_upload_sample_img_src()); ?>" alt=""></div>
              <div class="manufacturers-img" <?php echo $manufacturers_logo_control['manufacturers_logo']; ?>><img class="img-responsive" src="<?php echo e(get_image_url($manufacturers_update_data['brand_logo_img_url'])); ?>" alt=""></div>
              <br>
              <div class="manufacturers-img-remove-btn" <?php echo $manufacturers_logo_control['manufacturers_logo']; ?>>
                <button type="button" class="btn btn-default attachtopost remove-manufacturers-img"><?php echo e(trans('admin.remove_image')); ?></button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<input type="hidden" name="logo_img" id="logo_img" value="<?php echo e($manufacturers_update_data['brand_logo_img_url']); ?>">
</form>

<?php endif; ?>
<?php $__env->stopSection(); ?>