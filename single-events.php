<?php get_header(); ?>

<main class="event">
    <?php
    while(have_posts()) {
        the_post(); ?>

        <!-- postNav and children are styled in /modules/utilities -->
        <div class="postNav event__navLinks">
            <a href="<?php echo get_post_type_archive_link('events'); ?>" class="postNav__primary" id="first">
            <i class="far fa-calendar-alt"></i> Upcoming Events
            </a>
            <a href="<?php echo site_url('/event-registration'); ?>" class="postNav__secondary" id="second">
                Sign up for <span><?php the_title(); ?></span>
            </a>
        </div>

        <?php the_post_thumbnail('news-square', array('class' => 'event__feature-img')); ?>

        <h2 class="event__title post-title"><?php the_title(); ?></h2>

        <hr class="hr_style_1 event__hr">

        <div class="event__metaBox">
            <div class="event__price">
            <?php
                $eventPrice = get_field('event_price');
                if ( $eventPrice < 1) {
                    echo 'Free Event!';
                } else {
                    echo 'Only $' . $eventPrice . '!';
                }
            ?>
            </div>

            <p>
            <?php
                $eventDate = new DateTime(get_field('event_date'));
                echo '<i class="fas fa-calendar-alt"></i> &nbsp; ' . $eventDate->format('M jS, Y');
            ?> 
            </p>

            <p>
            <?php
                $eventStartTime = get_field('event_start_time');
                $eventEndTime = get_field('event_end_time');
                echo '<i class="far fa-clock"></i> &nbsp; ' . $eventStartTime . ' - ' . $eventEndTime;
            ?>
            </p>

            <p>
            <?php
                $eventLocation = get_field('event_location');
                echo '<i class="fas fa-map-marked-alt"></i> &nbsp; ' . $eventLocation;
            ?>
            </p>
        </div>

        <div class="post-content"><?php the_content(); ?></div>

        <a href="<?php echo site_url('/event-registration'); ?>" class="event__callOut">Sign up Now!</a>

        <h3 class="news-article__more-from-category">More Upcoming Events:</h3>

        <div class="news-article__related-content" data-flickity='{ "freeScroll": "true", "wrapAround": "true" }'>
            <?php             
                $today = date('Ymd');
                $moreEvents = new WP_Query(array(
                    'posts_per_page' => -1,
                    'post_type' => 'events',
                    'meta_key' => 'event_date',
                    'orderby' => 'meta_value_num',
                    'order' => 'ASC',
                    'meta_query' => array(
                        array(
                            'key' => 'event_date',
                            'compare' => '>=',
                            'value' => $today,
                            'type' => 'numeric'    
                        )
                    )
                ));

                while ($moreEvents->have_posts()) {
                    $moreEvents->the_post(); 
            ?>

            <div class="cards-related">
                <?php the_post_thumbnail('full', array('class' => 'cards-related__img')); ?>         

                <div class="cards-related__heading">                
                    <h3><a href="<?php the_permalink(); ?>" class="cards-related__title-link"><?php the_title(); ?></a></h3>
                </div>         
            </div>

            <?php 
                }
                wp_reset_postdata(); 
            ?>
        </div> 
    <?php } ?>

        <div class="paired-btnBox">
            <a href="<?php echo site_url('/'); ?>" class="paired-btn"><i class="fas fa-home"></i>&nbsp; Home</a>
            <a href="<?php echo get_post_type_archive_link('events'); ?>" class="paired-btn"><i class="far fa-calendar-alt"></i>&nbsp; Events</a>
        </div>
</main>

<?php get_footer(); ?>