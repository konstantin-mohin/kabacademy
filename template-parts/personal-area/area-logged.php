<div class="header__login__user">
    <div class="header__login__user__top js-user-modal">

		<?php
		$current_user = wp_get_current_user();
		$avatar_url   = get_avatar_url( $current_user->ID );
		$firstname    = get_user_meta( $current_user->ID, 'first_name', true );
		$lastname     = get_user_meta( $current_user->ID, 'last_name', true );
		?>
        <div class="header__login__user__image">
			<?php if ( $avatar_url ): ?>
                <img src="<?= $avatar_url ?>" alt="<?= $current_user->display_name; ?>">
			<?php endif; ?>
        </div>

        <div class="header__login__user__name">
			<?php if ( ! empty( $firstname ) || ! empty( $lastname ) ) {
                if ($lastname != '-') {
				    echo $firstname . ' ' . $lastname;
                } else {
                    echo $firstname;
                }
			} else {
				echo $current_user->display_name;
			} ?>
        </div>


        <!-- <a href="<?= wp_logout_url( home_url() ) ?>" class="header__login__user__logout">
      <svg class="icon__icon-close" width="14" height="14">
        <use href="svg-symbols.svg#icon-close"></use>
      </svg> 
    </a> -->
    </div>


    <div class="header__login__user__menu">
		<?php echo kabacedemy_user_logged_menu(); ?>
    </div>

</div>