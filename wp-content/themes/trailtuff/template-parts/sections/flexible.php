<?php
if (have_rows('flexible_sections')) :
    while (have_rows('flexible_sections')) : the_row();

        $layout = get_row_layout();
        get_template_part('template-parts/sections/' . $layout);

    endwhile;
endif;
?>