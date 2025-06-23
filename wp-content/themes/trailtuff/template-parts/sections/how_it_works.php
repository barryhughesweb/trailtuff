<?php
$bg = get_sub_field('steps_background_image');
$bg_url = is_array($bg) ? $bg['url'] : $bg;
$main_title = get_sub_field('steps_main_title');
?>

<section class="how-it-works relative bg-cover bg-center bg-no-repeat py-16 text-white" style="background-image: url('<?php echo esc_url($bg_url); ?>');">
    <div class="absolute inset-0 bg-black/30 z-0"></div>
    <div class="relative z-10 max-w-7xl mx-auto lg:max-w-6xl container px-4 xl:px-0">
        <?php if ($main_title) : ?>
            <h2 class="text-3xl md:text-4xl uppercase font-bold text-center mb-12 w-full tracking-wider">
                <?php echo esc_html($main_title); ?>
            </h2>
        <?php endif; ?>
        <?php if (have_rows('how_steps')) : ?>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center justify-items-center">
                <?php while (have_rows('how_steps')) : the_row(); 
                    $icon = get_sub_field('icon');
                    $title = get_sub_field('step_title');
                    $text = get_sub_field('step_text');
                ?>
                    <div class="flex flex-col items-center p-6 lg:max-w-80">
                        <?php if ($icon) : ?>
                            <div class="w-20 h-20 mb-4 flex items-center justify-center bg-brownlight border-4 border-white rounded-[10px]">
                                <img 
                                    src="<?php echo esc_url($icon['url']); ?>" 
                                    alt="<?php echo esc_attr($icon['alt'] ?: 'Icon'); ?>" 
                                    title="<?php echo esc_attr($icon['title'] ?: 'Icon'); ?>" 
                                    width="<?php echo esc_attr($icon['width']); ?>" 
                                    height="<?php echo esc_attr($icon['height']); ?>" 
                                    class="object-contain max-w-full max-h-full"
                                />
                            </div>
                        <?php endif; ?>


                        <?php if ($title) : ?>
                            <h3 class="text-xl leading-5 font-semibold mb-2"><?php echo esc_html($title); ?></h3>
                        <?php endif; ?>

                        <?php if ($text) : ?>
                            <p class="text-sm lg:text-base leading-4 lg:leading-5 opacity-90"><?php echo esc_html($text); ?></p>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</section>