<?php

// Get the post ID
$post_id = get_the_ID();

// Get the post object
$post = get_post($post_id);

if ($post) {
    // Display the post title
    echo '<h1>' . $post->post_title . '</h1>';

    // Display the post content
    echo $post->post_content;
} else {
    echo '<p>Post not found!</p>';
}
