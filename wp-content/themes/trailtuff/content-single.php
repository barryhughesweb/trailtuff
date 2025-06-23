<article id="post-<?php the_ID(); ?>" <?php post_class('prose max-w-none'); ?>>
    <h1 class="text-3xl font-bold mb-4"><?php the_title(); ?></h1>
    <div class="mb-8">
        <?php the_content(); ?>
    </div>
</article>