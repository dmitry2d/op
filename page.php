<?php
/**
* The template for displaying all single posts
*/

get_header();
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

	<div class="header_big uk-margin-large-top">
		<div class="uk-container uk-container-xlarge">
			<div><?=get_the_title()?></div>
		</div>
	</div>


	<section class="uk-section uk-section-medium">
		<div class="uk-container uk-container-xlarge" uk-scrollspy="cls: uk-animation-slide-bottom-medium;">

			<div class="uk-grid">

				<?php 
					if( is_page( 8456 ) ):
				?>
					<div class="uk-width-1-4@m uk-width-1-6@l">


					<?php
						wp_nav_menu(
							array(
								'menu' => '10'
							)
						);
					?>


					</div>
				<?php 
					endif;
				?>



				<div class="uk-width-expand">

				<div class="row">
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<?php the_content(); ?>
					</article>
				</div>

				</div>
			</div>
		</div>
	</section>
<?php endwhile; ?>


<?php get_footer(); ?>
