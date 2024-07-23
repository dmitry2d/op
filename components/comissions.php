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

    // Если это одна комиссия
    ?>
    
        <!-- <small><a href="/rabochie-gruppy/">< Рабочие группы</a></small> -->
        <h2><?= $comission_post->post_title ?></h2>
        <div class="uk-grid">
            <div class="uk-width-2-5@l">
                <h3>Председатель:</h3>
                <?php 
                    $members = get_field('predsedatel', $comission_post);
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
                    $members = get_field('sostav', $comission_post);
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
                    <?= $comission_post->post_content ?>
                </p>
            </div>
        </div>

    <?php
    
} else {
    
    // Если это страница комиссий
    $comission_posts = get_posts (array( 
        'post_type' => 'post',
        'post_status' => 'publish',
        'cat' => 12
    ));

    foreach ($comission_posts as $comission_post) {
        ?>
            <div class="sozyv_link">
                <h3>
                    <i class="fa fa-address-book-o" aria-hidden="true"></i>
                    &nbsp;&nbsp;
                    <a href="<?the_permalink($comission_post->ID)?>"><?=$comission_post->post_title?></a>
                </h3>
            </div>
        <?php
    }

}

?>