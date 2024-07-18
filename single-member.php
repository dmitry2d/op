<? get_header(); ?>

<section class="breadcrumbs_wrapper">
		<div class="uk-container uk-container-xlarge">
			<div class="breadcrumbs uk-text-small" typeof="BreadcrumbList" vocab="https://schema.org/">
				<a href="/" title="Главная страница">Главная</a> / <a href="/member/" title="Состав палаты">Состав палаты</a> / <?php echo get_the_title();?>
			</div>
	</div>
</section>


<section class="uk-section uk-section-medium">
	<div class="uk-container uk-container-xlarge" uk-scrollspy="cls: uk-animation-slide-bottom-medium;">
		<div class="uk-text-muted uk-text-small"><?=the_field('date_publish')?></div>
		<h2 class="h2 uk-margin-remove-top"><div><?php the_title(); ?></div></h2>
		<div class="uk-margin-medium-top">
			<?php
			the_content();
			?>
		</div>
	</div>
</section>



<?php
get_footer();
?>
