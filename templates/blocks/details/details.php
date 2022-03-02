<?php
wp_enqueue_style( 'details-block', get_template_directory_uri() . '/templates/blocks/details/style.css' );
wp_enqueue_script( 'details-block', get_template_directory_uri() . '/templates/blocks/details/script.js', array('jquery'), '1.0.0', false );

/**
 * Details Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

$id = 'juso-details-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

$className = 'juso-details';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <h5 class="juso-details-title"><?= the_field("title") ?></h5>
    <div class="juso-details-container <?= the_field("height") ?>">
        <div class="juso-details-inner">
            <?= the_field("content") ?>
        </div>
    </div>
    <span class="juso-details-read-more">Weiterlesen</span>
</div>