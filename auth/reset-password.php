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
    <p>Имате 30 минути за да нулирате вашата парола с вашият Token,<br />ако не успеете трябва отново да натиснете
        забравена парола<br /> за да ви изпратим нов Token.</p>
    <a href="forgot-password.php"><button>Забравена парола</button></a>
</div>
<br />
<div class="text-center border">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <h1>Нулиране на паролата</h1>
        <label>Вашият имейл</label>
        <br />
        <input name="email" type="email" placeholder="Вашият имейл" />
        <br />
        <label>Вашият Тoken</label>
        <br />
        <input name="token" type="text" placeholder="Вашият Тoken" />
        <br />
        <label>Нова парола</label>
        <br />
        <input name="password" type="password" placeholder="Нова парола" />
        <br />
        <label>Повторете новата парола</label>
        <br />
        <input name="confirm_password" type="password" placeholder="Повторете новата парола" />
        <br />
        <button>ИЗПРАТИ</button>
    </form>
</div>

<?php
include_once("../include/footer.php");
?>