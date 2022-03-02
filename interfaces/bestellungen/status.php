<?php
header("content-type: application/json");
require __DIR__ . ("/../../../../../wp-load.php");

$dbstatus = $wpdb->update(
    "wp_bestellungen",
    array(
        "bestellung_status" => 2
    ),
    array(
        "UUID" => $_POST["uuid"]
    )
);

echo $dbstatus;