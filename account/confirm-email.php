<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../auth/login.php");
    exit;
}else{
    if($_SESSION["email_confirmed"] == 1){
        header("location: index.php");
        exit;
    }
}

// Include database file
require_once("../include/db.php");

// Include header file
include_once("../include/header.php");

// Define variables and initialize with empty values
$token = "";
$token_err = "";

// Include PHPMailer
use PHPMailer\PHPMailer\PHPMailer;

$username = $_SESSION["username"];
$email = $_SESSION["email"];


if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST["send_token"])){
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
            $mail->Subject = "$title - Потвърдете имейла";
            $mail->isHTML(false);
            $mail->Body = <<<EOT
            Здравей, $username.
            Token: $token
            EOT;
            $mail->send();
        }
        echo "<script>alert('ПРОВЕРЕТЕ СИ ИМЕЙЛА!');location.href='confirm-email.php';</script>";
    }else{
        // Prepare a select statement
        $sql = "SELECT token, token_created_time, email_confirmed FROM users WHERE email = :email";

        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);

            // Set parameters
            $param_email = $email;

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
                        }else{
                            $_SESSION["email_confirmed"] = 1;
                            $pdo->prepare("UPDATE users SET email_confirmed = ?, token = ?, token_created_time = ? WHERE email = ?")->execute([$_SESSION["email_confirmed"] ,NULL, NULL, $email]);
                            echo "<script>alert('ВАШИЯТ ИМЕЙЛ Е ПОТВЪРДЕН УСПЕШНО!');location.href='index.php';</script>";
                        }
                    }
                }
            }else{
                echo "Грешка, моля опитайте по късно.";
            }
            // Close statement
            unset($stmt);
        }
    }
    // Close connection
    unset($pdo);
}
?>
<div class="text-center border">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <p>Имате 30 минути за да потвърдите имейла си с вашият Token,<br />ако не успеете трябва да натиснете
            "изпратете Token за потвърждение"<br /> за да ви изпратим нов Token.</p>
        <button name="send_token" type="submit">Изпратете Token за потвърждение</button></a>
    </form>
</div>
<br />
<div class="text-center border">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h1>Потвъдете вашият имейл</h1>
        <label for="token">Вашият Тoken</label>
        <?php
            if(!empty($token_err)){
                echo '<br /><span class="error">'.$token_err.'</span>';
            }
        ?>
        <br />
        <input type="text" id="token" name="token" placeholder="Вашият Тoken" required>
        <br />
        <button type="submit">Потвърди</button>
    </form>
</div>

<?php
include_once("../include/footer.php");
?>