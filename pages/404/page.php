<?php

use Timber\Timber;

/** Stop executing files when accessing them directly */
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access to theme files is not allowed.' );
}

$context   = Timber::context();
$templates = [ "404/view.twig" ];

Timber::render(
	$templates,
	$context,
	
);