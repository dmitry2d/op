<?php

$cat_slug = $wp_query->query_vars['pcouncil_cat'];
$doc_slug = $wp_query->query_vars['pcouncil_name'];

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
        'name' => $doc_slug,
        'posts_per_page' => -1 
    ))[0];
}

?>

<!-- Если это категория -->

<?php if ($posts) { ?>

    <h2><?=$cat_name?></h3>
    
    <div class="uk-grid">
        
        <?php foreach($posts as $post) {?>
            <div class="sozyv_link">
                <h3>
                    <i class="fa fa-address-book-o" aria-hidden="true"></i>
                    &nbsp;&nbsp;
                    <a href="<?the_permalink($post->ID)?>"><?=$post->post_title?></a>
                </h3>
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
    




