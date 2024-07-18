<?php
get_header();
?>

<?//
// Слайдер
//?>
<div id="main_slideshow" class="uk-position-relative">
  <div id="main_slider">
    <?php echo do_shortcode('[layerslider id="mainslider"]'); ?>
  </div>
  <?//
  // ПОС Баннер
  //?>
  <div id="pos_banner">
    <div class="uk-container uk-container-xlarge">
      <div class="uk-grid-medium" uk-grid uk-scrollspy="target: > div;cls: uk-animation-slide-bottom-medium;delay: 500;">
        <?php
        global $post;
        $myposts = get_posts([
          'numberposts' => 4,
          'post_type'   => 'banner',
          'order'       => 'ASC'
        ]);
        if( $myposts ){
          foreach( $myposts as $key => $post ){
            setup_postdata( $post );
            if(get_field('banner_format') == 'wide') {
              $banner_class = "uk-width-1-2@s";
            } else {
              $banner_class = "uk-width-1-2@s uk-width-1-4@l";
            }
            ?>
            <div class="uk-width-1-1 <?=$banner_class?>">
              <a href="<?=the_field('banner_url')?>" class="banner_img" style="background: url(<?=the_field('banner_img')?>) center center no-repeat;" title="<?=get_the_title()?>"></a>
            </div>
            <?php
          }
        } else {
          // Постов не найдено
        }
        wp_reset_postdata(); // Сбрасываем $post
        ?>
      </div>
    </div>
  </div>


<?//
// Новости
//?>
<div id="news" class="uk-section uk-section-medium uk-margin-large-top">
  <div class="uk-container uk-container-xlarge" uk-scrollspy="cls: uk-animation-slide-bottom-medium;">
    <div class="header_big uk-text-center">
      <div>Новости</div>
    </div>
    <div class="uk-margin-large" uk-scrollspy="target: > div; cls: uk-animation-slide-bottom-medium; delay: 100" uk-height-match="target: .uk-card > div;target: .uk-card-wrap;" uk-grid>
      <?php
      global $post;
      $myposts = get_posts([
        'numberposts' => 12,
        'post_type'   => 'novost',
        'meta_key' => 'date_publish',
        'orderby' =>'date_publish',
        'order' => 'DESC'
      ]);

      if( $myposts ){
        $show = 0;
        foreach( $myposts as $key => $post ){
          $show++;

          if (get_field('news_display') != 1 ) continue;
          if ($show > 8) break;
          setup_postdata( $post );
          $class = ($key == 0) ? 'active' : '';
          ?>
          <div class="uk-width-1-1 uk-width-1-2@m uk-width-1-3@l uk-width-1-4@xl">
            <div class="uk-card">
              <div class="uk-card-wrap">
                <div class="card-img"><a class="uk-text-small" href="<?=get_permalink();?>" title="Подробнее.."><img src="<?=the_post_thumbnail_url( 'thumbnail' );?>" uk-img></a></div>
                <div class="uk-margin-small uk-text-small uk-text-muted"><?=the_field('date_publish')?></div>
                <div class="uk-margin uk-h3"><?=get_the_title()?></div>
              </div>
              <div class=""><a class="uk-text-small" href="<?=get_permalink();?>">Подробнее</a></div>
            </div>
          </div>
          <?php
        }
      } else {
        // Постов не найдено
      }
      wp_reset_postdata(); // Сбрасываем $post
      ?>
    </div>
    <div class="uk-text-center">
      <a uk-scrollspy="cls: uk-animation-slide-bottom-medium; delay: 100" class="btn_fill_color" href="/novosty/" title="Смотреть все новости">Смотреть все</a>
    </div>
  </div>
</div>

<?/*
  НОРМАТИВНЫЕ ДОКУМЕНТЫ
*/?>
<div id="npa" class="uk-section uk-section-large">
    <div class="uk-container uk-container-xlarge" uk-scrollspy="cls: uk-animation-slide-bottom-medium;">
      <div uk-grid>
        <div class="uk-width-1-1 uk-width-1-2@m">
          <div class="header_big">Нормативные<br> правовые акты</div>
        </div>
        <div class="uk-width-1-1 uk-width-1-2@m">
          <div class="uk-flex uk-flex-middle" uk-grid>
            <div class="uk-width-auto"><img src="/wp-content/themes/oac/images/pdf.webp" width="50px"></div>
            <div class="uk-width-expand">Распоряжение от 21 ноября 2016 г. N 342 -рз О создании государственного областного казенного учреждения "Общественно-аналитический центр"</div>
          </div>
          <div class="uk-flex uk-flex-middle" uk-grid>
            <div class="uk-width-auto"><img src="/wp-content/themes/oac/images/pdf.webp" width="50px"></div>
            <div class="uk-width-expand">Федеральный закон от 21 июля 2014 года № 212-ФЗ "Об основах общественного контроля"</div>
          </div>
          <div class="uk-text-center uk-margin-large-top">
            <a class="btn_fill_white" href="/dokumenty/">Смотреть все</a>
          </div>
        </div>
      </div>
    </div>
</div>

<?php
  get_footer();
?>
