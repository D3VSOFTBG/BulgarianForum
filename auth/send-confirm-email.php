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

// Define variables and initialize with empty values
$email = "";
$email_err = "";
?>
<div class="text-center border">
    <p>Когато получите вашият Token, натиснете "потвърдете имейла"</p>
    <a href="confirm-email.php"><button>Потвърдете имейла</button></a>
</div>
<br />
<div class="text-center border">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h1>Потвъдете вашият имейл</h1>
        <label for="email">Вашият имейл</label>
        <br />
        <input type="email" id="email" name="email" placeholder="Вашият имейл">
        <br />
        <?php require("../include/captcha-html.php"); ?>
        <br />
        <button type="submit">Изпрати</button>
    </form>
</div>

<?php
include_once("../include/footer.php");
?>