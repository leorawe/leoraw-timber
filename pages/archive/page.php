<?php

namespace leoraw_timber\leoraw_timber;

use Timber;

/** Stop executing files when accessing them directly */
if ( ! defined( 'ABSPATH' ) ){
	die( 'Direct access to theme files is not allowed.' );
}

global $wp_query;
global $paged;
	if (!isset($paged) || !$paged){
		$paged = 1;
	}

	// $args = array(
	// 	'post_type' => 'post',
	// 	'posts_per_page' => 10,
	// 	'paged' => $paged
	// );

	$context          = Timber::context();
	$context['posts'] = Timber::get_posts( $wp_query );
	// $context['posts'] = new Timber\PostQuery($args);
	$context['sidebar'] = Timber::get_widgets('sidebar-1');
  $context['current_url'] = basename(Timber\URLHelper::get_current_url());
	$templates = [ "archive.twig" ];
	
	if (is_post_type_archive('art')) {
		$args = array(
		'post_type' => 'art',
		'posts_per_page' => 10,
		'paged' => $paged
	);
		$context['posts'] = new Timber\PostQuery($args);
		$context['sidebar2'] = Timber::get_widgets('sidebar-2');
		$templates        = [ "artcat.twig" ];
	}
	if ( is_tax( 'artcat' ) ) {
		$context['sidebar2'] = Timber::get_widgets('sidebar-2');
		$templates        = [ "artcat.twig" ];	
	}
	
	Timber::render(
		$templates,
		$context,
		
	);
