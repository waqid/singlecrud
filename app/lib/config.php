<?php

define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('NAME', 'singlecrud');

$db = new PDO('mysql:host='.HOST.';dbname='.NAME.';charset=utf8mb4', USER, PASS) or die;
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);