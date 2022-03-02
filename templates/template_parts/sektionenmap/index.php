<?php
wp_enqueue_style( 'kandis', get_template_directory_uri() . '/templates/template_parts/kandimap/style.css' );
wp_enqueue_script( 'kandis', get_template_directory_uri() . '/templates/template_parts/kandimap/script.js', array('jquery'), '1.0.0', false );
?>

<div id="sektionenmap-container">
    <div id="sektionenmap-outer">
        <div id="sektionenmap-inner">
            <?=
            file_get_contents(__DIR__ . "/img/sektionenmap.svg");
            ?>
        </div>
    </div>
</div>

<?php
$query = array(
    'posts_per_page'   => -1,
    'post_type' => 'sections',
    'post_status' => 'publish'
);
$sections_query = new WP_Query( $query );

while($sections_query->have_posts()) :
    $sections_query->the_post();
?>

<div class="section" id="<?= $post->post_name ?>">
    <h3><?= the_title() ?></h3>
    <?= the_content() ?>
</div>
    
    
<?php
endwhile;
wp_reset_postdata();
?>