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
$email = $captcha = "";
$email_err = $captcha_err = "";

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
                            
                        }
                    }
                }
            }
        }
    }
}
?>
<div class="text-center border">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <h1>Забравена парола</h1>
        <label>Вашият имейл</label>
        <br />
        <input type="email" placeholder="Въведете вашият имейл" />
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