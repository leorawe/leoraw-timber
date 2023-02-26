<?php

namespace leoraw_timber\leoraw_timber;

use Timber\Timber;

/** Stop executing files when accessing them directly */
if ( ! defined( 'ABSPATH' ) ){
	die( 'Direct access to theme files is not allowed.' );
}

global $wp_query;

if ( is_archive() ){
	if ( is_post_type_archive() ){

	} elseif ( is_tax( 'category' ) ) {

	} elseif ( is_tax( 'post_tag' ) ) {

	}
}

$context          = Timber::context();
$context['posts'] = Timber::get_posts( $wp_query );
$templates        = [ "archive/view.twig" ];

Timber::render(
	$templates,
	$context,
	
);