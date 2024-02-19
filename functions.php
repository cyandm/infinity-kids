<?php

/* Define Globals */
define('ACF_PATH', get_stylesheet_directory() . '/inc/acf/');
define('ACF_URL', get_stylesheet_directory_uri() . '/inc/acf/');

$GLOBALS['wc_cats_tax_name']    = "product_cat";
$GLOBALS['cyn_offers_tax_name'] = "cyn_offers";
$GLOBALS['cyn_colors_tax_name'] = "cyn_colors";
$GLOBALS['cyn_ages_tax_name']   = "cyn_ages";


/* Required Files */
include_once(ACF_PATH . 'acf.php');
require_once(__DIR__ . '/inc/classes/cyn-theme-init.php');
require_once(__DIR__ . '/inc/classes/cyn-theme-register.php');
require_once(__DIR__ . '/inc/classes/cyn-acf.php');
require_once(__DIR__ . '/inc/classes/cyn-products.php');


/* Initializing Classes */
new cyn_theme_init(true, '0.1.0');
new cyn_register();
new cyn_acf();
