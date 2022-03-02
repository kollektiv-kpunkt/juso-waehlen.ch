<?php
$bestellungen = $wpdb->get_results("SELECT * FROM `wp_bestellungen` WHERE `bestellung_sektion`='{$_GET["sektion"]}' AND `bestellung_status`=1", ARRAY_A);
?>

<div id="app-container">
    <h1>Materialbestellungen</h1>
    <p>Hier die Liste der offenen Materialbestellungen. Klick auf die Bestellung, um die Details zu sehen und die Bestellung abzuarbeiten.</p>
    <table id="bestellungen-open">
        <tr>
            <th>Bestellung</th>
            <th>Datum</th>
            <th>Vorname</th>
            <th>Nachname</th>
            <th>Adresse</th>
            <th></th>
        </tr>
        <?php
        foreach ($bestellungen as $key => $bestellung):
        ?>
        <tr>
            <td><?= $bestellung["UUID"] ?></td>
            <td><?= date("d.m.y", strtotime($bestellung["bestellung_timestamp"])) ?></td>
            <td><?= $bestellung["bestellung_fname"] ?></td>
            <td><?= $bestellung["bestellung_lname"] ?></td>
            <td><?= $bestellung["bestellung_address"] ?>,<br><?= $bestellung["bestellung_plz"] ?> <?= $bestellung["bestellung_ort"] ?></td>
            <td><a href="/wp-content/themes/jusowaehlen/interfaces/frontend/bestellungen/?uuid=<?=$bestellung["UUID"]?>">Details</a></td>
        </tr>
        <?php
        endforeach;
        ?>
    </table>
</div>