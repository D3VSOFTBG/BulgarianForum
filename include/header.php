<?php
# Include config file
include_once("config.php");
?>
<!DOCTYPE html>
<html>

<head>
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="<?php echo $url; ?>/assets/css/style.css">
    <link rel="icon" type="image/png" href="<?php echo $url; ?>/assets/images/logo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo $title; ?>">
    <meta name="keywords" content="<?php echo $title; ?>">
</head>

<body>
    <h1 class="text-center"><?php echo $title; ?></h1>

    <nav class="topnav" id="myTopnav">
        <a href="javascript:void(0);" class="icon" onclick="nav()">
            <img src="<?php echo $url; ?>/assets/images/nav.png" />&nbsp;НАВИГАЦИЯ
        </a>
        <a href="<?php echo $url; ?>">&#127968;&nbsp;Начало</a>
        <?php
        if(empty($_SESSION["id"])){
            echo "<a href='$url/auth/register.php'>&#9940;&nbsp;Регистрация</a>";
            echo "<a href='$url/auth/login.php'>&#128273;&nbsp;Вход</a>";
        }else{
            echo "<a href='$url/settings/index.php'>&#9881;&nbsp;Настройки</a>";
        }
        ?>
        <a href="<?php echo $url; ?>/pages/search.php">&#128269;&nbsp;Търси</a>
    </nav>
    <?php
        // Check if username's session is empty
        if(empty($_SESSION["username"])){
            echo '<p class="text-center alert">Моля влез или се регистрирай!</p>';
        }else{
            echo "<p class='text-center alert'>Здравей <strong>" . $_SESSION["username"] . "</strong>, (<a href='$url/auth/logout.php'><strong>ИЗЛЕЗ</strong></a>).</p>";
        }       
    ?>