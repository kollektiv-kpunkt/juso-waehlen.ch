<?php
$initJSON = json_decode(file_get_contents("./gemeinden_wahlkreise_kandis_ZH.geo.json"), true);

$file = fopen("sektionen.csv", "r");
$i=0;
while (($line = fgetcsv($file)) !== FALSE) {
    $zuornung[$i] = $line;
    $i++;
}
fclose($file);

foreach($initJSON["features"] as $key => $gemeinde) {
    $bfs = $gemeinde["properties"]["gemeinde.BFS_NUMMER"];
    $sektion = array_values(array_filter($zuornung, function($zeile) use ($bfs){
        return $zeile[2] == $bfs;
    }))[0][0];
    $initJSON["features"][$key]["properties"]["gemeinde.JUSO_SEKTION"] = $sektion;
}

file_put_contents("./out-geojson.json", json_encode($initJSON));