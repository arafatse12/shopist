<?php echo $__env->make('includes.frontend.header-content-custom-css', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<style type="text/css">
  header #header_content ul.right-menu li, header #header_content ul.all-menu li{
     padding: 0px 2px;

   }
   .carousel-inner {
    position: relative;
    width: 100%;
    overflow: hidden;
    margin-left: 3px;
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
                      <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/new-in-dresses')); ?>">New In: Dresses</a></li>
                      <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/new-in-tunics')); ?>">New In: Tunics</a></li>
                      <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/new-in-topcoats')); ?>">New In: Topcoats</a></li>
                      <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/new-in-abayas')); ?>">New In: Abayas</a></li>
                      <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/new-in-pants')); ?>">New In: Pants</a></li>
                      <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/new-in-skirts')); ?>">New In: Skirts</a></li>
                      <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/new-in-jeans')); ?>">New In: Jeans</a></li>
                       
                           
                       
                    </ul>

                  </li>
                   <li class="col-xs-12 col-sm-4">  
                    
                    <ul>
                      
                      <li class="dropdown-header">
                        <img src=""> 
                        <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/new-in-shoes')); ?>">New In: Shoes</a></li>
                        <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/new-in-bags')); ?>">New In: Bags</a></li>
                         <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/new-in-shawls')); ?>">New In: Shawls</a></li>
                          <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/new-in-scarves')); ?>">New In: Scarves</a></li>
                          <li class="dropdown-header"><a href ="<?php echo e(url('product/categories/semi-instant-shawls')); ?>">Semi-Instant Shawls</a>
                        
                      </li>
                      <li class="dropdown-header"><a href="<?php echo e(url('product/categories/instant-scarves-2')); ?>">Instant Scarves</a>
                      </li>
                       
                        
                        
                      </li>
                    </ul>

                  </li>
                  
                  
                 
                  
                  
                  <div class="clear-both"></div>
                  
                </ul>
              </li>
              <li class="dropdown mega-dropdown">
                <a href="<?php echo e(url('#')); ?>" class="dropdown-toggle menu-name" data-toggle="dropdown"> Hijab <span class="caret"></span></a>
                <ul class="dropdown-menu mega-dropdown-menu mega-menu-cat row clearfix">
                  <li class="col-xs-12 col-sm-4">  
                    
                    <ul>
                      
                      <li class="dropdown-header">
                        <img src=""> 
                        
                        HIJABS
                      </li>
                      <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/shawls')); ?>">Shawls</a></li>
                      <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/scarves')); ?>">Scarves</a></li>
                      <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/headwear')); ?>">Headwear</a></li>
                       <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/chiffon')); ?>">Chiffon</a></li>
                     

                        <li class="dropdown-header">
                        <img src=""> 
                        
                        SHAWLS
                      </li>

                      <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/silk')); ?>">Silk</a></li>
                      <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/chiffon')); ?>">Chiffon</a></li>
                      <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/pashmina')); ?>">Pashmina</a></li>
                      <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/silk-blend')); ?>">Silk Blend</a></li>
                      <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/pinless-shawls')); ?>">Pinless Shawls</a></li>
                      

                      

                    </ul>

                  </li>
                  
                  
                  <li class="col-xs-12 col-sm-4">  
                    
                    <ul>
                      
                      <li class="dropdown-header">
                        <img src=""> 
                       DESIGNERS
                        
                        
                      </li>
                       <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/rabia-z')); ?>">Rabia Z</a></li>
                          <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/tuva-Şal')); ?>">Tuva Şal</a></li>

                         <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/ayşe-türban')); ?>">Ayşe Türban</a></li>
                         <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/tulipa-türban')); ?>">Tulipa Türban</a></li>
                          <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/argite')); ?>">Argite</a></li>
                          <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/mirach')); ?>">Mirach
                          </a></li>
                          <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/duanil')); ?>">Duanil</a></li>
                          <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/zehrace-Şal')); ?>">Zehrace Şal</a></li>
                          <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/tajj')); ?>">Tajj</a></li>
                          <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/differenza')); ?>">Differenza</a></li>
                          <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/cŞK-unique')); ?>">CŞK Unique</a></li>
                          <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/capsters')); ?>">Capsters</a></li>
                          <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/theFAD.co')); ?>">TheFAD.co</a></li>


                      
                       

                    </ul>

                  </li>
                   <li class="col-xs-12 col-sm-4">  
                    
                    <ul>
                      
                      <li class="dropdown-header">
                        <img src=""> 
                       ACCESSORIES
                        
                        
                      </li>
                       <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/instant-scarves')); ?>">Instant Scarves</a></li>
                          <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/ponchos-and-shawl-wraps')); ?>">Ponchos and Shawl Wraps</a></li>

                         <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/arm-sleeves-neckcovers')); ?>">Arm Sleeves-Neckcovers</a></li>
                         <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/shawl-scarf-accessory')); ?>">Shawl & Scarf Accessory</a></li>
                          <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/scarf-hanger')); ?>">Scarf Hanger</a></li>
                        </ul>

                  </li>
                
                  <div class="clear-both"></div>
                  
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
                      <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/dresses')); ?>">Dresses</a></li>
                      <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/suits')); ?>">Suits</a></li>
                      <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/jumpsuits')); ?>">Jumpsuits</a></li>
                      <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/praying-dress')); ?>">Praying Dresses</a></li>

                        <li class="dropdown-header">
                        <img src=""> 
                        
                        TUNICS
                      </li>

                      <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/tunics')); ?>">Tunics</a></li>
                      <li class="dropdown-header">
                        <img src=""> 
                        
                        LOUNGEWEAR
                      </li>

                      <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/pajamas')); ?>">Pajamas</a></li>
                       <li class="product-sub-cat">
                          <a href="<?php echo e(url('product/categories/underwaear')); ?>">Underwear</a>
                        </li>
                        <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/socks')); ?>">Socks</a></li>

                    </ul>

                  </li>
                  
                  
                  <li class="col-xs-12 col-sm-4">  
                    
                    <ul>
                      
                      <li class="dropdown-header">
                        <img src=""> 
                       TOPS
                        
                        
                      </li>
                       <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/blouses-shirts')); ?>">Blouses / Shirts</a></li>
                          <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/jackets')); ?>">Jackets</a></li>

                         <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/vests')); ?>">Vests</a></li>
                         <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/cardigans')); ?>">Cardigans</a></li>
                          <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/sweaters')); ?>">Sweaters</a></li>


                      <li class="dropdown-header">
                        <img src=""> 
                       BOTTOMS
                        
                        
                      </li>
                       <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/pants')); ?>">Pants</a></li>
                          <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/skirts')); ?>">Skirts</a></li>

                         <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/panties')); ?>">panties</a></li>

                         <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/jeans')); ?>">Jeans</a></li>
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
                      <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/coats-topcoats')); ?>">Coats / Topcoats</a></li>
                      <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/abayas')); ?>">Abayas</a></li>
                      <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/trench-coats')); ?>">Trench Coats</a></li>
                      <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/coats')); ?>">Coats</a></li>
                       <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/jackets')); ?>">Jackets</a></li>
                        <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/puffer-jackets')); ?>">Puffer Jackets</a></li>
                         <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/ponchos')); ?>">Ponchos</a></li>

                        
                      
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
                      <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/p-size-dresses')); ?>">P. Size Dresses</a></li>
                      <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/p-size-evening-dresses')); ?>">P. Size Evening Dresses</a></li>
                      <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/p-size-tunics')); ?>">P. Size Tunics</a></li>
                      <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/p-size-suits')); ?>">P. Size Suits</a></li>

                        <li class="dropdown-header">
                        <img src=""> 
                        
                        OUTERWEAR
                      </li>

                      <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/p-size-abayas')); ?>">P. Size Abayas</a></li>
                      <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/p-size-coats-topcoats')); ?>">P. Size Coats/Topcoats</a></li>


                      <li class="dropdown-header">
                        <img src=""> 
                        
                        SWIMWEAR
                      </li>

                      <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/p-size-swimwear')); ?>">P. Size Swimwear</a></li>
                       <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/p-size-tracksuit')); ?>">P. Size Tracksuit</a></li>
                       <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/p-size-tracksuit')); ?>">P. Size Tracksuit</a></li>
                       

                    </ul>

                  </li>
                  
                  
                  <li class="col-xs-12 col-sm-4">  
                    
                    <ul>
                      
                      <li class="dropdown-header">
                        <img src=""> 
                       TOPS
                        
                        
                      </li>
                       <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/p-size-blouses-shirts')); ?>">P. Size Blouses/Shirts</a></li>
                          <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/p-size-vests')); ?>">P. Size Vests</a></li>

                         <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/p-size-cardigans')); ?>">P. Size Cardigans</a></li>

                         <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/p-size-jackets')); ?>">P. Size Jackets</a></li>
                         

                      <li class="dropdown-header">
                        <img src=""> 
                       BOTTOMS
                        
                        
                      </li>
                       <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/p-size-pants')); ?>">P. Size Pants</a></li>
                          <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/p-size-skirts')); ?>">P. Size Skirts</a></li>

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
                      <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/covered-swimsuits')); ?>">Covered Swimsuits</a></li>
                      <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/semi-covered-swimsuits')); ?>">Semi-Covered Swimsuits</a></li>
                      <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/swimwear-styles-bikini')); ?>">Swimwear Styles/Bikini</a></li>
                      

                        <li class="dropdown-header">
                        <img src=""> 
                        
                        SPORTSWEAR
                      </li>

                      <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/islamic-sportswear')); ?>">Islamic Sportswear</a></li>
                      <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/pareo')); ?>">Pareo</a></li>


                      
                       

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

                      <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/boots-booties')); ?>">Boots / Booties</a></li>
                      <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/casual-shoes')); ?>">Casual Shoes</a></li>
                      <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/high-heels')); ?>">High Heels</a></li>
                       <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/sports-shoes')); ?>">Sports Shoes</a></li>
                        <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/sandals-slippers')); ?>">Sandals & Slippers</a></li>

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
                      <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/kuaybe-gider')); ?>">Kuaybe Gider</a></li>
                      <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/mayovera')); ?>">Mayovera</a></li>
                      <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/minel-aşk')); ?>">Minel Aşk</a></li>
                      <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/nurbanu-kural')); ?>">Nurbanu Kural</a></li>
                       <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/mevrm')); ?>">Mevra</a></li>
                        <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/gamze-Özkul')); ?>">Gamze Özkul</a></li>
                         <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/pınar-Şems')); ?>">Pınar Şems</a></li>
                         <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/muslima-wear')); ?>">Muslima Wear</a></li>
                         <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/dersaadet')); ?>">Dersaadet</a></li>
                         <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/nur-kombin')); ?>">Nur Kombin</a></li>
                         <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/saliha')); ?>">Saliha</a></li>
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
                      <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/evening-dresses-gowns')); ?>">Evening Dresses & Gowns</a></li>
                      <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/evening-skirts')); ?>">Evening Skirts</a></li>
                      <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/dressy-shawls-headwear')); ?>">Dressy Shawls & Headwear</a></li>
                      <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/scarf-hanger')); ?>evening-suits">Evening Suits</a></li>
                       <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/evening-wear')); ?>">Evening Wear</a></li>
                        
                        
                      
                    </ul>

                  </li>
                   <li class="col-xs-12 col-sm-4">  
                    
                    <ul>
                      
                      <li class="dropdown-header">
                        <img src=""> 
                      EVENING WEAR BRANDS
                        
                        
                      </li>
                       <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/dersaadet')); ?>">Dersaadet</a></li>
                          <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/minel-aşk')); ?>">Minel Aşk</a></li>

                         <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/mevra')); ?>">Mevra</a></li>

                         <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/muslima-wear')); ?><">Muslima Wear</a></li>
                         <li class="product-sub-cat"><a href="<?php echo e(url('product/categories/modaysa')); ?>">Modaysa</a></li>
                         

                      
                      
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
    <div class="container">
    <div class="row">
      <div class="col-md-8 col-xs-8">
    

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
   <div class="col-md-4 col-xs-4">

    <img alt="Stilini Yansıt" src="https://fns.modanisa.com/r/catban/banner-set/stilini-yansit-lansman-yani-1Ly_en.png?v=7" width="360" height="310">

   </div>
  </div>
  </div>
</div>
  <?php endif; ?>
<?php endif; ?>