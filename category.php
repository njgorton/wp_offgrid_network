<?php get_header(); ?>

<main class="news-archive">

    <h2 class="news-archive__heading">Category: <?php single_cat_title(); ?></h2>

    <div class="news-archive__pagination">
        <?php echo paginate_links(); ?>
    </div>

    <hr class="hr_style_1">

    <?php 
    $category = get_category( get_query_var( 'cat' ) );
    $cat_id = $category->cat_ID;
    $args = array ( 'post_type' => array( 
        'news', 'posts' ),
        'cat' =>  $cat_id);
        //'posts_per_page' => -1);
    $myPosts = get_posts( $args ); 
    foreach( $myPosts as $post ) :	setup_postdata($post);
    ?>

        <section class="news-archive__section">
            <?php the_post_thumbnail('news-square', array('class' => 'news-archive__feature-img')); ?>
            
            <div class="news-archive__content">
                <p class="news-archive__post-details"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><strong>By <span><?php the_author(); ?></span> on <?php echo get_the_date() ?></strong></a></p>

                <h3 class="news-archive__title"><a class="news-archive__title-link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

                <p class="news-archive__text"><?php echo wp_trim_words(get_the_content(), 35); ?></p>

                <p class="news-archive__categories"><strong>Posted in:</strong> <?php the_category(', '); ?></p>

                <a href="<?php the_permalink(); ?>" class="news-archive__btn">Read Article &rarr;</a>
            </div>
        </section>

    <?php endforeach; ?>

    <hr class="hr_style_1">

    <div class="news-archive__pagination">
        <?php echo paginate_links(); ?>
    </div>

    <div class="category__listCats">
        <h3>More Category Archives:</h3> 
        <ul>
            <?php 
            $cat_list = array('title_li' => '');
            wp_list_categories($cat_list); 
            ?>
        </ul>
    </div>

    <a href="<?php echo site_url('/'); ?>" class="news-archive__home-btn">Home</a>

</main>


<?php get_footer(); ?>