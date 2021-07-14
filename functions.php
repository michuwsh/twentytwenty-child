<?php
/**
 * 
 *  Functions.php - to child themes Twenty Twenty
 * 
 */

// Add custom style css to theme parent and custom style

function add_twentytwenty_child_assets() {

    // Include parent style
    wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );

    // Include custom style
    wp_enqueue_style( 'child-custom-style', get_stylesheet_directory_uri().'/assets/css/custom.css' );

    // Include custom javascript 
    wp_enqueue_script( 'my-custom-script', get_stylesheet_directory_uri().'/assets/js/script.js', array( 'jquery' ), false, true );

}

add_action( 'wp_enqueue_scripts', 'add_twentytwenty_child_assets' );

/**
 * Custom Post Type: Library
 */

if ( ! function_exists('tt_child_custom_post') ) {

    // Register Custom Post Type
    function tt_child_custom_post() {
    
        $labels = array(
            'name'                  => _x( 'Books', 'Post Type General Name', 'text_domain' ),
            'singular_name'         => _x( 'Book', 'Post Type Singular Name', 'text_domain' ),
            'menu_name'             => __( 'Books', 'text_domain' ),
            'name_admin_bar'        => __( 'Books', 'text_domain' ),
            'archives'              => __( 'Books', 'text_domain' ),
            'add_new'               => __( 'Add New', 'text_domain' ),
            'new_item'              => __( 'New Item', 'text_domain' ),
            'edit_item'             => __( 'Edit Item', 'text_domain' ),
            'update_item'           => __( 'Update Item', 'text_domain' ),
            'view_item'             => __( 'View Item', 'text_domain' ),
            'view_items'            => __( 'View Items', 'text_domain' ),
            'search_items'          => __( 'Search Item', 'text_domain' ),
            'not_found'             => __( 'Not found', 'text_domain' ),
            'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
        );
    
        $rewrite = array(
            'slug'                  => 'library',
            'with_front'            => true,
            'pages'                 => true,
            'feeds'                 => false,
        );
    
        $args = array(
            'label'                 => __( 'Book', 'text_domain' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'post-formats', 'thumbnail' ),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'rewrite'               => $rewrite,
            'capability_type'       => 'page',
            'has_archive'           => true
        );
        register_post_type( 'library', $args );
    
    }
    add_action( 'init', 'tt_child_custom_post', 0 );
    
}

/**
 * Custom Post Type: Add to Library taxonomy
 */

if ( ! function_exists( 'tt_child_taxonomy' ) ) {

    // Register Custom Taxonomy
    function tt_child_taxonomy() {
    
        $labels = array(
            'name'                       => _x( 'Genre', 'Taxonomy General Name', 'text_domain' ),
            'singular_name'              => _x( 'Genre', 'Taxonomy Singular Name', 'text_domain' ),
            'menu_name'                  => __( 'Genre', 'text_domain' ),
            'all_items'                  => __( 'All Items', 'text_domain' ),
            'parent_item'                => __( 'Parent Item', 'text_domain' ),
            'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
            'new_item_name'              => __( 'New Item Name', 'text_domain' ),
            'add_new_item'               => __( 'Add New Item', 'text_domain' ),
            'edit_item'                  => __( 'Edit Item', 'text_domain' ),
            'update_item'                => __( 'Update Item', 'text_domain' ),
            'view_item'                  => __( 'View Item', 'text_domain' ),
            'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
            'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
            'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
            'popular_items'              => __( 'Popular Items', 'text_domain' ),
            'search_items'               => __( 'Search Items', 'text_domain' ),
            'not_found'                  => __( 'Not Found', 'text_domain' ),
            'no_terms'                   => __( 'No items', 'text_domain' ),
            'items_list'                 => __( 'Items list', 'text_domain' ),
            'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
        );
        $args = array(
            'labels'                     => $labels,
            'hierarchical'               => true,
            'public'                     => true,
            'show_ui'                    => true,
            'show_admin_column'          => true,
            'show_in_nav_menus'          => true,
            'show_tagcloud'              => true,
        );
        register_taxonomy( 'book-genre', array( 'library' ), $args );
    
    }
    add_action( 'init', 'tt_child_taxonomy', 0 );
    
}

/**
 * Add Shortcode Get News title book
 */

function tt_child_get_news_tiitle_book() {
    $args = array(
        'post_type' => 'library',
        'posts_per_page' => 1,
        'order'   => 'DESC'

    );

    $query = new WP_Query( $args );

    // echo "<pre>";
    // print_r($query );
    $title = '';
    if( 0 < count($query->posts) ) {
        $title .= '<div class="news-title">';
            $title .= '<h3>News book</h3>';
            $title .= '<a href="' . get_permalink($query->posts[0]->ID) . '">' . $query->posts[0]->post_title . '</a>';
        $title .= '</div>';
    }

    return $title;

}

add_shortcode( 'tt_child_get_news_tiitle_book', 'tt_child_get_news_tiitle_book' );

/**
 * Add Shortcode Get 5 posts with selected category 
 */

function tt_child_get_recent_posts_function($atts){
    extract(shortcode_atts(array(
       'posts' => 5,
       'category_id' => null
    ), $atts));

    $args = array(
        'post_type' => 'library',
        'order' => 'ASC',
        'orderby' => 'title',
        'showposts' => $posts
    );
    

    if ( null != $category_id ) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'book-genre',
                'field' => 'term_id',
                'terms' => $category_id
            )
        );
    }

    query_posts( $args );
    $return_string = '';
    if (have_posts()) :
        $return_string .= '<div class="books">';
            $return_string .= "<ul>";
            while (have_posts()) : the_post();
                $return_string .= '<li><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
            endwhile;
            $return_string .= "</ul>";
        $return_string .= '</div>';
     endif;

    return $return_string;
 }
 add_shortcode( 'tt_child_get_recent_posts', 'tt_child_get_recent_posts_function' );
