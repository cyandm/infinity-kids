<?php

/**
 * Show options for ordering
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/orderby.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woo.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.6.0
 */

if (!defined('ABSPATH'))
	exit;

function setChecked($value)
{
	echo 'value="' . $value . '"';

	if (isset($_GET['orderby']) && $_GET['orderby'] == $value)
		return "checked";

	return '';
}
?>

<div id="product-archive-ordering" class="ordering">
	<p>
		<i class="iconsax" icon-name="sort"></i>
		<b>ترتیب براساس:</b>
	</p>

	<div class="radio-group">
		<div>
			<input type="radio" name="orderby" class="form-check" id="menu-order-radio" <?= setChecked("menu_order") ?>>
			<label for="menu-order-radio">پیش‌فرض</label>
		</div>

		<div>
			<input type="radio" name="orderby" class="form-check" id="popularity-radio" <?= setChecked("popularity") ?>>
			<label for="popularity-radio">محبوب ترین</label>
		</div>

		<div>
			<input type="radio" name="orderby" class="form-check" id="price-radio" <?= setChecked("price") ?>>
			<label for="price-radio">ارزان ترین</label>
		</div>

		<div>
			<input type="radio" name="orderby" class="form-check" id="price-desc-radio" <?= setChecked("price-desc") ?>>
			<label for="price-desc-radio">گران ترین</label>
		</div>
	</div>
</div>
<div class="clearfix s-6"></div>