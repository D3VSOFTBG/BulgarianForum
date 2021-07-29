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
$username = $email = $password = $confirm_password = $captcha = "";
$username_err = $email_err = $password_err = $confirm_password_err = $captcha_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty(trim(htmlspecialchars($_POST["captcha"])))){
        $captcha_err = "Моля препишете буквите.";
    }else{
        $captcha = trim(htmlspecialchars($_POST["captcha"]));
        if(isset($captcha) && $captcha == $_SESSION["CAPTCHA_TEXT"]){
            // Validate username
            if(empty(trim(htmlspecialchars($_POST["username"])))){
                $username_err = "Моля въведете потребителско име.";
            }elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim(htmlspecialchars($_POST["username"])))){
                $username_err = "Потребителското име единствено може да съдържа букви, цифри и долни черти.";
            }elseif(strlen(trim(htmlspecialchars($_POST["username"]))) <= 5){
                $username_err = "Дължината на потребителското име трябва да е най-малко 5 символа.";
            }elseif(strlen(trim(htmlspecialchars($_POST["username"]))) >= 50){
                $username_err = "Дължината на потребителското име трябва да е най-много 50 символа.";
            }else{
                // Prepare a select statement
                $sql = "SELECT id FROM users WHERE username = :username";

                if($stmt = $pdo->prepare($sql)){
                    // Bind variables to the prepared statement as parameters
                    $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);

                    // Set parameters
                    $param_username = trim(htmlspecialchars($_POST["username"]));

                    // Attempt to execute the prepared statement
                    if($stmt->execute()){
                        if($stmt->rowCount() == 1){
                            $username_err = "Това потребителско име вече съществува.";
                        }else{
                            $username = trim(htmlspecialchars($_POST["username"]));
                        }
                    }else{
                        echo "Грешка, моля опитайте по късно.";
                    }
                    // Close statement
                    unset($stmt);
                }
            }
            // Validate email
            if(empty(trim(htmlspecialchars($_POST["email"])))){
                $email_err = "Моля въведете имейл адрес.";
            }elseif(!filter_var(htmlspecialchars($_POST["email"]), FILTER_VALIDATE_EMAIL)){
                $email_err = "Моля въведете правилен имейл адрес.";
            }else{
                $sql = "SELECT id FROM users WHERE email = :email";

                if($stmt = $pdo->prepare($sql)){
                    // Bind variables to the prepared statement as parameters
                    $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);

                    // Set parameters
                    $param_email = trim(htmlspecialchars($_POST["email"]));

                    // Attempt to execute the prepared statement
                    if($stmt->execute()){
                        if($stmt->rowCount() == 1){
                            $email_err = "Този имейл адрес вече съществува.";
                        }else{
                            $email = trim(htmlspecialchars($_POST["email"]));
                        }
                    }else{
                        echo "Грешка, моля опитайте по късно.";
                    }
                    // Close statement
                    unset($stmt);
                }
            }
            
            // Validate password
            if(empty(trim(htmlspecialchars($_POST["password"])))){
                $password_err = "Моля въведете парола.";
            }elseif(strlen(trim(htmlspecialchars($_POST["password"]))) < 8){
                $password_err = "Паролата трябва да е поне 8 символа.";
            }elseif(strlen(trim(htmlspecialchars($_POST["password"]))) > 255){
                $password_err = "Максималната дължина на паролата трябва да е 255 символа.";
            }elseif(!preg_match('/[\d]/', trim(htmlspecialchars($_POST["password"])))){
                $password_err = "Вашата парола трябва да съдържа поне една цифра.";
            }else{
                $password = trim(htmlspecialchars($_POST["password"]));
            }

            // Validate confirm password
            if(empty(trim(htmlspecialchars($_POST["confirm_password"])))){
                $confirm_password_err = "Моля потвърдете паролата.";
            }else{
                $confirm_password = trim(htmlspecialchars($_POST["confirm_password"]));
                if(empty($password_err) && ($password != $confirm_password)){
                    $confirm_password_err = "Паролите не съвпадат.";
                }
            }

            // Check input errors before inserting in database
            if(empty($username_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)){
                // Prepare an insert statement
                $sql = "INSERT INTO users (username, email, password, created_at) VALUES (:username, :email, :password, :created_at)";

                if($stmt = $pdo->prepare($sql)){
                    // Bind variables to the prepared statement as parameters
                    $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
                    $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
                    $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
                    $stmt->bindParam(":created_at", $param_created_at, PDO::PARAM_STR);

                    // Set parameters
                    $param_username = $username;
                    $param_email = $email;
                    $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
                    $param_created_at = date("Y-m-d");

                    // Attempt to execute the prepared statement
                    if($stmt->execute()){
                        echo "<script>alert('ВИЕ СЕ РЕГИСТРИРАХТЕ УСПЕШНО!');location.href='login.php';</script>";
                    }else{
                        echo "Грешка, моля опитайте по късно.";
                    }
                    // Close statement
                    unset($stmt);
                }
            }
            // Close connection
            unset($pdo);
        }else{
            $captcha_err = "Грешен отговор, моля опитайте отново.";
        }
    }
}        
?>
<div class="text-center border">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h1>Регистрация</h1>
        <label for="username">Потребителско име</label>
        <?php
            if(!empty($username_err)){
                echo '<br /><span class="error">'.$username_err.'</span>';
            }
        ?>
        <br />
        <input name="username" id="username" type="text" placeholder="Потребителско име" />
        <br />
        <label for="email">Имейл</label>
        <?php
            if(!empty($email_err)){
                echo '<br /><span class="error">'.$email_err.'</span>';
            }
        ?>
        <br />
        <input name="email" id="email" type="email" placeholder="Имейл" />
        <br />
        <label for="password">Парола</label>
        <?php
            if(!empty($password_err)){
                echo '<br /><span class="error">'.$password_err.'</span>';
            }
        ?>
        <br />
        <input name="password" id="password" type="password" placeholder="Парола" />
        <br />
        <label for="confirm_password">Потвърдете паролата</label>
        <?php
            if(!empty($confirm_password_err)){
                echo '<br /><span class="error">'.$confirm_password_err.'</span>';
            }
        ?>
        <br />
        <input name="confirm_password" id="confirm_password" type="password" placeholder="Потвърдете паролата" />
        <br />
        <?php require("../include/captcha-html.php"); ?>
        <br />
        <button type="submit">Регистрация</button>
        <p>Отиди към (<a href="login.php">ВХОД</a>).</p>
    </form>
</div>
<?php
include_once("../include/footer.php");
?>