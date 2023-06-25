<?php

use Timber\Timber;

/** Stop executing files when accessing them directly */
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access to theme files is not allowed.' );
}

$context   = Timber::context();
$context['sidebar'] = Timber::get_widgets('sidebar-1');
$templates = [ "404.twig" ];

Timber::render(
	$templates,
	$context,
	
);