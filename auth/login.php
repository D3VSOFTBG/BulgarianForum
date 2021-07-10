<?php
// CAPTCHA
require_once("captcha.php");

// Include header file
include_once("../include/header.php");

// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect people to index page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ../index.php");
    exit;
}
// Include database file
require_once("../include/db.php");

// Define variables and initialize with empty values
$username = $password = $captcha = "";
$username_err = $password_err = $login_err = $captcha_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty(trim($_POST["captcha"]))){
        $captcha_err = "Моля решете задачата.";
    }else{
        $captcha = trim($_POST["captcha"]);
        if($captcha == $result){
            if(empty(trim($_POST["username"]))){
                $username_err = "Моля въведете потребителско име.";
            }else{
                $username = trim($_POST["username"]);
            }
        
            // Check if password is empty
            if(empty(trim($_POST["password"]))){
                $password_err = "Моля въведете вашата парола.";
            }else{
                $password = trim($_POST["password"]);
            }
        
            // Validate credentials
            if(empty($username_err) && empty($password_err)){
                // Prepare a select statement
                $sql = "SELECT id, username, password FROM users WHERE username = :username";
        
                if($stmt = $pdo->prepare($sql)){
                    // Bind variables to the prepared statement as parameters
                    $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
        
                    // Set parameters
                    $param_username = trim($_POST["username"]);
        
                    // Attempt to execute the prepared statement
                    if($stmt->execute()){
                        // Check if username exists, if yes then verify password
                        if($stmt->rowCount() == 1){
                            if($row = $stmt->fetch()){
                                $id = $row["id"];
                                $username = $row["username"];
                                $hashed_password = $row["password"];
                                if(password_verify($password, $hashed_password)){
                                    // Password is correct, so start a new session
                                    session_start();
        
                                    // Store data in session variables
                                    $_SESSION["loggedin"] = true;
                                    $_SESSION["id"] = $id;
                                    $_SESSION["username"] = $username;
        
                                    // Redirect user to index page
                                    header("location: index.php");
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
            $captcha_err = "Грешен отговор, моля опитайте отново";
        }
    }
}
?>
<table>
    <tr>
        <td>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <?php
                if(!empty($login_err)){
                    echo '<br /><span style="color: red;">'.$login_err.'</span>';
                }
                ?>
                <h1>Вход</h1>
                <label for="username">Потребителско име</label>
                <?php
                if(!empty($username_err)){
                    echo '<br /><span style="color: red;">'.$username_err.'</span>';
                }
                ?>
                <br />
                <input name="username" id="username" type="text" placeholder="Потребителско име" />
                <br />
                <label for="password">Парола</label>
                <?php
                if(!empty($password_err)){
                    echo '<br /><span style="color: red;">'.$password_err.'</span>';
                }
                ?>
                <br />
                <input name="password" id="password" type="password" placeholder="Парола" />
                <br />
                <label for="captcha">Капча (<strong><span style="color: red;"><?php echo $_COOKIE["number1"]; ?> + <?php echo $_COOKIE["number2"]; ?> = ?</span>)</strong></label>
                <?php
                if(!empty($captcha_err)){
                    echo '<br /><span style="color: red;">'.$captcha_err.'</span>';
                }
                ?>
                <br />
                <input name="captcha" id="captcha" type="number" placeholder="Моля решете задачата" />
                <div class="text-center">
                    <button type="submit">Вход</button>
                    <p>Отиди към (<a href="<?php echo $url; ?>">Начална страница</a>).</p>
                </div>
            </form>
        </td>
    </tr>
</table>
<?php
include_once("../include/footer.php");
?>