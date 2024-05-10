<?php
function generate_article( $vuorot ): void {
    if ( $vuorot->have_posts() ) :
		while ( $vuorot->have_posts() ) :
            $vuorot->the_post();
			?>
            <article class="product border-2 border-black bg-white h-96 text-center rounded-md border-solid w-full sm:w-1/2 flex flex-col items-center justify-center gap-2">
				<?php
				the_post_thumbnail( 'thumbnail' );
				the_title( '<h3 class="text-lg font-bold">', '</h3>' );
				$excerpt = get_the_excerpt();
				?>
                <p>
					<?php
					echo substr( $excerpt, 0, 100 );
					?>...
                </p>
                <a class="font-bold hover:scale-105 duration-150 ease-in-out" href="<?php the_permalink(); ?>">Katso vuoroa</a>
                <a class="font-bold hover:scale-105 duration-150 ease-in-out open-modal" href="#" data-id="<?php echo get_the_ID(); ?>">Avaa ponnahdusikkunassa</a>
            </article>
		<?php
		endwhile;
	else :
		_e( 'Valitettavasti ei löytynyt varauksia.', 'padel-site' );
	endif;
}