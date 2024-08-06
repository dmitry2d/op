
<!-- Страница "совет" -->


<div class="uk-grid">

<?php 

$page_id = 11814;
$members = get_field ('members', $page_id);

if (! is_null($members)) foreach ($members as $member) {
    ?>
    <div class="sozyv_member uk-width-1-1@s uk-width-1-2@m">
        <div class="sozyv_member__img">
            <?= get_the_post_thumbnail($member)?>
        </div>
        <div class="sozyv_member__data">
            <h3>
                <a href="<?=the_permalink($member->ID)?>">
                    <?=$member->post_title?>
                </a>
            </h3>
            <small><?=get_field('dolzhnost',$member->ID)?></small>
        </div>
    </div>
    <?php
}

?>

</div>