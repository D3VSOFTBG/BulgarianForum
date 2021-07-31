<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../auth/login.php");
    exit;
}

// Include database file
require_once("../include/db.php");

// Include header file
include_once("../include/header.php");
?>

<div class="text-center border">
    <h1>Профил</h1>
    <table>
        <tr>
            <td>
                <p>Снимка:</p>
            </td>
            <td>
                <strong>...</strong>
            </td>
        </tr>
        <tr>
            <td>
                <p>Потребителско име:</p>
            </td>
            <td>
                <strong><?php echo $_SESSION["username"]; ?></strong>
            </td>
        </tr>
        <tr>
            <td>
                <p>Имейл:</p>
            </td>
            <td>
                <strong><?php echo $_SESSION["email"]; ?></strong>
            </td>
        </tr>
    </table>
    <p>Можете да направите промяна от "Настройки".</p>
</div>

<?php
include_once("../include/footer.php");
?>