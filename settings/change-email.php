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
$new_email = $confirm_new_email = $password = "";
$new_email_err = $confirm_new_email_err = $password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate new email
    if(empty(trim(htmlspecialchars($_POST["new_email"])))){
        $new_email_err = "Moля въведете нов имейл.";
    }elseif(!filter_var(trim(htmlspecialchars($_POST["new_email"])), FILTER_VALIDATE_EMAIL)){
        $new_email_err = "Моля въведете правилен имейл.";
    }else{
        $sql = "SELECT email FROM users WHERE email = :email";

        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            //$stmt->bindParam(":email");
        }

        //$new_email = trim(htmlspecialchars($_POST["new_email"]));
    }

    // Validate confirm new email
    if(empty(trim(htmlspecialchars($_POST["confirm_new_email"])))){
        $confirm_new_email_err = "Моля потвърдете вашият имейл.";
    }else{
        $confirm_new_email = trim(htmlspecialchars($_POST["confirm_new_email"]));
        if(empty($new_email_err) && ($new_email != $confirm_new_email)){
            $confirm_new_email_err = "Имейлите не съвпадат.";
        }
    }

    // Validate password
    if(empty(trim(htmlspecialchars($_POST["password"])))){
        $password_err = "Моля въведете вашата парола.";
    }else{
        $password = trim(htmlspecialchars($_POST["password"]));
    }

}
?>
<div class="text-center border">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h1>Промени имейла</h1>
        <label>Нов имейл</label>
        <?php
            if(!empty($new_email_err)){
                echo '<br /><span class="error">'.$new_email_err.'</span>';
            }
        ?>
        <br />
        <input type="email" name="new_email" placeholder="Нов имейл" required />
        <br />
        <label>Потвърдете новият имейл</label>
        <?php
            if(!empty($confirm_new_email_err)){
                echo '<br /><span class="error">'.$confirm_new_email_err.'</span>';
            }
        ?>
        <br />
        <input type="email" name="confirm_new_email" placeholder="Потвърдете новият имейл" required />
        <br />
        <label>Вашата парола</label>
        <?php
            if(!empty($password_err)){
                echo '<br /><span class="error">'.$password_err.'</span>';
            }
        ?>
        <br />
        <input type="password" name="password" placeholder="Вашата парола" required />
        <br />
        <a href="index.php"><button type="button">Назад</button></a><button type="submit">Промени</button>
    </form>

</div>
<?php
include_once("../include/footer.php");
?>