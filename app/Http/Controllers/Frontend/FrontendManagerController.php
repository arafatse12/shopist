<?php
namespace shopist\Http\Controllers\Frontend;

use shopist\Http\Controllers\Controller;
use Request;
use Illuminate\Support\Facades\Input;
use shopist\Models\Option;
use shopist\Library\GetFunction;
use shopist\Models\Post;
use shopist\Models\PostExtra;
use Anam\Phpcart\Cart;
use shopist\Models\SaveCustomDesign;
use shopist\Models\DownloadExtra;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Lang;
use Cookie;
use Hash;
use shopist\Models\UsersDetail;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

use shopist\Http\Controllers\ProductsController;
use shopist\Library\CommonFunction;
use shopist\Http\Controllers\CMSController;
use shopist\Http\Controllers\OptionController;
use shopist\Models\OrdersItem;

class FrontendManagerController extends Controller
{
  public $designer_settings         = array();
  public $payment                   = array();
  public $frontendData              = array();  
  public $classGetFunction;
  public $cart;
  public $frontendJsLocalization;
  
  public $product;
  public $classCommonFunction;
  public $CMS;
  public $option;
  public $download;

  public function __construct() 
  {
    $this->product  =  new ProductsController();
    $this->classCommonFunction  = new CommonFunction();
    $this->cart = new Cart();
    $this->classGetFunction     = new GetFunction();
    $this->CMS                  =  new CMSController();
    $this->option               =  new OptionController();
    $this->download = 'saved';
    
    $this->frontendData['_settings_data']   = $this->option->getSettingsData();
    $this->payment = $this->option->getPaymentMethodData();
  }
  
  /**
   * 
   *Manage frontend page
   *
   * @param id
   * @return void 
   */
  public function goToDifferentPages($params = null, $params2 = null)
  {
    //language setting option
    $this->classCommonFunction->set_frontend_lang();   
    $getAllProductPostDataById   =   array();
    
    
   				
    if(Request::is('home')){
      //$this->frontendData['_categories_products_all']  =   $this->classGetFunction->get_categories_products();
      $this->frontendData['advancedData']              =   $this->product->getAdvancedProducts();
      $this->frontendData['brands_data']               =   $this->product->getTermData( 'product_brands', false, null, 1 );
      $this->frontendData['testimonials_data']         =   get_all_testimonial_data();
    }
    
    if(Request::is('shop')){
      $sort = null;
      $price_min = null;
      $price_max = null;
      $selected_colors = null;
      $selected_sizes = null;
      
      if(isset($_GET['sort_by'])){
        $sort = $_GET['sort_by'];
      }
      
      if(isset($_GET['price_min'])){
        $price_min = $_GET['price_min'];
      }
      
      if(isset($_GET['price_max'])){
        $price_max = $_GET['price_max'];
      }
      
      if(isset($_GET['selected_colors'])){
        $selected_colors = $_GET['selected_colors'];
      }

      if(isset($_GET['selected_sizes'])){
        $selected_sizes = $_GET['selected_sizes'];
      }
      
      $this->frontendData['brands_data']        =   $this->product->getTermData( 'product_brands', false, null, 1 );
      $this->frontendData['advancedData']       =   $this->product->getAdvancedProducts();
      $this->frontendData['popular_tags_list']  =   $this->product->getTermData( 'product_tag', false, null, 1 );
      $this->frontendData['colors_list_data']   =   $this->product->getTermData( 'product_colors', false, null, 1 );
			$this->frontendData['sizes_list_data']    =   $this->product->getTermData( 'product_sizes', false, null, 1 );
      
      $get_product  =  $this->product->getFilterProductsDataWithPagination(array('sort' => $sort, 'price_min' => $price_min, 'price_max' => $price_max, 'selected_colors' => $selected_colors, 'selected_sizes' => $selected_sizes));
      
      if(count($get_product) > 0){
        $this->frontendData['all_products_details'] = $get_product;
        
        if(count($this->frontendData['all_products_details']) > 0){
          $this->frontendData['all_products_details']['action_url'] = Request::url();

          $currentQuery = Request::query();

          if(count($currentQuery) > 0){
            if(isset($currentQuery['view'])){
              unset($currentQuery['view']);
            }

            if(count($currentQuery) > 0){
              $currentQuery['view'] = 'list';
              $this->frontendData['all_products_details']['action_url_list_view'] = Request::url(). '?' . http_build_query($currentQuery);
              $currentQuery['view'] = 'grid';
              $this->frontendData['all_products_details']['action_url_grid_view'] = Request::url(). '?' . http_build_query($currentQuery);
            }
            else{
              $this->frontendData['all_products_details']['action_url_list_view'] = Request::url(). '?view=list';
              $this->frontendData['all_products_details']['action_url_grid_view'] = Request::url(). '?view=grid';
            }
          }
          else{
            $this->frontendData['all_products_details']['action_url_list_view'] = Request::url(). '?view=list';
            $this->frontendData['all_products_details']['action_url_grid_view'] = Request::url(). '?view=grid';
          }

          if(isset($_GET['view']) && $_GET['view'] == 'list'){
            $this->frontendData['all_products_details']['selected_view'] = 'list'; 
          }
          elseif(isset($_GET['view']) && $_GET['view'] == 'grid'){
            $this->frontendData['all_products_details']['selected_view'] = 'grid'; 
          }
          else{
            $this->frontendData['all_products_details']['selected_view'] = 'grid';
          }
        }
      }
      else{
        return view('errors.no_data');
      }
    }
    
    if(Request::is('product/categories/*')){
      //$this->frontendData['_categories_products_all']  =   $this->classGetFunction->get_categories_products();
      $this->frontendData['brands_data']        =   $this->product->getTermData( 'product_brands', false, null, 1 );
			$this->frontendData['colors_list_data']   =   $this->product->getTermData( 'product_colors', false, null, 1 );
			$this->frontendData['sizes_list_data']    =   $this->product->getTermData( 'product_sizes', false, null, 1 );
    }
    
    if(Request::is('product/customize/*')){
      $this->designer_settings = $this->option->getCustomDesignerSettingsData();
      $this->frontendData['art_cat_lists_data']  =   $this->product->getTermData( 'designer_cat', false, null, 1 );
    }
    
    if($params && (Request::is('product/details/*') || Request::is('product/customize/*'))){
      $get_post = Post::where(['post_slug' => $params, 'post_status' => 1])->get()->toArray();
      
      if(count($get_post) > 0){
        $get_current_user_data  =  get_current_frontend_user_info();
        $array_shift = array_shift($get_post);
        $product_id  = $array_shift['id'];
        $this->frontendData['single_product_details']   =   $this->product->getProductDataById( $product_id );
        
        
        if(is_frontend_user_logged_in() && isset($get_current_user_data['user_role_slug']) && $this->frontendData['single_product_details']['_is_role_based_pricing_enable'] == 'yes'){
          if(isset($this->frontendData['single_product_details']['_role_based_pricing'][$get_current_user_data['user_role_slug']])){

            $regular_price = $this->frontendData['single_product_details']['_role_based_pricing'][$get_current_user_data['user_role_slug']]['regular_price'];
            $sale_price = $this->frontendData['single_product_details']['_role_based_pricing'][$get_current_user_data['user_role_slug']]['sale_price'];

            if(isset($regular_price) && $regular_price && isset($sale_price) && $sale_price && $regular_price > $sale_price){
              $this->frontendData['single_product_details']['offer_price'] = get_product_price_html_by_filter($regular_price);
              $this->frontendData['single_product_details']['solid_price'] = get_product_price_html_by_filter($sale_price);
            }
            elseif(isset($regular_price) && $regular_price){
              $this->frontendData['single_product_details']['offer_price'] = null;
              $this->frontendData['single_product_details']['solid_price'] = get_product_price_html_by_filter($regular_price);
            }
            else{
              $this->frontendData['single_product_details']['offer_price'] = null;
              $this->frontendData['single_product_details']['solid_price'] = 0;
            }
          }
        }  
        else{
          if($this->frontendData['single_product_details']['_product_regular_price'] && $this->frontendData['single_product_details']['_product_regular_price'] >0 && $this->frontendData['single_product_details']['_product_sale_price'] && $this->frontendData['single_product_details']['_product_sale_price']>0 && $this->frontendData['single_product_details']['_product_regular_price'] > $this->frontendData['single_product_details']['_product_sale_price'] ){
            $this->frontendData['single_product_details']['offer_price'] = get_product_price_html_by_filter($this->frontendData['single_product_details']['_product_regular_price']);
          }
          else{
            $this->frontendData['single_product_details']['offer_price'] = null;
          }

          $this->frontendData['single_product_details']['solid_price']   = get_product_price_html_by_filter($this->frontendData['single_product_details']['_product_price']);
        }
        
								
        $this->frontendData['single_product_details']['is_user_login']   = 'no';
        $this->frontendData['single_product_details']['login_user_slug'] = '';

        if(is_frontend_user_logged_in()){
          $this->frontendData['single_product_details']['is_user_login'] = 'yes';
        }

        if(count($get_current_user_data) > 0 && isset($get_current_user_data['user_role_slug'])){
          $this->frontendData['single_product_details']['login_user_slug'] = $get_current_user_data['user_role_slug'];
        }
        
        if(Cookie::has('shopist_multi_currency')){
          $current_currency_name = get_current_currency_name();
          $to_currency    =  Cookie::get('shopist_multi_currency');
        }
								
        $product_url = default_placeholder_img_src();
        $this->frontendData['product_zoom_image'] = $product_url;
        
        if($this->frontendData['single_product_details']['_product_related_images_url']->product_image){
          $product_url = $this->frontendData['single_product_details']['_product_related_images_url']->product_image;
          $this->frontendData['product_zoom_image'] = $this->classCommonFunction->createZoomImageUrl( $product_url );
        }
        
        $this->frontendData['single_product_details']['_product_related_images_url']->product_image = $product_url;
        
        
        $product = (object) array('id' => time(), 'url' => $product_url);
        $this->frontendData['single_product_details']['_product_related_images_url']->product_gallery_images[0] = $product;
        
        $gallery_images = $this->frontendData['single_product_details']['_product_related_images_url']->product_gallery_images;
        if(count($gallery_images) > 0){
          foreach($gallery_images as $images){
            $images->zoom_img_url = $this->classCommonFunction->createZoomImageUrl( $images->url );
          }
        }
        
        $this->frontendData['attr_lists']               =   $this->product->getAllAttributes( $product_id );
        $this->frontendData['related_items']            =   $this->product->getRelatedItems( $product_id );  
        $this->frontendData['comments_details']         =   get_comments_data_by_object_id( $product_id, 'product' );
        $this->frontendData['comments_rating_details']  =   get_comments_rating_details( $product_id, 'product' );
        
        $get_seo_data = get_seo_data();
        
        if(isset($get_seo_data['meta_tag']['meta_keywords']) && isset($this->frontendData['single_product_details']['_product_seo_keywords'])){
          $this->frontendData['single_product_details']['meta_keywords'] = trim( trim($get_seo_data['meta_tag']['meta_keywords'], ','). ',' .trim($this->frontendData['single_product_details']['_product_seo_keywords'], ','), ',');
        }
        elseif(!isset($get_seo_data['meta_tag']['meta_keywords']) && isset($this->frontendData['single_product_details']['_product_seo_keywords'])){
          $this->frontendData['single_product_details']['meta_keywords'] = trim($this->frontendData['single_product_details']['_product_seo_keywords'], ',');
        }
        elseif(isset($get_seo_data['meta_tag']['meta_keywords']) && !isset($this->frontendData['single_product_details']['_product_seo_keywords'])){
          $this->frontendData['single_product_details']['meta_keywords'] = trim($get_seo_data['meta_tag']['meta_keywords'], ',');
        }
        else{
          $this->frontendData['single_product_details']['meta_keywords'] = null;
        }
        
        $this->frontendData['upsell_products'] = get_upsell_products( $product_id );
      }
      else{
        return view('errors.no_data');
      }
    }
    
    if($params && Request::is('product/categories/*')){
      $sort = null;
      $price_min = null;
      $price_max = null;
      $selected_colors = null;
      $selected_sizes = null;
      
      if(isset($_GET['sort_by'])){
        $sort = $_GET['sort_by'];
      }
      
      if(isset($_GET['price_min'])){
        $price_min = $_GET['price_min'];
      }
      
      if(isset($_GET['price_max'])){
        $price_max = $_GET['price_max'];
      }
      
      if(isset($_GET['selected_colors'])){
        $selected_colors = $_GET['selected_colors'];
      }

      if(isset($_GET['selected_sizes'])){
        $selected_sizes = $_GET['selected_sizes'];
      }
      
      $get_cat_product_and_breadcrumb  =  $this->product->getProductByCatSlug($params, array('sort' => $sort, 'price_min' => $price_min, 'price_max' => $price_max, 'selected_colors' => $selected_colors, 'selected_sizes' => $selected_sizes));
      
      if(count($get_cat_product_and_breadcrumb) > 0){
        $this->frontendData['product_by_cat_id'] = $get_cat_product_and_breadcrumb;
      }
      else{
        return view('errors.no_data');
      }
      
       
      if(count($this->frontendData['product_by_cat_id']) > 0){
        $this->frontendData['product_by_cat_id']['action_url'] = Request::url();
        
        $currentQuery = Request::query();
        
        if(count($currentQuery) > 0){
          if(isset($currentQuery['view'])){
            unset($currentQuery['view']);
          }
          
          if(count($currentQuery) > 0){
            $currentQuery['view'] = 'list';
            $this->frontendData['product_by_cat_id']['action_url_list_view'] = Request::url(). '?' . http_build_query($currentQuery);
            $currentQuery['view'] = 'grid';
            $this->frontendData['product_by_cat_id']['action_url_grid_view'] = Request::url(). '?' . http_build_query($currentQuery);
          }
          else{
            $this->frontendData['product_by_cat_id']['action_url_list_view'] = Request::url(). '?view=list';
            $this->frontendData['product_by_cat_id']['action_url_grid_view'] = Request::url(). '?view=grid';
          }
        }
        else{
          $this->frontendData['product_by_cat_id']['action_url_list_view'] = Request::url(). '?view=list';
          $this->frontendData['product_by_cat_id']['action_url_grid_view'] = Request::url(). '?view=grid';
        }
        
        if(isset($_GET['view']) && $_GET['view'] == 'list'){
          $this->frontendData['product_by_cat_id']['selected_view'] = 'list'; 
        }
        elseif(isset($_GET['view']) && $_GET['view'] == 'grid'){
          $this->frontendData['product_by_cat_id']['selected_view'] = 'grid'; 
        }
        else{
          $this->frontendData['product_by_cat_id']['selected_view'] = 'grid';
        }
      }
    }
    
    if($params && Request::is('categories/blog/*')){
      $get_cat_post  =   $this->CMS->getBlogPostByCatSlug($params);
      
      if(count($get_cat_post) > 0){
        $this->frontendData['blogs_cat_post']     =   $get_cat_post;
        $this->frontendData['advanced_data']      =   $this->CMS->get_blog_advanced_data();
        $this->frontendData['categoriesTree']     =   $this->product->get_categories(0, 'blog_cat');
      }
      else{
        return view('errors.no_data');
      }
    }
    
    if($params && Request::is('blog/*')){
      $get_blog_details_by_slug = $this->CMS->get_blog_by_slug($params);
      
      if(count($get_blog_details_by_slug) > 0 && isset($get_blog_details_by_slug['post_status']) && $get_blog_details_by_slug['post_status'] == 1){
        $object_id = 0;
        
        if(isset($get_blog_details_by_slug['id'])){
          $object_id = $get_blog_details_by_slug['id'];
        }
        
        $this->frontendData['advanced_data']            =   $this->CMS->get_blog_advanced_data($object_id);
        $this->frontendData['blog_details_by_slug']     =   $get_blog_details_by_slug;
        $this->frontendData['comments_details']         =   get_comments_data_by_object_id( $object_id, 'blog' );
        $this->frontendData['comments_rating_details']  =   get_comments_rating_details( $object_id, 'blog' );
        
        if(!Session::has('shopist_blog_count') || (Session::has('shopist_blog_count') && Session::get('shopist_blog_count') != $get_blog_details_by_slug['id'])){  
          $get_post_meta =  PostExtra::where(['post_id' => $get_blog_details_by_slug['id'], 'key_name' => '_count_visit'])->first();

          if(!empty($get_post_meta)){
              $new_value = array(
                                'key_value'    =>  $get_post_meta->key_value + 1
              );

              PostExtra::where(['post_id' => $get_blog_details_by_slug['id'], 'key_name' => '_count_visit'])->update($new_value);
          }
          else{
              PostExtra::insert(array(
                      array(
                          'post_id'       =>      $get_blog_details_by_slug['id'],
                          'key_name'      =>      '_count_visit',
                          'key_value'     =>      1,
                          'created_at'    =>      date("y-m-d H:i:s", strtotime('now')),
                          'updated_at'    =>      date("y-m-d H:i:s", strtotime('now'))
                      )
              ));
          }

          Session::put('shopist_blog_count', $get_blog_details_by_slug['id']);
      }
        
        $get_seo_data = get_seo_data();
        
        if(isset($get_seo_data['meta_tag']['meta_keywords']) && isset($this->frontendData['blog_details_by_slug']['blog_seo_keywords'])){
          $this->frontendData['blog_details_by_slug']['meta_keywords'] = trim( trim($get_seo_data['meta_tag']['meta_keywords'], ','). ',' .trim($this->frontendData['blog_details_by_slug']['blog_seo_keywords'], ','), ',');
        }
        elseif(!isset($get_seo_data['meta_tag']['meta_keywords']) && isset($this->frontendData['blog_details_by_slug']['blog_seo_keywords'])){
          $this->frontendData['blog_details_by_slug']['meta_keywords'] = trim($this->frontendData['blog_details_by_slug']['blog_seo_keywords'], ',');
        }
        elseif(isset($get_seo_data['meta_tag']['meta_keywords']) && !isset($this->frontendData['blog_details_by_slug']['blog_seo_keywords'])){
          $this->frontendData['blog_details_by_slug']['meta_keywords'] = trim($get_seo_data['meta_tag']['meta_keywords'], ',');
        }
        else{
          $this->frontendData['blog_details_by_slug']['meta_keywords'] = null;
        }
      }
      else{
        return view('errors.no_data');
      }
    }
    
    if($params && Request::is('testimonial/*')){
      $testimonial_arr = array();
      $get_testimonial = get_testimonial_data_by_slug($params);
      
      if(count($get_testimonial) > 0 && isset($get_testimonial['post_status']) && $get_testimonial['post_status'] == 1){
        $this->frontendData['testimonials_data_by_slug'] =  $get_testimonial;
        $get_testimonials_data                           =   get_all_testimonial_data(1);
        
        if(count($get_testimonials_data) > 0){
          foreach($get_testimonials_data as $data){
            if($data['post_slug'] != $params){
              array_push($testimonial_arr, $data);
            }
          }
        }
        
        if(count($testimonial_arr) > 0){
          $this->frontendData['testimonials_data'] = $testimonial_arr;
        }
        else{
          $this->frontendData['testimonials_data'] = array();
        }
      }
      else{
        return view('errors.no_data');
      }
    }
    
    if($params && Request::is('brand/*')){
      $get_brand_details_by_slug = $this->product->getBrandDataBySlug( $params );
     
      if(count($get_brand_details_by_slug) > 0){
        $this->frontendData['brand_details_by_slug'] = $get_brand_details_by_slug;
      }
      else{
        return view('errors.no_data');
      }
    }
    
    if(Request::is('blogs')){
      $this->frontendData['blogs_all_data']         =   get_all_blogs_data(1);
      $this->frontendData['categoriesTree']         =   $this->product->get_categories(0, 'blog_cat');
      $this->frontendData['advanced_data']          =   $this->CMS->get_blog_advanced_data();
    }
    
    if(Request::is('cart') || Request::is('checkout')){
      $get_shipping_data = Option :: where('option_name', '_shipping_method_data')->first();
      $this->frontendData['shipping_data'] = unserialize($get_shipping_data->option_value);
      
      $get_payment_option = Option :: where('option_name', '_payment_method_data')->first();
      $this->frontendData['payment_method_data'] = unserialize($get_payment_option->option_value);
      $this->frontendData['stripe_api_key'] = json_encode(get_stripe_api_key());
      
      //coupon applay
      if($this->cart->is_coupon_applyed() && !empty($this->cart->couponCode())){
        $response = $this->classGetFunction->manage_coupon($this->cart->couponCode(), 'update');
        
        if($response == 'coupon_already_apply' || $response == 'less_from_min_amount' || $response == 'exceed_from_max_amount' || $response == 'no_login' || $response == 'user_role_not_match' || $response == 'coupon_expired' || $response == 'exceed_from_cart_total' || $response == 'no_coupon_data'){
          $this->cart->remove_coupon();
          Session::flash('error-message', Lang::get('validation.coupon_removed_from_cart_msg' ));
        }
      }  
    }
    
    if(Request::is('cart')){
      if($this->cart->getItems()->count() > 0){
        $product_id = array();
        $cross_sell_products = array();
        
        foreach($this->cart->getItems() as $item){
          array_push($product_id, $item->product_id);
          $get_cross_sell_products = get_crosssell_products($item->product_id);
          
          if(count($get_cross_sell_products) > 0){
            $cross_sell_products = array_merge($cross_sell_products, $get_cross_sell_products);
          }
        }
        
        $unique_1 = array_unique($product_id); 
        $unique_2 = array_unique($cross_sell_products); 
        
        $final_unique_cross_sell_products = array_diff($unique_2, $unique_1);
        $this->frontendData['cross_sell_products'] = $final_unique_cross_sell_products;
      }
    }
    
    if(Request::is('checkout')){
      $is_user_login = false;
      $get_user_login_data = get_current_frontend_user_info();
      $user_account_parse_data = null;
            
      if(Session::has('shopist_frontend_user_id') && isset($get_user_login_data['user_id'])){
        $is_user_login = true;
        $get_data_by_user_id     =  get_user_account_details_by_user_id( $get_user_login_data['user_id'] ); 
        $get_array_shift_data    =  array_shift($get_data_by_user_id);
        $user_account_parse_data =  json_decode($get_array_shift_data['details']);
        
        if(!empty($user_account_parse_data)){
          $user_account_parse_data = $user_account_parse_data;
        }
      }
      
      $this->frontendData['is_user_login'] = $is_user_login;
      $this->frontendData['login_user_account_data'] = $user_account_parse_data;
    }
    
    if($params && Request::is('product/customize/*')){
      $get_post = Post::where(['post_slug' => $params, 'post_status' => 1])->get()->toArray();
      
      if(count($get_post) > 0){
        $array_shift = array_shift($get_post);
        $product_id  = $array_shift['id'];
      
        $getAllProductPostDataById  =  $this->product->getProductDataById($product_id);
        
        if($getAllProductPostDataById['_product_custom_designer_settings']['enable_global_settings'] == 'yes'){
          if(count($this->designer_settings)>0){
            $this->frontendData['designer_hf_data'] = $this->designer_settings['general_settings'];
          }
        }
        elseif($getAllProductPostDataById['_product_custom_designer_settings']['enable_global_settings'] == 'no'){
          if(count($getAllProductPostDataById['_product_custom_designer_settings']) >0){
            $this->frontendData['designer_hf_data'] = $getAllProductPostDataById['_product_custom_designer_settings'];
          }
        }
        
        $get_data = SaveCustomDesign ::where('product_id', $product_id)->first();

        if(!empty($get_data)){
          $this->frontendData['design_json_data'] = $get_data['design_data'];
        }
      }
      else{
        return view('errors.no_data');
      }   
    }
    
    if($params && $params2 && Request::is('checkout/order-received/*')){
      $get_order_data = $this->classCommonFunction->get_order_details_by_order_id(array('order_id' => $params, 'order_process_id' => $params2));
      
      if(count($get_order_data) > 0){
        $get_order_data['settings'] = $this->option->getSettingsData();  
        $this->frontendData['order_details_for_thank_you_page'] = $get_order_data;
      }
      else{
        $this->frontendData['order_details_for_thank_you_page'] = array();
      }
    }

    if($params && Request::is('product/tag/*')){
      $get_tag_by_slug = get_products_by_product_tag_slug( $params );
      
      if(count($get_tag_by_slug) > 0){
        $this->frontendData['tag_single_details']   =   $get_tag_by_slug;
        $this->frontendData['popular_tags_list']    =   $this->product->getTermData( 'product_tag', false, null, 1 );
      }
      else{
        return view('errors.no_data');
      }
    }
				
    if(!empty($params) && Request::is('page/*')){
      $get_page_by_filter = Post :: where(['post_slug' => $params, 'post_status' => 1, 'post_type' => 'page'])->first();

      if(!empty($get_page_by_filter)){
          $this->frontendData['page_data'] = $get_page_by_filter;
      }
      else{
          return view('errors.no_data');
      }
    }
				
    if(Request::is('product/comparison')){
      $this->frontendData['compare_product_data']  = array();
      $this->frontendData['compare_product_label'] = null;
      
      $compare_data     =  $this->option->getProductCompareData();
      $custom_data      =  array('Image', 'Product', 'Price');
            
      if(!empty($compare_data)){
        $this->frontendData['compare_product_label'] = (object) array_merge($custom_data, (array) $compare_data);
      }
      else{
        $this->frontendData['compare_product_label'] = (object) $custom_data;
      }
      

      if(Session::has('shopist_selected_compare_product_ids') && count(Session::get('shopist_selected_compare_product_ids')) > 0){
        $get_comparison_product = Session::get('shopist_selected_compare_product_ids');

        foreach($get_comparison_product as $product){
          array_push($this->frontendData['compare_product_data'],	$this->product->getProductDataById( $product ));
        }
      }
    }
    
    $this->frontendData['productCategoriesTree']   =   $this->product->get_categories(0, 'product_cat');
    if(Session::has('shopist_selected_compare_product_ids') && count(Session::get('shopist_selected_compare_product_ids')) > 0){
      $this->frontendData['total_compare_item'] = count(Session::get('shopist_selected_compare_product_ids'));
    }
    else{
      $this->frontendData['total_compare_item'] = 0;
    }
    
    $this->frontendData['current_parent_cat'] = get_product_parent_categories();
    $this->frontendData['pages_list'] = $this->CMS->get_pages(false, null, 1);
    $get_data = $this->classCommonFunction->get_dynamic_frontend_content_data( $this->frontendData ); 
    $get_data['seo_data'] = get_seo_data();
    $get_data['subscriptions_data'] = get_subscription_settings_data();
    
    $is_subscribe_cookie_exists = false;
    if(Cookie::has('subscribe_popup_not_needed') && Cookie::get('subscribe_popup_not_needed') == 'no_need'){
      $is_subscribe_cookie_exists = true;
    }
    
    $get_data['is_subscribe_cookie_exists'] = $is_subscribe_cookie_exists;
    $get_data['appearance_settings_data'] = get_appearance_settings();

    //dd($get_data);         
    
    return view('pages.frontend.frontend-main', $get_data);
  }
  
  /**
   * 
   *Manage for cart page
   *
   * @param null
   * @return void 
   */
  public function doActionFromCartPage(){
    $data = Input::all();
            
    if( Request::isMethod('post') && isset($data['empty_cart']) && Session::token() == Input::get('_token')){
      $this->cart->clear();
      return redirect()->back();
    }
    elseif( Request::isMethod('post') && isset($data['update_cart']) && Session::token() == Input::get('_token')){
      if(count($data['cart_quantity']) > 0){
        foreach($data['cart_quantity'] as $key => $qty){
          $this->cart->updateQty($key, $qty);
        }
      }
      return redirect()->back();
    }
    elseif( Request::isMethod('post') && isset($data['checkout']) && Session::token() == Input::get('_token')){
      if($this->cart->getItems()){
        foreach($this->cart->getItems() as $items){
          if($items->variation_id && count($items->options) > 0){
            $variation_product_data = $this->classCommonFunction->get_variation_and_data_by_post_id( $items->variation_id );
            
            if($variation_product_data['_variation_post_price'] == 0){
              Session::flash('message', Lang::get('frontend.sorry_label') .' '. get_product_title($variation_product_data['parent_id']) .' '. Lang::get('frontend.price_zero_validation'));
              $this->cart->clear();
              return redirect()->back();
            }

            if($variation_product_data['_variation_post_manage_stock'] == 1){
              if($variation_product_data['_variation_post_manage_stock_qty'] == 0){
                Session::flash('message', Lang::get('frontend.sorry_label') .' '.get_product_title($variation_product_data['parent_id']) .' '. Lang::get('frontend.stock_validation'));
                $this->cart->clear();
                return redirect()->back();
              }

              if(isset($this->cart->get($items->id)->quantity)){
               $cat_qty = $this->cart->get($items->id)->quantity;

               if($cat_qty > $variation_product_data['_variation_post_manage_stock_qty']){
                 Session::flash('message', Lang::get('frontend.sorry_label') .' '.get_product_title($variation_product_data['parent_id']) .' '. Lang::get('frontend.stock_validation'));
                 $this->cart->clear();
                 return redirect()->back();
               }
              }
            }
          }
          else{
            $product_data = $this->classCommonFunction->get_product_data_by_product_id( $items->id );
          
            if($product_data['product_price'] == 0){
              Session::flash('message', Lang::get('frontend.sorry_label') .' '.$product_data['post_title'] .' '. Lang::get('frontend.price_zero_validation'));
              $this->cart->clear();
              return redirect()->back();
            }

            if($product_data['product_manage_stock'] == 'yes'){
              if($product_data['product_manage_stock_qty'] == 0){
                Session::flash('message', Lang::get('frontend.sorry_label') .' '.$product_data['post_title'] .' '. Lang::get('frontend.stock_validation'));
                $this->cart->clear();
                return redirect()->back();
              }

              if(isset($this->cart->get($items->id)->quantity)){
               $cat_qty = $this->cart->get($items->id)->quantity;

               if($cat_qty > $product_data['product_manage_stock_qty']){
                 Session::flash('message', Lang::get('frontend.sorry_label') .' '.$product_data['post_title'] .' '. Lang::get('frontend.stock_validation'));
                 $this->cart->clear();
                 return redirect()->back();
               }
              }
            }
          }
        }
        
        return redirect()->route('checkout-page');
      }
    }
  }

  /**
   * 
   *Item remove from cart
   *
   * @param item id
   * @return void
   */
  public function doActionForRemoveItem( $item_id )
  {
    if($item_id){
      if( $this->cart->remove( $item_id ) ){
        return redirect()->back();
      }
    }
  }
  
  /**
   * 
   *Remove compare product from list
   *
   * @param product id
   * @return void
   */
  public function doActionForRemoveCompareProduct( $product_id )
  {
    if($product_id){
      if(Session::has('shopist_selected_compare_product_ids') && count(Session::get('shopist_selected_compare_product_ids')) > 0){
        $array = array();
        foreach(Session::get('shopist_selected_compare_product_ids') as $val){
          if($val != $product_id){
            array_push($array, $val);
          }
        }
        
        Session::forget('shopist_selected_compare_product_ids');
        Session::put('shopist_selected_compare_product_ids', $array);
        
        return redirect()->back();
      }
    }
  }
  
  /**
   * 
   * Force file download for downloadable product
   *
   * @param product id, file key
   * @return void
   */
  public function forceDownload( $post_id, $order_id, $file_key, $target ){
    $get_orders_items  =   OrdersItem::where(['order_id' => $order_id])->first();
    
    if(!empty($get_orders_items)){
      $orders_items = json_decode( $get_orders_items->order_data, TRUE );
    }
    
    if( $this->classCommonFunction->checkDownloadRequired( $orders_items[$post_id]['download_data'], $order_id ) && isset($orders_items[$post_id]['download_data']['downloadable_files'][$file_key]) && isset($orders_items[$post_id]['download_data']['downloadable_files'][$file_key][$target]) ){
      $parse_url = explode('uploads', $orders_items[$post_id]['download_data']['downloadable_files'][$file_key][$target]);
   
      if(count($parse_url) > 0 && isset($parse_url[1])){
        $file_path = public_path().'/uploads'.$parse_url[1];
        
        if(File::exists($file_path)){
          $get_extension = File::extension($file_path);
          $get_content_type = File::mimeType($file_path);

          if(!empty($get_extension) && !empty($get_content_type)){
            $filename = time().'-'.uniqid(true).'.'.$get_extension;
            
            $user_id = 0;
            $get_post = PostExtra::where(['post_id' => $order_id, 'key_name' => '_order_process_key'])->first();

            if(is_frontend_user_logged_in()){
              $get_user_info = get_current_frontend_user_info();
              $user_id = $get_user_info['user_id'];
            }
            
            $headers = array(
              'Content-Type:'.$get_content_type,
            );
            
            //save download data
            $downloadextra = new DownloadExtra;
            $downloadextra->post_id      =   $post_id;
            $downloadextra->order_id     =   $order_id;
            $downloadextra->order_key		 =   $get_post->key_value;
            $downloadextra->user_id			 =   $user_id;
            $downloadextra->file_name		 =   $orders_items[$post_id]['download_data']['downloadable_files'][$file_key]['file_name'];
            $downloadextra->file_url		 =   $parse_url[1];
            
            if($downloadextra->save()){
              return Response::download($file_path, $filename, $headers);
            }
          }
        } 
      }
    }
  }
}