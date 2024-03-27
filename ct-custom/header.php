<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package CT_Custom
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<script src="https://kit.fontawesome.com/2e5d4cc2f0.js" crossorigin="anonymous"></script>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'ct-custom' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="ct-top">
			<div class="ct-center">
				<div class="ct-callus">
					<span class="ct-color-darkorange">CALL US NOW!</span>&ensp;
					<span class="ct-color-white"><?php echo get_option('phone'); ?></span>
				</div>
				<div class="ct-auth">
					<span class="ct-color-darkorange"><a href="#">LOGIN</a></span>&ensp;
					<span class="ct-color-white"><a href="#">SIGNUP</a></span>
				</div>
			</div>
		</div>
		<div class="ct-topnav">
			<div class="ct-center">
				<div class="site-branding">
					<?php
					if (get_option('logo')) :
						?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="custom-logo-link" rel="home">
							<img src="<?php echo get_option('logo'); ?>" class="custom-logo" alt="<?php echo get_bloginfo( 'name' ); ?>">
						</a>
						<?php
					else :
						the_custom_logo();
					endif;
					if ( is_front_page() && is_home() ) :
						?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php
					else :
						?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						<?php
					endif;
					$ct_custom_description = get_bloginfo( 'description', 'display' );
					if ( $ct_custom_description || is_customize_preview() ) :
						?>
						<p class="site-description"><?php echo $ct_custom_description; /* WPCS: xss ok. */ ?></p>
					<?php endif; ?>
				</div><!-- .site-branding -->

				<nav id="site-navigation" class="main-navigation">
					<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'MENU', 'ct-custom' ); ?></button>
					<?php
					wp_nav_menu( array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
					) );
					?>
				</nav><!-- #site-navigation -->
			</div>
		</div>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
		<?php if (!is_home() && !is_front_page()): ?>
		<div class="breadcrumb">
			<?php get_breadcrumb(); ?>
        </div>
        <?php endif; ?>