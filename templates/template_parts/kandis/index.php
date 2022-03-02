<div style="margin-top: 1.5rem; margin-bottom: 1.5rem">

<div class="kandigrid">

<?php

$query = array(
    'posts_per_page'   => -1,
    'post_type' => 'kandidierende',
    'post_status' => 'publish',
    'order' => 'ASC',
    'orderby' => 'title',
    'tax_query' => array(
        array(
            'taxonomy' => 'sektion',
            'field'    => 'slug',
            'terms'    => $args["sektion"],
        ),
    ),
);
$kandi_query = new WP_Query( $query );

while($kandi_query->have_posts()) :
    $kandi_query->the_post();
    include __DIR__ . "/../../../interfaces/kandi/kandi.php";
    endwhile;
    wp_reset_postdata();
?>

</div>
</div>