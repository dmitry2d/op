
<?php

    $cat_slug = $wp_query->query_vars['doc_cat'];
    $doc_slug = $wp_query->query_vars['doc_name'];

    $cat_name = NULL;
    $posts = NULL;
    $doc_post = NULL;
    
    if (!is_null($cat_slug)) {
        
        $cat_name = get_category_by_slug($cat_slug)->name;
        $posts_sorted = get_posts(array(
            'category_name' => $cat_slug,
            'posts_per_page' => -1,
            'orderby' => 'meta_value_num',
            'meta_key' => 'index',
            'order' => 'ASC',
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
            'category_name' => $cat_slug,
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

<?php if ($posts) {
    
    $list_view = !!! get_the_post_thumbnail_url($posts[0]);
?>

<h2><?=$cat_name?></h3>

<?php if($list_view) { ?>
    <div class="uk-column-1-2@l">
<?php } else {?>
    <div class="uk-grid">
<?php } ?>
    
    
    <?php foreach($posts as $post) {
        
        $_file = get_field('file', $post->ID);
        $_list = is_null($_file);
        $_link = $_file ? $_file : get_the_permalink($post->ID);
        $_thumb = get_the_post_thumbnail_url($post, 'thumbnail' );
        $_thumb = $_thumb ?: wp_get_attachment_image_src(11575, 'thumbnail' )[0];
    
        if ($list_view == false) {

    ?>

    <div class="">
    <!-- <div class="uk-width-1-1 uk-width-1-2@m uk-width-1-3@l uk-width-1-4@xl"> -->
        <div class="uk-card">
            <div class="uk-card-wrap">
                <div class="card-img">
                  <img src="<?=$_thumb?>" uk-img>
                </div>
                <div class="uk-margin"><a class="doc-link" href="<?=$_link?>"><?=$post->post_title?></a></div>
            </div>
        </div>
    </div>

        <?php } else { ?>

    <div class="">
    <!-- <div class="uk-width-1-2@l"> -->
        <div class="uk-card">
            <div class="uk-card-wrap">
                 <div class="uk-margin"><a  class="doc-link" href="<?=$_link?>"><?=$post->post_title?></a></div>
            </div>
        </div>
    </div>

        <?php } ?>

    <?php } ?>

</div>


<?php } else if ($doc_post) { ?>

<!-- Если это документ -->

<h3><?=$doc_post->post_title?></h3>

<div>
    <?=$doc_post->post_content?>
</div>
 

<?php } ?>



