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

use PHPMailer\PHPMailer\PHPMailer;

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty(trim(htmlspecialchars($_POST["captcha"])))){
        $captcha_err = "Моля препишете буквите.";
    }else{
        $captcha = trim(htmlspecialchars($_POST["captcha"]));
        if(isset($captcha) && $captcha == $_SESSION["CAPTCHA_TEXT"]){
            // Check if email is empty
            if(empty(trim(htmlspecialchars($_POST["email"])))){
                $email_err = "Моля въведете вашият имейл.";
            }else{
                $email = trim(htmlspecialchars($_POST["email"]));
            }

            // Validate credentials
            if(empty($email_err)){
                // Prepare select statement
                $sql = "SELECT email FROM users WHERE email = :email";

                if($stmt = $pdo->prepare($sql)){
                    // Bind variables to the prepared statement as parameters
                    $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);

                    // Set parameters
                    $param_email = trim(htmlspecialchars($_POST["email"]));

                    // Attempt to execute the prepared statement
                    if($stmt->execute()){
                        // Check if email exist, if yes then send key via mail
                        if($stmt->rowCount() == 1){
                            require '../vendor/autoload.php';
                            $mail = new PHPMailer;
                            $mail->CharSet = "UTF-8";
                            $mail->isSMTP();
                            $mail->Host = 'smtp.mailtrap.io';
                            $mail->Port = 2525;
                            $mail->SMTPAuth = true;
                            $mail->Username = '81dd1f9c393198';
                            $mail->Password = '8ffe50f775a323';
                            $mail->setFrom('admin@d3vbg.eu', 'D3VBG');
                            $mail->addAddress($param_email);
                            if ($mail->addReplyTo($param_email)) {
                                $mail->Subject = "$title - Забравена парола";
                                $mail->isHTML(false);
                                $mail->Body = <<<EOT
                                Key: 123
                                EOT;
                                $mail->send();
                                $sent_message = "Проверете си имейла!";
                            }
                        }else{
                            // To prevent abuse
                            sleep(3);
                            $sent_message = "Проверете си имейла!";
                        }
                    }
                    // Close statement
                    unset($stmt);
                }
            }
            // Close connection
            unset($pdo);
        }
    }
}
?>
<div class="text-center border">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <?php
            if(!empty($sent_message)){
                echo '<br /><span class="error">'.$sent_message.'</span>';
            }
        ?>
        <h1>Забравена парола</h1>
        <label>Вашият имейл</label>
        <br />
        <input type="email" name="email" placeholder="Въведете вашият имейл" />
        <br />
        <?php require("../include/captcha-html.php"); ?>
        <br />
        <button type="submit">Изпрати</button>
        <p>Ще ви изпратим ключ ако имейлът ви съществува в нашата система.</p>
        <p>След като получите ключа, натиснете долният бутон.</p>
        <a href="reset-password.php"><button type="button">ИМАМ КЛЮЧ</button></a>
    </form>
</div>
<?php
include_once("../include/footer.php");
?>