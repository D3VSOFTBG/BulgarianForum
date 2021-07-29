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
$password = $confirm_password = "";
$password_err = $confirm_password_err = $delete_account_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate password
    if(empty(trim(htmlspecialchars($_POST["password"])))){
        $password_err = "Моля въведете вашата парола.";
    }else{
        $password = trim(htmlspecialchars($_POST["password"]));
    }

    // Validate confirm password
    if(empty(trim(htmlspecialchars($_POST["confirm_password"])))){
        $confirm_password_err = "Моля потвърдете вашата парола.";
    }else{
        $confirm_password = trim(htmlspecialchars($_POST["confirm_password"]));
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Паролите не съвпадат";
        }
    }

    if(empty($password_err) && empty($confirm_password_err)){
        // Prepare a select statement
        $sql = "SELECT password FROM users WHERE username = :username";

        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
    
            // Set parameters
            $param_username = trim($_SESSION["username"]);
    
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Fetching data
                if($row = $stmt->fetch()){
                    // Checking password
                    if(password_verify($password, $row["password"])){
                        $pdo->prepare("DELETE FROM users WHERE username = ?")->execute([$_SESSION["username"]]);
                        session_destroy();
                        echo "<script>alert('ВАШИЯТ АКАУНТ Е ИЗТРИТ УСПЕШНО!');location.href='../auth/login.php';</script>";
                    }else{
                        $delete_account_err = "Грешна парола.";
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
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
        onsubmit="return deleteAccount();">
        <?php
            if(!empty($delete_account_err)){
                echo '<br /><span class="error">'.$delete_account_err.'</span>';
            }
        ?>
        <h1>Изтрий акаунта (<?php echo $_SESSION["username"] ?>)</h1>
        <label>Текуща парола</label>
        <?php
            if(!empty($password_err)){
                echo '<br /><span class="error">'.$password_err.'</span>';
            }
        ?>
        <br />
        <input type="password" name="password" placeholder="Текуща парола" />
        <br />
        <label>Потвърдете текущата парола</label>
        <?php
            if(!empty($confirm_password_err)){
                echo '<br /><span class="error">'.$confirm_password_err.'</span>';
            }
        ?>
        <br />
        <input type="password" name="confirm_password" placeholder="Потвърдете текущата парола" />
        <br />
        <button type="submit">Изтрий</button>
    </form>
</div>
<script>
    function deleteAccount() {
        if (confirm("Наистина ли искате да изтриете вашият акаунт?")) {
            return true;
        } else {
            return false;
        }
    }
</script>
<?php
include_once("../include/footer.php");
?>