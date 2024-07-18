<?php

get_header();

            $current_page = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $per_page = '2';
            $testimonial_args = array(
                'post_type' => 'newstype',
                'posts_per_page' => $per_page,
                'paged' => $current_page,
            );
            $testimonials = new WP_Query($testimonial_args);
            ?>

            <?php if ($testimonials->have_posts()) : $i = 1; ?>
                <?php while ($testimonials->have_posts()) : $testimonials->the_post(); ?>

                    <div class="">
                        <div class="uk-card">
                            <div class="headline">
                                <?php the_title(); ?>
                            </div>
                            <div class="card-container">
                                <div class="photo"><?php the_post_thumbnail('thumbnail'); ?></div>
                                <a href="<?php the_permalink(); ?>" class="btn btn-secondary btn-pill hvr-float-shadow"><i aria-hidden="true" class="fa fa-arrow-circle-o-right"></i> Full Story</a>
                            </div>
                        </div>
                    </div>
                    <?php $i+=1; ?>
                <?php endwhile; ?>

                <div class="pagination">
                    <?php
                        $big = 999999999; // need an unlikely intege
                        echo paginate_links( array(
                            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                            'format' => '?paged=%#%',
                            'current' => max( 1, get_query_var('paged') ),
                            'total' => $testimonials->max_num_pages
                        ) );
                    ?>
                </div>
            <?php else : ?>
                <h2 class="center">Testimonials Not Found</h2>
                <p class="center">Sorry, but there are no testimonials, check back later!</p>
        <?php endif;

get_footer();
        ?>
