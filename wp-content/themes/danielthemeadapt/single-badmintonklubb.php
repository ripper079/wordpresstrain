<?php
get_header();


// Get the post ID
$post_id = get_the_ID();

// Get the post object
$post = get_post($post_id);

echo '<h1> Single-badmintonklubb.php </h1>';

if ($post) {
    // Display the post title
    echo '<h1>' . $post->post_title . '</h1>';

    // Display the post content
    echo $post->post_content;

    //Display values from ACF plugin with ACF functions
    $rank = get_field("stats_rk", $post_id);
    $team = get_field("stats_nameteam", $post_id);
    $games_played = get_field("stats_gp", $post_id);
    $count_winning = get_field("stats_win", $post_id);
    $count_tie = get_field("stats_tie", $post_id);
    $count_losses = get_field("stats_loss", $post_id);

    ?>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Rank #</th>
            <th scope="col">Lag</th>
            <th scope="col">Matcher lirade</th>
            <th scope="col">Vinster</th>
            <th scope="col">Oavgjorde</th>
            <th scope="col">Förluster</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row"><?php echo $rank; ?></th>
            <td><?php echo $team; ?></td>
            <td><?php echo $games_played; ?></td>
            <td><?php echo $count_winning; ?></td>
            <td><?php echo $count_tie; ?></td>
            <td><?php echo $count_losses; ?></td>            
        </tr>        
        </tbody>
    </table>
    <?php


    echo '<h4>Rank:' . $rank . "</h4>";

} else {
    echo '<p>Post not found!</p>';
}

?>
<a class="btn btn-info" role="button" href="<?php echo esc_url(home_url('/')); ?>" >Go to Start Page</a>
<?php

get_footer();
