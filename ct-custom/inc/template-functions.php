<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package CT_Custom
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function ct_custom_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'ct_custom_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function ct_custom_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'ct_custom_pingback_header' );

/**
* Add a menu for the theme settings page with page callback theme_settings_page. | By Hyppolite
*/
function add_theme_settings_page() {
	add_theme_page("Theme Settings", "Theme Settings", "manage_options", "theme-options", "theme_settings_page");
}
add_action('admin_menu', 'add_theme_settings_page');

/**
* Create the theme settings page with title Theme Settings. | By Hyppolite
*/
function theme_settings_page() {
?>
	<div class="wrap">
		<h1>Theme Settings</h1>
		<?php settings_errors(); ?>
		<form method="post" action="options.php" enctype="multipart/form-data" autocomplete="on">
			<?php
			// display settings fields on the theme settings page
			settings_fields("theme-options-grp");

			// display all sections for the theme settings page
			do_settings_sections("theme-options");

			submit_button();
			?>
		</form>
	</div>
<?php
}

/**
 * Create settings sections and settings fields. | By Hyppolite
 * */
function custom_theme_settings() {
	// Add settings section “main_section”
	add_settings_section('main_section', 'Main Section', 'main_section_callback','theme-options');

	/* Add settings fields to the section “main_section” */
	add_settings_field('logo','Logo','logo_display', 'theme-options','main_section');
	register_setting('theme-options-grp', 'logo', 'handle_logo_upload');

	add_settings_field('address','Address info','address_display', 'theme-options','main_section');
	register_setting('theme-options-grp', 'address');

	add_settings_field('phone','Phone number','phone_display', 'theme-options','main_section');
	register_setting('theme-options-grp', 'phone');

	add_settings_field('fax','Fax number','fax_display', 'theme-options','main_section');
	register_setting('theme-options-grp', 'fax');

	// Add settings section “social_section”
	add_settings_section('social_section', 'Social Media Links', 'social_section_callback','theme-options');

	/* Add settings fields to the section “social_section” */
	add_settings_field('facebook_url','Facebook','facebook_display', 'theme-options','social_section');
	register_setting('theme-options-grp', 'facebook_url');

	add_settings_field('twitter_url','Twitter','twitter_display', 'theme-options','social_section');
	register_setting('theme-options-grp', 'twitter_url');

	add_settings_field('linkedin_url','LinkedIn','linkedin_display', 'theme-options','social_section');
	register_setting('theme-options-grp', 'linkedin_url');

	add_settings_field('pinterest_url','Pinterest','pinterest_display', 'theme-options','social_section');
	register_setting('theme-options-grp', 'pinterest_url');
}
add_action('admin_init','custom_theme_settings');

function main_section_callback() {}

function social_section_callback() {}

function logo_display() { ?>
	<input type="hidden" name="logourl" value="<?php echo get_option('logo'); ?>" readonly />
	<input type="file" name="logo" id="logo"/><br/>
	<?php if (get_option('logo')) 
			echo '<strong>Current logo</strong><br/><img src="' . get_option('logo') . '" alt="' . get_bloginfo( 'name' ) . '">';
}

/**
* Handle the logo upload
*/
function handle_logo_upload()
{
    if(isset($_FILES['logo']) && !empty($_FILES['logo']['name']))
    {
        $upload = wp_handle_upload($_FILES['logo'], array('test_form' => FALSE));

        if( ! empty( $upload[ 'error' ] ) ) {
        	wp_die( $upload[ 'error' ] );
        }

        // Add our uploaded logo into WordPress media library
		$attachment_id = wp_insert_attachment(
			array(
				'guid'           => $upload['url'],
				'post_mime_type' => $upload['type'],
				'post_title'     => basename( $upload['file'] ),
				'post_content'   => '',
				'post_status'    => 'inherit',
			),
			$upload['file']
		);

		if( is_wp_error( $attachment_id ) || ! $attachment_id ) {
			wp_die( 'Upload error.' );
		}

		// Update medatata, regenerate image sizes
		wp_update_attachment_metadata(
			$attachment_id,
			wp_generate_attachment_metadata( $attachment_id, $upload['file'] )
		);

        $url = $upload['url'];
        return $url;
    }
 	elseif(isset($_FILES['logo']) && empty($_FILES['logo']['name'])){
 		$url = $_POST['logourl'];
 		return $url;
 	}
 	return $option;
} 

function address_display() { ?>
	<input type="text" name="address" id="address" class="regular-text" value="<?php echo get_option('address'); ?>" />
<?php
}

function phone_display() { ?>
	<input type="tel" name="phone" id="phone" pattern="[0-9]{3}\.[0-9]{3}\.[0-9]{2}\.[0-9]{2}\.[0-9]{2}" value="<?php echo get_option('phone'); ?>" /><br/><small>Format: xxx.xxx.xx.xx.xx</small>
<?php
}

function fax_display() { ?>
	<input type="tel" name="fax" id="fax" pattern="[0-9]{3}\.[0-9]{3}\.[0-9]{2}\.[0-9]{2}\.[0-9]{2}" value="<?php echo get_option('fax'); ?>" /><br/><small>Format: xxx.xxx.xx.xx.xx</small>
<?php
}

function facebook_display() { ?>
	<input type="url" name="facebook_url" id="facebook_url" class="regular-text" placeholder="https://facebook.com/example" pattern="https://.*" size="30" value="<?php echo get_option('facebook_url'); ?>" />
<?php
}

function twitter_display() { ?>
	<input type="url" name="twitter_url" id="twitter_url" class="regular-text" placeholder="https://twitter.com/example" pattern="https://.*" size="30" value="<?php echo get_option('twitter_url'); ?>" />
<?php
}

function linkedin_display() { ?>
	<input type="url" name="linkedin_url" id="linkedin_url" class="regular-text" placeholder="https://linkedin.com/example" pattern="https://.*" size="30" value="<?php echo get_option('linkedin_url'); ?>" />
<?php
}

function pinterest_display() { ?>
	<input type="url" name="pinterest_url" id="pinterest_url" class="regular-text" placeholder="https://pinterest.com/example" pattern="https://.*" size="30" value="<?php echo get_option('pinterest_url'); ?>" />
<?php
}