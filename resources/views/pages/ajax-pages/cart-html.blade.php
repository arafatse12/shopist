<div class="extra-margin-top-for-content"></div>
<div id="cart_page" class="container">
  @if( Cart::count() >0 )
  <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">  
    
    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col-centered clearfix">
      <h2 class="cart-shopping-label">{{ trans('frontend.shopping_cart') }}</h2>
      @include('pages-message.notify-msg-error')
      <ul class="cart-data">
        <li class="row list-inline columnCaptions">
          <div class="header-items">{!! trans('frontend.cart_item') !!}</div>
          <div class="header-price">{!! trans('frontend.price') !!}</div>
          <div class="header-qty">{!! trans('frontend.quantity') !!}</div>
          <div class="header-line-total">{!! trans('frontend.total') !!}</div>
        </li>
        @foreach(Cart::items() as $index => $items)
          <li class="row items-inline">
            <div class="itemName">
              @if($items->img_src)
                <div class="product-img">
                  <a href="{{ route('details-page', get_product_slug($items->id)) }}">
                    <img src="{{ get_image_url($items->img_src) }}" alt="product">
                  </a>
                </div>
              @else
                <div class="product-img">
                  <a href="{{ route('details-page', get_product_slug($items->id)) }}">
                    <img src="{{ default_placeholder_img_src() }}" alt="no_image">
                  </a>
                </div>
              @endif
              <div class="item-name">
                <a href="{{ route('details-page', get_product_slug($items->id)) }}">{!! $items->name !!}</a>
                <?php $count = 1; ?>
                @if(count($items->options) > 0)
                <p>
                  @foreach($items->options as $key => $val)
                    @if($count == count($items->options))
                      {!! $key .' &#8658; '. $val !!}
                    @else
                      {!! $key .' &#8658; '. $val. ' , ' !!}
                    @endif
                    <?php $count ++ ; ?>
                  @endforeach
                </p>
                @endif
                
                @if(get_product_type($items->id) === 'customizable_product')
                  @if($items->acces_token)
                    @if(count(get_customize_images_by_access_token($items->acces_token))>0)
                      <button class="btn btn-block btn-sm view-customize-images" data-images="{{ htmlspecialchars(json_encode( get_customize_images_by_access_token($items->acces_token) )) }}">{{ trans('frontend.design_images') }}</button>
                    @endif
                  @endif
                @endif
              </div>
            </div>  
              
            <div class="price">{!! price_html( get_product_price_html_by_filter( $items->price ), get_frontend_selected_currency() ) !!}</div>
            <div class="quantity"><input type="number" class="form-control cart_quantity_input" name="cart_quantity[{{ $index }}]" value="{{ $items->quantity }}" min="1"></div>
            <div class="price line-total">{!! price_html(  get_product_price_html_by_filter(Cart::getRowPrice($items->quantity, $items->price)), get_frontend_selected_currency() ) !!}</div>
            <div class="popbtn"><a class="cart_quantity_delete" href="{{ route('removed-item-from-cart', $index)}}"><i class="fa fa-close"></i></a></div>
          </li>
        @endforeach
        
        <li class="row cart-button-main">
            <div class="apply-coupon">
                <input type="text" class="form-control" id="apply_coupon_code" name="apply_coupon" placeholder="{{ trans('frontend.coupon_code_placeholder_text') }}">
                <button class="btn btn-primary" name="apply_coupon_post" id="apply_coupon_post">{!! trans('frontend.apply_coupon_label') !!}</button>
            </div>
          <div class="btn-cart-action">
            <button class="btn btn-primary empty" type="submit" name="empty_cart">{{ trans('frontend.empty_cart') }}</button>
            <button class="btn btn-primary update" type="submit" name="update_cart">{{ trans('frontend.update_cart') }}</button>
          </div>
        </li>
        
        @include('pages.ajax-pages.cart-total-html')
      </ul>
    </div>
  </form>    
  @else
    @include('pages-message.notify-msg-error')
    <h2 class="cart-shopping-label2">{{ trans('frontend.shopping_cart') }}</h2>
    <div class="empty-cart-msg">{{ trans('frontend.empty_cart_msg') }}</div>
    <div class="cart-return-shop"><a class="btn btn-default check_out" href="{{ route('shop-page') }}">{{ trans('frontend.return_to_shop') }}</a></div>
  @endif
</div>