<?php
// Define variables
define("DB_SERVER", "localhost");
define("DB_NAME", "bulgarianforum");
define("DB_USERNAME", "bulgarianforum");
define("DB_PASSWORD", "bulgarianforum");

// php errors = on
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

try{
    $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    die("ERROR: " . $e->getMessage());
}
?>