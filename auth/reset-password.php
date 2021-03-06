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
$email = $token = $new_password = $confirm_new_password = $captcha = "";
$email_err = $token_err = $new_password_err = $confirm_new_password_err = $captcha_err = "";

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
            if(empty(trim(htmlspecialchars($_POST["token"])))){
                $token_err = "Моля въведете вашият Token";
            }else{
                // Prepare a select statement
                $sql = "SELECT token, token_created_time FROM users WHERE email = :email";

                if($stmt = $pdo->prepare($sql)){
                    // Bind variables to the prepared statement as parameters
                    $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);

                    // Set parameters
                    $param_email = trim(htmlspecialchars($_POST["email"]));

                    // Attempt to execute the prepared statement
                    if($stmt->execute()){
                        if($row = $stmt->fetch()){
                            $token = trim(htmlspecialchars($_POST["token"]));
                            if($row["token"] != $token){
                                $token_err = "Вашият Token е невалиден.";
                            }else{
                                // The token must be used up to (1800 = 30 minutes)
                                if(!(time() - $row["token_created_time"] < 1800)){
                                    $token_err = "Времето ви за използване на този Token е изтекло.";
                                }
                            }
                        }
                    }else{
                        echo "<h1 class='text-center'>Грешка, моля опитайте по късно.</h1>";
                    }
                    // Close statement
                    unset($stmt);
                }
            }

            // Validate new password
            if(empty(trim(htmlspecialchars($_POST["new_password"])))){
                $new_password_err = "Моля въведете нова парола";
            }elseif(strlen(trim(htmlspecialchars($_POST["new_password"]))) < 8){
                $new_password_err = "Паролата трябва да е поне 8 символа.";
            }elseif(strlen(trim(htmlspecialchars($_POST["new_password"]))) > 255){
                $new_password_err = "Максималната дължина на паролата е 255 символа.";
            }elseif(!preg_match('/[\d]/', trim(htmlspecialchars($_POST["new_password"])))){
                $new_password_err = "Вашата парола трябва да съдържа поне една цифра.";
            }else{
                $new_password = trim(htmlspecialchars($_POST["new_password"]));
            }

            // Validate confirm new password
            if(empty(trim(htmlspecialchars($_POST["confirm_new_password"])))){
                $confirm_new_password_err = "Моля потвърдете паролата.";
            }else{
                $confirm_new_password = trim(htmlspecialchars($_POST["confirm_new_password"]));
                if(empty($new_password_err) && ($new_password != $confirm_new_password)){
                    $confirm_new_password_err = "Паролите не съвпадат";
                }
            }

            // Check input errors before inserting in database
            if(empty($email_err) && empty($token_err) && empty($new_password_err) && empty($confirm_new_password_err)){
                // Prepare an insert statement
                $sql = "UPDATE users SET password = :password WHERE email = :email";

                if($stmt = $pdo->prepare($sql)){
                    // Bind variables to the prepared statement as parameters
                    $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
                    $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);

                    // Set parameters
                    $param_password = password_hash($new_password, PASSWORD_DEFAULT);
                    $param_email = $email;

                    // Attempt to execute the prepared statement
                    if($stmt->execute()){
                        $pdo->prepare("UPDATE users SET token = ?, token_created_time = ? WHERE email = ?")->execute([NULL, NULL, $email]);
                        echo "<script>alert('ВАШАТА ПАРОЛА Е НУЛИРАНА УСПЕШНО!');location.href='login.php';</script>";
                    }else{
                        echo "<h1 class='text-center'>Грешка, моля опитайте по късно.</h1>";
                    }
                    // Close statement
                    unset($stmt);
                }
            }
            // Close connection
            unset($pdo);
        }else{
            $captcha_err = "Грешна капча, моля опитайте отново.";
        }
    }
}
?>
<div class="text-center border">
    <p>2. Имате 30 минути за да нулирате вашата парола с вашият Token</p>
    <a href="forgot-password.php"><button>Забравена парола</button></a>
</div>
<br />
<div class="text-center border">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <h1>Нулиране на паролата</h1>
        <label for="email">Вашият имейл</label>
        <?php
            if(!empty($email_err)){
                echo '<br /><span class="error">'.$email_err.'</span>';
            }
        ?>
        <br />
        <input id="email" name="email" type="email" placeholder="Вашият имейл" required />
        <br />
        <label for="token">Вашият Тoken</label>
        <?php
            if(!empty($token_err)){
                echo '<br /><span class="error">'.$token_err.'</span>';
            }
        ?>
        <br />
        <input id="token" name="token" type="text" placeholder="Вашият Тoken" required />
        <br />
        <label for="new_password">Нова парола</label>
        <?php
            if(!empty($new_password_err)){
                echo '<br /><span class="error">'.$new_password_err.'</span>';
            }
        ?>
        <br />
        <input minlength="8" maxlength="255" id="new_password" name="new_password" type="password" placeholder="Нова парола" required />
        <br />
        <label for="confirm_new_password">Повторете новата парола</label>
        <br />
        <input minlength="8" maxlength="255" id="confirm_new_password" name="confirm_new_password" type="password" placeholder="Повторете новата парола" required />
        <br />
        <?php require("../include/captcha-html.php"); ?>
        <br />
        <button>Изпрати</button>
    </form>
</div>

<?php
include_once("../include/footer.php");
?>