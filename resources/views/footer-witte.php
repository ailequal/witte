<?php

/**
 * The template for displaying the footer for witte.
 */

$message = get_option('witte_template_message');

?>

<footer id="footer-witte" class="site-footer">
    <div class="message container">
        <?php echo $message; ?>
    </div>
</footer><!-- #witte-footer -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
