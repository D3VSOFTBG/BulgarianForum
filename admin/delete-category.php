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

if(isset($_GET["id"])){
    // Delete statement
    $sql = "DELETE FROM categories WHERE id = :id";
    
    if($stmt = $pdo->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":id", $param_id, PDO::PARAM_INT);
        
        // Set parameters
        $param_id = trim(htmlspecialchars($_GET["id"]));

        // Attempt to execute the prepared statement
        if($stmt->execute()){
            echo "<script>alert('КАТЕГОРИЯТА Е ИЗТРИТА УСПЕШНО!');window.history.back();</script>";
        }else{
            echo "Грешка, моля опитайте по късно";
        }
        // Close statement
        unset($stmt);
    }
}else{
    echo "ГРЕШКА!";
}
// Close connection
unset($pdo);
?>