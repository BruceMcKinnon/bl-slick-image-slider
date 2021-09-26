<?php

add_action('init', 'pro_wpsisac_slider_init');
function pro_wpsisac_slider_init() {
    $wpsisac_slider_labels = array(
    'name'                 => _x('Slick Slider', 'post type general name'),
    'singular_name'        => _x('Slick Slider', 'post type singular name'),
    'add_new'              => _x('Add Slide', 'slick_slider'),
    'add_new_item'         => __('Add New slide'),
    'edit_item'            => __('Edit Slick Slider'),
    'new_item'             => __('New Slick Slider'),
    'view_item'            => __('View Slick Slider'),
    'search_items'         => __('Search Slick Slider'),
    'not_found'            =>  __('No Slick Slider Items found'),
    'not_found_in_trash'   => __('No Slick Slider Items found in Trash'), 
    '_builtin'             =>  false, 
    'parent_item_colon'    => '',
    'menu_name'            => 'Slick Slider Pro'
  );

  $wpsisac_slider_args = array(
    'labels'              => $wpsisac_slider_labels,
    'public'              => true,
    'publicly_queryable'  => true,
    'exclude_from_search' => false,
    'show_ui'             => true,
    'show_in_menu'        => true, 
    'query_var'           => true,
    'rewrite'             => array( 
							'slug' => 'slick_slider',
							'with_front' => false
							),
    'capability_type'     => 'post',
    'has_archive'         => true,
    'hierarchical'        => false,
    'menu_position'       => 8,
	'menu_icon'   => 'dashicons-images-alt2',
    'supports'            => array('title','editor','thumbnail'),
    'exclude_from_search' => true
  );

  register_post_type('slick_slider',$wpsisac_slider_args);

}

/* Register Taxonomy */
add_action( 'init', 'pro_wpsisac_slider_taxonomies');
function pro_wpsisac_slider_taxonomies() {
    $labels = array(
        'name'              => _x( 'Category', 'taxonomy general name' ),
        'singular_name'     => _x( 'Category', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Category' ),
        'all_items'         => __( 'All Category' ),
        'parent_item'       => __( 'Parent Category' ),
        'parent_item_colon' => __( 'Parent Category:' ),
        'edit_item'         => __( 'Edit Category' ),
        'update_item'       => __( 'Update Category' ),
        'add_new_item'      => __( 'Add New Category' ),
        'new_item_name'     => __( 'New Category Name' ),
        'menu_name'         => __( 'Slider Category' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'wpsisac_slider-category' ),
    );

    register_taxonomy( 'wpsisac_slider-category', array( 'slick_slider' ), $args );
}

function pro_wpsisac_slider_rewrite_flush() {  
		pro_wpsisac_slider_init();
    flush_rewrite_rules();
}

register_activation_hook( __FILE__, 'pro_wpsisac_slider_rewrite_flush' );


// Manage Category Shortcode Columns

add_filter("manage_wpsisac_slider-category_custom_column", 'pro_wpsisac_slider_category_columns', 10, 3);
add_filter("manage_edit-wpsisac_slider-category_columns", 'pro_wpsisac_slider_category_manage_columns'); 
function pro_wpsisac_slider_category_manage_columns($theme_columns) {
    $new_columns = array(
            'cb' => '<input type="checkbox" />',
            'name' => __('Name'),
            'slider_shortcode' => __( 'Slider Category Shortcode', 'slick_slider' ),
            'slug' => __('Slug'),
            'posts' => __('Posts')
			);

    return $new_columns;
}

function pro_wpsisac_slider_category_columns($out, $column_name, $theme_id) {
    $theme = get_term($theme_id, 'wpsisac_slider-category');
    switch ($column_name) {      
        case 'title':
            echo get_the_title();
        break;
        case 'slider_shortcode':
			echo '[slick-slider category="' . $theme_id. '"]<br />';
			  echo '[slick-carousel-slider category="' . $theme_id. '"]';		  

        break;
        default:
            break;
    }
    return $out;   

}

/* Custom meta box for slider link */
function pro_wpsisac_add_meta_box() {
		global $wpsisac_theme_domain;
		add_meta_box('custom-metabox',__( 'Read More Link', $wpsisac_theme_domain ),'pro_wpsisac_box_callback','slick_slider');
}
add_action( 'add_meta_boxes', 'pro_wpsisac_add_meta_box' );
function pro_wpsisac_box_callback( $post ) {
	wp_nonce_field( 'pro_wpsisac_save_meta_box_data', 'wpsisac_meta_box_nonce' );
	$value = get_post_meta( $post->ID, 'wpsisac_slide_link', true );
	echo '<input type="url" id="wpsisac_slide_link" name="wpsisac_slide_link" value="' . esc_attr( $value ) . '" size="25" /><br />';
	echo 'eg. http://www.google.com';
}
function pro_wpsisac_save_meta_box_data( $post_id ) {
	if ( ! isset( $_POST['wpsisac_meta_box_nonce'] ) ) {
		return;
	}
	if ( ! wp_verify_nonce( $_POST['wpsisac_meta_box_nonce'], 'pro_wpsisac_save_meta_box_data' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( isset( $_POST['post_type'] ) && 'slick_slider' == $_POST['post_type'] ) {

		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}
	} else {

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}
	if ( ! isset( $_POST['wpsisac_slide_link'] ) ) {
		return;
	}
	$link_data = sanitize_text_field( $_POST['wpsisac_slide_link'] );
	update_post_meta( $post_id, 'wpsisac_slide_link', $link_data );
}
add_action( 'save_post', 'pro_wpsisac_save_meta_box_data' );
