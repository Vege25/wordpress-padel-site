<?php
global $wp_query;
get_header();
?>


    <section class="hero">
        <div class="hero-text">
            <h1><?php single_cat_title('', false); ?></h1>
            <p><?php echo category_description(); ?></p>
        </div>

        <img src="<?php echo get_random_post_image(get_queried_object_id()); ?>" alt="hero">
    </section>

    <main class="products grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <?php
        $subcategories = get_categories([
            'child_of'   => get_queried_object_id(),
            'hide_empty' => true,
        ]);

        foreach ($subcategories as $subcategory) :
            ?>
            <div class="border border-gray-300 rounded-lg p-4">
                <h2 class="text-xl font-bold"><?php echo $subcategory->name; ?></h2>

                <?php
                $args = [
                    'post_type'      => 'post',
                    'cat'            => $subcategory->term_id,
                    'posts_per_page' => 3,
                ];

                $vuorot = new WP_Query($args);
                generate_article($vuorot);
                wp_reset_postdata();
                ?>

                <a href="<?php echo get_category_link($subcategory->term_id); ?>" class="text-blue-500 hover:underline">Katso kaikki</a>
            </div>
        <?php
        endforeach;
        ?>
    </main>


<?php
get_footer();