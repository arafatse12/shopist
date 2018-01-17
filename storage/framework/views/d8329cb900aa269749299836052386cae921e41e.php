<?php $__env->startSection('art-categories-lists-content'); ?>
<div class="box box-info">
  <div class="box-header">
    <h3 class="box-title"><?php echo e(trans('admin.art_categories_lists')); ?></h3>
    <div class="box-tools pull-right">
      <a href="<?php echo e(route('admin.art_new_category_content')); ?>" class="btn btn-primary pull-right"><?php echo e(trans('admin.add_new_category')); ?></a>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-body">
        <div id="table_search_option">
          <form action="<?php echo e(route('admin.art_categories_list_content')); ?>" method="GET"> 
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="input-group">
                  <input type="text" name="term_art_cat" class="search-query form-control" placeholder="Enter your cat name to search" value="<?php echo e($search_value); ?>" />
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
        <table class="table table-bordered table-striped admin-data-table">
          <thead>
            <tr>
              <th><?php echo e(trans('admin.name')); ?></th>
              <th><?php echo e(trans('admin.status')); ?></th>
              <th><?php echo e(trans('admin.action')); ?></th>
            </tr>
          </thead>
          <tbody>
            <?php if(count($art_cat_lists_data)>0): ?>
              <?php $__currentLoopData = $art_cat_lists_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
              <tr>
                <td><?php echo $row['name']; ?></td>

                <?php if($row['status'] == 1): ?>
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
                      <li><a href="<?php echo e(route('admin.update_art_category_content', $row['slug'])); ?>"><i class="fa fa-edit"></i><?php echo e(trans('admin.edit')); ?></a></li>
                      <li><a class="remove-selected-data-from-list" data-track_name="art_cat_list" data-id="<?php echo e($row['term_id']); ?>" href="#"><i class="fa fa-remove"></i><?php echo e(trans('admin.delete')); ?></a></li>
                    </ul>
                  </div>
                </td>
              </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
            <?php else: ?>
              <tr><td colspan="3"><i class="fa fa-exclamation-triangle"></i> <?php echo trans('admin.no_data_found_label'); ?></td></tr>  
            <?php endif; ?>
          </tbody>
          <tfoot>
            <tr>
              <th><?php echo e(trans('admin.name')); ?></th>
              <th><?php echo e(trans('admin.status')); ?></th>
              <th><?php echo e(trans('admin.action')); ?></th>
            </tr>
          </tfoot>
        </table>
        <div class="products-pagination"><?php echo $art_cat_lists_data->appends(Request::capture()->except('page'))->render(); ?></div>  
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>