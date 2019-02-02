<?php get_header(); ?>

<main class="generic-page">
    <h2 class="generic-page__title post-title">
        <?php echo 'You searched for &ldquo;' . esc_html(get_search_query(false)) . '&rdquo;'; ?>
    </h2>

    <hr class="hr_style_1">

    <div>
        <?php
        if(have_posts()) {
            while(have_posts()) {
                the_post();
                echo '<ul class="wp-search__list">';

                if(get_post_type() == 'events') {
                ?>
                    <li class="search-overlay__listItem">
                        <a class="search-overlay__title" href="<?php the_permalink(); ?>"><i class="far fa-calendar-alt"></i><?php the_title(); ?></a>
                        <h4 class="search-overlay__subtitle">On <?php 
                            $eventDate = new DateTime(get_field('event_date'));
                            echo $eventDate->format('M jS, Y');
                            ?>
                        </h4>
                        <div class="search-overlay__content">
                            <?php the_post_thumbnail('news-square', array('class' => 'search-overlay__image')); ?>
                            <p class="search-overlay__description"><?php echo wp_trim_words(get_the_content(), 50); ?>&nbsp;<a href="<?php the_permalink(); ?>" class="search-overlay__readMore">Learn more</a></p>
                            <p class="wp-search__category"><?php echo get_post_type(); ?></p>
                        </div>
                    </li>
                <?php
                } 
                    
                if(get_post_type() == 'news') {
                ?>  
                    <li class="search-overlay__listItem">
                        <a class="search-overlay__title" href="<?php the_permalink(); ?>"><i class="far fa-newspaper"></i><?php the_title(); ?></a>
                        <h4 class="search-overlay__subtitle">Posted on <?php the_date(); ?></h4>
                    
                        <div class="search-overlay__content">
                            <?php the_post_thumbnail('news-square', array('class' => 'search-overlay__image')); ?>
                            <p class="search-overlay__description"><?php echo wp_trim_words(get_the_content(), 50); ?>&nbsp;<a href="<?php the_permalink(); ?>" class="search-overlay__readMore">Learn more</a></p>
                            <p class="wp-search__category"><?php echo get_post_type(); ?></p>
                        </div>
                    </li>
                <?php
                }
    
                if(get_post_type() == 'post' OR get_post_type() == 'page') {
                ?>
                    <li class="search-overlay__listItem search-overlay__listItem--general">
                        <a class="search-overlay__title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </li>
                <?php
                }

                echo '</ul>';
            }
        } else {
            echo '<p class="search-overlay__noResults">Sorry, nothing matches your search.</p>';
        } 
        get_search_form();
    ?>
    </div>

    <hr class="hr_style_1">

    <a href="<?php echo esc_url(site_url('/')); ?>" class="btn-primary"><i class="fas fa-home"></i>&nbsp; Home</a>
</main>

<?php get_footer(); ?>   