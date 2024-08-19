<?php

$cat_slug = $wp_query->query_vars['pcouncil_cat'];
$doc_slug = $wp_query->query_vars['pcouncil_name'];

$cat_name = NULL;
$posts = NULL;
$doc_post = NULL;

if (!is_null($cat_slug)) {
    
    $cat_name = get_category_by_slug($cat_slug)->name;
    $posts_unsorted = get_posts(array(
        'category_name' => $cat_slug,
        'posts_per_page' => -1,
        'meta_query'     => array(
            'relation' => 'OR',
            array(
                'key'     => 'index',
                'compare' => 'NOT EXISTS',
            ),
            // array(
            //     'key'     => 'index',
            //     'value' => '',
            //     'compare' => '=',
            // ),
        ),
        'orderby' => 'title',
        'order' => 'ASC'
    ));

    $posts_sorted = get_posts(array(
        'category_name' => $cat_slug,
        'posts_per_page' => -1,
        'orderby' => 'meta_value_num',
        'meta_key' => 'index',
        'order' => 'ASC',
    ));

    $posts = array_merge($posts_sorted, $posts_unsorted);

}

if (!is_null($doc_slug)) {
    
    $doc_post = get_posts(array(
        'category_name' => $documents,
        'name' => $doc_slug,
        'posts_per_page' => -1 
    ))[0];
}

?>

<!-- Если это категория -->

<?php if ($posts) { ?>

    <h2><?=$cat_name?></h2>
    
    <!-- <div class="uk-grid"> -->
    <div class="uk-column-1-2@l">
        
        <?php foreach($posts as $post) {?>
            <div class="sozyv_link ">
            <!-- <div class="sozyv_link uk-width-1-2@l"> -->
                <div class="uk-margin-small-bottom">
                    <div class="uk-grid">
                        <div class="">
                            <i class="fa fa-address-book-o" aria-hidden="true" style="margin-top: 10px"></i>
                        </div>
                        <div class="uk-width-expand uk-margin-small-bottom">
                            <h3>
                                <a href="<?the_permalink($post->ID)?>"><?=$post->post_title?></a>
                            </h3>
                        </div>                    
                    </div>
                </div>
            </div>
    
        <?php } ?>
        
    </div>
    
    
    <?php } else if ($doc_post) { ?>
    
    <!-- Если это документ -->
    
    <h2><?=$doc_post->post_title?></h2>
    
    <div>
        <?=$doc_post->post_content?>
    </div>
     
    
    <?php } ?>
    




