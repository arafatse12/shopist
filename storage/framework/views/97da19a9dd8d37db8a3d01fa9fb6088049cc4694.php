<?php $__env->startSection('subscription-settings-content'); ?>
<?php echo $__env->make('pages-message.notify-msg-success', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
  <input type="hidden" name="_token" id="_token" value="<?php echo e(csrf_token()); ?>">
  
  <div class="box box-info">
    <div class="box-header">
      <div class="pull-right">
        <button class="btn btn-block btn-primary" type="submit"><?php echo trans('admin.save'); ?></button>
      </div>
    </div>
  </div>
  
  <div class="row">
    <div class="col-md-12">
      <div class="box box-solid"> 
        <div class="box-body">
          <div class="form-group">
            <label class="col-sm-4 control-label" for="inputSubscribeEnableDisable"><?php echo e(trans('admin.enable_disable_subscribe_label')); ?></label>
            <div class="col-sm-8">
              <?php if($subscription_settings_data['subscription_visibility'] == true): ?>  
                <input type="checkbox" checked="checked" class="shopist-iCheck" name="subscriptions_visibility">
              <?php else: ?>
                <input type="checkbox" class="shopist-iCheck" name="subscriptions_visibility">
              <?php endif; ?>
            </div>
          </div>  
          <div class="form-group">
            <label class="col-sm-4 control-label" for="inputMode"><?php echo e(trans('admin.subscriptions_type')); ?></label>
            <div class="col-sm-8">
              <?php if($subscription_settings_data['subscribe_type'] == 'custom'): ?>  
                <div style="margin-bottom: 10px;"><input type="radio" checked="checked" class="shopist-iCheck" name="subscriptions_type" value="custom">&nbsp; <?php echo e(trans('admin.custom_subscriptions_label')); ?></div>
              <?php else: ?>
                <div style="margin-bottom: 10px;"><input type="radio" class="shopist-iCheck" name="subscriptions_type" value="custom">&nbsp; <?php echo e(trans('admin.custom_subscriptions_label')); ?></div>
              <?php endif; ?>
              
              <?php if($subscription_settings_data['subscribe_type'] == 'mailchimp'): ?>
                <div><input type="radio" checked="checked" class="shopist-iCheck" name="subscriptions_type" value="mailchimp">&nbsp; <?php echo e(trans('admin.mailchimp_subscriptions_label')); ?></div>
              <?php else: ?>
                <div><input type="radio" class="shopist-iCheck" name="subscriptions_type" value="mailchimp">&nbsp; <?php echo e(trans('admin.mailchimp_subscriptions_label')); ?></div>
              <?php endif; ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="inputOptions"><?php echo e(trans('admin.subscription_options_label')); ?></label>
            <div class="col-sm-8">
              <?php if($subscription_settings_data['subscribe_options'] == 'email'): ?>  
                <div style="margin-bottom: 10px;"><input type="radio" checked="checked" class="shopist-iCheck" name="subscribe_options" value="email">&nbsp; <?php echo e(trans('admin.subscribe_by_email_label')); ?></div>
              <?php else: ?>
                <div style="margin-bottom: 10px;"><input type="radio" class="shopist-iCheck" name="subscribe_options" value="email">&nbsp; <?php echo e(trans('admin.subscribe_by_email_label')); ?></div>
              <?php endif; ?>
              
              <?php if($subscription_settings_data['subscribe_options'] == 'name_email'): ?> 
                <div><input type="radio" class="shopist-iCheck" checked="checked" name="subscribe_options" value="name_email">&nbsp; <?php echo e(trans('admin.subscribe_by_name_and_email_label')); ?></div>
              <?php else: ?> 
                <div><input type="radio" class="shopist-iCheck" name="subscribe_options" value="name_email">&nbsp; <?php echo e(trans('admin.subscribe_by_name_and_email_label')); ?></div>
              <?php endif; ?>
            </div>
          </div>  
          <div class="form-group">
            <label class="col-sm-4 control-label" for="inputBGColor"><?php echo e(trans('admin.subscription_popupbg_color_label')); ?></label>
            <div class="col-sm-8">
              <input type="text" class="color form-control" id="subscriptions_popup_bg_color" name="subscriptions_popup_bg_color" value="<?php echo e($subscription_settings_data['popup_bg_color']); ?>"/>
            </div>
          </div>  
          <div class="form-group">
            <label class="col-sm-4 control-label" for="inputHTMLContent"><?php echo e(trans('admin.subscription_popup_content_label')); ?></label>
            <div class="col-sm-8">
              <textarea id="subscription_content_editor" name="subscription_content_editor" class="dynamic-editor"><?php echo string_decode($subscription_settings_data['popup_content']); ?></textarea>
            </div>
          </div> 
          <div class="form-group">
            <label class="col-sm-4 control-label" for="inputDisplay"><?php echo e(trans('admin.subscription_popup_display_at_label')); ?></label>
            <div class="col-sm-8">
              <?php if(count($subscription_settings_data['popup_display_page']) >0 && in_array('home', $subscription_settings_data['popup_display_page'])): ?>  
                <div style="margin-bottom: 10px;">
                  <input type="checkbox" checked="checked" class="shopist-iCheck" name="popup_display[]" value="home">&nbsp; <?php echo e(trans('admin.subscription_popup_display_at_home_label')); ?>

                </div>  
              <?php else: ?>
                <div style="margin-bottom: 10px;">
                  <input type="checkbox" class="shopist-iCheck" name="popup_display[]" value="home">&nbsp; <?php echo e(trans('admin.subscription_popup_display_at_home_label')); ?>

                </div>
              <?php endif; ?>
              
              <?php if(count($subscription_settings_data['popup_display_page']) >0 && in_array('shop', $subscription_settings_data['popup_display_page'])): ?>  
                <div style="margin-bottom: 10px;">
                  <input type="checkbox" checked="checked" class="shopist-iCheck" name="popup_display[]" value="shop">&nbsp; <?php echo e(trans('admin.subscription_popup_display_at_shop_label')); ?>

                </div> 
              <?php else: ?>
                <div style="margin-bottom: 10px;">
                  <input type="checkbox" class="shopist-iCheck" name="popup_display[]" value="shop">&nbsp; <?php echo e(trans('admin.subscription_popup_display_at_shop_label')); ?>

                </div>
              <?php endif; ?>
              
              <?php if(count($subscription_settings_data['popup_display_page']) >0 && in_array('blog', $subscription_settings_data['popup_display_page'])): ?>  
                <div style="margin-bottom: 10px;">
                  <input type="checkbox" checked="checked" class="shopist-iCheck" name="popup_display[]" value="blog">&nbsp; <?php echo e(trans('admin.subscription_popup_display_at_blog_label')); ?>

                </div>
              <?php else: ?>
                <div style="margin-bottom: 10px;">
                  <input type="checkbox" class="shopist-iCheck" name="popup_display[]" value="blog">&nbsp; <?php echo e(trans('admin.subscription_popup_display_at_blog_label')); ?>

                </div>
              <?php endif; ?>
              
              <?php if(count($subscription_settings_data['popup_display_page']) >0 && in_array('cart', $subscription_settings_data['popup_display_page'])): ?>  
                <div style="margin-bottom: 10px;">
                  <input type="checkbox" checked="checked" class="shopist-iCheck" name="popup_display[]" value="cart">&nbsp; <?php echo e(trans('admin.subscription_popup_display_at_cart_label')); ?>

                </div>   
              <?php else: ?>
                <div style="margin-bottom: 10px;">
                  <input type="checkbox" class="shopist-iCheck" name="popup_display[]" value="cart">&nbsp; <?php echo e(trans('admin.subscription_popup_display_at_cart_label')); ?>

                </div>   
              <?php endif; ?>
            </div>
          </div>  
          <div class="form-group">
            <label class="col-sm-4 control-label" for="inputBtnLabel"><?php echo e(trans('admin.subscribe_btn_label')); ?></label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="subscribe_btn_text" id="subscribe_btn_text" value="<?php echo e($subscription_settings_data['subscribe_btn_text']); ?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="inputCookieSet"><?php echo e(trans('admin.subscribe_cookie_set_label')); ?></label>
            <div class="col-sm-8">
              <?php if($subscription_settings_data['subscribe_popup_cookie_set_visibility'] == true): ?>
                <input type="checkbox" class="shopist-iCheck" checked="checked" name="subscribe_popup_cookie_set" id="subscribe_popup_cookie_set">
              <?php else: ?>
                <input type="checkbox" class="shopist-iCheck" name="subscribe_popup_cookie_set" id="subscribe_popup_cookie_set">
              <?php endif; ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="inputCookieSetText"><?php echo e(trans('admin.subscribe_cookie_set_text')); ?></label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="subscribe_popup_cookie_set_text" id="subscribe_popup_cookie_set_text" value="<?php echo e($subscription_settings_data['subscribe_popup_cookie_set_text']); ?>">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>  
<?php $__env->stopSection(); ?>