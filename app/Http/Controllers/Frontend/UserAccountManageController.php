<?php
namespace shopist\Http\Controllers\Frontend;

use shopist\Http\Controllers\Controller;
use Request;
use Cookie;
use Hash;
use shopist\Models\User;
use shopist\Models\Option;
use shopist\Library\CommonFunction;
use Illuminate\Support\Facades\Lang;
use Validator;
use Illuminate\Support\Facades\Session;
use shopist\Models\UsersDetail;
use Illuminate\Support\Facades\Input;
use shopist\Models\Post;
use shopist\Models\PostExtra;
use shopist\Models\OrdersItem;
use Carbon\Carbon;
use shopist\Http\Controllers\OptionController;

class UserAccountManageController extends Controller
{
  public $frontendUserData          =  array();  
  public $payment                   =  array();
  public $classCommonFunction;
  public $frontendJsLocalization;
  public $carbonObject;



  public function __construct() 
  { 
    $this->classCommonFunction     = new CommonFunction();
    $option  =  new OptionController();
    
    $this->frontendUserData['_settings_data']   = $option->getSettingsData();
    $this->payment = $option->getPaymentMethodData();
    
    $this->carbonObject = new Carbon();
  }
  
  /**
   * 
   *Manage frontend user dashboard
   *
   * @param id
   * @return response 
   */
  public function goToDifferentPages($params = null, $params2 = null)
  {
    //if user not logged in, it will go for login page
    $getRoutePrefix = trim(Request::route()->getPrefix(), '/');
    
    if( isset($getRoutePrefix) && $getRoutePrefix == 'user' && !Session::has('shopist_frontend_user_id') ){
      return redirect()->route('user-login-page');
    }
	else{
    
      $this->classCommonFunction->set_frontend_lang();
      if( Request::is('user/account/my-address') || Request::is('user/account/my-address/edit') || Request::is('user/account/my-address/add') || Request::is('user/account/my-saved-items') ){
        $get_current_user_id = get_current_frontend_user_info();
        $get_data_by_user_id = get_user_account_details_by_user_id( $get_current_user_id['user_id'] );
        $get_array_shift_data = array_shift($get_data_by_user_id);

        $this->frontendUserData['frontend_account_details'] = json_decode($get_array_shift_data['details']);
      }
    
      if(Request::is('user/account/my-profile')){
        $get_current_user_id = get_current_frontend_user_info();
        $this->frontendUserData['user_details'] = get_user_details( $get_current_user_id['user_id'] );
      }
      
      if(Request::is('user/account/my-orders') || Request::is('user/account/download')){
        $this->frontendUserData['orders_list_data'] = array();
        
        $get_shop_order_data = Post::where(['post_author_id' => Session::get('shopist_frontend_user_id'), 'post_status' => 1, 'post_type' => 'shop_order'])->orderBy('id', 'DESC')->get()->toArray();
        
        if(count($get_shop_order_data) > 0){
          $order_list_data = array();
          
          foreach($get_shop_order_data as $row){
            $downloadData = array();
            $get_postmeta_by_order_id = PostExtra::where(['post_id' => $row['id']])->get()->toArray();
            
            if(count($get_postmeta_by_order_id) > 0){
              $order_postmeta = array();
              $date_format    = new Carbon( $row['created_at']);


              $order_postmeta['_post_id']    = $row['id'];
              $order_postmeta['_order_date'] = $date_format->toDayDateTimeString();

              foreach($get_postmeta_by_order_id as $postmeta_row){
                if( $postmeta_row['key_name'] == '_order_status' || $postmeta_row['key_name'] == '_order_total' || $postmeta_row['key_name'] == '_order_currency' || $postmeta_row['key_name'] == '_final_order_total' || $postmeta_row['key_name'] == '_order_process_key'){
                $order_postmeta[$postmeta_row['key_name']] = $postmeta_row['key_value'];
                }
              }
              
              if(Request::is('user/account/download')){
                $get_order_data_by_id = OrdersItem::where(['order_id' => $row['id']])->first();
                $parse_order_data     = json_decode($get_order_data_by_id->order_data, true);
                
                if(!empty($parse_order_data) && count($parse_order_data) > 0){
                  foreach($parse_order_data as $product){
                    if($product['product_type'] == 'downloadable_product'){
                      array_push($downloadData, $product);
                    }
                  }
                }

                $order_postmeta['_download_history'] = $downloadData;
              }
              
              array_push($order_list_data, $order_postmeta);
            }
          }
          
          
          $this->frontendUserData['orders_list_data']   =   $order_list_data;
        }
      }
      
      if(!empty($params) && $params > 0 && !empty($params2) && $params2 >0 && Request::is('user/account/order-details/*')){
        $get_order_data = $this->classCommonFunction->get_order_details_by_order_id(array('order_id' => $params, 'order_process_id' => $params2));
        
        if(count($get_order_data) > 0){
          $this->frontendUserData['order_details_by_order_id'] = $get_order_data;
        }
        else{
          $this->frontendUserData['order_details_by_order_id'] = array();
        }
      }
      
      if(Request::is('user/account/my-coupons')){
        $coupon_data = array();
        $get_current_user_id = get_current_frontend_user_info();
        
        if(!empty($get_current_user_id) && count($get_current_user_id) > 0){
          $get_post_meta = PostExtra::where(['key_name' => '_coupon_allow_role_name', 'key_value' => $get_current_user_id['user_role_slug']])->get()->toArray();
          if(!empty($get_post_meta) && count($get_post_meta) > 0){
            foreach($get_post_meta as $row){
              $get_post = Post::where(['id' => $row['post_id']])->first();
              $get_post_meta_all = PostExtra::where(['post_id' => $row['post_id']])->get()->toArray();
              
              if(!empty($get_post)){
                $data['coupon_code']        = $get_post->post_title;
                $data['coupon_status']      = $get_post->post_status;
                $data['coupon_description'] = $get_post->post_content;
              }
              
              if(!empty($get_post_meta_all) && count($get_post_meta_all) > 0){
                foreach($get_post_meta_all as $post_meta_row){
                  if($post_meta_row['key_name'] == '_coupon_condition_type'){
                    if($post_meta_row['key_value'] == 'discount_from_product'){
                      $data['coupon_condition_type'] = Lang::get('frontend.coupon_condition_discount_product');
                    }
                    elseif($post_meta_row['key_value'] == 'percentage_discount_from_product'){
                      $data['coupon_condition_type'] = Lang::get('frontend.coupon_condition_percentage_discount_product');
                    }
                    elseif($post_meta_row['key_value'] == 'discount_from_total_cart'){
                      $data['coupon_condition_type'] = Lang::get('frontend.coupon_condition_discount_from_total_cart');
                    }
                    elseif($post_meta_row['key_value'] == 'percentage_discount_from_total_cart'){
                      $data['coupon_condition_type'] = Lang::get('frontend.coupon_condition_percentage_discount_from_total_cart');
                    }
                    
                  }
                  elseif($post_meta_row['key_name'] == '_coupon_amount'){
                    $data['coupon_amount'] = $post_meta_row['key_value'];
                  }
                  elseif($post_meta_row['key_name'] == '_coupon_min_restriction_amount'){
                    $data['coupon_min_restriction_amount'] = $post_meta_row['key_value'];
                  }
                  elseif($post_meta_row['key_name'] == '_coupon_max_restriction_amount'){
                    $data['coupon_max_restriction_amount'] = $post_meta_row['key_value'];
                  }
                  elseif($post_meta_row['key_name'] == '_coupon_allow_role_name'){
                    $data['coupon_allow_role_name'] = $post_meta_row['key_value'];
                  }
                  elseif($post_meta_row['key_name'] == '_usage_limit_per_coupon'){
                    $data['usage_limit_per_coupon'] = $post_meta_row['key_value'];
                  }
                  elseif($post_meta_row['key_name'] == '_usage_range_end_date'){
                    $data['usage_range_end_date'] = $post_meta_row['key_value'];
                  }
                }
              }
              
              array_push($coupon_data, $data);
            }
          }     
        }
        
        $this->frontendUserData['login_user_coupon_data'] =  $coupon_data;
      }
      
      if(Request::is('user/account/dashboard') || Request::is('user/account')){
        $dashboard_total['total_order']   = 0;
        $dashboard_total['todays_order']  = 0;
        $dashboard_total['recent_coupon'] = 0;
          
        $get_current_user_id = get_current_frontend_user_info();
        
        if(!empty($get_current_user_id) && count($get_current_user_id) > 0){
          $total_order  = Post::where(['post_author_id' => $get_current_user_id['user_id'], 'post_type' => 'shop_order'])->get()->toArray();
          $todays_order = Post::whereDate('created_at', '=', $this->carbonObject->today()->toDateString())->where(['post_author_id' => $get_current_user_id['user_id'], 'post_type' => 'shop_order'])->get()->toArray();
          $recent_coupon = PostExtra::where(['key_name' => '_coupon_allow_role_name', 'key_value' => $get_current_user_id['user_role_slug']])->get()->toArray();
          
          $dashboard_total['total_order']   = count($total_order);
          $dashboard_total['todays_order']  = count($todays_order);
          $dashboard_total['recent_coupon'] = count($recent_coupon);  
        }
        $this->frontendUserData['dashboard_data'] =  $dashboard_total;
      }
      
      $this->frontendUserData['login_user_details'] =  get_current_frontend_user_info();
      $get_data  =   $this->classCommonFunction->get_dynamic_frontend_content_data( $this->frontendUserData );
      
      return view('pages.frontend.frontend-main', $get_data);
    }
  }
  
  /**
   * 
   * Save/Update frontend user account data
   *
   * @param null
   * @return null
   */
  function saveUserAccountData(){
    if( Request::isMethod('post') && Session::token() == Input::get('_token') ){
      if(Input::get('_account_post_type') == 'address'){
        $rules = [
                 'account_bill_first_name'                  =>  'required',
                 'account_bill_last_name'                   =>  'required',
                 'account_bill_email_address'               =>  'required|email',
                 'account_bill_select_country'              =>  'required',
                 'account_bill_adddress_line_1'             =>  'required',
                 'account_bill_town_or_city'                =>  'required',
                 'account_bill_zip_or_postal_code'          =>  'required',
                 
                 'account_shipping_first_name'              =>  'required',
                 'account_shipping_last_name'               =>  'required',
                 'account_shipping_email_address'           =>  'required|email',
                 'account_shipping_select_country'          =>  'required',
                 'account_shipping_adddress_line_1'         =>  'required',
                 'account_shipping_town_or_city'            =>  'required',
                 'account_shipping_zip_or_postal_code'      =>  'required',
                 
        ];
        
        $messages = [
                    'account_bill_first_name.required' => Lang::get('validation.account_bill_first_name'),
                    'account_bill_last_name.required' => Lang::get('validation.account_bill_last_name'),
                    'account_bill_email_address.required' => Lang::get('validation.account_bill_email_address'),
                    'account_bill_email_address.email' => Lang::get('validation.account_bill_email_address_is_email'),
                    'account_bill_select_country.required' => Lang::get('validation.account_bill_select_country'),
                    'account_bill_adddress_line_1.required' => Lang::get('validation.account_bill_adddress_line_1'),
                    'account_bill_town_or_city.required' => Lang::get('validation.account_bill_town_or_city'),
                    'account_bill_zip_or_postal_code.required' => Lang::get('validation.account_bill_zip_or_postal_code'),
                    'account_shipping_first_name.required' => Lang::get('validation.account_shipping_first_name'),
                    'account_shipping_last_name.required' => Lang::get('validation.account_shipping_last_name'),
                    'account_shipping_email_address.required' => Lang::get('validation.account_shipping_email_address'),
                    'account_shipping_email_address.email' => Lang::get('validation.account_shipping_email_address_is_email'),
                    'account_shipping_select_country.required' => Lang::get('validation.account_shipping_select_country'),
                    'account_shipping_adddress_line_1.required' => Lang::get('validation.account_shipping_adddress_line_1'),
                    'account_shipping_town_or_city.required' => Lang::get('validation.account_shipping_town_or_city'),
                    'account_shipping_zip_or_postal_code.required' => Lang::get('validation.account_shipping_zip_or_postal_code')
        ];
      
        $validator = Validator::make(Input::all(), $rules, $messages);
        
        if($validator->fails()){
          return redirect()-> back()
          ->withInput()
          ->withErrors( $validator );
        }
        else{
          
          $address_data_ary = array();
          $address_data_ary['account_bill_title']                   =         Input::get('account_bill_title');
          $address_data_ary['account_bill_company_name']            =         Input::get('account_bill_company_name');
          $address_data_ary['account_bill_first_name']              =         Input::get('account_bill_first_name');
          $address_data_ary['account_bill_last_name']               =         Input::get('account_bill_last_name');
          $address_data_ary['account_bill_email_address']           =         Input::get('account_bill_email_address');
          $address_data_ary['account_bill_phone_number']            =         Input::get('account_bill_phone_number');
          $address_data_ary['account_bill_select_country']          =         Input::get('account_bill_select_country');
          $address_data_ary['account_bill_adddress_line_1']         =         Input::get('account_bill_adddress_line_1');
          $address_data_ary['account_bill_adddress_line_2']         =         Input::get('account_bill_adddress_line_2');
          $address_data_ary['account_bill_town_or_city']            =         Input::get('account_bill_town_or_city');
          $address_data_ary['account_bill_zip_or_postal_code']      =         Input::get('account_bill_zip_or_postal_code');
          $address_data_ary['account_bill_fax_number']              =         Input::get('account_bill_fax_number');
          
          $address_data_ary['account_shipping_title']               =         Input::get('account_shipping_title');
          $address_data_ary['account_shipping_company_name']        =         Input::get('account_shipping_company_name');
          $address_data_ary['account_shipping_first_name']          =         Input::get('account_shipping_first_name');
          $address_data_ary['account_shipping_last_name']           =         Input::get('account_shipping_last_name');
          $address_data_ary['account_shipping_email_address']       =         Input::get('account_shipping_email_address');
          $address_data_ary['account_shipping_phone_number']        =         Input::get('account_shipping_phone_number');
          $address_data_ary['account_shipping_select_country']      =         Input::get('account_shipping_select_country');
          $address_data_ary['account_shipping_adddress_line_1']     =         Input::get('account_shipping_adddress_line_1');
          $address_data_ary['account_shipping_adddress_line_2']     =         Input::get('account_shipping_adddress_line_2');
          $address_data_ary['account_shipping_town_or_city']        =         Input::get('account_shipping_town_or_city');
          $address_data_ary['account_shipping_zip_or_postal_code']  =         Input::get('account_shipping_zip_or_postal_code');
          $address_data_ary['account_shipping_fax_number']          =         Input::get('account_shipping_fax_number');
          
          $address_data = array('post_type' => 'address', 'details' => $address_data_ary);
          
         
          if($this->classCommonFunction->frontendUserAccountDataProcess( $address_data )){
            Session::flash('message', Lang::get('frontend.address_saved_msg'));
            return redirect()->route('my-address-page');
          }
          
        }
      }
    }
    else{
      return redirect()-> back();
    }
  }
  
  /**
   * 
   * Update frontend user profile data
   *
   * @param null
   * @return void
   */
  public function updateFrontendUserProfile()
  {
    if( Request::isMethod('post') && Session::token() == Input::get('_token') )
    {
      $input = Input::all();
      $rules = [
               'display_name'                  =>  'required',
               'user_name'                     =>  'required',
               'email_id'                      =>  'required|email',
               ];

      if(Input::get('password'))
      {
        $rules['password']             =   'min:5';                 
      }

      $validator = Validator:: make($input, $rules);

      if($validator->fails())
      {
        return redirect()-> back()
        ->withInput()
        ->withErrors( $validator );
      }
      else
      {
        $is_user_name_exists = User::where(['name' => Input::get('user_name')])->first();
        $is_email_exists     = User::where(['email' => Input::get('email_id')])->first();
        
        if($is_user_name_exists && $is_user_name_exists->id != Session::get('shopist_frontend_user_id'))
        {
          Session::flash('error-message', Lang::get('validation.unique', ['attribute' => 'user name']));
          return redirect()->back();
        } 
        
        if($is_email_exists && $is_email_exists->id != Session::get('shopist_frontend_user_id'))
        {
          Session::flash('error-message', Lang::get('validation.unique', ['attribute' => 'email id']));
          return redirect()->back();
        } 

        $data = array(
                      'display_name'         =>    Input::get('display_name'),
                      'name'                 =>    Input::get('user_name'),
                      'email'                =>    Input::get('email_id')
        );

        if(Input::get('password'))
        {
          $data['password'] = bcrypt(Input::get('password'));
        }

        if(Input::get('hf_frontend_profile_picture'))
        {
          $data['user_photo_url'] = Input::get('hf_frontend_profile_picture');
        }
        else
        {
          $data['user_photo_url'] = '';
        }

        if(User::where('id', Session::get('shopist_frontend_user_id'))->update($data))
        {
          Session::flash('message', Lang::get('frontend.profile_updated_msg'));
          return redirect()->back();
        }
      }
    }
    else 
    {
      return redirect()-> back();
    }
  }
  
  /**
   * 
   * Frontend user logout
   *
   * @param null
   * @return response
   */
  public function userLogout(){
    if(is_frontend_user_logged_in() && Request::isMethod('post') && Session::token() == Input::get('_token')){
      Session::forget('shopist_frontend_user_id');
      return redirect()->route('user-login-page');
    }
  }
}
