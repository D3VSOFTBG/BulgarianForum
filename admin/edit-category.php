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
$error = false;

if(isset($_GET["id"])){
    // Select statement
    $sql = "SELECT category_name FROM categories WHERE id = :id";

    if($stmt = $pdo->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":id", $param_id, PDO::PARAM_INT);

        // Set parameters
        $param_id = trim(htmlspecialchars($_GET["id"]));

        // Attempt to execute the prepared statement
        if($stmt->execute()){
            if($stmt->rowCount() != 0){
                if($row = $stmt->fetch()){
                    $category_name = $row["category_name"];
                }
            }else{
                echo "<h1 class='text-center'>Категорията несъществува.</h1>";
                $error = true;
            }
        }else{
            echo "<h1 class='text-center'>Грешка, моля опитайте по късно.</h1>";
        }
        // Close statement
        unset($stmt);
    }
?>

<?php
if(!$error){
?>
<div class="text-center border">
    <h1>Редактирай категория</h1>
    <input type="text" id="category_name" name="category_name" placeholder="Име на категория" value="<?php echo $category_name; ?>" required>
    <br />
    <a href="categories.php"><button type="button">Назад</button></a><button type="submit">Редактирай</button>
</div>
<?php
}
?>


<?php
}else{
    echo "Грешка!";
}
include_once("../include/footer.php");
?>