<?php

namespace leoraw_timber\leoraw_timber;

use Timber;

/** Stop executing files when accessing them directly */
if ( ! defined( 'ABSPATH' ) ){
	die( 'Direct access to theme files is not allowed.' );
}

$context = Timber::context();
if (is_post_type_archive('post') || is_post_type('post')) {
	$context['sidebar'] = Timber::get_widgets('sidebar-1');
	$templates = [ "archive.twig" ];
}

if (is_post_type_archive('art')) {

	$args = [ 'post_type' => 'art', 'posts_per_page' => 5, 'paged' => $paged ];
	$context['posts'] = Timber::get_posts($args);
	$context['sidebar2'] = Timber::get_widgets('sidebar-2');
	$templates = [ "art.twig" ];
}
	if ( is_tax( 'artcat' ) ) {
		$context['sidebar2'] = Timber::get_widgets('sidebar-2');
		$templates = [ "artcat.twig" ];	
	}
	
	Timber::render(
		$templates,
		$context,		
	);

