<?php

namespace leoraw_timber\leoraw_timber;

use Timber;

/** Stop executing files when accessing them directly */
if ( ! defined( 'ABSPATH' ) ){
	die( 'Direct access to theme files is not allowed.' );
}

// $context         = Timber::context();
// $context["post"] = Timber::get_post();
// $templates        = array('blog.twig' );

// Timber::render(
// 	$templates,
// 	$context
// );
	global $paged;
	if (!isset($paged) || !$paged){
		$paged = 1;
	}
	$context = Timber::context();
	$args = array(
		'post_type' => 'post',
		'posts_per_page' => 5,
		'paged' => $paged
	);
	$context['posts'] = new Timber\PostQuery($args);
	Timber::render('blog.twig', $context);
