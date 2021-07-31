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
$upload_profile_picture = "";
$upload_profile_picture_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty($_FILES["upload_profile_picture"]["name"])){
        $upload_profile_picture_err = "Моля изберете снимка.";
    }else{
        $username = $_SESSION["username"];
        $target_dir = "../uploads/$username/profile-picture/";
        
        // Check if folder not exist
        if(!file_exists($target_dir)){
            mkdir($target_dir, 0777, true);
        }else{
            array_map('unlink', glob("$target_dir/*.*"));
            rmdir($target_dir);
            mkdir($target_dir, 0777, true);
        }
        
        $target_file = $target_dir . basename($_FILES["upload_profile_picture"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
        // Check if image file is actual image or fake image
        $check = getimagesize($_FILES["upload_profile_picture"]["tmp_name"]);
        
        // Validate profile picture
        if($check !== false){
            // Check file size
            if(!($_FILES["upload_profile_picture"]["size"] > 1000000)){
                if($imageFileType = "jpg" && $imageFileType = "png" && $imageFileType = "jpeg" && $imageFileType = "gif"){
                    if(move_uploaded_file($_FILES["upload_profile_picture"]["tmp_name"], $target_file)){
                        echo "<script>alert('ВАШАТА СНИМКА Е КАЧЕНА УСПЕШНО!');location.href='index.php';</script>";
                    }else{
                        $upload_profile_picture_err = "За съжаление при качването на вашият файл възникна грешка.";
                    }
                }else{
                    $upload_profile_picture_err = "Позволените файлови разширения са JPG, JPEG, PNG и GIF.";
                }
            }else{
                $upload_profile_picture_err = "Снимката ви е твърде голяма.";
            }
        }else{
            $upload_profile_picture_err = "Файлът не е снимка.";
        }
    }
}
?>

<div class="text-center border">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        <h1>Качи профилна снимка</h1>
        <label>Профилна снимка (1MB MAX)</label>
        <?php
            if(!empty($upload_profile_picture_err)){
                echo '<br /><span class="error">'.$upload_profile_picture_err.'</span>';
            }
        ?>
        <br />
        <input name="upload_profile_picture" type="file" accept="image/*">
        <br />
        <a href="index.php"><button type="button">Назад</button><button type="submit">Качи</button>
    </form>
</div>

<?php
include_once("../include/footer.php");
?>