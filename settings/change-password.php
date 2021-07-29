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
    <h1>Промени паролата</h1>
    <label>Текуща парола</label>
    <br />
    <input placeholder="Текуща парола" required />
    <br />
    <label>Нова парола</label>
    <br />
    <input placeholder="Нова парола" required />
    <br />
    <label>Потвърдете новата парола</label>
    <br />
    <input placeholder="Потвърдете новата парола" required />
    <br />
    <button>Промени</button>
</div>
<?php
include_once("../include/footer.php");
?>