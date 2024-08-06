<?php

$news_name = $wp_query->query_vars['onk_news_name'];
$news_post = null;

if ($news_name) {

    if ( ! is_null($news_name)) {
        if ( $posts = get_posts( array( 
            'name' => $news_name, 
            'post_type' => 'post',
            'post_status' => 'publish',
            // 'cat' => 38,
            'posts_per_page' => 1
        )));
        $news_post = $posts[0];
    }

// var_dump($news_post->post_content);

?>



    <div class="uk-text-muted uk-text-small"><?=$news_post->post_date?></div>
    <h2 class="h2"><div><?= $news_post->post_title ?></div></h2>
    <div class="">
        <?= $news_post->post_content;?>
    </div>

<?php
    
} else {

    $wp_query = null;
    $wp_query = new WP_Query();
    $wp_query -> query(array (
        'post_type' => 'post',
        'cat' => 38,
        'paged' => $paged,
        'orderby' => 'date',
        'order' => 'ASC'
        )
    );

    ?>

    <div class="uk-grid">

    <?php
    
    while ($wp_query->have_posts()) : $wp_query->the_post();
        ?>
    
        <div class="uk-width-1-1 uk-width-1-2@m uk-width-1-3@l uk-width-1-4@xl">
            <div class="uk-card">
                <div class="uk-card-wrap">
                  <div class="card-img">
                    <a class="uk-text-small" href="<?=get_permalink();?>" title="Подробнее..">
                      <img src="<?=the_post_thumbnail_url( 'thumbnail' );?>" uk-img>
                    </a>
                  </div>
                  <div class="uk-margin uk-text-small"><?= the_field('date_publish')?></div>
                  <div class="uk-margin uk-h3"><?=get_the_title()?></div>
                </div>
                <div class=""><a class="uk-text-small" href="<?=get_permalink();?>">Подробнее</a></div>
            </div>
        </div>
    
        <?php
    endwhile;
    
    ?>
    
    </div>

    <div class="paginations uk-margin-xlarge uk-flex uk-flex-center">
        <?php my_pagination(); ?>
    </div>
    
<?php
        $wp_query = null;
    }
?>

