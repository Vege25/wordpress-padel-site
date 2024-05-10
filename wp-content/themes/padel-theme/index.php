<?php
get_header();
?>


<section class="hero w-full relative">
    <div class="hero-text absolute top-1/2 text-center text-xl text-white left-1/2 -translate-x-1/2 -translate-y-1/2">
	    <?php
	    if ( have_posts() ) :
		    while ( have_posts() ) :
			    the_post();
			    the_title('<h1 class="font-bold text-3xl">', '</h1>');
			    the_content();
		    endwhile;
	    else :
		    _e( 'Valitettavsti vuoroja ei löytynyt', 'padel-site' );
	    endif;
	    ?>
    </div>

    <?php the_custom_header_markup(); ?>
    <!-- <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/map.svg" alt="hero"> -->
</section>
    <section class="breadcrumbs text-center font-bold text-3xl">
        <?php if ( function_exists('bcn_display') ) {
            bcn_display();
        } ?>
    </section>
<main>
    <section>
        <?php
        global $wp_query;

        if (is_page('you')) {
            // Add your custom content or fetch and display liked posts here
            // get participates.php
            get_template_part('userdata');
        }
        ?>
    </section>
    <section>
        <?php
        global $wp_query;

        if (is_page('participates')) {
            // Add your custom content or fetch and display liked posts here
            // get participates.php
            get_template_part('participates');
        }
        ?>
    </section>
    <section class="products">
        <h2 class="font-bold text-2xl my-4 text-center">Suositut vuorot</h2>
        <div class="flex px-2 md:flex-row flex-col items-center justify-center gap-2">
            <?php
            $args = ['tag' => 'suositut', 'posts_per_page' => 3];
            $vuorot = new WP_Query($args);
            generate_article($vuorot);
            ?>
        </div>
    </section>
</main>

<?php
get_sidebar();
get_footer();