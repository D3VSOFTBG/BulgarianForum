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
$username = $password = $captcha = "";
$username_err = $password_err = $login_err = $captcha_err = "";

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
            }else{
                $username = trim(htmlspecialchars($_POST["username"]));
            }
        
            // Validate password
            if(empty(trim(htmlspecialchars($_POST["password"])))){
                $password_err = "Моля въведете вашата парола.";
            }else{
                $password = trim(htmlspecialchars($_POST["password"]));
            }
        
            // Validate credentials
            if(empty($username_err) && empty($password_err)){
                // Prepare a select statement
                $sql = "SELECT id, username, email, password, role, profile_picture FROM users WHERE username = :username";
        
                if($stmt = $pdo->prepare($sql)){
                    // Bind variables to the prepared statement as parameters
                    $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
        
                    // Set parameters
                    $param_username = trim(htmlspecialchars($_POST["username"]));
        
                    // Attempt to execute the prepared statement
                    if($stmt->execute()){
                        // Check if username exists, if yes then verify password
                        if($stmt->rowCount() == 1){
                            if($row = $stmt->fetch()){
                                $id = $row["id"];
                                $username = $row["username"];
                                $email = $row["email"];
                                $role = $row["role"];
                                $profile_picture = $row["profile_picture"];
                                $hashed_password = $row["password"];
                                if(password_verify($password, $hashed_password)){
                                    // Store data in session variables
                                    $_SESSION["loggedin"] = true;
                                    $_SESSION["id"] = $id;
                                    $_SESSION["username"] = $username;
                                    $_SESSION["email"] = $email;
                                    $_SESSION["role"] = $role;
                                    $_SESSION["profile_picture"] = $profile_picture;
        
                                    // Redirect user to index page
                                    header("location: ../index.php");
                                }else{
                                    // Password is not valid, display a generic error message
                                    $login_err = "Невалидно потребителско име или парола.";
                                }
                            }
                        }else{
                            // Username doesn't exist, display a generic error message
                            $login_err = "Невалидно потребителско име или парола.";
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
        }else{
            $captcha_err = "Грешна капча, моля опитайте отново";
        }
    }
}
?>
<div class="text-center border">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <?php
            if(!empty($login_err)){
                echo '<br /><span class="error">'.$login_err.'</span>';
            }
        ?>
        <h1>Вход</h1>
        <label for="username">Потребителско име</label>
        <?php
            if(!empty($username_err)){
                echo '<br /><span class="error">'.$username_err.'</span>';
            }
        ?>
        <br />
        <input name="username" id="username" type="text" placeholder="Потребителско име" required />
        <br />
        <label for="password">Парола</label>
        <?php
            if(!empty($password_err)){
                echo '<br /><span class="error">'.$password_err.'</span>';
            }
        ?>
        <br />
        <input name="password" id="password" type="password" placeholder="Парола" required />
        <br />
        <?php require("../include/captcha-html.php"); ?>
        <div class="text-center">
            <button type="submit">Вход</button>
            <p>Отиди към (<a href="register.php">Регистрация</a>).</p>
            <p>ИЛИ</p>
            <p>Отиди към (<a href="forgot-password.php">Забравена парола</a>).</p>
        </div>
    </form>
</div>
<?php
include_once("../include/footer.php");
?>