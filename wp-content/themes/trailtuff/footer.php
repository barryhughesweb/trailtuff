<section class="bg-white p-3 md:py-5 md:py-8">
    <div class="max-w-7xl container mx-auto">
        <?php if (have_rows('payment_options', 'option')) : ?>
            <div class="w-full flex flex-wrap justify-center gap-8">
                <?php while (have_rows('payment_options', 'option')) : the_row(); 
                    $icon = get_sub_field('payment_icon');
                ?>
                    <?php if ($icon) : ?>
                        <img 
                            src="<?php echo esc_url($icon['url']); ?>" 
                            alt="<?php echo esc_attr($icon['alt'] ?: 'Payment Option'); ?>" 
                            title="<?php echo esc_attr($icon['title'] ?: 'Payment Option'); ?>" 
                            width="<?php echo esc_attr($icon['width']); ?>"
                            height="<?php echo esc_attr($icon['height']); ?>"
                            class="max-w-15 md:max-w-16 lg:max-w-20 h-auto object-contain"
                        />
                    <?php endif; ?>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php
$footer_background_image = get_field('footer_background_image', 'option');
$bg_style = '';

if (!empty($footer_background_image['url'])) {
    $bg_style = 'style="background-image: url(' . esc_url($footer_background_image['url']) . ');"';
}
$company_name = get_field('company_name','option');
$companies_house_number = get_field('companies_house_number','option');
$copyright = get_field('copyright','option');
$website_by_link = get_field('website_by_link','option');
?>

<footer class="text-browndark px-4 py-12 bg-cover bg-no-repeat bg-center text-sm font-bold text-center" <?php echo $bg_style; ?>>
    <div class="max-w-7xl mx-auto container">
        <div class="md:flex md:flex-wrap md:justify-between">
            <div class="w-full md:w-1/3 lg:w-2/5 xl:w-1/2 flex justify-center md:justify-start mb-5 md:mb-0 order-1 md:h-fit">
                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                    <?php
                    $logo = get_field('company_logo', 'option');
                    if (!empty($logo)) :
                        $alt = !empty($logo['alt']) ? $logo['alt'] : get_bloginfo('name');
                        $title = !empty($logo['title']) ? $logo['title'] : get_bloginfo('name');
                    ?>
                        <img 
                        src="<?php echo esc_url($logo['url']); ?>"
                        alt="<?php echo esc_attr($alt); ?>"
                        title="<?php echo esc_attr($title); ?>"
                        width="<?php echo esc_attr($logo['width']); ?>"
                        height="<?php echo esc_attr($logo['height']); ?>"
                        class="w-full max-w-56 lg:max-w-64 h-auto aspect-auto object-contain md:-ml-2.5 lg:-ml-4 drop-shadow-xl/50"
                        aria-label="<?php echo esc_attr($alt); ?>"
                        />
                    <?php else : ?>
                        <h1 class="site-title text-xl font-bold"><?php bloginfo('name'); ?></h1>
                        <h2 class="site-description text-sm text-gray-600"><?php bloginfo('description'); ?></h2>
                    <?php endif; ?>
                </a>
            </div>
            <?php if (have_rows('social_media_links', 'option')) : ?>
                <div class="w-full md:w-auto flex justify-center items-center md:items-start gap-2.5 order-2 md:order-4">
                    <?php while (have_rows('social_media_links', 'option')) : the_row(); 
                    $link = get_sub_field('social_media_link');
                    $icon = get_sub_field('social_media_icon');
                    if ($link && $icon) :
                    ?>
                    <a 
                        href="<?php echo esc_url($link['url']); ?>" 
                        target="<?php echo esc_attr($link['target']); ?>" 
                        rel="<?php echo $link['target'] === '_blank' ? 'noopener noreferrer' : ''; ?>"
                    >
                        <img 
                        src="<?php echo esc_url($icon['url']); ?>" 
                        alt="<?php echo esc_attr($icon['alt']); ?>" 
                        title="<?php echo esc_attr($icon['title']); ?>" 
                        width="<?php echo esc_attr($logo['width']); ?>"
                        height="<?php echo esc_attr($logo['height']); ?>"
                        class="w-8 md:w-6 h-auto"
                        />
                    </a>
                    <?php endif; endwhile; ?>
                </div>
            <?php endif; ?>
            <div class="flex flex-col mt-8 md:mt-0 justify-center md:justify-start w-full flex-1 order-3 md:order-2 text-base md:text-left">
                <?php wp_nav_menu([
                    'theme_location' => 'footer_left',
                    'container'      => false,
                    'menu_class'     => 'flex flex-col gap-2',
                ]); ?>
            </div>
            <div class="flex flex-col justify-center md:justify-start w-full flex-1 order-4 md:order-3 mt-2 md:mt-0 text-base md:text-left">
                <?php wp_nav_menu([
                    'theme_location' => 'footer_right',
                    'container'      => false,
                    'menu_class'     => 'flex flex-col gap-2',
                ]); ?>
            </div>
            <div class="flex flex-col md:items-start w-full order-5 mt-5 lg:mt-0">
                <?php if (!empty($company_name)) : ?>
                    <p><?php echo $company_name; ?></p>
                <?php endif; ?>
                <?php if (!empty($companies_house_number)) : ?>
                    <p>Companies House Number - <?php echo $companies_house_number; ?></p>
                <?php endif; ?>
                <?php if (!empty($copyright)) : ?>
                    <p><?php echo $copyright; ?> <?php echo date('Y'); ?> <?php bloginfo('name'); ?></p>
                <?php endif; ?>
                <?php if (!empty($website_by_link)) : ?>
                    <a 
                        href="<?php echo esc_url($website_by_link['url']); ?>" 
                        target="<?php echo esc_attr($website_by_link['target']); ?>" 
                        rel="<?php echo $website_by_link['target'] === '_blank' ? 'noopener noreferrer' : ''; ?>" class="text-redmain mt-5">
                        <?php echo esc_html($website_by_link['title']); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php wp_footer(); ?>
</footer>
</body>
</html>