<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package kabacedemy
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <meta content="telephone=no" name="format-detection">
    <!-- This make sence for mobile browsers. It means, that content has been optimized for mobile browsers -->
    <meta name="HandheldFriendly" content="true">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <link rel="preload" href="<?php echo get_stylesheet_directory_uri(); ?>/static/fonts/Open-Sans/OpenSans-Light.woff2"
          as="font" type="font/woff2" crossorigin="anonymous"/>
    <link rel="preload"
          href="<?php echo get_stylesheet_directory_uri(); ?>/static/fonts/Montserrat-SemiBold/Montserrat-SemiBold.woff2"
          as="font" type="font/woff2" crossorigin="anonymous"/>
    <link rel="preload"
          href="<?php echo get_stylesheet_directory_uri(); ?>/static/fonts/Montserrat-Bold/Montserrat-Bold.woff2"
          as="font" type="font/woff2" crossorigin="anonymous"/>
    <link rel="preload"
          href="<?php echo get_stylesheet_directory_uri(); ?>/static/fonts/Montserrat-Light/Montserrat-Light.woff2"
          as="font" type="font/woff2" crossorigin="anonymous"/>
    <link rel="preload"
          href="<?php echo get_stylesheet_directory_uri(); ?>/static/fonts/Montserrat-Medium/Montserrat-Medium.woff2"
          as="font" type="font/woff2" crossorigin="anonymous"/>
    <link rel="preload"
          href="<?php echo get_stylesheet_directory_uri(); ?>/static/fonts/Open-Sans/OpenSans-SemiBold.woff2" as="font"
          type="font/woff2" crossorigin="anonymous"/>
    <link rel="preload"
          href="<?php echo get_stylesheet_directory_uri(); ?>/static/fonts/Montserrat-Regular/Montserrat-Regular.woff2"
          as="font" type="font/woff2" crossorigin="anonymous"/>

	<?php wp_head(); ?>
</head>

<body <?php body_class( 'page' ); ?>>
<?php wp_body_open(); ?>


<div class="header-menu__sticky js-sticky-menu">
    <div class="header-menu__sticky__bg js-sticky-bg"></div> 
    <div class="container">
        <div class="header-menu__container">
            <a class="header-menu__logo" href="/">
                <svg class="header-menu__logo__icon" width="21" height="40">
                    <use href="/svg-symbols.svg#logo-icon-white"></use>
                </svg>
            </a>

			<?php
			wp_nav_menu( [
				'theme_location' => 'top_header',
				'container'      => false,
				'menu_class'     => 'header-menu__list',
				'echo'           => true,
				'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
				'walker'         => new Top_Header_Walker(),
			] );
			?>

			<?php $top_header_btn = get_field( 'mp_button', 'option' );
			if ( ! empty( $top_header_btn ) ) { ?>
                <a href="<?php echo esc_url( $top_header_btn['mp_button_link'] ); ?>" target="_blank"
                   class="header-menu__button btn btn--bold btn--upper">
					<?php echo esc_html( $top_header_btn['mp_button_name'] ); ?>
                </a>
			<?php } ?>

        </div>
    </div>
</div>
<header class="header">
    <div class="container">
        <div class="header__container">
            <div class="header__left">
                <a class="header__logo" href="<?php echo home_url(); ?>">
                    <svg class="header__logo__icon" width="168" height="35">
                        <use href="/svg-symbols.svg#logo-text"></use>
                    </svg>
                </a>
                <div class="header__text">
                    <span>Вебинары, курсы, <br>сообщество</span>
                    <span>Знакомься, изучай,<br>практикуй</span>
                </div>
                <button class="header__burger js-burger" type="button">
                    <svg viewBox="0 0 32 27" xmlns="http://www.w3.org/2000/svg">
                        <rect width="32" height="5"/>
                        <rect y="11" width="32" height="5"/>
                        <rect y="22" width="32" height="5"/>
                    </svg>
                </button>
            </div>

            <div class="header__right header__login__user-hover">

				<?php if ( is_user_logged_in() ) {
					get_template_part( 'template-parts/personal-area/area', 'logged' );
				} else { ?>

                    <button class="header__login js-modal-open"
                            data-target="modalLogin" type="button">
                        <svg class="header__login__icon" width="29" height="29">
                            <use href="/svg-symbols.svg#icon-login"></use>
                        </svg>
                        <span>Войти <br>на сайт</span>
                    </button>

					<?php
					get_template_part( 'template-parts/personal-area/area', 'login' );

					get_template_part( 'template-parts/personal-area/area', 'registration' );
					?>

				<?php } ?>

                <div class="modal__shadow"></div>
            </div>
        </div>
    </div>
</header>
<main class="main">