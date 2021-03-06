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
$email = $captcha = $sent_message = "";
$email_err = $captcha_err = "";

// Include PHPMailer
use PHPMailer\PHPMailer\PHPMailer;

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty(trim(htmlspecialchars($_POST["captcha"])))){
        $captcha_err = "Моля препишете буквите.";
    }else{
        $captcha = trim(htmlspecialchars($_POST["captcha"]));
        if(isset($captcha) && $captcha == $_SESSION["CAPTCHA_TEXT"]){
            // Validate email
            if(empty(trim(htmlspecialchars($_POST["email"])))){
                $email_err = "Моля въведете вашият имейл.";
            }else{
                $email = trim(htmlspecialchars($_POST["email"]));
                
                // Prepare select statement
                $sql = "SELECT email, username FROM users WHERE email = :email";

                if($stmt = $pdo->prepare($sql)){
                    // Bind variables to the prepared statement as parameters
                    $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);

                    // Set parameters
                    $param_email = trim(htmlspecialchars($_POST["email"]));

                    // Attempt to execute the prepared statement
                    if($stmt->execute()){
                        // Check if email exist, if yes then send Token via mail
                        if($stmt->rowCount() == 1){
                            if($row = $stmt->fetch()){
                                $username = $row["username"];

                                // Token
                                $token = md5(substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789") , 0 , 62));
                                $pdo->prepare("UPDATE users SET token = ?, token_created_time = ? WHERE email = ?")->execute([$token, time(), $email]);
                            
                                // Email
                                require '../vendor/autoload.php';
                                $mail = new PHPMailer;
                                $mail->CharSet = "UTF-8";
                                $mail->isSMTP();
                                $mail->Host = $smtp_host;
                                $mail->Port = $smtp_port;
                                $mail->SMTPAuth = true;
                                $mail->Username = $smtp_username;
                                $mail->Password = $smtp_password;
                                $mail->setFrom($smtp_from_email, $smtp_from_username);
                                $mail->addAddress($email);
                                if ($mail->addReplyTo($email)) {
                                    $mail->Subject = "$title - Забравена парола";
                                    $mail->isHTML(false);
                                    $mail->Body = <<<EOT
                                    Здравей, $username.
                                    Token: $token
                                    EOT;
                                    $mail->send();
                                    $sent_message = "Проверете си имейла!";
                                }
                            }
                        }else{
                            $email_err = "Въведеният имейл не съществува в нашата система!";
                        }
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
    <p>1. Ще ви изпратим Token ако имейлът ви съществува в нашата система.</p>
    <a href="reset-password.php"><button type="button">Нулиране на парола</button></a>
</div>
<br />
<div class="text-center border">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <?php
            if(!empty($sent_message)){
                echo '<br /><span class="success">'.$sent_message.'</span>';
            }
        ?>
        <h1>Забравена парола</h1>
        <label for="email">Вашият имейл</label>
        <?php
            if(!empty($email_err)){
                echo '<br /><span class="error">'.$email_err.'</span>';
            }
        ?>
        <br />
        <input type="email" id="email" name="email" placeholder="Въведете вашият имейл" required />
        <br />
        <?php require("../include/captcha-html.php"); ?>
        <br />
        <button type="submit">Изпрати</button>
    </form>
</div>
<?php
include_once("../include/footer.php");
?>