
<?php

    $cat_slug = $wp_query->query_vars['doc_cat'];
    $cat_parent_slug = $wp_query->query_vars['cat_parent'];
    $doc_slug = $wp_query->query_vars['doc_name'];

    $cat_name = NULL;
    $cat_parent_name = NULL;
    $posts = NULL;
    $doc_post = NULL;
    
    if (!is_null($cat_slug)) {
        

        $cat_OBJ = get_category_by_slug($cat_slug);
        $cat_name = $cat_OBJ->name;
        $posts_sorted = get_posts(array(
            'category_name' => $cat_slug,
            'posts_per_page' => -1,
            'orderby' => 'meta_value_num',
            'meta_key' => 'index',
            'order' => 'ASC',
            // 'meta_query'     => array(
            //     'relation' => 'AND',
            //     array(
            //         'key'     => 'index',
            //         'compare' => 'EXISTS',
            //     ),
            //     array(
            //         'key'     => 'index',
            //         'value' => '',
            //         'compare' => '!=',
            //     ),
            // ),
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
                // array(
                //     'key'     => 'index',
                //     'value' => '',
                //     'compare' => '=',
                // ),
            ),
            'orderby' => 'DATE',
            'order' => 'DESC'

        ));
        $posts = array_merge($posts_sorted, $posts_unsorted);

        // Category subs
        // $args = array('child_of' => 17);
        $sub_categories = get_categories(array('child_of' => $cat_OBJ->term_id));
        // echo '<pre>';
        // var_dump($sub_categories);
        // echo '</pre>';

    }


    if (!is_null($doc_slug)) {
        
        $doc_post = get_posts(array(
            'category_name' => $documents,
            'name' => $doc_name,
            'posts_per_page' => -1 
        ))[0];
    }


    if (!is_null($cat_parent_slug)) {
        $cat_parent_OBJ = get_category_by_slug($cat_parent_slug);
        $cat_parent_name = $cat_parent_OBJ->name;
    }

?>


<!-- Если это категория -->

<?php if ($posts) {
    
    $list_view = !!! get_the_post_thumbnail_url($posts[0]);
?>

<h2>
    <?php if (!is_null($cat_parent_name)) {?>
        <a href="../">
            <?=$cat_parent_name?>
        </a>
        /
    <?php }?>
    <?=$cat_name?>
</h3>


<!-- Подкатегории -->
<?php foreach ($sub_categories as $sub_cat) { ?>

    <div class="">
        <h3>
            <i class="fa fa-folder-o"></i>&nbsp;&nbsp;<a href="./<?=$sub_cat->slug?>" class="">
                <?= $sub_cat->name ?>
            </a>
        </h3>
    </div>

<?php } ?>
<!-- // Подкатегории -->


<?php if($list_view) { ?>
    <div class="">
    <!-- <div class="uk-column-1-2@l"> -->
<?php } else {?>
    <div class="uk-grid">
<?php } ?>
    
<?php 


    if (count($sub_categories) == 0) { 
        
        foreach($posts as $post) {
        
        $_file = get_field('file', $post->ID);
        $_list = is_null($_file);
        $_link = $_file ? $_file : get_the_permalink($post->ID);
        $_thumb = get_the_post_thumbnail_url($post, 'post-thumbnail' );
        $_thumb = $_thumb ?: wp_get_attachment_image_src(11575, 'post-thumbnail' )[0];
    
        if ($list_view == false) {

    ?>

    <div class="">
    <!-- <div class="uk-width-1-1 uk-width-1-2@m uk-width-1-3@l uk-width-1-4@xl"> -->
        <div class="uk-card">
            <div class="uk-card-wrap">
                <div class="card-img">
                <a class="" href="<?=$_link?>"><img src="<?=$_thumb?>" uk-img></a>
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
                 <div class="uk-margin"><a class="doc-link" href="<?=$_link?>"><?=$post->post_title?></a></div>
            </div>
        </div>
    </div>

        <?php } ?>

    <?php } ?>

    <?php  } ?>

</div>


<?php } else if ($doc_post) { ?>

<!-- Если это документ -->


<h3><?=$doc_post->post_title?></h3>

<div>
    <?=$doc_post->post_content?>
</div>

<!-- Если в документе есть файлы -->

<?php
$_files = get_field('files', $doc_post->ID);
if ($_files) {

    ?>

    <!-- <h3 class="">Файлы</h3> -->

    <?php

    foreach ($_files as $_f) {
        $_f_data = $_f['files_item'];
        ?>


        <div class="">
            <div class="uk-card">
                <div class="uk-card-wrap">
                    <div class="uk-margin"><a class="doc-link" href="<?=$_f_data['url']?>"><?=$_f_data['title']?></a></div>
                </div>
            </div>
        </div>          

        <?php
    }

}
?>

 

<?php } ?>



