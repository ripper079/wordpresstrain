<?php

/*
 @package           PluginPackage
 @author            Your Name
 @copyright         2019 Your Name or Company Name
 @license           GPL-2.0-or-later

 @wordpress-plugin

Plugin Name:  Daniel Super Simple Plugin
Plugin URI:   https://www.danielwpbeginnerplugin.se
Description:  Demo plugin that does something silly
Version:      1.0
Requires at least: 5.2
Requires PHP:      7.2
Author:       Daniel Oikarainen
Author URI:   https://www.danieloikarainen.se
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Update URI:        https://example.com/my-plugin/
Text Domain:  wpb-tutorial
Domain Path:  /languages
*/


if (! defined('ABSPATH')) {
    echo "You should really not be here";
    die;
}

class DanielPlugin
{
    public function __construct()
    {
        add_action('init', array($this, 'registerAllCustomPostTypes'));
    }


    public function activate()
    {
        //Generate a CPT
        $this->registerAllCustomPostTypes();
        //flush rewrite rules
        flush_rewrite_rules();
    }

    public function deactivate()
    {
        //flush rewrite rules
        flush_rewrite_rules();
    }

    public function uninstall()
    {
        //delete CPT
        //delete all the plugin data from the DB
    }


    //Register ALL CPT from here
    public function registerAllCustomPostTypes()
    {
        $this->registerCPTComputers();
    }

    public function registerCPTComputers()
    {
        $labels = array(
            'name'                  => _x('Computers', 'Post type general name', 'textdomain'),
            'singular_name'         => _x('Computer', 'Post type singular name', 'textdomain'),
            'menu_name'             => _x('Computers', 'Admin Menu text', 'textdomain'),
            'name_admin_bar'        => _x('Computer', 'Add New on Toolbar', 'textdomain'),
            'add_new'               => __('Add New', 'textdomain'),
            'add_new_item'          => __('Add New Computer', 'textdomain'),
            'new_item'              => __('New Computer', 'textdomain'),
            'edit_item'             => __('Edit Computer', 'textdomain'),
            'view_item'             => __('View Computer', 'textdomain'),
            'all_items'             => __('All Computers', 'textdomain'),
            'search_items'          => __('Search Computers', 'textdomain'),
            'parent_item_colon'     => __('Parent Computers:', 'textdomain'),
            'not_found'             => __('No Computers found.', 'textdomain'),
            'not_found_in_trash'    => __('No Computers found in Trash.', 'textdomain'),
            'featured_image'        => _x('Computer Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'textdomain'),
            'set_featured_image'    => _x('Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'textdomain'),
            'remove_featured_image' => _x('Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'textdomain'),
            'use_featured_image'    => _x('Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'textdomain'),
            'archives'              => _x('Computer archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain'),
            'insert_into_item'      => _x('Insert into Computer', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'textdomain'),
            'uploaded_to_this_item' => _x('Uploaded to this Computer', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'textdomain'),
            'filter_items_list'     => _x('Filter Computers list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'textdomain'),
            'items_list_navigation' => _x('Computers list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'textdomain'),
            'items_list'            => _x('Computers list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'textdomain'),
        );

        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'Computer' ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'menu_icon'         => 'dashicons-desktop',
            'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
        );

        //Name for CPT is Computer
        register_post_type('Computer', $args);
    }
    //Put all desired hooks in one place
    public function addAllHooks()
    {
        //computer CPT
        $this->addHooksCPTComputers();

    }

    public function addHooksCPTComputers()
    {
        //For Customer Detail
        //--------------------------------------
        add_action("add_meta_boxes", array($this, 'registerCPTComputersMetaboxCustomer'));
        //Last two arguments are: priority(this case 10) and pass 2 argument
        add_action("save_post", array($this, 'saveCPTComputerMetabox'), 10, 2);
        //Rearrange column backend(admin), the hook 'manage_{posttype}_posts_columns'
        add_action("manage_computer_posts_columns", array($this, "rearrangeCPTComputerColumns"));
        //For custom CPT this is also neccessary for custom columns
        add_action("manage_computer_posts_custom_column", array($this, 'rearrangeCPTComputerCustomColumns'), 10, 2);
    }

    //
    public function registerCPTComputersMetaboxCustomer()
    {
        //add_meta_box("comp-cpt-id", "Customer Detail (Metabox)", array($this, 'drawCPTComputersCustomerMetabox'), "Computer", "side", "high");
        add_meta_box("comp-cpt-id", "Customer Detail (Metabox)", array($this, 'drawCPTComputersCustomerMetabox'), "Computer", "normal", "high");
    }
    //The function responsible for drawing the layout
    public function drawCPTComputersCustomerMetabox($post)
    {
        ?>
            <p>
                <label>Name:</label>
                <?php $name = get_post_meta($post->ID, "computer_customer_name", true) ?>
                <input type="text" value="<?php echo $name; ?>" name="inputname" placeholder="Customer Name" />
            </p>
            <p>
                <label>Email:</label>
                <?php $email = get_post_meta($post->ID, "computer_customer_email", true) ?>
                <input type="text" value="<?php echo $email; ?>"  name="inputemail" placeholder="Customer Email" />
            </p>
        <?php
    }


    //https://www.youtube.com/watch?v=poC7NFAi83I&list=PLT9miexWCpPXs5LDHnQFUTFh0o_ihDy3-&index=3
    //9:15 min
    public function saveCPTComputerMetabox($post_id, $post)
    {
        $name = isset($_POST['inputname']) ? $_POST['inputname'] : "";
        $email = isset($_POST['inputemail']) ? $_POST['inputemail'] : "";

        //now save to wp_postmeta
        //update_post_meta($post_id, )
        update_post_meta($post_id, 'computer_customer_name', $name);
        update_post_meta($post_id, 'computer_customer_email', $email);
    }

    //For 'standard'
    public function rearrangeCPTComputerColumns($columns)
    {
        $columns = array(
            "cb" => "<input type='checkbox' />",
            "title" => "Movie title",
            "the_value_for_name" => "Customer name for Computer",
            "the_value_for_email" => "Customer email for Computer"
        );
        return $columns;
    }

    //For custom fields
    public function rearrangeCPTComputerCustomColumns($column, $post_id)
    {

        switch($column) {
            case 'the_value_for_name':
                $customerName = get_post_meta($post_id, "computer_customer_name", true);
                //This line insert into CPT All list
                echo $customerName;
                break;
            case 'the_value_for_email':
                $customerEmail = get_post_meta($post_id, "computer_customer_email", true);
                //This line insert into CPT All list
                echo $customerEmail;
                break;
            default:
                echo "Not implemented yet dude!";
        }
    }


}

$myPlugin = new DanielPlugin();

//Activation
register_activation_hook(__FILE__, array( $myPlugin, 'activate'));
//deactivation
register_deactivation_hook(__FILE__, array( $myPlugin, 'deactivate'));

$myPlugin->addAllHooks();
