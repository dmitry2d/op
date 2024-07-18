<?php
/**
 * Страница 404 ошибки
 */
get_header();
?>

<section class="uk-section uk-section-large">
	<div class="uk-container uk-container-medium" uk-scrollspy="cls: uk-animation-slide-bottom-medium;">
		<div class="row">
			<div class="uk-child-width-1-1 uk-child-width-1-2@m uk-text-center uk-flex uk-flex-middle" uk-grid>
				<div>
					<img src="/wp-content/themes/oac/images/4042.svg" width="360px">
				</div>
				<div>
					<h2>Похоже мы не можем найти<br> нужную вам страницу</h2>
					<h4>Код ошибки: <strong>404</strong></h4>
					<a href="/" class="btn_fill_color uk-margin-top">На главную</a>
				</div>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>
