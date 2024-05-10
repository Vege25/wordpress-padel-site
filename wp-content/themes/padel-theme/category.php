<?php
global $wp_query;
get_header();
?>

<section class="hero">
    <div class="hero-text">
        <h1 class="text-3xl font-bold text-black"><?php single_cat_title('', false); ?></h1>
        <p class="text-xl"><?php echo category_description(); ?></p>
    </div>

    <img src="<?php echo get_random_post_image(get_queried_object_id()); ?>" alt="hero">
</section>

<main class="products flex flex-col items-center gap-4">
    <h2 class="text-2xl font-bold"><?php single_cat_title(); ?></h2>
    <?php
    generate_article($wp_query);
    ?>
</main>

<?php
get_footer();
?>
