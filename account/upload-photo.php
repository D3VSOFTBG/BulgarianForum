<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../auth/login.php");
    exit;
}

// Include database file
require_once("../include/db.php");

// Include header file
include_once("../include/header.php");
?>

<div class="text-center border">
    <h1>Качи снимка</h1>
    <label>Снимка</label>
    <br />
    <input type="file" accept="image/*">
    <br />
    <a href="index.php"><button type="button">Назад</button><button type="submit">Качи</button>
</div>

<?php
include_once("../include/footer.php");
?>