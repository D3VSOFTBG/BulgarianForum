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
?>

<div class="text-center border">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h1>Създай категория</h1>
        <label>Име на категория</label>
        <br />
        <input type="text" name="category_name" placeholder="Име на категория" required>
        <br />
        <a href="index.php"><button type="button">Назад</button></a><button type="submit">Създай категория</button>
    </form>
</div>

<?php
include_once("../include/footer.php");
?>