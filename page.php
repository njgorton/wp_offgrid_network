<?php get_header(); ?>

<main class="news-article">
    <?php
    while(have_posts()) {
        the_post(); ?>

        <h2 class="news-article__title"><?php the_title(); ?></h2>

        <div>
            <?php the_content(); ?>
        </div>

        <div class="news-article__btn-box">
            <a href="<?php echo get_post_type_archive_link('news'); ?>" class="news-article__btn">&larr; Back to News</a>
            <a href="<?php echo site_url('/'); ?>" class="news-article__btn">&larr; Home</a>
        </div>
    
    <?php } ?>
</main>

<?php get_footer(); ?>