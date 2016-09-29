<?php
function wcssaa_enqueue_styles() {

    $parent_style = 'parent-style';

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}
add_action( 'wp_enqueue_scripts', 'wcssaa_enqueue_styles' );

function customize_sports_archive_display ( $query ) {
	if (($query->is_main_query()) && (is_tax('sports')) && !is_admin()) {
		$query->set( 'post_type', 'game' );
		$query->set( 'posts_per_page', '999' );
		//$query->set( 'meta_key', 'game_date' );
		//$query->set( 'orderby', 'meta_value' );
		$query->set( 'orderby', 'title' );
		$query->set( 'order', 'ASC' );
	}
}
add_action( 'pre_get_posts', 'customize_sports_archive_display' );
