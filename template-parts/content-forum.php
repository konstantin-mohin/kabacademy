<?php
/**
 * Template part for displaying page content in forum.php
 *
 * @package kabacedemy
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'article', 'online-club' ) ); ?>>
  <div class="container">
    <div class="article__container">

      <?php get_sidebar( 'mak-second' ); ?>

      <section class="article-content">
        <div class="breadcrumbs">
          <div class="breadcrumbs__item"> 
            <a href="#">Главная</a>
              <div class="breadcrumbs__separate"> 
                <svg width="4" height="8" viewBox="0 0 4 8"
                xmlns="http://www.w3.org/2000/svg">
                <path d="M.894 6.545l2.558-2.559L.805 1.337" fill="none" stroke="currentColor"
                  stroke-linecap="round" stroke-linejoin="round" /> </svg> </div>
            </div>
          <div class="breadcrumbs__item"> 
            <span>Самообразование</span>
            <div class="breadcrumbs__separate"> 
              <svg width="4" height="8" viewBox="0 0 4 8"
                xmlns="http://www.w3.org/2000/svg">
                <path d="M.894 6.545l2.558-2.559L.805 1.337" fill="none" stroke="currentColor"
                  stroke-linecap="round" stroke-linejoin="round" /> 
                </svg> 
              </div>
          </div>
        </div>

        <div class="online-club__content">
          <div class="online-club__background"> 
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/static/img/assets/online-club/forum.jpg" alt="<?php the_title(); ?>">
          </div>

          <?php the_title('<h1 class="online-club__title-main">', '</h1>'); ?>
          
          <div class="forum">

            <?php the_content(); ?>

          </div>

        </div>
      </section>
    </div>
  </div>
</article>