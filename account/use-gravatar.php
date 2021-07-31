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

$email = $_SESSION["email"];

// Prepare an update statement
$sql = "UPDATE users SET profile_picture = :profile_picture WHERE id = :id";

if($stmt = $pdo->prepare($sql)){
    // Bind variables to the prepared statement as parameters
    $stmt->bindParam(":id", $param_id, PDO::PARAM_STR);
    $stmt->bindParam(":profile_picture", $param_profile_picture, PDO::PARAM_STR);

    // Set parameters
    $param_id = $_SESSION["id"];
    $param_profile_picture = "https://www.gravatar.com/avatar/" . md5(strtolower(trim($email)));

    // Attempt to execute the prepared statement
    if($stmt->execute()){
        $_SESSION["profile_picture"] = $param_profile_picture;
        echo "<script>alert('ВАШАТА СНИМКА Е ПРОМЕНЕНА УСПЕШНО!');location.href='index.php';</script>";
    }else{
        echo "Грешка, моля опитайте по късно.";
    }
    // Close statement
    unset($stmt);
}
// Close connection
unset($pdo);
?>

<img src="<?php echo $grav_url; ?>" alt="Grav" />