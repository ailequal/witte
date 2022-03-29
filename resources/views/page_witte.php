<?php

/**
 * Template Name: witte
 *
 * The custom template for the plugin witte.
 * It's important to name this template with "page_" and not "page-",
 * otherwise WordPress will apply this template to the "witte" page slug.
 */

get_header('witte');

$time = wp_date('H:m - d-m-Y', time(), null);

// TODO: We need to handle these labels with their translations??
//  Or maybe just add universal label textarea inside the options!!
//$meals = [
//    'first_course'  => 'Primo - Vorspeise - First course',
//    'second_course' => 'Secondo - Vorspeise - Second course'
//];

$day    = get_option('witte_day_plan');
$lunch  = $day['lunch'];
$dinner = $day['dinner'];

?>

    <main id="primary-witte" class="site-main">

        <h2 class="menu">Menu</h2>

        <h3 class="time"><?php echo $time; ?></h3>

        <!--            --><?php //foreach ($day as $mealKey => $mealData): ?>
        <!--                --><?php //// Loop all the meals together. ?>
        <!--            --><?php //endforeach; ?>

        <div class="lunch">
            <h2>Pranzo - Mittagessen - Lunch</h2>
            <?php foreach ($lunch as $mealKey => $mealData): ?>
                <?php // Loop the lunch meal.
                if (0 == $mealData['id'])
                    continue; ?>
                <div class="meal">
                    <h3><?php echo implode(' - ', $mealData['translations']); ?></h3>
                    <?php echo $mealData['thumbnail']; ?>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="dinner">
            <h2>Cena - Abendessen - Dinner</h2>
            <?php foreach ($dinner as $mealKey => $mealData): ?>
                <?php // Loop the dinner meal.
                if (0 == $mealData['id'])
                    continue; ?>
                <div class="meal">
                    <h3><?php echo implode(' - ', $mealData['translations']); ?></h3>
                    <?php echo $mealData['thumbnail']; ?>
                </div>
            <?php endforeach; ?>
        </div>

    </main><!-- #main -->

<?php

get_sidebar();
get_footer('witte');
