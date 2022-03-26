<?php

/**
 * Template Name: witte
 *
 * The custom template for the plugin witte.
 */

get_header('witte');

// TODO: We need to handle these labels with their translations??
//  Or maybe just add universal label textarea inside the options.
//$meals = [
//    'first_course'  => 'Primo - Vorspeise - First course',
//    'second_course' => 'Secondo - Vorspeise - Second course'
//];

$day    = get_option('witte_day_plan');
$lunch  = $day['lunch'];
$dinner = $day['dinner'];

?>

    <main id="primary-witte" class="site-main" style="border: 3px solid orangered;">

        <h2>witte</h2>

        <!--            --><?php //foreach ($day as $mealKey => $mealData): ?>
        <!--                --><?php //// Loop all the meals together. ?>
        <!--            --><?php //endforeach; ?>

        <div class="lunch">
            <h2>Pranzo - Mittagessen - Lunch</h2>
            <?php foreach ($lunch as $mealKey => $mealData): ?>
                <?php // Loop the lunch meal.
                if (0 == $mealData['id'])
                    continue;
                ?>
                <div class="meal">
                    <h3><?php echo implode(' - ', $mealData['translations']) ?></h3>
                    <?php echo $mealData['thumbnail'] ?>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="dinner">
            <h2>Cena - Abendessen - Dinner</h2>
            <?php foreach ($dinner as $mealKey => $mealData): ?>
                <?php // Loop the dinner meal.
                if (0 == $mealData['id'])
                    continue;
                ?>
                <div class="meal">
                    <h3><?php echo implode(' - ', $mealData['translations']) ?></h3>
                    <?php echo $mealData['thumbnail'] ?>
                </div>
            <?php endforeach; ?>
        </div>

    </main><!-- #main -->

<?php

get_sidebar();
get_footer('witte');
