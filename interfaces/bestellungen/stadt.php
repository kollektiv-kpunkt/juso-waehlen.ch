<?php
header("content-type: application/json");
require __DIR__ . ("/../../../../../wp-load.php");

if (!isset($_POST["optin"])) {
    $optin = 0;
} else {
    $optin = 1;
}

$content = json_encode(array_filter($_POST["bestellung"], function($item) {
    return $item != 0;
}));

$hosturl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER["HTTP_HOST"]}";

$message = <<<EOD
Hallo!<br><br>
Es gab eine neue Materialbestellung von {$_POST["fname"]} {$_POST["lname"]}.<br><br>
Du kannst sie hier anschauen: <a href="{$hosturl}/wp-content/themes/jusowaehlen/interfaces/frontend/bestellungen?uuid={$_POST["uuid"]}">{$hosturl}/wp-content/themes/jusowaehlen/interfaces/frontend/bestellungenuuid={$_POST["uuid"]}</a>.<br><br>
bei Fragen, wende dich an Timothy!<br>
Grüessli
EOD;


$mailstatus = wp_mail( array("timothy@kpunkt.ch", "info@jusozueri.ch"), "Neue Bestellung von {$_POST["fname"]} {$_POST["lname"]}", $message, array('Content-Type: text/html; charset=UTF-8'));

if ($mailstatus != 1){
    $return = [
        "code" => 500.1,
        "message" => "Fehler im Mailversand. Bitte versuch es nochmals."
    ];
    echo (json_encode($return));
    exit;
}

$dbstatus = $wpdb->insert('wp_bestellungen', array(
    'UUID' => $_POST["uuid"],
    'bestellung_sektion' => $_POST["sektion"],
    'bestellung_fname' => $_POST["fname"],
    'bestellung_lname' => $_POST["lname"],
    'bestellung_email' => $_POST["email"],
    'bestellung_address' => $_POST["address"],
    'bestellung_plz' => $_POST["plz"],
    'bestellung_ort' => $_POST["ort"],
    'bestellung_optin' => $optin,
    'bestellung_content' => $content
));

if ($dbstatus == 1) {
    $return = [
        "code" => 200,
        "message" => "Danke für deine Bestellung! Wir werden sie dir so schnell wie möglich schicken."
    ];
    echo (json_encode($return));
}