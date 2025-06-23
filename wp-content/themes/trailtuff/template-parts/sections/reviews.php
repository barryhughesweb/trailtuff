<section class="bg-brownlighter py-16 lg:py-20">
    <div class="max-w-7xl mx-auto px-4">
        <?php $reviews_title = get_field('reviews_title', 'option'); ?>
        <h2 class="text-center text-3xl md:text-4xl text-browndark font-bold mb-12 lg:mb-16 uppercase tracking-wide">
            <?php echo esc_html($reviews_title); ?>
        </h2>
        <div class="relative">
            <div class="swiper happy-swiper !pb-2.5">
                <div class="swiper-wrapper">
                    <?php
                    $reviews = new WP_Query([
                        'post_type' => 'reviews',
                        'posts_per_page' => -1
                    ]);
                    while ($reviews->have_posts()) : $reviews->the_post();
                        $customer_name = get_field('customer_name');
                        $featured_image = get_post_thumbnail_id();
                        $image_data = wp_get_attachment_image_src($featured_image, 'full');
                        $image_alt = get_post_meta($featured_image, '_wp_attachment_image_alt', true);
                        $image_meta = wp_get_attachment_metadata($featured_image);
                        $image_title = get_the_title($featured_image);

                        $width = $image_meta['width'] ?? '';
                        $height = $image_meta['height'] ?? '';
                        $purchased_by_label = get_field('purchased_by', 'option');
                    ?>
                    <div class="swiper-slide">
                        <div class="bg-white rounded-xl shadow-md overflow-hidden text-center">
                            <?php if ($image_data) : ?>
                                <img 
                                    src="<?php echo esc_url($image_data[0]); ?>" 
                                    alt="<?php echo esc_attr($image_alt ?: get_the_title()); ?>" 
                                    title="<?php echo esc_attr($image_title ?: get_the_title()); ?>" 
                                    width="<?php echo esc_attr($width); ?>" 
                                    height="<?php echo esc_attr($height); ?>" 
                                    class="w-full h-48 object-cover"
                                />
                            <?php endif; ?>
                            <div class="p-5">
                                <h3 class="font-semibold text-lg leading-snug px-2.5"><?php the_title(); ?></h3>
                                <?php if ($customer_name) : ?>
                                    <p class="text-redmain text-sm mt-2">
                                        <?php echo esc_html($purchased_by_label); ?>
                                    </p>
                                    <p class="font-bold text-browndark text-lg">
                                        <?php echo esc_html($customer_name); ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; wp_reset_postdata(); ?>
                </div>
                <div class="pointer-events-none absolute top-0 left-0 w-12 h-full z-10 bg-gradient-to-r from-brownlighter via-brownlighter/70 to-transparent"></div>
                <div class="pointer-events-none absolute top-0 right-0 w-12 h-full z-10 bg-gradient-to-l from-brownlighter via-brownlighter/70 to-transparent"></div>
                </div>
                <div class="swiper-button-prev z-20 !text-browndark !bg-brownlight !p-2 !rounded-lg shadow-md !w-[60px] !h-[60px] border-2 border-white"></div>
                <div class="swiper-button-next z-20 !text-browndark !bg-brownlight !p-2 !rounded-lg shadow-md !w-[60px] !h-[60px] border-2 border-white"></div>
            </div>
        </div>
    </div>
</section>