<?php
// Initialize the session
session_start();

// Include header file
include_once("../include/header.php");
?>
<div class="text-center">
    <h1>Промени имейла</h1>
    <label>Нов имейл</label>
    <br />
    <input placeholder="Нов имейл"/>
    <br />
    <label>Потвърди новият имейл</label>
    <br />
    <input placeholder="Потвърдете новият имейл"/>
    <br />
    <label>Вашата парола</label>
    <br />
    <input placeholder="Вашата парола"/>
    <br />
    <button>Промени</button>
</div>
<?php
include_once("../include/footer.php");
?>