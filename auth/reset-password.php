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
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <h1>Нулиране на паролата</h1>
        <label>Вашият имейл</label>
        <br />
        <input name="email" type="email" placeholder="Вашият имейл" />
        <br />
        <label>Вашият ключ</label>
        <br />
        <input name="key" type="text" placeholder="Вашият ключ" />
        <br />
        <label>Нова парола</label>
        <br />
        <input name="password" type="password" placeholder="Нова парола" />
        <br />
        <label>Повторете новата парола</label>
        <br />
        <input name="confirm_password" type="password" placeholder="Повторете новата парола" />
        <br />
        <button>Изпрати</button>
        <p>Ако нямате ключ натиснете долният бутон.</p>
        <a href="forgot-password.php"><button type="button">НЯМАМ КЛЮЧ</button></a>
    </form>
</div>
<?php
include_once("../include/footer.php");
?>