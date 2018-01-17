<?php echo $__env->make('includes.frontend.header-content-custom-css', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<style type="text/css">
  header #header_content ul.right-menu li, header #header_content ul.all-menu li{
     padding: 0px 2px;

   }
   .carousel-inner {
    position: relative;
    width: 66%;
    overflow: hidden;
    margin-left: 63px;
   }
   .carousel-indicators{
    margin-left: 5%;
   }
   .layoutRow1Right {
    width: 350px;
    height: 350px;
    float: right;
    background: #DFDFDF;
  }

</style>

<div id="header_content" class="header-before-slider header-background">
  <div class="top-header">
    <div class="container">
      <div class="row">
        <div class="col-xs-5 col-sm-6 col-md-6 col-lg-6">
          <div class="dropdown change-multi-currency">
            <?php if(get_frontend_selected_currency()): ?>
            <a class="dropdown-toggle" href="#" data-hover="dropdown" data-toggle="dropdown">
              <span class="hidden-xs"><?php echo get_currency_name_by_code( get_frontend_selected_currency() ); ?></span>
              <span class="hidden-sm hidden-md hidden-lg fa fa-money fa-lg"></span> 
              <?php if(count(get_frontend_selected_currency_data()) >0): ?>
              <span class="caret"></span>
              <?php endif; ?>
            </a>
            <?php endif; ?>
            <div class="dropdown-content">
              <?php if(count(get_frontend_selected_currency_data()) >0): ?>
                <?php $__currentLoopData = get_frontend_selected_currency_data(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                  <a href="#" data-currency_name="<?php echo e($val); ?>"><?php echo get_currency_name_by_code( $val ); ?></a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
              <?php endif; ?>
            </div>
          </div>
          

          <div class="dropdown language-list">
            <?php if(count(get_frontend_selected_languages_data()) > 0): ?>
              <?php if(get_frontend_selected_languages_data()['lang_code'] == 'en'): ?>
                <a class="dropdown-toggle" href="#" data-hover="dropdown" data-toggle="dropdown">
                  <img src="<?php echo e(asset('resources/assets/images/'. get_frontend_selected_languages_data()['lang_sample_img'])); ?>" alt="lang"> <span class="hidden-xs"> &nbsp; <?php echo get_frontend_selected_languages_data()['lang_name']; ?></span> <span class="caret"></span></a>
              <?php else: ?>
                <a class="dropdown-toggle" href="#" data-hover="dropdown" data-toggle="dropdown">
                  <img src="<?php echo e(get_image_url(get_frontend_selected_languages_data()['lang_sample_img'])); ?>" alt="lang"> <span class="hidden-xs"> &nbsp; <?php echo get_frontend_selected_languages_data()['lang_name']; ?></span> <span class="caret"></span></a>
              <?php endif; ?>
            <?php endif; ?>
            <?php if(count(get_available_languages_data_frontend() > 0)): ?>
              <div class="dropdown-content">
                <?php $__currentLoopData = get_available_languages_data_frontend(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                  <?php if($val['lang_code'] == 'en'): ?>
                    <a href="#" data-lang_name="<?php echo e($val['lang_code']); ?>"><img src="<?php echo e(asset('resources/assets/images/'. $val['lang_sample_img'])); ?>" alt="lang"> &nbsp;<?php echo ucwords($val['lang_name']); ?></a>
                  <?php else: ?>
                    <a href="#" data-lang_name="<?php echo e($val['lang_code']); ?>"><img src="<?php echo e(get_image_url($val['lang_sample_img'])); ?>" alt="lang"> &nbsp;<?php echo ucwords($val['lang_name']); ?></a>
                  <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
              </div>
            <?php endif; ?>
          </div>     
        </div>
      
        <div class="col-xs-7 col-sm-6 col-md-6 col-lg-6">
          <div class="clearfix">
            <div class="pull-right">
              <ul class="right-menu top-right-menu">
                <li class="wishlist-content">
                  <a class="main" href="<?php echo e(route('my-saved-items-page')); ?>">
                    <i class="fa fa-heart"></i> 
                    <span class="hidden-xs"><?php echo trans('frontend.frontend_wishlist'); ?></span> 
                  </a>    
                </li>  
                <?php if(Request::is('user/account')): ?>
                <li><a href="<?php echo e(route('user-account-page')); ?>" class="main selected"><i class="fa fa-user" aria-hidden="true"></i> <span class="hidden-xs"><?php echo trans('frontend.menu_my_account'); ?></span></a></li>
                <?php else: ?>
                <li><a href="<?php echo e(route('user-account-page')); ?>" class="main"><i class="fa fa-user" aria-hidden="true"></i> <span class="hidden-xs"><?php echo trans('frontend.menu_my_account'); ?></span></a></li>
                <?php endif; ?>

                <li class="mini-cart-content">
                    <?php echo $__env->make('pages.ajax-pages.mini-cart-html', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </li>
              </ul>
            </div>  
          </div>
        </div> 
      </div>         
    </div>      
  </div>  
   
  <div class="container">  
    <div class="row">
      <div class="search-content">
        <div class="col-xs-12 col-sm-0 col-md-3 col-lg-3">
          <?php if(get_site_logo_image()): ?>
            <div class="logo hidden-xs hidden-sm"><img src="<?php echo e(get_site_logo_image()); ?>" title="<?php echo e(trans('frontend.your_store_label')); ?>" alt="<?php echo e(trans('frontend.your_store_label')); ?>"></div>
          <?php endif; ?>
        </div> 

        <div class="col-xs-8 col-sm-10 col-md-6 col-lg-6">
          <form id="search_option" action="<?php echo e(route('shop-page')); ?>" method="get">
            <div class="input-group">
              <input type="text" id="srch_term" name="srch_term" class="form-control" placeholder="<?php echo e(trans('frontend.search_for_label')); ?>">
              <span class="input-group-btn">
                <button id="btn-search" type="submit" class="btn btn-default">
                  <span class="glyphicon glyphicon-search"></span>
                </button>
              </span>
            </div>
          </form>
        </div> 

        <div class="col-xs-4 col-sm-2 col-md-3 col-lg-3 text-right"> 
          <a href="<?php echo e(route('product-comparison-page')); ?>" class="btn btn-default btn-compare"><i class="fa fa-exchange"></i> <span class="hidden-xs hidden-sm"> &nbsp; <?php echo trans('frontend.compare_label'); ?></span> <span class="compare-value"> (<?php echo $total_compare_item;?>)</span></a>
        </div>  
      </div>
    </div>    
  </div>    
   
  <div class="container"> 
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <nav class="navbar navbar-default" role="navigation">
          <div class="navbar-header">
            <button type="button" class="btn navbar-toggle collapsed" 
               data-toggle="collapse" data-target="#header-navbar-collapse">
               <span class="sr-only">Toggle navigation</span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
            </button>
            <img class="navbar-brand visible-xs visible-sm" src="<?php echo e(get_site_logo_image()); ?>" alt="<?php echo e(trans('frontend.your_store_label')); ?>">  
          </div>
          <div class="collapse navbar-collapse" id="header-navbar-collapse">
            <ul class="all-menu nav navbar-nav">

              
              

              <li class="dropdown mega-dropdown">
                <a href="<?php echo e(url('#')); ?>" class="dropdown-toggle menu-name" data-toggle="dropdown"> New <span class="caret"></span></a>
                <ul class="dropdown-menu mega-dropdown-menu mega-menu-cat row clearfix">
                  <li class="col-xs-12 col-sm-4">  
                    
                    <ul>
                      
                      <li class="dropdown-header">
                        <img src=""> 
                        
                        NEW
                      </li>
                      <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/new-in-dresses">New In: Dresses</a></li>
                      <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/new-in-tunics">New In: Tunics</a></li>
                      <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/new-in-topcoats">New In: Topcoats</a></li>
                      <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/new-in-abayas">New In: Abayas</a></li>
                      <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/new-in-pants">New In: Pants</a></li>
                      <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/new-in-skirts">New In: Skirts</a></li>
                      <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/new-in-jeans">New In: Jeans</a></li>
                       
                           
                       
                    </ul>

                  </li>
                   <li class="col-xs-12 col-sm-4">  
                    
                    <ul>
                      
                      <li class="dropdown-header">
                        <img src=""> 
                        <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/new-in-shoes">New In: Shoes</a></li>
                        <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/new-in-bags">New In: Bags</a></li>
                         <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/new-in-shawls">New In: Shawls</a></li>
                          <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/new-in-scarves">New In: Scarves</a></li>
                          <li class="dropdown-header"><a href ="http://islamicdressonline.com/product/categories/semi-instant-shawls">
                        
                        Semi-Instant Shawls</a>
                        
                      </li>
                      <li class="dropdown-header"><a href="http://islamicdressonline.com/product/categories/instant-scarves">
                         
                        
                        Instant Scarves</a>
                      </li>
                       
                        
                        
                      </li>
                    </ul>

                  </li>
                  
                  
                 
                  
                  
                  <div class="clear-both"></div>
                  
                </ul>
              </li>


              <li class="dropdown mega-dropdown">
                <a href="#" class="dropdown-toggle menu-name" data-toggle="dropdown"> Hijab<span class="caret"></span></a>
                <ul class="dropdown-menu mega-dropdown-menu mega-menu-cat row clearfix">
                  <?php if(count($productCategoriesTree) > 0): ?>
                    <?php $i = 1; $j = 0;?>
                    <?php $__currentLoopData = $productCategoriesTree; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                      <?php if($i == 1): ?>
                      <?php $j++; ?>
                      <li class="col-xs-12 col-sm-4">  
                      <?php endif; ?>

                      <ul>
                        <?php if(isset($cat['parent']) && $cat['parent'] == 'Parent Category'): ?>  
                        <li class="dropdown-header">
                            <?php if( $cat['img_url'] ): ?>
                            <img src="<?php echo e(get_image_url($cat['img_url'])); ?>"> 
                            <?php else: ?>
                            <img src="<?php echo e(default_placeholder_img_src()); ?>"> 
                            <?php endif; ?>
                            
                            <?php echo $cat['name']; ?>

                        </li>
                        <?php endif; ?>
                        <?php if(isset($cat['children']) && count($cat['children']) > 0): ?>
                          <?php $__currentLoopData = $cat['children']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat_sub): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                            <li class="product-sub-cat"><a href="<?php echo e(route('categories-page', $cat_sub['slug'])); ?>"><?php echo $cat_sub['name']; ?></a></li>
                            <?php if(isset($cat_sub['children']) && count($cat_sub['children']) > 0): ?>
                              <?php echo $__env->make('pages.common.category-frontend-loop-home', $cat_sub, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php endif; ?>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                        <?php endif; ?>
                      </ul>

                      <?php if($i == 1): ?>
                      </li>
                      <?php $i = 0;?>
                      <?php endif; ?>

                      <?php if($j == 3 || $j == 4): ?>
                      <div class="clear-both"></div>
                      <?php $j = 0; ?>
                      <?php endif; ?>

                      <?php $i ++;?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                  <?php endif; ?>
                </ul>
              </li>
              <li class="dropdown mega-dropdown">
                <a href="<?php echo e(url('#')); ?>" class="dropdown-toggle menu-name" data-toggle="dropdown"> Clothing <span class="caret"></span></a>
                <ul class="dropdown-menu mega-dropdown-menu mega-menu-cat row clearfix">
                  <li class="col-xs-12 col-sm-4">  
                    
                    <ul>
                      
                      <li class="dropdown-header">
                        <img src=""> 
                        
                        ALL DRESSES
                      </li>
                      <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/dresses">Dresses</a></li>
                      <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/suits">Suits</a></li>
                      <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/jumpsuits">Jumpsuits</a></li>
                      <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/praying-dress">Praying Dresses</a></li>

                        <li class="dropdown-header">
                        <img src=""> 
                        
                        TUNICS
                      </li>

                      <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/tunics">Tunics</a></li>
                      <li class="dropdown-header">
                        <img src=""> 
                        
                        LOUNGEWEAR
                      </li>

                      <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/pajamas">Pajamas</a></li>
                       <li class="product-sub-cat">
                          <a href="http://islamicdressonline.com/product/categories/underwaear">Underwear</a>
                        </li>
                        <li class="product-sub-cat"><a href="http://localhost/shopist/product/categories/headwear">Socks</a></li>

                    </ul>

                  </li>
                  
                  
                  <li class="col-xs-12 col-sm-4">  
                    
                    <ul>
                      
                      <li class="dropdown-header">
                        <img src=""> 
                       TOPS
                        
                        
                      </li>
                       <li class="product-sub-cat"><a href="http://localhost/shopist/product/categories/headwear">Blouses / Shirts</a></li>
                          <li class="product-sub-cat"><a href="http://localhost/shopist/product/categories/headwear">Jackets</a></li>

                         <li class="product-sub-cat"><a href="http://localhost/shopist/product/categories/headwear">Vests</a></li>

                         <li class="product-sub-cat"><a href="http://localhost/shopist/product/categories/headwear">Cardigans</a></li>
                          <li class="product-sub-cat"><a href="http://localhost/shopist/product/categories/headwear">Sweaters</a></li>


                      <li class="dropdown-header">
                        <img src=""> 
                       BOTTOMS
                        
                        
                      </li>
                       <li class="product-sub-cat"><a href="http://localhost/shopist/product/categories/headwear">Pants</a></li>
                          <li class="product-sub-cat"><a href="http://localhost/shopist/product/categories/headwear">Skirts</a></li>

                         <li class="product-sub-cat"><a href="http://localhost/shopist/product/categories/headwear">panties</a></li>

                         <li class="product-sub-cat"><a href="http://localhost/shopist/product/categories/headwear">Jeans</a></li>
                         <li class="dropdown-header">
                         <img src=""> 
                          KNITWEAR 
                         </li>
                      <li class="dropdown-header">
                        <img src=""> 
                          MATERNITY CLOTHING 
                      </li>
                          

                    </ul>

                  </li>
                
                  <div class="clear-both"></div>
                  
                </ul>
              </li>

               <li class="dropdown mega-dropdown">
                <a href="<?php echo e(url('#')); ?>" class="dropdown-toggle menu-name" data-toggle="dropdown"> Outerwear <span class="caret"></span></a>
                <ul class="dropdown-menu mega-dropdown-menu mega-menu-cat row clearfix">
                  <li class="col-xs-12 col-sm-4">  
                    
                    <ul>
                      
                      <li class="dropdown-header">
                        <img src=""> 
                        
                       OUTERWEAR
                      </li>
                      <li class="product-sub-cat"><a href="http://localhost/shopist/product/categories/SHAWLS">Coats / Topcoats</a></li>
                      <li class="product-sub-cat"><a href="http://localhost/shopist/product/categories/Scarves">Abayas</a></li>
                      <li class="product-sub-cat"><a href="http://localhost/shopist/product/categories/headwear">Trench Coats</a></li>
                      <li class="product-sub-cat"><a href="http://localhost/shopist/product/categories/SHAWLS">Coats</a></li>
                       <li class="product-sub-cat"><a href="http://localhost/shopist/product/categories/SHAWLS">Jackets</a></li>
                        <li class="product-sub-cat"><a href="http://localhost/shopist/product/categories/SHAWLS">Puffer Jackets</a></li>
                         <li class="product-sub-cat"><a href="http://localhost/shopist/product/categories/SHAWLS">Ponchos</a></li>

                        
                      
                    </ul>

                  </li>
                
                  <div class="clear-both"></div>
                  
                </ul>
              </li>
              <li class="dropdown mega-dropdown">
                <a href="<?php echo e(url('#')); ?>" class="dropdown-toggle menu-name" data-toggle="dropdown"> Plus Size <span class="caret"></span></a>
                <ul class="dropdown-menu mega-dropdown-menu mega-menu-cat row clearfix">
                  <li class="col-xs-12 col-sm-4">  
                    
                    <ul>
                      
                      <li class="dropdown-header">
                        <img src=""> 
                        
                        DRESSES
                      </li>
                      <li class="product-sub-cat"><a href="http://localhost/shopist/product/categories/SHAWLS">P. Size Dresses</a></li>
                      <li class="product-sub-cat"><a href="http://localhost/shopist/product/categories/Scarves">P. Size Evening Dresses</a></li>
                      <li class="product-sub-cat"><a href="http://localhost/shopist/product/categories/headwear">P. Size Tunics</a></li>
                      <li class="product-sub-cat"><a href="http://localhost/shopist/product/categories/SHAWLS">P. Size Suits</a></li>

                        <li class="dropdown-header">
                        <img src=""> 
                        
                        OUTERWEAR
                      </li>

                      <li class="product-sub-cat"><a href="http://localhost/shopist/product/categories/Scarves">P. Size Abayas</a></li>
                      <li class="product-sub-cat"><a href="http://localhost/shopist/product/categories/Scarves">P. Size Coats/Topcoats</a></li>


                      <li class="dropdown-header">
                        <img src=""> 
                        
                        SWIMWEAR
                      </li>

                      <li class="product-sub-cat"><a href="http://localhost/shopist/product/categories/headwear">P. Size Swimwear</a></li>
                       <li class="product-sub-cat"><a href="http://localhost/shopist/product/categories/headwear">P. Size Tracksuit</a></li>
                       

                    </ul>

                  </li>
                  
                  
                  <li class="col-xs-12 col-sm-4">  
                    
                    <ul>
                      
                      <li class="dropdown-header">
                        <img src=""> 
                       TOPS
                        
                        
                      </li>
                       <li class="product-sub-cat"><a href="http://localhost/shopist/product/categories/headwear">P. Size Blouses/Shirts</a></li>
                          <li class="product-sub-cat"><a href="http://localhost/shopist/product/categories/headwear">P. Size Vests</a></li>

                         <li class="product-sub-cat"><a href="http://localhost/shopist/product/categories/headwear">P. Size Cardigans</a></li>

                         <li class="product-sub-cat"><a href="http://localhost/shopist/product/categories/headwear">P. Size Jackets</a></li>
                         

                      <li class="dropdown-header">
                        <img src=""> 
                       BOTTOMS
                        
                        
                      </li>
                       <li class="product-sub-cat"><a href="http://localhost/shopist/product/categories/headwear">P. Size Pants</a></li>
                          <li class="product-sub-cat"><a href="http://localhost/shopist/product/categories/headwear">P. Size Skirts</a></li>

                    </ul>

                  </li>
                
                  <div class="clear-both"></div>
                  
                </ul>
              </li>
              <li class="dropdown mega-dropdown">
                <a href="<?php echo e(url('#')); ?>" class="dropdown-toggle menu-name" data-toggle="dropdown"> Swimwear/Sportswear <span class="caret"></span></a>
                <ul class="dropdown-menu mega-dropdown-menu mega-menu-cat row clearfix">
                  <li class="col-xs-12 col-sm-4">  
                    
                    <ul>
                      
                      <li class="dropdown-header">
                        <img src=""> 
                        
                        SWIMWEAR
                      </li>
                      <li class="product-sub-cat"><a href="http://localhost/shopist/product/categories/SHAWLS">Covered Swimsuits</a></li>
                      <li class="product-sub-cat"><a href="http://localhost/shopist/product/categories/Scarves">Semi-Covered Swimsuits</a></li>
                      <li class="product-sub-cat"><a href="http://localhost/shopist/product/categories/headwear">Swimwear Styles/Bikini</a></li>
                      

                        <li class="dropdown-header">
                        <img src=""> 
                        
                        SPORTSWEAR
                      </li>

                      <li class="product-sub-cat"><a href="http://localhost/shopist/product/categories/Scarves">Islamic Sportswear</a></li>
                      <li class="product-sub-cat"><a href="http://localhost/shopist/product/categories/Scarves">Pareo</a></li>


                      
                       

                    </ul>

                  </li>
                  
                  </li>
                
                  <div class="clear-both"></div>
                  
                </ul>
              </li>
              <li class="dropdown mega-dropdown">
                <a href="<?php echo e(url('#')); ?>" class="dropdown-toggle menu-name" data-toggle="dropdown"> Shoes/Bags <span class="caret"></span></a>
                <ul class="dropdown-menu mega-dropdown-menu mega-menu-cat row clearfix">
                  <li class="col-xs-12 col-sm-4">  
                    
                    <ul>
                      
                      <li class="dropdown-header">
                        <img src=""> 
                        
                        BAGS
                      </li>
                       <li class="dropdown-header">
                        <img src=""> 
                        
                        WALLET
                      </li>
                       <li class="dropdown-header">
                        <img src=""> 
                        
                        SUNGLASSES
                      </li>
                       <li class="dropdown-header">
                        <img src=""> 
                        
                        WATCHES
                      </li>
                       <li class="dropdown-header">
                        <img src=""> 
                        
                        JEWELRY


                      </li>
                       <li class="dropdown-header">
                        <img src=""> 
                        
                        GIFTS
                      </li>
                       <li class="dropdown-header">
                        <img src=""> 
                        
                        SHOES
                      </li>

                      <li class="product-sub-cat"><a href="http://localhost/shopist/product/categories/SHAWLS">Boots / Booties</a></li>
                      <li class="product-sub-cat"><a href="http://localhost/shopist/product/categories/Scarves">Casual Shoes</a></li>
                      <li class="product-sub-cat"><a href="http://localhost/shopist/product/categories/headwear">High Heels</a></li>
                       <li class="product-sub-cat"><a href="http://localhost/shopist/product/categories/headwear">Sports Shoes</a></li>
                        <li class="product-sub-cat"><a href="http://localhost/shopist/product/categories/headwear">Sandals & Slippers</a></li>

                    </ul>

                  </li>
                  
                  </li>
                
                  <div class="clear-both"></div>
                  
                </ul>
              </li>
               <li class="dropdown mega-dropdown">
                <a href="<?php echo e(url('#')); ?>" class="dropdown-toggle menu-name" data-toggle="dropdown"> Designers <span class="caret"></span></a>
                <ul class="dropdown-menu mega-dropdown-menu mega-menu-cat row clearfix">
                  <li class="col-xs-12 col-sm-4">  
                    
                    <ul>
                      
                      <li class="dropdown-header">
                        <img src=""> 
                        
                       DESIGNERS
                      </li>
                      <li class="product-sub-cat"><a href="http://localhost/shopist/product/categories/SHAWLS">Kuaybe Gider</a></li>
                      <li class="product-sub-cat"><a href="http://localhost/shopist/product/categories/Scarves">Mayovera</a></li>
                      <li class="product-sub-cat"><a href="http://localhost/shopist/product/categories/headwear">Minel Aşk</a></li>
                      <li class="product-sub-cat"><a href="http://localhost/shopist/product/categories/SHAWLS">Nurbanu Kural</a></li>
                       <li class="product-sub-cat"><a href="http://localhost/shopist/product/categories/SHAWLS">Mevra</a></li>
                        <li class="product-sub-cat"><a href="http://localhost/shopist/product/categories/SHAWLS">Gamze Özkul</a></li>
                         <li class="product-sub-cat"><a href="http://localhost/shopist/product/categories/SHAWLS">Pınar Şems</a></li>
                         <li class="product-sub-cat"><a href="http://localhost/shopist/product/categories/SHAWLS">Muslima Wear</a></li>
                         <li class="product-sub-cat"><a href="http://localhost/shopist/product/categories/SHAWLS">Dersaadet</a></li>
                         <li class="product-sub-cat"><a href="http://localhost/shopist/product/categories/SHAWLS">Nur Kombin</a></li>
                         <li class="product-sub-cat"><a href="http://localhost/shopist/product/categories/SHAWLS">Saliha</a></li>
                         <li class="dropdown-header">
                        <img src=""> 
                        
                      All Brands
                      </li>
                      
                    </ul>

                  </li>
                
                  <div class="clear-both"></div>
                  
                </ul>
              </li>
               <li class="dropdown mega-dropdown">
                <a href="<?php echo e(url('#')); ?>" class="dropdown-toggle menu-name" data-toggle="dropdown"> Evening Wear <span class="caret"></span></a>
                <ul class="dropdown-menu mega-dropdown-menu mega-menu-cat row clearfix">
                  <li class="col-xs-12 col-sm-4">  
                    
                    <ul>
                      
                      <li class="dropdown-header">
                        <img src=""> 
                        
                       EVENING WEAR
                      </li>
                      <li class="product-sub-cat"><a href="http://localhost/shopist/product/categories/SHAWLS">Evening Dresses & Gowns</a></li>
                      <li class="product-sub-cat"><a href="http://localhost/shopist/product/categories/Scarves">Evening Skirts</a></li>
                      <li class="product-sub-cat"><a href="http://localhost/shopist/product/categories/headwear">Dressy Shawls & Headwear</a></li>
                      <li class="product-sub-cat"><a href="http://localhost/shopist/product/categories/SHAWLS">Evening Suits</a></li>
                       <li class="product-sub-cat"><a href="http://localhost/shopist/product/categories/SHAWLS">Evening Wear</a></li>
                        
                        
                      
                    </ul>

                  </li>
                   <li class="col-xs-12 col-sm-4">  
                    
                    <ul>
                      
                      <li class="dropdown-header">
                        <img src=""> 
                      EVENING WEAR BRANDS
                        
                        
                      </li>
                       <li class="product-sub-cat"><a href="http://localhost/shopist/product/categories/headwear">Dersaadet</a></li>
                          <li class="product-sub-cat"><a href="http://localhost/shopist/product/categories/headwear">Minel Aşk</a></li>

                         <li class="product-sub-cat"><a href="http://localhost/shopist/product/categories/headwear">Mevra</a></li>

                         <li class="product-sub-cat"><a href="http://localhost/shopist/product/categories/headwear">Muslima Wear</a></li>
                         <li class="product-sub-cat"><a href="http://localhost/shopist/product/categories/headwear">Modaysa</a></li>
                         

                      
                      
                    </ul>

                  </li>
                
                  <div class="clear-both"></div>
                  
                </ul>
              </li>


             

              
              <?php if(count($pages_list) > 0): ?>
              <li>
                <div class="dropdown custom-page">
                  <a class="dropdown-toggle menu-name" href="#" data-hover="dropdown" data-toggle="dropdown"> <?php echo trans('frontend.pages_label'); ?> 
                    <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu">
                    <?php $__currentLoopData = $pages_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pages): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                    <li> <a href="<?php echo e(route('custom-page-content', $pages['post_slug'])); ?>"><?php echo $pages['post_title']; ?></a></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                  </ul>
                </div>
              </li>
              <?php endif; ?>
            </ul>
          </div>
        </nav>
      </div>
    </div> 
  </div>    
</div>

<?php if($appearance_settings_data['header_details']['slider_visibility'] == true && Request::is('home')): ?>
  <?php $count = count(get_appearance_header_settings_data());?>
  <?php if($count > 0): ?>
  <div class="header-with-slider">
    <div id="slider-carousel" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <?php for($i = 0; $i < $count; $i++): ?>
          <?php if($i== 0): ?>
            <li data-target="#slider-carousel" data-slide-to="<?php echo e($i); ?>" class="active"></li>
          <?php else: ?>
            <li data-target="#slider-carousel" data-slide-to="<?php echo e($i); ?>"></li>
          <?php endif; ?>
        <?php endfor; ?>                           
      </ol>

      <?php $numb = 1; ?>
      <div class="carousel-inner">
        <?php $__currentLoopData = get_appearance_header_settings_data(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
          <?php if($numb == 1): ?>
            <div class="item active">
              <?php if($img->img_url): ?>
                <img src="<?php echo e(get_image_url($img->img_url)); ?>" class="girl img-responsive" alt="" />
              <?php endif; ?>

              <?php if(isset($img->text)){?>
                <div class="dynamic-text-on-image-container"><?php echo $img->text; ?></div>
              <?php }?>
            </div>
          <?php else: ?>
            <div class="item">
              <?php if($img->img_url): ?>
                <img src="<?php echo e(get_image_url($img->img_url)); ?>" class="girl img-responsive" alt="" />
              <?php endif; ?>

              <?php if(isset($img->text)){?>
                <div class="dynamic-text-on-image-container"><?php echo $img->text; ?></div>
              <?php }?>
            </div>
          <?php endif; ?>
          <?php $numb++ ; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
      </div>
    </div>
  </div>

  <?php endif; ?>
<?php endif; ?>