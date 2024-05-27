<?php

namespace leoraw_timber\leoraw_timber;

use Timber;

/** Stop executing files when accessing them directly */
if ( ! defined( 'ABSPATH' ) ){
	die( 'Direct access to theme files is not allowed.' );
}

get_template_part( 'pages/archive/art' );
