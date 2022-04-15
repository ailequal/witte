<?php

/**
 * The template for displaying the header for witte.
 */

$title = get_option('witte_template_title');

// TODO: Should we return these values from the option below already formatted??
$showDateTime = get_option('witte_template_date_time');
$timestamp    = time();
$dateTime     = wp_date('d/m/Y - H:i', $timestamp, null);
$date         = wp_date('d/m/Y', $timestamp, null);
$time         = wp_date('H:i', $timestamp, null);

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
                <h2 class="title"><?php echo $title; ?></h2>
                <?php if (true == $showDateTime): ?>
                    <div class="date-time">
                        <span class="date"><?php echo $date; ?></span>
                        <span class="separator">&nbsp;-&nbsp;</span>
                        <span class="time"><?php echo $time; ?></span>
                    </div>
                <?php endif; ?>
            </div>
            <div class="right">
                <img src="#" alt="—">
            </div>
        </div>
    </header><!-- #masthead -->
