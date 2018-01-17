<?php $__env->startSection('testimonial-post-list-content'); ?>
<div class="row">
  <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
    <h4><?php echo trans('admin.posts_list'); ?></h4>
  </div>
  <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
    <div class="pull-right">
      <a href="<?php echo e(route('admin.testimonial_post_content')); ?>" class="btn btn-primary pull-right"><?php echo e(trans('admin.add_new_post')); ?></a>
    </div>  
  </div>
</div>

<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-body">
        <div id="table_search_option">
          <form action="<?php echo e(route('admin.testimonial_post_list_content')); ?>" method="GET"> 
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="input-group">
                  <input type="text" name="term_testimonial" class="search-query form-control" placeholder="<?php echo e(trans('admin.post_title_search_placeholder')); ?>" value="<?php echo e($search_value); ?>" />
                  <div class="input-group-btn">
                    <button class="btn btn-primary" type="submit">
                      <span class="glyphicon glyphicon-search"></span>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </form>  
        </div>      
        <table id="table_for_manufacturers_list" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th><?php echo e(trans('admin.image')); ?></th>
              <th><?php echo e(trans('admin.post_title')); ?></th>
              <th><?php echo e(trans('admin.status')); ?></th>
              <th><?php echo e(trans('admin.action')); ?></th>
            </tr>
          </thead>
          <tbody>
            <?php if(count($testimonial_list_data)>0): ?>
              <?php $__currentLoopData = $testimonial_list_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                <tr>
                  <?php if($row['testimonial_image_url']): ?>
                  <td><img src="<?php echo e(get_image_url($row['testimonial_image_url'])); ?>" alt="<?php echo e(basename ($row['testimonial_image_url'])); ?>"></td>
                  <?php else: ?>
                  <td><img src="<?php echo e(default_placeholder_img_src()); ?>" alt=""></td>
                  <?php endif; ?>

                  <td><?php echo $row['post_title']; ?></td>

                  <?php if($row['post_status'] == 1): ?>
                  <td><?php echo e(trans('admin.enable')); ?></td>
                  <?php else: ?>
                  <td><?php echo e(trans('admin.disable')); ?></td>
                  <?php endif; ?>

                  <td>
                    <div class="btn-group">
                      <button class="btn btn-success btn-flat" type="button"><?php echo e(trans('admin.action')); ?></button>
                      <button data-toggle="dropdown" class="btn btn-success btn-flat dropdown-toggle" type="button">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                      </button>
                      <ul role="menu" class="dropdown-menu">
                        <?php if(in_array('add_edit_testimonial', $user_permission_list)): ?>
                          <li><a href="<?php echo e(route('admin.update_testimonial_post_content', $row['post_slug'])); ?>"><i class="fa fa-edit"></i><?php echo e(trans('admin.edit')); ?></a></li>
                        <?php endif; ?>
                        
                        <?php if(in_array('delete_testimonial', $user_permission_list)): ?>
                          <li><a class="remove-selected-data-from-list" data-track_name="testimonial_list" data-id="<?php echo e($row['id']); ?>" href="#"><i class="fa fa-remove"></i><?php echo e(trans('admin.delete')); ?></a></li>
                        <?php endif; ?>
                      </ul>
                    </div>
                  </td>
                </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
            <?php else: ?>
            <tr><td colspan="4"><i class="fa fa-exclamation-triangle"></i> <?php echo trans('admin.no_data_found_label'); ?></td></tr>
            <?php endif; ?>
          </tbody>
          <tfoot>
            <th><?php echo e(trans('admin.image')); ?></th>
            <th><?php echo e(trans('admin.post_title')); ?></th>
            <th><?php echo e(trans('admin.status')); ?></th>
            <th><?php echo e(trans('admin.action')); ?></th>
          </tfoot>
        </table>
        <div class="products-pagination"><?php echo $testimonial_list_data->appends(Request::capture()->except('page'))->render(); ?></div>  
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>