<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../auth/login.php");
    exit;
}else{
    if($_SESSION["role"] !== "Administrator"){
        header("location: ../index.php");
        exit;
    }
}

// Include database file
require_once("../include/db.php");

// Include header file
include_once("../include/header.php");
?>

<div class="text-center border">
    <h1>Категории</h1>
    <div class="responsive">
    <table>
        <tr>
            <td>
                Име_на_категория
            </td>
            <td>
                <button>Редактирай</button>
            </td>
            <td>
                <button>Изтрий</button>
            </td>
        </tr>
    </table>
    </div>
    <a href="index.php"><button>Назад</button></a><button>Създай категория</button>
</div>

<?php
include_once("../include/footer.php");
?>