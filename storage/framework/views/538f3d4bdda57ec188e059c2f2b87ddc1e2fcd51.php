<?php $__env->startSection('product-attributes-list-content'); ?>

<div class="box box-info">
  <div class="box-header">
    <h3 class="box-title"><?php echo trans('admin.attributes_list'); ?></h3>
    <div class="box-tools pull-right">
      <button data-toggle="modal" data-target="#addDynamicAttributes" class="btn btn-primary custom-event-attrs" type="button"><?php echo trans('admin.add_new_attributes'); ?></button>
    </div>
  </div>
</div>

<div class="modal fade" id="addDynamicAttributes" tabindex="-1" role="dialog" aria-labelledby="updater" aria-hidden="true">
  <div class="modal-dialog add-attributes-dialog">
    <div class="ajax-overlay"></div>
    
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">✕</button>
        <br>
        <i class="icon-credit-card icon-7x"></i>
        <p class="no-margin top-title-attrs"><b><?php echo trans('admin.create_new_product_attrs'); ?></b></p>
      </div>
      <div class="modal-body">
        <div class="custom-model-row">
          <div class="custom-input-group">
            <div class="custom-input-label"><label for="inputAttrsName"><?php echo trans('admin.attribute_name'); ?></label></div>
            <div class="custom-input-element"><input type="text" placeholder="<?php echo e(trans('admin.attribute_name_example_size')); ?>" id="inputAttrName" name="inputAttrName" class="form-control"></div>
          </div>
          <div class="custom-input-group">
            <div class="custom-input-label"><label for="inputAttrsValue"><?php echo trans('admin.attribute_value'); ?></label></div>
            <div class="custom-input-element"><input type="text" placeholder="<?php echo e(trans('admin.attribute_values_example')); ?>" id="inputAttrValues" name="inputAttrValues" class="form-control"><span><?php echo trans('admin.enter_attribute_values_by_comma_separator'); ?></span></div>
          </div>  
          <div class="custom-input-group">
            <div class="custom-input-label"><label for="inputAttrsStatus"><?php echo trans('admin.status'); ?></label></div>
            <div class="custom-input-element">
              <select name="attrs_status" id="attrs_status" class="form-control select2" style="width: 100%;">
                <option value="1"><?php echo trans('admin.enable'); ?></option>
                <option value="0"><?php echo trans('admin.disable'); ?></option>
              </select>
            </div>
          </div>
        </div>     
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default attachtopost create-attrs"><?php echo trans('admin.create_attrs'); ?></button>
        <button type="button" class="btn btn-default attachtopost" data-dismiss="modal"><?php echo trans('admin.close'); ?></button>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-body">
        <div id="table_search_option">
          <form action="<?php echo e(route('admin.product_attributes_list')); ?>" method="GET"> 
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="input-group">
                  <input type="text" name="term_attrs" class="search-query form-control" placeholder="Enter your attribute name to search" value="<?php echo e($search_value); ?>" />
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
              <th><?php echo trans('admin.attributes_name'); ?></th>
              <th><?php echo trans('admin.attributes_values'); ?></th>
              <th><?php echo trans('admin.status'); ?></th>
              <th><?php echo trans('admin.action'); ?></th>
            </tr>
          </thead>
          <tbody>
            <?php if(count($attribute_list_data)>0): ?>
              <?php $__currentLoopData = $attribute_list_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
              <tr>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['product_attr_values']; ?></td>

                <?php if($row['status'] == 1): ?>
                  <td><?php echo trans('admin.enable'); ?></td>
                <?php else: ?>
                  <td><?php echo trans('admin.disable'); ?></td>
                <?php endif; ?>

                <td>
                  <div class="btn-group">
                    <button class="btn btn-success btn-flat" type="button"><?php echo trans('admin.action'); ?></button>
                    <button data-toggle="dropdown" class="btn btn-success btn-flat dropdown-toggle" type="button">
                      <span class="caret"></span>
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul role="menu" class="dropdown-menu">
                      <li><a href="#" class="edit-data" data-track_name="attr_list" data-id="<?php echo e($row['term_id']); ?>"><i class="fa fa-edit"></i><?php echo trans('admin.edit'); ?></a></li>
                      <li><a class="remove-selected-data-from-list" data-track_name="attr_list" data-id="<?php echo e($row['term_id']); ?>" href="#"><i class="fa fa-remove"></i><?php echo trans('admin.delete'); ?></a></li>
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
            <tr>
              <th><?php echo trans('admin.attributes_name'); ?></th>
              <th><?php echo trans('admin.attributes_values'); ?></th>
              <th><?php echo trans('admin.status'); ?></th>
              <th><?php echo trans('admin.action'); ?></th>
            </tr>
          </tfoot>
        </table>
        <div class="products-pagination"><?php echo $attribute_list_data->appends(Request::capture()->except('page'))->render(); ?></div>  
      </div>
    </div>
  </div>
</div>
<div class="eb-overlay"></div>
<div class="eb-overlay-loader"></div>

<input type="hidden" name="hf_from_model" id="hf_from_model" value="">
<input type="hidden" name="hf_update_id" id="hf_update_id" value="">

<?php $__env->stopSection(); ?>