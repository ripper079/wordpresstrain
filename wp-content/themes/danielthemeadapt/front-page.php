<?php

get_header();
?>

<h1>front-page.php aka Site Front Page/Landing Page</h1>
<h2><?php echo return_my_name(); ?></h2>
<?php

$argsCPTComputer = array(
    'post_type' => 'computer',
    'posts_per_page' => -1, // Retrieve all posts
);

$query = new WP_Query($argsCPTComputer); // Create a new query object with the specified arguments
?>

<div class="container">
    <div class="row">
        <?php
            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();
                    ?>
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="cardheader text-center"><?php the_title(); ?></div> 
                                <img class="card-img-top" src="https://picsum.photos/200/?random" alt="No pic availible...">
                                <div class="card-body">
                                    <h4 class="text-center">Posttype=<?php echo get_post_type(); ?></h4>
                                    <a href="<?php the_permalink(); ?>"><h5 class="card-title">Go to page to read more</h5></a>
                                    <p class="card-text"><?php the_excerpt(); ?></p>
                                </div>
                            </div>
                        </div> 
                    <?php
                }
            } else {
                echo '<p>There are no posts<p>';
            }
?>
    </div>  
</div> 
<?php

$argsCPTComputer = array(
    'post_type' => 'badmintonklubb',
    'posts_per_page' => -1, // Retrieve all posts
);

$query = new WP_Query($argsCPTComputer); // Create a new query object with the specified arguments
?>

<div class="container">
    <div class="row">
        <?php
            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();
                    $post_id = get_the_ID();
                    $title = get_the_title($post_id);
                    $content = get_the_content($post_id);
                    ?>
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="cardheader text-center"><?php echo $title; ?></div> 
                                <img class="card-img-top" src="https://picsum.photos/200/?random" alt="No pic availible...">                                
                                <div class="card-body">
                                    <h4 class="text-center">Posttype=<?php echo get_post_type(); ?></h4>
                                    <a href="<?php the_permalink(); ?>"><h5 class="card-title">Go to page to read more</h5></a>
                                    <p class="card-text"><?php the_excerpt(); ?></p>
                                </div>
                            </div>
                        </div> 
                    <?php
                }
            } else {
                echo '<p>There are no posts<p>';
            }
?>
    </div>  
</div> 
<h1>Page scraping content of https://stats.swehockey.se/ScheduleAndResults/Overview/14834</h1>
<?php


scrapePage();
?>
<?php
get_footer();
