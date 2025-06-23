<?php
$background_image = get_sub_field('background_image');
$product_list_title = get_sub_field('product_list_title');
?>

<section class="relative py-16">
    <?php if ($background_image): ?>
        <div class="absolute inset-0 z-0">
            <img src="<?php echo esc_url($background_image); ?>" alt="" class="w-full h-full object-cover" />
            <div class="absolute inset-0 bg-white opacity-60"></div>
            <div class="absolute inset-x-0 bottom-0 h-[800px] bg-gradient-to-t from-white to-transparent"></div>
        </div>
    <?php endif; ?>

    <div class="relative z-10 max-w-7xl mx-auto px-4 xl:px-0">
        <?php if ($product_list_title): ?>
            <h2 class="text-3xl md:text-4xl font-bold text-browndark text-center mb-16 uppercase tracking-wide">
                <?php echo esc_html($product_list_title); ?>
            </h2>
        <?php endif; ?>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-2.5 md:gap-5 gap-y-10 md:gap-y-10 lg:gap-10 lg:gap-y-20">
            <?php
            $products = wc_get_products([
                'limit' => 6,
                'orderby' => 'date',
                'order' => 'DESC',
                'status' => 'publish',
            ]);
            foreach ($products as $product):
                $product_id = $product->get_id();
                $end_date = get_field('end_date', $product_id);
                $stock_quantity = $product->get_stock_quantity();
                $total_sales = $product->get_total_sales();
                
                $stock_quantity = is_numeric($stock_quantity) ? (int)$stock_quantity : 0;
                $total_sales = is_numeric($total_sales) ? (int)$total_sales : 0;
                
                $stock_total = $stock_quantity + $total_sales;
                $stock_sold = $total_sales;
                $stock_remaining = max(0, $stock_total - $stock_sold);
                
                $percentage = ($stock_total > 0) ? round(($stock_sold / $stock_total) * 100) : 0;
                
                $label = '';
                $label = '';
                $label_class = '';
                
                if ($end_date) {
                    try {
                        $end = DateTime::createFromFormat('d/m/Y', $end_date);
                        if ($end) {
                            $today = new DateTime();
                            $today->setTime(0, 0);
                            $end->setTime(0, 0);
                
                            if ($end == $today) {
                                $label = 'Ends Today';
                                $label_class = 'bg-label-today';
                            } elseif ($end > $today) {
                                $label = 'Ends ' . $end->format('D jS M');
                                $label_class = 'bg-label-future';
                            } else {
                                $label = 'Ended ' . $end->format('D jS M');
                                $label_class = 'bg-label-future';
                            }                            
                        }
                    } catch (Exception $e) {
                        $label = '';
                        $label_class = '';
                    }
                }
                
                $image = wp_get_attachment_image_src($product->get_image_id(), 'medium');
            ?>
                <a href="<?php echo get_permalink($product_id); ?>" class="block group">
                    <div class="bg-white rounded-lg shadow-lg h-full flex flex-col justify-between transition hover:shadow-xl">
                        <div class="relative">
                            <?php if ($label): ?>
                                <div class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2 z-10 inline-block text-center <?php echo $label_class; ?> text-white w-full max-w-4/5 py-1.5">
                                    <p class="font-semibold text-[10px] md:text-xs lg:text-sm uppercase px-4 tracking-wider text-shadow-md"><?php echo $label; ?></p>
                                </div>

                            <?php endif; ?>

                            <div class="bg-white rounded-lg overflow-hidden shadow-lg h-full flex flex-col justify-between transition hover:shadow-xl">
                                <?php if ($image): ?>
                                    <img src="<?php echo esc_url($image[0]); ?>" alt="<?php echo esc_attr($product->get_name()); ?>" class="w-full h-28 md:h-48 object-cover" />
                                <?php endif; ?>

                                <div class="px-2.5 py-5 md:p-5">
                                    <h3 class="font-semibold text-base leading-4 text-browndark mb-4 text-center"><?php echo $product->get_name(); ?></h3>
                                    <p class="text-browndark text-3xl md:text-4xl font-extrabold mb-4 text-center">
                                        <?php
                                        $price = floatval($product->get_price());
                                        echo '£' . number_format($price, 0, '.', ',');
                                        ?>
                                    </p>
                                    <?php if ($stock_total > 0): ?>
                                        <div class="sold-line flex flex-row justify-between">
                                            <p class="text-xs mb-1 text-browndark uppercase">Sold: <?php echo $percentage; ?>%</p>
                                            <p class="text-xs text-browndark mb-4"><?php echo $stock_sold; ?> / <?php echo $stock_total; ?></p>
                                        </div>
                                        <div class="w-full h-2 bg-gray-300 rounded-full overflow-hidden">
                                            <div class="h-full bg-redmain" style="width: <?php echo $percentage; ?>%;"></div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="flex md:p-5">
                                    <span class="w-full bg-brownlight text-brownmedium text-center py-2 mt-auto rounded-lg font-bold transition border-2 border-brownmedium group-hover:bg-redmain group-hover:text-white group-hover:border-redmain">View Product</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>