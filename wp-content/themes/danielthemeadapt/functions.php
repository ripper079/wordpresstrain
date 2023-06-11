 <?php

//Useful of printing/debugging apps
//echo '<pre>';
//print_r(get_template_directory_uri());
//print_r(get_stylesheet_uri());
//wp_die();

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




function theme_setup(){
    //Lets wordpress manage the title tag (Settings->General -> SiteTitle+Tagline)
    add_theme_support( 'title-tag');
}
add_action('after_setup_theme', 'theme_setup');