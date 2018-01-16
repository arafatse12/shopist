<?php
namespace shopist\Http\Controllers;

use shopist\Http\Controllers\Controller;
use Validator;
use Request;
use Session;
use shopist\Models\Post;
use shopist\Models\PostExtra;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use shopist\Http\Controllers\OptionController;
use shopist\Models\Option;


class FeaturesController extends Controller
{
		public $option;
		public function __construct(){
			$this->option  =  new OptionController();	
		}
  /**
   * 
   * Save/Update coupon manager data
   *
   * @param null
   * @return response
   */
  public function saveCoupon($coupon_slug = null){
    if( Request::isMethod('post') && Session::token() == Input::get('_token') ){
      $data = Input::all();

      $rules =  [
                  'coupon_code'             => 'required',
                  'change_conditions_type'  => 'required',
                  'coupon_amount'           => 'required',
                  'inputUsageEndDate'       => 'required'
                ];

      $validator = Validator:: make($data, $rules);
      
      if($validator->fails()){
        return redirect()-> back()
        ->withInput()
        ->withErrors( $validator );
      }
      else{
        $check_coupon_id = Post::where(['post_title' => Input::get('coupon_code')])->first();
        
        if(empty($check_coupon_id) || (!empty($check_coupon_id) && $check_coupon_id->post_slug == $coupon_slug)){
          $today = date("Y-m-d");
          $usage_start_date = '';
          $usage_end_date   = '';

          if(Input::get('inputUsageEndDate') >= $today){
            $usage_end_date = Input::get('inputUsageEndDate');
          }

          $post       =    new Post;
          
          $post_slug = '';
          $check_slug  = Post::where(['post_slug' => string_slug_format( Input::get('coupon_code') )])->orWhere('post_slug', 'like', '%' . string_slug_format( Input::get('coupon_code') ) . '%')->get()->count();

          if($check_slug === 0){
            $post_slug = string_slug_format( Input::get('coupon_code') );
          }
          elseif($check_slug > 0){
            $slug_count = $check_slug + 1;
            $post_slug = string_slug_format( Input::get('coupon_code') ). '-' . $slug_count;
          }

          $is_shipping_free          =  'no';
          $usage_restriction_min     =  '';
          $usage_restriction_max     =  '';
          $usage_limit_per_coupon    =  '';
          
          if(Input::has('min_restriction_amount')){
            $usage_restriction_min = Input::get('min_restriction_amount');
          }

          if(Input::has('max_restriction_amount')){
            $usage_restriction_max = Input::get('max_restriction_amount');
          }

          if(Input::has('usage_limit_per_coupon')){
            $usage_limit_per_coupon = Input::get('usage_limit_per_coupon');
          }

         
          if(Input::get('hf_post_type') == 'add'){
            $post->post_author_id         =   Session::get('shopist_admin_user_id');
            $post->post_content           =   string_encode(Input::get('coupon_description'));
            $post->post_title             =   Input::get('coupon_code');
            $post->post_slug              =   $post_slug;
            $post->parent_id              =   0;
            $post->post_status            =   Input::get('coupon_visibility');
            $post->post_type              =   'user_coupon';

            if($post->save()){  
              if(PostExtra::insert(array(
                                        array(
                                              'post_id'       =>  $post->id,
                                              'key_name'      =>  '_coupon_condition_type',
                                              'key_value'     =>  Input::get('change_conditions_type'),
                                              'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
                                              'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
                                        ),
                                        array(
                                              'post_id'       =>  $post->id,
                                              'key_name'      =>  '_coupon_amount',
                                              'key_value'     =>  Input::get('coupon_amount'),
                                              'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
                                              'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
                                        ),
                                        array(
                                              'post_id'       =>  $post->id,
                                              'key_name'      =>  '_coupon_min_restriction_amount',
                                              'key_value'     =>  $usage_restriction_min,
                                              'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
                                              'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
                                        ),
                                        array(
                                              'post_id'       =>  $post->id,
                                              'key_name'      =>  '_coupon_max_restriction_amount',
                                              'key_value'     =>  $usage_restriction_max,
                                              'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
                                              'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
                                        ),
                                        array(
                                              'post_id'       =>  $post->id,
                                              'key_name'      =>  '_coupon_allow_role_name',
                                              'key_value'     =>  Input::get('user_role_usage_restriction'),
                                              'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
                                              'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
                                        ),
                                        array(
                                              'post_id'       =>  $post->id,
                                              'key_name'      =>  '_usage_limit_per_coupon',
                                              'key_value'     =>  $usage_limit_per_coupon,
                                              'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
                                              'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
                                        ),                      
                                        array(
                                              'post_id'       =>  $post->id,
                                              'key_name'      =>  '_usage_range_end_date',
                                              'key_value'     =>  Input::get('inputUsageEndDate'),
                                              'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
                                              'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
                                        )
              ))){
                Session::flash('success-message', Lang::get('admin.successfully_saved_msg') );
                Session::flash('update-message', "");
                return redirect()->route('admin.update_coupon_manager_content', $post->post_slug);
              }
            }
          }
          elseif(Input::get('hf_post_type') == 'update'){
            $coupon_data = Post::where(['post_slug' => $coupon_slug])->first();
            
            $data = array(
                        'post_author_id'	          =>  Session::get('shopist_admin_user_id'),
                        'post_content'	            =>  string_encode(Input::get('coupon_description')),
                        'post_title'               =>  Input::get('coupon_code'),
                        'post_status'              =>  Input::get('coupon_visibility')
            );
            if( Post::where('post_slug', $coupon_slug)->update($data)){
              $coupon_condition_type = array(
                                'key_value'    =>  Input::get('change_conditions_type')
              );
              
              $coupon_amount = array(
                                'key_value'    =>  Input::get('coupon_amount')
              );
              
              $coupon_min_restriction_amount = array(
                                'key_value'    =>  $usage_restriction_min
              );
              
              $coupon_max_restriction_amount = array(
                                'key_value'    =>  $usage_restriction_max
              );
              
              $coupon_allow_role_name = array(
                                'key_value'    =>  Input::get('user_role_usage_restriction')
              );
              
              $usage_limit_per_coupon = array(
                                'key_value'    =>  $usage_limit_per_coupon
              );
              
              $usage_range_end_date = array(
                                'key_value'    =>  Input::get('inputUsageEndDate')
              );
              
              PostExtra::where(['post_id' => $coupon_data->id, 'key_name' => '_coupon_condition_type'])->update($coupon_condition_type);
              PostExtra::where(['post_id' => $coupon_data->id, 'key_name' => '_coupon_amount'])->update($coupon_amount);
              PostExtra::where(['post_id' => $coupon_data->id, 'key_name' => '_coupon_min_restriction_amount'])->update($coupon_min_restriction_amount);
              PostExtra::where(['post_id' => $coupon_data->id, 'key_name' => '_coupon_max_restriction_amount'])->update($coupon_max_restriction_amount);
              PostExtra::where(['post_id' => $coupon_data->id, 'key_name' => '_coupon_allow_role_name'])->update($coupon_allow_role_name);
              PostExtra::where(['post_id' => $coupon_data->id, 'key_name' => '_usage_limit_per_coupon'])->update($usage_limit_per_coupon);
              PostExtra::where(['post_id' => $coupon_data->id, 'key_name' => '_usage_range_end_date'])->update($usage_range_end_date);
             
              Session::flash('update-message',  Lang::get('admin.successfully_saved_msg'));
              return redirect()->route('admin.update_coupon_manager_content', $coupon_slug);
            }
          }
        }
        else{
          Session::flash('success-message', Lang::get('admin.coupon_code_exists_msg') );
          return redirect()->back();
        }
      }
    }
  }
		
		/**
   * 
   * Get function for coupon
   *
   * @param slug
   * @return array
   */
		public function getCouponBySlug($slug){
				$coupon_data = array();
				$get_coupon_data_by_id = Post::where(['post_slug' => $slug , 'post_type' => 'user_coupon'])->first();
				
				if(!empty($get_coupon_data_by_id)){
						$get_coupon_postmeta   = PostExtra::where(['post_id' => $get_coupon_data_by_id->id])->get()->toArray();

						$coupon_data['post_id']          = $get_coupon_data_by_id->id;
						$coupon_data['post_author_id']   = $get_coupon_data_by_id->post_author_id;
						$coupon_data['post_content']     = $get_coupon_data_by_id->post_content;
						$coupon_data['post_title']       = $get_coupon_data_by_id->post_title;
						$coupon_data['post_slug']        = $get_coupon_data_by_id->post_slug;
						$coupon_data['parent_id']        = $get_coupon_data_by_id->parent_id;
						$coupon_data['post_status']      = $get_coupon_data_by_id->post_status;
						$coupon_data['post_type']        = $get_coupon_data_by_id->post_type;


						if(count($get_coupon_postmeta) >0){

								foreach($get_coupon_postmeta as $key => $val){
										if($val['key_name'] == '_coupon_condition_type'){
												$coupon_data['coupon_condition_type'] = $val['key_value'];
										}
										elseif($val['key_name'] == '_coupon_amount'){
												$coupon_data['coupon_amount'] = $val['key_value'];
										}
										elseif($val['key_name'] == '_coupon_shipping_allow_option'){
												$coupon_data['coupon_shipping_allow_option'] = $val['key_value'];
										}
										elseif($val['key_name'] == '_coupon_min_restriction_amount'){
												$coupon_data['coupon_min_restriction_amount'] = $val['key_value'];
										}
										elseif($val['key_name'] == '_coupon_max_restriction_amount'){
												$coupon_data['coupon_max_restriction_amount'] = $val['key_value'];
										}
										elseif($val['key_name'] == '_usage_limit_per_coupon'){
												$coupon_data['usage_limit_per_coupon'] = $val['key_value'];
										}
										elseif($val['key_name'] == '_coupon_allow_role_name'){
												$coupon_data['coupon_allow_role_name'] = $val['key_value'];
										}
										elseif($val['key_name'] == '_usage_range_start_date'){
												$coupon_data['usage_range_start_date'] = $val['key_value'];
										}
										elseif($val['key_name'] == '_usage_range_end_date'){
												$coupon_data['usage_range_end_date'] = $val['key_value'];
										}
								}
						}
				}		
				
				return $coupon_data;
		}
		
	/**
   * 
   * Get coupon list data
   *
   * @param pagination, search value, status flag
   * @param pagination required. Boolean type TRUE or FALSE, by default false
   * @param search value optional
	  * @param status flag by default -1. -1 for all data, 1 for status enable and 0 for disable status
   * @return array
   */
	public function getCouponListData( $pagination = false, $search_val = null, $status_flag = -1){
    $coupon_data  = array();
    
    if($status_flag == -1){
        $where = ['post_type' => 'user_coupon'];
    }
    else{
        $where = ['post_status' => $status_flag, 'post_type' => 'user_coupon'];
    }
				
    if($search_val && $search_val != ''){
      $get_coupon_data = Post::where($where)
																								 ->where('post_title', 'LIKE', $search_val.'%')  
																									->get()
																									->toArray();
    }
    else{
      $get_coupon_data =  Post::where($where)
																									->get()
																									->toArray();
    }
				
				if(count($get_coupon_data) > 0){
      foreach($get_coupon_data as $row){
        if(isset($row['id'])){
           array_push($coupon_data, $this->getCouponPostExtra( $row['id'], $row ));
        }
      }
    }
    	
    if($pagination){
      $currentPage = LengthAwarePaginator::resolveCurrentPage();
      $col = new Collection( $coupon_data );
      $perPage = 10;
      $currentPageSearchResults = $col->slice(($currentPage - 1) * $perPage, $perPage)->all();
      $coupon_object = new LengthAwarePaginator($currentPageSearchResults, count($col), $perPage);

      $coupon_object->setPath( route('admin.coupon_manager_list') );
    }
    
    if($pagination){
      return $coupon_object;
    }
    else{
      return $coupon_data;
    }
  }
		
		/**
   * Get coupon post extra data
   *
   * @param post_id, array
   * @return array
   */
  public function getCouponPostExtra( $post_id, $data ){
    $arr = $data;
    $get_coupon_postmeta   = PostExtra::where(['post_id' => $post_id])->get()->toArray();
    
    if(count($get_coupon_postmeta) >0 && count($arr) > 0){
      foreach($get_coupon_postmeta as $key => $val){
        if( isset($val['key_name']) && $val['key_name'] == '_coupon_condition_type'){
          $arr['coupon_condition_type'] = $val['key_value'];
        }
        elseif( isset($val['key_name']) && $val['key_name'] == '_coupon_amount'){
          $arr['coupon_amount'] = $val['key_value'];
        }
        elseif( isset($val['key_name']) && $val['key_name'] == '_coupon_shipping_allow_option'){
          $arr['coupon_shipping_allow_option'] = $val['key_value'];
        }
        elseif( isset($val['key_name']) && $val['key_name'] == '_coupon_min_restriction_amount'){
          $arr['coupon_min_restriction_amount'] = $val['key_value'];
        }
        elseif( isset($val['key_name']) && $val['key_name'] == '_coupon_max_restriction_amount'){
          $arr['coupon_max_restriction_amount'] = $val['key_value'];
        }
        elseif( isset($val['key_name']) && $val['key_name'] == '_usage_limit_per_coupon'){
          $arr['usage_limit_per_coupon'] = $val['key_value'];
        }
        elseif( isset($val['key_name']) && $val['key_name'] == '_coupon_allow_role_name'){
          $arr['coupon_allow_role_name'] = get_role_name_by_role_slug($val['key_value']);
        }
        elseif( isset($val['key_name']) && $val['key_name'] == '_usage_range_start_date'){
          $arr['usage_range_start_date'] = $val['key_value'];
        }
        elseif( isset($val['key_name']) && $val['key_name'] == '_usage_range_end_date'){
          $arr['usage_range_end_date'] = $val['key_value'];
        }
      }
    }
    
    return $arr;
  }
		
  /**
   * 
   * Update SEO data
   *
   * @param null
   * @return response
   */
  public function updateSeoData(){
    if( Request::isMethod('post') && Session::token() == Input::get('_token') ){
      $seo_data  =   $this->option->getSEOData();
      
      if(isset($seo_data['meta_tag']['meta_keywords'])){
        $seo_data['meta_tag']['meta_keywords'] = Input::get('inputMetaKeywords'); 
      }
      if(isset($seo_data['meta_tag']['meta_description'])){
        $seo_data['meta_tag']['meta_description'] = Input::get('inputMetaDescription'); 
      }
      
      $data = array(
                   'option_value'        => serialize($seo_data)
      );
      
      if( Option::where('option_name', '_seo_data')->update($data)){
        Session::flash('success-message', Lang::get('admin.successfully_updated_msg'));
        return redirect()->back();
      }
    } 
  }
  
  /**
   * 
   * Save/Update compare data
   *
   * @param null
   * @return response
   */
	public function saveProductCompareMoreFields(){
    if( Request::isMethod('post') && Session::token() == Input::get('_token') ){
      
      $input = '';
      if(count(Input::get('product_compare_field_title')) > 0){
        $input = json_encode(Input::get('product_compare_field_title'));
      }
      
      $get_compare_option = $this->option->getCompareOption();
      if(!empty($get_compare_option)){
        $data = array(
                    'option_value' =>	 $input,
                );

        if(Option::where('option_name', '_product_compare_more_fields_name')->update($data)){
            Session::flash('success-message', Lang::get('admin.successfully_updated_msg'));
        }
      }
      else{
        if(Option::insert(
            array(
                  'option_name'  =>  '_product_compare_more_fields_name',
                  'option_value' =>	 $input,
                  'created_at'   =>  date("y-m-d H:i:s", strtotime('now')),
                  'updated_at'   =>  date("y-m-d H:i:s", strtotime('now'))
            ))){
            Session::flash('success-message', Lang::get('admin.successfully_saved_msg'));
        }
      }
      
      return redirect()-> back();
    }
	}
}