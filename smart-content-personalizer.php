<?php
/*
  Plugin Name: Smart Content Personalizer
  Description: Allowing Content Managers To Display Custom Contents On The Site.
  Version: 1.0
  Author: Tal Rimer
  License: GPLv3 or later License
  License URI: http://www.gnu.org/licenses/gpl-3.0.html
  Text Domain: smart-content-personalizer
*/

require_once('functions.php');

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

 add_action('admin_menu','smart_content_menu');

  function smart_content_menu(){
    add_menu_page(
      'Smart Content Personalizer',
      'Smart Content Personalizer',
      'manage_options',
      'smart-content-personalizer',
      'smart_content_func',
      'dashicons-welcome-write-blog',
      12
    );
  }

  function smart_content_func(){

    if(!get_option('smart_content_post_inserted')){
      $postIdSmartContent = wp_insert_post( array(
        'post_status' => 'publish',
        'post_type' => 'smart_content',
      ) );
      add_option('postIdSmartContent',$postIdSmartContent);
    }

    add_option('smart_content_post_inserted',true);
    $postId = get_option('postIdSmartContent');

      if(isset($_POST['new_guest_checkbox'])){
        if($_POST['new_guest_checkbox'] == 'on'){
          update_option('new_guest_checkbox_smart_content',$_POST['new_guest_checkbox']);
          if($postId){
            update_post_meta($postId,'new_guest_smart_content_textarea',$_POST['guest_textArea']);
          }
          $checkedOn ='checked';
      }else if($_POST['new_guest_checkbox'] == 'off'){
        delete_option('new_guest_checkbox_smart_content');
        delete_post_meta($postId,'new_guest_smart_content_textarea');
        $checkedOn = '';
      }
    }

    if(get_option('new_guest_checkbox_smart_content') == 'on'){
      $checkedOn ='checked';
    }else{
      $checkedOn = '';
    }

      if(isset($_POST['return_user_checkbox'])){
        if($_POST['return_user_checkbox'] == 'on'){
          update_option('return_user_checkbox_smart_content',$_POST['return_user_checkbox']);
          if($postId){
            update_post_meta($postId,'return_smart_content_textarea',$_POST['return_textArea']);
          }
          $checkedOn2 ='checked';
      }else if($_POST['return_user_checkbox'] == 'off'){
        delete_option('return_user_checkbox_smart_content');
        delete_post_meta($postId,'return_smart_content_textarea');
        $checkedOn2 = '';
      }
    }

    if(get_option('return_user_checkbox_smart_content') == 'on'){
      $checkedOn2 ='checked';
    }else{
      $checkedOn2 = '';
    }


    if(isset($_POST['registered_user_checkbox'])){
      if($_POST['registered_user_checkbox'] == 'on'){
        update_option('registered_user_checkbox_smart_content',$_POST['registered_user_checkbox']);
        update_post_meta($postId,'register_smart_content_textarea',$_POST['registered_textArea']);
        $checkedOn3 ='checked';
    }else if($_POST['registered_user_checkbox'] == 'off'){
      delete_option('registered_user_checkbox_smart_content');
      delete_post_meta($postId,'register_smart_content_textarea');
      $checkedOn3 = '';
    }
   }

    if(get_option('registered_user_checkbox_smart_content') == 'on'){
      $checkedOn3 ='checked';
    }else{
      $checkedOn3 = '';
   }
   
   if (isset($_POST['local_user_checkbox'])) {
    if ($_POST['local_user_checkbox'] == 'on') {
        update_option('local_user_checkbox_smart_content', $_POST['local_user_checkbox']);
        update_post_meta($postId,'Local_smart_content_textarea',$_POST['my_country_textArea']);
        $ownerIp = $_SERVER['REMOTE_ADDR'];
        if(!get_option('ownerIp')){
          add_option('ownerIp',$ownerIp);
        }
        $checkedOn4 = 'checked';
    } else if ($_POST['local_user_checkbox'] == 'off') {
        delete_option('local_user_checkbox_smart_content');
        delete_post_meta($postId,'Local_smart_content_textarea');
        $checkedOn4 = '';
    }
}

if (get_option('local_user_checkbox_smart_content') == 'on') {
    $checkedOn4 = 'checked';
} else {
    $checkedOn4 = '';
}

// Worldwide User Checkbox Smart Content
if (isset($_POST['worldwide_user_checkbox'])) {
    if ($_POST['worldwide_user_checkbox'] == 'on') {
        update_option('worldwide_user_checkbox_smart_content', $_POST['worldwide_user_checkbox']);
        update_post_meta($postId,'world_smart_content_textarea',$_POST['worldwide_textArea']);
        $ownerIp = $_SERVER['REMOTE_ADDR'];
        if(!get_option('ownerIp')){
          add_option('ownerIp',$ownerIp);
        }
        $checkedOn5 = 'checked';
    } else if ($_POST['worldwide_user_checkbox'] == 'off') {
        delete_option('worldwide_user_checkbox_smart_content');
        delete_post_meta($postId,'world_smart_content_textarea');
        $checkedOn5 = '';
    }
}

if (get_option('worldwide_user_checkbox_smart_content') == 'on') {
    $checkedOn5 = 'checked';
} else {
    $checkedOn5 = '';
}

// Specific Time Checkbox Smart Content
if (isset($_POST['specific_time_checkbox'])) {
    if ($_POST['specific_time_checkbox'] == 'on') {
        update_option('specific_time_checkbox_smart_content', $_POST['specific_time_checkbox']);
        update_post_meta($postId,'specific_time_smart_content_textarea',$_POST['specific_time_textArea']);
        update_post_meta($postId,'specific_time_hour',$_POST['hour_select']);
        $checkedOn6 = 'checked';
    } else if ($_POST['specific_time_checkbox'] == 'off') {
        delete_option('specific_time_checkbox_smart_content');
        delete_post_meta($postId,'specific_time_smart_content_textarea');
        $checkedOn6 = '';
    }
}
if(isset($postId)){
  if(get_post_meta($postId,'specific_time_hour',true)){
    $specific_time_hour = get_post_meta($postId,'specific_time_hour',true);
  }
}


if (get_option('specific_time_checkbox_smart_content') == 'on') {
    $checkedOn6 = 'checked';
} else {
    $checkedOn6 = '';
}

// Between Time Checkbox Smart Content
if (isset($_POST['between_time_checkbox'])) {
    if ($_POST['between_time_checkbox'] == 'on') {
        update_option('between_time_checkbox_smart_content', $_POST['between_time_checkbox']);
        update_post_meta($postId,'between_time_smart_content_textarea',$_POST['between_times_textArea_']);
        update_post_meta($postId,'from_time_smart_content',$_POST['from_time']);
        update_post_meta($postId,'to_time_smart_content',$_POST['to_time']);
        $checkedOn7 = 'checked';
    } else if ($_POST['between_time_checkbox'] == 'off') {
        delete_option('between_time_checkbox_smart_content');
        delete_post_meta($postId,'between_time_smart_content_textarea');
        $checkedOn7 = '';
    }
}

if(isset($postId)){
  if(get_post_meta($postId,'from_time_smart_content',true)){
    $from_time_value = get_post_meta($postId,'from_time_smart_content',true);
  }else{
    $from_time_value = '';
  }
  if(get_post_meta($postId,'to_time_smart_content',true)){
    $to_time_value = get_post_meta($postId,'to_time_smart_content',true);
  }else{
    $to_time_value = '';
  }
}


if (get_option('between_time_checkbox_smart_content') == 'on') {
    $checkedOn7 = 'checked';
} else {
    $checkedOn7 = '';
}

// Specific Days Checkbox Smart Content
if (isset($_POST['specific_days_checkbox'])) {
    if ($_POST['specific_days_checkbox'] == 'on') {
        update_option('specific_days_checkbox_smart_content', $_POST['specific_days_checkbox']);
        update_post_meta($postId,'specific_days_smart_content_textarea',$_POST['specific_days_textArea']);
        update_post_meta($postId,'selected_day_smart_content',$_POST['daysSelection']);
        update_post_meta($postId,'selected_day_hour_smart_content',$_POST['hour_select_days']);
        $checkedOn8 = 'checked';
    } else if ($_POST['specific_days_checkbox'] == 'off') {
        delete_option('specific_days_checkbox_smart_content');
        delete_post_meta($postId,'specific_days_smart_content_textarea');
        delete_post_meta($postId,'selected_day_smart_content');
        delete_post_meta($postId,'selected_day_hour_smart_content');
        $checkedOn8 = '';
    }
}

if (get_option('specific_days_checkbox_smart_content') == 'on') {
    $checkedOn8 = 'checked';
} else {
    $checkedOn8 = '';
}

$selectedSunday = '';
$selectedMonday = '';
$selectedTusday = '';
$selectedWednesday = '';
$selectedThursday = '';
$selectedFriday  = '';
$selectedSaturday = '';
$selectedDayHour = '';

if(isset($postId)){
  if(get_post_meta($postId,'selected_day_smart_content',true)){
   $selectedDay =  get_post_meta($postId,'selected_day_smart_content',true);
    switch ($selectedDay){
      case 'Sunday':
        $selectedSunday =  'selected';
        break;
      case 'Monday':
        $selectedMonday  = 'selected';
          break;
      case 'Tusday':
        $selectedTusday  = 'selected';
          break;
      case 'Wednesday':
        $selectedWednesday  = 'selected';
          break;
      case 'Thursday':
        $selectedThursday  = 'selected';
          break;
      case 'Friday':
         $selectedFriday  = 'selected';
          break;
      case 'Saturday':
          $selectedSaturday  = 'selected';
         break;
     }
  }
  if(get_post_meta($postId,'selected_day_hour_smart_content',true)){
    $selectedDayHour =  get_post_meta($postId,'selected_day_hour_smart_content',true);
}
}
// Content Abandoned Cart Checkbox Smart Content
if (isset($_POST['content_abandoned_cart_checkbox'])) {
    if ($_POST['content_abandoned_cart_checkbox'] == 'on') {
        update_option('content_abandoned_cart_checkbox_smart_content', $_POST['content_abandoned_cart_checkbox']);
        update_post_meta($postId,'specific_abandoned_cart_content_textarea',$_POST['cart_customers_textArea']);
        update_post_meta($postId,'time_abandoned_cart_minutes_smart_content',$_POST['time_abandoned_cart_minutes']);
        update_post_meta($postId,'time_abandoned_cart_after_minutes_smart_content',$_POST['time_abandoned_cart_after_minutes']);
       
        $checkedOn9 = 'checked';
    } else if ($_POST['content_abandoned_cart_checkbox'] == 'off') {
        delete_option('content_abandoned_cart_checkbox_smart_content');
        delete_post_meta($postId,'specific_abandoned_cart_content_textarea');
        delete_post_meta($postId,'time_abandoned_cart_minutes_smart_content');
        delete_post_meta($postId,'time_abandoned_cart_after_minutes_smart_content');
        $checkedOn9 = '';
    }
}

if (get_option('content_abandoned_cart_checkbox_smart_content') == 'on') {
    $checkedOn9 = 'checked';
} else {
    $checkedOn9 = '';
}

$time_cart_minutes = '1';
$time_cart_after_minutes = '1';
if(isset($postId)){
  if(get_post_meta($postId,'time_abandoned_cart_minutes_smart_content',true)){
    $time_cart_minutes = get_post_meta($postId,'time_abandoned_cart_minutes_smart_content',true);
  }

  if(get_post_meta($postId,'time_abandoned_cart_after_minutes_smart_content',true)){
    $time_cart_after_minutes = get_post_meta($postId,'time_abandoned_cart_after_minutes_smart_content',true);
  }
}

    ?> 
        <div class ="wrap_smart_content">
            <br>
            <h1>Smart Content Personalizer</h1>
            <form action="/wp-admin/admin.php?page=smart-content-personalizer" method="post">
            <br>
             <section class="section1">
                <h2>Content (Based on user permision): </h2>
                <div class="input-options">
                <input type='hidden' value='off' name='new_guest_checkbox'>
                 <div><input type="checkbox" id="new_guest_checkbox" name="new_guest_checkbox" <?php echo $checkedOn ?> value="on"><span>New Guest <b>[newGuestContentShortcode]</b></span></div>
                 <input type='hidden' value='off' name='return_user_checkbox'>
                 <div><input type="checkbox" id="return_user_checkbox" name="return_user_checkbox" <?php echo $checkedOn2 ?> value="on" ><span>Return User <b>[returnUserContentShortcode]</b></span></div>
                 <input type='hidden' value='off' name='registered_user_checkbox'>
                 <div><input type="checkbox" id="registered_user_checkbox" name="registered_user_checkbox" <?php echo $checkedOn3 ?> value="on"><span>Registered User <b>[LocalUserContentShortcode]</b></span></div>
                </div>
                <br>
           <?php
            $settings_guest_textArea = array(
                'textarea_name' => 'guest_textArea',
                'media_buttons' => true, 
                'teeny' => false,
                'quicktags' => true, 
                'editor_height' => 300, 
            );
            $initNewGuestText = get_post_meta($postId,'new_guest_smart_content_textarea',true) ? get_post_meta($postId,'new_guest_smart_content_textarea',true) : 'New Guest Content';
            wp_editor($initNewGuestText, 'guest_textArea_id', $settings_guest_textArea);
            $settings_return_textArea = array(
              'textarea_name' => 'return_textArea',
              'media_buttons' => true, 
              'teeny' => false,
              'quicktags' => true, 
              'editor_height' => 300, 
           );
           $initReturnUserText = get_post_meta($postId,'return_smart_content_textarea',true) ? get_post_meta($postId,'return_smart_content_textarea',true) : 'Return User Content';
            wp_editor($initReturnUserText, 'return_textArea_id', $settings_return_textArea);
            $settings_registered_textArea = array(
              'textarea_name' => 'registered_textArea',
              'media_buttons' => true, 
              'teeny' => false,
              'quicktags' => true, 
              'editor_height' => 300, 
           );
           $initRegisterUserText = get_post_meta($postId,'register_smart_content_textarea',true) ? get_post_meta($postId,'register_smart_content_textarea',true) : 'Registered User Content';
            wp_editor($initRegisterUserText, 'registered_textArea_id', $settings_registered_textArea);
            ?>
            </section>
            <section class="section2">
                <h2>Content (Based on Geo-Targeting):</h2>
                <div class="input-options">
                <input type='hidden' value='off' name='local_user_checkbox'>
                <div><input type="checkbox" id="local_user_checkbox" name="local_user_checkbox" <?php echo $checkedOn4 ?> value="on"><span>Local users <b>[LocalUserContentShortcode]</b></span></div>
                <input type='hidden' value='off' name='worldwide_user_checkbox'>
                <div><input type="checkbox" id="worldwide_user_checkbox" name="worldwide_user_checkbox" <?php echo $checkedOn5 ?> value="on"><span>Worldwide users <b>[WorldwideUserContentShortcode]</b></span></div>
                </div>
            </section>
            <br>
            <?php
                 $settings_my_country_textArea = array(
                  'textarea_name' => 'my_country_textArea',
                  'media_buttons' => true, 
                  'teeny' => false,
                  'quicktags' => true, 
                  'editor_height' => 300, 
               );
               $initLocalUserText = get_post_meta($postId,'Local_smart_content_textarea',true) ? get_post_meta($postId,'Local_smart_content_textarea',true) : 'Local Content';
                wp_editor($initLocalUserText,'my_country_textArea_id', $settings_my_country_textArea);
                $settings_world_textArea = array(
                  'textarea_name' => 'worldwide_textArea',
                  'media_buttons' => true, 
                  'teeny' => false,
                  'quicktags' => true, 
                  'editor_height' => 300, 
               );
               $initWorldUserText = get_post_meta($postId,'world_smart_content_textarea',true) ? get_post_meta($postId,'world_smart_content_textarea',true) : 'WorldWide Content';
                wp_editor($initWorldUserText, 'world_textArea_id', $settings_world_textArea);
            ?>
            <section class="section3">
               <h2>Content (Based on Time):</h2>
               <div class="input-options">
               <input type='hidden' value='off' name='specific_time_checkbox'>
               <div><input type="checkbox" name='specific_time_checkbox' id="specific_time_checkbox" <?php echo $checkedOn6 ?> value="on"><span>Content in specific time (Hour) every day <b>[SpecificTimeContentShortcode]</b></span>
               <select id="hour_select" name="hour_select" data-hour="<?php echo $specific_time_hour; ?>">
                <option>12 AM</option>
                <option>1 AM</option>
                <option>2 AM</option>
                <option>3 AM</option>
                <option>4 AM</option>
                <option>5 AM</option>
                <option>6 AM</option>
                <option>7 AM</option>
                <option>8 AM</option>
                <option>9 AM</option>
                <option>10 AM</option>
                <option>11 AM</option>
                <option>12 PM</option>
                <option>1 PM</option>
                <option>2 PM</option>
                <option>3 PM</option>
                <option>4 PM</option>
                <option>5 PM</option>
                <option>6 PM</option>
                <option>7 PM</option>
                <option>8 PM</option>
                <option>9 PM</option>
                <option>10 PM</option>
                <option>11 PM</option>
              </select>
              </div>
               <input type='hidden' value='off' name='between_time_checkbox'>
               <div><input type="checkbox" name='between_time_checkbox' id="between_time_checkbox" <?php echo $checkedOn7 ?> value="on"><span>Content in between times every day <b>[betweenTimesContentShortcode]</b></span><div class="from_time_container">From Time: <input type="time" name ="from_time" value="<?php echo $from_time_value; ?>"/></div><div class="to_time_container">To Time: <input type="time" name ="to_time" value="<?php echo $to_time_value;  ?>"/></div></div>
               <input type='hidden' value='off' name='specific_days_checkbox'>
                <div>
                <input type="checkbox" name='specific_days_checkbox' id="specific_days_checkbox" <?php echo $checkedOn8 ?> value="on"><span>Content in specific day in specific time (Hour) <b>[specificDayTimeContentShortcode]</b></span>
                 <select id ="daysSelection" name="daysSelection">
                  <option <?php echo $selectedSunday ?>>Sunday</option>
                  <option  <?php echo $selectedMonday ?>>Monday</option>
                  <option  <?php echo $selectedTusday ?>>Tusday</option>
                  <option  <?php echo $selectedWednesday ?>>Wednesday</option>
                  <option  <?php echo $selectedThursday ?>>Thursday</option>
                  <option  <?php echo $selectedFriday ?>>Friday</option>
                  <option  <?php echo $selectedSaturday ?>>Saturday</option>
                </select>
                  <select id="hour_select_days" name="hour_select_days" data-hour-days="<?php echo $selectedDayHour; ?>">
                    <option>12 AM</option>
                    <option>1 AM</option>
                    <option>2 AM</option>
                    <option>3 AM</option>
                    <option>4 AM</option>
                    <option>5 AM</option>
                    <option>6 AM</option>
                    <option>7 AM</option>
                    <option>8 AM</option>
                    <option>9 AM</option>
                    <option>10 AM</option>
                    <option>11 AM</option>
                    <option>12 PM</option>
                    <option>1 PM</option>
                    <option>2 PM</option>
                    <option>3 PM</option>
                    <option>4 PM</option>
                    <option>5 PM</option>
                    <option>6 PM</option>
                    <option>7 PM</option>
                    <option>8 PM</option>
                    <option>9 PM</option>
                    <option>10 PM</option>
                    <option>11 PM</option>
              </select>
                </div>
                </div>
                <br>
                <?php
            $settings_specific_time_textArea = array(
                'textarea_name' => 'specific_time_textArea',
                'media_buttons' => true, 
                'teeny' => false,
                'quicktags' => true, 
                'editor_height' => 300, 
            );
            $initSpecificTimeText = get_post_meta($postId,'specific_time_smart_content_textarea',true) ? get_post_meta($postId,'specific_time_smart_content_textarea',true) : 'Content in Specific Time';
            wp_editor($initSpecificTimeText, 'specific_time_textArea_id', $settings_specific_time_textArea);
            
            $settings_between_times_textArea = array(
              'textarea_name' => 'between_times_textArea ',
              'media_buttons' => true, 
              'teeny' => false,
              'quicktags' => true, 
              'editor_height' => 300, 
           );
           $initBetweenTimesText = get_post_meta($postId,'between_time_smart_content_textarea',true) ? get_post_meta($postId,'between_time_smart_content_textarea',true) : 'Content Between Times';
            wp_editor($initBetweenTimesText, 'between_times_textArea_id', $settings_between_times_textArea);

            $settings_specific_days_textArea = array(
              'textarea_name' => 'specific_days_textArea',
              'media_buttons' => true, 
              'teeny' => false,
              'quicktags' => true, 
              'editor_height' => 300, 
           );
           $initSpecificDaysText = get_post_meta($postId,'specific_days_smart_content_textarea',true) ? get_post_meta($postId,'specific_days_smart_content_textarea',true) : 'Content in Specific Days';
            wp_editor($initSpecificDaysText, 'specific_days_textArea_id', $settings_specific_days_textArea);
            ?>
            </section>
            <section class="section4">
            <h2>Content (Based on abandoned cart):</h2>
              <div class="input-options">
              <input type='hidden' value='off' name='content_abandoned_cart_checkbox'>
                 <div><input type="checkbox" name='content_abandoned_cart_checkbox' id="content_abandoned_cart_checkbox" value="on" <?php echo $checkedOn9 ?>><span>Content for abandoned cart customers after X minutes <b>[abandonedCartContentTimeContentShortcode]</b> </span>
                 <input type="number" min="1" value="<?php echo $time_cart_minutes ?>" name="time_abandoned_cart_minutes" style="width:50px; margin-left:10px;"/>
                 How long will the content appear (minutes) <input type="number" min="1" name="time_abandoned_cart_after_minutes" value="<?php echo $time_cart_after_minutes; ?>" style="width:50px; margin-left:10px;"/></div>
                 <input type='hidden' value='off' name='content_abandoned_cart_display_times_checkbox'>
              </div>
              <br>
              <?php
                 $settings_cart_customers_textArea = array(
                  'textarea_name' => 'cart_customers_textArea',
                  'media_buttons' => true, 
                  'teeny' => false,
                  'quicktags' => true, 
                  'editor_height' => 300, 
               );
               $initAbandonedCartText = get_post_meta($postId,'specific_abandoned_cart_content_textarea',true) ? get_post_meta($postId,'specific_abandoned_cart_content_textarea',true) : 'Content for abandoned cart customers after X minutes';
                wp_editor($initAbandonedCartText, 'cart_customers_textArea_id', $settings_cart_customers_textArea);
              ?>
            </section>
            <br>
            <div class="submit_button_container">
              <button type="submit" name="submit">Save</button>
            </div>
        </div>
     </form>
    <?php
  }
?>