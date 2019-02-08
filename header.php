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
<nav class="nav">
    <ul class="nav__list">
        <li class="nav__item"><a href="<?php echo esc_url(site_url('/')); ?>" id="home" class="nav__link">Home</a></li>
        <li class="nav__item"><a href="<?php echo get_post_type_archive_link('news'); ?>" class="nav__link">News</a></li>
        <li class="nav__item"><a href="<?php echo get_post_type_archive_link('events'); ?>" class="nav__link">Events</a></li>
        <li class="nav__item"><a href="#" class="nav__link">Forum</a></li>
        <li class="nav__item"><a href="<?php echo esc_url(site_url('/about-ogn')); ?>" class="nav__link">About</a></li>
    </ul>

    <div class="nav__user-menu">
        <a class="nav__search js-search-trigger" href="<?php echo esc_url(site_url('/search')); ?>">
            <i class="fas fa-search"></i>
        </a> 

        <?php if(is_user_logged_in()) { ?>

            <a href="#" class="nav__user-profile"> 
                <span class="nav__user-img"><?php echo get_avatar(get_current_user_id(), 40); ?></span>

                <span class="nav__user-name">
                    <?php 
                        $current_user = wp_get_current_user();
                        echo $current_user->display_name;
                    ?>
                </span>                             
            </a>  
            <a href="<?php echo wp_logout_url(); ?>" class="nav__userBtn nav__userBtn--logout">Log out?</a>

          <?php } else { ?>

            <a href="<?php echo wp_login_url(); ?>" class="nav__userBtn nav__userBtn--login">Login</a>  
            <a href="<?php echo wp_registration_url(); ?>" class="nav__userBtn nav__userBtn--signup">Sign Up!</a>  
             
          <?php } ?>                                               
    </div>

    <div class="nav__mobile">
        <a id="nav-toggle" href="#!"><span></span></a>
    </div>
</nav>