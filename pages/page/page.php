<?php

namespace leoraw_timber\leoraw_timber;

use Timber;

/** Stop executing files when accessing them directly */
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access to theme files is not allowed.' );
}

$context         = Timber::context();
$context["post"] = Timber::get_post();
$templates        = array('page.twig' );

Timber::render(
	$templates,
	$context
);