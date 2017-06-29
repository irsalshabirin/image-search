<?php

include './cndb/db.php';

$fileName = $_POST['file_name'];

$query = "SELECT 
                i.id, 
                i.location,
                SQRT(SUM(POW((fi.count - 
                        (SELECT 
                            count 
                            FROM 
                                    feature_image 
                            WHERE 
                                    image_id = (SELECT id FROM images WHERE location = '$fileName')
                            AND feature_image.color_feature_id = fi.color_feature_id
                        )
                ), 2))) AS ranking

        FROM feature_image fi INNER JOIN images i ON fi.image_id = i.id

        -- WHERE i.id <> (SELECT id FROM images WHERE location = '$fileName')

        GROUP BY i.id
        ORDER BY ranking ";
        // . "LIMIT 30";

$res = mysql_query($query) or die();
$result = array();

while ($data = mysql_fetch_array($res)) {
    array_push($result, $data); 
}

echo json_encode($result);
?>
