<?php

include './ColorOfImage/colorsofimage.class.php';

$colorMap = new ColorsOfImage("assets/img/blog_img-01.jpg");
$colors = $colorMap->getPercentageOfColors();
echo "<pre>";
var_dump($colors);
?>
