<?php

function getData($db, $sql) {
    $stmt = $db->query($sql);
    $response = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $rows = array();
    foreach($response as $row){
        $rows[] = $row;
    }
    
    return $rows;
 }

 function run($db, $sql) {
    $affected_rows = $db->exec($sql);
    return $affected_rows;
 }