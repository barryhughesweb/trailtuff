<?php
get_header();
?>

<main class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">
        <?php the_archive_title(); ?>
    </h1>

    <?php if (have_posts()) : ?>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <?php while (have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('border p-4'); ?>>
                    <h2 class="text-xl font-semibold mb-2"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <div><?php the_excerpt(); ?></div>
                </article>
            <?php endwhile; ?>
        </div>
    <?php else : ?>
        <p>No posts found.</p>
    <?php endif; ?>
</main>

<?php get_footer(); ?>