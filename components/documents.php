
<?php

    $cat_slug = $wp_query->query_vars['doc_cat'];
    $doc_slug = $wp_query->query_vars['doc_name'];

    $cat_name = NULL;
    $posts = NULL;
    $doc_post = NULL;
    
    if (!is_null($cat_slug)) {
        
        $cat_name = get_category_by_slug($cat_slug)->name;
        $posts = get_posts(array(
            'category_name' => $cat_slug,
            'posts_per_page' => -1 
        ));

    }

    if (!is_null($doc_slug)) {
        
        $doc_post = get_posts(array(
            'category_name' => $documents,
            'name' => $doc_name,
            'posts_per_page' => -1 
        ))[0];
    }

?>


<!-- Если это категория -->

<?php if ($posts) { ?>

<h2><?=$cat_name?></h3>

<div class="uk-grid">
    
    <?php foreach($posts as $post) {
        $_file = get_field('file', $post->ID);
        $_link = $_file ? $_file : get_the_permalink($post->ID);
        $_thumb = get_the_post_thumbnail_url($post, 'thumbnail' );
        $_thumb = $_thumb ?: wp_get_attachment_image_src(11575, 'thumbnail' )[0];

        // $_thumb_html = $_thumb ? $_thumb : '<i class="fa fa-file-text" aria-hidden="true"></i>&nbsp;&nbsp;'; 
    ?>

    <div class="uk-width-1-1 uk-width-1-2@m uk-width-1-3@l uk-width-1-4@xl">
        <div class="uk-card">
            <div class="uk-card-wrap">
                <div class="card-img">
                  <img src="<?=$_thumb?>" uk-img>
                </div>
                <div class="uk-margin uk-h3"><a href="<?=$_link?>"><?=$post->post_title?></a></div>
            </div>
        </div>

        <?php } ?>
    
    </div>


<?php } else if ($doc_post) { ?>

<!-- Если это документ -->

<h3><?=$doc_post->post_title?></h3>

<div>
    <?=$doc_post->post_content?>
</div>
 

<?php } ?>



