<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<!-- ============================HEADER================================ -->
<header class="header">
    <h1 class="header__heading-primary">The Off-Grid Network</h1>
    <h2 class="header__heading-secondary">Where homesteaders get connected, and off-grid meets community.</h2>
</header>

<!-- ==========================NAVIGATION============================== -->
<nav class="navigation">
    <div class="navigation__search">
        <input type="search" class="search-text" placeholder="Search the site..." aria-label="Search through site content">
        <button type="submit" class="search-btn">
            <i class="fas fa-search"></i>
        </button>
    </div>
    
    <div class="navigation__user-profile">
        <p class="user-text">Logged in as:</p>
        <p class="user-name" tabindex="0">njgorton</p>
        <img src="<?php bloginfo('stylesheet_directory');?>/assets/img/user-img.jpg" alt="User's profile Image" class="user-img" tabindex="0">
        <div class="user-menu">                                  
            <i class="fas fa-caret-square-down user-menuIcon" tabindex="0"></i>
            <span class="user-menuBadge">2</span>   
        </div>                                                  
    </div>

    <div class="navigation__mobile">
        <a id="nav-toggle" href="#!"><span></span></a>
    </div>

    <ul class="navigation__list">
        <li class="navigation__item"><a href="<?php echo site_url('/'); ?>" id="home" class="navigation__link">Home</a></li>
        <li class="navigation__item"><a href="<?php echo get_post_type_archive_link('news'); ?>" class="navigation__link">News</a></li>
        <li class="navigation__item"><a href="<?php echo get_post_type_archive_link('events'); ?>" class="navigation__link">Events</a></li>
        <li class="navigation__item"><a href="#" class="navigation__link">Forum</a></li>
        <li class="navigation__item"><a href="<?php echo site_url('/about-ogn'); ?>" class="navigation__link">About</a></li>
    </ul>
</nav>