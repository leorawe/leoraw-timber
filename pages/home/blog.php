<?php
$context         = Timber::context();
$context["post"] = Timber::get_post();
$templates        = array('blog.twig' );

Timber::render(
	$templates,
	$context
);
