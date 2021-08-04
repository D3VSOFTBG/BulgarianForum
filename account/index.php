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
    <div class="responsive">
    <table>
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
                Роля:
            </td>
            <td>
                <?php echo $_SESSION["role"]; ?>
            </td>
        </tr>
        <tr>
            <td>
                <p>Профилна снимка:</p>
            </td>
            <td>
                <img class="profile_picture" height="80" width="80" src="<?php echo $_SESSION["profile_picture"]; ?>"
                    alt="profile_picture">
                <br />
                <a href="upload-profile-picture.php"><button><?php
                if(!str_contains($_SESSION["profile_picture"], "gravatar")){
                    echo "&#9989;&nbsp;";
                }
                ?>Качи профилна снимка</button></a>
                <br />
                <a href="use-gravatar.php"><button><?php
                if(str_contains($_SESSION["profile_picture"], "gravatar")){
                    echo "&#9989;&nbsp;";
                }
                ?>Използвай Gravatar</button></a>
            </td>
        </tr>
        <tr>
            <td>
                <p>Имейл:</p>
            </td>
            <td>
                <strong><?php echo $_SESSION["email"]; ?></strong>
                <br />
                <a href="change-email.php"><button>Промени имейла</button></a>
                <?php
                if($_SESSION["email_confirmed"] == 0){
                    echo '<a href="confirm-email.php"><button>Потвърдете имейла</button></a>';
                }
                ?>
            </td>
        </tr>
    </table>
    </div>
    <a href="change-password.php"><button>Промени паролата</button></a>
    <a href="delete-account.php"><button>Изтрий Акаунта</button></a>
</div>

<?php
include_once("../include/footer.php");
?>