<?php
require __DIR__ . ("/../../../../../wp-load.php");

$gemeinden = explode(",", $_GET["gemeinden"]);

$args = array(
    'posts_per_page'   => -1,
    'post_type' => 'kandidierende',
    'post_status' => 'publish',
    'order' => 'ASC',
    'orderby' => 'title',
    'tax_query' => array(
        array(
            'taxonomy' => 'gemeinde',
            'field'    => 'slug',
            'terms'    => $gemeinden
        )
    )
);
$kandi_query = new WP_Query( $args );

while($kandi_query->have_posts()) :
$kandi_query->the_post();
    include __DIR__ . "/kandi.php";
endwhile;
?>