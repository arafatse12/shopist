<?php
namespace shopist\Http\Controllers;

use shopist\Http\Controllers\Controller;
use shopist\Models\Post;
use shopist\Models\PostExtra;
use Carbon\Carbon;


class AdminDashboardController extends Controller
{
  public $carbonObject;
		
  public function __construct(){
		$this->carbonObject = new Carbon();
	}
		
	/**
   * 
   * Total product count
   *
   * @param null
   * @return integer
   */
	public function totalProducts(){
    $totalProducts  =  0;
	  $getProducts    =  Post::where(['post_type' => 'product'])->get()->toArray();
				
	  if(!empty($getProducts) && count($getProducts) > 0){
      $totalProducts = count($getProducts);
		}
				
		return $totalProducts;
	}
		
  /**
   * 
   * Today's orders count
   *
   * @param null
   * @return integer
   */
	public function todayOrders(){
		$todayOrders  =  0;
		$getTodayOrders  =  Post::whereDate('created_at', '=', $this->carbonObject->today()->toDateString())->where('post_type', 'shop_order')->get()->toArray();
				
		if(!empty($getTodayOrders) && count($getTodayOrders) > 0){
			$todayOrders = count($getTodayOrders);
		}
				
		return $todayOrders;
	}
		
	/**
   * 
   * Today's total sales count
   *
   * @param null
   * @return float
   */
	public function todayTotalSales(){
    $todaysTotal = 0;
		$getTodayOrders  =  Post::whereDate('created_at', '=', $this->carbonObject->today()->toDateString())->where('post_type', 'shop_order')->get()->toArray();
				 
    if(count($getTodayOrders) > 0){
      foreach($getTodayOrders as $rows){
        $get_order_total = PostExtra::where(['post_id' => $rows['id'], 'key_name' => '_order_total'])->first();

        if(!empty($get_order_total) && !empty($get_order_total->key_value)){
          $todaysTotal += $get_order_total->key_value;
        }
      }
    }
    
    return $todaysTotal;
	}
  
  /**
   * 
   * Total orders count
   *
   * @param null
   * @return integer
   */
	public function totalOrders(){
		$totalOrders  =  0;
		$getOrdersData  =  Post::where('post_type', 'shop_order')->get()->toArray();
				
		if(count($getOrdersData) > 0){
			$totalOrders = count($getOrdersData);
		}
				
		return $totalOrders;
	}
  
  /**
   * 
   * Latest orders
   *
   * @param null
   * @return array
   */
	public function latestOrders(){
    $latest_orders     =   array();
		$last2DaysOrders   =   Post::whereBetween('created_at', array($this->carbonObject->yesterday()->toDateString(), $this->carbonObject->today()->toDateString().' 23:59:59'))->where('post_type', 'shop_order')->orderBy('created_at', 'DESC')->get()->toArray();
    
    if(count($last2DaysOrders) > 0){
      foreach($last2DaysOrders as $rows){
			  $order_data = array();
			  $order_data['order_id']       =   $rows['id'];
			  $order_data['order_date']     =   $this->carbonObject->parse($rows['created_at'])->toDayDateTimeString();
        
        $order_status                 =   PostExtra::where(['post_id' => $rows['id'], 'key_name' => '_order_status'])->first();
        
        if(!empty($order_status->key_value)){
          $order_data['order_status'] =   $order_status->key_value;
        }
        
        $order_total                  =   PostExtra::where(['post_id' => $rows['id'], 'key_name' => '_order_total'])->first();
        
        if(!empty($order_total->key_value)){
          $order_data['order_totals'] =   $order_total->key_value;
        }
        
        $order_currency               =   PostExtra::where(['post_id' => $rows['id'], 'key_name' => '_order_currency'])->first();
        
        if(!empty($order_currency->key_value)){
          $order_data['order_currency'] =   $order_currency->key_value;
        }
			  
			  array_push($latest_orders, $order_data);
			}
    }
    
    return $latest_orders;
	}
  
  /**
   * 
   * Latest products
   *
   * @param null
   * @return array
   */
	public function latestProducts(){
    $latest_products  =   array();
		$getProducts      =   Post::whereBetween('created_at', array($this->carbonObject->yesterday()->toDateString(), $this->carbonObject->today()->toDateString().' 23:59:59'))->where(['post_type' => 'product'])->orderBy('created_at', 'DESC')->get()->toArray();
    
    if(count($getProducts) > 0){
      foreach($getProducts as $rows){
			  $product_data = array();
			  $parse_url    = json_decode(PostExtra::where(['post_id' => $rows['id'], 'key_name' => '_product_related_images_url'])->first()->key_value);  
        
			  $product_data['id'] = $rows['id'];
			  if($parse_url->product_image && $parse_url->product_image != '/images/upload.png'){
          $product_data['img_url'] = $parse_url->product_image;
			  }
			  else{
          $product_data['img_url'] = URL::to('/resources/assets/images/no-image.png');
			  }
			  
			  $product_data['title'] = $rows['post_title'];
			  if(get_product_type($rows['id']) == 'simple_product'){
          $product_data['price'] = get_current_currency_symbol().PostExtra::where(['post_id' => $rows['id'], 'key_name' => '_product_price'])->first()->key_value;
			  }
			  elseif (get_product_type($rows->id) == 'configurable_product') {
          $product_data['price'] = get_product_variations_min_to_max_price_html(get_current_currency_symbol(), $rows['id']);
			  }
			  elseif (get_product_type($rows->id) == 'customizable_product') {
          if(count(get_product_variations($rows['id']))>0){  
            $product_data['price'] = get_product_variations_min_to_max_price_html(get_current_currency_symbol(), $rows['id']);
          }
          else{  
            $product_data['price'] = get_current_currency_symbol().PostExtra::where(['post_id' => $rows['id'], 'key_name' => '_product_price'])->first()->key_value;
          }
			  }
			  
			  $product_data['description'] = $rows['post_content'];
			  
			  array_push($latest_products, $product_data);
			}
    }
    
    return $latest_products;
	}
}