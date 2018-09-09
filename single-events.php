<?php get_header(); ?>

<main class="news-article">
    <?php
    while(have_posts()) {
        the_post(); ?>

        <h2 class="news-article__title"><?php the_title(); ?></h2>

        <div class="news-article__post-details">
            <a href="<?php echo get_post_type_archive_link('events'); ?>" class="news-article__nav-category" id="first">
            <i class="far fa-calendar-alt"></i> Upcoming Events
            </a>
            <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>" class="news-article__posted-by" id="second">
                Sign up for <span><?php the_title(); ?></span>
            </a>
        </div>

        <hr class="hr_style_1">

        <?php the_post_thumbnail('news-large', array('class' => 'news-article__feature-img')); ?>

        <div class="news-article__main-content"><?php the_content(); ?></div>

        <div class="news-article__end-mark">
            <i class="fas fa-feather-alt"></i>
        </div>

        <h3 class="news-article__more-from-category">Also posted in <?php the_category(', '); ?>:</h3>

        <div class="news-article__related-content" data-flickity='{ "freeScroll": "true", "wrapAround": "true" }'>
            <?php             
                $categories = get_the_category();
                $category_ids = array();
                foreach( $categories as $cat ) {
                    $category_ids[] = $cat->term_id;
                }

                $categoryPosts = new WP_Query(array(
                    'post_type' => array( 'news', 'posts' ),
                    'posts_per_page' => 10,
                    'category__in' => $category_ids
                ));

                while ($categoryPosts->have_posts()) {
                    $categoryPosts->the_post(); 
            ?>

            <div class="cards-related">
                <?php the_post_thumbnail('full', array('class' => 'cards-related__img')); ?>         

                <div class="cards-related__heading">                
                    <h3><a href="<?php the_permalink(); ?>" class="cards-related__title-link"><?php the_title(); ?></a></h3>
                </div>         
            </div>

            <?php 
                }
                wp_reset_postdata(); 
            ?>
        </div> 
    <?php } ?>

        <div class="news-article__btn-box">
            <a href="<?php echo get_post_type_archive_link('news'); ?>" class="news-article__btn">&larr; Back to News</a>
            <a href="<?php echo site_url('/'); ?>" class="news-article__btn">&larr; Home</a>
        </div>
</main>

<?php get_footer(); ?>