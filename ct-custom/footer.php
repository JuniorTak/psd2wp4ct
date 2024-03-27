<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package CT_Custom
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="ct-footer">
			<div class="ct-contact">
				<span class="ct-title">CONTACT US</span>
				<div class="ct-line"></div>
			</div>
			<div class="ct-reachus">
				<span class="ct-title">REACH US</span>
				<div class="ct-line"></div>
				<div class="ct-break ct-info">
					<?php echo get_bloginfo( 'name' ); ?>
					<br><br>
					<?php echo get_option('address'); ?>
					<br><br>
					Phone: <?php echo get_option('phone'); ?>
					<br>
					Fax: <?php echo get_option('fax'); ?>
				</div>
				<div class="ct-break">
					<span class="ct-social"><a href="<?php echo get_option('facebook_url'); ?>" rel="noopener noreferrer" target=_blank>
						<i class="fa-brands fa-square-facebook fa-2xl"></i></a></span>
					<span class="ct-social"><a href="<?php echo get_option('twitter_url'); ?>" rel="noopener noreferrer" target=_blank>
						<i class="fa-brands fa-square-twitter fa-2xl"></i></a></span>
					<span class="ct-social"><a href="<?php echo get_option('linkedin_url'); ?>" rel="noopener noreferrer" target=_blank>
						<i class="fa-brands fa-linkedin fa-2xl"></i></a></span>
					<span class="ct-social"><a href="<?php echo get_option('pinterest_url'); ?>" rel="noopener noreferrer" target=_blank>
						<i class="fa-brands fa-pinterest fa-2xl"></i></a></span>
				</div>
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
