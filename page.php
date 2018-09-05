<?php get_header(); ?>

<main class="generic-page">
    <?php
    while(have_posts()) {
        the_post(); ?>

        <h2 class="generic-page__title"><?php the_title(); ?></h2>

        <hr class="hr_style_1">

        <div class="generic-page__content">
            <?php the_content(); ?>
        </div>

        <div class="end-mark">
            <i class="fas fa-feather-alt"></i>
        </div>

        <hr class="hr_style_1">

        <a href="<?php echo site_url('/'); ?>" class="btn-primary">&larr; Home</a>
        
    <?php } ?>
</main>

<?php get_footer(); ?>