<?php
$imgdir = get_template_directory_uri() . "/templates/template_parts/bestellformular/stadt/img/";
?>

<div class="bestellformular">
    <h3>Bestell unser Material!</h3>
    <p>Wir haben für dich ganz viel Material: Du kannst für unsere Kandidierenden Postkarten und Plakate bestellen.</p>
    <form action="#" class="ajax-form" data-interface="bestellungen/stadt.php">
        <div class="step visible" data-step="1">
            <input type="hidden" name="sektion" value="stadt">
            <h4 style="margin-bottom: 1rem">Postkarten</h4>
            <div class="productgrid">
                <?php
                $products = array(
                    [
                        "ID" => "pk-1+2",
                        "description" => "Postkarte Kreis 1&2",
                        "img" => "pk-1+2-quer.jpg",
                        "alt" => "Postcard for candidates in Zürich 1&2"
                    ],
                    [
                        "ID" => "pk-3",
                        "description" => "Postkarte Kreis 3",
                        "img" => "pk-3-hoch.jpg",
                        "alt" => "Postcard for candidates in Zürich 3"
                    ],
                    [
                        "ID" => "pk-4+5",
                        "description" => "Postkarte Kreis 4&5",
                        "img" => "pk-4+5-hoch.jpg",
                        "alt" => "Postcard for candidates in Zürich 4&5"
                    ],
                    [
                        "ID" => "pk-6",
                        "description" => "Postkarte Kreis 6",
                        "img" => "pk-6-quer.jpg",
                        "alt" => "Postcard for candidates in Zürich 6"
                    ],
                    [
                        "ID" => "pk-7+8",
                        "description" => "Postkarte Kreis 7&8",
                        "img" => "pk-7+8-hoch.jpg",
                        "alt" => "Postcard for candidates in Zürich 7&8"
                    ],
                    [
                        "ID" => "pk-9",
                        "description" => "Postkarte Kreis 9",
                        "img" => "pk-9-quer.jpg",
                        "alt" => "Postcard for candidates in Zürich 9"
                    ],
                    [
                        "ID" => "pk-10",
                        "description" => "Postkarte Kreis 10",
                        "img" => "pk-10-quer.jpg",
                        "alt" => "Postcard for candidates in Zürich 10"
                    ],
                    [
                        "ID" => "pk-11",
                        "description" => "Postkarte Kreis 11",
                        "img" => "pk-11-hoch.jpg",
                        "alt" => "Postcard for candidates in Zürich 11"
                    ],
                    [
                        "ID" => "pk-12",
                        "description" => "Postkarte Kreis 12",
                        "img" => "pk-12-hoch.jpg",
                        "alt" => "Postcard for candidates in Zürich 12"
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
            <h4 style="margin-top: 2rem;">Plakate</h4>
            <p style="margin-bottom: 1rem"><small><i>Bitte Plakate nur an dafür vorgesehenen Stellen aufhängen.</i></small></p>
            <div class="productgrid">
                <?php
                $products = array(
                    [
                        "ID" => "plakat-themen",
                        "description" => "Themenplakat",
                        "img" => "plakat-themen-hoch.jpg",
                        "alt" => "Poster for our topics"
                    ],
                    [
                        "ID" => "plakat-1+2",
                        "description" => "Plakat Kreis 1&2",
                        "img" => "plakat-1+2-quer.jpg",
                        "alt" => "Poster for candidates in Zürich 1&2"
                    ],
                    [
                        "ID" => "plakat-3",
                        "description" => "Plakat Kreis 3",
                        "img" => "plakat-3-hoch.jpg",
                        "alt" => "Poster for candidates in Zürich 3"
                    ],
                    [
                        "ID" => "plakat-4+5",
                        "description" => "Plakat Kreis 4&5",
                        "img" => "plakat-4+5-hoch.jpg",
                        "alt" => "Poster for candidates in Zürich 4&5"
                    ],
                    [
                        "ID" => "plakat-7+8",
                        "description" => "Plakat Kreis 7&8",
                        "img" => "plakat-7+8-hoch.jpg",
                        "alt" => "Poster for candidates in Zürich 7&8"
                    ],
                    [
                        "ID" => "plakat-9",
                        "description" => "Plakat Kreis 9",
                        "img" => "plakat-9-quer.jpg",
                        "alt" => "Poster for candidates in Zürich 9"
                    ],
                    [
                        "ID" => "plakat-10",
                        "description" => "Plakat Kreis 10",
                        "img" => "plakat-10-quer.jpg",
                        "alt" => "Poster for candidates in Zürich 10"
                    ],
                    [
                        "ID" => "plakat-11",
                        "description" => "Plakat Kreis 11",
                        "img" => "plakat-11-hoch.jpg",
                        "alt" => "Poster for candidates in Zürich 11"
                    ],
                    [
                        "ID" => "plakat-12",
                        "description" => "Plakat Kreis 12",
                        "img" => "plakat-12-hoch.jpg",
                        "alt" => "Poster for candidates in Zürich 12"
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