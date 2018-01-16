<div class="variations-content-main" data-is_login="{{ $single_product_details['is_user_login'] }}" data-login_user_slug="{{ $single_product_details['login_user_slug'] }}" data-current_currency_value="{{ get_product_price_html_by_filter(1) }}" data-variations_details="{{ htmlspecialchars(json_encode(get_product_variations_with_data($single_product_details['id']))) }}">
  <div class="variations-data row">
    <div class="clearfix">
      @foreach($attr_lists as $row)
        <div class="col-sm-12 variations-line">
          <div class="variation-attr-name">{!! $row['attr_name'] !!}</div>
          <div class="variation-attr-value">
            <div class="variation-choose-option"><i class="fa fa-hand-o-up"></i> {{ trans('frontend.choose_an_options') }}</div>
            @foreach( explode(',', $row['attr_values']) as $val )
            <div class="variation-options-lists"><input  type="radio" name="{{ string_slug_format( $row['attr_name'] ) }}" value="{{ string_slug_format( $val ) }}"> &nbsp;&nbsp; {!! ucwords($val) !!}</div>
            @endforeach
          </div>
        </div>
      @endforeach
    </div>
      
  </div>
  
  <div class="product-add-to-cart-content add-to-cart-content" style="display:none;">
    <div class="variation-price-label"></div>  
    <ul>
      <li>
        <div class="input-group">
            <span class="input-group-btn">
              <button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">
                <span class="fa fa-minus"></span>
              </button>
            </span>
            <input type="text" id="quantity" name="quant[1]" class="form-control input-number" value="1" min="1" max="10"/>
            <span class="input-group-btn">
              <button type="button" class="btn btn-default btn-number" data-type="plus" data-field="quant[1]">
                <span class="fa fa-plus"></span>
              </button>
            </span>
        </div>
      </li>
      @if(Request::is('product/customize/*'))
      <li>
        <a href="" class="btn btn-sm btn-style cart customize-page-add-to-cart" data-id="{{ $single_product_details['id'] }}"><i class="fa fa-shopping-cart"></i>&nbsp;&nbsp; {{ trans('frontend.add_to_cart') }}</a>
      </li>
      @else
      <li>
        <a href="" class="btn btn-sm btn-style cart single-page-add-to-cart" data-id="{{ $single_product_details['id'] }}"><i class="fa fa-shopping-cart"></i>&nbsp;&nbsp; {{ trans('frontend.add_to_cart') }}</a>
      </li>
      @endif
    </ul>
    
    @if(!Request::is('product/customize/*'))
    <br>  
    <ul>
      <li>
        <a href="" class="btn btn-sm btn-style product-wishlist" data-id="{{ $single_product_details['id'] }}" data-toggle="tooltip" data-placement="top" title="{{ trans('frontend.add_to_wishlist_label') }}"><i class="fa fa-heart"></i></a>
      </li>
      <li>
        <a href="" class="btn btn-sm btn-style product-compare" data-id="{{ $single_product_details['id'] }}" data-toggle="tooltip" data-placement="top" title="{{ trans('frontend.add_to_compare_list_label') }}"><i class="fa fa-exchange"></i></a>
      </li>
    </ul> 
    @endif
  </div>  
</div><br>