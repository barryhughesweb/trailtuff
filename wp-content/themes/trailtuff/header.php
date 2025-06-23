<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes" />
<meta name="theme-color" content="#968372">
<?php $theme_uri = get_template_directory_uri(); ?>
<link rel="shortcut icon" href="<?php echo $theme_uri; ?>/assets/img/favicon.ico">
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo $theme_uri; ?>/assets/img/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo $theme_uri; ?>/assets/img/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo $theme_uri; ?>/assets/img/favicon-16x16.png">
<link rel="manifest" href="<?php echo $theme_uri; ?>/assets/img/site.webmanifest">
<?php wp_head(); ?>
</head>
<body <?php body_class('bg-white text-gray-900'); ?>>

<?php
$bg_image = get_field('header_background_image', 'option');
$bg_style = '';
if (!empty($bg_image['url'])) {
    $bg_style = 'style="background-image: url(' . esc_url($bg_image['url']) . ');"';
}
?>

<header class="bg-cover bg-no-repeat bg-center flex items-center justify-between text-white relative"
    <?php echo $bg_style; ?>>
    <div class="max-w-7xl container mx-auto flex items-center justify-between px-4 md:px-3 relative h-24 md:h-auto">
        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home" class="order-2 md:order-1 w-1/2 md:w-40 lg:w-56 flex justify-center md:justify-start relative z-20">
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
                    class="w-auto max-w-48 md:max-w-40 lg:max-w-full absolute md:left-0 bottom-[-60px] md:bottom-[-50px] lg:bottom-[-70px] drop-shadow-xl/50"
                    aria-label="<?php echo esc_attr($alt); ?>"
                />

            <?php else : ?>
                <h1 class="site-title text-xl font-bold"><?php bloginfo('name'); ?></h1>
                <h2 class="site-description text-sm text-gray-600"><?php bloginfo('description'); ?></h2>
            <?php endif; ?>
        </a>
        <div class="button-wrapper flex justify-end w-1/4 md:hidden order-3">
            <button id="menuToggle" class=" p-2 z-50 relative cursor-pointer ml-auto">
                <span class="block w-6 h-0.5 bg-black transition transform origin-center" id="bar1"></span>
                <span class="block w-6 h-0.5 bg-black mt-1.5 transition-opacity duration-300 ease-in-out opacity-100" id="bar2"></span>
                <span class="block w-6 h-0.5 bg-black mt-1.5 transition transform origin-center" id="bar3"></span>
            </button>
        </div>
        <div class="md:order-2 nav-wrapper hidden md:flex">
            <nav class="relative bg-nav-pattern z-10">
                <div class="relative md:px-4 md:py-2.5 lg:px-5">
                    <?php
                        wp_nav_menu([
                            'theme_location' => 'primary',
                            'menu_class' => 'flex space-x-6 md:text-[10px] lg:text-base uppercase text-white text-shadow-sm tracking-[0.7px] font-bold',
                            'container' => false,
                            'walker' => new Tailwind_Desktop_Navwalker(),
                        ]);
                    ?>
                </div>
            </nav>
        </div>
        <div id="mobileMenu" class="fixed inset-0 z-40 hidden">
            <div id="menuOverlay" class="fixed inset-0 bg-black/70 backdrop-blur-xs opacity-0 transition-opacity duration-300"></div>
            <div id="menuPanel" class="absolute top-0 right-0 bg-brownlight w-3/4 h-full pt-32 translate-x-full transition-transform duration-300 ease-in-out text-center font-bold uppercase">
                <?php
                wp_nav_menu([
                    'theme_location' => 'primary',
                    'container' => false,
                    'menu_class' => 'flex flex-col space-y-4',
                    'walker' => new Tailwind_Navwalker(),
                ]);
                ?>
            </div>
        </div>
        <?php
        $cart_icon = get_field('cart_icon_mobile', 'option');
        $account_icon = get_field('account_icon_mobile', 'option');
        $cart_icon_desktop = get_field('cart_icon_desktop', 'option');
        $account_icon_desktop = get_field('account_icon_desktop', 'option');
        $cart_count = function_exists('WC') && WC()->cart ? WC()->cart->get_cart_contents_count() : 0;
        ?>
        <div class="flex items-center space-x-3 md:space-x-6 order-1 md:order-3 w-1/4 justify-start md:w-auto relative md:overflow-visible md:px-4 md:gap-6">
            <?php if (!empty($cart_icon)) : 
                $cart_alt = !empty($cart_icon['alt']) ? $cart_icon['alt'] : 'Cart';
                $cart_title = !empty($cart_icon['title']) ? $cart_icon['title'] : 'Cart';
            ?>
                <div class="hidden md:block absolute left-2.5 top-0 h-[103%] w-px bg-brownmedium rotate-[15deg] origin-top-left z-0"></div>
                <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="relative flex items-center space-x-2 md:py-10 z-10 md:mr-4">
                    <img 
                        src="<?php echo esc_url($cart_icon['url']); ?>"
                        alt="<?php echo esc_attr($cart_alt); ?>"
                        title="<?php echo esc_attr($cart_title); ?>"
                        width="<?php echo esc_attr($cart_icon['width']); ?>"
                        height="<?php echo esc_attr($cart_icon['height']); ?>"
                        class="w-auto max-w-[18px] block md:hidden"
                        aria-label="<?php echo esc_attr($cart_alt); ?>"
                    />
                    <?php if (!empty($cart_icon_desktop)) : 
                        $cart_alt_desktop = !empty($cart_icon_desktop['alt']) ? $cart_icon_desktop['alt'] : $cart_alt;
                        $cart_title_desktop = !empty($cart_icon_desktop['title']) ? $cart_icon_desktop['title'] : $cart_title;
                    ?>
                    <img 
                        src="<?php echo esc_url($cart_icon_desktop['url']); ?>"
                        alt="<?php echo esc_attr($cart_alt_desktop); ?>"
                        title="<?php echo esc_attr($cart_title_desktop); ?>"
                        width="<?php echo esc_attr($cart_icon_desktop['width']); ?>"
                        height="<?php echo esc_attr($cart_icon_desktop['height']); ?>"
                        class="w-auto max-w-[18px] hidden md:block"
                        aria-label="<?php echo esc_attr($cart_alt_desktop); ?>"
                    />
                    <?php endif; ?>

                    <div class="relative w-8 h-6 text-browndark/70 md:text-brownmedium/70">
                        <svg
                            viewBox="0 0 32 24"
                            xmlns="http://www.w3.org/2000/svg"
                            class="absolute inset-0 w-full h-full"
                            aria-hidden="true"
                        >
                            <path
                            d="M0.138986 6.96792C-0.457909 3.31632 2.36034 0 6.0604 0H25.9396C29.6397 0 32.4579 3.31633 31.861 6.96792L29.8995 18.9679C29.4252 21.8695 26.9182 24 23.9781 24H8.02193C5.08182 24 2.57483 21.8695 2.10053 18.9679L0.138986 6.96792Z"
                            fill="currentColor"
                            />
                        </svg>
                        <div class="relative z-10 flex items-center justify-center w-full h-full text-sm font-medium text-white">
                            <?php echo esc_html($cart_count); ?>
                        </div>
                    </div>
                </a>
                <div class="hidden md:block absolute right-0 top-0 h-[103%] w-px bg-brownmedium rotate-[15deg] origin-top-left z-0 md:right-3.5"></div>
            <?php endif; ?>
            <?php if (!empty($account_icon)) : 
                $account_alt = !empty($account_icon['alt']) ? $account_icon['alt'] : 'Account';
                $account_title = !empty($account_icon['title']) ? $account_icon['title'] : 'Account';

                $account_alt_desktop = !empty($account_icon_desktop['alt']) ? $account_icon_desktop['alt'] : $account_alt;
                $account_title_desktop = !empty($account_icon_desktop['title']) ? $account_icon_desktop['title'] : $account_title;
            ?>
                <a href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))); ?>" class="hidden md:flex items-center">
                    <img 
                        src="<?php echo esc_url($account_icon['url']); ?>"
                        alt="<?php echo esc_attr($account_alt); ?>"
                        title="<?php echo esc_attr($account_title); ?>"
                        width="<?php echo esc_attr($account_icon['width']); ?>"
                        height="<?php echo esc_attr($account_icon['height']); ?>"
                        class="w-auto max-w-[18px] block md:hidden"
                        aria-label="<?php echo esc_attr($account_alt); ?>"
                    />
                    <?php if (!empty($account_icon_desktop)) : ?>
                        <img 
                            src="<?php echo esc_url($account_icon_desktop['url']); ?>"
                            alt="<?php echo esc_attr($account_alt_desktop); ?>"
                            title="<?php echo esc_attr($account_title_desktop); ?>"
                            width="<?php echo esc_attr($account_icon_desktop['width']); ?>"
                            height="<?php echo esc_attr($account_icon_desktop['height']); ?>"
                            class="w-auto max-w-[18px] hidden md:block"
                            aria-label="<?php echo esc_attr($account_alt_desktop); ?>"
                        />
                    <?php endif; ?>
                </a>
            <?php endif; ?>
        </div>
    </div>
</header>