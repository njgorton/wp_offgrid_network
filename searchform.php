<form class="wp-search__form" method="GET" action="<?php echo esc_url(site_url('/')); ?>">
    <label class="wp-search__label" for="s">Perform a New Search:</label>
    
    <div class="wp-search__inputBox">
        <input class="wp-search__searchInput" type="search" id="s" name="s" placeholder="What are you looking for?">
        <input class="wp-search__searchSubmit" type="submit" value="Search">
    </div>
</form>