<?php
$initJSON = json_decode(file_get_contents("./gemeinden_wahlkreise_ZH.geo.json"), true);

foreach($initJSON["features"] as $key => $gemeinde) {
    $initJSON["features"][$key]["properties"]["gemeinde.JUSO_KANDI"] = 0;
}

file_put_contents("./out-geojson.json", json_encode($initJSON, JSON_UNESCAPED_UNICODE));