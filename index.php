<?php
include_once("include/header.php");
?>
<h1 style="text-align:center;"><?php echo $title; ?></h1>

<nav class="topnav" id="myTopnav">
    <a href="javascript:void(0);" class="icon" onclick="nav()">
        <img src="<?php echo $url; ?>/assets/images/nav.png" />&nbsp;НАВИГАЦИЯ
    </a>
    <a href="#home">Home</a>
    <a href="#news">News</a>
    <a href="#contact">Contact</a>
    <a href="#about">About</a>
</nav>
<!--<input type="search" placeholder="Търси" style="padding: 10px;" />-->
<div style="overflow-x:auto;">
    <table>
        <tr>
            <!--Forum Name-->
            <th colspan="3">
                <p style="font-size:25px;">Име на форум</p>
            </th>
            <th>
                <p><a href="#">[-]</a></p>
            </th>
        </tr>
        <tr>
            <!--New posts-->
            <td>X</td>
            <!--Category (Name/Description)-->
            <td>
                <p><strong><a href="#">Име на категория</a></strong></p>
            </td>
            <!--Statistics (Topics/Posts)-->
            <td>
                <p>Публикации:&nbsp;<strong>1</strong></p>
            </td>
            <td>
                <p>Теми:&nbsp;<strong>1</strong></p>
            </td>
        </tr>
    </table>
</div>
<br />
<table>
    <tr>
        <td colspan="3">Статистика</td>
    </tr>
    <tr>
        <td>Брой публикации</td>
        <td>Брой теми</td>
        <td>Регистрирани потребители</td>
    </tr>
    <tr>
        <td>1</td>
        <td>1</td>
        <td>1</td>
    </tr>
</table>
<?php
include_once("include/footer.php");
?>