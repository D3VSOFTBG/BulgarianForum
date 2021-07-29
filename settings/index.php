<?php
// Initialize the session
session_start();

// Include header file
include_once("../include/header.php");
?>
<div class="text-center border">
    <h1>Настройки</h1>
    <a href="change-password.php"><button>Промени паролата</button></a>
    <br />
    <a href="change-email.php"><button>Промени имейла</button></a>
    <br />
    <a href="delete-account.php"><button>Изтрий Акаунта</button></a>
</div>
<?php
include_once("../include/footer.php");
?>