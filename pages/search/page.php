<?php

namespace leoraw_timber\leoraw_timber;

use Timber\Timber;

/** Stop executing files when accessing them directly */
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access to theme files is not allowed.' );
}

$templates = array( 'search.twig' );

$context = Timber::context();
$context['sidebar'] = Timber::get_widgets('sidebar-1');
$context['title'] = 'Search results for ' . get_search_query();
$context['posts'] = Timber::get_posts();

Timber::render( $templates, $context );