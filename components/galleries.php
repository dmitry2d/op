
<!-- Страница "галереи" -->

<?php

$gal_name = $wp_query->query_vars['gallery_name'];
$gal_post = null;

if ($gal_name) {
    
    if ( ! is_null($gal_name)) {
        if ( $posts = get_posts( array( 
            'name' => $gal_name, 
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => 1
        )));
        $gal_post = $posts[0];
    }
    
    // var_dump($gal_post);
    $gallerys = get_field('images', $gal_post->ID);


    
    ?>
    
    <h2><a href="/galerei/">← Все галереи </a> / <?=$gal_post->post_title?></h2>
    <br>
    <div class="uk-grid">
        
    <?php
    if (! is_null($gallerys)) foreach ($gallerys as $gallery) {
    ?>

        <div class="uk-width-1-2 uk-width-1-3@l uk-width-1-4@xl uk-margin-small">
        <!-- <div class="sozyv_member uk-width-1-1@s uk-width-1-2@m uk-width-1-3@l uk-width-1-4@xl"> -->
            <!-- <div class="sozyv_member__img"> -->
            <!-- <div class=""> -->
                <a href="<?= $gallery['url']?>" data-lightbox="gallery">
                    <img src="<?= $gallery['sizes']['thumbnail'] ?>" alt="">
                </a>
            <!-- </div> -->
            <!-- <div class="sozyv_member__data"> -->
                <!-- <h4> -->
                    <?= '' //$gallery['title'] ?>
                <!-- </h4> -->
                <!-- <div> -->
                    <!-- <small><?= '' // $gallery['caption'] ?></small> -->
                <!-- </div> -->
                <!-- <small class="uk-text-small" style="font-size: 10px;">
                    <?= '' // $gallery['date'] ?>
                </small> -->
            <!-- </div> -->
        </div>
        <?php
    }
    ?> </div> <?php
}

else {

?> <div class="uk-grid"> <?php


$posts_sorted = get_posts (array( 
    'post_type' => 'post',
    'cat' => 39,
    'orderby' => 'meta_value_num',
    'meta_key' => 'index',
    'order' => 'ASC',
    'posts_per_page' => -1
));
$posts_unsorted = get_posts(array( 
    'post_type' => 'post',
    'cat' => 39,
    'posts_per_page' => -1,
    'meta_query'     => array(
        'relation' => 'OR',
        array(
            'key'     => 'index',
            'compare' => 'NOT EXISTS',
        ),
    ),
    'orderby' => 'DATE',
    'order' => 'DESC'

));
$posts = array_merge($posts_sorted, $posts_unsorted);


// $posts =  get_posts (array( 
//     'post_type' => 'post',
//     'post_status' => 'publish',
//     'cat' => 39,
//     'posts_per_page' => -1
// ));

foreach ($posts as $post) {
    $image = get_field('images', $post->ID)[0];
    ?>
        <div class="sozyv_member uk-width-1-1@s uk-width-1-2@m uk-width-1-3@l">
            <div class="sozyv_member__img">
                <img src="<?= $image['sizes']['thumbnail'] ?>" alt="">
            </div>
            <div class="sozyv_member__data">
                <h3>
                    <a href="<?=the_permalink($post->ID)?>">
                        <?= $post->post_title ?>
                    </a>
                </h3>
                <small>Изображений: <?=count(get_field('images', $post->ID))?></small>
            </div>
        </div>

    <?php
}

// var_dump($posts);

?> </div> <?php

}

?>

