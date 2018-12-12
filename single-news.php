<?php get_header(); ?>

<main class="news-article">
    <?php
    while(have_posts()) {
        the_post(); ?>

        <h2 class="news-article__title post-title"><?php the_title(); ?></h2>
        
        <!-- postNav and children are styled in /modules/utilities -->
        <div class="postNav news-article__navLinks"> 
            <a href="<?php echo get_post_type_archive_link('news'); ?>" class="postNav__primary" id="first">
                <i class="far fa-newspaper"></i>&nbsp; News Home
            </a>
            <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>" class="postNav__secondary" id="second">
                By <span><?php the_author(); ?></span>, on <?php the_date(); ?>
            </a>
        </div>

        <p class="news-article__categories"><strong>Posted in:</strong> <?php the_category(', '); ?></p>

        <hr class="hr_style_1">

        <?php the_post_thumbnail('news-large', array('class' => 'news-article__feature-img')); ?>

        <div class="news-article__main-content post-content"><?php the_content(); ?></div>

        <div class="end-mark">
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

        <div class="paired-btnBox">
            <a href="<?php echo site_url('/'); ?>" class="paired-btn"><i class="fas fa-home"></i>&nbsp; Home</a>
            <a href="<?php echo get_post_type_archive_link('news'); ?>" class="paired-btn"><i class="far fa-newspaper"></i>&nbsp; News</a>
        </div>
</main>

<?php get_footer(); ?>