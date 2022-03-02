<?php
require __DIR__ . ("/../../../../../../wp-load.php");

if (!is_user_logged_in()) {
    $actual_host = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER["HTTP_HOST"];
    $redirect = urlencode((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
    header("Location: {$actual_host}/wp-login.php?redirect_to={$redirect}");
    exit;
}
get_header("bestellung");
wp_enqueue_style( 'bestellbestaetigung', get_template_directory_uri() . '/interfaces/frontend/bestellungen/style.css' );
wp_enqueue_script( 'html2pdf', "https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js", array('jquery'), '1.0.0', false);
wp_enqueue_script( 'bestellbestaetigung', get_template_directory_uri() . '/interfaces/frontend/bestellungen/app.js', array('jquery'), '1.0.0', false);

if (isset($_GET["uuid"])) {
    include __DIR__ . "/views/single.php";
} else if (isset($_GET["sektion"])) {
    include __DIR__ . "/views/sektion.php";
}


get_footer();
?>