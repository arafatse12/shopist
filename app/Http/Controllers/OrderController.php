<?php
namespace shopist\Http\Controllers;

use shopist\Http\Controllers\Controller;
use shopist\Models\Post;
use shopist\Models\DownloadExtra;
use Illuminate\Support\Facades\DB;


class OrderController extends Controller
{
  /**
   * 
   * Get order list
   *
   * @param all order or current date order
   * @return array
   */
  public function getOrderList( $order_track ){
    $order_data = array();
    if($order_track == 'all_order'){
      $order_data = Post::where('post_type', 'shop_order')->orderBy('id', 'DESC')->get()->toArray();
    }
    elseif($order_track == 'current_date_order'){
      $order_data = Post::whereDate('created_at', '=', $this->carbonObject->today()->toDateString())->where('post_type', 'shop_order')->get()->toArray();
    }
    
    return $order_data;
  }
  
  /**
   * 
   * Get order download history
   *
   * @param order_id
   * @return array
   */
  public function getOrderDownloadHistory( $order_id){
    $order_data = array();
    $get_order_data = DB::table('download_extras')
                      ->select('file_name', 'file_url', DB::raw('count(*) as total'))
                      ->where('order_id', $order_id)
                      ->groupBy('file_name', 'file_url')
                      ->get()->toArray();
    
    
    if(count($get_order_data) > 0){
      $order_data = $get_order_data;
    }
    
    return $order_data;
  }
}