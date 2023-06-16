<?php

// Get the post ID
$post_id = get_the_ID();

// Get the post object
$post = get_post($post_id);

echo '<h1> Single-computer.php </h1>';

if ($post) {
    // Display the post title
    echo '<h1>' . $post->post_title . '</h1>';

    // Display the post content
    echo $post->post_content;
} else {
    echo '<p>Post not found!</p>';
}
