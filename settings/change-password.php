<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../auth/login.php");
    exit;
}

// Include header file
include_once("../include/header.php");
?>
<div class="text-center border">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <h1>Промени паролата</h1>
    <label>Текуща парола</label>
    <br />
    <input type="password" name="password" placeholder="Текуща парола" required />
    <br />
    <label>Нова парола</label>
    <br />
    <input type="password" name="new_password" placeholder="Нова парола" required />
    <br />
    <label>Потвърдете новата парола</label>
    <br />
    <input type="password" name="confirm_new_password" placeholder="Потвърдете новата парола" required />
    <br />
    <a href="index.php"><button type="button">Назад</button><button>Промени</button>
    </form>
</div>
<?php
include_once("../include/footer.php");
?>