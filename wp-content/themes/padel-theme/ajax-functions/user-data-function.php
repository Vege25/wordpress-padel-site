<?php
// Custom function to handle AJAX request for searching user data
add_action('wp_ajax_search_user_data', 'search_user_data_callback');
function search_user_data_callback() {
    error_log('search_user_data_callback triggered'); // Debugging statement

    // Get the user ID from the AJAX request
    $user_id = $_POST['user_id'];

    // Use $wpdb to query the 'pad_user_data' table for the user's data
    global $wpdb;
    $table_name = $wpdb->prefix . 'user_data'; // Assuming table name is 'pad_user_data'

    $query = $wpdb->prepare("SELECT * FROM $table_name WHERE user_id = %d", $user_id);
    $user_data = $wpdb->get_row($query);

    if ($user_data) {
        wp_send_json_success($user_data); // Return user data as JSON response
    } else {
        wp_send_json_error('No data found for the user.'); // Return error message as JSON response
    }
}

// Custom function to handle AJAX request for updating user data
add_action('wp_ajax_update_user_data', 'update_user_data_callback');
function update_user_data_callback() {
    error_log('update_user_data_callback triggered'); // Debugging statement

    // Get the form data from the AJAX request
    parse_str($_POST['form_data'], $form_data);

    // Extract individual form fields
    $user_id = $form_data['user_id'];
    $wins = $form_data['wins'];
    $racket = $form_data['racket'];

    // Use $wpdb to update the 'pad_user_data' table with the new data
    global $wpdb;
    $table_name = $wpdb->prefix . 'user_data'; // Assuming table name is 'pad_user_data'

    $data = [
        'wins' => $wins,
        'racket' => $racket,
    ];

    $where = [
        'user_id' => $user_id,
    ];

    $updated = $wpdb->update($table_name, $data, $where);

    // Check if update was successful
    if ($updated !== false) {
        wp_send_json_success('User data updated successfully!'); // Return success message as JSON response
    } else {
        wp_send_json_error('Error updating user data.'); // Return error message as JSON response
    }
}
?>
