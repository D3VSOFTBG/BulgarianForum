<?php
// Initialize the session
session_start();

// Include header file
include_once("../include/header.php");
?>
<div class="text-center border">
    <h1>Промени паролата</h1>
    <label>Текуща парола</label>
    <br />
    <input placeholder="Текуща парола"/>
    <br />
    <label>Нова парола</label>
    <br />
    <input placeholder="Нова парола"/>
    <br />
    <label>Потвърдете новата парола</label>
    <br />
    <input placeholder="Потвърдете новата парола"/>
    <br />
    <button>Промени</button>
</div>
<?php
include_once("../include/footer.php");
?>