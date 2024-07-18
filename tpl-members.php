<?php
/*
Template Name: Шаблон членов палаты
*/
?>
<? get_header(); ?>

<section class="breadcrumbs_wrapper">
	<div class="uk-container uk-container-xlarge">
		<div class="breadcrumbs uk-text-small" typeof="BreadcrumbList" vocab="https://schema.org/">
			<a href="/" title="Главная страница">Главная</a> / Новости
		</div>
	</div>
</section>

<div class="header_big uk-margin-large">
	<div class="uk-container uk-container-xlarge">
		<div>Новости</div>
	</div>
</div>

<div id="news">
  <div class="uk-container uk-container-xlarge" uk-scrollspy="cls: uk-animation-slide-bottom-medium;">
    <div uk-scrollspy="target: > div; cls: uk-animation-slide-bottom-medium; delay: 50" uk-height-match="target: .uk-card > div;target: .uk-card-wrap;" uk-grid>


<?php $args = array(
  'show_option_all'    => '',
  'show_option_none'   => __('No categories'),
  'orderby'            => 'name',
  'order'              => 'ASC',
  'style'              => 'list',
  'show_count'         => 1,
  'hide_empty'         => 0,
  'use_desc_for_title' => 0,
  'child_of'           => 0,
  'feed'               => '',
  'feed_type'          => '',
  'feed_image'         => '',
  'exclude'            => '',
  'exclude_tree'       => '',
  'include'            => '',
  'hierarchical'       => true,
  'title_li'           => __( 'Categories' ),
  'number'             => NULL,
  'echo'               => 1,
  'depth'              => 0,
  'current_category'   => 0,
  'pad_counts'         => 0,
  'taxonomy'           => 'category',
  'walker'             => 'Walker_Category',
  'hide_title_if_empty' => false,
  'separator'          => '<br />',
);

echo '<ul>';
  wp_list_categories( $args );
echo '</ul>'; ?>      
      <?php


			$temp = $wp_query;
      $wp_query = null;
      $wp_query = new WP_Query();

      $wp_query->query('post_type=member'.'&paged='.$paged);
      while ($wp_query->have_posts()) : $wp_query->the_post();
      	$excerpt_reviews = get_the_excerpt();
      	?>
      <div class="uk-width-1-1 uk-width-1-2@m uk-width-1-3@l uk-width-1-4@xl">
        <div class="uk-card">
            <div class="uk-card-wrap">
              <div class="card-img"><a class="uk-text-small" href="<?=get_permalink();?>" title="Подробнее.."><img src="<?=the_post_thumbnail_url( 'thumbnail' );?>" uk-img></a></div>
              <div class="uk-margin uk-text-small"><?=the_field('date_publish')?></div>
              <div class="uk-margin uk-h3"><?=get_the_title()?></div>
            </div>
            <div class=""><a class="uk-text-small" href="<?=get_permalink();?>">Подробнее</a></div>
        </div>
      </div>
      <?php endwhile;?>
    </div>

    <div class="paginations uk-margin-xlarge uk-flex uk-flex-center">
      <?php my_pagination(); ?>
    </div>

    <?php
    $wp_query = null;
    $wp_query = $temp;
    ?>

  </div>
</div>

<?php get_footer(); ?>
