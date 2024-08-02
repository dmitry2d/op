<?php

switch ($post->ID) {

    // Страница "рабочие группы"
    case 8483:
        get_template_part('components/work_groups');
    break;

    // Страница "Состав палаты"
    case 11388:
        get_template_part('components/sostav_op');
    break;

    // Страница "Совет палаты"
    case 8484:
        get_template_part('components/council');
    break;

    // Страница "Комиссии"
    case 8485:
        get_template_part('components/comissions');
    break;

    // Страница "Документы"
    case 8489:
        get_template_part('components/documents');
    break;

    // Страница "Документы ОНК"
    case 11819:
        get_template_part('components/documents_onk');
    break;

    // Страница "Общественные советы"
    case 11576:
        get_template_part('components/public_council');
    break;

    // Страница "Рейтинги"
    case 11786:
        get_template_part('components/raitings');
    break;
        
    // Страница по умолчанию
    default:
    ?>
        <div class="row">
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <?php the_content(); ?>
            </article>
        </div>
    <?php
    break;
}

?>
				