<?php

$group_name = $wp_query->query_vars['gruppa'];
$group_post = null;
if ( ! is_null($group_name)) {
    if ( $posts = get_posts( array( 
        'name' => $group_name, 
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => 1
    )));
    $group_post = $posts[0];
}
if ( ! is_null($group_post)) {

    // Если это одна группа
    ?>
    
        <small><a href="/rabochie-gruppy/">< Рабочие группы</a></small>
        <h2><?= $group_post->post_title ?></h2>
        <div class="group_content">
            <?= $group_post->post_content ?>
        </div>

    <?php
    
} else {
    
    // Если это страница групп
    $group_posts = get_posts (array( 
        'post_type' => 'post',
        'post_status' => 'publish',
        'cat' => 11
    ));

    foreach ($group_posts as $group_post) {
        ?>
            <div class="">
                <a href="<?the_permalink($group_post->ID)?>"><?=$group_post->post_title?></a>
            </div>
        <?php
    }

}

?>