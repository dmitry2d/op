<? get_header(); ?>

<section class="breadcrumbs_wrapper">
	<div class="uk-container uk-container-xlarge">
		<div class="breadcrumbs uk-text-small" typeof="BreadcrumbList" vocab="https://schema.org/">
			<a href="/" title="Главная страница">Главная</a> / Документы
		</div>
	</div>
</section>

<div class="header_big uk-margin-large-top">
	<div class="uk-container uk-container-xlarge">
		<div>Документы</div>
	</div>
</div>

<div id="documents">
  <div class="uk-container uk-container-xlarge uk-margin-large-bottom" uk-scrollspy="cls: uk-animation-slide-bottom-medium;">
    <div class="uk-child-width-1-1" uk-scrollspy="target: > div; cls: uk-animation-slide-bottom-medium; delay: 50" uk-height-match="target: .uk-card > div;target: .uk-card-wrap;" uk-grid>
			<?php
			global $post;
			$myposts = get_posts([
				'posts_per_page' => 100,
				'post_type'   => 'dokument',
				'order'       => 'ASC'
			]);
			if( $myposts ){
				show_dokument_from($myposts,'Федеральные нормативные правовые акты');
				show_dokument_from($myposts,'Областные нормативные правовые акты');
				show_dokument_from($myposts,'Учредительные документы');
				show_dokument_from($myposts,'Результаты проведения специальной оценки труда работников ГОКУ "ОАЦ"');
				show_dokument_from($myposts,'Локальные правовые акты');
				show_dokument_from($myposts,'Реестр помещений для организации добровольческой (волонтерской) деятельности');
			} else {
				// Документов не найдено
			}
			wp_reset_postdata(); // Сбрасываем $post
			?>
    </div>
  </div>
</div>

<?php get_footer(); ?>
