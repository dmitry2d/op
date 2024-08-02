<?php

$sozyv_name = $wp_query->query_vars['sozyv'];
$member_name = $wp_query->query_vars['memb'];
$sozyv_post = null;
$member_post = null;

if ( ! is_null($sozyv_name)) {
    if ( $posts = get_posts( array( 
        'name' => $sozyv_name, 
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => 1
    )));
    $sozyv_post = $posts[0];
}
if ( ! is_null($member_name)) {
    if ( $posts = get_posts( array( 
        'name' => $member_name, 
        'post_type' => 'member',
        'post_status' => 'publish',
        'posts_per_page' => 1
    )));
    $member_post = $posts[0];
}
if ( ! is_null($sozyv_post)) {
    
    // Если это один созыв
    
    $years = get_field('gody',$sozyv_post->ID);

    $sozyv_members = get_field('members', $sozyv_post->ID);

    ?>
        <h2><?= $sozyv_post->post_title ?></h2>
        <div class="sozyv_content">
            <?= $sozyv_post->post_content ?>
        </div>
        <div class="sozyv_members uk-grid">
        <?php
            foreach ($sozyv_members as $sozyv_member) {
                ?>
                    <div class="sozyv_member uk-width-1-1@s uk-width-1-2@m">
                        <div class="sozyv_member__img">
                            <?= get_the_post_thumbnail($sozyv_member)?>
                        </div>
                        <div class="sozyv_member__data">
                            <h3>
                                <a href="<?=the_permalink($sozyv_member->ID)?>">
                                    <?=$sozyv_member->post_title?>
                                </a>
                            </h3>
                            <small><?=get_field('dolzhnost',$sozyv_member->ID)?></small>
                        </div>
                    </div>
                <?php
            }
        ?>
        </div>
    <?php
    
} else if ( ! is_null($member_post)) {

    $sozyv_post = NULL;
    if ($sozyv_posts = get_posts (array( 
        'post_type' => 'post',
        'post_status' => 'publish',
        'cat' => 9,
        'meta_key' => 'gody',
        'meta_value' => get_field('sozyv',$member_post->ID)
    ))) $sozyv_post = $sozyv_posts[0];

    $group_posts = get_posts (array( 
        'post_type' => 'post',
        'post_status' => 'publish',
        'cat' => 11,
        'meta_query' => array(
            array(
                'key' => 'sostav',
                'value' => $member_post->ID,
                'compare' => 'LIKE'
            )
        )
    ));
    $comission_posts = get_posts (array( 
        'post_type' => 'post',
        'post_status' => 'publish',
        'cat' => 12,
        'meta_query' => array(
            array(
                'key' => 'sostav',
                'value' => $member_post->ID,
                'compare' => 'LIKE'
            )
        )
    ));

?>
    
    <h2>
        <?=$member_post->post_title?>
    </h2>
    <?php if (! is_null($sozyv_post)) { ?>
        <div>
            <a href="<?=get_the_permalink($sozyv_post->ID)?>">
                <i class="fa fa-angle-double-left" aria-hidden="true"></i>&nbsp;<?=$sozyv_post->post_title?>
            </a>
        </div>
    <?php } ?>
        <br>
    <div class="sozyv_member">
        <div class="sozyv_member__img">
            <?= get_the_post_thumbnail($member_post)?>
        </div>
        <div class="sozyv_member__data">
            <b><small><?=get_field('dolzhnost',$member_post->ID)?></small></b>
            <p>
                <?=apply_filters( 'the_content', $member_post->post_content )?>
            </p>

            
            <?php 
                if ( ! is_null($group_posts[0])) {
            ?>
            <h3>Состоит в рабочих группах:</h3>
            <?php 
                foreach ($group_posts as $group_post) {
            ?>
                <div>
                    <i class="fa fa-cogs" aria-hidden="true"></i>&nbsp;&nbsp;<a href="<?=get_the_permalink($group_post)?>"><?=$group_post->post_title?></a>
                </div>
            <?php
                }
            ?>
            <?php
                }
            ?>
            
            <?php 
                if ( ! is_null($comission_posts[0])) {
            ?>
            <h3>Входит в состав комиссий:</h3>
            <?php 
                foreach ($comission_posts as $comission_post) {
            ?>
                <div>
                    <i class="fa fa-cogs" aria-hidden="true"></i>&nbsp;&nbsp;<a href="<?=get_the_permalink($comission_post)?>"><?=$comission_post->post_title?></a>
                </div>
            <?php
                }
            ?>
            <?php
                }
            ?>
            
        </div>
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
            <div class="sozyv_link">
                <h3>
                    <i class="fa fa-address-book-o" aria-hidden="true"></i>
                    &nbsp;&nbsp;
                    <a href="<?the_permalink($sozyv_post->ID)?>"><?=$sozyv_post->post_title?></a>
                </h3>
            </div>
        <?php
    }

}

?>