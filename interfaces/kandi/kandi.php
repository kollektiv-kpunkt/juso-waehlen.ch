<?php
$names = explode(" ", get_the_title());
$nameclass = "";
foreach ($names as $name) {
    if (strlen($name) >= 9) {
        $nameclass = " longname";
    }
}
$pronomen = get_field("pronomen");
?>

<div class="kandi">
    <img src="<?= wp_get_attachment_image_src( get_field("portrait"), 'medium_large' )[0]; ?>" alt="<?= the_title()?>, Kandidat:in <?= get_the_terms( $post->ID, 'gemeinde' )[0]->name ?>" class="kandi-portrait">
    <h4 class="kandi-name<?=$nameclass?>"><?= the_title()?></h4>
    <p class="kandi-gemeinde"><?= get_the_terms( $post->ID, 'gemeinde' )[0]->name ?></p>
    <div class="kandi-info-container">
        <div class="kandi-infos">
            <h1 class="kandi-info-name"><?= the_title()?></h1>
            <p class="kandi-info-subtitle"><?= the_field("job") ?>, <?= get_the_terms( $post->ID, 'gemeinde' )[0]->name ?>, <?= the_field("jahrgang") ?><?php ($pronomen) ? print(", " . $pronomen) : ""; ?></p>
            <p class="kandi-info-quote">«<?= trim(strip_tags(get_the_content())) ?>»</p>
            <i class="fas fa-times kandi-info-close"></i>
        </div>
    </div>
    <div class="kandi-infos-placeholder"></div>
</div>