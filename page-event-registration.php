<?php get_header(); ?>

<main class="event-registration">
    <?php
    while(have_posts()) {
        the_post(); ?>

    <h2 class="event-registration__heading">OGN<br><?php the_title(); ?></h2>

    <form class="event-registration__form">
        <div class="event-registration__pickEvent">
            <label for="event"><sup>*</sup> Which event will you be attending?</label>
            <select required name="event">
                <option id="disabled" disabled selected>Select an event</option>

                <?php
                $today = date('Ymd');
                $event = new WP_Query(array(
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
                while ($event->have_posts()) {
                $event->the_post(); 
                ?>

                    <option value="<?php the_title(); ?>">
                    <?php 
                        $eventDate = new DateTime(get_field('event_date'));

                        echo the_title() . ' - ' .  $eventDate->format('M jS, Y');
                    ?>
                    </option>

                <?php } wp_reset_postdata(); ?>
            </select>
        </div>

        <fieldset class="event-registration__fieldset event-registration__fieldset--left">                
            <div class="event-registration__inputBox">
                <label for="email"><sup>*</sup> Email: </label>
                <input type="email" name="email" placeholder="Your email" required>
            </div>

            <div class="event-registration__inputBox">
                <label for="first-name"><sup>*</sup> First Name: </label>
                <input type="text" name="first-name" placeholder="Your first name" required">
            </div>
            
            <div class="event-registration__inputBox">
                <label for="last-name"><sup>*</sup> Last Name: </label>
                <input type="text" name="last-name" placeholder="Your last name" required>
            </div>

            <div class="event-registration__inputBox">
                <label for="address">Address: </label>
                <input type="text" name="address" placeholder="Your address">
            </div>

            <div class="event-registration__inputBox">
                <label for="city">City: </label>
                <input type="text" name="city" placeholder="Your city">
            </div>

            <div class="event-registration__inputBox">
                <label for="country">Country: </label>
                <input type="text" name="country" placeholder="Your country">
            </div>

            <div class="event-registration__inputBox">
                <label for="telephone">Phone: </label>
                <input type="tel" name="telphone" placeholder="Your phone number">
            </div>
            
            <div class="event-registration__inputBox event-registration__inputBox--stacked">
                <p>What is your preffered method of contact?</p>

                <div>
                    <div class="event-registration__options">
                        <label for="email">
                        <input id="email" type="radio" name="radio" value="1"><span>Email</span></label>
                    </div>

                    <div class="event-registration__options">
                        <label for="phone">
                        <input id="phone" type="radio" name="radio"value="2"><span>Phone</span></label>
                    </div>

                    <div class="event-registration__options">
                        <label for="text">
                        <input id="text" type="radio" name="radio" value="3"><span>Text</span></label>
                    </div>
                </div>
            </div>

            <div class="event-registration__inputBox event-registration__inputBox--stacked">
                <p><sup>*</sup> Have you ever attended any of OGN's past events?</p>

                <div>
                    <div class="event-registration__options">
                        <label for="yes">
                        <input id="yes" type="radio" name="radio" value="yes"><span>Yes</span></label>
                    </div>

                    <div class="event-registration__options">
                        <label for="no">
                        <input id="no" type="radio" name="radio"value="no"><span>No</span></label>
                    </div>
                </div>
            </div>
        </fieldset>

        <fieldset class="event-registration__fieldset event-registration__fieldset--right">

            <h3>Optional:</h3>
            
            <div class="event-registration__inputBox event-registration__inputBox--stacked">
                <label for="describe">How would you best describe yourself?</label>
                <select name="describe">
                    <option id="generic-selected" disabled selected>Select an option</option>
                    <option value="1">Grids are for CSS!</option>
                    <option value="2">Off-Grid Veteran</option>
                    <option value="3">Getting Off-Grid</option>
                    <option value="4">Interested in Off-Grid Living</option>
                    <option value="5">Just Here to Learn Cool Stuff</option>
                    <option value="6">Prefer Not to Say</option>
                    <option value="7">Other</option>
                </select>
            </div>

            <div class="event-registration__checkBoxes">
                <p>What kind of events or workshops would you like OGN to curate in the future?<br>(Check all that apply)</p>

                <div class="event-registration__checkOptions">
                    <div class="event-registration__options">
                        <label><input type="checkbox" name="check" value="1">
                            <span>Agriculture</span>
                        </label>
                    </div>

                    <div class="event-registration__options">
                        <label><input type="checkbox" name="check" value="2">
                            <span>Animal Husbandry</span>
                        </label>
                    </div>

                    <div class="event-registration__options">
                        <label><input type="checkbox" name="check" value="3">
                            <span>Poultry</span>
                        </label>
                    </div>

                    <div class="event-registration__options">
                        <label><input type="checkbox" name="check" value="4">
                            <span>Livestock</span>
                        </label>
                    </div>

                    <div class="event-registration__options">
                        <label><input type="checkbox" name="check" value="5">
                            <span>Permaculture</span>
                        </label>
                    </div>

                    <div class="event-registration__options">
                        <label><input type="checkbox" name="check" value="6">
                            <span>Power and electricty</span>
                        </label>
                    </div>

                    <div class="event-registration__options">
                        <label><input type="checkbox" name="check" value="7">
                            <span>Water and Plumbing</span>
                        </label>
                    </div>

                    <div class="event-registration__options">
                        <label><input type="checkbox" name="check" value="8">
                            <span>Land and Legal</span>
                        </label>
                    </div>

                    <div class="event-registration__options">
                        <label><input type="checkbox" name="check" value="9">
                            <span>Homesteading Skills and Past-times</span>
                        </label>
                    </div>

                    <div class="event-registration__options">
                        <label><input type="checkbox" name="check" value="10">
                            <span>Alternative Fuels and Transportation</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="event-registration__comments">
                <label for="comments">We're always looking for ways to improve OGN. Feel free to leave us any comments!</label>
                <textarea id="comments" name="comments" placeholder="Enter your comments here..."></textarea>
            </div>
        </fieldset>
        
        <a href="#popup" class="event-registration__submit call-out-btn" id="submit" type="submit">Submit!</a>
    </form>
        
    <div class="paired-btnBox">
            <a href="<?php echo site_url('/'); ?>" class="paired-btn" id="pageNav"><i class="fas fa-home"></i>&nbsp; Home</a>
            <a href="<?php echo get_post_type_archive_link('events'); ?>" class="paired-btn" id="pageNav"><i class="far fa-calendar-alt"></i>&nbsp; Events</a>
    </div>

    <!-- Confirmation Modal Popup -->
    <div class="popup" id="popup">
        <div class="popup__content">
            <h3 class="popup__heading">Thanks for signing up!</h3>

            <hr class="hr_style_1">
            
            <p class="popup__text">A confirmation email will be sent to you shortly, with everything you need to know about the event.</p>

            <p class="popup__text">(...but not really. This is a fake website. Nothing happened. Please don't show up to any events or you will be very alone and embarassed. That would be awkward.)</p>

            <div class="paired-btnBox">
                <a href="<?php echo site_url('/'); ?>" class="paired-btn"><i class="fas fa-home"></i>&nbsp; Home</a>
                <a href="<?php echo get_post_type_archive_link('events'); ?>" class="paired-btn"><i class="far fa-calendar-alt"></i>&nbsp; Events</a>
            </div>
        </div>
    </div>

    <?php } ?>
</main>

<?php get_footer(); ?>