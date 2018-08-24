<?php get_header(); ?>

<main class="news-archive">

    <h2 class="news-archive__heading">Latest OGN News</h2>

    <div class="news-archive__pagination">
        <?php echo paginate_links(); ?>
    </div>

    <?php
    while(have_posts()) {
        the_post(); ?>

        <section class="news-archive__section">
        <?php the_post_thumbnail('full', array('class' => 'news-archive__feature-img')); ?>
        
        <div class="news-archive__content">
        <h3 class="news-archive__title"><a class="news-archive__title-link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

        <p><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>" class="news-archive__post-details"><strong>By <span><?php the_author(); ?></span> on <?php echo get_the_date() ?></strong></a></p>

        <p class="news-archive__text"><?php echo wp_trim_words(get_the_content(), 50); ?></p>

        <p class="news-archive__categories"><strong>Posted in:</strong> <?php the_category(', '); ?></p>

        <a href="<?php the_permalink(); ?>" class="news-archive__btn">Read Article &rarr;</a>
        </div>
        </section>

        <hr class="hr_style_1">
    
    <?php } ?>

    <div class="news-archive__pagination">
        <?php echo paginate_links(); ?>
    </div>

    <a href="<?php echo site_url('/'); ?>" class="news-archive__home-btn">Home</a>

</main>


<?php get_footer(); ?>