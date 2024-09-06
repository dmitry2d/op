
<!-- Страница "состав ОНК" -->

<h3>Состав общественной наблюдательной комиссии по общественному контролю за обеспечением прав человека в местах принудительного содержания и содействию лицам, находящимся в местах принудительного содержания Новгородской области, VI созыва (март 2023 г.  -  март 2026 г.)</h3>

<br>

<div class="uk-grid">

<?php 

$page_id = 11814;
$members = get_field ('members', $page_id);

if (! is_null($members)) foreach ($members as $member) {
    ?>
    <div class="sozyv_member uk-width-1-1@s uk-width-1-2@m">
        <div class="sozyv_member__img">
            <a href="<?= get_the_post_thumbnail_url($member, 'full')?>" data-lightbox="gallery">
                <?= get_the_post_thumbnail($member)?>
            </a>
        </div>
        <div class="sozyv_member__data">
            <h3>
                    <?=$member->post_title?>
                
            </h3>
            <small><?=get_field('dolzhnost',$member->ID)?></small>
        </div>
    </div>
    <?php
}

?>

</div>