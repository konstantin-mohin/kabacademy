<article class="article cabinet">
  <div class="container">
    <div class="cabinet-complete">
      <h1 class="cabinet-info__title">Спасибо!</h1>

        <script>
            jQuery( function($) {
                wiPublic.myCoursesUrl = '<?php echo wc_get_account_endpoint_url( 'my-courses'); ?>';
                $('#wi-thanq-wrapper a').attr( 'href', '<?php echo wc_get_account_endpoint_url( "my-courses"); ?>' );
            } );
        </script>

      <?php the_content(); ?>

    </div>
  </div>
</article>