<?php
defined('ABSPATH') || exit;
get_header('shop'); ?>

<main class="container mx-auto px-4 py-8">
    <?php
    while (have_posts()) :
        the_post();

        wc_get_template_part('content', 'single-product');

    endwhile; // end of the loop.
    ?>
</main>

<?php get_footer('shop'); ?>