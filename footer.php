<footer id="footer">
	<div class="container footer f-row c-7 c-md-2">
		<div class="">
			<h5>فروشگاه</h5>
			<?php wp_nav_menu(['theme_location' => "footer_shop"]) ?>
		</div>

		<div class="">
			<h5>مطالب مفید</h5>
			<?php wp_nav_menu(['theme_location' => "footer_articles"]) ?>
		</div>

		<div class="">
			<h5>خدمات مشتریان</h5>
			<?php wp_nav_menu(['theme_location' => "footer_services"]) ?>
		</div>

		<div class="">
			<h5>ارتباط با ما</h5>
			<?php if (get_option("cyn_phone_number1")) : ?>
				<p dir="ltr"><?= get_option("cyn_phone_number1") ?></p>
			<?php endif; ?>
			<?php if (get_option("cyn_phone_number2")) : ?>
				<p dir="ltr"><?= get_option("cyn_phone_number2") ?></p>
			<?php endif; ?>
		</div>

		<div class="w-md-100">
			<h5>آدرس فروشگاه حضوری</h5>
			<p><?= get_option("cyn_shop_address") ?></p>
		</div>

		<div class="w-md-100">
			<div>
				<h5>شبکه های اجتماعی</h5>
				<div class="footer-media">
					<a href="<?php echo get_option("cyn_pinterest") ? get_option("cyn_pinterest") : "#"; ?>">
						<img src="<?= get_stylesheet_directory_uri() . "/assets/img/pinterest-icon.svg" ?>">
					</a>

					<a href="<?php echo get_option("cyn_instagram") ? get_option("cyn_instagram") : "#"; ?>">
						<img src="<?= get_stylesheet_directory_uri() . "/assets/img/instagram-icon.svg" ?>">
					</a>

					<a href="<?php echo get_option("cyn_whatsapp") ? get_option("cyn_whatsapp") : "#"; ?>">
						<img src="<?= get_stylesheet_directory_uri() . "/assets/img/whatsapp-icon.svg" ?>">
					</a>
				</div>
			</div>
			<div class="clearfix s-5"></div>

			<div>
				<h5>پیگیری سفارشات</h5>
				<div class="footer-media">
					<a href="#"><img src="<?= get_stylesheet_directory_uri() . "/assets/img/track-orders-icon.svg" ?>"></a>
				</div>
			</div>
		</div>

		<div class="footer-img w-md-100">
			<img src="<?= get_option("cyn_footer_img") ?>">
		</div>
	</div>
</footer>

<!-- Scripts -->
<?php wp_footer() ?>
</body>

</html>