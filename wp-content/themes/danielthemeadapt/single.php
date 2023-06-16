<?php

// Get the post ID
$post_id = get_the_ID();

// Get the post object
$post = get_post($post_id);

echo '<h1> Single.php </h1>';

if ($post) {
    // Display the post title
    echo '<h1>' . $post->post_title . '</h1>';

    // Display the post content
    echo $post->post_content;
} else {
    echo '<p>Post not found!</p>';
}

// Get all taxonomies for the post
$taxonomies = get_post_taxonomies($post_id);
echo '<br>Taxonoies<br>';

// Loop through each taxonomy
foreach ($taxonomies as $taxonomy) {
    echo '<h3>TAXONOMY=' . $taxonomy . '</h3>';

    // Get the terms for the taxonomy
    $terms = get_the_terms($post_id, $taxonomy);

    // Check if terms exist
    if ($terms && ! is_wp_error($terms)) {
        // Loop through each term
        foreach ($terms as $term) {
            $term_link = get_term_link($term, $taxonomy);
            if (is_wp_error($term_link)) {
                continue;
            }
            echo '<a href="' . esc_url($term_link) . '">' . $term->name . '</a>';
            // You can also display other term properties like description, slug, etc. using $term->description, $term->slug, etc.
        }
    }
}
