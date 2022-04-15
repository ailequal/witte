<?php

/**
 * The template for displaying the header for witte.
 */

$time = wp_date('H:i - d-m-Y', time(), null);

?>

<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page-witte" class="site">

    <header id="masthead-witte" class="site-header">
        <div class="info">
            <div class="left">
                <h2 class="title">Menu</h2>
                <h3 class="time"><?php echo $time; ?></h3>
            </div>
            <div class="right">
                <img src="#" alt="—">
            </div>
        </div>
    </header><!-- #masthead -->
