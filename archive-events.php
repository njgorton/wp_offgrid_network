<?php get_header(); ?>

<main class="events-archive">

    <h2 class="events-archive__heading">Upcoming Events and Workshops!</h2>

    <div class="pagination">
        <?php echo paginate_links(); ?>
    </div>

    <!-- Card Grid Container Around Loop --> 
    <div class="events-archive__card-grid"> 
    <?php
        while (have_posts()) {
            the_post(); ?>

        <div class="flip-card">
            <!-- Front of Card -->
            <a href="<?php the_permalink(); ?>" class="flip-card__side flip-card__side--front">
                <div class="flip-card__imgBox-front">
                    <?php the_post_thumbnail('news-medium', array('class' => 'flip-card__img-front')); ?>
                </div>
                        
                <div class="flip-card__content">
                    <h4 class="flip-card__event-date">
                        <?php
                            $eventDate = new DateTime(get_field('event_date'));
                            $eventLocation = get_field('event_location', false);
                            echo $eventDate->format('M jS, Y') . ' | ' . $eventLocation;
                        ?> 
                    </h4>
                    <h3 class="flip-card__title-front"><?php the_title(); ?></h3>

                    <p class="flip-card__event-content">
                        <?php 
                        if (has_excerpt()) {
                            echo get_the_excerpt();
                        } else {
                            echo wp_trim_words(get_the_content(), 18); 
                        }
                        ?>
                    </p>
                </div>
            </a>

            <!-- Back of Card -->
            <div class="flip-card__side flip-card__side--back">
                <h3 class="flip-card__title-back"><?php the_title(); ?></h3>

                <div class="flip-card__imgBox-back">
                    <?php the_post_thumbnail('news-square', array('class' => 'flip-card__img-back')); ?>
                </div>

                <p class="flip-card__details">
                    <?php
                        $eventPrice = get_field('event_price');
                        if ( $eventPrice < 1) {
                            echo 'Free Event!';
                        } else {
                            echo 'Only $' . $eventPrice . '!';
                        }
                    ?>
                </p>

                <div class="flip-card__btn-container">
                    <a href="#" class="flip-card__btn">Sign Up!</a>
                    <a href="<?php the_permalink(); ?>" class="flip-card__btn">See Details &rarr;</a>
                </div>
            </div>
        </div>

    <?php } ?>
    </div> <!-- Close Card Grid Container -->

    <div class="pagination">
        <?php echo paginate_links(); ?>
    </div>

    <a href="<?php echo site_url('/'); ?>" class="btn-secondary"><i class="fas fa-home"></i>&nbsp; Home</a>
</main>


<?php get_footer(); ?>