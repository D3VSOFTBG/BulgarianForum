<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../auth/login.php");
    exit;
}else{
    if($_SESSION["role"] !== "Administrator"){
        header("location: ../index.php");
        exit;
    }
}

// Include database file
require_once("../include/db.php");

// Include header file
include_once("../include/header.php");

if(isset($_GET["id"])){
    // Select statement
    $sql = "SELECT category_name FROM categories WHERE id = :id";

    if($stmt = $pdo->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":id", $param_id, PDO::PARAM_INT);

        // Set parameters
        $param_id = trim(htmlspecialchars($_GET["id"]));

        // Attempt to execute the prepared statement
    }
?>

<div class="text-center border">
    <h1>Редактирай категория</h1>
    <input type="text" id="category_name" name="category_name" placeholder="Име на категория" required>
    <a href="categories.php"><button type="button">Назад</button></a><button type="submit">Редактирай</button>
</div>

<?php
}else{
    echo "<h1 class='text-center'>ГРЕШКА!</h1>";
}
include_once("../include/footer.php");
?>