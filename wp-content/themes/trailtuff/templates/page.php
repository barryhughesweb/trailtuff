<?php
/*
Template Name: Page
*/
get_header();
?>

<main>
    <?php
    if (have_posts()) :
        while (have_posts()) : the_post();
            get_template_part('template-parts/content', 'single');
        endwhile;
    endif;
    ?>
    <?php get_template_part('template-parts/sections/flexible'); ?>
</main>

<?php get_footer(); ?>