<?php
wp_enqueue_style( 'page', get_template_directory_uri() . '/public/style/pages/page.css' );
// wp_enqueue_script( 'frontpage', get_template_directory_uri() . '/public/js/pages/frontpage.js', array('jquery'), '1.0.0', false );
get_header()
?>
<div id="bg-container">
    <img src="<?= get_template_directory_uri() ?>/public/img/geruest.png" alt="Baugerüst" id="bg-grid">
</div>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <h1 id="page-title"><?= the_title() ?></h1>
    <div id="page-container">
        <?= the_content() ?>
    </div>
    <?php
    get_juso_partial("footer");
    ?>

    <?php endwhile; else: ?>

      <h2><?php esc_html_e( '404 Error', 'phpforwp' ); ?></h2>
      <p><?php esc_html_e( 'Sorry, content not found.', 'phpforwp' ); ?></p>

<?php endif; ?>


<?php
get_footer()
?>