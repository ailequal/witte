<?php

/**
 * Template Name: witte
 *
 * The custom template for the plugin witte.
 * It's important to name this template with "page_" and not "page-",
 * otherwise WordPress will apply this template to the "witte" page slug.
 */

get_header('witte');

// TODO: Add the logo which will retrieved from the plugin options.

// TODO: We need to handle these labels with their translations??
//  Or maybe just add universal label textarea inside the options!!
//$meals = [
//    'first_course'  => 'Primo - Vorspeise - First course',
//    'second_course' => 'Secondo - Vorspeise - Second course'
//];

$day = get_option('witte_day_plan');
if (false == $day)
    $day = ['lunch' => [], 'dinner' => []];

$lunch  = $day['lunch'];
$dinner = $day['dinner'];

?>

    <main id="primary-witte" class="site-main">

        <!--            --><?php //foreach ($day as $mealKey => $mealData): ?>
        <!--                --><?php //// Loop all the meals together. ?>
        <!--            --><?php //endforeach; ?>

        <div class="meals">
            <div class="meal lunch">
                <h2 class="title">Pranzo - Mittagessen - Lunch</h2>
                <div class="courses">
                    <?php foreach ($lunch as $mealKey => $mealData): ?>
                        <?php // Loop the lunch meal.
                        if (0 == $mealData['id'])
                            continue; ?>
                        <div class="course">
                            <div class="info">
                                <div class="left">
                                    <div class="translations">
                                        <?php foreach ($mealData['translations'] as $translationKey => $translation): ?>
                                            <h4 class="title" data-translation="<?php echo $translationKey; ?>">
                                                <?php echo $translation; ?>
                                            </h4>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <div class="right">
                                    <?php echo $mealData['thumbnail']; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="meal dinner">
                <h2 class="title">Cena - Abendessen - Dinner</h2>
                <div class="courses">
                    <?php foreach ($dinner as $mealKey => $mealData): ?>
                        <?php // Loop the dinner meal.
                        if (0 == $mealData['id'])
                            continue; ?>
                        <div class="course">
                            <div class="info">
                                <div class="left">
                                    <div class="translations">
                                        <?php foreach ($mealData['translations'] as $translationKey => $translation): ?>
                                            <h4 class="title" data-translation="<?php echo $translationKey; ?>">
                                                <?php echo $translation; ?>
                                            </h4>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <div class="right">
                                    <?php echo $mealData['thumbnail']; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

    </main><!-- #main -->

<?php

get_footer('witte');
