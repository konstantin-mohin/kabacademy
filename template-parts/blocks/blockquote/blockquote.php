<?php

/**
 * Blockquote Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'blockquote-' . $block['id'];

if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'article-content__blockquote';

if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assing defaults.
$text = get_field('blockquote') ?: 'Текст ...';
?>

<blockquote id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>"> 
    <svg class="icon__icon-warning" width="28"
        height="25">
        <use href="/svg-symbols.svg#icon-warning"></use>
    </svg>
    <p>
      <?php echo $text; ?>
    </p>
</blockquote>