<!DOCTYPE html>
<html lang="de" class="<?php (is_front_page()) ? print("ds1") : print("ds" . rand(1,4)); ?>">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, minimum-scale=1.0">
    <?php
    wp_head()
    ?>
</head>
<body>