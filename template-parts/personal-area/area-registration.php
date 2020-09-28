<?php
// check if registration enabled
$general_settings    = get_option( 'eb_general' );
$enable_registration = getArrValue( $general_settings, "eb_enable_registration", "" );

if ( $enable_registration == 'yes' ):
	$fname = getArrValue( $_POST, 'firstname', "" );
	$lname           = getArrValue( $_POST, 'lastname', "" );
	$email           = getArrValue( $_POST, 'email', "" );
	?>

    <div class="modal modal--register" id="modalRegister">
        <button class="modal__close js-modal-close" type="button">
            <svg class="icon__icon-close" width="14" height="14">
                <use href="svg-symbols.svg#icon-close"></use>
            </svg>
        </button>

        <form action="/my-account?action=eb_register" method="POST" class="modal__form">
			<?php
			do_action( 'eb_register_form_start' );
			?>
            <div class="modal__form__title">Регистрация</div>

            <div class="form-group">
                <label class="form-label">
                    <input type="text" name="firstname" id="reg_firstname" value="<?php echo esc_attr( $fname ); ?>"
                           required> <span>Ваше имя</span>
                </label>

                <label class="form-label">
                    <input type="text" name="lastname" id="reg_lastname" value="<?php echo esc_attr( $lname ); ?>"
                           required>
                    <span>Ваша фамилия</span>
                </label>

                <label class="form-label">
                    <input type="email" class="input-text" name="email" id="reg_email"
                           value="<?php echo esc_attr( $email ); ?>" required>
                    <span>Ваш e-mail</span>
                </label>

                <!-- <label class="form-label">
				  <input type="password" name="name"> <span>Ваше пароль</span>
				</label> -->
				<?php
				if ( isset( $general_settings['eb_enable_terms_and_cond'] ) && $general_settings['eb_enable_terms_and_cond'] == "yes" && isset( $general_settings['eb_terms_and_cond'] ) ) {
					?>

                    <p class="form-row form-row-wide">
                        <input type="checkbox" class="input-text" name="reg_terms_and_cond" id="reg_terms_and_cond"
                               required/>
						<?php _e( "I agree to the ", "eb-textdomain" ); ?>
                        <span style="cursor: pointer;" id="eb_terms_cond_check"> <u><?php _e( "Terms and Conditions",
									"eb-textdomain" ); ?></u></span>
                    </p>

                    <div class="eb-user-account-terms">
                        <div id="eb-user-account-terms-content"
                             title="<?php _e( "Terms and Conditions", "eb-textdomain" ) ?>">
							<?=
							$general_settings['eb_terms_and_cond'];
							?>
                        </div>
                    </div>
					<?php
				}
				?>


            </div>

			<?php
			do_action( 'eb_register_form' );
			?>

			<?php wp_nonce_field( 'eb-register' ); ?>

            <button class="btn modal__form__button" name="register">регистрация</button>

            <button type="button" class="link modal__form__link js-modal-open" data-target="modalLogin" type="button">
                войти на сайт
            </button>

			<?php do_action( 'eb_register_form_end' ); ?>
        </form>
    </div>

<?php endif; ?>