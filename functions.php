<?php
/* Вывод документов из категории */
function show_dokument_from($myposts,$category_name){
  global $post;
  $cat_name = '';
  foreach( $myposts as $key => $post ){
    setup_postdata( $post );
    if( get_field('dokument_cat') == $category_name ) :
    ?>

    <?
    if (!$cat_name){
      $cat_name = get_field('dokument_cat');
      echo "
      <div class=\"document_list\">
        <div class=\"uk-h2 uk-margin-large-top\">".$cat_name."</div>";
    }
    ?>
    <div class="document_item uk-padding-small">
      <div class="uk-flex uk-flex-middle" uk-grid>
        <div class="uk-width-expand">
          <?=get_the_title();?>
        </div>
        <div class="uk-width-auto">
          <a href="<?=the_field('dokument_url')?>" title="Скачать документ"><img class="uk-margin-small-right" src="/wp-content/themes/oac/images/<?php echo get_field('dokument_type') == 'doc' ? "doc" : "pdf"; ?>.webp" width="50px" /><span class="uk-visible@s">Скачать</span></a>
        </div>
      </div>
    </div>
    <?php
    endif;
  }
  if ($cat_name){
    echo "</div>";
  }

  return;
}

/* По-страничная навигация */
function my_pagination(){
    global $wp_query;
    if (is_front_page()) {
        $currentPage = (get_query_var("page")) ? get_query_var("page") : 1;
    } else {
        $currentPage = (get_query_var("paged")) ? get_query_var("paged") : 1;
    }
    $pagination = paginate_links([
        "base"      => str_replace(999999999, "%#%", get_pagenum_link(999999999)),
        "format"    => "",
        "current"   => max(1, $currentPage),
        "total"     => $wp_query->max_num_pages,
        "type"      => "list",
        "prev_text" => '<img src="/wp-content/themes/oac/images/arrow-left.svg" width="16px">',
        "next_text" => '<img src="/wp-content/themes/oac/images/arrow-right.svg" width="16px">',
    ]);
    echo str_replace("page-numbers", "pagination", $pagination);
}


/* Добавить класс к input */
add_action('woocommerce_form_field_args','wc_form_field_args',10,3);
function wc_form_field_args($args, $key, $value) {
  if ($args['type'] == 'textarea'){
    $args['input_class'][] = 'uk-textarea';
  } else {
    $args['input_class'][] = 'uk-input';
  }
  return $args;
}


/* СТИЛИ */
add_action( 'wp_enqueue_scripts', 'ritus_add_scripts' );
function ritus_add_scripts(){
    wp_enqueue_style( 'uikit', get_template_directory_uri() . '/css/uikit.min.css' );
    wp_enqueue_style( 'style-main', get_template_directory_uri() . '/css/style.css' );
    wp_enqueue_script( 'uikit-core', get_template_directory_uri() . '/js/uikit.min.js' );
}

/* Тип страницы Новости */
add_action( 'init', 'register_post_types' );
function register_post_types(){
	register_post_type( 'novost', [
		'label'  => null,
		'labels' => [
			'name'               => 'Новости', // основное название для типа записи
			'singular_name'      => 'Новость', // название для одной записи этого типа
			'add_new'            => 'Добавить новость', // для добавления новой записи
			'add_new_item'       => 'Добавление новости', // заголовка у вновь создаваемой записи в админ-панели.
			'edit_item'          => 'Редактирование новости', // для редактирования типа записи
			'new_item'           => 'Новая новость', // текст новой записи
			'view_item'          => 'Смотреть новость', // для просмотра записи этого типа.
			'search_items'       => 'Искать новость', // для поиска по этим типам записи
			'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
			'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
			'parent_item_colon'  => '', // для родителей (у древовидных типов)
			'menu_name'          => 'Новости', // название меню
		],
		'description'         => '',
		'public'              => true,
		'show_in_menu'        => true, // показывать ли в меню админки
		'show_in_rest'        => null, // добавить в REST API. C WP 4.7
		'rest_base'           => null, // $post_type. C WP 4.7
		'menu_position'       => null,
		'menu_icon'           => 'dashicons-align-left',
		'hierarchical'        => false,
		'supports'            => [ 'title', 'thumbnail', 'editor', 'custom-fields' ], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
		'taxonomies'          => [],
		'has_archive'         => false,
		'rewrite'             => true,
		'query_var'           => true
	] );
  register_post_type( 'banner', [
		'label'  => null,
		'labels' => [
			'name'               => 'Баннеры', // основное название для типа записи
			'singular_name'      => 'Баннер', // название для одной записи этого типа
			'add_new'            => 'Добавить баннер', // для добавления новой записи
			'add_new_item'       => 'Добавление баннера', // заголовка у вновь создаваемой записи в админ-панели.
			'edit_item'          => 'Редактирование баннера', // для редактирования типа записи
			'new_item'           => 'Новый баннер', // текст новой записи
			'view_item'          => 'Смотреть баннер', // для просмотра записи этого типа.
			'search_items'       => 'Искать баннер', // для поиска по этим типам записи
			'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
			'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
			'parent_item_colon'  => '', // для родителей (у древовидных типов)
			'menu_name'          => 'Баннеры', // название меню
		],
		'description'         => '',
		'public'              => true,
		'show_in_menu'        => true, // показывать ли в меню админки
		'show_in_rest'        => null, // добавить в REST API. C WP 4.7
		'rest_base'           => null, // $post_type. C WP 4.7
		'menu_position'       => null,
		'menu_icon'           => 'dashicons-columns',
		'hierarchical'        => false,
		'supports'            => [ 'title', 'custom-fields' ], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
		'taxonomies'          => [],
		'has_archive'         => false,
		'rewrite'             => true,
		'query_var'           => true
	] );
  register_post_type( 'dokument', [
		'label'  => null,
		'labels' => [
			'name'               => 'Документы', // основное название для типа записи
			'singular_name'      => 'Документ', // название для одной записи этого типа
			'add_new'            => 'Добавить документ', // для добавления новой записи
			'add_new_item'       => 'Добавление документа', // заголовка у вновь создаваемой записи в админ-панели.
			'edit_item'          => 'Редактирование документа', // для редактирования типа записи
			'new_item'           => 'Новый документ', // текст новой записи
			'view_item'          => 'Смотреть документ', // для просмотра записи этого типа.
			'search_items'       => 'Искать документ', // для поиска по этим типам записи
			'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
			'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
			'parent_item_colon'  => '', // для родителей (у древовидных типов)
			'menu_name'          => 'Документы', // название меню
		],
		'description'         => '',
		'public'              => true,
		'show_in_menu'        => true, // показывать ли в меню админки
		'show_in_rest'        => null, // добавить в REST API. C WP 4.7
		'rest_base'           => null, // $post_type. C WP 4.7
		'menu_position'       => null,
		'menu_icon'           => 'dashicons-book',
		'hierarchical'        => false,
		'supports'            => [ 'title', 'custom-fields' ], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
		'taxonomies'          => [],
		'has_archive'         => false,
		'rewrite'             => true,
		'query_var'           => true
	] );
  register_post_type( 'member', [
    'label'  => null,
    'labels' => [
      'name'               => 'Члены ОП', // основное название для типа записи
      'singular_name'      => 'Член ОП', // название для одной записи этого типа
      'add_new'            => 'Добавить члена ОП', // для добавления новой записи
      'add_new_item'       => 'Добавление члена ОП', // заголовка у вновь создаваемой записи в админ-панели.
      'edit_item'          => 'Редактирование документа', // для редактирования типа записи
      'new_item'           => 'Новый документ', // текст новой записи
      'view_item'          => 'Смотреть документ', // для просмотра записи этого типа.
      'search_items'       => 'Искать документ', // для поиска по этим типам записи
      'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
      'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
      'parent_item_colon'  => '', // для родителей (у древовидных типов)
      'menu_name'          => 'Члены ОП', // название меню
    ],
    'description'         => '',
    'public'              => true,
    'show_in_menu'        => true, // показывать ли в меню админки
    'show_in_rest'        => null, // добавить в REST API. C WP 4.7
    'rest_base'           => null, // $post_type. C WP 4.7
    'menu_position'       => null,
    'menu_icon'           => 'dashicons-id',
    'hierarchical'        => false,
    'supports'            => [ 'title', 'custom-fields','thumbnail','editor','page-attributes','post-formats' ], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
    'taxonomies'          => ['category','post_tag'],
    'has_archive'         => false,
    'rewrite'             => true,
    'query_var'           => true
  ] );
}


/* Разрешить SVG */
add_filter( 'upload_mimes', 'svg_upload_allow' );
# Добавляет SVG в список разрешенных для загрузки файлов.
function svg_upload_allow( $mimes ) {
	$mimes['svg']  = 'image/svg+xml';
	return $mimes;
}
add_filter( 'wp_check_filetype_and_ext', 'fix_svg_mime_type', 10, 5 );
# Исправление MIME типа для SVG файлов.
function fix_svg_mime_type( $data, $file, $filename, $mimes, $real_mime = '' ){
	// WP 5.1 +
	if( version_compare( $GLOBALS['wp_version'], '5.1.0', '>=' ) )
		$dosvg = in_array( $real_mime, [ 'image/svg', 'image/svg+xml' ] );
	else
		$dosvg = ( '.svg' === strtolower( substr($filename, -4) ) );
	// mime тип был обнулен, поправим его
	// а также проверим право пользователя
	if( $dosvg ){
		// разрешим
		if( current_user_can('manage_options') ){
			$data['ext']  = 'svg';
			$data['type'] = 'image/svg+xml';
		}
		// запретим
		else {
			$data['ext'] = $type_and_ext['type'] = false;
		}
	}
	return $data;
}

function visually_impaired_widget() {
  register_sidebar(array(
    'name' => 'Версия слабовидящих',
    'id' => 'visually'
  ));
}
add_action( 'init', 'visually_impaired_widget' );

function devise_widgets_init() {
  register_sidebar(array(
    'name' => __( 'Сайдбар 1', 'devise' ),
    'id' => 'sidebar-1',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '<h4>',
    'after_title' => '</h4>',
  ));
}
add_action( 'init', 'devise_widgets_init' );

add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' );


/*
 * Function for post duplication. Dups appear as drafts. User is redirected to the edit screen
 */
function rd_duplicate_post_as_draft(){
  global $wpdb;
  if (! ( isset( $_GET['post']) || isset( $_POST['post'])  || ( isset($_REQUEST['action']) && 'rd_duplicate_post_as_draft' == $_REQUEST['action'] ) ) ) {
    wp_die('No post to duplicate has been supplied!');
  }

  /*
   * Nonce verification
   */
  if ( !isset( $_GET['duplicate_nonce'] ) || !wp_verify_nonce( $_GET['duplicate_nonce'], basename( __FILE__ ) ) )
    return;

  /*
   * get the original post id
   */
  $post_id = (isset($_GET['post']) ? absint( $_GET['post'] ) : absint( $_POST['post'] ) );
  /*
   * and all the original post data then
   */
  $post = get_post( $post_id );

  /*
   * if you don't want current user to be the new post author,
   * then change next couple of lines to this: $new_post_author = $post->post_author;
   */
  $current_user = wp_get_current_user();
  $new_post_author = $current_user->ID;

  /*
   * if post data exists, create the post duplicate
   */
  if (isset( $post ) && $post != null) {

    /*
     * new post data array
     */
    $args = array(
      'comment_status' => $post->comment_status,
      'ping_status'    => $post->ping_status,
      'post_author'    => $new_post_author,
      'post_content'   => $post->post_content,
      'post_excerpt'   => $post->post_excerpt,
      'post_name'      => $post->post_name,
      'post_parent'    => $post->post_parent,
      'post_password'  => $post->post_password,
      'post_status'    => 'draft',
      'post_title'     => $post->post_title,
      'post_type'      => $post->post_type,
      'to_ping'        => $post->to_ping,
      'menu_order'     => $post->menu_order
    );

    /*
     * insert the post by wp_insert_post() function
     */
    $new_post_id = wp_insert_post( $args );

    /*
     * get all current post terms ad set them to the new post draft
     */
    $taxonomies = get_object_taxonomies($post->post_type); // returns array of taxonomy names for post type, ex array("category", "post_tag");
    foreach ($taxonomies as $taxonomy) {
      $post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
      wp_set_object_terms($new_post_id, $post_terms, $taxonomy, false);
    }

    /*
     * duplicate all post meta just in two SQL queries
     */
    $post_meta_infos = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id");
    if (count($post_meta_infos)!=0) {
      $sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
      foreach ($post_meta_infos as $meta_info) {
        $meta_key = $meta_info->meta_key;
        if( $meta_key == '_wp_old_slug' ) continue;
        $meta_value = addslashes($meta_info->meta_value);
        $sql_query_sel[]= "SELECT $new_post_id, '$meta_key', '$meta_value'";
      }
      $sql_query.= implode(" UNION ALL ", $sql_query_sel);
      $wpdb->query($sql_query);
    }


    /*
     * finally, redirect to the edit post screen for the new draft
     */
    wp_redirect( admin_url( 'post.php?action=edit&post=' . $new_post_id ) );
    exit;
  } else {
    wp_die('Post creation failed, could not find original post: ' . $post_id);
  }
}
add_action( 'admin_action_rd_duplicate_post_as_draft', 'rd_duplicate_post_as_draft' );

/*
* Add the duplicate link to action list for post_row_actions
*/
function rd_duplicate_post_link( $actions, $post ) {
  if (current_user_can('edit_posts')) {
    $actions['duplicate'] = '<a href="' . wp_nonce_url('admin.php?action=rd_duplicate_post_as_draft&post=' . $post->ID, basename(__FILE__), 'duplicate_nonce' ) . '" title="Копировать элемент" rel="permalink">Дублировать</a>';
  }
  return $actions;
}
add_filter( 'post_row_actions', 'rd_duplicate_post_link', 10, 2 );

/*
*  МЕНЮ
*/
add_action( 'after_setup_theme', 'theme_register_nav_menu' );
function theme_register_nav_menu() {
	register_nav_menu( 'primary', 'Основное меню' );
}

/*
* Редирект и переменная для рабочей группы
*/
function custom_rewrite_workgroups() {
  add_rewrite_rule('gruppa/([a-z0-9-]+)[/]?$','index.php?page_id=8483&gruppa=$matches[1]','top');
}
add_filter( 'query_vars', function( $query_vars ) {
  $query_vars[] = 'gruppa';
  return $query_vars;
});
add_action('init', 'custom_rewrite_workgroups', 10, 0);
/*
* Редирект и переменная для комиссии
*/
function custom_rewrite_comissions() {
  add_rewrite_rule('comission/([a-z0-9-]+)[/]?$','index.php?page_id=8485&comission=$matches[1]','top');
}
add_filter( 'query_vars', function( $query_vars ) {
  $query_vars[] = 'comission';
  return $query_vars;
});
add_action('init', 'custom_rewrite_comissions', 10, 0);
/*
* Редирект и переменная для состава палаты
*/
function custom_rewrite_sozyvi() {
  add_rewrite_rule('sozyvy-op/([a-z0-9-]+)[/]?$','index.php?page_id=11388&sozyv=$matches[1]','top');
}
add_filter( 'query_vars', function( $query_vars ) {
  $query_vars[] = 'sozyv';
  return $query_vars;
});
add_action('init', 'custom_rewrite_sozyvi', 10, 0);

/*
* Редирект и переменная для члена палаты
*/
function custom_rewrite_members() {
  add_rewrite_rule('member/([a-z0-9-]+)[/]?$','index.php?page_id=11388&memb=$matches[1]','top');
}
add_filter( 'query_vars', function( $query_vars ) {
  $query_vars[] = 'memb';
  return $query_vars;
});
add_action('init', 'custom_rewrite_members', 10, 0);

/*
* Редирект и переменная для документов
*/
function custom_rewrite_documents() {
  add_rewrite_rule('category/documenti/([a-z0-9-]+)[/]?$','index.php?page_id=8489&doc_cat=$matches[1]','top');
}
add_filter( 'query_vars', function( $query_vars ) {
  $query_vars[] = 'doc_cat';
  return $query_vars;
});
add_action('init', 'custom_rewrite_documents', 10, 0);

/*
* Редирект и переменная для документа
*/
function custom_rewrite_document() {
  add_rewrite_rule('documenti/([a-z0-9-]+)[/]?$','index.php?page_id=8489&doc_name=$matches[1]','top');
}
add_filter( 'query_vars', function( $query_vars ) {
  $query_vars[] = 'doc_name';
  return $query_vars;
});
add_action('init', 'custom_rewrite_document', 10, 0);

/*
* Редирект и переменная для общ советов
*/
function custom_rewrite_pcouncils() {
  add_rewrite_rule('category/obschestvennye-sovety/([a-z0-9-]+)[/]?$','index.php?page_id=11576&pcouncil_cat=$matches[1]','top');
}
add_filter( 'query_vars', function( $query_vars ) {
  $query_vars[] = 'pcouncil_cat';
  return $query_vars;
});
add_action('init', 'custom_rewrite_pcouncils', 10, 0);

/*
* Редирект и переменная для общ совета
*/
function custom_rewrite_pcouncil() {
  add_rewrite_rule('obschestvennye-sovety/([a-z0-9-]+)[/]?$','index.php?page_id=11576&pcouncil_name=$matches[1]','top');
}
add_filter( 'query_vars', function( $query_vars ) {
  $query_vars[] = 'pcouncil_name';
  return $query_vars;
});
add_action('init', 'custom_rewrite_pcouncil', 10, 0);

/*
* Редирект и переменная для рейтингов
*/
function custom_rewrite_ratings() {
  add_rewrite_rule('category/reitingi/([a-z0-9-]+)[/]?$','index.php?page_id=11786&rating_cat=$matches[1]','top');
}
add_filter( 'query_vars', function( $query_vars ) {
  $query_vars[] = 'rating_cat';
  return $query_vars;
});
add_action('init', 'custom_rewrite_ratings', 10, 0);


/*
* Редирект и переменная для новости ОНК
*/
function custom_rewrite_onknews() {
  add_rewrite_rule('onk-news/([a-z0-9-]+)[/]?$','index.php?page_id=12185&onk_news_name=$matches[1]','top');
}
add_filter( 'query_vars', function( $query_vars ) {
  $query_vars[] = 'onk_news_name';
  return $query_vars;
});
add_action('init', 'custom_rewrite_onknews', 10, 0);

/*
* Редирект и переменная для галереи
*/
function custom_rewrite_gallery() {
  add_rewrite_rule('gallery/([a-z0-9-]+)[/]?$','index.php?page_id=12652&gallery_name=$matches[1]','top');
}
add_filter( 'query_vars', function( $query_vars ) {
  $query_vars[] = 'gallery_name';
  return $query_vars;
});
add_action('init', 'custom_rewrite_gallery', 10, 0);



/*
* Без заголовка
*/
add_filter( 'query_vars', function( $query_vars ) {
  $query_vars[] = 'notitle';
  return $query_vars;
});


// disable srcset on frontend
function disable_wp_responsive_images() {
	return 1;
}
add_filter('max_srcset_image_width', 'disable_wp_responsive_images');