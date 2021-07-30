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

// Define variables and initialize with empty values
$password = $new_password = $confirm_new_password = "";
$password_err = $new_password_err = $confirm_new_password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate password
    if(empty(trim(htmlspecialchars($_POST["password"])))){
        $password_err = "Моля въведете вашата парола.";
    }else{
        $password = trim(htmlspecialchars($_POST["password"]));
    }

    // Validate new password
    if(empty(trim(htmlspecialchars($_POST["new_password"])))){
        $new_password_err = "Моля въведете нова парола.";        
    }elseif(strlen(trim(htmlspecialchars($_POST["password"]))) < 8){
        $new_password_err = "Паролата трябва да е поне 8 символа.";
    }elseif(strlen(trim(htmlspecialchars($_POST["password"]))) > 255){
        $new_password_err = "Максималната дължина на паролата е 255 символа.";
    }elseif(!preg_match('/[\d]/', trim(htmlspecialchars($_POST["password"])))){
        $new_password_err = "Вашата парола трябва да съдържа поне една цифра.";
    }else{
        $new_password = trim(htmlspecialchars($_POST["new_password"]));
    }

    // Validate confirm new password
}
?>
<div class="text-center border">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <h1>Промени паролата</h1>
    <label>Текуща парола</label>
    <br />
    <input type="password" name="password" placeholder="Текуща парола" required />
    <br />
    <label>Нова парола</label>
    <br />
    <input type="password" name="new_password" placeholder="Нова парола" required />
    <br />
    <label>Потвърдете новата парола</label>
    <br />
    <input type="password" name="confirm_new_password" placeholder="Потвърдете новата парола" required />
    <br />
    <a href="index.php"><button type="button">Назад</button><button>Промени</button>
    </form>
</div>
<?php
include_once("../include/footer.php");
?>