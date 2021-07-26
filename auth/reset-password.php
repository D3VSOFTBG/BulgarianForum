<?php
// Initialize the session
session_start();

// Include header file
include_once("../include/header.php");
?>
<div class="text-center border">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <h1>Нулиране на паролата</h1>
    <label>Вашият имейл</label>
    <br />
    <input placeholder="Въведете вашият имейл"/>
    <br />
    <button>Промени</button>
    <p>Ако имейлът съществува ние ще изпратим код за нулиране на паролата.</p>
    </form>
</div>
<?php
include_once("../include/footer.php");
?>