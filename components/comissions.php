<?php

$comission_name = $wp_query->query_vars['comission'];
$comission_post = null;
if ( ! is_null($comission_name)) {
    if ( $posts = get_posts( array( 
        'name' => $comission_name, 
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => 1
    )));
    $comission_post = $posts[0];
}
if ( ! is_null($comission_post)) {

    // Если это одна группа
    ?>
    
        <small><a href="/rabochie-gruppy/">< Рабочие группы</a></small>
        <h2><?= $comission_post->post_title ?></h2>
        <div class="comission_content">
            <?= $comission_post->post_content ?>
        </div>

    <?php
    
} else {
    
    // Если это страница созывов
    $comission_posts = get_posts (array( 
        'post_type' => 'post',
        'post_status' => 'publish',
        'cat' => 9
    ));

    foreach ($comission_posts as $comission_post) {
        ?>
            <div class="">
                <a href="<?the_permalink($comission_post->ID)?>"><?=$comission_post->post_title?></a>
            </div>
        <?php
    }

}

?>