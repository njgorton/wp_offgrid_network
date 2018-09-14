<?php get_header(); ?>

<main class="news-article">

    <?php
        $param = $_GET['events'];
        if ( $param ) {
            global $post;
            $post = get_post( $param );
            if ( $post ) {
                setup_postdata( $post ); ?>
                
                <h1>Im the registration PAGE!!!!!</h1>
                <h2 class="news-article__title post-title"><?php the_title(); ?></h2>

                <div class="news-article__post-details">
                    <a href="<?php echo get_post_type_archive_link('events'); ?>" class="news-article__nav-category" id="first">
                        <i class="far fa-newspaper"></i> Events Home
                    </a>
                    <a href="<?php echo site_url('/'); ?>" class="news-article__posted-by" id="second">
                    Back to Event Details
                    </a>
                </div>

                <hr class="hr_style_1">

                <?php the_post_thumbnail('thumbnail', array('class' => 'news-article__feature-img')); ?>

            <?php } else {
                // Event Post not found, let's 404 it.
                echo 'This event was not found!';
            }
        wp_reset_postdata();
        }  else {
        // invalid query param
        echo 'Invalid link!';
        }
    ?>

        <div class="news-article__btn-box">
            <a href="<?php echo get_post_type_archive_link('events'); ?>" class="news-article__btn">&larr; Back to Events</a>
            <a href="<?php echo site_url('/'); ?>" class="news-article__btn">&larr; Home</a>
        </div>
</main>

<?php get_footer(); ?>