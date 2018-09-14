<?php get_header(); ?>

<main class="news-archive">

    <h2 class="news-archive__heading">Latest OGN News</h2>

    <div class="pagination">
        <?php echo paginate_links(); ?>
    </div>

    <hr class="hr_style_1">

    <?php
    while(have_posts()) {
        the_post(); ?>

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
    
    <?php } ?>

    <hr class="hr_style_1">

    <div class="pagination">
        <?php echo paginate_links(); ?>
    </div>

    <a href="<?php echo site_url('/'); ?>" class="btn-primary">Home</a>

</main>


<?php get_footer(); ?>