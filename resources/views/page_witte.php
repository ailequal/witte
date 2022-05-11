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

        <div class="meals container">
            <div class="meal lunch">
                <div class="info">
                    <?php echo $lunchTitle; ?>
                </div>

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
                                            <div class="translation" data-translation="<?php echo $translationKey; ?>">
                                                <span class="language">
                                                    <?php echo strtoupper($translationKey); ?>
                                                </span>
                                                <span class="title">
                                                    <?php echo $translation; ?>
                                                </span>
                                            </div>
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
                <div class="info">
                    <?php echo $dinnerTitle; ?>
                </div>

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
                                            <div class="translation" data-translation="<?php echo $translationKey; ?>">
                                                <span class="language">
                                                    <?php echo strtoupper($translationKey); ?>
                                                </span>
                                                <span class="title">
                                                    <?php echo $translation; ?>
                                                </span>
                                            </div>
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
