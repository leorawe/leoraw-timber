<?php

namespace leoraw_timber\leoraw_timber;

use Timber\Timber;

/** Stop executing files when accessing them directly */
if ( ! defined( 'ABSPATH' ) ){
	die( 'Direct access to theme files is not allowed.' );
}

global $wp_query;

	$context          = Timber::context();
	$context['posts'] = Timber::get_posts( $wp_query );
	$context['sidebar'] = Timber::get_widgets('sidebar-1');
	$templates        = [ "archive.twig" ];
	
	if (is_post_type_archive('art')) {
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
