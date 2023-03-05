<?php

namespace leoraw_timber\leoraw_timber;

use Timber\Timber;

/** Stop executing files when accessing them directly */
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access to theme files is not allowed.' );
}

$context         = Timber::context();
$context["post"] = Timber::get_post();
if ( is_singular( 'art' ) ) {
	$templates        = array('single-art.twig' );
}
else {
	$templates        = array('single.twig' );
}

Timber::render(
	$templates,
	$context,
	
);