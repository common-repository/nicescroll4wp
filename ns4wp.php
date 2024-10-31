<?php 
/*
Plugin Name:NiceScroll4wp
Plugin URI: https://wordpress.org/plugins/nicescroll4wp/
Description: By useing this plugin you can easily customize your website scrollbar and you also get the smothscroll effect for targeting your anchor-text.
Author: Niloy 
Version: 1.2
Author URI: http://www.iamniloy.com
*/

/*===========
 Call Jquery 
=============*/

function ns4wp_scripts() {
	wp_enqueue_script('jquery');
    wp_enqueue_script( 'nicescroll', plugins_url( '/js/jquery.nicescroll.js', __FILE__ ), array('jquery'), 1.0, false);
}

add_action('init','ns4wp_scripts');

include_once('s-api/settings-api.php');
/**
 * Get the value of a settings field
 *
 * @param string $option settings field name
 * @param string $section the section name this field belongs to
 * @param string $default default text if it's not found
 * @return mixed
 */
function ns4wp_get_value( $option, $section, $default = '' ) {

	$options = get_option( $section );

	if ( isset( $options[$option] ) ) {
		return $options[$option];
	}

	return $default;
}


function ns4wp_js_area() {?>

<?php global $ns4wp_options; $ns4wp_settings = get_option( 'ns4wp_options', $ns4wp_options ); ?>

	<script type="text/javascript">
		jQuery(document).ready(function(){
				var nice = jQuery("html").niceScroll({
				cursorcolor: "<?php echo ns4wp_get_value( 'cursorcolor', 'ns4wp_settings', '#ddd' );?>",
				background:"<?php echo ns4wp_get_value( 'background', 'ns4wp_settings', '#fff' );?>",
				cursorwidth: "<?php echo ns4wp_get_value( 'cursorwidth', 'ns4wp_settings', '10' );?>px",
				cursorborderradius: "<?php echo ns4wp_get_value( 'cursorborderradius', 'ns4wp_settings', '0' );?>px",
				autohidemode: <?php echo ns4wp_get_value( 'autohidemode', 'ns4wp_settings', 'no' );?>,
				touchbehavior: false,
				bouncescroll: true,
				horizrailenabled: false
				});  // The document page (body)

		}); 
		jQuery(function() {
		  jQuery('a[href*=#]:not([href=#])').click(function() {
			if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
			  var target = jQuery(this.hash);
			  target = target.length ? target : jQuery('[name=' + this.hash.slice(1) +']');
			  if (target.length) {
				jQuery('html,body').animate({
				  scrollTop: target.offset().top
				}, 1000);
				return false;
			  }
			}
		  });
		});		
	</script>


<?php
}
add_action('wp_head', 'ns4wp_js_area');

?>