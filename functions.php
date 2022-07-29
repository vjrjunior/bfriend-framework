<?php

// setup framework functions
require_once ('functions/setup.php');
require_once ('functions/wp-admin.php');

// define theme constants
define('BF_PARTIALS_PATH', get_stylesheet_directory() . '/partials/');
define('BF_CONTENTS_PATH', get_stylesheet_directory() . '/contents/');
define('BF_LOOPS_PATH',    get_stylesheet_directory() . '/contents/loops/');

// general functions, filters and hooks
require_once ('functions/bfriend.php');
require_once ('functions/bfriend-acf.php');
require_once ('functions/bfriend-functions.php');

// wordpress navwalker
require_once ('functions/wp_bootstrap_navwalker.php');