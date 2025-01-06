<?php
// Exit if accessed directly
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}
$postId = get_option('postIdSmartContent');

// Delete plugin options
delete_option('countUsersIp');
delete_option('smart_content_post_inserted');
delete_option('new_guest_checkbox_smart_content');
delete_option('return_user_checkbox_smart_content');
delete_option('registered_user_checkbox_smart_content');
delete_option('local_user_checkbox_smart_content');
delete_option('worldwide_user_checkbox_smart_content');
delete_option('specific_time_checkbox_smart_content');
delete_option('between_time_checkbox_smart_content');
delete_option('specific_days_checkbox_smart_content');
delete_option('content_abandoned_cart_checkbox_smart_content');

//Delete plugin posts meta

// delete_post_meta($postId,'new_guest_smart_content_textarea');
// delete_post_meta($postId,'return_smart_content_textarea');
// delete_post_meta($postId,'register_smart_content_textarea');
// delete_post_meta($postId,'Local_smart_content_textarea');
// delete_post_meta($postId,'world_smart_content_textarea');
// delete_post_meta($postId,'specific_time_smart_content_textarea');
// delete_post_meta($postId,'between_time_smart_content_textarea');
// delete_post_meta($postId,'specific_days_smart_content_textarea');
// delete_post_meta($postId,'selected_day_smart_content');
// delete_post_meta($postId,'selected_day_hour_smart_content');
// delete_post_meta($postId,'specific_abandoned_cart_content_textarea');
// delete_post_meta($postId,'time_abandoned_cart_minutes_smart_content');
// delete_post_meta($postId,'time_abandoned_cart_after_minutes_smart_content');

function delete_post_meta_on_post_delete($post_id) {
    // Verify if it's a valid post ID
    if (!$post_id || get_post_type($post_id) !== 'post') {
        return;
    }

    // Delete all post meta associated with this post
    global $wpdb;
    $wpdb->delete(
        $wpdb->postmeta,
        ['post_id' => $post_id],
        ['%d']
    );
}
add_action('before_delete_post', 'delete_post_meta_on_post_delete');

wp_delete_post( $postId, true);

delete_option('postIdSmartContent');
