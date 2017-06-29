<?php

$dbServer = "localhost";
$dbUser = "root";
$dbPass = "";
$dbKoneksi = mysql_connect($dbServer, $dbUser, $dbPass);
$dbName = "image_search";
mysql_select_db($dbName);
?>