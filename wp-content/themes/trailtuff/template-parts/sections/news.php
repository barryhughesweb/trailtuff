<?php $news_title = get_sub_field('news_title'); ?>

<section class="w-full bg-browndark text-white text-sm font-semibold overflow-hidden">
    <div class="mx-auto relative flex items-center gap-4">
        <?php if ($news_title): ?>
            <div class="news-title bg-redmain h-full shrink-0 relative z-10 text-xs uppercase tracking-wider flex items-center px-4 py-4 pr-12 md:pl-36 lg:pl-[300px] xl:pl-[400px] 2xl:pl-[500px]">
                <?php echo esc_html($news_title); ?>
            </div>
        <?php endif; ?>

        <div class="flex gap-[40px] animate-scroll-x relative z-0 py-2 px-4">
            <?php
            $recent_posts = wp_get_recent_posts([
                'numberposts' => 100,
                'post_status' => 'publish',
            ]);

            foreach ($recent_posts as $post) {
                $title = esc_html($post['post_title']);
                $link = esc_url(get_permalink($post['ID']));
                ?>
                <div class="news-item">
                    <a href="<?php echo $link; ?>" class="inline-block uppercase text-xs tracking-wider">
                        <?php echo $title; ?>
                    </a>
                </div>
                <?php
            }
            wp_reset_postdata();
            ?>
        </div>
    </div>
</section>