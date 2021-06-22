jQuery(document).ready(function($) {
    setTimeout(function() {
        $('.wcf-order-wrap .cart-final__agree #cart-agree').click();
    },2500);


    var generatePassword = (
        length = 14,
        wishlist = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz!@#$"
    ) => Array(length)
        .fill('')
        .map(() => wishlist[Math.floor(crypto.getRandomValues(new Uint32Array(1))[0] / (0xffffffff + 1) * wishlist.length)])
        .join('');

    $('#account_password').val(generatePassword());

    $('.woocommerce-billing-fields h3').text('Шаг #1 Контактная информация');

  });