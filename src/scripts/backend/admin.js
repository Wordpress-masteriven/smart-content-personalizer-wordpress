jQuery(function($){
    if($('#new_guest_checkbox').is(':checked')){
        $('#wp-guest_textArea_id-editor-container').css('display','block');
        $('#wp-guest_textArea_id-editor-tools').css('display','block');
    }

    if($('#return_user_checkbox').is(':checked')){
        $('#wp-return_textArea_id-editor-container').css('display','block');
        $('#wp-return_textArea_id-editor-tools').css('display','block');
    }

    if($('#registered_user_checkbox').is(':checked')){
        $('#wp-registered_textArea_id-editor-container').css('display','block');
       $('#wp-registered_textArea_id-editor-tools').css('display','block');
    }

    if($('#local_user_checkbox').is(':checked')){
        $('#wp-my_country_textArea_id-editor-container').css('display','block');
       $('#wp-my_country_textArea_id-editor-tools').css('display','block');
    }

    if($('#worldwide_user_checkbox').is(':checked')){
        $('#wp-world_textArea_id-editor-container').css('display','block');
        $('#wp-world_textArea_id-editor-tools').css('display','block');
    }

    if($('#specific_time_checkbox').is(':checked')){
        $('#wp-specific_time_textArea_id-editor-container').css('display','block');
        $('#wp-specific_time_textArea_id-editor-tools').css('display','block');
    }

    if($('#between_time_checkbox').is(':checked')){
        $('#wp-between_times_textArea_id-editor-container').css('display','block');
        $('#wp-between_times_textArea_id-editor-tools').css('display','block');
    }

    if($('#specific_days_checkbox').is(':checked')){
        $('#wp-specific_days_textArea_id-editor-container').css('display','block');
        $('#wp-specific_days_textArea_id-editor-tools').css('display','block');
    }

    if($('#content_abandoned_cart_checkbox').is(':checked')){
        $('#wp-cart_customers_textArea_id-editor-container').css('display','block');
        $('#wp-cart_customers_textArea_id-editor-tools').css('display','block');
    }

   $('#new_guest_checkbox').on('click',function(){
     if($(this).is(':checked')){
        $('#wp-guest_textArea_id-editor-container').css('display','block');
        $('#wp-guest_textArea_id-editor-tools').css('display','block');
     }else{
        $('#wp-guest_textArea_id-editor-container').css('display','none');
        $('#wp-guest_textArea_id-editor-tools').css('display','none');
     }
   });

   $('#return_user_checkbox').on('click',function(){
    if($(this).is(':checked')){
       $('#wp-return_textArea_id-editor-container').css('display','block');
       $('#wp-return_textArea_id-editor-tools').css('display','block');
    }else{
       $('#wp-return_textArea_id-editor-container').css('display','none');
       $('#wp-return_textArea_id-editor-tools').css('display','none');
    }
  });

  $('#registered_user_checkbox').on('click',function(){
    if($(this).is(':checked')){
       $('#wp-registered_textArea_id-editor-container').css('display','block');
       $('#wp-registered_textArea_id-editor-tools').css('display','block');
    }else{
       $('#wp-registered_textArea_id-editor-container').css('display','none');
       $('#wp-registered_textArea_id-editor-tools').css('display','none');
    }
  });

  $('#local_user_checkbox').on('click',function(){
    if($(this).is(':checked')){
       $('#wp-my_country_textArea_id-editor-container').css('display','block');
       $('#wp-my_country_textArea_id-editor-tools').css('display','block');
    }else{
       $('#wp-my_country_textArea_id-editor-container').css('display','none');
       $('#wp-my_country_textArea_id-editor-tools').css('display','none');
    }
  });

  $('#worldwide_user_checkbox').on('click',function(){
    if($(this).is(':checked')){
       $('#wp-world_textArea_id-editor-container').css('display','block');
       $('#wp-world_textArea_id-editor-tools').css('display','block');
    }else{
       $('#wp-world_textArea_id-editor-container').css('display','none');
       $('#wp-world_textArea_id-editor-tools').css('display','none');
    }
  });

  $('#specific_time_checkbox').on('click',function(){
    if($(this).is(':checked')){
       $('#wp-specific_time_textArea_id-editor-container').css('display','block');
       $('#wp-specific_time_textArea_id-editor-tools').css('display','block');
    }else{
       $('#wp-specific_time_textArea_id-editor-container').css('display','none');
       $('#wp-specific_time_textArea_id-editor-tools').css('display','none');
    }
  });

  $('#between_time_checkbox').on('click',function(){
    if($(this).is(':checked')){
       $('#wp-between_times_textArea_id-editor-container').css('display','block');
       $('#wp-between_times_textArea_id-editor-tools').css('display','block');
    }else{
       $('#wp-between_times_textArea_id-editor-container').css('display','none');
       $('#wp-between_times_textArea_id-editor-tools').css('display','none');
    }
  });

  $('#specific_days_checkbox').on('click',function(){
    if($(this).is(':checked')){
       $('#wp-specific_days_textArea_id-editor-container').css('display','block');
       $('#wp-specific_days_textArea_id-editor-tools').css('display','block');
    }else{
       $('#wp-specific_days_textArea_id-editor-container').css('display','none');
       $('#wp-specific_days_textArea_id-editor-tools').css('display','none');
    }
  });

  $('#content_abandoned_cart_checkbox').on('click',function(){
    if($(this).is(':checked')){
       $('#wp-cart_customers_textArea_id-editor-container').css('display','block');
       $('#wp-cart_customers_textArea_id-editor-tools').css('display','block');
    }else{
       $('#wp-cart_customers_textArea_id-editor-container').css('display','none');
       $('#wp-cart_customers_textArea_id-editor-tools').css('display','none');
    }
  });
  let dataHour = $('#hour_select').attr('data-hour');
  $('#hour_select option').each(function(){
      return $(this).text() === dataHour ? $(this).attr('selected','selected') : '';
   });
   let dataHourDay = $('#hour_select_days').attr('data-hour-days');
   $('#hour_select_days option').each(function(){
       return $(this).text() === dataHourDay ? $(this).attr('selected','selected') : '';
    });
});
