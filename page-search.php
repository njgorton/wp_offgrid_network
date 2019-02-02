<?php get_header(); ?>

<main class="generic-page">
    <?php
    while(have_posts()) {
        the_post(); ?>

        <h2 class="generic-page__title post-title">Looking for something?</h2>

        <div class="generic-content">
            <?php get_search_form(); ?>
        </div>

        <a href="<?php echo esc_url(site_url('/')); ?>" class="btn-primary"><i class="fas fa-home"></i>&nbsp; Home</a>
        
    <?php } ?>
</main>

<?php get_footer(); ?> 