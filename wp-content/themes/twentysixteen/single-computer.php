<?php
//Check content for this in the permalink section of the current CPT
while (have_posts()) {
    the_post();
    $name = get_the_title();
    $content = get_the_content();
    //$lines = explode("\n", $content);
    $lines = explode(PHP_EOL, $content);

    $customerName = get_post_meta(get_the_ID(), 'computer_customer_name', true);
    $email = get_post_meta(get_the_ID(), 'computer_customer_email', true);
    ?>
    <h1>Title</h1>
    <h2><?php echo $name; ?></h2>
    <h1>The content</h1>
    <?php
        foreach ($lines as $line) {
            // Process each line here
            echo $line . "<br>"; // Example: Output each line with a line break
        }
    ?>

    <!-- <h2><?php echo $content; ?></h2> -->
    <p>Customer Name: <?php echo $customerName; ?></p>
    <p>Email: <?php echo $email; ?></p>

<?php } ?>
