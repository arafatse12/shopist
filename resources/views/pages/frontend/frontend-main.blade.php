@extends('layouts.frontend.master')
@section('content')

@if(Request::is('home'))
  @include('pages.frontend.frontend-pages.home')
  @section('title', trans('frontend.shopist_home_title') .' - '. get_site_title() )
  @yield('home-content')
  
@elseif(Request::is('shop'))
  @include('pages.frontend.frontend-pages.shop')
  @section('title', trans('frontend.shopist_shop_title') .' - '. get_site_title() )
  @yield('shop-content')
    
@elseif(Request::is('product/details/*'))
  @include('pages.frontend.frontend-pages.product-details')
  @section('title', $single_product_details['_product_seo_title'] .' - '. get_site_title() )
  @yield('products-details-content')
  
@elseif(Request::is('product/categories/*') || Request::is('product/categories/*/grid_view') || Request::is('product/categories/*/list_view'))
  @include('pages.frontend.frontend-pages.categories-main')
  @section('title', trans('frontend.shopist_category_products') .' - '. get_site_title() )
  @yield('categories-main-content')
  
@elseif(Request::is('testimonial/*'))
  @include('pages.frontend.frontend-pages.testimonial-details')
  @section('title', trans('frontend.testimonials_details_page_title') .' - '. get_site_title() )
  @yield('testimonial-details-content')  
  
@elseif(Request::is('checkout'))
  @include('pages.frontend.frontend-pages.checkout')
  @section('title', trans('frontend.shopist_checkout') .' - '. get_site_title() )
  @yield('checkout-content')
  
@elseif(Request::is('cart'))
  @include('pages.frontend.frontend-pages.cart')
  @section('title', trans('frontend.shopist_cart_title') .' - '. get_site_title() )
  @yield('cart-content')  
  
@elseif(Request::is('product/customize/*'))
  @include('pages.frontend.frontend-pages.frontend-designer')
  @section('title',  trans('frontend.shopist_customize_page') .' - '. get_site_title() )
  @yield('frontend-designer-html-content')
  
@elseif(Request::is('checkout/order-received/*'))
  @include('pages.frontend.frontend-pages.thank-you')
  @section('title',  trans('frontend.shopist_order_received_title') .' - '. get_site_title() )
  @yield('frontend-thank-you-content') 
    
@elseif(Request::is('user/account') || Request::is('user/account/dashboard') || Request::is('user/account/my-address') || Request::is('user/account/my-address/add') || Request::is('user/account/my-address/edit') || Request::is('user/account/my-profile') || Request::is('user/account/my-orders') || Request::is('user/account/my-saved-items') || Request::is('user/account/view-orders-details/*') || Request::is('user/account/my-coupons') || Request::is('user/account/download') || Request::is('user/account/order-details/*'))

  @include('pages.frontend.user-account.user-account-pages')
  
  @if(Request::is('user/account'))
    @section('title',  trans('frontend.frontend_user_dashboard_title') .' - '. get_site_title() )
  @elseif (Request::is('user/account/dashboard'))
    @section('title',  trans('frontend.frontend_user_dashboard_title') .' - '. get_site_title() )
  @elseif (Request::is('user/account/my-address'))
    @section('title',  trans('frontend.frontend_user_address_title') .' - '. get_site_title() )
  @elseif (Request::is('user/account/my-address/add'))
    @section('title',  trans('frontend.frontend_user_address_add_title') .' - '. get_site_title() ) 
  @elseif (Request::is('user/account/my-address/edit'))
    @section('title',  trans('frontend.frontend_user_address_edit_title') .' - '. get_site_title() )
  @elseif (Request::is('user/account/my-profile'))
    @section('title',  trans('frontend.frontend_user_profile_edit_title') .' - '. get_site_title() )
  @elseif (Request::is('user/account/my-orders'))
    @section('title',  trans('frontend.frontend_my_order_title') .' - '. get_site_title() )
  @elseif (Request::is('user/account/my-saved-items'))
    @section('title',  trans('frontend.frontend_wishlist_items_title') .' - '. get_site_title() ) 
  @elseif (Request::is('user/account/my-coupons'))
    @section('title',  trans('frontend.frontend_coupons_items_title') .' - '. get_site_title() )
  @elseif (Request::is('user/account/download'))
    @section('title',  trans('frontend.frontend_download_options_title') .' - '. get_site_title() )  
  @elseif(Request::is('user/account/order-details/*'))
    @section('title',  trans('frontend.user_order_details_page_title') .' - '. get_site_title() )  
  @endif
  @yield('frontend-user-account')
  
@elseif(Request::is('blogs'))
  @include('pages.frontend.frontend-pages.blogs-main')
  @section('title',  trans('frontend.blogs_page_title') .' - '. get_site_title() )
  @yield('frontend-blogs-content')
  
@elseif(Request::is('categories/blog/*'))
  @include('pages.frontend.frontend-pages.blog-categories-post')
  @section('title',  trans('frontend.cat_post_label') .' - '. get_site_title() )
  @yield('frontend-blogs-cat-post-content')
  
@elseif(Request::is('blog/*'))
  @include('pages.frontend.frontend-pages.blog-single-page')
  @if(!empty($blog_details_by_slug['blog_seo_title']))
    @section('title',  $blog_details_by_slug['blog_seo_title'] .' - '. get_site_title())
  @else
    @section('title',  trans('frontend.blog_details_page_label') .' - '. get_site_title())
  @endif
  @yield('frontend-blog-single-page-content')
  
@elseif(Request::is('brand/*'))
  @include('pages.frontend.frontend-pages.brand-single-page')
  @section('title',  trans('frontend.brand_details_page_label') .' - '. get_site_title() )
  @yield('frontend-brand-single-page-content')
  
@elseif(Request::is('product/tag/*'))
  @include('pages.frontend.frontend-pages.tag-single-page')
  @section('title',  trans('frontend.tag_details_page_label') .' - '. get_site_title() )
  @yield('frontend-tag-single-page-content')
		
@elseif(Request::is('page/*'))
  @include('pages.frontend.frontend-pages.custom-single-page')
  @section('title', $page_data->post_title .' - '. get_site_title())
  @yield('custom-single-page-content')
  
@elseif(Request::is('product/comparison'))
  @include('pages.frontend.frontend-pages.product-comparison')
  @section('title', trans('frontend.product_comparison_title_label') .' - '. get_site_title())
  @yield('custom-product-comparison-page-content')  
@endif
@endsection