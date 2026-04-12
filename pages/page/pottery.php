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
	$context['posts'] = Timber::get_posts( 
		[ 'post_type' => 'art', 
		'artcat' => 'pottery',
		'posts_per_page' => 9, 
		'paged' => $paged] );
	$context['sidebar2'] = Timber::get_widgets('sidebar-2');
	Timber::render('art.twig', $context);
