<?php

get_header();
?>

<h1>archive-computer.php</h1>

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
                                <div class="cardheader text-center">Posttype=<?php echo get_post_type(); ?></div> 
                                <img class="card-img-top" src="https://picsum.photos/200/?random" alt="No pic availible...">
                                <div class="card-body">
                                    <a href="<?php the_permalink(); ?>">Link to page</a>
                                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                    <h5 class="card-title"><?php the_title(); ?></h5>
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

get_footer();