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
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"></form>
    <h1>Промени имейла</h1>
    <label>Нов имейл</label>
    <br />
    <input type="email" name="email" placeholder="Нов имейл"/>
    <br />
    <label>Потвърди новият имейл</label>
    <br />
    <input type="email" name="confirm_email" placeholder="Потвърдете новият имейл"/>
    <br />
    <label>Вашата парола</label>
    <br />
    <input placeholder="Вашата парола"/>
    <br />
    <button>Промени</button>
</div>
<?php
include_once("../include/footer.php");
?>