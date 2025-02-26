<?php
/*
Plugin Name: Flormar Slider
Description: Mashyni92@gmail.com
Version: 1.0
Author: Maria
Text Domain: flormar-slider
Author URI: https://dev-04.semenenko.pp.ua/
Licence: GPLv2 or later
*/


if ( ! defined( 'ABSPATH' ) ) {
    exit; 
}

function flormar_test_slider($atts) {
	
	if ( ! class_exists( 'WooCommerce' ) ) {
    return;
}	
	$atts = shortcode_atts( array(
        'max-price' => '',
        'min-price' => '',
    ), $atts, 'flormar-test-slider' );

    $meta_query = array('relation' => 'AND');

    if ($atts['max-price']) {
        $meta_query[] = array(
            'key' => '_price',
            'value' => $atts['max-price'],
            'compare' => '<=',
            'type' => 'NUMERIC',
        );
    }

    if ($atts['min-price']) {
        $meta_query[] = array(
            'key' => '_price',
            'value' => $atts['min-price'],
            'compare' => '>=',
            'type' => 'NUMERIC',
        );
    }

    $args = array(
        'post_type' => 'product',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'meta_query' => $meta_query,
    );
	if (!empty($meta_query) && count($meta_query) > 1) {
    $args['meta_query'] = $meta_query;
}

    $query = new WP_Query($args);

    $output .= '<div class="flormar-container">';
	$output .= '<div class="flormar-inner">';
    $output .= '<h2 class="flormar-title">המוצרים הנמכרים ביותר </h2>';
    $output .= '</div>'; 	
    $output .= '<div class="flormar-slider">';	

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            global $product;
            
            $output .= '<div class="flormar-slide">';
            $output .= '<a href="' . get_permalink() . '">' . get_the_post_thumbnail(get_the_ID(), 'medium') . '</a>';
            $output .= '<h3>' . get_the_title() . '</h3>';
            $output .= '<p>' . wc_price($product->get_price()) . '</p>';
            $output .= '</div>';
			
        }
        wp_reset_postdata();
    } else {
        $output .= '<p>No products found.</p>';
    }
	$output .= '</div>';   
	$output .= '</div>'; 

    return $output;	
	
}
add_shortcode('flormar-test-slider', 'flormar_test_slider'); 
   

function flormar_slider_assets() {
    wp_enqueue_style('slick-css', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css');
    wp_enqueue_script('slick-js', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array('jquery'), '', true);
    wp_enqueue_style('flormar-slider-style', plugins_url('style-flormar.css', __FILE__));
    wp_enqueue_script('flormar-slider-script', plugins_url('script-flormar.js', __FILE__), array('jquery', 'slick-js'), '', true);
}
add_action('wp_enqueue_scripts', 'flormar_slider_assets');  
 
