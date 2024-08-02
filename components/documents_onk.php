



<div class="uk-grid">

<?php 

    $posts_sorted = get_posts (array( 
        'post_type' => 'post',
        'cat' => 35,
        'orderby' => 'meta_value_num',
        'meta_key' => 'index',
        'order' => 'DESC',
        'meta_query'     => array(
            'relation' => 'AND',
            array(
                'key'     => 'index',
                'compare' => 'EXISTS',
            ),
            array(
                'key'     => 'index',
                'value' => '',
                'compare' => '!=',
            ),
        ),
    ));
    $posts_unsorted = get_posts(array( 
        'post_type' => 'post',
        'cat' => 35,
        'posts_per_page' => -1,
        'meta_query'     => array(
            'relation' => 'OR',
            array(
                'key'     => 'index',
                'compare' => 'NOT EXISTS',
            ),
            array(
                'key'     => 'index',
                'value' => '',
                'compare' => '=',
            ),
        ),
        'orderby' => 'DATE',
        'order' => 'DESC'

    ));
    $posts = array_merge($posts_sorted, $posts_unsorted);
    foreach($posts as $post) {

    
        $_link = get_field('file', $post->ID);
        $_thumb = get_the_post_thumbnail_url($post, 'thumbnail' );
        $_thumb = $_thumb ?: wp_get_attachment_image_src(11575, 'thumbnail' )[0];
    ?>

    <div class="uk-width-1-1 uk-width-1-2@m uk-width-1-3@l uk-width-1-4@xl">
        <div class="uk-card">
            <div class="uk-card-wrap">
                <div class="card-img">
                  <img src="<?=$_thumb?>" uk-img>
                </div>
                <div class="uk-margin"><a class="doc-link" href="<?=$_link?>"><?=$post->post_title?></a></div>
            </div>
        </div>
    </div>

    <?php } ?>

</div>