<?php
wp_enqueue_style( 'frontpage', get_template_directory_uri() . '/public/style/pages/frontpage.css' );
wp_enqueue_script( 'frontpage', get_template_directory_uri() . '/public/js/pages/frontpage.js', array('jquery'), '1.0.0', false );
get_header()
?>

<div id="heroine">
    <img src="<?= get_template_directory_uri() ?>/public/img/geruest.png" alt="Baugerüst" id="geruest">
    <div class="claim" id="bg">
        <?=
        file_get_contents(__DIR__ . "/public/img/frontpage/claim.svg");
        ?>
    </div>
    <div class="claim" id="fg">
        <?=
        file_get_contents(__DIR__ . "/public/img/frontpage/claim.svg");
        ?>
    </div>
</div>


<?php
get_footer()
?>