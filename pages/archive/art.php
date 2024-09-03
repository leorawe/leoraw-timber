<?php

namespace leoraw_timber\leoraw_timber;

use Timber;

/** Stop executing files when accessing them directly */
if ( ! defined( 'ABSPATH' ) ){
	die( 'Direct access to theme files is not allowed.' );
}

$context = Timber::context();

global $wp_query;
global $paged;
	if (!isset($paged) || !$paged){
		$paged = 1;
	}

$args = [ 'post_type' => 'art', 'posts_per_page' => 10, 'paged' => $paged ];
$context['posts'] = Timber::get_posts($args);
$context['sidebar2'] = Timber::get_widgets('sidebar-2');
$templates = [ "art.twig" ];

Timber::render(
		$templates,
		$context,		
	);
