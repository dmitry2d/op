
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

    }

    ?>
