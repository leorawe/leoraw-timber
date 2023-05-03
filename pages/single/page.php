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
	$context['sidebar2'] = Timber::get_widgets('sidebar-2');
	Timber::render('single-art.twig', $context);
}
else {
	$context['sidebar'] = Timber::get_widgets('sidebar-1');
	$templates        = array('single.twig' );
	Timber::render('single.twig', $context);
}
