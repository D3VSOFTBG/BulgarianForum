<?php
include_once("../include/header.php");
// Include database file
require_once("../include/db.php");

// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate username
    if(empty(trim($_POST['username']))){
        $username_err = "Моля, въведете потребителско име.";
    }elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Потребителското име единствено може да съдържа букви, цифри и долни черти.";
    }else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = :username";
        
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);

            // Set parameters
            $param_username = trim($_POST["username"]);

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $username_err = "Това потребителско име вече съществува.";
                }else{
                    $username = trim($_POST["username"]);
                }
            }else{
                echo "Грешка, моля опитайте след по късно.";
            }
            //Close statement
            unset($stmt);
        }
    }
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Моля, напишете парола";
    }
}
?>
<table>
    <tr>
        <td>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <h1>Регистрация</h1>
                <label for="username">Потребителско име</label>
                <br />
                <input name="username" id="username" type="text" placeholder="Потребителско име" />
                <br />
                <label for="email">Имейл</label>
                <br />
                <input name="email" id="email" type="email" placeholder="Имейл" />
                <br />
                <label for="password">Парола</label>
                <br />
                <input name="password" id="password" type="password" placeholder="Парола" />
                <br />
                <label for="password2">Потвърдете паролата</label>
                <br />
                <input name="password2" id="password2" type="password" placeholder="Потвърдете паролата" />
                <br />
                <div class="text-center">
                    <button type="submit">Регистрация</button>
                    <p>Отиди към (<a href="<?php echo $url; ?>">Начална страница</a>).</p>
                </div>
            </form>
        </td>
    </tr>
</table>
<?php
include_once("../include/footer.php");
?>