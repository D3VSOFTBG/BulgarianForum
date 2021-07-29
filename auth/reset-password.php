<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect people to index page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ../index.php");
    exit;
}

// Include database file
require_once("../include/db.php");

// Include header file
include_once("../include/header.php");

// Define variables and initialize with empty values
$email = $new_password = $confirm_new_password = $captcha = "";
$email_err = $new_password_err = $confirm_new_password_err = $captcha_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty(trim(htmlspecialchars($_POST["captcha"])))){
        $captcha_err = "Моля препишете буквите.";
    }else{
        $captcha = trim(htmlspecialchars($_POST["captcha"]));
        if(isset($captcha) && $captcha == $_SESSION["CAPTCHA_TEXT"]){
            // Validate email
            if(empty(trim(htmlspecialchars($_POST["email"])))){
                $email_err = "Моля въведете вашият имейл";
            }else{
                $email = trim(htmlspecialchars($_POST["email"]));
            }

            // Validate token

            // Validate new password
            if(empty(trim(htmlspecialchars($_POST["new_password"])))){
                $new_password_err = "Моля въведете нова парола";
            }elseif(strlen(trim(htmlspecialchars($_POST["new_password"]))) < 8){
                $new_password_err = "Паролата трябва да е поне 8 символа.";
            }elseif(strlen(trim(htmlspecialchars($_POST["new_password"]))) > 255){
                $new_password_err = "Максималната дължина на паролата трябва да е 255 символа.";
            }elseif(!preg_match('/[\d]/', trim(htmlspecialchars($_POST["new_password"])))){
                $new_password_err = "Вашата парола трябва да съдържа поне една цифра.";
            }else{
                $new_password = trim(htmlspecialchars($_POST["new_password"]));
            }

            // Validate confirm new password



        }else{
            $captcha_err = "Грешен отговор, моля опитайте отново.";
        }
    }
}
?>
<div class="text-center border">
    <p>Имате 30 минути за да нулирате вашата парола с вашият Token,<br />ако не успеете трябва отново да натиснете
        забравена парола<br /> за да ви изпратим нов Token.</p>
    <a href="forgot-password.php"><button>Забравена парола</button></a>
</div>
<br />
<div class="text-center border">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <h1>Нулиране на паролата</h1>
        <label>Вашият имейл</label>
        <?php
            if(!empty($email_err)){
                echo '<br /><span class="error">'.$email_err.'</span>';
            }
        ?>
        <br />
        <input name="email" type="email" placeholder="Вашият имейл" />
        <br />
        <label>Вашият Тoken</label>
        <br />
        <input name="token" type="text" placeholder="Вашият Тoken" />
        <br />
        <label>Нова парола</label>
        <?php
            if(!empty($new_password_err)){
                echo '<br /><span class="error">'.$new_password_err.'</span>';
            }
        ?>
        <br />
        <input name="new_password" type="password" placeholder="Нова парола" />
        <br />
        <label>Повторете новата парола</label>
        <br />
        <input name="confirm_new_password" type="password" placeholder="Повторете новата парола" />
        <br />
        <?php require("../include/captcha-html.php"); ?>
        <br />
        <button>Изпрати</button>
    </form>
</div>

<?php
include_once("../include/footer.php");
?>