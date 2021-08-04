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
    <h1>Изисквания</h1>
    <table>
        <tr>
            <td>
                PHP GD
            </td>
            <td>
                <?php
                if(extension_loaded('gd')){
                    echo "Активирано.";
                }else{
                    echo "Не е активирано.";
                }
                ?>
            </td>
        </tr>
        <tr>
            <td>
                PHP fileinfo
            </td>
            <td>
                <?php
                if(extension_loaded('fileinfo')){
                    echo "Активирано.";
                }else{
                    echo "Не е активирано.";
                }
                ?>
            </td>
        </tr>
        <tr>
            <td>
                PHP hash
            </td>
            <td>
                <?php
                if(extension_loaded('hash')){
                    echo "Активирано.";
                }else{
                    echo "Не е активирано.";
                }
                ?>
            </td>
        </tr>
        <tr>
            <td>
                PHP pdo
            </td>
            <td>
                <?php
                if(extension_loaded('pdo')){
                    echo "Активирано.";
                }else{
                    echo "Не е активирано.";
                }
                ?>
            </td>
        </tr>
    </table>
    <a href="index.php"><button>Назад</button></a>
    <button onclick="window.location.reload();">Презареждане</button>
</div>

<?php
include_once("../include/footer.php");
?>