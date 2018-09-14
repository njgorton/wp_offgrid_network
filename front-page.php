<?php get_header(); ?>


<!-- ============================ABOUT================================= -->
<main>
    <article class="about">
        <p class="about__text">
            Here at the <em>Off-Grid Network</em>, we believe that living off the grid doesn’t have to mean going it alone. From the know-how of past generations to new innovations, we aim to provide a network for homesteaders to share and learn from each other through the vast knowledge, experience, and traditions of self-sufficiency and independence, shared by a community of folks who love living free and unfettered in our modern world.
        </p>
    </article>


<!-- ============================NEWS================================== -->
    <section class="news">
        <div class="news__heading-container">
            <h2 class="news__heading">News</h2>
        </div>

        <div class="news__content" data-flickity='{ "freeScroll": "true", "wrapAround": "true" }'>
            <?php
                $homepageNews = new WP_Query(array(
                'posts_per_page' => 5,
                'post_type' => 'news',
                ));

                while ($homepageNews->have_posts()) {
                $homepageNews->the_post(); 
            ?>

            <div class="news-card">
                <?php the_post_thumbnail('news-medium', array('class' => 'news-card__img')); ?>         

                <div class="news-card__content">
                    <div class="news-card__heading">                
                        <h3><a href="<?php the_permalink(); ?>" class="news-card__title-link"><?php the_title(); ?></a></h3>
                    </div>
            
                    <p class="news-card__text"><?php echo wp_trim_words(get_the_content(), 18); ?></p>
        
                    <a href="<?php the_permalink(); ?>" class="news-card__btn">Read Article &rarr;</a>
                </div>           
            </div>
            <?php } wp_reset_postdata(); ?>
        </div>
        
        <a class="news__btn" href="<?php echo get_post_type_archive_link('news'); ?>">See More News</a>
    </section>


<!-- ===========================EVENTS================================= -->
    <section class="events">
        <div class="events__heading-container">
            <h2 class="events__heading">Upcoming Events</h2>
        </div>

        <div class="events__content">
        <?php
        $today = date('Ymd');
        $homepageEvents = new WP_Query(array(
          'posts_per_page' => 4,
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
        while ($homepageEvents->have_posts()) {
          $homepageEvents->the_post(); ?>

            <div class="events-card" tabindex="0">
                <?php the_post_thumbnail('news-square', array('class' => 'events-card__img')); ?>                
                
                <div class="events-card__content">
                    <div class="events-card__heading">
                        <h4>
                            <?php
                                $eventDate = new DateTime(get_field('event_date'));
                                $eventLocation = get_field('event_location', false);
                                echo $eventDate->format('M jS, Y') . ' | ' . $eventLocation;
                            ?> 
                        </h4>
                        
                        <h3><?php the_title(); ?></h3>
                    </div>
            
                    <p class="events-card__text">
                        <?php 
                            if (has_excerpt()) {
                                echo get_the_excerpt();
                            } else {
                                echo wp_trim_words(get_the_content(), 18); 
                            }
                        ?>
                    </p>   
                </div>
                
                <div class="events-card__btn-container">
                    <a href="#" class="events-card__btn">Sign Up!</a>
                    <a href="<?php the_permalink(); ?>" class="events-card__btn">See Details &rarr;</a>
                </div>
            </div>

        <?php } wp_reset_postdata(); ?>
        </div>

        <a class="btn-secondary" href="<?php echo get_post_type_archive_link('events'); ?>">See Full Schedule!</a>
    </section>


<!-- ==========================COMMUNITY=============================== -->
    <section class="community">
        <div class="community__heading">
            <h2>Community</h2>
        </div>

        <div class="community__content">
            <div class="community__left">
                <div class="forum">
                    <div class="forum__heading" tabindex="0">
                        <h3>OGN FORUM/</h3>
                        <h4>TRENDING POSTS</h4>
                    </div>                              

                    <div class="forum__post">
                        <h5 class="forum__post-title" tabindex="0">Better chicken coop predator protection ideas?? I'm at my wit's end!!!</h5>
                        <h6 class="forum__post-details">posted 8 days ago by: <img src="img/user-default.jpg" alt="User Image" class="forum__user-img"><span tabindex="0">barnOwl_56</span></h6>
                        <p class="forum__post-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam inventore laboriosam maxime. Ipsam aliquam fugit fugiat minus et, amet nostrum? Consequatur modi, ad labore nulla beatae autem. Quia, voluptatum officia...</p>
                    </div>

                    <div class="forum__post">
                        <h5 class="forum__post-title" tabindex="0">Help me pick a new tractor!</h5>
                        <h6 class="forum__post-details">posted 2 days ago by: <img src="img/user-9.jpg" alt="User Image" class="forum__user-img"><span tabindex="0">buckshot</span></h6>
                        <p class="forum__post-text">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nostrum doloribus assumenda non necessitatibus perferendis vitae quisquam velit dolorum rerum, laborum ducimus accusamus quos, temporibus optio??</p>
                    </div>

                    <div class="forum__post">
                        <h5 class="forum__post-title" tabindex="0">Is my land better suited for solar or hydro power?</h5>
                        <h6 class="forum__post-details">posted 5 days ago by: <img src="img/user-default.jpg" alt="User Image" class="forum__user-img"><span tabindex="0">city2farm</span></h6>
                        <p class="forum__post-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis qui officiis natus consectetur repudiandae vel harum ad hic enim cum. Expedita soluta ex esse sed consequatur non ullam porro officiis...</p>
                    </div>

                    <div class="forum__post">
                        <h5 class="forum__post-title" tabindex="0">County zoning regs are impossible! How to fight "the man"?</h5>
                        <h6 class="forum__post-details">posted yesterday by: <img src="img/user-1.jpg" alt="User Image" class="forum__user-img"><span tabindex="0">LeeroyJenkinz</span></h6>
                        <p class="forum__post-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos reprehenderit nesciunt est ipsum corporis. Vitae laudantium, velit cum nesciunt rerum voluptatum? Eligendi obcaecati, tenetur cum labore nihil saepe!</p>
                    </div>
                </div>       
            </div>

            <div class="community__right">    
                <div class="online">
                    <div class="online__container">
                        <h3 class="online__user-count" tabindex="0">Users online: 2,768</h3>
                        <h4 class="online__member-count">1,836 members</h4>
                        <h4 class="online__guest-count">932 guests</h4>
                    </div>                
                </div>

                <div class="members">
                    <h3 class="members__heading">Top Contributing Users</h3>
                    <p class="members__updated">Updated: 58 minutes ago, restarts in 5 days 8 hours...</p>

                    <ul class="members__list">
                        <li class="members__user" tabindex="0">1. <img src="img/user-1.jpg" alt="User Image" class="members__img"> LeeroyJenkinz <span>206</span></li>

                        <li class="members__user" tabindex="0">2. <img src="img/user-2.jpg" alt="User Image" class="members__img"> whisky_n_powder <span>183</span></li>

                        <li class="members__user" tabindex="0">3. <img src="img/user-3.jpg" alt="User Image" class="members__img"> oldcatlady <span>179</span></li>

                        <li class="members__user" tabindex="0">4. <img src="img/user-4.jpg" alt="User Image" class="members__img"> TriggerWarning <span>142</span></li>

                        <li class="members__user" tabindex="0">5. <img src="img/user-5.jpg" alt="User Image" class="members__img"> deere_green69 <span>137</span></li>

                        <li class="members__user" tabindex="0">6. <img src="img/user-6.jpg" alt="User Image" class="members__img"> crazyJoe <span>111</span></li>

                        <li class="members__user" tabindex="0">7. <img src="img/user-default.jpg" alt="User Image" class="members__img"> shroomguy83 <span>109</span></li>

                        <li class="members__user" tabindex="0">8. <img src="img/user-7.jpg" alt="User Image" class="members__img"> moldy_pickle <span>88</span></li>

                        <li class="members__user" tabindex="0">9. <img src="img/user-default.jpg" alt="User Image" class="members__img"> city2farm <span>81</span></li>

                        <li class="members__user" tabindex="0">10. <img src="img/user-8.jpg" alt="User Image" class="members__img"> njgorton <span>75</span></li>
                    </ul>

                    <p class="members__top-100" tabindex="0">Top 100 Users</p>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>