<?php

get_header();
?>

<main>
    <!-- Add your main content here -->
    Content[Element main]
</main>

<section>


<?php
$args = array(
    'post_type' => 'post', // Specify the post type as 'post'
    'posts_per_page' => -1, // Retrieve all posts
);

$query = new WP_Query($args); // Create a new query object with the specified arguments
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


</section>

<aside>
    <!-- Add your aside content here -->
    Content[Aside]
</aside>

<?php
get_footer();
