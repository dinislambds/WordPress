<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              logicfighters.com
 * @since             1.0.0
 * @package           Guild
 *
 * @wordpress-plugin
 * Plugin Name:       Guilds
 * Plugin URI:        logicfighters.com
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            logicfighters
 * Author URI:        logicfighters.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       guild
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'PLUGIN_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-guild-activator.php
 */
function activate_guild() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-guild-activator.php';
	Guild_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-guild-deactivator.php
 */
function deactivate_guild() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-guild-deactivator.php';
	Guild_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_guild' );
register_deactivation_hook( __FILE__, 'deactivate_guild' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-guild.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_guild() {

	$plugin = new Guild();
	$plugin->run();

}
run_guild();




/** 

Custom PHP by Logic Fighters

*/
function cat_post_type() {
  register_post_type( 'cat_guild',
    array(
      'labels' => array(
        'name' => __( 'Guilds' ),
        'singular_name' => __( 'Guild' ),
		'add_new_item' => __('Add New Guild'),
		'edit_item'=> __('Edit Guild'),
		'search_item' => __('Search Guild'),
		'parent_item_colon' => __('Parent Guild'),
		'not_found' => __('No Guild Found'),
		'not_found_in_trash' => __('No Guild Found in trash')
      ),
      'public' => true,
      'has_archive' => true,
      'supports' => array( 'title')
    )
  );
}
add_action( 'init', 'cat_post_type' );


/*   
		Position Custom Taxonomy
*/


function position_custom_taxonomies(){
	$labels = array(
			'name' => 'Position',
			'singular_name' => 'Position',
			'search_items' => 'Search Position',
			'all_items' => 'All Position',
			'parent_item' => 'Parent Position',
			'parent_item_colon' => 'Parent Position:',
			'edit_item' => 'Edit Position',
			'update_item' => 'Update Position',
			'add_new_item' => 'Add New Position',
			'add_new_name' => 'New Position Name',
			'menu_name' => 'Position'

	);
	$args = array(
		'hierarchical' => true,
		'public' => true,
		'labels' => $labels,
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'position')
	);
	register_taxonomy('position_custom_taxonomies', array('cat_guild'), $args);
}
add_action('init', 'position_custom_taxonomies');


/*   
		Character Custom Taxonomy
*/


function character_custom_taxonomies(){
	$labels = array(
			'name' => 'Characters',
			'singular_name' => 'Character',
			'search_items' => 'Search Character',
			'all_items' => 'All Characters',
			'parent_item' => 'Parent Character',
			'parent_item_colon' => 'Parent Character:',
			'edit_item' => 'Edit Character',
			'update_item' => 'Update Character',
			'add_new_item' => 'Add New Character',
			'add_new_name' => 'New Character Name',
			'menu_name' => 'Characters'

	);
	$args = array(
		'hierarchical' => true,
		'public' => true,
		'labels' => $labels,
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'characters')
	);
	register_taxonomy('character_custom_taxonomies', array('cat_guild'), $args);
}
add_action('init', 'character_custom_taxonomies');


/*   
		Meta Box
*/

function guild_add_meta_boxes(){
	add_meta_box('cat_guild_details', __('Guild Details', 'guild'), 'guild_event_details_callback', 'cat_guild');
}
add_action('add_meta_boxes', 'guild_add_meta_boxes');
function guild_event_details_callback($post){
	$event_id = get_post_meta($post->ID, '_guild_event_id', true);
	$event_name = get_post_meta($post->ID, '_guild_event_name', true);
	$event_tropies = get_post_meta($post->ID, '_guild_event_tropies', true);
	$event_members = get_post_meta($post->ID, '_guild_event_members', true);
	$event_joined = get_post_meta($post->ID, '_guild_event_joined', true);
	$event_status = get_post_meta($post->ID, '_guild_event_status', true);
	$event_password = get_post_meta($post->ID, '_guild_event_password', true);
	?>
	<style>
		.guild-inputs{
			display: block;
			width: 50%;
			clear: both;
			margin-bottom: 10px;
		}
	</style>
	<label for="">ID</label>
	<input type="text" class="guild-inputs" name="_guild_event_id" value="<?php echo $event_id; ?>">
	<label for="">Name</label>
	<input type="text" class="guild-inputs" name="_guild_event_name" value="<?php echo $event_name; ?>">
	<label for="">Tropies</label>
	<input type="text" class="guild-inputs" name="_guild_event_tropies" value="<?php echo $event_tropies; ?>">
	<label for="">Members</label>
	<input type="text" class="guild-inputs" name="_guild_event_members" value="<?php echo $event_members; ?>">
	<label for="">Joined</label>
	<input type="date" class="guild-inputs" name="_guild_event_joined" value="<?php echo $event_joined; ?>">
	<label for="">Status</label>
	<!-- <input type="text" class="guild-inputs" name="_guild_event_status" value="<?php echo $event_status; ?>"> -->

	 <select name="_guild_event_status">
            <option value="Active" <?php selected( $$event_status, 'Active' ); ?>>Active</option>
            <option value="Inactive" <?php selected( $$event_status, 'Inactive' ); ?>>Inactive</option>
      </select>


	<label for="">Password</label>
	<input type="text" class="guild-inputs" name="_guild_event_password" value="<?php echo $event_password; ?>">
	<?php
}
function guild_save_event_details($post_id){
	$post_type = get_post_type($post_id);
	if( $post_type == 'cat_guild' ){
		if( isset($_POST['_guild_event_id'])){
			update_post_meta($post_id, '_guild_event_id', trim($_POST['_guild_event_id']));
		}
		if( isset($_POST['_guild_event_name'])){
			update_post_meta($post_id, '_guild_event_name', trim($_POST['_guild_event_name']));
		}
		if( isset($_POST['_guild_event_tropies'])){
			update_post_meta($post_id, '_guild_event_tropies', trim($_POST['_guild_event_tropies']));
		}
		if( isset($_POST['_guild_event_members'])){
			update_post_meta($post_id, '_guild_event_members', trim($_POST['_guild_event_members']));
		}
		if( isset($_POST['_guild_event_joined'])){
			update_post_meta($post_id, '_guild_event_joined', trim($_POST['_guild_event_joined']));
		}
		if( isset($_POST['_guild_event_status'])){
			update_post_meta($post_id, '_guild_event_status', trim($_POST['_guild_event_status']));
		}
		if( isset($_POST['_guild_event_password'])){
			update_post_meta($post_id, '_guild_event_password', trim($_POST['_guild_event_password']));
		}
	}
}
add_action('save_post', 'guild_save_event_details');