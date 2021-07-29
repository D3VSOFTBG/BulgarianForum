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

if($_SERVER["REQUEST_METHOD"] == "POST"){

}
?>
<div class="text-center border">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <h1>Забравена парола</h1>
        <label>Вашият имейл</label>
        <br />
        <input type="email" placeholder="Въведете вашият имейл" />
        <br />
        <?php require("../include/captcha-html.php"); ?>
        <br />
        <button type="submit">Изпрати</button>
        <p>Ще ви изпратим ключ ако имейлът ви съществува в нашата система.</p>
        <p>След като получите ключа, натиснете долният бутон.</p>
        <a href="reset-password.php"><button type="button">ИМАМ КЛЮЧ</button></a>
    </form>
</div>
<?php
include_once("../include/footer.php");
?>