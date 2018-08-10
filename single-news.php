<?php get_header(); ?>

<main class="news-article">
    <?php
    while(have_posts()) {
        the_post(); ?>

        <h2 class="news-article__title"><?php the_title(); ?></h2>

        <div class="news-article__feature-img"><?php the_post_thumbnail(); ?></div>

        <div class="news-article__content"><?php the_content(); ?></div>
    
    <?php } ?>

    <hr class="news-article__hr">

    <div class="news-article__btn-box">
        <a href="<?php echo get_post_type_archive_link('news'); ?>" class="news-article__btn">&larr; Back to News</a>
        <a href="<?php echo site_url('/'); ?>" class="news-article__btn">&larr; Home</a>
    </div>
</main>

<?php get_footer(); ?>