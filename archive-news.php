<?php get_header(); ?>

<main>

    <?php
    while(have_posts()) {
        the_post(); ?>

        <h2><?php the_title(); ?></h2>

        <div><?php the_post_thumbnail(); ?></div>

        <div><?php the_content(); ?></div>
    
    <?php } ?>

</main>


<?php get_footer(); ?>