<?php

require_once 'app/autoload.php';

try {
    $sql = "SELECT id,task FROM todo ORDER BY created_at DESC";
    $result = getData($db, $sql);

    $response = array(
    	'todos' => $result
    );
    echo json_encode($response);
} catch(PDOException $ex) {
    // handle error
}