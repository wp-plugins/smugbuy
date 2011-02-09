<?php
/*
Plugin Name: SmugBuy
Plugin URI: http://chrismartino.com/smugbuy
Description: A plugin to automatically insert SmugMug buy links into wordpress posts and pages using a shortcode.
Version: 1.1.1
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

// Runs when plugin is activated
register_activation_hook(__FILE__, 'smugbuy_install');

// Runs on plugin deactivation
register_deactivation_hook( __FILE__, 'smugbuy_remove' );

// Runs Plugin settings link function
add_filter('plugin_action_links', 'add_smugbuy_settings_link', 10, 2 );

// Creates new database field
function smugbuy_install() {
add_option("smugbuy_text", 'Buy Print on SmugMug', '', 'yes');
add_option("smugbuy_gtext", 'Buy Prints on SmugMug', '', 'yes');
add_option("smugbuy_dsize", 'L', '', 'yes');
}

// Deletes the database field
function smugbuy_remove() {
delete_option('smugbuy_text');
delete_option('smugbuy_gtext');
delete_option('smugbuy_dsize');
}

// [smugbuy photo="smugmug photo page URL"]
function smugbuy_func($atts) {
        extract(shortcode_atts(array(
                'photo' => '',
                                'display' => 'no',
                'gallery' => '',
        ), $atts));
        ob_start();
            if ($gallery) {
                $smugsplit=explode('/',$gallery);
                $smugurl=$smugsplit[2];
            } else {
                $smugsplit=explode('/',$photo);
                $smugurl=$smugsplit[2];
            }
            if ($gallery) {
				echo "<a href='".esc_url("http://" . $smugurl . "/buy" . strrchr($gallery, '/')) ."'>" . esc_html(get_option('smugbuy_gtext')) . "</a>";
			} else {
				if (strtolower($display) == yes) {
					echo "<a href='".esc_url(str_replace ('#','/',"http://" . $smugurl . "/buy" . strrchr($photo, '/'))) ."'><img src='". esc_url(str_replace('#','/',"http://" . $smugurl . strrchr($photo, '#'))) . "-" . get_option('smugbuy_dsize') . ".jpg'></a><br>";
				}
                    echo "<a href='".esc_url(str_replace ('#','/',"http://" . $smugurl . "/buy" . strrchr($photo, '/'))) ."'>" . esc_html(get_option('smugbuy_text')) . "</a>";
            }
        $link = ob_get_clean();
        return $link;
}
// Add Settings link to plugins page
function add_smugbuy_settings_link($links, $file) {
	static $this_plugin;
	if (!$this_plugin) $this_plugin = plugin_basename(__FILE__);
	if ($file == $this_plugin){
		$settings_link = '<a href="options-general.php?page=SmugBuy">'.__("Settings", "SmugBuy").'</a>';
 		array_unshift($links, $settings_link);
	}
	return $links;
}

add_shortcode('smugbuy', 'smugbuy_func');

if ( is_admin() ){

    // Call the html code
    add_action('admin_menu', 'smugbuy_admin_menu');

    function smugbuy_admin_menu() {
        add_options_page('SmugBuy Options', 'SmugBuy', 'administrator', 'SmugBuy', 'smugbuy_html_page');
    }
}

function smugbuy_html_page() {
?>
    <div>
    <h2>SmugBuy Options</h2>

    <form method="post" action="options.php">
    <?php wp_nonce_field('update-options'); ?>

    <table width="650">
    <tr valign="middle" align="left">
    <th width="150" scope="row">Photo Link Text</th>
    <td width="500">
    <input name="smugbuy_text" type="text" size=30 id="smugbuy_text" value="<?php echo get_option('smugbuy_text'); ?>" /> (ex. Buy Print on SmugMug)</td>
    </tr>
    <tr valign="middle" align="left">
    <th width="150" scope="row">Gallery Link Text</th>
    <td width="500">
    <input name="smugbuy_gtext" type="text" size=30 id="smugbuy_gtext" value="<?php echo get_option('smugbuy_gtext'); ?>" /> (ex. Buy Prints on SmugMug)</td>
    </tr>
    <tr valign="Top" align="left">
    <th width="150" scope="row">Photo Display Size</th>
    <td width="500">
        <input name="smugbuy_dsize" type="radio" id="smugbuy_dsize" value="Ti" <?php if (get_option('smugbuy_dsize') == "Ti") {echo "checked";} ?> /> Tiny <br>
        <input name="smugbuy_dsize" type="radio" id="smugbuy_dsize" value="Th" <?php if (get_option('smugbuy_dsize') == "Th") {echo "checked";} ?> /> Thumbnail<br>
        <input name="smugbuy_dsize" type="radio" id="smugbuy_dsize" value="S" <?php if (get_option('smugbuy_dsize') == "S") {echo "checked";} ?> /> Small<br>
        <input name="smugbuy_dsize" type="radio" id="smugbuy_dsize" value="M" <?php if (get_option('smugbuy_dsize') == "M") {echo "checked";} ?> /> Medium<br>
        <input name="smugbuy_dsize" type="radio" id="smugbuy_dsize" value="L" <?php if (get_option('smugbuy_dsize') == "L") {echo "checked";} ?> /> Large<br>
        <input name="smugbuy_dsize" type="radio" id="smugbuy_dsize" value="XL" <?php if (get_option('smugbuy_dsize') == "XL") {echo "checked";} ?> /> X Large<br>
        <input name="smugbuy_dsize" type="radio" id="smugbuy_dsize" value="X2" <?php if (get_option('smugbuy_dsize') == "X2") {echo "checked";} ?> /> X2 Large<br>
        <input name="smugbuy_dsize" type="radio" id="smugbuy_dsize" value="X3" <?php if (get_option('smugbuy_dsize') == "X3") {echo "checked";} ?> /> X3 Large</td>
    </tr>
    </table><br>
	<strong>Note:</strong> Displayed images will only appear as large as they're allowed by the SmugMug gallery<br>
	configuration.  If you select a display size larger than the gallery settings permit a smaller
	<br>one may appear.<br>
    <input type="hidden" name="action" value="update" />
    <input type="hidden" name="page_options" value="smugbuy_text,smugbuy_gtext,smugbuy_dsize" />

    <p>
    <input type="submit" value="<?php _e('Save Changes') ?>" />
    </p>

	</form>
    </div>
<?php
}
?>