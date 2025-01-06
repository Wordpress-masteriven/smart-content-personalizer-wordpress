<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

function enqueue_styles(){
  wp_enqueue_style('admin_style',plugin_dir_url(__FILE__).'src/styles/backend/style.css');
  wp_enqueue_script('admin_script',plugin_dir_url(__FILE__).'src/scripts/backend/admin.js',array('jquery'),'1.0',true);
}
add_action('admin_enqueue_scripts','enqueue_styles');

add_action('wp',function(){

  // $_SERVER['REMOTE_ADDR']
  $singleUserIp = $_SERVER['REMOTE_ADDR'];
  //$currentDate = date('d-m-y');
  $currentDate = date('d-m-y');
  $usersIp = get_option('countUsersIp');
  if(is_user_logged_in()){
     //login user
    $user = '1';
  }else{
    //guest
    $user = '0';
  }
  $usersIp[] = array(
    'userIp' => $singleUserIp,
    'currentDate'=> $currentDate,
    'userRegistered' => $user
  );
  add_option('countUsersIp',$usersIp);
  $usersIp1 = get_option('countUsersIp');
    if(is_user_logged_in()){
       //login user
      $user = '1';
    }else{
      //guest
      $user = '0';
    }


   foreach($usersIp1 as $key => $userIp){
     if($usersIp1[$key]['userIp'] == $singleUserIp && $usersIp1[$key]['currentDate'] == $currentDate){
      return;
     }
   }

    $usersIp1[] = [
      'userIp' => $singleUserIp,
      'currentDate'=> $currentDate,
      'userRegistered' => $user
    ];

  update_option('countUsersIp',$usersIp1);
});


add_shortcode( 'newGuestContentShortcode', 'newGuestContentShortcodeFunc' );
  function newGuestContentShortcodeFunc(){
    $guestContent = '';
    if(!is_user_logged_in()){
    $postId = get_option('postIdSmartContent');
    if($postId){
      $guestContent = get_post_meta($postId,'new_guest_smart_content_textarea',true);
    }
  }
  return $guestContent;
}

add_shortcode( 'registeredUserContentShortcode', 'registeredUserContentShortcodeFunc' );

  function registeredUserContentShortcodeFunc(){
    $registeredUserContent = '';
    if(is_user_logged_in()){
    $postId = get_option('postIdSmartContent');
    if($postId){
      $registeredUserContent = get_post_meta($postId,'register_smart_content_textarea',true);
    }
  }
  return $registeredUserContent;
}

add_shortcode( 'returnUserContentShortcode', 'returnUserContentShortcodeFunc' );

  function returnUserContentShortcodeFunc(){
    $returnUserContent = '';
    $usersIp = get_option('countUsersIp');
     // $_SERVER['REMOTE_ADDR']
    $singleUserIp = $_SERVER['REMOTE_ADDR'];
    $counterIpNumbpers = 0;
    foreach($usersIp as $key => $userIp){
      if($usersIp[$key]['userIp'] == $singleUserIp){
          $counterIpNumbpers++;
      }
    }

    if(is_user_logged_in() && $counterIpNumbpers >= 2){
    $postId = get_option('postIdSmartContent');
    if($postId){
      $returnUserContent = get_post_meta($postId,'return_smart_content_textarea',true);
    }
  }
  return $returnUserContent;
}

add_shortcode( 'LocalUserContentShortcode', 'LocalUserContentShortcodeFunc' );

  function LocalUserContentShortcodeFunc(){
    $postId = get_option('postIdSmartContent');

    //user ip
    $userip = $_SERVER['REMOTE_ADDR']; // Get user IP
    $response = file_get_contents("http://ip-api.com/json/{$userip}");
    $locationUser = json_decode($response, true);
    
    //owner ip
    $ownerIp = get_option('ownerIp'); // Get owner IP
    $response1 = file_get_contents("http://ip-api.com/json/{$ownerIp}");
    $locationOwner = json_decode($response1, true);

    $localUserContent  = '';
    if($postId && $locationOwner == $locationUser){
    $localUserContent = get_post_meta($postId,'Local_smart_content_textarea',true);
   }
  return $localUserContent;
}

add_shortcode( 'WorldwideUserContentShortcode', 'WorldwideUserContentShortcodeFun' );

  function WorldwideUserContentShortcodeFun(){
    $postId = get_option('postIdSmartContent');

    //user ip
    $userip = $_SERVER['REMOTE_ADDR']; // Get user IP
    $response = file_get_contents("http://ip-api.com/json/{$userip}");
    $locationUser = json_decode($response, true);
    
    //owner ip
    $ownerIp = get_option('ownerIp'); // Get owner IP
    $response1 = file_get_contents("http://ip-api.com/json/{$ownerIp}");
    $locationOwner = json_decode($response1, true);
    
    $worldWideUserContent  = '';
    if($postId && $locationOwner != $locationUser){
    $worldWideUserContent = get_post_meta($postId,'world_smart_content_textarea',true);
   }
  return $worldWideUserContent;
}

add_shortcode( 'SpecificTimeContentShortcode', 'SpecificTimeContentShortcodeFunc' );

  function SpecificTimeContentShortcodeFunc(){
    $postId = get_option('postIdSmartContent');
    $timeSelected = get_post_meta($postId,'specific_time_hour',true);
    $currentTime = ltrim(current_time('h A'),'0');
    $specificTimeContent  = '';
    if($postId && $currentTime == $timeSelected ){
    $specificTimeContent = get_post_meta($postId,'specific_time_smart_content_textarea',true);
   }
  return $specificTimeContent;
}

add_shortcode( 'betweenTimesContentShortcode', 'betweenTimesContentShortcodeFunc' );

  function betweenTimesContentShortcodeFunc(){
    $postId = get_option('postIdSmartContent');
    $currentTime = new DateTime(date('h:i'));
    $fromTime =  new DateTime(get_post_meta($postId,'from_time_smart_content',true));
    $ToTime = new DateTime(get_post_meta($postId,'to_time_smart_content',true));
       //23:00 > 02:00   current time = 1:00
    if ($fromTime > $ToTime) {
      $betweenTimes = $currentTime >= $fromTime || $currentTime <= $ToTime ? true : false;
  } else {
      $betweenTimes =  $currentTime >= $fromTime && $currentTime <= $ToTime ? true : false;
  }
    $betweenTimesContent  = '';
    if($postId && $betweenTimes == true ){
    $betweenTimesContent = get_post_meta($postId,'between_time_smart_content_textarea',true);
   }
  return $betweenTimesContent;
}

add_shortcode( 'specificDayTimeContentShortcode', 'specificDayTimeContentShortcodeFunc' );

function specificDayTimeContentShortcodeFunc(){
  $postId = get_option('postIdSmartContent');
  $dayToday = '';
  $currentTime = ltrim(current_time('h A'),'0');
  $selectedDay = get_post_meta($postId,'selected_day_smart_content',true);
  $selectedTime = get_post_meta($postId,'selected_day_hour_smart_content',true);
  $DayOfWeekNumber = date("w");
  switch($DayOfWeekNumber)
  {
     case 0 : $dayToday = 'Sunday'; break;
     case 1 : $dayToday ='Monday'; break;
     case 2 : $dayToday = "Tuesday"; break;
     case 3 : $dayToday =  "Wednesday"; break;
     case 4 : $dayToday  =  "Thursday"; break;
     case 5 : $dayToday  =  "Friday"; break;
     case 6 : $dayToday  =  "Saturday" ; break;
  }
  $dayTimesContent  = '';
  if($postId && $selectedDay == $dayToday && $currentTime == $selectedTime ){
  $dayTimesContent = get_post_meta($postId,'specific_days_smart_content_textarea',true);
 }
return $dayTimesContent;
}

function update_cart_last_activity_time() {
  if (WC()->cart) {
      WC()->session->set('cart_last_activity', time());
  }
}
add_action('woocommerce_add_to_cart', 'update_cart_last_activity_time');


add_shortcode( 'abandonedCartContentTimeContentShortcode', 'abandonedCartContentTimeContentShortcodeFunc' );

function abandonedCartContentTimeContentShortcodeFunc(){
  $postId = get_option('postIdSmartContent');

    $last_activity = WC()->session->get('cart_last_activity');
    $abandonedCartTime = get_post_meta($postId,'time_abandoned_cart_minutes_smart_content',true);  
    $abandonedCartAfterTime = get_post_meta($postId,'time_abandoned_cart_after_minutes_smart_content',true);  
    $abandonment_timeout = floatval($abandonedCartTime) * 60;
    $abandonment_timeout_after = floatval($abandonedCartTime + $abandonedCartAfterTime) * 60;
    $abandonedCart = false;
    if ($last_activity) {
        $current_time = time();
        if (($current_time - $last_activity) > $abandonment_timeout) {
            do_action('woocommerce_abandoned_cart');
            $abandonedCart = true;
        }
        if (($current_time - $last_activity) > $abandonment_timeout_after) {
          $abandonedCart = false;
      }
    }

  $abandonedCartContent  = '';
  
  if($postId && $abandonedCart == true){
  $abandonedCartContent = get_post_meta($postId,'specific_abandoned_cart_content_textarea',true);
  }
  return $abandonedCartContent;
}

?>
