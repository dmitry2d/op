
    <?php 

    switch ($post->ID) {

        
        // Страница "о палате"
        case 8456:
        // Страница "рабочие группы"
        case 8483:
        // Страница "совет палаты"
        case 8484:
        // Страница "комиссии"
        case 8485:
        // Страница "состав палаты"
        case 11388:
            ?>
                <div class="uk-width-1-3@m uk-width-1-4@l left-column">
                    <?php
                        wp_nav_menu(array(
                            'menu' => '10',
                            'menu_class' => 'left-column-menu',
                        ));
                    ?>
                </div>
            <?php
        break;
        // Страница "документы"
        case 8489:
            ?>
                <div class="uk-width-1-3@m uk-width-1-4@l left-column">
                    <?php
                        wp_nav_menu(array(
                            'menu' => '15',
                            'menu_class' => 'left-column-menu',
                        ));
                    ?>
                </div>
            <?php 
        break;
        // Страница "общественное наблюдение"
        case 11619:
        case 11769:
        case 11771:
        case 11773:
        case 11775:
        case 8486:
            ?>
                <div class="uk-width-1-3@m uk-width-1-4@l left-column">
                    <?php
                        wp_nav_menu(array(
                            'menu' => '29',
                            'menu_class' => 'left-column-menu',
                        ));
                    ?>
                </div>
            <?php 
        break;
        // Страница "общественные советы"
        case  11576:
            ?>
                <div class="uk-width-1-3@m uk-width-1-4@l left-column">
                    <?php
                        wp_nav_menu(array(
                            'menu' => '28',
                            'menu_class' => 'left-column-menu',
                        ));
                    ?>
                </div>
            <?php 
        break;
        // Страница "Рейтинги"
        case  11786:
            ?>
                <div class="uk-width-1-3@m uk-width-1-4@l left-column">
                    <?php
                        wp_nav_menu(array(
                            'menu' => '34',
                            'menu_class' => 'left-column-menu',
                        ));
                    ?>
                </div>
            <?php 
        break;

        // Страница "ОНК"
        case  11819:
            ?>
                <div class="uk-width-1-3@m uk-width-1-4@l left-column">
                    <?php
                        wp_nav_menu(array(
                            'menu' => '36',
                            'menu_class' => 'left-column-menu',
                        ));
                    ?>
                </div>
            <?php 
        break;

    }

    ?>
