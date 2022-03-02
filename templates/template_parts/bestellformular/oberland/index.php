<?php
$imgdir = get_template_directory_uri() . "/templates/template_parts/bestellformular/oberland/img/";
?>

<div class="bestellformular">
    <h3>Bestell unser Material!</h3>
    <p>Wir haben für dich ganz viel Material: Bestell es gratis und hilf uns dabei, die Wahlen im Zürcher Oberland zu gewinnen!</p>
    <form action="#" class="ajax-form" data-interface="bestellungen/oberland.php">
        <div class="step visible" data-step="1">
            <input type="hidden" name="sektion" value="oberland">
            <div class="productgrid">
                <?php
                $products = array(
                    [
                        "ID" => "flyer-allgemein",
                        "description" => "Flyer mit unseren Themen",
                        "img" => "flyer-allgemein.jpg",
                        "alt" => "Flyer with topics of JUSO Oberland"
                    ],
                    [
                        "ID" => "plakat-themen",
                        "description" => "Plakat mit unseren Themen",
                        "img" => "plakat-themen.jpg",
                        "alt" => "Poster with topics of JUSO Oberland"
                    ],
                    [
                        "ID" => "plakat-grueningen",
                        "description" => "Plakat für Grüningen",
                        "img" => "plakat-grueningen.jpg",
                        "alt" => "Poster for candidate in Grüningen"
                    ],
                    [
                        "ID" => "plakat-pfaeffikon",
                        "description" => "Plakat für Pfäffikon",
                        "img" => "plakat-pfaeffikon.jpg",
                        "alt" => "Poster for candidates in Pfäffikon"
                    ],
                );
                foreach ($products as $product): ?>
                <div class="product">
                    <div class="product-img">
                        <img src="<?= $imgdir . $product["img"] ?>" alt="<?= $product["alt"] ?>">
                    </div>
                    <p class="product-description"><?= $product["description"] ?></p>
                    <div class="picker-group">
                        <input type="number" name="bestellung['<?= $product["ID"] ?>']" id="" class="product-picker" value="0" min="0">
                        <div class="picker-toggle picker-remove"><i class="fas fa-minus"></i></div>
                        <div class="picker-toggle picker-add"><i class="fas fa-plus"></i></div>
                    </div>
                </div>
                <?php
                endforeach;
                ?>
            </div>
            <a class="button step-button product-selection">Weiter</a>
        </div>
        <?php
        include __DIR__ . "/../allg/personal-details.php";
        ?>
    </form>
    <div class="thank-you">Danke für deine Bestellung bla bla</div>
</div>