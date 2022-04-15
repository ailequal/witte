<?php

/**
 * Template Name: witte
 *
 * The custom template for the plugin witte.
 * It's important to name this template with "page_" and not "page-",
 * otherwise WordPress will apply this template to the "witte" page slug.
 */

get_header('witte');

$lunchTitle  = get_option('witte_template_lunch');
$dinnerTitle = get_option('witte_template_dinner');

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
                <h2 class="title"><?php echo $lunchTitle; ?></h2>
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
                <h2 class="title"><?php echo $dinnerTitle; ?></h2>
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
