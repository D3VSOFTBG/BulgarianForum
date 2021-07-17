<?php
// Initialize the session
session_start();

// Include header file
include_once("../include/header.php");
?>
<div class="text-center">
    <h1>Изтрий акаунта</h1>
    <label>Текуща парола</label>
    <br />
    <input placeholder="Текуща парола"/>
    <br />
    <button onclick="deleteAccount();">Изтрий</button>
</div>
<script>
function deleteAccount(){
    alert("Наистина ли искате да изтриете вашият акаунт?")
}
</script>
<?php
include_once("../include/footer.php");
?>