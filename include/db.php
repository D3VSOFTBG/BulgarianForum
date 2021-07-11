<?php
// Read password from .password file
$open_password_file = fopen(".password", "r") or die("Unable to open file to read password!");
$read_password_file = trim(fread($open_password_file, filesize(".password")));
fclose($open_password_file);

// Define variables
define("DB_SERVER", "localhost");
define("DB_NAME", "bulgarianforum");
define("DB_USERNAME", "bulgarianforum");
define("DB_PASSWORD", $read_password_file);

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