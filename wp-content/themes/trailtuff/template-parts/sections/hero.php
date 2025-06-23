<?php
$hero_countdown_title = get_sub_field('countdown_title');
$countdown_date = get_sub_field('countdown_date');
?>

<?php if (have_rows('slider')) : ?>
<section class="swiper-container w-full relative overflow-hidden">
    <div class="swiper-wrapper flex transition-transform box-content relative">
        <?php while (have_rows('slider')) : the_row();
            $subtitle = get_sub_field('subtitle');
            $title = get_sub_field('title');
            $button_text = get_sub_field('button_text');
            $button_link = get_sub_field('button_link');
            $bg_image = get_sub_field('background_image');
        ?>
        <div class="swiper-slide relative bg-cover bg-center flex flex-col justify-center items-center text-white p-8 shrink-0 w-full h-full" style="background-image: url('<?php echo esc_url($bg_image['url']); ?>');">
            <div class="max-w-7xl mx-auto container mb-56 md:mb-36 xl:mb-44">
                <?php if ($subtitle): ?>
                    <div class="text-base font-bold uppercase tracking-widest mb-2 mt-28 xl:mt-56 2xl:mt-96 text-shadow-md"><?php echo esc_html($subtitle); ?></div>
                <?php endif; ?>

                <?php if ($title): ?>
                    <h2 class="text-3xl uppercase font-extrabold mb-8 text-shadow-md"><?php echo esc_html($title); ?></h2>
                <?php endif; ?>

                <?php if ($button_text && !empty($button_link)) : ?>
                    <a href="<?php echo esc_url($button_link); ?>" class="mt-4 px-6 py-3 border border-white rounded-lg bg-redmain hover:bg-white hover:text-browndark transition font-semibold">
                        <?php echo esc_html($button_text); ?>
                    </a>
                <?php endif; ?>

            </div>
        </div>
        <?php endwhile; ?>
    </div>
    <div id="hero-bottom" class="w-full z-20 backdrop-blur bg-black/50 absolute bottom-0 left-0">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between md:pl-2.5 xl:pl-5 2xl:pl-0">
            <?php if (have_rows('countdown_information')) : ?>
                <div class="flex md:flex-wrap items-center gap-8 countdown-info p-2.5 xl:pl-0">
                    <?php while (have_rows('countdown_information')) : the_row(); 
                        $icon = get_sub_field('icon');
                        $title = get_sub_field('title');
                        $subtitle = get_sub_field('subtitle');
                    ?>
                    <div class="flex items-center gap-4">
                        <?php if ($icon): ?>
                            <div class="w-12 lg:w-16 h-12 lg:h-16 flex items-center justify-center bg-brownlight border-4 border-white rounded-[10px] p-2.5">
                                <img 
                                    src="<?php echo esc_url($icon['url']); ?>" 
                                    alt="<?php echo esc_attr($icon['alt'] ?? ''); ?>" 
                                    title="<?php echo esc_attr($icon['title'] ?? ''); ?>" 
                                    width="<?php echo esc_attr($icon['width'] ?? ''); ?>" 
                                    height="<?php echo esc_attr($icon['height'] ?? ''); ?>" 
                                    class="object-contain max-w-full max-h-full" 
                                />
                            </div>
                        <?php endif; ?>
                        <div class="text-white">
                            <?php if ($title): ?>
                                <div class="text-xl font-bold leading-tight lg:text-3xl"><?php echo esc_html($title); ?></div>
                            <?php endif; ?>
                            <?php if ($subtitle): ?>
                                <div class="text-[10px] tracking-wide uppercase lg:text-sm"><?php echo esc_html($subtitle); ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
            <?php
                $formatted_date = '';
                if ($countdown_date) {
                    $date = DateTime::createFromFormat('d/m/Y', $countdown_date);
                    if ($date) {
                        $formatted_date = $date->format('Y-m-d') . ' 00:00:00';
                    } else {
                        $formatted_date = $countdown_date;
                    }
                }
            ?>
            <?php if (!empty($formatted_date)) : ?>
                <div class="relative countdown text-white w-full md:w-auto">
                    <div class="countdown-box relative bg-black/30 text-white px-6 md:pr-0 py-4 z-10 lg:py-1">
                        <div class="relative z-10 px-4 py-2 lg:px-8 lg:py-4 flex flex-col items-center gap-2">
                            <?php if ($hero_countdown_title): ?>
                                <div class="text-xs lg:text-sm font-medium uppercase tracking-widest lg:leading-3">
                                    <?php echo esc_html($hero_countdown_title); ?>
                                </div>
                            <?php endif; ?>
                            <div 
                                id="countdown" 
                                class="flex gap-4 flex-wrap" 
                                data-target-date="<?php echo esc_attr($formatted_date); ?>"
                            >
                                <?php foreach (['days', 'hours', 'minutes', 'seconds'] as $unit): ?>
                                    <div class="flex flex-col items-center justify-between bg-black text-white w-16 md:w-12 lg:w-16 xl:w-20 h-16 md:h-12 lg:h-16 xl:h-20 rounded-lg overflow-hidden">
                                        <div id="<?php echo $unit; ?>" class="text-2xl md:text-xl lg:text-2xl font-bold flex items-center justify-center h-3/4 opacity-100 transition-opacity duration-200">
                                            0
                                        </div>
                                        <div class="bg-redmain text-white text-[10px] md:text-[8px] lg:text-[10px] xl:text-xs leading-2.5 md:leading-1.5 lg:leading-2.5  xl:leading-3.5 uppercase w-full text-center py-1 h-1/4">
                                            <?php echo $unit; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            new Swiper('.swiper-container', {
                loop: true,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
            });
        });
    </script>
</section>
<?php endif; ?>