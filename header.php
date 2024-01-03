<!DOCTYPE html>
<html <?php language_attributes() ?>>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php wp_head() ?>
</head>

<body <?php body_class() ?>>
	<?php wp_body_open() ?>

	<header id="header">
		<div class="container">
			<!-- Desktop -->
			<div id="header-desktop">
				<div class="logo">
					<?php the_custom_logo() ?>
				</div>

				<nav class="header-nav">
					<?php wp_nav_menu(['menu' => 'Header']) ?>
				</nav>

				<div class="actions">
					<div class="header-search">
						<button class="btn" variant="default" id="open-header-search"><i class="iconsax" icon-name="search-normal-2"></i></button>
						<div class="header-search-group">
							<form class="input-group" action="<?php echo site_url() ?>" method="GET">
								<button type="submit" class="btn iconsax" icon-name="search-normal-2"></button>
								<input name="s" type="text" class="form-control" variant="search" placeholder="جستجو" required>
							</form>
						</div>
					</div>

					<a href="#" class="btn" variant="default"><i class="iconsax" icon-name="shop"></i></a>

					<a href="#" class="btn" variant="text-primary">
						ورود یا ثبت نام
						<i class="iconsax" icon-name="login-2"></i>
					</a>
				</div>
			</div>

			<!-- Mobile -->
			<div id="header-mobile">
				<div class="actions">
					<button id="open-mobile-menu" class="btn" variant="default"><i class="iconsax" icon-name="hamburger-menu"></i></button>

					<div class="logo">
						<?php the_custom_logo() ?>
					</div>

					<a href="#" class="btn" variant="default"><i class="iconsax" icon-name="shop"></i></a>
				</div>

				<div class="clearfix s-6"></div>

				<div class="mobile-search">
					<form class="input-group" action="<?php echo site_url() ?>" method="GET">
						<button type="submit" class="btn iconsax" icon-name="search-normal-2"></button>
						<input name="s" type="text" class="form-control" variant="search" placeholder="جستجو" required>
					</form>
				</div>

				<!-- Menu Modal -->
				<div id="mobile-menu-modal" class="">
					<div class="modal-container">
						<div class="menu-head">
							<button class="btn close-modal" variant="default"><i class="iconsax" icon-name="x"></i></button>

							<div>
								<img src="<?= get_option("cyn_second_logo") ?>" alt="<?= get_option("blogname") ?>">
							</div>
						</div>
						<div class="clearfix s-4"></div>

						<div class="mobile-search">
							<form class="input-group" action="<?php echo site_url() ?>" method="GET">
								<button type="submit" class="btn iconsax" icon-name="search-normal-2"></button>
								<input name="s" type="text" class="form-control" variant="search" placeholder="جستجو" required>
							</form>
						</div>
						<div class="clearfix s-4"></div>

					</div>
				</div>
			</div>
		</div>
	</header>