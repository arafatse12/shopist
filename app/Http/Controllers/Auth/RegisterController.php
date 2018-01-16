<?php

namespace shopist\Http\Controllers\Auth;

use shopist\Http\Controllers\Controller;
use shopist\Models\Role;
use shopist\Models\User;
use shopist\Models\RoleUser;
use shopist\Models\Option;
use Illuminate\Support\Facades\Input;
use Validator;
use Request;
use Cookie;
use Session;
use Illuminate\Support\Facades\Lang;
use shopist\Models\ManageLanguage;
use shopist\Library\CommonFunction;
use shopist\Models\UserRolePermission;
use shopist\Http\Controllers\OptionController;

use shopist\Http\Controllers\AdminDashboardController;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation.
    |
    */
  
    public $classCommonFunction;
    public $settingsData = array();
    public $recaptchaData = array();
    public $option;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
	    $this->middleware('verifyLoginPage');
      $this->classCommonFunction  =  new CommonFunction();
      $this->recaptchaData     =  get_recaptcha_data();
      $this->option  = new OptionController();
      
      $this->settingsData['_settings_data']   = $this->option->getSettingsData();
    }
    
  /**
   * 
   * Redirect to installation process
   *
   * @param null
   * @return response
   */
    
  public function redirectToInstallationProcess(){
    $this->classCommonFunction->set_admin_lang();
    if($this->classCommonFunction->is_shopist_admin_installed()){
      return redirect()->route('admin.login');
    }
    else{
      return view('pages.auth.install');
    }
  }
  
  /**
   * 
   * Redirect to user registration
   *
   * @param null
   * @return response
   */
    
  public function redirectToUserRegistrationProcess(){
    $data  = array(); 
    $this->classCommonFunction->set_frontend_lang();
    
    $data['target']   =   'empty_check';
    $get_data         =   $this->classCommonFunction->get_dynamic_frontend_content_data( $data );
    $get_data['is_enable_recaptcha'] = $this->recaptchaData['enable_recaptcha_for_user_registration'];
    
    return view('pages.auth.user-registration')->with($get_data);
  }
  
  /**
   * 
   * Save installation data
   *
   * @param null
   * @return response
   */
  public function installationDataSave(){
    if(!$this->classCommonFunction->is_shopist_admin_installed()){
      if( Request::isMethod('post') && Session::token() == Input::get('_token')){
        $data = Input::all();
        
        $rules = [
          'display_name'               => 'required',
          'user_name'                  => 'required|unique:users,name',
          'email_id'                   => 'required|email|unique:users,email',
          'password'                   => 'required|min:5|confirmed',
          'password_confirmation'      => 'required|min:5',
          'secret_key'                 => 'required'
        ];
        
        $messages = [
          'display_name.required' => Lang::get('validation.display_name_required'),
          'user_name.required' => Lang::get('validation.user_name_required'),
          'user_name.unique' => Lang::get('validation.user_name_unique'),
          'email_id.required' => Lang::get('validation.email_required'),
          'email_id.unique' => Lang::get('validation.email_unique'),
          'email_id.email' => Lang::get('validation.email_is_email'),
          'password.required' => Lang::get('validation.password_required'),
          'password_confirmation.required' => Lang::get('validation.password_confirmation_required'),
          'secret_key.required' => Lang::get('validation.secret_key_required')
        ];
        
        $validator = Validator:: make($data, $rules, $messages);
        
        if($validator->fails()){
          return redirect()-> back()
          ->withInput()
          ->withErrors( $validator );
        }
        else{
          $User =       new User;
          $Role =       new Role;
          $Roleuser =   new RoleUser;
          $Option =     new Option;
          
          if(Role::insert(
            array(
              array(
                  'role_name'       =>    'Administrator',
                  'slug'            =>    'administrator',
                  'created_at'      =>    date("y-m-d H:i:s", strtotime('now')),
                  'updated_at'      =>    date("y-m-d H:i:s", strtotime('now'))
              ),
              array(
                  'role_name'       =>    'Site User',
                  'slug'            =>    'site-user',
                  'created_at'      =>    date("y-m-d H:i:s", strtotime('now')),
                  'updated_at'      =>    date("y-m-d H:i:s", strtotime('now'))
              )
            )
          )){
              $User->display_name       =    Input::get('display_name');
              $User->name               =    Input::get('user_name');
              $User->email              =    Input::get('email_id');
              $User->password           =    bcrypt( trim(Input::get('password')) );
              $User->user_photo_url     =    '';
              $User->user_status        =    1;
              $User->secret_key         =    bcrypt( trim(Input::get('secret_key')) );
              
              if($User->save()){
                $roleArray      =   ['slug' => 'administrator'];
                $get_user_role  =   Role::where($roleArray)->first();
                
                $Roleuser->user_id    =    $User->id;
                $Roleuser->role_id    =    $get_user_role->id;
                
                if($Roleuser->save()){
                  $bacs_desc = Lang::get('admin.bacs_desc');
                  $bacs_ins = Lang::get('admin.bacs_ins');
                  $cod_desc = Lang::get('admin.cod_desc');
                  $cod_ins = Lang::get('admin.cod_ins');
                  $paypal_desc = Lang::get('admin.paypal_desc');
                  $stripe_desc = Lang::get('admin.stripe_desc');
                  
                  $shipping_method_array = array( 
                    'shipping_option'  => array('enable_shipping' => '', 'display_mode' => 'radio_buttons'),
                    'flat_rate'        => array('enable_option' => '', 'method_title' => Lang::get('admin.flat_rate'), 'method_cost' => ''),
                    'free_shipping'    => array('enable_option' => '', 'method_title' => Lang::get('admin.free_shipping'), 'order_amount' => ''),
                    'local_delivery'   => array('enable_option' => '', 'method_title' => Lang::get('admin.local_delivery'), 'fee_type' => '', 'delivery_fee' => '')
                  );
                  
                  $settings_array = array( 
                    'general_settings'  => 
                    array(
                      'general_options'     => array('site_title' => 'Shopist', 'email_address' => 'yourEmail@domain.com', 'site_logo' => '', 'allow_registration_for_frontend' => true, 'default_role_slug_for_site' => 'site-user'),
                      'taxes_options'       => array('enable_status' => 0, 'apply_tax_for' => '', 'tax_amount' => ''),
                      'checkout_options'    => array('enable_guest_user' => true, 'enable_login_user' => true),
                      'downloadable_products_options'    => array('login_restriction' => false, 'grant_access_from_thankyou_page' => true, 'grant_access_from_email' => false),  
                      'recaptcha_options'   => array('enable_recaptcha_for_admin_login' => false, 'enable_recaptcha_for_user_login' => false, 'enable_recaptcha_for_user_registration' => false, 'recaptcha_secret_key' => '', 'recaptcha_site_key' => ''),
                      'currency_options'    => array('currency_name' => 'USD', 'currency_position' => 'left', 'thousand_separator' => ',', 'decimal_separator' => '.', 'number_of_decimals' => '2', 'frontend_currency' => array('USD', 'GBP', 'BDT', 'EUR')),
                      'date_format_options' => array('date_format' => 'Y-m-d'),
                      'default_frontend_currency' => array('AUD', 'EUR', 'GBP', 'USD', 'BDT')
                    )
                  );
                  
                  $designer_settings = array(
                    'general_settings' => array(
                        'canvas_dimension' => array('small_devices' => array('width' => 280, 'height' => 300), 'medium_devices' => array('width'=> 480, 'height' => 480), 'large_devices' => array('width' => 500, 'height' => 550))
                    )
                  );
                  
                  $payment_method_array = array( 
                    'payment_option'   => array('enable_payment_method' => ''),
                    'bacs'             => array('enable_option' => '', 'method_title' => Lang::get('admin.direct_bank_transfer'), 'method_description' => $bacs_desc, 'method_instructions' => $bacs_ins, 'account_details' => array('account_name' => '', 'account_number' => '', 'bank_name' => '', 'short_code' => '', 'iban' => '', 'swift' => '') ),
                    'cod'              => array('enable_option' => '', 'method_title' => Lang::get('admin.cash_on_delivery'), 'method_description' => $cod_desc, 'method_instructions' => $cod_ins),
                    'paypal'           => array('enable_option' => '', 'method_title' => Lang::get('admin.paypal'), 'paypal_client_id' => '', 'paypal_secret' => '', 'paypal_sandbox_enable_option' => 'yes', 'method_description' => $paypal_desc),
                    'stripe'           => array('enable_option' => '', 'method_title' => Lang::get('admin.stripe'), 'test_secret_key' => '', 'test_publishable_key' => '', 'live_secret_key' => '', 'live_publishable_key' => '', 'stripe_test_enable_option' => 'yes', 'method_description' => $stripe_desc)
                  );
                  
                  $appearance_tab = array(
                    'settings'          =>    json_encode( array('header_slider_images_and_text'   => array('slider_images' => array(), 'slider_text' => array()))),
                    'settings_details'  =>    array('general' => array('custom_css' => false, 'body_bg_color' => 'd2d6de', 'filter_price_min' => 0, 'filter_price_max' => 1000, 'sidebar_panel_bg_color' => 'f2f0f1', 'sidebar_panel_title_text_color' => '333333', 'sidebar_panel_title_text_bottom_border_color' => '1fc0a0', 'sidebar_panel_title_text_font_size' => 14, 'sidebar_panel_content_text_color' => '333333', 'sidebar_panel_content_text_font_size' => 12, 'product_box_bg_color' => 'f2f0f1', 'product_box_border_color' => 'e1e1e1', 'product_box_text_color' => '333333', 'product_box_text_font_size' => 13, 'product_box_btn_bg_color' => '1fc0a0', 'product_box_btn_hover_color' => 'e1e1e1', 'btn_text_color' => 'FFFFFF', 'btn_hover_text_color' => '444444', 'selected_menu_border_color' => '1fc0a0', 'pages_content_title_border_color' => '1fc0a0'  ), 
                                            'header_details' => array('slider_visibility' => true, 'custom_css' => false, 'header_top_gradient_start_color' => '272727', 'header_top_gradient_end_color' => '272727', 'header_bottom_gradient_start_color' => '1e1e1e','header_bottom_gradient_end_color' => '1e1e1e', 'header_text_color' => 'B4B1AB', 'header_text_size' => '14', 'header_text_hover_color' => 'd2404d', 'header_selected_menu_bg_color' => 'C0C0C0', 'header_selected_menu_text_color' => 'd2404d', 'header_slogan' => 'Default welcome message'),
                                            'home_details'  => array('cat_list_to_display' => array(), 'cat_collection_list_to_display' => array()),
                                            'footer_details' => array('footer_about_us_description' => 'Your description here', 'follow_us_url' => array('fb' => '', 'twitter' => '', 'linkedin' => '', 'dribbble' => '', 'google_plus' => '', 'instagram' => '', 'youtube' => ''))),
                    'header'            =>    'customfy',
                    'home'              =>    'customfy',
                    'products'          =>    'crazy',
                    'single_product'    =>    'crazy',
                    'blogs'             =>    'crazy'
                  );
                  
                  $permissions_files = array('manage_pages' => 'Manage Pages', 'add_edit_delete_pages' => 'Add/Edit/delete Pages', 'manage_blog_manager' => 'Manage Blog Manager', 'all_blogs' => 'Access Blog List', 'add_edit_blog' => 'Add/Edit Blog', 'delete_blog' => 'Delete Blog', 'all_blog_comments' => 'Access Blog Comments', 'blog_categories' => 'Add/Edit Blog Categories', 'manage_testimonial' => 'Manage Testimonial', 'all_testimonial' => 'Access Testimonial List', 'add_edit_testimonial' => 'Add/Edit Testimonial', 'delete_testimonial' => 'Delete Testimonial', 'manage_products' => 'Manage Products', 'all_products' => 'Access Products List', 'add_edit_product' => 'Add/Edit Product', 'delete_product' => 'Delete Product', 'product_categories' => 'Add/Edit Products Categories', 'product_tags' => 'Add/Edit Products Tags', 'product_attributes' => 'Add/Edit Products Attributes', 'product_colors' => 'Add/Edit Products Colors', 'product_sizes' => 'Add/Edit Products Sizes', 'manage_products_comments' => 'Manage Products Comments', 'manage_shipping_method' => 'Manage Shipping Method', 'manage_payment_method' => 'Manage Payment Method', 'manage_brands' => 'Manage Brands', 'manage_designer_elements' => 'Manage Custom Designer Elements', 'manage_orders' => 'Manage Orders', 'manage_reports' => 'Manage Reports', 'manage_coupon' => 'Manage Coupon Manager', 'manage_seo' => 'Manage seo Manager', 'manage_requested_product' => 'Manage Request Products', 'manage_subscription' => 'Manage Subscription', 'manage_extra_features' => 'Manage Extra Features', 'manage_settings' => 'Manage Settings');
                  
                  $seo_data       =  array('meta_tag' => array('meta_keywords' => '', 'meta_description' => ''));   
                  $subscription   =  array('mailchimp' => array('api_key' => '', 'list_id' => ''));  
                  $subscription_settings   = array('subscription_visibility' => true, 'subscribe_type' => 'mailchimp', 'subscribe_options' => 'name_email', 'popup_bg_color' => 'f5f5f5', 'popup_content' => '', 'popup_display_page' => array('home', 'shop'), 'subscribe_btn_text' => 'Subscribe Now', 'subscribe_popup_cookie_set_visibility' => true, 'subscribe_popup_cookie_set_text' => 'No thanks, i am not interested!');
                  
                  if(Option::insert(array(
                    array(
                        'option_name'  =>  '_shipping_method_data',
                        'option_value' =>  serialize($shipping_method_array),
                        'created_at'   =>  date("y-m-d H:i:s", strtotime('now')),
                        'updated_at'   =>  date("y-m-d H:i:s", strtotime('now'))
                    ),
                    array(
                        'option_name'  =>  '_settings_data',
                        'option_value' =>  serialize($settings_array),
                        'created_at'   =>  date("y-m-d H:i:s", strtotime('now')),
                        'updated_at'   =>  date("y-m-d H:i:s", strtotime('now'))
                    ),
                    array(
                        'option_name'  =>  '_custom_designer_settings_data',
                        'option_value' =>  serialize($designer_settings),
                        'created_at'   =>  date("y-m-d H:i:s", strtotime('now')),
                        'updated_at'   =>  date("y-m-d H:i:s", strtotime('now'))
                    ),
                    array(
                        'option_name'  =>  '_payment_method_data',
                        'option_value' =>  serialize($payment_method_array),
                        'created_at'   =>  date("y-m-d H:i:s", strtotime('now')),
                        'updated_at'   =>  date("y-m-d H:i:s", strtotime('now'))
                    ),
                    array(
                        'option_name'  =>  '_appearance_tab_data',
                        'option_value' =>  serialize($appearance_tab),
                        'created_at'   =>  date("y-m-d H:i:s", strtotime('now')),
                        'updated_at'   =>  date("y-m-d H:i:s", strtotime('now'))
                    ),
                    array(
                        'option_name'  =>  '_permissions_files_list',
                        'option_value' =>  serialize($permissions_files),
                        'created_at'   =>  date("y-m-d H:i:s", strtotime('now')),
                        'updated_at'   =>  date("y-m-d H:i:s", strtotime('now'))
                    ),
                    array(
                        'option_name'  =>  '_seo_data',
                        'option_value' =>  serialize($seo_data),
                        'created_at'   =>  date("y-m-d H:i:s", strtotime('now')),
                        'updated_at'   =>  date("y-m-d H:i:s", strtotime('now'))
                    ),
                    array(
                        'option_name'  =>  '_subscription_data',
                        'option_value' =>  serialize($subscription),
                        'created_at'   =>  date("y-m-d H:i:s", strtotime('now')),
                        'updated_at'   =>  date("y-m-d H:i:s", strtotime('now'))
                    ),
                    array(
                        'option_name'  =>  '_subscription_settings_data',
                        'option_value' =>  serialize($subscription_settings),
                        'created_at'   =>  date("y-m-d H:i:s", strtotime('now')),
                        'updated_at'   =>  date("y-m-d H:i:s", strtotime('now'))
                    )
                  ))){
                    $manageLanguage = new ManageLanguage();
                  
                    $manageLanguage->lang_name              =    'english';
                    $manageLanguage->lang_code              =    'en';
                    $manageLanguage->lang_sample_img        =    'en_lang_sample_img.png';
                    $manageLanguage->status                 =    1;
                    $manageLanguage->default_lang           =    1;

                    if($manageLanguage->save()){
                      $user_role_permission                 =    new UserRolePermission;
                      $permissions_list                     =    array('manage_pages', 'add_edit_delete_pages', 'manage_blog_manager', 'all_blogs', 'add_edit_blog', 'delete_blog', 'all_blog_comments', 'blog_categories', 'manage_testimonial', 'all_testimonial', 'add_edit_testimonial', 'delete_testimonial', 'manage_products', 'all_products', 'add_edit_product', 'delete_product', 'product_categories', 'product_tags', 'product_attributes', 'product_colors', 'product_sizes', 'manage_products_comments', 'manage_shipping_method', 'manage_payment_method', 'manage_brands', 'manage_designer_elements', 'manage_orders', 'manage_reports', 'manage_user', 'manage_coupon', 'manage_seo', 'manage_requested_product', 'manage_subscription', 'manage_extra_features', 'manage_settings');
                      $user_role_permission->role_id        =    $get_user_role->id;
                      $user_role_permission->permissions    =    serialize($permissions_list);

                      if($user_role_permission->save()){
                        return redirect()->route('admin.login');
                      }
                    }
                  }
                }
              }
          }
        }
      }
      else{
        return redirect()-> back();
      }
    }
  }
  
  /**
   * 
   *User redistration
   *
   * @param null
   * @return null
   */
  public function userRegistration(){
    if( Request::isMethod('post') && Session::token() == Input::get('_token')){
      $data = Input::all();
      
      $rules = [
        'user_reg_display_name'          => 'required',
        'user_reg_name'                  => 'required|unique:users,name',
        'reg_email_id'                   => 'required|email|unique:users,email',
        'reg_password'                   => 'required|min:5|confirmed',
        'reg_password_confirmation'      => 'required|min:5',
        'reg_secret_key'                 => 'required'
      ];
      
      $messages = [
        'user_reg_display_name.required' => Lang::get('validation.display_name_required'),
        'user_reg_name.required' => Lang::get('validation.user_name_required'),
        'user_reg_name.unique' => Lang::get('validation.user_name_unique'),
        'reg_email_id.required' => Lang::get('validation.email_required'),
        'reg_email_id.unique' => Lang::get('validation.email_unique'),
        'reg_email_id.email' => Lang::get('validation.email_is_email'),
        'reg_password.required' => Lang::get('validation.password_required'),
        'reg_password_confirmation.required' => Lang::get('validation.password_confirmation_required'),
        'reg_secret_key.required' => Lang::get('validation.secret_key_required')
      ];
      
      if($this->recaptchaData['enable_recaptcha_for_user_registration'] == true){
        $rules['g-recaptcha-response']  = 'required|captcha';
        $messages['g-recaptcha-response.required']  =  Lang::get('validation.g_recaptcha_response_required');
      }
      
      $validator = Validator:: make($data, $rules, $messages);
      
      if($validator->fails()){
        return redirect()-> back()
        ->withInput()
        ->withErrors( $validator );
      }
      else{
        if(isset($this->settingsData['_settings_data']['general_settings']['general_options']['default_role_slug_for_site']) && !empty($this->settingsData['_settings_data']['general_settings']['general_options']['default_role_slug_for_site'])){
          $User =       new User;
          $Role =       new Role;
          $Roleuser =   new RoleUser;

          $get_role = Role::where(['slug' => $this->settingsData['_settings_data']['general_settings']['general_options']['default_role_slug_for_site']])->first();
          
          if(!empty($get_role->id)){
            $User->display_name       =    Input::get('user_reg_display_name');
            $User->name               =    Input::get('user_reg_name');
            $User->email              =    Input::get('reg_email_id');
            $User->password           =    bcrypt( trim(Input::get('reg_password')) );
            $User->user_photo_url     =    '';
            $User->user_status        =    1;
            $User->secret_key         =    bcrypt( trim(Input::get('reg_secret_key')) );

            if($User->save()){
              $Roleuser->user_id    =    $User->id;
              $Roleuser->role_id    =    $get_role->id;

              if($Roleuser->save()){
                return redirect()->route('user-login-page');
              }
            }
          }
          else{
            Session::flash('error-message', Lang::get('frontend.user_role_not_selected_msg'));
            return redirect()-> back();
          }
        }
        else{
          Session::flash('error-message', Lang::get('frontend.user_role_not_selected_msg'));
          return redirect()-> back();
        }
      }
    }
    else{
      return redirect()-> back();
    }
  } 
}