<meta charset="UTF-8">
<title>@yield('title')</title>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
<meta name="csrf-token" content="{{ csrf_token() }}">

@if((Request::is('product/details/*') || Request::is('product/customize/*')) && !empty($single_product_details['meta_keywords']))
<meta name="keywords" content="{{ $single_product_details['meta_keywords'] }}">
@elseif( Request::is('blog/*') && !empty($blog_details_by_slug['meta_keywords']))
<meta name="keywords" content="{{ $blog_details_by_slug['meta_keywords'] }}">
@elseif(!empty($seo_data) && $seo_data['meta_tag']['meta_keywords'])
<meta name="keywords" content="{{ $seo_data['meta_tag']['meta_keywords']}}">
@endif

@if(!empty($seo_data) && $seo_data['meta_tag']['meta_description'])
<meta name="description" content="{{ $seo_data['meta_tag']['meta_description'] }}">
@endif

@if((Request::is('product/details/*') || Request::is('product/customize/*')) && !empty($single_product_details['_product_seo_description']))
<meta name="description" content="{{ $single_product_details['_product_seo_description'] }}">
@endif

@if((Request::is('product/details/*') || Request::is('product/customize/*')) && !empty($single_product_details['post_slug']))
<link rel="canonical" href="{{ route('details-page', $single_product_details['post_slug']) }}">
@endif

@if(Request::is('blog/*') && !empty($blog_details_by_slug['blog_seo_description']))
<meta name="description" content="{{ $blog_details_by_slug['blog_seo_description'] }}">
@endif

@if(Request::is('blog/*') && !empty($blog_details_by_slug['blog_seo_url']))
<link rel="canonical" href="{{ route('blog-single-page', $blog_details_by_slug['blog_seo_url']) }}">
@endif

{!! HTML::style('resources/assets/frontend/css/bootstrap.min.css') !!}
{!! HTML::style('resources/assets/font-awesome-4.6.3/css/font-awesome.min.css') !!}
{!! HTML::style('resources/assets/plugins/datatables/dataTables.bootstrap.css') !!}
{!! HTML::style('resources/assets/frontend/css/font-awesome.min.css') !!}
{!! HTML::style('resources/assets/sweetalert/sweetalert.css') !!}
{!! HTML::style('resources/assets/plugins/select2/select2.min.css') !!}
{!! HTML::style('resources/assets/dropzone/css/dropzone.css') !!}
{!! HTML::style('resources/assets/designer/designer.css') !!}
{!! HTML::style('resources/assets/designer/scroll/jquery.mCustomScrollbar.css') !!}
{!! HTML::style('resources/assets/plugins/ionslider/ion.rangeSlider.css') !!}
{!! HTML::style('resources/assets/plugins/ionslider/ion.rangeSlider.skinModern.css') !!}
{!! HTML::style('resources/assets/plugins/bootstrap-slider/slider.css') !!}
{!! HTML::style('resources/assets/frontend/css/common.css') !!}
{!! HTML::style('resources/assets/frontend/css/price-range.css') !!}
{!! HTML::style('resources/assets/plugins/iCheck/square/purple.css') !!}
{!! HTML::style('resources/assets/modal/css/modal.css') !!}
{!! HTML::style('resources/assets/modal/css/modal-extra.css') !!}
{!! HTML::style('resources/assets/slick/slick.css') !!}
{!! HTML::style('resources/assets/slick/slick-theme.css') !!}

{!! HTML::style('resources/views/frontend-templates/footer/black-crazy/style.css') !!}

<!--load header style-->
{!! HTML::style('resources/views/frontend-templates/header/'. $appearance_settings['header'] .'/style.css') !!}

<!--load home style-->
{!! HTML::style('resources/views/frontend-templates/home/'. $appearance_settings['home'] .'/style.css') !!}

<!--load blogs style-->
{!! HTML::style('resources/views/frontend-templates/blog/'. $appearance_settings['blogs'] .'/style.css') !!}

<!--load products style-->
{!! HTML::style('resources/views/frontend-templates/product/'. $appearance_settings['products'] .'/style.css') !!}

<!--load single products style-->
{!! HTML::style('resources/views/frontend-templates/single-product/'. $appearance_settings['single_product'] .'/style.css') !!}


{!! HTML::script('resources/assets/jquery/jquery-1.10.2.js') !!}
{!! HTML::script('resources/assets/jquery/jquery-ui-1.11.4.js') !!}
{!! HTML::script('resources/assets/dropzone/dropzone.js') !!}
{!! HTML::script('resources/assets/frontend/js/bootstrap.min.js') !!}
{!! HTML::script('resources/assets/plugins/datatables/jquery.dataTables.min.js') !!}
{!! HTML::script('resources/assets/plugins/datatables/dataTables.bootstrap.min.js') !!}
{!! HTML::script('resources/assets/frontend/js/jquery.scrollUp.min.js') !!}
{!! HTML::script('resources/assets/sweetalert/sweetalert.min.js') !!}
{!! HTML::script('resources/assets/plugins/select2/select2.full.min.js') !!}
{!! HTML::script('resources/assets/designer/fabric-1.5.0.min.js') !!}
{!! HTML::script('resources/assets/designer/fabric.curvedText.js') !!}
{!! HTML::script('resources/assets/designer/customiseControls.min.js') !!}
{!! HTML::script('resources/assets/designer/colorpicker/jscolor.js') !!}
{!! HTML::script('resources/assets/designer/scroll/jquery.mCustomScrollbar.concat.min.js') !!}
{!! HTML::script('resources/assets/designer/jsPDF.min.js') !!}
{!! HTML::script('resources/assets/plugins/ionslider/ion.rangeSlider.min.js') !!}
{!! HTML::script('resources/assets/plugins/bootstrap-slider/bootstrap-slider.js') !!}
{!! HTML::script('resources/assets/designer/designer.js') !!}
{!! HTML::script('resources/assets/designer/designerControl.js') !!}
{!! HTML::script('resources/assets/frontend/js/products-variation.js') !!}
{!! HTML::script('resources/assets/frontend/js/products-add-to-cart.js') !!}
{!! HTML::script('resources/assets/frontend/js/price-range.js') !!}
{!! HTML::script('resources/assets/plugins/iCheck/icheck.min.js') !!}
{!! HTML::script('resources/assets/modal/js/modal.js') !!}
{!! HTML::script('resources/assets/frontend/js/jquery.validate.js') !!}

{!! HTML::script('resources/views/frontend-templates/footer/black-crazy/script.js') !!}

<!--load header scripts-->
{!! HTML::script('resources/views/frontend-templates/header/'. $appearance_settings['header'] .'/script.js') !!}

<!--load home scripts-->
{!! HTML::script('resources/views/frontend-templates/home/'. $appearance_settings['home'] .'/script.js') !!}

<!--load blogs scripts-->
{!! HTML::script('resources/views/frontend-templates/blog/'. $appearance_settings['blogs'] .'/script.js') !!}

<!--load products scripts-->
{!! HTML::script('resources/views/frontend-templates/product/'. $appearance_settings['products'] .'/script.js') !!}

<!--load single products scripts-->
{!! HTML::script('resources/views/frontend-templates/single-product/'. $appearance_settings['single_product'] .'/script.js') !!}
{!! HTML::script('resources/views/frontend-templates/single-product/'. $appearance_settings['single_product'] .'/jquery.elevatezoom.js') !!}

{!! HTML::script('resources/assets/frontend/js/common.js') !!}
{!! HTML::script('resources/assets/frontend/js/social-network.js') !!}
{!! HTML::script('resources/assets/slick/slick.min.js') !!}
