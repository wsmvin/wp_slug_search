<?php 
/**
 * Plugin Name:   Slug:Search
 * Description:   WP: Custom search by slug
 * Version:       1.1.1.0
 * Author:        wsmvin
 */

//for /wp-admin/edit.php
add_filter( 'posts_search', 'custom_search_by_slug', 10, 2 );
function custom_search_by_slug( $search, $query ) {
  global $wpdb;
  if ( is_admin() && $query->is_main_query() && $s = $query->get( 's' ) ) {
    if ( strpos( $s, 'slug:' ) !== false ) {
      $slug = str_replace( 'slug:', '', $s );
      $post_type = $query->get( 'post_type' ) ?: 'any';
      $search .= " OR ({$wpdb->posts}.post_type = '{$post_type}' AND {$wpdb->posts}.post_name LIKE '%{$slug}%') ";
    }
  }
  return $search;
}


