<?php

//include './smart_resize_image.function.php';
include './cndb/db.php';
include './ColorCompare/ColorCompare.php';

$target_dir = "assets/img/upload/";
$fileName = basename($_FILES["file"]["name"]);
$target_file = $target_dir . $fileName;
$uploadOk = 1;
$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image

$check = getimagesize($_FILES["file"]["tmp_name"]);
if ($check !== false) {
//    echo "File is an image - " . $check["mime"] . ".<br>";
    $uploadOk = 1;
} else {
    echo "File is not an image.";
    $uploadOk = 0;
}

// Check file size
/*
  if ($_FILES["file"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
  }
 */

// Allow certain file formats

if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}


// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    $image_data = getimagesize($_FILES["file"]["tmp_name"]);
    $width = $image_data[0];
    $height = $image_data[1];
    $size = filesize($_FILES["file"]["tmp_name"]);
    $fileName1 = md5($fileName . $width . $height . $size) . "." . $imageFileType;
    $target_file = $target_dir . $fileName1;

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {

        $query = "INSERT INTO images(file_name, size, location, created_at, updated_at)"
                . "VALUES ('$fileName', '$size', '$target_file', NOW(), NOW())";
        $result = mysql_query($query);
//        var_dump($result);
        if ($result) {
            $imageId = mysql_insert_id();
            $result = ColorCompare::compare(33, $target_file);
//            var_dump($result);
//            die();
            insertingDBColor($imageId, $target_file, $result, 33);
        }
        
        // $sk = edgeDetection($target_file);
//        insertingDBEdge($target_file, $sk);
        echo $target_file;
//        echo "<br>The file " . basename($_FILES["file"]["name"]) . " has been uploaded.<br>";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

function insertingDBColor($imageId, $path, $result, $count) {
    for ($index = 0; $index < $count; $index++) {
        $val = isset($result[$index]) ? $result[$index] : 0;
        $rand = md5($imageId . $index . $val);
        $colorId = ($index + 1);
        $query = "INSERT INTO feature_image(image_id, color_feature_id, count, unique_col, created_at, updated_at)"
                . "VALUES ('$imageId', '$colorId', $val, '$rand', NOW(), NOW())";
        mysql_query($query);
    }
}

function insertingDBEdge($path, $result) {

    $query = "INSERT INTO tbl_tepi VALUES (null, '" . $path . "', '";
    for ($index = 0; $index < count($result['horizontal']); $index++) {
        $val = isset($result['horizontal'][$index]) ? $result['horizontal'][$index] : 0;
        if ($index == count($result['horizontal']) - 1)
            $query .= $val;
        else
            $query .= $val . "-";
    }
    $query .= "', '";
    for ($index = 0; $index < count($result['vertical']); $index++) {
        $val = isset($result['vertical'][$index]) ? $result['vertical'][$index] : 0;
        if ($index == count($result['vertical']) - 1)
            $query .= $val;
        else
            $query .= $val . "-";
    }
    $query .= "')";
    mysql_query($query);
}

?>