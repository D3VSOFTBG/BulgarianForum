<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../auth/login.php");
    exit;
}else{
    if($_SESSION["role"] !== "Administrator"){
        header("location: ../index.php");
        exit;
    }
}

// Include database file
require_once("../include/db.php");

// Include header file
include_once("../include/header.php");

// Define variables and initialize with empty values
$category_name = "";
$category_name_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty(trim(htmlspecialchars($_POST["category_name"])))){
        $category_name_err = "Моля въведете име на категория.";
    }else{
        // Prepare a select statement
        $sql = "SELECT category_name FROM categories WHERE category_name = :category_name";

        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":category_name", $param_category_name, PDO::PARAM_STR);

            // Set parameters
            $param_category_name = trim(htmlspecialchars($_POST["category_name"]));

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount()){
                    $category_name_err = "Тази категория вече съществува.";
                }else{
                    $category_name = trim(htmlspecialchars($_POST["category_name"]));
                }
            }else{
                echo "Грешка, моля опитайте по късно";
            }
            // Close statement
            unset($stmt);
        }
    }
    // Check input errors before inserting in database
    if(empty($category_name_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO categories (category_name) VALUES (:category_name)";

        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":category_name", $param_category_name, PDO::PARAM_STR);

            // Set parameters
            $param_category_name = $category_name;

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                echo "<script>alert('КАТЕГОРИЯТА Е СЪЗДАДЕНА УСПЕШНО!');</script>";
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
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h1>Създай категория</h1>
        <label for="category_name">Име на категория</label>
        <?php
            if(!empty($category_name_err)){
                echo '<br /><span class="error">'.$category_name_err.'</span>';
            }
        ?>
        <br />
        <input type="text" id="category_name" name="category_name" placeholder="Име на категория" required>
        <br />
        <a href="categories.php"><button type="button">Назад</button></a><button type="submit">Създай категория</button>
    </form>
</div>

<?php
include_once("../include/footer.php");
?>