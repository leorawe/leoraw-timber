<?php

namespace leoraw_timber\leoraw_timber;

use Timber;

/** Stop executing files when accessing them directly */
if ( ! defined( 'ABSPATH' ) ){
	die( 'Direct access to theme files is not allowed.' );
}

	global $paged;
	if (!isset($paged) || !$paged){
		$paged = 1;
	}
	$context = Timber::context();
	// $args = array(
	// 	'post_type' => 'post',
	// 	'posts_per_page' => 5,
	// 	'paged' => $paged
	// );
	$context['posts'] = Timber::get_posts( [ 'post_type' => 'art', 'posts_per_page' => 5, 'paged' => $paged] );
	// $context['posts'] = new Timber\PostQuery($args);
	$context['sidebar2'] = Timber::get_widgets('sidebar-2');
	// $context['current_url'] = Timber\URLHelper::get_current_url();
	Timber::render('art.twig', $context);
