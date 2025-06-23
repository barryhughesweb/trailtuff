<?php
add_action( 'init', function() {
    register_post_type('reviews', [
        'labels' => [
            'name'                  => 'Reviews',
            'singular_name'         => 'Review',
            'menu_name'             => 'Reviews',
            'name_admin_bar'        => 'Review',
            'all_items'             => 'All Reviews',
            'add_new'               => 'Add New',
            'add_new_item'          => 'Add New Review',
            'edit_item'             => 'Edit Review',
            'new_item'              => 'New Review',
            'view_item'             => 'View Review',
            'search_items'          => 'Search Reviews',
            'not_found'             => 'No Reviews found',
            'not_found_in_trash'    => 'No Reviews found in Trash',
            'parent_item_colon'     => 'Parent Review:',
            'featured_image'        => 'Review Featured Image',
            'set_featured_image'    => 'Set featured image',
            'remove_featured_image' => 'Remove featured image',
            'use_featured_image'    => 'Use as featured image',
            'archives'              => 'Review Archives',
            'insert_into_item'      => 'Insert into Review',
            'uploaded_to_this_item' => 'Uploaded to this Review',
            'filter_items_list'     => 'Filter Reviews list',
            'items_list_navigation' => 'Reviews list navigation',
            'items_list'            => 'Reviews list',
        ],
        'public'        => true,
        'has_archive'   => true,
        'menu_icon'     => 'dashicons-star-filled',
        'supports'      => ['title', 'editor', 'thumbnail', 'excerpt'], // 👈 Add this line
    ]);
});