<?php

require_once __DIR__ . '/vendor/autoload.php';

use mcordingley\LinearAlgebra\Matrix;

include './cndb/db.php';

$count_impressions = 7;
$count_color = 33;

$query = "SELECT id, impressions_id FROM images";
$res = mysql_query($query);

$image_impressions = array();
$image_color = array();

$i = 0;
while ($row = mysql_fetch_array($res)) {

    for ($j = 0; $j < $count_impressions; $j++) {
        if ($row['impressions_id'] == ($j + 1)) {
            $image_impressions[$i][$j] = 1;
        } else {
            $image_impressions[$i][$j] = 0;
        }
    }

    $q = "SELECT count FROM feature_image WHERE image_id = '" . $row['id'] . "'";
    $r = mysql_query($q);

    $image_color[$i] = array();
    $j = 0;
    while ($row1 = mysql_fetch_array($r)) {
        $image_color[$i][$j] = $row1['count'];
        $j++;
    }
    $i++;
}

echo "<pre>";
//var_dump($image_color);
//var_dump($image_impressions);

$A = new Matrix($image_impressions);
$A = $A->transpose();

$B = new Matrix($image_color);

$C = $A->multiply($B);
var_dump($C);

?>
