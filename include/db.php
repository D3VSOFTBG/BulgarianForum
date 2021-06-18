<?php
define('DB_SERVER','localhost');
define('DB_USERNAME','bulgarianforum');
define('DB_PASSWORD','bulgarianforum');
define('DB_NAME','bulgarianforum');

try{
    $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    die("ERROR: " . $e->getMessage());
}
?>