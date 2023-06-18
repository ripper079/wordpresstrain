<?php

get_header();

// Get the post ID
$post_id = get_the_ID();

// Get the post object
$post = get_post($post_id);
//Extract metabox value(s) for  CPT computer - Manually created (usually in the plugin), with Wordpress functions
$computerOwner = get_post_meta($post->ID, "computer_customer_name", true);
$computerOwnerEmail = get_post_meta($post->ID, "computer_customer_email", true);


echo '<h1> Single-computer.php </h1>';

if ($post) {
    // Display the post title
    echo '<h1>' . $post->post_title . '</h1>';

    // Display the post content
    echo $post->post_content;

    echo '<h5>Contact ' . $computerOwner . " at " . $computerOwnerEmail .  "</h5>";

} else {
    echo '<p>Post not found!</p>';
}
?>
<a class="btn btn-info" role="button" href="<?php echo esc_url(home_url('/')); ?>" >Go to Start Page</a>
<?php

get_footer();
