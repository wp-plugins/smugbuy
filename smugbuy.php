<?php
/*
Plugin Name: SmugBuy
Plugin URI: http://chrismartino.com/smugbuy
Description: A plugin to automatically insert SmugMug buy links into wordpress posts and pages using a shortcode.
Version: 1.0
Author: Chris Martino
Author URI: http://chrismartino.com

Copyright 2011  CHRIS_MARTINO  (email : chris@chrismartino.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/* Runs when plugin is activated. */
register_activation_hook(__FILE__, 'smugbuy_install'); 

/* Runs when plugin is deactivated. */
register_deactivation_hook( __FILE__, 'smugbuy_remove' );

function smugbuy_install() {
/* Creates new database fields */
add_option("smugbuy_url", 'mysite.smugmug.com', '', 'yes');
add_option("smugbuy_text", 'Buy Print on SmugMug', '', 'yes');
}

function smugbuy_remove() {
/* Deletes the database fields */
delete_option('smugbuy_url');
delete_option('smugbuy_text');
}

/*
Generates the appropriate "buy" link from the photo URL.
Usage: [smugbuy photo="smugmug photo page URL"]
*/
function smugbuy_func($atts) {
	extract(shortcode_atts(array(
		'photo' => '',
	), $atts));
	ob_start();
		echo "<a href='".esc_url(str_replace ('#','/',"http://" . get_option('smugbuy_url') . "/buy" . strrchr($photo, '/'))) ."'>" . esc_html(get_option('smugbuy_text')) . "</a>";
	$link = ob_get_clean();
	return $link;
}
add_shortcode('smugbuy', 'smugbuy_func');

/* Check if we're in the admin screens */
if ( is_admin() ){

	/* Call the html code */
	add_action('admin_menu', 'smugbuy_admin_menu');

	function smugbuy_admin_menu() {
		add_options_page('SmugBuy Options', 'SmugBuy', 'administrator', 'SmugBuy', 'smugbuy_html_page');
	}
}

/* Generate the SmugBuy admin form. */
function smugbuy_html_page() {
?>
<div>
	<h2>SmugBuy Options</h2>

	<form method="post" action="options.php">
	<?php wp_nonce_field('update-options'); ?>

	<table width="650">
	<tr valign="middle" align="left">
	<th width="150" scope="row">SmugMug URL</th>
	<td width="500">
	http://<input name="smugbuy_url" type="text" size=30 id="smugbuy_url" value="<?php echo get_option('smugbuy_url'); ?>" /> (ex. mysite.smugmug.com)</td>
	</tr>
	<tr valign="middle" align="left">
	<th width="150" scope="row">SmugMug Link Text</th>
	<td width="500">
	<input name="smugbuy_text" type="text" size=30 id="smugbuy_text" value="<?php echo get_option('smugbuy_text'); ?>" /> (ex. Buy Print on SmugMug)</td>
	</tr>
	</table>

	<input type="hidden" name="action" value="update" />
	<input type="hidden" name="page_options" value="smugbuy_url,smugbuy_text" />

	<p>
	<input type="submit" value="<?php _e('Save Changes') ?>" />
	</p>

	</form>
	</div>
<?php
}
?>