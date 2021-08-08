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
$error = false;
$id = trim(htmlspecialchars((int)$_GET["id"]));

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty(trim(htmlspecialchars($_POST["category_name"])))){
        $category_name_err = "Моля въведете име на категория.";
    }else{
        // Prepare a select statement
        $sql = "SELECT category_name, id FROM categories WHERE category_name = :category_name";
    
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":category_name", $param_category_name, PDO::PARAM_STR);
    
            // Set parameters
            $param_category_name = trim(htmlspecialchars($_POST["category_name"]));
    
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $category_name_err = "Тази категория вече съществува.";
                    $edit_category_id = $_SESSION["edit-category-id"];
                    header("location: edit-category.php?id=$edit_category_id");
                    }else{
                        echo "<script>alert('КАТЕГОРИЯТА Е ПРОМЕНЕНА УСПЕШНО!');window.history.back();</script>";
                        $sql = "UPDATE categories SET category_name = ? WHERE id = ?";
                        $pdo->prepare($sql)->execute([$param_category_name, $edit_category_id]);
                    }
                }else{
                    echo "<h1 class='text-center'>Грешка, моля опитайте по късно</h1>";
                }
            }
        }
    }else{
        // Select statement
$sql = "SELECT category_name FROM categories WHERE id = :id";

if($stmt = $pdo->prepare($sql)){
    // Bind variables to the prepared statement as parameters
    $stmt->bindParam(":id", $param_id, PDO::PARAM_INT);

    // Set parameters
    $param_id = $id;

    // Attempt to execute the prepared statement
    if($stmt->execute()){
        if($stmt->rowCount() != 0){
            if($row = $stmt->fetch()){
                $category_name = $row["category_name"];
                $_SESSION["edit-category-id"] = $id;
            }
        }else{
            $error = true;
            echo "<h1 class='text-center'>Категорията несъществува.</h1>";
        }
    }else{
        echo "<h1 class='text-center'>Грешка, моля опитайте по късно.</h1>";
    }
    // Close statement
    unset($stmt);
}
}
?>

<?php
if(!$error){
?>
<div class="text-center border">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h1>Редактирай категория</h1>
        <label for="category_name">Име на категория</label>
        <?php
            if(!empty($category_name_err)){
                echo '<br /><span class="error">'.$category_name_err.'</span>';
            }
        ?>
        <br />
        <input type="text" id="category_name" name="category_name" placeholder="Име на категория"
            value="<?php echo $category_name; ?>" required>
        <br />
        <a href="categories.php"><button type="button">Назад</button></a><button type="submit">Редактирай</button>
    </form>
</div>
<?php
}
?>

<?php
include_once("../include/footer.php");
?>