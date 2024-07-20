<?php

$sozyv_name = $wp_query->query_vars['sozyv'];
$sozyv_post = null;
if ( ! is_null($sozyv_name)) {
    if ( $posts = get_posts( array( 
        'name' => $sozyv_name, 
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => 1
    )));
    $sozyv_post = $posts[0];
}
if ( ! is_null($sozyv_post)) {

    // Если это одна группа
    ?>
    
        <small><a href="/rabochie-gruppy/">< Рабочие группы</a></small>
        <h2><?= $sozyv_post->post_title ?></h2>
        <div class="sozyv_content">
            <?= $sozyv_post->post_content ?>
        </div>

    <?php
    
} else {
    
    // Если это страница созывов
    $sozyv_posts = get_posts (array( 
        'post_type' => 'post',
        'post_status' => 'publish',
        'cat' => 9
    ));

    foreach ($sozyv_posts as $sozyv_post) {
        ?>
            <div class="">
                <a href="<?the_permalink($sozyv_post->ID)?>"><?=$sozyv_post->post_title?></a>
            </div>
        <?php
    }

}

?>