<?php
$args = array(
    'post_type' => 'computer',
    'posts_per_page' => -1,
);

$contacts = new WP_Query($args);

if ($contacts->have_posts()) {
    while ($contacts->have_posts()) {
        $contacts->the_post();
        $title = get_the_title();

        //$email = get_post_meta(get_the_ID(), 'email', true);
        $customerName = get_post_meta(get_the_ID(), 'computer_customer_name', true);
        $email = get_post_meta(get_the_ID(), 'computer_customer_email', true);
        ?>

        <h2><?php echo $title; ?></h2>
        <p>Email: <?php echo $email; ?></p>
        <hr>

    <?php }
    }
wp_reset_postdata();
?>
