<div class="modal modal--login" id="modalLogin" <?php echo ( defined( 'USER_FORM_MESSAGE' ) ) ? 'style="display: block;"' : '';  ?> >
    <button class="modal__close js-modal-close" type="button">
        <svg class="icon__icon-close" width="14" height="14">
            <use href="svg-symbols.svg#icon-close"></use>
        </svg>
    </button>


    <form method="post" class="modal__form login">
        <div class="modal__form__title">Авторизация</div>

        <?php //wdmShowNotices(); ?>

        <div class="form-group">
            <label class="form-label">
                <input type="text" name="wdm_username" id="username"> <span>Ваш email</span>
            </label>
            <label class="form-label">
                <input type="password" name="wdm_password" id="password"> <span>Ваш пароль</span>
            </label>
        </div>
        <input type="submit" class="eb-login-button btn modal__form__button" name="wdm_login" value="войти на сайт"/>

        <a class="link modal__form__link" href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'woocommerce' ); ?></a>

        <?php wp_nonce_field( 'eb-login' ); ?>
        <input type="hidden" name="rememberme" value="forever"/>
    </form>

</div>
