var designer = designer || {};
var designerCanvasObj, selectedObj;
var designer_settings_data, designer_img_elements, design_save_json_data;
var $lineHeightRange, $textShadowX, $textShadowY, $shadowBlur, $textOpacity, $curveRadius, $curveSpacing, $imgOpacity;
var ary = [];
var prev_canvobj = 0;
var canvDataobj = {};
var baseURL = '';
var designerLocalizationString;

designer.onPageLoad = {
_designer_init:function()
{
  if($('#hf_base_url').length>0)
  {
    baseURL = $('#hf_base_url').val();
  }
  if($('#frontend_all_msg_with_localization').length>0)
  {
    designerLocalizationString = JSON.parse( $('#frontend_all_msg_with_localization').val() );
  }
  
  if( $('#designer_canvas').length>0 && $('#hf_designer_settings_json').length>0 && $('#hf_custom_designer_data').length>0 && $('#hf_designer_settings_json').val() && $('#hf_custom_designer_data').val() )
  {
    if($('#hf_designer_settings_json').length>0 && $('#hf_designer_settings_json').val().length>0)
    {
      designer_settings_data = JSON.parse( $('#hf_designer_settings_json').val() );
    }
    
    if($('#hf_custom_designer_data').length>0 && $('#hf_custom_designer_data').val().length>0)
    {
      designer_img_elements = JSON.parse( $('#hf_custom_designer_data').val() );
    }
    
    if($('#hf_design_save_json_data').length>0 && $('#hf_design_save_json_data').val().length>0)
    {
      design_save_json_data = $.parseJSON($('#hf_design_save_json_data').val());
    }
    
    if ($('#swap-popover-content').find('.design-title-items').length >0 )
    {
      prev_canvobj = $('#swap-popover-content .design-title-items:first-child').data('id');
    }
    
    
    designerCanvasObj = new fabric.Canvas('designer_canvas');
    designer.function._resizeCanvas();
    
    designerCanvasObj.on( 'selection:cleared', designer.function._designer_view_clear );
    designerCanvasObj.on( 'object:selected', designer.function._designer_viewObject );

    if( $( ".designer-text-control" ).length>0 || $( ".designer-image-gallery" ).length>0 || $( ".designer-image-edit-panel" ).length>0 || $( ".designer-upload-image" ).length>0)
    {
      $( ".designer-text-control, .designer-image-gallery, .designer-image-edit-panel, .designer-upload-image" ).draggable({ handle: "#draggable-handle" });
    }
    
    if($('.canvas-design-panel .panel-body').length>0)
    {
      $(".canvas-design-panel .panel-body").mCustomScrollbar({
              autoHideScrollbar:true,
              theme:"dark"
      });      
    }
    
    if($('.designer-text-control #change_fonts').length>0)
    {
      $(".designer-text-control #change_fonts").select2({  width: '100%' });
    }
    
    
    if($('#text_line_height').length>0)
    {
      var lineHeight = $('#text_line_height');
      lineHeight.ionRangeSlider({
        min: 0.1,
        max: 10,
        type: 'single',
        step: 0.1,
        postfix: "",
        prettify: false,
        hasGrid: false,
        onChange:function(obj)
        {
          if(selectedObj && (selectedObj.itemName === 'normal_text' || selectedObj.itemName === 'curvedText'))
          {
            selectedObj.set($('#text_line_height').data('name'), obj.from);
            designerCanvasObj.renderAll();
          }
        }
      });
      
      $lineHeightRange = lineHeight.data("ionRangeSlider");
    }
    
    
    if($('#change_text_x_shadow').length>0)
    {
      var x_shadow = $("#change_text_x_shadow");
      x_shadow.ionRangeSlider({
        min: -10,
        max: 40,
        type: 'single',
        step: 1,
        postfix: "",
        prettify: false,
        hasGrid: false,
        onChange:function(obj)
        {
          if(selectedObj && (selectedObj.itemName === 'normal_text' || selectedObj.itemName === 'curvedText'))
          {
            designer.function._shadow_elements($("#change_text_x_shadow"), obj.from);
          }
        }
      });
      
      $textShadowX = x_shadow.data("ionRangeSlider");
    }
    
    if($('#change_text_y_shadow').length>0)
    {
      var y_shadow = $("#change_text_y_shadow");
      y_shadow.ionRangeSlider({
        min: 0,
        max: 40,
        type: 'single',
        step: 1,
        postfix: "",
        prettify: false,
        hasGrid: false,
        onChange:function(obj)
        {
          if(selectedObj && (selectedObj.itemName === 'normal_text' || selectedObj.itemName === 'curvedText'))
          {
            designer.function._shadow_elements($("#change_text_y_shadow"), obj.from);
          }
        }
      });
      
      $textShadowY = y_shadow.data("ionRangeSlider");
    }
    
    if($('#change_text_blur_shadow').length>0)
    {
      var shadow_blur = $("#change_text_blur_shadow");
      shadow_blur.ionRangeSlider({
        min: 0,
        max: 40,
        type: 'single',
        step: 1,
        postfix: "",
        prettify: false,
        hasGrid: false,
        onChange:function(obj)
        {
          if(selectedObj && (selectedObj.itemName === 'normal_text' || selectedObj.itemName === 'curvedText'))
          {
            designer.function._shadow_elements($("#change_text_blur_shadow"), obj.from);
          }
        }
      });
      
      $shadowBlur = shadow_blur.data("ionRangeSlider");
    }
    
    if($('#change_text_opacity').length>0)
    {
      var text_opacity = $("#change_text_opacity");
      text_opacity.ionRangeSlider({
        min: 0,
        max: 1,
        type: 'single',
        step: 0.01,
        postfix: "",
        prettify: false,
        hasGrid: false,
        onChange:function(obj)
        {
          if(selectedObj && (selectedObj.itemName === 'normal_text' || selectedObj.itemName === 'curvedText'))
          {
            selectedObj.set('opacity', obj.from);
            designerCanvasObj.renderAll();
          }
        }
      });
      
      $textOpacity = text_opacity.data("ionRangeSlider");
    }
    
    if($('#change_img_opacity').length>0)
    {
      var img_opacity = $("#change_img_opacity");
      img_opacity.ionRangeSlider({
        min: 0,
        max: 1,
        type: 'single',
        step: 0.01,
        postfix: "",
        prettify: false,
        hasGrid: false,
        onChange:function(obj)
        {
          if(selectedObj && (selectedObj.itemName === 'gallery_image' || selectedObj.itemName === 'upload_image'))
          {
            selectedObj.set('opacity', obj.from);
            designerCanvasObj.renderAll();
          }
        }
      });
      
      $textOpacity = text_opacity.data("ionRangeSlider");
    }
    
    if($('#change_radius').length>0)
    {
      var curve_radius = $("#change_radius");
      curve_radius.ionRangeSlider({
        min: 0,
        max: 200,
        type: 'single',
        step: 1,
        postfix: "",
        prettify: false,
        hasGrid: false,
        onChange:function(obj)
        {
          if(selectedObj && (selectedObj.itemName === 'normal_text' || selectedObj.itemName === 'curvedText'))
          {
            selectedObj.set($('#change_radius').data('name'), obj.from);
            designerCanvasObj.renderAll();
          }
        }
      });
      
      $curveRadius = curve_radius.data("ionRangeSlider");
    }
    
    if($('#change_spacing').length>0)
    {
      var curve_spacing = $("#change_spacing");
      curve_spacing.ionRangeSlider({
        min: 5,
        max: 40,
        type: 'single',
        step: 1,
        postfix: "",
        prettify: false,
        hasGrid: false,
        onChange:function(obj)
        {
          if(selectedObj && (selectedObj.itemName === 'normal_text' || selectedObj.itemName === 'curvedText'))
          {
            selectedObj.set($('#change_spacing').data('name'), obj.from);
            designerCanvasObj.renderAll();
          }
        }
      });
      
      $curveSpacing = curve_spacing.data("ionRangeSlider");
    }
   
    
    //controls
    fabric.Object.prototype.setControlsVisibility( {
      ml: false,
      mr: false,
      bl: false,
      mb: false,
      mt: false,
      tr: false
    } );

    fabric.Canvas.prototype.customiseControls( {
      tl: {
          action: 'rotate',
          cursor: 'crosshair'
      },
      br: {
          action: 'scale'
      }
    } );
    
    if($('#downloadImgLink').length>0)
    {
      var button = document.getElementById('downloadImgLink');
      button.addEventListener('click', function (e) 
      {
        allPanelHide();
        
        var dataURL = designerCanvasObj.toDataURL('image/png');
        button.href = dataURL;
      });
    }
    
    if($('.icon-img-pdf').length>0)
    {
      $('.icon-img-pdf').click(function()
      {
        allPanelHide();

        var imgData = designerCanvasObj.toDataURL('image/png');              
        var doc = new jsPDF('p', 'mm');
        doc.addImage(imgData, 'PNG', 10, 10);
        doc.save('product.pdf');
      });
    }
    
    if($('.icon-img-print').length>0)
    {
      $('.icon-img-print').click(function()
      {
        allPanelHide();
        
        var win = window.open();
        win.document.write("<img src='"+ designerCanvasObj.toDataURL()+"'/>");
        win.print();
        win.location.reload();
      });
    }
  }
}
};
designer.event = {
  _chnage_dynamic_text:function()
  {
    if($('#change_dynamic_text').length>0)
    {
      $('#change_dynamic_text').keyup(function()
      {
        if(selectedObj && (selectedObj.itemName === 'normal_text' || selectedObj.itemName === 'curvedText'))
        {
          designer.function._design_rearrange_again('edit_text', $(this));
        }
      });
    }
  },

  _chnage_dynamic_text_fonts:function()
  {
    if($('#change_fonts').length>0)
    {
      $('#change_fonts').change(function()
      {
        if(selectedObj && (selectedObj.itemName === 'normal_text' || selectedObj.itemName === 'curvedText'))
        {
          designer.function._design_rearrange_again('change_fonts_family', $(this));
        }
      });
    }
  },
  	
  _chnage_dynamic_color:function()
  {
    if($('#change_text_color').length>0 || $('#change_img_color').length>0)
    {
      $('#change_text_color, #change_img_color').change(function()
      {
        if(selectedObj && (selectedObj.itemName === 'normal_text' || selectedObj.itemName === 'curvedText'))
        {
          designer.function._design_rearrange_again('change_text_color', $(this));
        }
        else if(selectedObj && (selectedObj.itemName === 'gallery_image' || selectedObj.itemName === 'upload_image'))
        {
          designer.function._design_rearrange_again('change_img_color', $(this));
        }
      });
    }
  },
	
  _chnage_dynamic_text_align:function()
  {
    if($('.text-align').length>0)
    {
      $('.text-align li').click(function()
      {
        if(selectedObj && (selectedObj.itemName === 'normal_text' || selectedObj.itemName === 'curvedText'))
        {
          designer.function._design_rearrange_again('change_alignment', $(this));
        }
      });
    }
  },
	
  _chnage_dynamic_text_fontWeight:function()
  {
    if($('.text-font-weight').length>0)
    {
      $('.text-font-weight li').click(function()
      {
        if(selectedObj && (selectedObj.itemName === 'normal_text' || selectedObj.itemName === 'curvedText'))
        {
          designer.function._design_rearrange_again('change_style', $(this));
        }
      });
    }
  },
	
  _chnage_dynamic_text_decoration:function()
  {
    if($('.textDecoration').length>0)
    {
      $('.textDecoration li').click(function()
      {
        if(selectedObj && (selectedObj.itemName === 'normal_text' || selectedObj.itemName === 'curvedText'))
        {
          designer.function._design_rearrange_again('change_decoration', $(this));
        }
      });
    }
  },

  _chnage_dynamic_text_shadow:function()
  {
    if($('#change_text_shadow_color').length>0)
    {
      $('#change_text_shadow_color').change(function()
      {
        if(selectedObj && (selectedObj.itemName === 'normal_text' || selectedObj.itemName === 'curvedText'))
        {
          designer.function._shadow_elements($(this), $(this).val());
        }
      });
    }
  },
  
  _chnage_dynamic_more_options:function()
  {
    if($('.dynamic-text-more-option').length>0 || $('.dynamic-img-more-option').length>0)
    {
      $('.dynamic-text-more-option ul li, .dynamic-img-more-option ul li').click(function()
      {
        if(selectedObj && (selectedObj.itemName === 'normal_text' || selectedObj.itemName === 'curvedText' || selectedObj.itemName === 'gallery_image' || selectedObj.itemName === 'upload_image'))
        {
          designer.function._design_rearrange_again('more_action', $(this));
        }
      });
    }
  },
  
  _enable_curved_text:function()
  {
    if($('#enableCurvedText').length>0)
    {
      $('#enableCurvedText').click(function()
      {
        if(selectedObj && (selectedObj.itemName === 'normal_text' || selectedObj.itemName === 'curvedText'))
        {
          var props = {};
          var obj = selectedObj;
          var textSample;

          if(obj)
          {
            if ($(this).is(':checked')) 
            {
              if(/text/.test(obj.type)) 
              {
                default_text = obj.getText();
                props = obj.toObject();
                delete props['type'];
                props['textAlign'] = 'center';
                props['radius'] = 50;
                props['spacing'] = 20;
                props['itemName'] = 'curvedText';
                props['hasRotatingPoint'] = false;
                props['padding'] = 10;

                textSample = new fabric.CurvedText(default_text, props);
              }
              $('.curved-text-elements').fadeIn();
            }
            else
            {
              if(/curvedText/.test(obj.type)) 
              {
                default_text = obj.getText();
                props = obj.toObject();
                delete props['type'];
                props['itemName'] = 'normal_text';
                props['hasRotatingPoint'] = false;
                props['padding'] = 10;

                textSample = new fabric.Text(default_text, props);
              }
              $('.curved-text-elements').fadeOut();
            }

            designerCanvasObj.remove(obj);
            designerCanvasObj.add(textSample).renderAll();
            designerCanvasObj.setActiveObject(textSample);
          }
        }
      });
    }
  },
   
  _remove_selected_object:function()
  {
    if($('.remove-selected-object').length>0)
    {
      $('.remove-selected-object').click(function()
      {
        if(selectedObj && (selectedObj.itemName === 'normal_text' || selectedObj.itemName === 'curvedText' || selectedObj.itemName === 'gallery_image' || selectedObj.itemName === 'upload_image'))
        {
          designerCanvasObj.remove( selectedObj );
        }
      });
    }
  },
  
  _curved_text_reverse_change:function()
  {
    if($('#enableCurvedTextReverse').length>0)
    {
      $('#enableCurvedTextReverse').on('click', function()
      {
        if(selectedObj && (selectedObj.itemName === 'normal_text' || selectedObj.itemName === 'curvedText'))
        {
          designer.function._design_rearrange_again('reverse', $(this));
        }
      });
    }
  },
  
  _remove_design_modal:function()
  {
    if($('.close-design-control-modal').length>0)
    {
      $('.close-design-control-modal').on('click', function()
      {
        $(this).parent().parent().fadeOut();
        canvasDeactivateAll();
        
        if($(this).data('name') == 'gallery')
        {
          show_gallery_image_cat_list();
        }
      });
    }
  },
  
  _save_custom_design:function()
  {
    if($('#save_custom_design').length>0)
    {
      $('#save_custom_design').on('click', function(e)
      {
        e.preventDefault();
        allPanelHide();
        
        designerCanvasObj.deactivateAll().renderAll();
        canvDataobj[prev_canvobj] = {objId:prev_canvobj, customdata:JSON.stringify(designerCanvasObj.toJSON(['id','name','itemName', 'lockMovementX', 'lockMovementY', 'lockScalingX', 'lockScalingY', 'lockRotation', 'hasControls', 'hasBorders', 'lockSystem', 'textAlign', 'radius', 'spacing', 'hasRotatingPoint', 'padding', 'angle', 'strokeWidth', 'stroke', 'borderColor', 'cornerSize', 'cornerShape', 'cornerBackgroundColor', 'cornerPadding', 'reverse', 'shadow', 'filters'])), screenShot:designerCanvasObj.toDataURL()};
               
        for(var key in canvDataobj)
        {
          delete canvDataobj[key].screenShot;
        }
        $('.ajax-overlay, .ajax-overlay').show();
        
        $.ajax({
            url: baseURL + '/ajax/save_custom_data',
            type: 'POST',
            cache: false,
            headers: { 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content') },
            data: {product_id:$('#product_id').val(), _data:canvDataobj},

            success: function(data)
            {
              if(data.status && data.status === 'success')
              {
                window.location.href = window.location.href;
              }
            },

            error:function(){}
        });
        
      });
    }
  },
  
  _remove_custom_design:function()
  {
    if($('#remove_custom_design').length>0)
    {
      $('#remove_custom_design').on('click', function(e)
      {
        e.preventDefault();
        allPanelHide();
        
        $.ajax({
            url: baseURL +'/ajax/remove_custom_data',
            type: 'POST',
            cache: false,
            headers: { 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content') }, 
            data: {product_id:$('#product_id').val()},

            success: function(data)
            {
              if(data.status && data.status === 'deleted')
              {
                window.location.href = window.location.href;
              }
            },

            error:function(){}
        });
      });
    }
  },
  
  _add_to_cart_process:function()
  {
    if($('.customize-page-add-to-cart').length>0){
      $('.customize-page-add-to-cart').on('click', function(e){
        e.preventDefault();
        var current_obj = $(this);
        var img_data_ary = [];
        allPanelHide();
    
        canvDataobj[prev_canvobj] = {objId:prev_canvobj, customdata:JSON.stringify(designerCanvasObj.toJSON(['id','name','itemName', 'lockMovementX', 'lockMovementY', 'lockScalingX', 'lockScalingY', 'lockRotation', 'hasControls', 'hasBorders', 'lockSystem', 'textAlign', 'radius', 'spacing', 'hasRotatingPoint', 'padding', 'angle', 'strokeWidth', 'stroke', 'borderColor', 'cornerSize', 'cornerShape', 'cornerBackgroundColor', 'cornerPadding', 'reverse', 'shadow', 'filters'])), screenShot:designerCanvasObj.toDataURL()};
        
        
        //manage image data for save
        for(var key in canvDataobj){
          var obj = {};
          obj.name = 'custom_design_product_' + canvDataobj[key].objId;
          obj.file = createBlob(canvDataobj[key].screenShot);

          img_data_ary.push(obj);
        }
        
        var formdata = new FormData();
                    
        for(var j = 0; j< img_data_ary.length; j++){
          formdata.append(img_data_ary[j].name, img_data_ary[j].file);
        }
        
        $('#cart_page_overlay').show();
        
        var xhrForm = new XMLHttpRequest();
        xhrForm.open("POST", baseURL + "/ajax/save_custom_design_img");
        xhrForm.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
        xhrForm.send(formdata);

        xhrForm.onreadystatechange = function () {
          if (xhrForm.readyState === 4 && xhrForm.status == 200) {
            var parseResponse = $.parseJSON(xhrForm.responseText);
            designer.function._final_step_for_add_to_cart_process(canvDataobj, current_obj, parseResponse._access_token);
          }
        };
      });
    }
  }
  
};
		
designer.function = {
  _resizeCanvas:function()
  {	
    designer.function._objectResize();
  },
	
  _objectResize:function()
  {
    var width, height;

    if(screen.width <= 500) 
    {
      if(designer_settings_data.canvas_dimension.small_devices.width)
      {
        width = designer_settings_data.canvas_dimension.small_devices.width;
      }
      else
      {
        width = 280;
      }

      if(designer_settings_data.canvas_dimension.small_devices.height)
      {
        height = designer_settings_data.canvas_dimension.small_devices.height;
      }
      else
      {
        height = 300;
      }
    }
    else if (screen.width <= 768 &&  screen.width >= 501) 
    {
      if(designer_settings_data.canvas_dimension.medium_devices.width)
      {
        width = designer_settings_data.canvas_dimension.medium_devices.width;
      }
      else
      {
        width = 480;
      }

      if(designer_settings_data.canvas_dimension.medium_devices.height)
      {
        height = designer_settings_data.canvas_dimension.medium_devices.height;
      }
      else
      {
        height = 480;
      }
    }
    else if (screen.width >= 769) 
    {
      if(designer_settings_data.canvas_dimension.large_devices.width)
      {
        width = designer_settings_data.canvas_dimension.large_devices.width;
      }
      else
      {
        width = 500;
      }

      if(designer_settings_data.canvas_dimension.large_devices.height)
      {
        height = designer_settings_data.canvas_dimension.large_devices.height;
      }
      else
      {
        height = 550;
      }
    } 

    designerCanvasObj.setWidth(width);
    designerCanvasObj.setHeight(height);
    
    if($('.canvas-design-panel').length>0 && $('.canvas-container-main').length>0)
    {
      $('.canvas-design-panel').css({"width": parseInt(width), "height": parseInt(height)});
      $('.canvas-container-main').css({"width": parseInt(width) + 150, "height": parseInt(height) + 150});
    }
    
    if(design_save_json_data && $('#hf_design_save_json_data').val().length > 0)
    {
      loadSaveJsonToCanvas(prev_canvobj);
    }
    else
    {
      if($('#track_is_loaded_first').length>0)
      {
        if($('#track_is_loaded_first').val())
        {
          designer.function._design_bg_img_load( $('#track_is_loaded_first').val());
        }
      }
      
      if($('#track_is_trans_loaded_first').length>0)
      {
        if($('#track_is_trans_loaded_first').val())
        {
          designer.function._design_trans_img_load( $('#track_is_trans_loaded_first').val());
        }
      }
    }

//    var scaleMultiplier = $(".canvas-container-main").width() / designerCanvasObj.width;
//
//    var objects = designerCanvasObj.getObjects();
//    for (var i in objects) {
//                    objects[i].scaleX = objects[i].scaleX * scaleMultiplier;
//                    objects[i].scaleY = objects[i].scaleY * scaleMultiplier;
//                    objects[i].left = objects[i].left * scaleMultiplier;
//                    objects[i].top = objects[i].top * scaleMultiplier;
//                    objects[i].setCoords();
//    }

    designerCanvasObj.renderAll();
    designerCanvasObj.calcOffset();
  },
	
  _add_dynamic_text_to_design:function()
  {
    var strObj = new fabric.Text( 'Enter Your Text' ,{
            angle: 0,
            fontSize:20,
            fill:'#444444',
            itemName:'normal_text',
            hasRotatingPoint: false,
            fontFamily:'arial',
            padding:10,
            lockSystem    : false
    });

    designerCanvasObj.add( strObj );
    designerCanvasObj.centerObject( strObj );

    designerCanvasObj.setActiveObject( strObj );
    strObj.setCoords();

    designerCanvasObj.calcOffset();
    designerCanvasObj.renderAll();

  },
  
  _image_gallery:function()
  {
    $('.designer-image-gallery').show();
    show_gallery_image_cat_list();
  },
  
   _image_upload_option:function()
  {
    $('.designer-upload-image').show();
  },
  
  _designer_view_clear:function()
  {
    allPanelHide();
  },

  _designer_viewObject:function()
  {
    selectedObj = designerCanvasObj.getActiveObject();
    
    if(selectedObj)
    {
      designer.function._fabric_control_icon_change( selectedObj );
    }
    
    if(selectedObj && (selectedObj.itemName === 'normal_text' || selectedObj.itemName === 'curvedText'))
    {
      if($('.designer-text-control').length>0)
      {
        
        $('.designer-text-control #change_dynamic_text').val(selectedObj.getText());
        
        if(selectedObj.itemName === 'normal_text')
        {
          if($('#enableCurvedText').is(':checked'))
          {
            $('#enableCurvedText').prop('checked', false);
            $('.curved-text-elements').fadeOut();
          }
        }
        else if(selectedObj.itemName === 'curvedText')
        {
          if($('#enableCurvedText').not(':checked'))
          {
            $('#enableCurvedText').prop('checked', true);
            
            $curveRadius.update({ from: selectedObj.radius });
            $curveSpacing.update({ from: selectedObj.spacing });
            
            $('.curved-text-elements').fadeIn();
          }
          
          if(selectedObj.reverse)
          {
            $('#enableCurvedTextReverse').prop('checked', true);
          }
          else
          {
            $('#enableCurvedTextReverse').prop('checked', false);
          }
        }
        
        if(selectedObj.getFontFamily())
        {
          $('#change_fonts').select2('val', selectedObj.getFontFamily());
        }
        
        if(selectedObj.getLineHeight())
        {
          $lineHeightRange.update({ from: selectedObj.getLineHeight()});
        }
        
        if(selectedObj.getFill())
        {
          $('#change_text_color').val( selectedObj.getFill().split('#')[1] );
          $('#change_text_color').css('background-color', selectedObj.getFill());
        }
        
        if(selectedObj.getOpacity())
        {
          $textOpacity.update({ from: selectedObj.getOpacity()});
        }
        
        if(selectedObj.getShadow())
        {
          var shadow_obj = selectedObj.getShadow();
          
          $('#change_text_shadow_color').val( shadow_obj.color.split('#')[1] );
          $('#change_text_shadow_color').css('background-color', shadow_obj.color);
          
          $textShadowX.update({ from: shadow_obj.offsetX});
          $textShadowY.update({ from: shadow_obj.offsetY});
          $shadowBlur.update({ from: shadow_obj.blur});
        }
        else
        {
          $('#change_text_shadow_color').val( 'FFFFFF' );
          $('#change_text_shadow_color').css('background-color', "#FFFFFF");
          
          $textShadowX.update({ from: -10});
          $textShadowY.update({ from: 0});
          $shadowBlur.update({ from: 0});
        }
        
        if(selectedObj.lockSystem)
        {
          if($('.object-lock').length>0)
          {
            $('.object-lock').find('span').removeClass().addClass('icon-object-unlock');
          }       
        }
        else
        {
          if($('.object-lock').length>0)
          {
            $('.object-lock').find('span').removeClass().addClass('icon-object-lock');
          } 
        }
        
        $('.designer-text-control').show();
        if($('.designer-image-edit-panel').css('display') === 'block')
        {
          $('.designer-image-edit-panel').hide();
        }
        if($('.designer-image-gallery').css('display') === 'block')
        {
          $('.designer-image-gallery').hide();
        }
      }
    }
    else if(selectedObj && (selectedObj.itemName === 'gallery_image' || selectedObj.itemName === 'upload_image'))
    {
      $('.designer-image-edit-panel').show();
      if($('.designer-text-control').css('display') === 'block')
      {
        $('.designer-text-control').hide();
      }
    }
  },

  _fabric_control_icon_change:function( obj )
  {
    obj.customiseCornerIcons( {
      settings: {
                borderColor: '#6B7983',
                cornerSize: 20,
                cornerShape: 'rect',
                cornerBackgroundColor: '#6B7983',
                cornerPadding: 9
      },
      tl: {
                icon: $('#hf_base_url').val() + '/resources/assets/designer/icons/rotate.png'
      },
      br: {
                icon: $('#hf_base_url').val() + '/resources/assets/designer/icons/resize.png'
      }
    }, function() {
                designerCanvasObj.renderAll();
    } );
  },
  
  _design_bg_img_load:function(url)
  {
    if(url)
    {
      designerCanvasObj.setBackgroundImage(url, designerCanvasObj.renderAll.bind(designerCanvasObj), 
      {
        backgroundImageStretch: false,
        width:  parseInt( designerCanvasObj.getWidth() - 20 ),
        height: parseInt( designerCanvasObj.getHeight() - 20),
        left:10,
        top:10
      });
    }
  },
  
  _design_trans_img_load:function(url)
  {
    if(url)
    {
      designerCanvasObj.setOverlayImage(url, designerCanvasObj.renderAll.bind(designerCanvasObj), {
        width:  parseInt( designerCanvasObj.getWidth() - 20 ),
        height: parseInt( designerCanvasObj.getHeight() - 20),
        left:10,
        top:10
      });
    }
  },
  
  _design_rearrange_again:function(target, obj)
  {
    if(target === 'edit_text')
    {
      selectedObj.setText( obj.val() );
    }
    else if(target === 'change_fonts_family')
    {
      selectedObj.set( obj.data('name'), obj.val() );
    }
    else if(target === 'change_text_color')
    {
      selectedObj.set( obj.data('name'), '#' + obj.val() );
    }
    else if(target === 'change_img_color')
    {
      var filter = new fabric.Image.filters.Tint({
        color: obj.val()
      });
      selectedObj.filters.push(filter);
      selectedObj.applyFilters(designerCanvasObj.renderAll.bind(designerCanvasObj));
    }
    else if(target === 'change_alignment')
    {
      if(obj.attr('class') === 'align-left')
      {
        selectedObj.set('textAlign', 'left');
      }
      else if(obj.attr('class') === 'align-center')
      {
        selectedObj.set('textAlign', 'center');
      }
      else if(obj.attr('class') === 'align-right')
      {
        selectedObj.set('textAlign', 'right');
      }
    }
    else if(target === 'change_style')
    {
      if(obj.attr('class') === 'normal')
      {
        selectedObj.set('fontWeight', 'normal');
        selectedObj.set('fontStyle', 'normal');
      }
      else if(obj.attr('class') === 'bold')
      {
        selectedObj.set('fontWeight', 'bold');
      }
      else if(obj.attr('class') === 'italic')
      {
        selectedObj.set('fontStyle', 'italic');
      }
    }
    else if(target === 'change_decoration')
    {
      if(obj.attr('class') === 'underline')
      {
        selectedObj.set('textDecoration', 'underline');
      }
      else if(obj.attr('class') === 'line-through')
      {
        selectedObj.set('textDecoration', 'line-through');
      }
      else if(obj.attr('class') === 'overline')
      {
        selectedObj.set('textDecoration', 'overline');
      }
      else if(obj.attr('class') === 'none')
      {
        selectedObj.set('textDecoration', '');
      }
    }
    else if(target === 'more_action' )
    {
      if(obj.data('name') === 'flip-x')
      {
        if(selectedObj.getFlipY() == true)
        {
          selectedObj.set('flipY', false); 
        }
        selectedObj.set('flipX', true);
      }
      else if(obj.data('name') === 'flip-y')
      {
        if(selectedObj.getFlipX() == true)
        {
          selectedObj.set('flipX', false); 
        }
        selectedObj.set('flipY', true);
      }
      else if(obj.data('name') === 'move-front')
      {
        designerCanvasObj.bringToFront( selectedObj );
      }
      else if(obj.data('name') === 'move-back')
      {
        designerCanvasObj.sendToBack( selectedObj );
      }
      else if(obj.data('name') === 'lock' && obj.find('.icon-object-lock').length>0)
      {
        selectedObj.set({
          lockMovementX : true,
          lockMovementY : true,
          lockScalingX  : true,
          lockScalingY  : true,
          lockRotation  : true,
          hasControls   : false,
          hasBorders    : false,
          lockSystem    : true
        });
        
        obj.find('.icon-object-lock').removeClass('icon-object-lock').addClass('icon-object-unlock');
        canvasDeactivateActiveObject();
      }
      else if(obj.data('name') === 'lock' && obj.find('.icon-object-unlock').length>0)
      {
        selectedObj.set({
          lockMovementX : false,
          lockMovementY : false,
          lockScalingX  : false,
          lockScalingY  : false,
          lockRotation  : false,
          hasControls   : true,
          hasBorders    : true,
          lockSystem    : false
        });
        
        obj.find('.icon-object-unlock').removeClass('icon-object-unlock').addClass('icon-object-lock');
        canvasDeactivateActiveObject();
      }
    }
    else if(target === 'reverse' )
    {
      selectedObj.set(obj.data('name'), obj.is(':checked')); 
    }
    
    designerCanvasObj.renderAll();
  },
  
  _shadow_elements:function(obj, val)
  {
    var color, shadowObj;
    var offset_x	= 0;
    var offset_y	= 0;
    var blur            = 0;

    if(selectedObj)
    {
      shadowObj = selectedObj.getShadow();
    }
    
    if(obj.data('name') === 'color')
    {
      color = '#' + obj.val();
    }
    else
    {
      if(shadowObj)
      {
        color = shadowObj.color;
      }
    }

    if(obj.data('name') === 'offset_x')
    {
      offset_x = val;
    }
    else
    {
      if(shadowObj)
      {
        offset_x = shadowObj.offsetX;
      }
    }

    if(obj.data('name') === 'offset_y')
    {
      offset_y = val;
    }
    else
    {
      if(shadowObj)
      {
        offset_y = shadowObj.offsetY;
      }
    }

    if(obj.data('name') === 'blur')
    {
      blur = val;
    }
    else
    {
      if(shadowObj)
      {
        blur = shadowObj.blur;
      }
    }
    
    selectedObj.set('shadow', {color: color, blur: blur, offsetX: offset_x, offsetY: offset_y});
    designerCanvasObj.renderAll();
  },
  
  _dynamic_image_add_at_design:function( type, url )
  {
    if(url)
    {
      var randomID = _makeid();
      var image_name = '';
      
      if(type === 'upload_image')
      {
        image_name = 'upload_image';
      }
      else
      {
        image_name = 'gallery_image';
      }

      var ImgObj = new Image();
      ImgObj.src = url;

      ImgObj.onload = function () 
      {
        var image = new fabric.Image( ImgObj );

        image.set({
            itemName:image_name,
            id:randomID,
            hasRotatingPoint: false,
            lockSystem    : false,
            padding:10
        });
        var getRatio = _scaleImageSize( 100, 110, image.getWidth(), image.getHeight());
        image.setWidth( getRatio[0] );
        image.setHeight( getRatio[1] );

        designerCanvasObj.add( image );
        designerCanvasObj.setActiveObject( image );
        designerCanvasObj.centerObject( image );

        image.setCoords();

        designerCanvasObj.calcOffset();
        designerCanvasObj.renderAll();
      }
    }
  },
  
  _img_preview:function()
  {
    if($('#designPreview').length>0)
    {
      $('#designPreview .modal-body img').attr('src', designerCanvasObj.toDataURL());
      $('#designPreview').modal('show');
    }
  },
  
  _manage_swap_content:function(obj)
  {
    var current_item_id = obj.data('id');
    allPanelHide();
    
    canvDataobj[prev_canvobj] = {objId:prev_canvobj, customdata:JSON.stringify(designerCanvasObj.toJSON(['id','name','itemName', 'lockMovementX', 'lockMovementY', 'lockScalingX', 'lockScalingY', 'lockRotation', 'hasControls', 'hasBorders', 'lockSystem', 'textAlign', 'radius', 'spacing', 'hasRotatingPoint', 'padding', 'angle', 'strokeWidth', 'stroke', 'borderColor', 'cornerSize', 'cornerShape', 'cornerBackgroundColor', 'cornerPadding', 'reverse', 'shadow', 'filters'])), screenShot:designerCanvasObj.toDataURL()};
    
    designerCanvasObj.clear();
    prev_canvobj = current_item_id;
    
    
    if(typeof(canvDataobj[current_item_id])!= 'undefined')
    {
      designerCanvasObj.loadFromJSON(canvDataobj[current_item_id].customdata, function () 
      {
        var objLen = designerCanvasObj.getObjects().length;
        var renderIfAll = function () 
        {
          if (--objLen == 0) 
          {
            designerCanvasObj.renderAll();
          }
        };
        
        designerCanvasObj.forEachObject(function(obj) 
        {
          if (obj.type === 'image' && obj.filters.length) 
          {
            obj.applyFilters(renderIfAll);
          }
        });
      }); 
      
      if(!obj.data('design_trans_img_url'))
      {
        designerCanvasObj.overlayImage = null;
        designerCanvasObj.renderAll.bind(designerCanvasObj);
      }
    }
    else
    {
      if(design_save_json_data && $('#hf_design_save_json_data').val().length > 0)
      {
        loadSaveJsonToCanvas(current_item_id);
        if(!obj.data('design_trans_img_url'))
        {
          designerCanvasObj.overlayImage = null;
          designerCanvasObj.renderAll.bind(designerCanvasObj);
        }
      }
      else
      {
        if(obj.data('design_img_url'))
        {
          designer.function._design_bg_img_load( obj.data('design_img_url') );
        }
        
        if(obj.data('design_trans_img_url'))
        {
          designer.function._design_trans_img_load( obj.data('design_trans_img_url') );
        }
        else
        {
          designerCanvasObj.overlayImage = null;
          designerCanvasObj.renderAll.bind(designerCanvasObj);
        }
      }
    }
  },
  
  _final_step_for_add_to_cart_process:function(customize_data, obj, accessToken)
  {
    var dataObj = {};
    
    dataObj.product_id = obj.data('id');
    
    if($('#quantity').length>0){
      dataObj.qty = parseInt( $('#quantity').val() );
    }
    else{
      dataObj.qty = 1;
    }
    
    if($('#selected_variation_id').length>0 && $('#selected_variation_id').val()){
      dataObj.variation_id = parseInt( $('#selected_variation_id').val() );
    }
    
    //remove screenshot
    for(var key in customize_data){
      if(customize_data[key].screenShot != 'undefined'){
        delete customize_data[key].screenShot;
      }
    }
    
    if(customize_data){
      dataObj.customizeData = customize_data;
    }
    
    if(accessToken){
      dataObj.accessToken = accessToken;
    }
    
    $.ajax({
        url: baseURL + '/ajax/customize-product-add-to-cart',
        type: 'POST',
        cache: false,
        headers: { 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content') },  
        data: dataObj,

        success: function(data){
          $('#cart_page_overlay').hide();
          
          if(data && data == 'zero_price'){
            swal("" , designerLocalizationString.designer_price_can_not_zero);
          }
          else if(data && data == 'out_of_stock'){
            swal("" , designerLocalizationString.designer_product_out_of_stock);
          }
          else if(data && data == 'item_added'){
            swal({
              title: designerLocalizationString.designer_item_added_successfully,
              text: designerLocalizationString.designer_cart_page_view,
              type: "info",
              showCancelButton: true,
              closeOnConfirm: false,
              showLoaderOnConfirm: true,
            },
            function(){
              if($('#cart_url').length>0){
                window.location.href = $('#cart_url').val();
              }
            }
            );
          }
        },
        error:function(){}
    });
  }
};

var canvasDeactivateAll = function()
{
  designerCanvasObj.deactivateAll();
  designerCanvasObj.renderAll();
}

var canvasDeactivateActiveObject = function()
{
  designerCanvasObj.discardActiveObject();
  designerCanvasObj.renderAll(); 
}

var getItemByName = function(name) 
{
  var object = null;
  designerCanvasObj.forEachObject(function(obj){
    if(obj.name === name)
    {
      object = obj;
      return false;
    }
  });
  return object;
}

var loadSaveJsonToCanvas = function(selected_obj_id)
{
  var selected_json_data = '';
      
  $.each(design_save_json_data, function(key, val) 
  {             
    if(key === selected_obj_id)
    {
      selected_json_data = val.customdata;
      return false;
    }
  });
      
  if(selected_json_data)
  {
    designerCanvasObj.loadFromJSON(selected_json_data, function () 
    {
      var objLen = designerCanvasObj.getObjects().length;
      
      var renderIfAll = function () 
      {
        if (--objLen == 0) 
        {
          designerCanvasObj.renderAll();
        }
      };

      designerCanvasObj.forEachObject(function(obj) 
      {
        if (obj.type === 'image' && obj.filters.length) 
        {
          obj.applyFilters(renderIfAll);
        } 
        else 
        {
          renderIfAll();
        }
      });
    });
  }
}


$(document).ready(function()
{
  designer.onPageLoad._designer_init();
});