<?php
/*
 * Plugin Name: PriceFish - Pricing Tables
 * Plugin URI: http://www.pricefish.com
 * Description: Add & create <strong>Pricing tables and pages</strong> for your Wordpress website. Increase your online sales with our advanced analytics and professional designs!
 * Version: 1.0.2
 * Author: PriceFish
 * Author URI: http://www.pricefish.com/
 * License: GPLv2 or later
 */

/*
 * Shortcode to diplay PriceFish page in your site.
 *
 *	   The list of arguments is below:
 *     'projectid' (string) - Table guid
 */

function pricefish_shortcode( $atts ) {
	extract( shortcode_atts( array(
		'projectid' => "5bc66a4d-5299-4fd0-ba6d-bad6704a6771"
	), $atts ) );

	$siteUrl = "http";

	if ($_SERVER["HTTPS"] == "on") {$siteUrl .= "s";}
		$siteUrl .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
		$siteUrl .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	} else {
		$siteUrl .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}


	$pricefish_html = "<div id='pricefish_pricing'></div><script type='text/javascript' src='//assets.pricefish.com/js/pricefish_loader.js'></script><script type='text/javascript'>new PriceFish('$projectid');</script>";



	return $pricefish_html;
}

add_shortcode( 'pricefish', 'pricefish_shortcode' );


/*
 * tinyMCE button registration
 */

function pricefish_register( $buttons ) {
   array_push( $buttons, "|", "pricefish" );
   return $buttons;
}

function pricefish_add( $plugin_array ) {
   $plugin_array['pricefish'] = plugins_url() . '/pricefish-pricing-tables/js/pricefish.js';
   return $plugin_array;
}

function pricefish_button() {

   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
      return;
   }

   if ( get_user_option('rich_editing') == 'true' ) {
      add_filter( 'mce_external_plugins', 'pricefish_add' );
      add_filter( 'mce_buttons', 'pricefish_register' );
   }

}

add_action('init', 'pricefish_button');

?>