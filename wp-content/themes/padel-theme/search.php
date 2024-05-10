<?php
global $wp_query;
get_header();
?>
	<main class="my-2">
		<section class="products flex flex-col justify-center">
			<h2 class="text-center font-bold text-2xl my-4"><?php _e('Haun tulokset', 'padel-site'); ?></h2>
			<div class="flex flex-col justify-center items-center gap-2">
                <?php
                generate_article( $wp_query );
                ?>
            </div>

		</section>
	</main>
<?php
get_footer();