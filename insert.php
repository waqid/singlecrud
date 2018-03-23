<?php

require_once 'app/autoload.php';

try {
    $response = array();

    if(isset($_POST) && !empty($_POST)) {
        $task = $_POST['task'];
        $sql = "INSERT INTO todo(task,created_at,updated_at) VALUES('$task', NOW(), NOW())";
        $rows = run($db, $sql);

        $response['error'] = FALSE;
        $response['message'] = $rows . ' rows inserted';
    } else {
        $response['error'] = TRUE;
        $response['message'] = 'No Post Data';
    }

    echo json_encode($response);
} catch(PDOException $ex) {
    // handle error
}