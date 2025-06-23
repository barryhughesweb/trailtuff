<?php get_header(); ?>

<main class="container mx-auto px-4 py-8 max-w-8xl">
    <?php
    if (have_posts()) :
        while (have_posts()) : the_post();
            get_template_part('template-parts/content', 'single');
        endwhile;
    else :
        echo '<p>No content found</p>';
    endif;
    ?>
</main>
<?php get_footer(); ?>