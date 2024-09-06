



<div class="uk-grid">

<?php 

    $posts_sorted = get_posts (array( 
        'post_type' => 'post',
        'cat' => 35,
        'orderby' => 'meta_value_num',
        'meta_key' => 'index',
        'order' => 'DESC',
        'posts_per_page' => -1
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
        ),
        'orderby' => 'DATE',
        'order' => 'DESC'

    ));
    $posts = array_merge($posts_sorted, $posts_unsorted);
    foreach($posts as $post) {

    
        $_link = get_field('file', $post->ID);
        // $_thumb = get_the_post_thumbnail_url($post, 'thumbnail' );
        // $_thumb = $_thumb ?: wp_get_attachment_image_src(11575, 'thumbnail' )[0];
    ?>

    <div class="uk-width-1-2@l">
        <div class="uk-card">
            <div class="uk-card-wrap">
                 <div class="uk-margin"><a  class="doc-link" href="<?=$_link?>"><?=$post->post_title?></a></div>
            </div>
        </div>
    </div>

    <?php } ?>

</div>