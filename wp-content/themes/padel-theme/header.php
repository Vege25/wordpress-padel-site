<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php wp_head(); ?>
</head>

<body>
<div class="">
    <header class="page-header flex-row">
        <div class="header-top-left">
			<?php the_custom_logo(); ?>
        </div>
        <div class="header-top-right flex items-center justify-end">
			<?php wp_nav_menu( [ 'container' => 'nav', 'theme_location' => 'main-menu' ] ); ?>
        </div>
    </header>