<?php
get_header();
?>
    <main class="full-width">
        <section class="products my-4">
            <article class="single border border-gray-300 rounded-lg p-4 flex flex-col gap-2 justify-center items-center">
                <?php
                if (have_posts()) :
                    while (have_posts()) :
                        the_post();
                        ?>
                        <h1 class="text-3xl font-bold text-center"><?php the_title(); ?></h1>
                        <div class="post-content"><?php the_content(); ?></div>
                    <?php
                    endwhile;
                else :
                    _e('Valitettavasti vuoroa ei löytynyt', 'padel-site');
                endif;
                ?>
                <?php echo do_shortcode('[like_button]'); ?>
            </article>
        </section>
    </main>


<?php
get_footer();