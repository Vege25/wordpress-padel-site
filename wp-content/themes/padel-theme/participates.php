<?php
global $wpdb; // Access WordPress database functions

// Custom table name where liked post IDs are stored
$table_name = $wpdb->prefix . 'likes';

// Get the current user's ID (assuming you are fetching liked posts for the current user)
$user_id = get_current_user_id();

// Query the database to fetch liked post IDs for the current user
$query = $wpdb->prepare(
    "SELECT post_id FROM $table_name WHERE user_id = %d",
    $user_id
);
$liked_post_ids = $wpdb->get_col($query);

// Query and display liked posts if there are any
if (!empty($liked_post_ids)) {
    $args = [
        'post_type'      => 'post',
        'post__in'       => $liked_post_ids,
        'posts_per_page' => -1, // Retrieve all liked posts
        'orderby'        => 'post__in', // Order by the order of IDs in $liked_post_ids
    ];
    $liked_posts_query = new WP_Query($args);

    // Display the liked posts as ordered shifts
    if ($liked_posts_query->have_posts()) {
        while ($liked_posts_query->have_posts()) {
            $liked_posts_query->the_post();
            // Generate HTML for each liked post (shift)
            ?>
            <article class="product my-2 bg-white w-1/2 m-auto flex items-center justify-center gap-2 flex-col border-2 border-solid border-black rounded-md shadow-lg p-4 mb-4">
                <h2 class="text-xl font-bold mb-2"><?php the_title(); ?></h2>
                <div class="post-content mb-4">
                    <?php the_content(); ?>
                </div>
                <div class="flex justify-center">
                    <?php echo do_shortcode( '[like_button]' ); ?>
                </div>
            </article>
            <?php
        }
        wp_reset_postdata(); // Reset post data
    } else {
        echo 'No participations found on liked posts.';
    }
} else {
    echo '<p class="text-center text-lg">Sinulla ei ole varauksia</p>';
}
?>
