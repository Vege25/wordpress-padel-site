<?php
function single_post(): void {
	header( 'Content-Type: application/json');
	$post_id = $_POST['post_id'];
	$post = get_post( $post_id );
	echo json_encode( $post );
	wp_die();
}
function search_user_data(): void {
    global $wpdb;
    $user_id = $_POST['user_id'];

    $table_name = $wpdb->prefix . 'user_data';
    $query = $wpdb->prepare("SELECT * FROM $table_name WHERE user_id = %d", $user_id);
    $user_data = $wpdb->get_row($query);

    if ($user_data) {
        wp_send_json_success($user_data); // Return user data as JSON response
    } else {
        wp_send_json_error('No data found for the user.'); // Return error message as JSON response
    }
}
function update_user_data(): void {
    global $wpdb;
    parse_str($_POST['form_data'], $form_data);

    $user_id = $form_data['user_id'];
    $wins = $form_data['wins'];
    $racket = $form_data['racket'];

    // Update user data in the database (adjust as per your table structure)
    $table_name = $wpdb->prefix . 'user_data';
    $wpdb->update(
        $table_name,
        array(
            'wins' => $wins,
            'racket' => $racket,
        ),
        array('user_id' => $user_id)
    );

    wp_send_json_success('User data updated successfully.'); // Return success message as JSON response
}

add_action('wp_ajax_update_user_data', 'update_user_data');

add_action('wp_ajax_search_user_data', 'search_user_data');

add_action( 'wp_ajax_single_post', 'single_post' );