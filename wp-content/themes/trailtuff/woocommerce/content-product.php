<?php
defined('ABSPATH') || exit;
global $product;
?>

<li <?php wc_product_class('border rounded p-4 hover:shadow-md', $product); ?>>
    <a href="<?php the_permalink(); ?>">
        <?php
        if (has_post_thumbnail()) {
            the_post_thumbnail('medium', ['class' => 'w-full h-auto mb-4']);
        }
        ?>
        <h2 class="text-lg font-semibold mb-2"><?php the_title(); ?></h2>
        <?php woocommerce_template_loop_price(); ?>
    </a>
</li>