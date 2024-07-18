<?php
//
// Если страница не найдена
//

get_header();
?>
<div class="uk-section">
	<div class="uk-container uk-container-xlarge">
	<?php
		// циклы вывода записей
		// если записи найдены
		if ( have_posts() ){
			while ( have_posts() ){
				the_post();
				echo '<h3><a href="'. get_permalink() .'">'. get_the_title() .'</a></h3>';
				echo get_the_excerpt();
			}
		}
		// если записей не найдено
		else{
			echo ' <p>Записей нет...</p>';
		}
		?>
	</div>
</div>

<?php
get_footer();
?>
