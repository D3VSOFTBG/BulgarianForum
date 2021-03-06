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
$categories_err = "";

// Prepare a select statement
$sql = "SELECT id, category_name FROM categories";

if($stmt = $pdo->prepare($sql)){
    if($stmt->execute()){
        $result = $stmt->fetchAll();
        if($stmt->rowCount() == 0){
            $categories_err = "Няма намерени категории.";
        }
    }else{
        echo "<h1 class='text-center'>Грешка, моля опитайте по късно.</h1>";
    }
}
?>

<div class="text-center border">
    <?php
        if(!empty($categories_err)){
            echo '<br /><span class="error">'.$categories_err.'</span>';
        }
    ?>
    <h1>Категории</h1>
    <div class="responsive">
    <table>
        <?php
        foreach($result as $row){
        ?>
        <tr>
            <td>
                <?php echo $row["category_name"]; ?>
            </td>
            <td>
                <a href="edit-category.php?id=<?php echo $row["id"]; ?>"><button>Редактирай</button></a>
            </td>
            <td>
                <a href="delete-category.php?id=<?php echo $row["id"]; ?>"><button>Изтрий</button></a>
            </td>
        </tr>
        <?php
        }
        ?>
    </table>
    </div>
    <a href="index.php"><button>Назад</button></a><a href="create-category.php"><button>Създай категория</button></a>
</div>

<?php
include_once("../include/footer.php");
?>