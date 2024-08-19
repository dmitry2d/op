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
    
        <!-- <small><a href="/rabochie-gruppy/">< Рабочие группы</a></small> -->
        <h2><?= $group_post->post_title ?></h2>
        <div class="uk-grid">
            <div class="uk-width-2-5@l">                
                <h3>Руководитель:</h3>
                <?php 
                    $members = get_field('rukovoditel', $group_post);
                    if (! is_null($members)) foreach ($members as $member) {
                        ?>

                        <div class="">
                            <i class="fa fa-user" aria-hidden="true"></i>&nbsp;&nbsp;<a href="<?=get_the_permalink(($member->ID))?>"><?=$member->post_title?></a>
                        </div>

                        <?php
                    }
                ?>
                <h3>Состав:</h3>
                <?php 
                    $members = get_field('sostav', $group_post);
                    if (! is_null($members)) foreach ($members as $member) {
                        ?>

                        <div class="">
                            <i class="fa fa-user" aria-hidden="true"></i>&nbsp;&nbsp;<a href="<?=get_the_permalink(($member->ID))?>"><?=$member->post_title?></a>
                        </div>

                        <?php
                    }
                ?>

            </div>
            <div class="uk-width-3-5@l">
                <p>
                    <?= $group_post->post_content ?>
                </p>
            </div>
        </div>

    <?php
    
} else {
    
    // Если это страница групп
    $group_posts = get_posts (array( 
        'post_type' => 'post',
        'post_status' => 'publish',
        'cat' => 11,
        'posts_per_page' => -1,
        'orderby' => 'meta_value_num',
        'meta_key' => 'index',
        'order' => 'ASC'
    ));

    foreach ($group_posts as $group_post) {
        ?>
            <div class="sozyv_link">
                <h3>
                    <i class="fa fa-address-book-o" aria-hidden="true" style="margin-top: 10px"></i>
                    &nbsp;&nbsp;
                    <a href="<?the_permalink($group_post->ID)?>"><?=$group_post->post_title?></a>
                </h3>
            </div>
        <?php
    }

}

?>