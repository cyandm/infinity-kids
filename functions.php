<?php

/* Define Globals */
define('ACF_PATH', get_stylesheet_directory() . '/inc/acf/');
define('ACF_URL', get_stylesheet_directory_uri() . '/inc/acf/');

$GLOBALS['wc_cats_tax_name']    = "product_cat";
$GLOBALS['cyn_offers_tax_name'] = "cyn_offers";
$GLOBALS['cyn_colors_tax_name'] = "cyn_colors";
$GLOBALS['cyn_ages_tax_name']   = "cyn_ages";
$GLOBALS['cyn_faq_post_name']   = "cyn_faq";


/* Required Files */
include_once(ACF_PATH . 'acf.php');
require_once(__DIR__ . '/inc/classes/cyn-theme-init.php');
require_once(__DIR__ . '/inc/classes/cyn-theme-register.php');
require_once(__DIR__ . '/inc/classes/cyn-acf.php');
require_once(__DIR__ . '/inc/classes/cyn-products.php');
require_once(__DIR__ . '/inc/classes/cyn-sms.php');
require_once(__DIR__ . '/inc/classes/cyn-ajax.php');
require_once (__DIR__ . '/inc/classes/cyn-query.php');

/* Initializing Classes */
new cyn_theme_init(false, '1.1.9');
new cyn_register();
new cyn_acf();
new cyn_products(true);
new cyn_ajax();


/**********************************************************/
function sort_products_by_modified_date( $query ) {
    // اطمینان از اینکه در بخش مدیریت نیستیم و کوئری اصلی است
    if ( is_admin() || !$query->is_main_query() ) {
        return;
    }

    // بررسی می‌کنیم که کوئری برای محصولات ووکامرس در صفحات آرشیو (دسته‌بندی‌ها، تگ‌ها و غیره) باشد
    if ( is_post_type_archive('product') || is_tax('product_cat') || is_tax('product_tag') || is_tax('cyn_offers') ) {
        // تنظیم ترتیب بر اساس تاریخ آخرین ویرایش
        $query->set( 'orderby', 'modified' );
        $query->set( 'order', 'DESC' ); // نزولی: جدیدترین ویرایش در ابتدا
    }
}
add_action( 'pre_get_posts', 'sort_products_by_modified_date' );