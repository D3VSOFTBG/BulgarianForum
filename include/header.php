<?php
include_once("config.php")
?>
<html>

<head>
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="<?php echo $url; ?>/assets/css/style.css">
    <link rel="icon" type="image/png" href="<?php echo $url; ?>/assets/images/logo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
<h1 class="text-center"><?php echo $title; ?></h1>

<nav class="topnav" id="myTopnav">
    <a href="javascript:void(0);" class="icon" onclick="nav()">
        <img src="<?php echo $url; ?>/assets/images/nav.png" />&nbsp;НАВИГАЦИЯ
    </a>
    <a href="auth/register.html">Регистрация</a>
    <a href="auth/login.html">Вход</a>
    <a href="#">Търси</a>
</nav>