<?php
$bestellung = $wpdb->get_row("SELECT * from `wp_bestellungen` WHERE `UUID` = '{$_GET["uuid"]}';", ARRAY_A);

$products = json_decode($bestellung["bestellung_content"], true);
if (count($products) > 8) {
    $tableclass = "klein";
} else if (count($products) > 4) {
    $tableclass = "medium";
} else {
    $tableclass = "";
}

$sektion = $bestellung["bestellung_sektion"];
if ($sektion == "stadt") {
    $l10n = [
        "line1" => "JUSO Stadt und Kanton Zürich",
        "line2" => "Zusammen kämpfen wir für eine linke, queerfeministische und nachhaltige Stadt Zürich",
        "line3" => "Deine JUSO Stadt Zürich"
    ];
} else if ($sektion == "oberland") {
    $l10n = [
        "line1" => "JUSO Zürich Oberland",
        "line2" => "Zusammen kämpfen wir für ein linkes, queerfeministisches und nachhaltiges Zürcher Oberland",
        "line3" => "Deine JUSO Zürich Oberland"
    ];
}
?>

<div id="toggles">
    <div id="actionbuttons">
        <a href="#" class="actionbutton" id="print">Drucken</a>
        <a href="#" class="actionbutton<?php ($bestellung["bestellung_status"] == 2) ? print(" done") : print(""); ?>" id="status">Abschliessen</a>
        <a href="/wp-content/themes/jusowaehlen/interfaces/frontend/bestellungen/?sektion=<?= $sektion ?>" id="back">Sektion</a>
    </div>
</div>

<div id="bestellung-container" data-filename="<?= $bestellung["UUID"] ?>.pdf" data-uuid="<?= $bestellung["UUID"] ?>">
    <div id="bestellung-inner">
        <div id="address-container">
            <small style="margin-bottom: 0.5rem; display: block;"><b><?= $l10n["line1"] ?>,</b><br>Gartenhofstrasse 15, 8004 Zürich, Schweiz</small>
            <?= <<<EOD
            {$bestellung["bestellung_fname"]} {$bestellung["bestellung_lname"]}<br>
            {$bestellung["bestellung_address"]}<br>
            CH-{$bestellung["bestellung_plz"]} {$bestellung["bestellung_ort"]}<br>
            EOD; ?>
        </div>
        <p id="bestellung-title">Deine Bestellung vom <?= date("d.m.y", strtotime($bestellung["bestellung_timestamp"])) ?></p>
        <div id="bestellung-content" style="margin-top: 1.5rem">
            <p id="bestellung-text">
                <b>Liebe*r <?= $bestellung["bestellung_fname"] ?></b><br><br>
                Vielen Dank für deine Bestellung! <?= $l10n["line2"] ?>! du findest in dieser Sendung folgendes:
            </p>
            <table id="bestellung-products" class="<?= $tableclass ?>">
                <tr>
                    <th>Produkt</th>
                    <th>Anzahl</th>
                </tr>
                <?php
                foreach ($products as $key => $product):
                $key = explode("-", $key);
                $name = (($key[0] == "pk") ? "Postkarte " : "Plakat ") . substr($key[1], 0, -1);
                ?>
                <tr>
                    <td><?= $name ?></td>
                    <td><?= $product ?></td>
                </tr>
                <?php
                endforeach;
                ?>
            </table>
            <p>
                Wir haben dir dieser Bestellung einen Einzahlungsschein beigelegt: Natürlich ist das Material für dich gratis. Aber selbst mit einer kleinen Spenden können wir viel erreichen. Danke, dass du dich zusammen mit uns für eine bessere Stadt Zürich engagierst!<br><br>
                Solidarisch,<br>
                <b><?= $l10n["line3"] ?></b>
            </p>
        </div>
    </div>
</div>