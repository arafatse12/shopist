<?php $__env->startSection('dashboard-content'); ?>
<div class="row">
  <div class="col-lg-3 col-xs-12">
    <div class="small-box bg-gray">
      <div class="inner">
        <h3><?php echo price_html( $dashboard_data['today_totals_sales'] ); ?></h3>
        <p><?php echo e(trans('admin.today_total_sales')); ?></p>
      </div>
      <div class="icon">
        <i class="fa fa-shopping-cart"></i>
      </div>
      <a href="<?php echo e(route('admin.shop_current_date_orders_list')); ?>" class="small-box-footer"><?php echo e(trans('admin.more_info')); ?> <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-lg-3 col-xs-12">
    <div class="small-box bg-aqua">
      <div class="inner">
        <h3><?php echo $dashboard_data['total_products']; ?></h3>
        <p><?php echo e(trans('admin.total_products')); ?></p>
      </div>
      <div class="icon">
        <i class="fa fa-shopping-cart"></i>
      </div>
      <a href="<?php echo e(route('admin.product_list')); ?>" class="small-box-footer"><?php echo e(trans('admin.more_info')); ?> <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-lg-3 col-xs-12">
    <div class="small-box bg-green">
      <div class="inner">
        <h3><?php echo $dashboard_data['today_orders']; ?></h3>
        <p><?php echo e(trans('admin.today_orders')); ?></p>
      </div>
      <div class="icon">
        <i class="fa fa-area-chart"></i>
      </div>
      <a href="<?php echo e(route('admin.shop_current_date_orders_list')); ?>" class="small-box-footer"><?php echo e(trans('admin.more_info')); ?> <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-lg-3 col-xs-12">
    <div class="small-box bg-yellow">
      <div class="inner">
        <h3><?php echo $dashboard_data['total_orders']; ?></h3>
        <p><?php echo e(trans('admin.total_orders')); ?></p>
      </div>
      <div class="icon">
        <i class="fa fa-area-chart"></i>
      </div>
      <a href="<?php echo e(route('admin.shop_orders_list')); ?>" class="small-box-footer"><?php echo e(trans('admin.more_info')); ?> <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
</div>

<div class="row">
  <section class="col-lg-7">
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo e(trans('admin.latest_orders')); ?></h3>
        <div class="box-tools pull-right">
          <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
      </div>
      <div class="box-body">
        <div class="table-responsive">
          <table class="table no-margin latest-orders">
            <thead>
              <tr>
                <th><?php echo e(trans('admin.order_id')); ?></th>
                <th><?php echo e(trans('admin.date')); ?></th>
                <th><?php echo e(trans('admin.status')); ?></th>
                <th><?php echo e(trans('admin.order_totals')); ?></th>
              </tr>
            </thead>
            <tbody>
              <?php if(count($dashboard_data['latest_orders'])>0): ?>
                <?php $__currentLoopData = $dashboard_data['latest_orders']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vals): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                  <tr>
                    <td><a href="<?php echo e(route('admin.view_order_details', $vals['order_id'])); ?>">#<?php echo $vals['order_id']; ?></a></td>
                    <td><?php echo $vals['order_date']; ?></td>
                    <td>
                      <?php if($vals['order_status'] == 'on-hold'): ?><span class="on-hold-label"><?php echo e(trans('admin.on_hold')); ?></span><?php elseif($vals['order_status'] == 'refunded'): ?> <span class="refunded-label"><?php echo e(trans('admin.refunded')); ?></span><?php elseif($vals['order_status'] == 'cancelled'): ?> <span class="cancelled-label"><?php echo e(trans('admin.cancelled')); ?></span> <?php elseif($vals['order_status'] == 'pending'): ?> <span class="pending-label"><?php echo e(trans('admin.pending')); ?></span> <?php elseif($vals['order_status'] == 'processing'): ?> <span class="processing-label"><?php echo e(trans('admin.processing')); ?></span> <?php elseif($vals['order_status'] == 'completed'): ?> <span class="completed-label"><?php echo e(trans('admin.completed')); ?></span> <?php elseif($vals['order_status'] == 'shipping'): ?> <span class="shipping-label"><?php echo e(trans('admin.shipping')); ?></span> <?php endif; ?>
                    </td>
                    <td><?php echo price_html( $vals['order_totals'],  $vals['order_currency']); ?></td>
                  </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>  
              <?php else: ?>
              <tr>
                <td rowspan="4"><?php echo e(trans('admin.no_latest_order_yet')); ?></td>
              </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="box-footer clearfix">
        <a href="<?php echo e(route('admin.shop_orders_list')); ?>" class="btn btn-sm btn-default btn-flat pull-right"><?php echo e(trans('admin.view_all_orders')); ?></a>
      </div>
    </div>
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo e(trans('admin.recently_added_products')); ?></h3>
        <div class="box-tools pull-right">
          <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
      </div>
      <div class="box-body">
        <ul class="products-list product-list-in-box">
          <?php if(count($dashboard_data['latest_products'])>0): ?>
            <?php $__currentLoopData = $dashboard_data['latest_products']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vals): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
              <li class="item">
                <div class="product-img">
                  <?php if($vals['img_url']): ?>
                    <img src="<?php echo e(get_image_url($vals['img_url'])); ?>" alt="">
                  <?php else: ?>
                    <img src="<?php echo e(default_placeholder_img_src()); ?>" alt="">
                  <?php endif; ?>
                </div>
                <div class="products-info">
                  <a target="_blank" href="<?php echo e(route('details-page', $vals['id'] .'-'. string_slug_format(get_product_title($vals['id'])))); ?>" class="product-title"><?php echo $vals['title']; ?> <span class="label label-warning pull-right"><?php echo $vals['price']; ?></span></a>
                  <span class="product-description">
                    <?php echo string_decode($vals['description']); ?>

                  </span>
                </div>
              </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
          <?php else: ?>
            <li class="item"><?php echo e(trans('admin.no_recent_products_added')); ?></li>
          <?php endif; ?> 
        </ul>
      </div>
      <div class="box-footer clearfix">
        <a href="<?php echo e(route('admin.product_list')); ?>" class="btn btn-sm btn-default btn-flat pull-right"><?php echo e(trans('admin.view_all_products')); ?></a>
      </div>
    </div>
  </section>
  <section class="col-lg-5">
    <form  method="post" action="" enctype="multipart/form-data"> 
      <input type="hidden" name="_token" id="_token" value="<?php echo e(csrf_token()); ?>">
      <div class="box box-info">
        <div class="box-header">
          <i class="fa fa-envelope"></i>
          <h3 class="box-title"><?php echo e(trans('admin.quick_email')); ?></h3>
          <div class="pull-right box-tools">
            <button class="btn btn-default btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
          <?php echo $__env->make('pages-message.form-submit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
          <?php echo $__env->make('pages-message.notify-msg-success', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
          <div class="form-group">
              <input type="email" class="form-control" name="quickemailto" placeholder="<?php echo e(trans('admin.email_to')); ?>"/>
          </div>
          <div class="form-group">
              <input type="text" class="form-control" name="quickmailsubject" placeholder="<?php echo e(trans('admin.subject')); ?>"/>
          </div>
          <div>
            <textarea id="quickmailbody" name="quickmailbody" placeholder="<?php echo e(trans('admin.message')); ?>......." style="width: 100%; height: 125px;font-size: 14px;border: 1px solid #dddddd; padding: 10px;"></textarea>
          </div>
        </div>
        <div class="box-footer clearfix">
          <button class="pull-right btn btn-default" type="submit" id="sendQuickEmail" name="sendQuickEmail"><?php echo e(trans('admin.send')); ?> <i class="fa fa-arrow-circle-right"></i></button>
        </div>
      </div>
    </form>      
  </section>
</div>
<?php $__env->stopSection(); ?>