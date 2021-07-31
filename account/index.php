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
    <h1>Акаунт</h1>
    <table>
        <tr>
            <td>
                <p>Потребителско име:</p>
            </td>
            <td colspan="2">
                <strong><?php echo $_SESSION["username"]; ?></strong>
            </td>
        </tr>
        <tr>
            <td>
                <p>Профилна снимка:</p>
            </td>
            <td>
                <strong>...</strong>
            </td>
            <td>
                <a href="upload-profile-picture.php"><button>Качи профилна снимка</button></a>
            </td>
        </tr>
        <tr>
            <td>
                <p>Имейл:</p>
            </td>
            <td>
                <strong><?php echo $_SESSION["email"]; ?></strong>
            </td>
            <td>
            <a href="change-email.php"><button>Промени имейла</button></a>

            </td>
        </tr>
    </table>
    <a href="change-password.php"><button>Промени паролата</button></a>
    <a href="delete-account.php"><button>Изтрий Акаунта</button></a>
</div>

<?php
include_once("../include/footer.php");
?>