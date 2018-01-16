<div id="single_product">
  <div class="container">
      <div class="visible-xs visible-sm"><h1 class="product-title"><?php echo e($single_product_details['post_title']); ?></h1><hr></div>  
    <?php if(!empty($single_product_details['_product_related_images_url']->shop_banner_image)): ?>  
    <div class="row extra-margin-bottom">
      <div class="col-xs-12 col-sm-12 col-md-12">
        <img src="<?php echo e(get_image_url($single_product_details['_product_related_images_url']->shop_banner_image)); ?>" alt="" class="img-responsive" />
      </div>
    </div> 
    <?php endif; ?>
    
    <div class="row">
      <div class="col-xs-12 col-sm-5 col-md-5">
        <div class="product-main-content">
          <div class="product-main-image">
            <?php if( !empty($single_product_details['_product_related_images_url']->product_image) && basename($single_product_details['_product_related_images_url']->product_image) != 'no-image.png'): ?>
              <img src="<?php echo e(get_image_url($single_product_details['_product_related_images_url']->product_image)); ?>" id="product_image_zoom" data-zoom-image="<?php echo e(get_image_url($product_zoom_image)); ?>" alt="<?php echo e(basename($single_product_details['_product_related_images_url']->product_image)); ?>" class="img-responsive"/>
            <?php endif; ?>
            <div class="zoom-icon"></div>
          </div>
        
          <?php if(count($single_product_details['_product_related_images_url']->product_gallery_images) > 0): ?>
          <?php $count = 1;?>

          <div id="product_gallery_image" class="product-gallery-image">
            <?php $__currentLoopData = $single_product_details['_product_related_images_url']->product_gallery_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>

              <?php if($count == 1): ?>
              <a  href="#" class="elevatezoom-gallery active" data-image="<?php echo e(get_image_url($row->url)); ?>" data-zoom-image="<?php echo e(get_image_url($row->zoom_img_url)); ?>"><img src="<?php echo e(get_image_url($row->url)); ?>" width="100"  /></a>
              <?php else: ?>
              <a  href="#" class="elevatezoom-gallery" data-image="<?php echo e(get_image_url($row->url)); ?>" data-zoom-image="<?php echo e(get_image_url($row->zoom_img_url)); ?>"><img src="<?php echo e(get_image_url($row->url)); ?>" width="100"  /></a>
              <?php endif; ?>

              <?php $count ++;?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
          </div>
          <?php endif; ?>
        </div> 
          
        <div class="selected-variation-product">
          <img src=""  class="img-responsive"/>
        </div> 
          
        <?php if($single_product_details['_product_enable_video_feature'] == 'yes'): ?>
        <br>
          <?php if($single_product_details['_product_video_feature_display_mode'] == 'popup'): ?>
            <div class="product-video-content">
              <button class="btn btn-default product-video" type="button">
                <i class="fa fa-video-camera"></i>
                <?php echo e(trans('frontend.product_video')); ?>

              </button>
              <?php echo $__env->make('modal.product-video', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>  
            </div>
          <?php elseif($single_product_details['_product_video_feature_display_mode'] == 'content'): ?>
            <h4> <?php echo $single_product_details['_product_video_feature_title']; ?> </h4>
            <div class="product-video-content-panel">
              <?php if($single_product_details['_product_video_feature_source'] == 'embedded_code'): ?>
                <?php echo $__env->make('pages.frontend.frontend-pages.video-source-embedded-url', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php echo $__env->yieldContent('embedded-content'); ?>
              <?php elseif($single_product_details['_product_video_feature_source'] == 'online_url'): ?>
                <?php echo $__env->make('pages.frontend.frontend-pages.video-source-online-url', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php echo $__env->yieldContent('online-url-content'); ?>
              <?php endif; ?>
            </div>  
          <?php endif; ?>
        <?php endif; ?>
        
      </div>
      <div class="col-xs-12 col-sm-7 col-md-7">
        <h1 class="product-title visible-md visible-lg"><?php echo e($single_product_details['post_title']); ?></h1>
        <?php $reviews_settings = get_reviews_settings_data($single_product_details['id']);?>
        <?php if($reviews_settings['enable_reviews_add_link_to_details_page'] && $reviews_settings['enable_reviews_add_link_to_details_page'] == 'yes'): ?>
          <div class="comments-advices">
            <ul>
              <li class="review-stars"><div class="star-rating"><span style="width:<?php echo e($comments_rating_details['percentage']); ?>%"></span></div></li>
              <li class="read-review"><a href="#product_description_bottom_tab" class="reviews selected"> <?php echo e(trans('frontend.single_product_read_review_label')); ?> (<span itemprop="reviewCount"><?php echo e($comments_rating_details['total']); ?></span>) </a></li>
              <li class="write-review"><a class="open-comment-form" href="#new_comment_form">&nbsp;<span>|</span>&nbsp; <?php echo e(trans('frontend.single_product_write_review_label')); ?> </a></li>
            </ul>
          </div>
        <?php endif; ?>
        
        <div class="product-pricing">
          <?php if( get_product_type($single_product_details['id']) == 'simple_product' || (get_product_type($single_product_details['id']) == 'downloadable_product' && count(get_product_variations($single_product_details['id'])) == 0 ) || (get_product_type($single_product_details['id']) == 'customizable_product' && count(get_product_variations($single_product_details['id'])) == 0 ) ): ?>
            <?php if(!is_null($single_product_details['offer_price'])): ?>
            <span class="offer-price"><?php echo price_html( $single_product_details['offer_price'] ); ?></span>
            <?php endif; ?>
            
            <span class="solid-price"><?php echo price_html( $single_product_details['solid_price'] ); ?></span>

            <?php if($single_product_details['_product_regular_price'] && $single_product_details['_product_sale_price'] && $single_product_details['_product_regular_price'] > $single_product_details['_product_sale_price'] && $single_product_details['_product_sale_price_start_date'] && $single_product_details['_product_sale_price_end_date'] && $single_product_details['_product_sale_price_end_date'] >= date("Y-m-d")): ?>
            <p class="offer-message-label"><i class="fa fa-bell" aria-hidden="true"></i> <?php echo e(trans('frontend.offer_msg')); ?>  <i><?php echo date("F j, Y", strtotime($single_product_details['_product_sale_price_start_date'])); ?> <?php echo e(trans('frontend.to')); ?> <?php echo date("F j, Y", strtotime($single_product_details['_product_sale_price_end_date'])); ?> </i></p>
            <?php endif; ?>
            
          <?php elseif( (get_product_type($single_product_details['id']) == 'configurable_product' || get_product_type($single_product_details['id']) == 'customizable_product' || get_product_type($single_product_details['id']) == 'downloadable_product') && count(get_product_variations($single_product_details['id'])) > 0 ): ?>
            <span class="solid-price"><?php echo get_product_variations_min_to_max_price_html($currency_symbol, $single_product_details['id']); ?> </span>
          <?php endif; ?>
        </div>
        
        <?php if(( get_product_type($single_product_details['id']) == 'simple_product' || ( ( get_product_type($single_product_details['id']) == 'customizable_product' || get_product_type($single_product_details['id']) == 'downloadable_product' ) && count(get_product_variations($single_product_details['id'])) == 0) )): ?>
          <?php if( $single_product_details['_product_manage_stock_availability'] == 'in_stock' || ($single_product_details['_product_manage_stock'] == 'yes' && $single_product_details['_product_manage_stock_back_to_order'] == 'only_allow' && $single_product_details['_product_manage_stock_availability'] == 'in_stock') || ($single_product_details['_product_manage_stock'] == 'yes' && $single_product_details['_product_manage_stock_back_to_order'] == 'allow_notify_customer' && $single_product_details['_product_manage_stock_availability'] == 'in_stock') ): ?>
            <p class="availability-status"><span><?php echo e(trans('frontend.single_product_availability_label')); ?>: </span> <span class="in-stock"><?php echo e(trans('frontend.single_product_availability_status_instock_label')); ?></span></p>
          <?php else: ?>
            <p class="availability-status"><span><?php echo e(trans('frontend.single_product_availability_label')); ?>: </span> <span class="in-stock"><?php echo e(trans('frontend.single_product_availability_status_outstock_label')); ?></span></p>
            <button class="btn btn-default request-product" type="button"><?php echo e(trans('frontend.request_product')); ?></button>
            <?php echo $__env->make('modal.request-products', array('product_id' => $single_product_details['id']), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
          <?php endif; ?>
          
          <?php if( ($single_product_details['_product_manage_stock'] == 'yes' && $single_product_details['_product_manage_stock_back_to_order'] == 'only_allow' && $single_product_details['_product_manage_stock_availability'] == 'in_stock') || ($single_product_details['_product_manage_stock'] == 'yes' && $single_product_details['_product_manage_stock_back_to_order'] == 'allow_notify_customer' && $single_product_details['_product_manage_stock_availability'] == 'in_stock') ): ?>
            <p class="availability-status"><span><?php echo e(trans('frontend.single_product_available_stock_label')); ?>: </span> <span class="stock-amount"><?php echo e($single_product_details['_product_manage_stock_qty']); ?></span></p>
          <?php endif; ?>
          
          <?php if($single_product_details['_product_manage_stock'] == 'yes' && $single_product_details['_product_manage_stock_back_to_order'] == 'allow_notify_customer' && $single_product_details['_product_manage_stock_availability'] == 'in_stock'): ?>
            <p class="stock-notify-msg"><i class="fa fa-bell" aria-hidden="true"></i> <?php echo e(trans('frontend.product_available_msg')); ?></p>
          <?php endif; ?>
        <?php endif; ?>
        <hr>
        
        <?php if($single_product_details['post_content']): ?>
        <div class="product-description">
        <?php echo string_decode($single_product_details['post_content']); ?>

        </div><hr>
        <?php endif; ?>
        
        <?php if( (get_product_type($single_product_details['id']) == 'configurable_product' || get_product_type($single_product_details['id']) == 'downloadable_product')): ?>
          <?php if(count($attr_lists) >0 && count(get_product_variations_with_data($single_product_details['id']))>0): ?>
            <?php echo $__env->make('includes.frontend.variations-html', array('attr_lists' => $attr_lists, 'single_product_details' => $single_product_details), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
          <?php endif; ?>
        <?php endif; ?>
        
        <?php if(( get_product_type($single_product_details['id']) == 'simple_product' || ( get_product_type($single_product_details['id']) == 'downloadable_product' && count(get_product_variations($single_product_details['id'])) == 0 )) && ($single_product_details['_product_manage_stock_availability'] == 'in_stock' || ($single_product_details['_product_manage_stock'] == 'yes' && $single_product_details['_product_manage_stock_back_to_order'] == 'only_allow' && $single_product_details['_product_manage_stock_availability'] == 'in_stock') || ($single_product_details['_product_manage_stock'] == 'yes' && $single_product_details['_product_manage_stock_back_to_order'] == 'allow_notify_customer' && $single_product_details['_product_manage_stock_availability'] == 'in_stock'))): ?>
        <div class="product-add-to-cart-content add-to-cart-content">
          <ul>
            <li>
              <div class="input-group">
                  <span class="input-group-btn">
                    <button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">
                      <span class="fa fa-minus"></span>
                    </button>
                  </span>
                  <input type="text" id="quantity" name="quant[1]" class="form-control input-number" value="1" min="1" max="10"/>
                  <span class="input-group-btn">
                    <button type="button" class="btn btn-default btn-number" data-type="plus" data-field="quant[1]">
                      <span class="fa fa-plus"></span>
                    </button>
                  </span>
              </div>
            </li>
            <li>
              <a href="" class="btn btn-sm btn-style add-to-cart-bg" data-id="<?php echo e($single_product_details['id']); ?>"><i class="fa fa-shopping-cart"></i>&nbsp;&nbsp; <?php echo e(trans('frontend.add_to_cart')); ?></a>
            </li>
          </ul>
          <br>  
          <ul>
            <li>
              <a href="" class="btn btn-sm btn-style product-wishlist" data-id="<?php echo e($single_product_details['id']); ?>" data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('frontend.add_to_wishlist_label')); ?>"><i class="fa fa-heart"></i></a>
            </li>
            <li>
              <a href="" class="btn btn-sm btn-style product-compare" data-id="<?php echo e($single_product_details['id']); ?>" data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('frontend.add_to_compare_list_label')); ?>"><i class="fa fa-exchange"></i></a>
            </li>
          </ul>  
        </div>
        <?php endif; ?>
        
        <?php if(get_product_type($single_product_details['id']) == 'customizable_product'): ?>
        <a href="<?php echo e(route('customize-page', $single_product_details['post_slug'])); ?>" class="btn btn-sm btn-style product-customize-bg"><i class="fa fa-gears"></i> <?php echo trans('frontend.customize_it'); ?></a>
        <?php endif; ?>
        
        <div class="product-extra-data">
          <?php if($single_product_details['_product_sku']): ?>  
            <p><label><?php echo e(trans('frontend.sku')); ?>:</label><span><?php echo e($single_product_details['_product_sku']); ?></span></p>
          <?php endif; ?>
          
          <?php if($single_product_details['_product_enable_as_latest'] == 'yes'): ?>
            <p><label><?php echo e(trans('frontend.condition_label')); ?>:</label><span><?php echo e(trans('frontend.new_label')); ?></span></p>
          <?php endif; ?>
          
          <?php if(count(get_product_brands_lists($single_product_details['id'])) > 0): ?>
            <p><label><?php echo e(trans('frontend.brand_label')); ?>:</label><span><?php echo e(get_single_page_product_brands_lists( get_product_brands_lists($single_product_details['id']) )); ?></span></p>
          <?php endif; ?>
          
          <?php if(get_single_page_product_categories_lists($single_product_details['id'])): ?>
            <p><label><?php echo e(trans('frontend.category_label')); ?>:</label><span><?php echo e(get_single_page_product_categories_lists($single_product_details['id'])); ?></span></p>
          <?php endif; ?>
          
          <?php if(count(get_product_tags_lists($single_product_details['id']))>0): ?>
            <p><label><?php echo e(trans('frontend.tag_label')); ?>:</label><span><?php echo e(get_single_page_product_tags_lists(get_product_tags_lists($single_product_details['id']))); ?></span></p>
          <?php endif; ?>
        </div>

        <div class="product-share-content">
          <ul>
            <li><a class="facebook btn btn-default btn-sm" data-name="fb" href="#" data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('frontend.share_with_fb_label')); ?>"><i class="fa fa-facebook"></i> <?php echo trans('frontend.share_label'); ?></a></li>
            <li><a class="twitter btn btn-default btn-sm" data-name="tweet" href="#" data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('frontend.share_with_twitter_label')); ?>"><i class="fa fa-twitter"></i> <?php echo trans('frontend.tweet_label'); ?></a></li>
            <li><a class="google-plus btn btn-default btn-sm" data-name="gplus" href="#" data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('frontend.share_with_google_plus_label')); ?>"><i class="fa fa-google-plus"></i> <?php echo trans('frontend.share_label'); ?></a></li>
            <li><a class="linkedin btn btn-default btn-sm" data-name="lin" href="#" data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('frontend.share_with_linkedin_label')); ?>"><i class="fa fa-linkedin"></i> <?php echo trans('frontend.share_label'); ?></a></li>
						<li><a class="pinterest btn btn-default btn-sm" data-name="pi" href="#" data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('frontend.share_with_pin_it_label')); ?>"><i class="fa fa-pinterest"></i> <?php echo trans('frontend.share_pin_it_label'); ?></a></li>
						<li><a class="print btn btn-default btn-sm" data-name="print" href="#" data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('frontend.print_label')); ?>"><i class="fa fa-print"></i> <?php echo trans('frontend.print_label'); ?></a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="row">
        <div id="product_description_bottom_tab" class="product-description-bottom-tab">
          <ul class="nav nav-tabs">
            <?php if(!old('comments_target')): ?>
            <li class="active"><a href="#features" data-toggle="tab"><?php echo e(trans('frontend.features_label')); ?></a></li>
            <?php else: ?>
            <li><a href="#features" data-toggle="tab"><?php echo e(trans('frontend.features_label')); ?></a></li>
            <?php endif; ?>
            <li><a href="#shippingInfo" data-toggle="tab"><?php echo e(trans('frontend.shipping_info_label')); ?></a></li>
            
            <?php if($single_product_details['_product_enable_reviews'] == 'yes'): ?>
              <?php if(old('comments_target')): ?>
              <li class="active"><a href="#reviews" data-toggle="tab"><?php echo e(trans('frontend.reviews_label')); ?> (5)</a></li>
              <?php else: ?>
              <li><a href="#reviews" data-toggle="tab"><?php echo e(trans('frontend.reviews_label')); ?> (<?php echo $comments_rating_details['total']; ?>)</a></li>
              <?php endif; ?>
            <?php endif; ?>
          </ul>
          <div class="tab-content">
            <?php if(!old('comments_target')): ?>
            <div class="tab-pane fade active in" id="features" >
            <?php else: ?>
            <div class="tab-pane fade" id="features" >
            <?php endif; ?>
              <?php if($single_product_details['_product_extra_features']): ?>  
                <?php echo string_decode($single_product_details['_product_extra_features']); ?>

              <?php else: ?>
                <?php echo trans('frontend.no_features_label'); ?>

              <?php endif; ?>
            </div>
            
            <div class="tab-pane fade" id="shippingInfo" >
              <?php echo e(trans('frontend.no_shippingInfo_label')); ?>

            </div>
          
            <?php if($single_product_details['_product_enable_reviews'] == 'yes'): ?>
              <?php if(old('comments_target')): ?>
               <div class="tab-pane fade active in" id="reviews">
              <?php else: ?>
               <div class="tab-pane fade" id="reviews">
              <?php endif; ?>

              <div class="product-reviews-content">
                  <div class="rating-box clearfix">
                      <div class="score-box">
                        <div class="score"><?php echo e($comments_rating_details['average']); ?></div>
                        <div class="star-rating"><span style="width:<?php echo e($comments_rating_details['percentage']); ?>%"></span></div>
                        <div class="total-users"><i class="fa fa-user"></i>&nbsp;<span class="total"><?php echo e($comments_rating_details['total']); ?></span>&nbsp;<?php echo e(trans('frontend.totals_label')); ?></div>
                      </div>
                      <div class="individual-score-graph">
                        <ul>
                          <li>
                            <div class="rating-progress-content clearfix">
                              <div class="individual-rating-score">
                                <span><i class="fa fa-star"></i> 5</span>
                              </div>
                              <div class="individual-rating-progress">
                                <div class="progress">
                                  <div class="progress-bar progress-bar-five" role="progressbar" aria-valuenow="<?php echo e($comments_rating_details[5]); ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo e($comments_rating_details[5]); ?>%">
                                  <?php echo $comments_rating_details[5]; ?>%
                                  </div>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li>
                              <div class="rating-progress-content clearfix">
                                  <div class="individual-rating-score">
                                      <span><i class="fa fa-star"></i> 4</span>
                                  </div>
                                  <div class="individual-rating-progress">
                                      <div class="progress">
                                        <div class="progress-bar progress-bar-four" role="progressbar" aria-valuenow="<?php echo e($comments_rating_details[4]); ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo e($comments_rating_details[4]); ?>%">
                                        <?php echo $comments_rating_details[4]; ?>%
                                        </div>
                                      </div>
                                  </div>
                              </div>
                          </li>
                          <li>
                              <div class="rating-progress-content clearfix">
                                  <div class="individual-rating-score">
                                      <span><i class="fa fa-star"></i> 3</span>
                                  </div>
                                  <div class="individual-rating-progress">
                                      <div class="progress">
                                        <div class="progress-bar progress-bar-three" role="progressbar" aria-valuenow="<?php echo e($comments_rating_details[3]); ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo e($comments_rating_details[3]); ?>%">
                                        <?php echo $comments_rating_details[3]; ?>%
                                        </div>
                                      </div>
                                  </div>
                              </div>
                          </li>
                          <li>
                              <div class="rating-progress-content clearfix">
                                  <div class="individual-rating-score">
                                      <span><i class="fa fa-star"></i> 2</span>
                                  </div>
                                  <div class="individual-rating-progress">
                                      <div class="progress">
                                        <div class="progress-bar progress-bar-two" role="progressbar" aria-valuenow="<?php echo e($comments_rating_details[2]); ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo e($comments_rating_details[2]); ?>%">
                                        <?php echo $comments_rating_details[2]; ?>%
                                        </div>
                                      </div>
                                  </div>
                              </div>
                          </li>
                          <li>
                              <div class="rating-progress-content clearfix">
                                  <div class="individual-rating-score">
                                      <span><i class="fa fa-star"></i> 1</span>
                                  </div>
                                  <div class="individual-rating-progress">
                                      <div class="progress">
                                        <div class="progress-bar progress-bar-one" role="progressbar" aria-valuenow="<?php echo e($comments_rating_details[1]); ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo e($comments_rating_details[1]); ?>%">
                                        <?php echo $comments_rating_details[1]; ?>%
                                        </div>
                                      </div>
                                  </div>
                              </div>
                          </li>
                        </ul>
                      </div>
                  </div>
                  <div class="user-reviews-content">
                        <h2 class="user-reviews-title"><?php echo e($comments_rating_details['total']); ?> <?php echo e(trans('frontend.reviews_for_label')); ?> <span><?php echo e($single_product_details['post_title']); ?></span></h2>
                        <?php if(count($comments_details) > 0): ?>
                        <ol class="commentlist">
                           <?php $__currentLoopData = $comments_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?> 
                            <li class="comment">
                              <div class="comment-container clearfix">
                                <div class="user-img">
                                  <?php if(!empty($comment->user_photo_url)): ?>
                                  <img alt="" src="<?php echo e(get_image_url( $comment->user_photo_url )); ?>" class="avatar photo" width="60" height="60">
                                  <?php else: ?>
                                  <img alt="" src="<?php echo e(default_avatar_img_src()); ?>" class="avatar photo" width="60" height="60">
                                  <?php endif; ?>
                                </div>
                                <div class="comment-text">
                                  <div class="star-rating">
                                    <span style="width:<?php echo e($comment->percentage); ?>%"><strong itemprop="ratingValue"></strong></span>
                                  </div>
                                  <p class="meta">
                                    <span class="comment-date"><?php echo e(Carbon\Carbon::parse(  $comment->created_at )->format('F d, Y')); ?></span> &nbsp; - <span class="comment-user-role"><strong ><?php echo e(trans('frontend.by_label')); ?> <?php echo e($comment->display_name); ?></strong></span>
                                  </p><hr>
                                  <div class="description">
                                    <p><?php echo e($comment->content); ?></p>
                                  </div>
                                </div>
                              </div>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                        </ol>
                        <?php else: ?>
                        <p><?php echo e(trans('frontend.no_review_label')); ?></p>
                        <?php endif; ?>
                  </div>
                  
                  <br>

                  <?php echo $__env->make('pages-message.notify-msg-success', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                  <?php echo $__env->make('pages-message.notify-msg-error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                  <?php echo $__env->make('pages-message.form-submit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                  <form id="new_comment_form" method="post" action="" enctype="multipart/form-data">
                    <input type="hidden" name="_token" id="_token" value="<?php echo e(csrf_token()); ?>">
                    <input type="hidden" name="comments_target" id="comments_target" value="product">
                    <input type="hidden" name="selected_rating_value" id="selected_rating_value" value="">
                    <input type="hidden" name="object_id" id="object_id" value="<?php echo e($single_product_details['id']); ?>">

                    <div class="add-user-review">
                      <h2 class="add-reviews-title"><?php echo e(trans('frontend.add_a_review_label')); ?></h2>
                      <hr>
                      <h2 class="rating-title"><?php echo e(trans('frontend.select_your_rating_label')); ?></h2>
                      <div class="rating-select">
                        <div class="btn btn-default btn-sm" data-rating_value="1"><span class="glyphicon glyphicon-star-empty"></span></div>
                        <div class="btn btn-default btn-sm" data-rating_value="2"><span class="glyphicon glyphicon-star-empty"></span></div>
                        <div class="btn btn-default btn-sm" data-rating_value="3"><span class="glyphicon glyphicon-star-empty"></span></div>
                        <div class="btn btn-default btn-sm" data-rating_value="4"><span class="glyphicon glyphicon-star-empty"></span></div>
                        <div class="btn btn-default btn-sm" data-rating_value="5"><span class="glyphicon glyphicon-star-empty"></span></div>
                      </div>
                      <br>
                      <div class="review-content">
                        <fieldset>
                          <legend><?php echo e(trans('frontend.write_your_review_label')); ?></legend>
                          <p><textarea name="product_review_content" id="product_review_content"></textarea></p>
                        </fieldset>
                      </div>
                      <br>
                      <div class="review-submit">
                        <input name="review_submit" id="review_submit" class="btn btn-sm btn-style" value="<?php echo e(trans('frontend.submit_label')); ?>" type="submit">
                      </div>
                    </div>
                  </form>
              </div>
            </div>
          </div>
          <?php endif; ?>  
        </div>
    </div>  
            
    <?php if(count($related_items) > 0): ?>    
    <div class="row">
      <div id="related_products">
        <div class="content-title">
          <h2 class="text-center title-under"><?php echo e(trans('frontend.related_products_label')); ?></h2>
        </div>
        
        <div class="related-products-content">
          <?php $__currentLoopData = $related_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $products): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
            <?php 
            $reviews          = get_comments_rating_details($products['id'], 'product');
            $reviews_settings = get_reviews_settings_data($products['id']);      
            ?>
            <div class="col-xs-12 col-sm-3 col-md-3 extra-padding grid-view">
              <div class="hover-product">
                <div class="hover">
                  <?php if($products['_product_related_images_url']->product_image): ?>
                  <img class="img-responsive" src="<?php echo e(get_image_url($products['_product_related_images_url']->product_image)); ?>" alt="<?php echo e(basename($products['_product_related_images_url']->product_image)); ?>" />
                  <?php else: ?>
                  <img class="img-responsive" src="<?php echo e(default_placeholder_img_src()); ?>" alt="" />
                  <?php endif; ?>

                  <div class="overlay">
                    <button class="info quick-view-popup" data-id="<?php echo e($products['id']); ?>"><?php echo e(trans('frontend.quick_view_label')); ?></button>
                  </div>
                </div> 

                <div class="single-product-bottom-section">
                  <h3><?php echo get_product_title($products['id']); ?></h3>

                  <?php if(get_product_type($products['id']) == 'simple_product'): ?>
                    <p><?php echo price_html( get_product_price($products['id']), get_frontend_selected_currency() ); ?></p>
                  <?php elseif(get_product_type($products['id']) == 'configurable_product'): ?>
                    <p><?php echo get_product_variations_min_to_max_price_html(get_frontend_selected_currency(), $products['id']); ?></p>
                  <?php elseif(get_product_type($products['id']) == 'customizable_product' || get_product_type($products['id']) == 'downloadable_product'): ?>
                    <?php if(count(get_product_variations($products['id']))>0): ?>
                      <p><?php echo get_product_variations_min_to_max_price_html(get_frontend_selected_currency(), $products['id']); ?></p>
                    <?php else: ?>
                      <p><?php echo price_html( get_product_price($products['id']), get_frontend_selected_currency() ); ?></p>
                    <?php endif; ?>
                  <?php endif; ?>

                  <?php if($reviews_settings['enable_reviews_add_link_to_product_page'] && $reviews_settings['enable_reviews_add_link_to_product_page'] == 'yes'): ?>
                    <div class="text-center">
                      <div class="star-rating">
                        <span style="width:<?php echo e($reviews['percentage']); ?>%"></span>
                      </div>

                      <div class="comments-advices">
                        <ul>
                          <li class="read-review"><a href="<?php echo e(route('details-page', $products['post_slug'])); ?>#product_description_bottom_tab" class="reviews selected"> <?php echo e(trans('frontend.single_product_read_review_label')); ?> (<span itemprop="reviewCount"><?php echo $reviews['total']; ?></span>) </a></li>
                          <li class="write-review"><a class="open-comment-form" href="<?php echo e(route('details-page', $products['post_slug'])); ?>#new_comment_form">&nbsp;<span>|</span>&nbsp; <?php echo e(trans('frontend.single_product_write_review_label')); ?> </a></li>
                        </ul>
                      </div>
                    </div>
                  <?php endif; ?>

                  <div class="title-divider"></div>
                  <div class="single-product-add-to-cart">
                    <?php if(get_product_type($products['id']) == 'simple_product'): ?>
                      <a href="" data-id="<?php echo e($products['id']); ?>" class="btn btn-sm btn-style add-to-cart-bg" data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('frontend.add_to_cart_label')); ?>"><i class="fa fa-shopping-cart"></i></a>
                      <a href="" class="btn btn-sm btn-style product-wishlist" data-id="<?php echo e($products['id']); ?>" data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('frontend.add_to_wishlist_label')); ?>"><i class="fa fa-heart"></i></a>
                      <a href="" class="btn btn-sm btn-style product-compare" data-id="<?php echo e($products['id']); ?>" data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('frontend.add_to_compare_list_label')); ?>"><i class="fa fa-exchange"></i></a>
                      <a href="<?php echo e(route('details-page', $products['post_slug'])); ?>" class="btn btn-sm btn-style product-details-view" data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('frontend.product_details_label')); ?>"><i class="fa fa-eye"></i></a>

                    <?php elseif(get_product_type($products['id']) == 'configurable_product'): ?>
                      <a href="<?php echo e(route('details-page', $products['post_slug'])); ?>" class="btn btn-sm btn-style select-options-bg" data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('frontend.select_options')); ?>"><i class="fa fa-hand-o-up"></i></a>
                      <a href="" class="btn btn-sm btn-style product-wishlist" data-id="<?php echo e($products['id']); ?>" data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('frontend.add_to_wishlist_label')); ?>"><i class="fa fa-heart"></i></a>
                      <a href="" class="btn btn-sm btn-style product-compare" data-id="<?php echo e($products['id']); ?>" data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('frontend.add_to_compare_list_label')); ?>"><i class="fa fa-exchange"></i></a>
                      <a href="<?php echo e(route('details-page', $products['post_slug'])); ?>" class="btn btn-sm btn-style product-details-view" data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('frontend.product_details_label')); ?>"><i class="fa fa-eye"></i></a>

                    <?php elseif(get_product_type($products['id']) == 'customizable_product'): ?>
                      <?php if(is_design_enable_for_this_product($products['id'])): ?>
                        <a href="<?php echo e(route('customize-page', $products['post_slug'])); ?>" class="btn btn-sm btn-style product-customize-bg" data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('frontend.select_options')); ?>"><i class="fa fa-gears"></i></a>
                        <a href="" class="btn btn-sm btn-style product-wishlist" data-id="<?php echo e($products['id']); ?>" data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('frontend.add_to_wishlist_label')); ?>"><i class="fa fa-heart"></i></a>
                        <a href="" class="btn btn-sm btn-style product-compare" data-id="<?php echo e($products['id']); ?>" data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('frontend.add_to_compare_list_label')); ?>"><i class="fa fa-exchange"></i></a>
                        <a href="<?php echo e(route('details-page', $products['post_slug'])); ?>" class="btn btn-sm btn-style product-details-view" data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('frontend.product_details_label')); ?>"><i class="fa fa-eye"></i></a>

                      <?php else: ?>
                        <a href="" data-id="<?php echo e($products['id']); ?>" class="btn btn-sm btn-style add-to-cart-bg" data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('frontend.add_to_cart_label')); ?>"><i class="fa fa-shopping-cart"></i></a>
                        <a href="" class="btn btn-sm btn-style product-wishlist" data-id="<?php echo e($products['id']); ?>" data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('frontend.add_to_wishlist_label')); ?>"><i class="fa fa-heart"></i></a>
                        <a href="" class="btn btn-sm btn-style product-compare" data-id="<?php echo e($products['id']); ?>" data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('frontend.add_to_compare_list_label')); ?>"><i class="fa fa-exchange"></i></a>
                        <a href="<?php echo e(route('details-page', $products['post_slug'])); ?>" class="btn btn-sm btn-style product-details-view" data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('frontend.product_details_label')); ?>"><i class="fa fa-eye"></i></a>
                      <?php endif; ?>
                    <?php elseif(get_product_type( $products['id'] ) == 'downloadable_product'): ?> 
                      <?php if(count(get_product_variations( $products['id'] ))>0): ?>
                      <a href="<?php echo e(route( 'details-page', $products['post_slug'] )); ?>" class="btn btn-sm btn-style select-options-bg" data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('frontend.select_options')); ?>"><i class="fa fa-hand-o-up"></i></a>
                      <a href="" class="btn btn-sm btn-style product-wishlist" data-id="<?php echo e($products['id']); ?>" data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('frontend.add_to_wishlist_label')); ?>"><i class="fa fa-heart"></i></a>
                      <a href="" class="btn btn-sm btn-style product-compare" data-id="<?php echo e($products['id']); ?>" data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('frontend.add_to_compare_list_label')); ?>"><i class="fa fa-exchange" ></i></a>
                      <a href="<?php echo e(route('details-page', $products['post_slug'] )); ?>" class="btn btn-sm btn-style product-details-view" data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('frontend.product_details_label')); ?>"><i class="fa fa-eye"></i></a>
                      <?php else: ?>
                      <a href="" data-id="<?php echo e($products['id']); ?>" class="btn btn-sm btn-style add-to-cart-bg" data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('frontend.add_to_cart_label')); ?>"><i class="fa fa-shopping-cart"></i></a>
                      <a href="" class="btn btn-sm btn-style product-wishlist" data-id="<?php echo e($products['id']); ?>" data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('frontend.add_to_wishlist_label')); ?>"><i class="fa fa-heart"></i></a>
                      <a href="" class="btn btn-sm btn-style product-compare" data-id="<?php echo e($products['id']); ?>" data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('frontend.add_to_compare_list_label')); ?>"><i class="fa fa-exchange" ></i></a>
                      <a href="<?php echo e(route('details-page', $products['post_slug'] )); ?>" class="btn btn-sm btn-style product-details-view" data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('frontend.product_details_label')); ?>"><i class="fa fa-eye"></i></a>
                      <?php endif; ?>                         
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
        </div>      
      </div>
    </div>
    <?php endif; ?>
    
    <?php if(count($upsell_products) > 0): ?>
    <br>
    <div class="row upsell-products-content">
      <div class="col-md-12">
        <h3><?php echo trans('frontend.upsell_title_label'); ?></h3><br>  
        <div class="upsell-products">
          <?php $__currentLoopData = $upsell_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $products): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
          <div class="col-xs-12 col-sm-4 col-md-3">
            <div class="upsell-img"><img src="<?php echo e(get_image_url(get_product_image( $products ))); ?>" alt="<?php echo e(basename( get_product_image( $products ) )); ?>"></div>
            <div class="upsell-products-info">
              <a href="<?php echo e(route('details-page', get_product_slug($products) )); ?>"><span><?php echo get_product_title( $products ); ?></span></a><br>
              <span>
                <?php if(get_product_type( $products ) == 'simple_product'): ?>
                  <?php echo price_html( get_product_price( $products ), get_frontend_selected_currency() ); ?>

                <?php elseif(get_product_type( $products ) == 'configurable_product'): ?>
                  <?php echo get_product_variations_min_to_max_price_html(get_frontend_selected_currency(), $products); ?>

                <?php elseif(get_product_type( $products ) == 'customizable_product' || get_product_type( $products ) == 'downloadable_product'): ?>
                  <?php if(count(get_product_variations( $products ))>0): ?>
                    <?php echo get_product_variations_min_to_max_price_html(get_frontend_selected_currency(), $products); ?>

                  <?php else: ?>
                    <?php echo price_html( get_product_price( $products ), get_frontend_selected_currency() ); ?>

                  <?php endif; ?>
                <?php endif; ?>
              </span>
            </div>
          </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
        </div>
      </div>  
    </div>    
    <?php endif; ?>
  </div>
  <input type="hidden" name="product_title" id="product_title" value="<?php echo e($single_product_details['post_title']); ?>"> 
  <input type="hidden" name="product_img" id="product_img" value="<?php echo e($single_product_details['_product_related_images_url']->product_image); ?>"> 
</div>