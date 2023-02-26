<?php

namespace leoraw_timber\leoraw_timber;

use Timber\Timber;

/** Stop executing files when accessing them directly */
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access to theme files is not allowed.' );
}

$context           = Timber::context();
$context["author"] = Timber::get_user();
$templates         = [ "view.twig" ];

Timber::render(
	$templates,
	$context,
	
);
