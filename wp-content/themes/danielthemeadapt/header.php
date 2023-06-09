<?php
/**
 * Header template file
 *
 * @ Danielthemeadapt
 */
?>

<!DOCTYPE html>
<!-- <html lang="en"> -->
<html lang="<?php language_attributes(); ?>">
<head>
    <!-- <meta charset="UTF-8"> -->
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>Genix Coperation</title> -->  
    <!-- Wordpress way of including scripts -->
    <?php wp_head() ?>
</head>
<body>
    <!-- Add your header content here -->
    <header>
        HEADER
        <nav>
            <ul>
                <li><a href="link1.html">Link 1</a></li>
                <li><a href="link2.html">Link 2</a></li>
                <li><a href="link3.html">Link 3</a></li>
            </ul>
        </nav>
    </header>