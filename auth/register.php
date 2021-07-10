<?php
// Include header file
include_once("../include/header.php");

// Include database file
require_once("../include/db.php");

// Define variables and initialize with empty values
$username = $email = $password = $confirm_password = $captcha = "";
$username_err = $email_err = $password_err = $confirm_password_err = $captcha_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty(trim($_POST["captcha"]))){
        $captcha_err = "Моля решете задачата.";
    }
    
?>
<table>
    <tr>
        <td>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <h1>Регистрация</h1>
                <label for="username">Потребителско име</label>
                <?php
                if(!empty($username_err)){
                    echo '<br /><span style="color: red;">'.$username_err.'</span>';
                }
                ?>
                <br />
                <input name="username" id="username" type="text" placeholder="Потребителско име" />
                <br />
                <label for="email">Имейл</label>
                <?php
                if(!empty($email_err)){
                    echo '<br /><span style="color: red;">'.$email_err.'</span>';
                }
                ?>
                <br />
                <input name="email" id="email" type="email" placeholder="Имейл" />
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
                <label for="confirm_password">Потвърдете паролата</label>
                <?php
                if(!empty($confirm_password_err)){
                    echo '<br /><span style="color: red;">'.$confirm_password_err.'</span>';
                }
                ?>
                <br />
                <input name="confirm_password" id="confirm_password" type="password" placeholder="Потвърдете паролата" />
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