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
$password = $new_password = $confirm_new_password = "";
$password_err = $new_password_err = $confirm_new_password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate password
    if(empty(trim(htmlspecialchars($_POST["password"])))){
        $password_err = "Моля въведете вашата парола.";
    }else{
        $password = trim(htmlspecialchars($_POST["password"]));
    }

    // Validate new password
    if(empty(trim(htmlspecialchars($_POST["new_password"])))){
        $new_password_err = "Моля въведете нова парола.";        
    }elseif(strlen(trim(htmlspecialchars($_POST["password"]))) < 8){
        $new_password_err = "Паролата трябва да е поне 8 символа.";
    }elseif(strlen(trim(htmlspecialchars($_POST["password"]))) > 255){
        $new_password_err = "Максималната дължина на паролата е 255 символа.";
    }elseif(!preg_match('/[\d]/', trim(htmlspecialchars($_POST["password"])))){
        $new_password_err = "Вашата парола трябва да съдържа поне една цифра.";
    }else{
        $new_password = trim(htmlspecialchars($_POST["new_password"]));
    }

    // Validate confirm new password
    if(empty(trim(htmlspecialchars($_POST["confirm_new_password"])))){
        $confirm_new_password_err = "Моля потвърдете вашата парола.";
    }else{
        $confirm_new_password = trim(htmlspecialchars($_POST["confirm_new_password"]));
        if(empty($new_password_err) && ($new_password != $confirm_new_password)){
            $confirm_new_password_err = "Паролите не съвпадат.";
        }
    }

    // Check input errors before inserting in database
    if(empty($password_err) && empty($new_password_err) && empty($confirm_new_password_err)){
        // Prepare an update statement
        $sql = "UPDATE users SET password = :password WHERE id = :id";

        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
            $stmt->bindParam(":id", $param_id, PDO::PARAM_STR);

            // Set parameters
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                echo "<script>alert('ВАШАТА ПАРОЛА Е ПРОМЕНЕНА УСПЕШНО!');location.href='index.php';</script>";
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
    <h1>Промени паролата</h1>
    <label>Текуща парола</label>
    <?php
        if(!empty($password_err)){
            echo '<br /><span class="error">'.$password_err.'</span>';
        }
    ?>
    <br />
    <input type="password" name="password" placeholder="Текуща парола" required />
    <br />
    <label>Нова парола</label>
    <?php
        if(!empty($new_password_err)){
            echo '<br /><span class="error">'.$new_password_err.'</span>';
        }
    ?>
    <br />
    <input type="password" name="new_password" placeholder="Нова парола" required />
    <br />
    <label>Потвърдете новата парола</label>
    <?php
        if(!empty($confirm_new_password_err)){
            echo '<br /><span class="error">'.$confirm_new_password_err.'</span>';
        }
    ?>
    <br />
    <input type="password" name="confirm_new_password" placeholder="Потвърдете новата парола" required />
    <br />
    <a href="index.php"><button type="button">Назад</button><button>Промени</button>
    </form>
</div>
<?php
include_once("../include/footer.php");
?>