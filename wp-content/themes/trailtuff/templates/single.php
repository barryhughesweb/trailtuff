<?php
get_header();
?>

<main class="container mx-auto px-4 py-8">
    <?php
    while (have_posts()) : the_post();
        get_template_part('template-parts/content', 'single');
    endwhile;
    ?>
</main>

<?php get_footer(); ?>