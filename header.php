<!doctype html>
<html>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="keywords" content="" />
  <meta name="description" content="" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<link rel="preload" href="/wp-content/themes/oac/font/Montserrat-Regular.woff2" as="font">
	<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
	<link rel="manifest" href="/site.webmanifest">
	<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="msapplication-TileColor" content="#2b5797">
	<meta name="theme-color" content="#000000">
	<?php wp_head();
		$cls_front = "";
		$logo_url = "/wp-content/themes/oac/images/logo_white.png";
		if (is_front_page()) {
			$cls_front = "frontpage";
			$logo_url = "/wp-content/themes/oac/images/logo.png";
		}

	?>
</head>

<body>
<div id="page" class="site <?=$cls_front;?>">
	<div class="topmenu_wrapper">
		<nav class="uk-navbar-container uk-navbar-transparent">
			<div class="uk-container uk-container-xlarge" uk-scrollspy="cls: uk-animation-fade;">
				<div uk-navbar>
					<div class="uk-navbar-left">
						<a class="uk-navbar-item uk-logo" href="/" title='ГОКУ "ОАЦ"'>
							<img src="<?=$logo_url?>" width="60px" alt='ГОКУ "ОАЦ"'> <span class="uk-margin-left" style="line-height: 26px;">Общественная палата<BR>Новгородской области <!--strong>ОАЦ</strong--></span>
						</a>
					</div>
					<div class="uk-width-expand uk-flex uk-flex-middle uk-position-relative">
						<?php
						wp_nav_menu( [
							'theme_location'  => '',
							'menu'            => 'primary',
							'container'       => '',
							'container_class' => '',
							'container_id'    => '',
							'menu_class'      => 'uk-navbar-nav uk-width-expand uk-flex-center',
							'menu_id'         => 'topmenu',
							'echo'            => true,
							'fallback_cb'     => 'wp_page_menu',
							'before'          => '',
							'after'           => '',
							'link_before'     => '',
							'link_after'      => '',
							'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
							'depth'           => 0,
							'walker'          => '',
						]);
						?>

						<div class="menu-dropdown-support uk-padding">
							<div class="uk-child-width-1-2 uk-child-width-1-3" uk-grid>
								<div><a href="https://ngnov.ru/wp-content/uploads/2023/05/opendata.xlsx" target="_blank">Открытые данные</a></div>
								<div><a href="https://oacentr.ru/reestry-minekonomrazvitiya-rossii/" target="_blank">Реестры</a></div>
								<div><a href="https://oacentr.ru/blagotvoritelnost/">Благотворительность</a></div>
								
							</div>
						</div>

						<?php echo do_shortcode( '[bvi]' ); ?>
						<div class="uk-visible@s uk-text-nowrap topmenu_address">
							<span class="uk-text-small alignright">г. Великий Новгород,<BR>ул. Славная, д. 55А</span><br>
							<a href="tel:88162273217" class="font-22 uk-flex uk-flex-middle color_white" style="margin-top: 14px;">+7 (8162) 27-32-17</a>
						</div>
						<div class="hamburger hamburger--slider" uk-toggle="target: #offcanvas-flip">
        			<div class="hamburger-box">
          			<div class="hamburger-inner"></div>
        			</div>
      			</div>
						<div id="offcanvas-flip" uk-offcanvas="flip: true; overlay: true">
							<div class="uk-offcanvas-bar">
								<div>
									<a href="/" class="uk-flex uk-flex-middle uk-logo">
										<img src="/wp-content/themes/oac/images/oac-logo.svg" width="60px"> <span class="uk-margin-left">ГОКУ <strong>ОАЦ</strong></span>
									</a>
								</div>
								<button class="uk-offcanvas-close uk-close-large" type="button" uk-close></button>
								<?php
								wp_nav_menu( [
									'theme_location'  => '',
									'menu'            => 'primary',
									'container'       => '',
									'container_class' => '',
									'container_id'    => '',
									'menu_class'      => 'uk-list',
									'menu_id'         => 'menu_offset',
									'echo'            => true,
									'fallback_cb'     => 'wp_page_menu',
									'before'          => '',
									'after'           => '',
									'link_before'     => '',
									'link_after'      => '',
									'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
									'depth'           => 0,
									'walker'          => '',
								]);
								?>
								<hr />
								<div>
									<a href="tel:+78162273217" class="uk-text-bold">+7 (8162) 27-32-17</a>
									<a href="mailto:oac@oacentr.ru">oac@oacentr.ru</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</nav>
	</div>


	<div id="content" class="site-content">
