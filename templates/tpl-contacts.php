<?php
/**
 * Template Name: Страница "Контакты"
 */

get_header(); ?>

    <div class="contact">
        <div class="container">

			<?php the_title( '<h1 class="contact__head">', '</h1>' ); ?>

			<?php
			while ( have_posts() ) : the_post();
				get_template_part( 'template-parts/content', 'contact' );
			endwhile;
			?>


        </div>
    </div>

    <!--
	todo уточнить что делать с этой формой
	Перенести в шорткод? -->
    <div class="subscription">
        <div class="container">
            <form action="http://kabacademy.com/newsletter/input.php" method="POST" class="subscription__form">
                <div class="subscription__form__title">Подпишись<br>на нашу рассылку</div>
                <div class="form-group">
                    <label class="form-label">
                        <input name="name"> <span>Ваше имя</span>
                    </label>
                    <label class="form-label">
                        <input type="email" name="name">
                        <span>Ваше e-mail</span>
                    </label>
                </div>
                <button class="btn subscription__form__button">запишись сейчас!</button>
            </form>
        </div>
    </div>

<?php get_footer(); ?>