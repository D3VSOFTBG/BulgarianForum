<?php
include_once("config.php")
?>
<html>

<head>
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="<?php echo $url; ?>/assets/css/style.css">
    <link rel="icon" type="image/png" href="<?php echo $url; ?>/assets/images/logo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo $title; ?>">
</head>

<body>
<h1 class="text-center"><?php echo $title; ?></h1>

<nav class="topnav" id="myTopnav">
    <a href="javascript:void(0);" class="icon" onclick="nav()">
        <img src="<?php echo $url; ?>/assets/images/nav.png" />&nbsp;НАВИГАЦИЯ
    </a>
    <a href="<?php echo $url; ?>">Начало</a>
    <a href="<?php echo $url; ?>/auth/register.php">Регистрация</a>
    <a href="<?php echo $url; ?>/auth/login.php">Вход</a>
    <a href="#">Търси</a>
</nav>