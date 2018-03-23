<?php

require_once 'app/autoload.php';

try {
    $sql = "SELECT id,task FROM todo ORDER BY created_at DESC";
    $result = getData($db, $sql);

    echo json_encode($result);
} catch(PDOException $ex) {
    // handle error
}