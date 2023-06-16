<!-- https://www.youtube.com/watch?v=rrpyotWlR2g&list=PLD8nQCAhR3tT3ehpyOpoYeUj3KHDEVK9h&index=21 -->
<!-- 2.30 min -->
<?php

//Useful of printing/debugging apps
// echo '<pre>';
// print_r(get_template_directory_uri());
// print_r(get_stylesheet_uri());
// wp_die();

function Danielthemeadapt_enqueue_scripts()
{
    //The benfits with registering and enqueueing in this style is that we can implement som logic when implementing script e.i conditionally or multiply times

    //Register Styles
    //Custom our
    wp_register_style('style-css', get_stylesheet_uri(), [], filemtime(get_template_directory() . '/style.css'), 'all');
    //Bootstrap
    wp_register_style('bootstrap-css', get_template_directory_uri() . '/assets/src/library/css/bootstrap.min.css', [], false, 'all');

    //Register scripts
    //Custom our
    wp_register_script('main-js', get_template_directory_uri() . '/assets/main.js', [], filemtime(get_template_directory() . '/assets/main.js'), true);
    //Bootstrap
    wp_register_script('bootstrap-js', get_template_directory_uri() . '/assets/src/library/js/bootstrap.min.js', ['jquery'], false, true);

    //Enqueue Styles
    //Custom our
    wp_enqueue_style('style-css');
    //Bootstrap
    wp_enqueue_style('bootstrap-css');

    //Enqueue Scripts
    //Custom our
    wp_enqueue_script('main-js');
    //Bootstrap
    wp_enqueue_script('bootstrap-js');

}

add_action('wp_enqueue_scripts', 'Danielthemeadapt_enqueue_scripts');




function theme_setup()
{
    //Lets wordpress manage the title tag (Settings->General -> SiteTitle+Tagline)
    add_theme_support('title-tag');
    //Enable support for a custom theme logo (Appearance->Customize->Sity Identity->Logo )
    add_theme_support('custom-logo', array(
        'height'      => 160,
        'width'       => 160,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array( 'site-title', 'site-description' ),
    ));
    //Enable support for a custom background (Appearance->Customize-> Colors&BackgroundImage)
    add_theme_support('custom-background', array(
        'default-color'          => '#fff',
        'default-image'          => '',
        'default-repeat'        => 'no-repeat'
    ));
    //Enable support for thumbnail when creating new posts newpost->featuredimage
    add_theme_support('post-thumbnails');
    //Enable
    add_theme_support('customize-selective-refresh-widgets');
    //Automatic generation of rss feeds
    add_theme_support('automatic-feed-links');
    //Special support for HTML5 features
    add_theme_support('html5', array(
        'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script'
    ));
    //. It allows you to customize the visual appearance of the editor to match the front-end styling of your theme.
    add_editor_style();
    //Enable support for the block styles feature introduced in the WordPress Gutenberg editor.
    add_theme_support('wp-block-styles');
    //Enabale support for the wide alignment option in the Gutenberg editor.
    add_theme_support('align-wide');
    //Max content width supported
    global $content_width;
    if (! isset($content_width)) {
        $content_width = 1240;
    }
}
add_action('after_setup_theme', 'theme_setup');
