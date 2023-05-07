<?php

namespace leoraw_timber\leoraw_timber;

use Timber\Timber;

/** Stop executing files when accessing them directly */
if ( ! defined( 'ABSPATH' ) ){
	die( 'Direct access to theme files is not allowed.' );
}

global $paged;
if (!isset($paged) || !$paged){
    $paged = 1;
}
$context = Timber::context();
$args = array(
    'post_type' => 'art',
    'posts_per_page' => 10,
    'paged' => $paged
);
$context['posts'] = new Timber\PostQuery($args);
$context['sidebar2'] = Timber::get_widgets('sidebar2');
Timber::render('arcat.twig', $context);