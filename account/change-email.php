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
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);

            // Set parameters
            $param_email = trim(htmlspecialchars($_POST["new_email"]));

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $new_email_err = "Този имейл вече съществува.";
                }else{
                    $new_email = trim(htmlspecialchars($_POST["new_email"]));
                }
            }else{
                echo "<h1 class='text-center'>Грешка, моля опитайте по късно.</h1>";
            }
            // Close statement
            unset($stmt);
        }
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

    // Check input errors before inserting in database
    if(empty($new_email_err) && empty($confirm_new_email_err) && empty($password_err)){
        // Prepare an update statement
        $sql = "UPDATE users SET email = :email WHERE id = :id";

        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
            $stmt->bindParam(":id", $param_id, PDO::PARAM_STR);

            // Set parameters
            $param_email = $new_email;
            $param_id = $_SESSION["id"];

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                $_SESSION["email_confirmed"] = 0;
                $_SESSION["email"] = $new_email;
                $pdo->prepare("UPDATE users SET email_confirmed = ?, token = ?, token_created_time = ? WHERE email = ?")->execute([$_SESSION["email_confirmed"], NULL, NULL, $new_email]);
                echo "<script>alert('ВАШИЯТ ИМЕЙЛ Е ПРОМЕНЕН УСПЕШНО!');location.href='index.php';</script>";
            }else{
                echo "<h1 class='text-center'>Грешка, моля опитайте по късно.</h1>";
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
        <h1>Промени имейла</h1>
        <label for="new_email">Нов имейл</label>
        <?php
            if(!empty($new_email_err)){
                echo '<br /><span class="error">'.$new_email_err.'</span>';
            }
        ?>
        <br />
        <input type="email" id="new_email" name="new_email" placeholder="Нов имейл" required />
        <br />
        <label for="confirm_new_email">Потвърдете новият имейл</label>
        <?php
            if(!empty($confirm_new_email_err)){
                echo '<br /><span class="error">'.$confirm_new_email_err.'</span>';
            }
        ?>
        <br />
        <input type="email" id="confirm_new_email" name="confirm_new_email" placeholder="Потвърдете новият имейл" required />
        <br />
        <label for="password">Вашата парола</label>
        <?php
            if(!empty($password_err)){
                echo '<br /><span class="error">'.$password_err.'</span>';
            }
        ?>
        <br />
        <input type="password" id="password" name="password" placeholder="Вашата парола" required />
        <br />
        <a href="index.php"><button type="button">Назад</button></a><button type="submit">Промени</button>
    </form>

</div>
<?php
include_once("../include/footer.php");
?>