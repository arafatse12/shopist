@include('includes.frontend.header-content-custom-css')

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
            @if(get_frontend_selected_currency())
            <a class="dropdown-toggle" href="#" data-hover="dropdown" data-toggle="dropdown">
              <span class="hidden-xs">{!! get_currency_name_by_code( get_frontend_selected_currency() ) !!}</span>
              <span class="hidden-sm hidden-md hidden-lg fa fa-money fa-lg"></span> 
              @if(count(get_frontend_selected_currency_data()) >0)
              <span class="caret"></span>
              @endif
            </a>
            @endif
            <div class="dropdown-content">
              @if(count(get_frontend_selected_currency_data()) >0)
                @foreach(get_frontend_selected_currency_data() as $val)
                  <a href="#" data-currency_name="{{ $val }}">{!! get_currency_name_by_code( $val ) !!}</a>
                @endforeach
              @endif
            </div>
          </div>
          

          <div class="dropdown language-list">
            @if(count(get_frontend_selected_languages_data()) > 0)
              @if(get_frontend_selected_languages_data()['lang_code'] == 'en')
                <a class="dropdown-toggle" href="#" data-hover="dropdown" data-toggle="dropdown">
                  <img src="{{ asset('resources/assets/images/'. get_frontend_selected_languages_data()['lang_sample_img']) }}" alt="lang"> <span class="hidden-xs"> &nbsp; {!! get_frontend_selected_languages_data()['lang_name'] !!}</span> <span class="caret"></span></a>
              @else
                <a class="dropdown-toggle" href="#" data-hover="dropdown" data-toggle="dropdown">
                  <img src="{{ get_image_url(get_frontend_selected_languages_data()['lang_sample_img']) }}" alt="lang"> <span class="hidden-xs"> &nbsp; {!! get_frontend_selected_languages_data()['lang_name'] !!}</span> <span class="caret"></span></a>
              @endif
            @endif
            @if(count(get_available_languages_data_frontend() > 0))
              <div class="dropdown-content">
                @foreach(get_available_languages_data_frontend() as $key => $val)
                  @if($val['lang_code'] == 'en')
                    <a href="#" data-lang_name="{{ $val['lang_code'] }}"><img src="{{ asset('resources/assets/images/'. $val['lang_sample_img']) }}" alt="lang"> &nbsp;{!! ucwords($val['lang_name']) !!}</a>
                  @else
                    <a href="#" data-lang_name="{{ $val['lang_code'] }}"><img src="{{ get_image_url($val['lang_sample_img']) }}" alt="lang"> &nbsp;{!! ucwords($val['lang_name']) !!}</a>
                  @endif
                @endforeach
              </div>
            @endif
          </div>     
        </div>
      
        <div class="col-xs-7 col-sm-6 col-md-6 col-lg-6">
          <div class="clearfix">
            <div class="pull-right">
              <ul class="right-menu top-right-menu">
                <li class="wishlist-content">
                  <a class="main" href="{{ route('my-saved-items-page') }}">
                    <i class="fa fa-heart"></i> 
                    <span class="hidden-xs">{!! trans('frontend.frontend_wishlist') !!}</span> 
                  </a>    
                </li>  
                @if(Request::is('user/account'))
                <li><a href="{{ route('user-account-page') }}" class="main selected"><i class="fa fa-user" aria-hidden="true"></i> <span class="hidden-xs">{!! trans('frontend.menu_my_account') !!}</span></a></li>
                @else
                <li><a href="{{ route('user-account-page') }}" class="main"><i class="fa fa-user" aria-hidden="true"></i> <span class="hidden-xs">{!! trans('frontend.menu_my_account') !!}</span></a></li>
                @endif

                <li class="mini-cart-content">
                    @include('pages.ajax-pages.mini-cart-html')
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
          @if(get_site_logo_image())
            <div class="logo hidden-xs hidden-sm"><img src="{{ get_site_logo_image() }}" title="{{ trans('frontend.your_store_label') }}" alt="{{ trans('frontend.your_store_label') }}"></div>
          @endif
        </div> 

        <div class="col-xs-8 col-sm-10 col-md-6 col-lg-6">
          <form id="search_option" action="{{ route('shop-page') }}" method="get">
            <div class="input-group">
              <input type="text" id="srch_term" name="srch_term" class="form-control" placeholder="{{ trans('frontend.search_for_label') }}">
              <span class="input-group-btn">
                <button id="btn-search" type="submit" class="btn btn-default">
                  <span class="glyphicon glyphicon-search"></span>
                </button>
              </span>
            </div>
          </form>
        </div> 

        <div class="col-xs-4 col-sm-2 col-md-3 col-lg-3 text-right"> 
          <a href="{{ route('product-comparison-page') }}" class="btn btn-default btn-compare"><i class="fa fa-exchange"></i> <span class="hidden-xs hidden-sm"> &nbsp; {!! trans('frontend.compare_label') !!}</span> <span class="compare-value"> (<?php echo $total_compare_item;?>)</span></a>
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
            <img class="navbar-brand visible-xs visible-sm" src="{{ get_site_logo_image() }}" alt="{{ trans('frontend.your_store_label') }}">  
          </div>
          <div class="collapse navbar-collapse" id="header-navbar-collapse">
            <ul class="all-menu nav navbar-nav">

              {{--@if(Request::is('home'))
                <li class="first"><a href="{{ route('home-page') }}" class="main selected menu-name">{!! trans('frontend.home') !!}</a></li>
              @else
                <li class="first"><a href="{{ route('home-page') }}" class="main menu-name">{!! trans('frontend.home') !!}</a></li>
              @endif--}}
              

              <li class="dropdown mega-dropdown">
                <a href="{{ url('#') }}" class="dropdown-toggle menu-name" data-toggle="dropdown"> New <span class="caret"></span></a>
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
                <a href="#" class="dropdown-toggle menu-name" data-toggle="dropdown">{{--{!! trans('frontend.shop_by_cat_label') !!} --}} Hijab<span class="caret"></span></a>
                <ul class="dropdown-menu mega-dropdown-menu mega-menu-cat row clearfix">
                  @if(count($productCategoriesTree) > 0)
                    <?php $i = 1; $j = 0;?>
                    @foreach($productCategoriesTree as $cat)
                      @if($i == 1)
                      <?php $j++; ?>
                      <li class="col-xs-12 col-sm-4">  
                      @endif

                      <ul>
                        @if(isset($cat['parent']) && $cat['parent'] == 'Parent Category')  
                        <li class="dropdown-header">
                            @if( $cat['img_url'] )
                            <img src="{{ get_image_url($cat['img_url']) }}"> 
                            @else
                            <img src="{{ default_placeholder_img_src() }}"> 
                            @endif
                            
                            {!! $cat['name'] !!}
                        </li>
                        @endif
                        @if(isset($cat['children']) && count($cat['children']) > 0)
                          @foreach($cat['children'] as $cat_sub)
                            <li class="product-sub-cat"><a href="{{ route('categories-page', $cat_sub['slug']) }}">{!! $cat_sub['name'] !!}</a></li>
                            @if(isset($cat_sub['children']) && count($cat_sub['children']) > 0)
                              @include('pages.common.category-frontend-loop-home', $cat_sub)
                            @endif
                          @endforeach
                        @endif
                      </ul>

                      @if($i == 1)
                      </li>
                      <?php $i = 0;?>
                      @endif

                      @if($j == 3 || $j == 4)
                      <div class="clear-both"></div>
                      <?php $j = 0; ?>
                      @endif

                      <?php $i ++;?>
                    @endforeach
                  @endif
                </ul>
              </li>
              <li class="dropdown mega-dropdown">
                <a href="{{ url('#') }}" class="dropdown-toggle menu-name" data-toggle="dropdown"> Clothing <span class="caret"></span></a>
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
                        <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/socks">Socks</a></li>

                    </ul>

                  </li>
                  
                  
                  <li class="col-xs-12 col-sm-4">  
                    
                    <ul>
                      
                      <li class="dropdown-header">
                        <img src=""> 
                       TOPS
                        
                        
                      </li>
                       <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/blouses-shirts">Blouses / Shirts</a></li>
                          <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/jackets">Jackets</a></li>

                         <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/vests">Vests</a></li>
                         <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/cardigans">Cardigans</a></li>
                          <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/sweaters">Sweaters</a></li>


                      <li class="dropdown-header">
                        <img src=""> 
                       BOTTOMS
                        
                        
                      </li>
                       <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/pants">Pants</a></li>
                          <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/skirts">Skirts</a></li>

                         <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/panties">panties</a></li>

                         <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/jeans">Jeans</a></li>
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
                <a href="{{ url('#') }}" class="dropdown-toggle menu-name" data-toggle="dropdown"> Outerwear <span class="caret"></span></a>
                <ul class="dropdown-menu mega-dropdown-menu mega-menu-cat row clearfix">
                  <li class="col-xs-12 col-sm-4">  
                    
                    <ul>
                      
                      <li class="dropdown-header">
                        <img src=""> 
                        
                       OUTERWEAR
                      </li>
                      <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/coats-topcoats">Coats / Topcoats</a></li>
                      <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/abayas">Abayas</a></li>
                      <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/trench-coats">Trench Coats</a></li>
                      <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/coats">Coats</a></li>
                       <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/jackets">Jackets</a></li>
                        <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/puffer-jackets">Puffer Jackets</a></li>
                         <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/ponchos">Ponchos</a></li>

                        
                      
                    </ul>

                  </li>
                
                  <div class="clear-both"></div>
                  
                </ul>
              </li>
              <li class="dropdown mega-dropdown">
                <a href="{{ url('#') }}" class="dropdown-toggle menu-name" data-toggle="dropdown"> Plus Size <span class="caret"></span></a>
                <ul class="dropdown-menu mega-dropdown-menu mega-menu-cat row clearfix">
                  <li class="col-xs-12 col-sm-4">  
                    
                    <ul>
                      
                      <li class="dropdown-header">
                        <img src=""> 
                        
                        DRESSES
                      </li>
                      <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/p-size-dresses">P. Size Dresses</a></li>
                      <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/p-size-evening-dresses">P. Size Evening Dresses</a></li>
                      <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/p-size-tunics">P. Size Tunics</a></li>
                      <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/p-size-suits">P. Size Suits</a></li>

                        <li class="dropdown-header">
                        <img src=""> 
                        
                        OUTERWEAR
                      </li>

                      <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/p-size-abayas">P. Size Abayas</a></li>
                      <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/p-size-coats-topcoats">P. Size Coats/Topcoats</a></li>


                      <li class="dropdown-header">
                        <img src=""> 
                        
                        SWIMWEAR
                      </li>

                      <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/p-size-swimwear">P. Size Swimwear</a></li>
                       <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/p-size-tracksuit">P. Size Tracksuit</a></li>
                       

                    </ul>

                  </li>
                  
                  
                  <li class="col-xs-12 col-sm-4">  
                    
                    <ul>
                      
                      <li class="dropdown-header">
                        <img src=""> 
                       TOPS
                        
                        
                      </li>
                       <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/p-size-blouses-shirts">P. Size Blouses/Shirts</a></li>
                          <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/p-size-vests">P. Size Vests</a></li>

                         <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/p-size-cardigans">P. Size Cardigans</a></li>

                         <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/p-size-jackets">P. Size Jackets</a></li>
                         

                      <li class="dropdown-header">
                        <img src=""> 
                       BOTTOMS
                        
                        
                      </li>
                       <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/p-size-pants">P. Size Pants</a></li>
                          <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/p-size-skirts">P. Size Skirts</a></li>

                    </ul>

                  </li>
                
                  <div class="clear-both"></div>
                  
                </ul>
              </li>
              <li class="dropdown mega-dropdown">
                <a href="{{ url('#') }}" class="dropdown-toggle menu-name" data-toggle="dropdown"> Swimwear/Sportswear <span class="caret"></span></a>
                <ul class="dropdown-menu mega-dropdown-menu mega-menu-cat row clearfix">
                  <li class="col-xs-12 col-sm-4">  
                    
                    <ul>
                      
                      <li class="dropdown-header">
                        <img src=""> 
                        
                        SWIMWEAR
                      </li>
                      <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/covered-swimsuits">Covered Swimsuits</a></li>
                      <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/semi-covered-swimsuits">Semi-Covered Swimsuits</a></li>
                      <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/swimwear-styles-bikini">Swimwear Styles/Bikini</a></li>
                      

                        <li class="dropdown-header">
                        <img src=""> 
                        
                        SPORTSWEAR
                      </li>

                      <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/islamic-sportswear">Islamic Sportswear</a></li>
                      <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/pareo">Pareo</a></li>


                      
                       

                    </ul>

                  </li>
                  
                  </li>
                
                  <div class="clear-both"></div>
                  
                </ul>
              </li>
              <li class="dropdown mega-dropdown">
                <a href="{{ url('#') }}" class="dropdown-toggle menu-name" data-toggle="dropdown"> Shoes/Bags <span class="caret"></span></a>
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

                      <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/boots-booties">Boots / Booties</a></li>
                      <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/casual-shoes">Casual Shoes</a></li>
                      <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/high-heels">High Heels</a></li>
                       <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/sports-shoes">Sports Shoes</a></li>
                        <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/sandals-slippers">Sandals & Slippers</a></li>

                    </ul>

                  </li>
                  
                  </li>
                
                  <div class="clear-both"></div>
                  
                </ul>
              </li>
               <li class="dropdown mega-dropdown">
                <a href="{{ url('#') }}" class="dropdown-toggle menu-name" data-toggle="dropdown"> Designers <span class="caret"></span></a>
                <ul class="dropdown-menu mega-dropdown-menu mega-menu-cat row clearfix">
                  <li class="col-xs-12 col-sm-4">  
                    
                    <ul>
                      
                      <li class="dropdown-header">
                        <img src=""> 
                        
                       DESIGNERS
                      </li>
                      <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/kuaybe-gider">Kuaybe Gider</a></li>
                      <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/mayovera">Mayovera</a></li>
                      <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/minel-aşk">Minel Aşk</a></li>
                      <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/nurbanu-kural">Nurbanu Kural</a></li>
                       <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/mevrm">Mevra</a></li>
                        <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/gamze-Özkul">Gamze Özkul</a></li>
                         <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/pınar-Şems">Pınar Şems</a></li>
                         <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/muslima-wear">Muslima Wear</a></li>
                         <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/dersaadet">Dersaadet</a></li>
                         <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/nur-kombin">Nur Kombin</a></li>
                         <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/saliha">Saliha</a></li>
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
                <a href="{{ url('#') }}" class="dropdown-toggle menu-name" data-toggle="dropdown"> Evening Wear <span class="caret"></span></a>
                <ul class="dropdown-menu mega-dropdown-menu mega-menu-cat row clearfix">
                  <li class="col-xs-12 col-sm-4">  
                    
                    <ul>
                      
                      <li class="dropdown-header">
                        <img src=""> 
                        
                       EVENING WEAR
                      </li>
                      <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/evening-dresses-gowns">Evening Dresses & Gowns</a></li>
                      <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/evening-skirts">Evening Skirts</a></li>
                      <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/dressy-shawls-headwear">Dressy Shawls & Headwear</a></li>
                      <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/evening-suits">Evening Suits</a></li>
                       <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/evening-wear">Evening Wear</a></li>
                        
                        
                      
                    </ul>

                  </li>
                   <li class="col-xs-12 col-sm-4">  
                    
                    <ul>
                      
                      <li class="dropdown-header">
                        <img src=""> 
                      EVENING WEAR BRANDS
                        
                        
                      </li>
                       <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/dersaadet">Dersaadet</a></li>
                          <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/minel-aşk">Minel Aşk</a></li>

                         <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/mevra">Mevra</a></li>

                         <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/muslima-wear<">Muslima Wear</a></li>
                         <li class="product-sub-cat"><a href="http://islamicdressonline.com/product/categories/modaysa">Modaysa</a></li>
                         

                      
                      
                    </ul>

                  </li>
                
                  <div class="clear-both"></div>
                  
                </ul>
              </li>


             {{-- @if(Request::is('shop'))
                <li><a href="{{ route('shop-page') }}" class="main selected menu-name">{!! trans('frontend.all_products_label') !!}</a></li>
              @else
                <li><a href="{{ route('shop-page') }}" class="main menu-name">{!! trans('frontend.all_products_label') !!}</a></li>
              @endif--}}

             {{--@if(Request::is('checkout'))
                <li><a href="{{ route('checkout-page') }}" class="main selected menu-name">{!! trans('frontend.checkout') !!}</a></li>
              @else
                <li><a href="{{ route('checkout-page') }}" class="main menu-name">{!! trans('frontend.checkout') !!}</a></li>
              @endif

              @if(Request::is('cart'))
                <li><a href="{{ route('cart-page') }}" class="main selected menu-name">{!! trans('frontend.cart') !!}</a></li>
              @else
                <li><a href="{{ route('cart-page') }}" class="main menu-name">{!! trans('frontend.cart') !!}</a></li>
              @endif

              @if(Request::is('blogs'))
                <li><a href="{{ route('blogs-page-content') }}" class="main selected menu-name">{!! trans('frontend.blog') !!}</a></li>
              @else
                <li><a href="{{ route('blogs-page-content') }}" class="main menu-name">{!! trans('frontend.blog') !!}</a></li>
              @endif --}} 
              @if(count($pages_list) > 0)
              <li>
                <div class="dropdown custom-page">
                  <a class="dropdown-toggle menu-name" href="#" data-hover="dropdown" data-toggle="dropdown"> {!! trans('frontend.pages_label') !!} 
                    <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu">
                    @foreach($pages_list as $pages)
                    <li> <a href="{{ route('custom-page-content', $pages['post_slug']) }}">{!! $pages['post_title'] !!}</a></li>
                    @endforeach
                  </ul>
                </div>
              </li>
              @endif
            </ul>
          </div>
        </nav>
      </div>
    </div> 
  </div>    
</div>

@if($appearance_settings_data['header_details']['slider_visibility'] == true && Request::is('home'))
  <?php $count = count(get_appearance_header_settings_data());?>
  @if($count > 0)
  <div class="header-with-slider">
    <div id="slider-carousel" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        @for($i = 0; $i < $count; $i++)
          @if($i== 0)
            <li data-target="#slider-carousel" data-slide-to="{{ $i }}" class="active"></li>
          @else
            <li data-target="#slider-carousel" data-slide-to="{{ $i }}"></li>
          @endif
        @endfor                           
      </ol>

      <?php $numb = 1; ?>
      <div class="carousel-inner">
        @foreach(get_appearance_header_settings_data() as $img)
          @if($numb == 1)
            <div class="item active">
              @if($img->img_url)
                <img src="{{ get_image_url($img->img_url) }}" class="girl img-responsive" alt="" />
              @endif

              <?php if(isset($img->text)){?>
                <div class="dynamic-text-on-image-container">{!! $img->text !!}</div>
              <?php }?>
            </div>
          @else
            <div class="item">
              @if($img->img_url)
                <img src="{{ get_image_url($img->img_url) }}" class="girl img-responsive" alt="" />
              @endif

              <?php if(isset($img->text)){?>
                <div class="dynamic-text-on-image-container">{!! $img->text !!}</div>
              <?php }?>
            </div>
          @endif
          <?php $numb++ ; ?>
        @endforeach
      </div>
    </div>
  </div>

  @endif
@endif