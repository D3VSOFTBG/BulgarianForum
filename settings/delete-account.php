<?php
// Initialize the session
session_start();

// Include header file
include_once("../include/header.php");

// Define variables and initialize with empty values
$password = $confirm_password = "";
$password_err = $confirm_password_err = "";
?>
<div class="text-center border">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return deleteAccount();">
        <h1>Изтрий акаунта</h1>
        <label>Текуща парола</label>
        <br />
        <input name="password" placeholder="Текуща парола" />
        <br />
        <input name="confirm_password" placeholder="Потвърди текущата парола" />
        <br />
        <button type="submit">Изтрий</button>
    </form>
</div>
<script>
    function deleteAccount() {
        if(confirm("Наистина ли искате да изтриете вашият акаунт?")){
            return true;
        }else{
            return false;
        }
    }
</script>
<?php
include_once("../include/footer.php");
?>