<div id="main-navbar">
    <div id="main-nav-inner">
        <?php
        echo(file_get_contents(__DIR__ . "/img/logo.svg"));
        ?>
        <div id="nav-menu-button">
            Menu
        </div>
    </div>
    <div id="main-nav-container">
        <div id="main-nav-content">
            <?php
            $items = get_nav_location("primary");
            foreach ($items as $item) :
            ?>
            <a href="<?= $item->url ?>" class="menu-item"><?= $item->title ?></a>
            <?php
            endforeach;
            ?>
        </div>
    </div>
</div>

<div id="cover"></div>