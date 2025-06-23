<?php
defined('ABSPATH') || exit;
get_header(); ?>

<main class="container mx-auto px-4 py-8">
    <?php if (apply_filters('woocommerce_show_page_title', true)) : ?>
        <h1 class="text-3xl font-bold mb-6"><?php woocommerce_page_title(); ?></h1>
    <?php endif; ?>

    <?php if (woocommerce_product_loop()) : ?>

        <?php woocommerce_product_loop_start(); ?>

        <?php if (wc_get_loop_prop('total')) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <?php wc_get_template_part('content', 'product'); ?>
            <?php endwhile; ?>
        <?php endif; ?>

        <?php woocommerce_product_loop_end(); ?>

        <?php
        /**
         * Hook: woocommerce_after_shop_loop.
         */
        do_action('woocommerce_after_shop_loop');
        ?>

    <?php else : ?>

        <?php
        /**
         * Hook: woocommerce_no_products_found.
         */
        do_action('woocommerce_no_products_found');
        ?>

    <?php endif; ?>
</main>

<?php get_footer(); ?>