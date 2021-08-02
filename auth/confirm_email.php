<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect people to index page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ../index.php");
    exit;
}

// Include database file
require_once("../include/db.php");

// Include header file
include_once("../include/header.php");
?>

<div class="text-center border">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"></form>
    <h1>Потвъдете вашият имейл</h1>
    <input>
    <br />
    <input>
    <br />
    <button type="submit">Потвърди</button>
</div>

<?php
include_once("../include/footer.php");
?>