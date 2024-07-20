<?php
/**
* The template for displaying all single posts
*/

get_header();

$no_title = (
	! is_null($wp_query->query_vars['gruppa'])
);

?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	<section class="breadcrumbs_wrapper">
		<div class="uk-container uk-container-xlarge">
			<div class="breadcrumbs uk-text-small" typeof="BreadcrumbList" vocab="https://schema.org/">
				<?php
				if(function_exists('bcn_display'))
				{
					bcn_display();
				}?>
			</div>
		</div>
	</section>

	<?php if (!$no_title) { ?>
	<div class="header_big uk-margin-large-top">
		<div class="uk-container uk-container-xlarge">
			<div><?= get_the_title(); ?></div>
		</div>
	</div>
	<?php } ?>

	<section class="uk-section uk-section-medium">
		<div class="uk-container uk-container-xlarge" uk-scrollspy="cls: uk-animation-slide-bottom-medium;">

			<div class="uk-grid">

				<!-- Левая колонка -->

				<?php get_template_part('components/left_column'); ?>
				
				<!-- / Левая колонка -->
				
				<div class="uk-width-expand">
					
				<!-- Контент -->
					
				<?php get_template_part('components/page_content'); ?>
				
				<!-- / Контент -->
				
				</div>
			</div>
		</div>
	</section>
<?php endwhile; ?>


<?php get_footer(); ?>
