<?php
require __DIR__ . ("/../../../../wp-load.php");

$sektion = $_GET["sektion"];

$args = array(
    'posts_per_page'   => 1,
    'post_type' => 'sections',
    'post_status' => 'publish',
    "name"  => $sektion
);
$sektion_query = new WP_Query( $args );
while($sektion_query->have_posts()) :
    $sektion_query->the_post();
    ?>
    <h3><?= the_title() ?></h3>
    <?= the_content() ?>
    
<?php
    endwhile;
?>