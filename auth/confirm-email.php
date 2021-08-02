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
    <p>Имате 30 минути за да потвърдите имейла си с вашият Token,<br />ако не успеете трябва да натиснете
    "изпратете имейл за потвърждение"<br /> за да ви изпратим нов Token.</p>
    <a href="send-confirm-email.php"><button>Изпратете имейл за потвърждение</button></a>
</div>
<br />
<div class="text-center border">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h1>Потвъдете вашият имейл</h1>
        <label for="email">Вашият имейл</label>
        <br />
        <input type="email" id="email" name="email" placeholder="Вашият имейл">
        <br />
        <label for="token">Вашият Тoken</label>
        <br />
        <input type="text" id="token" name="token" placeholder="Вашият Тoken">
        <br />
        <button type="submit">Потвърди</button>
    </form>
</div>

<?php
include_once("../include/footer.php");
?>