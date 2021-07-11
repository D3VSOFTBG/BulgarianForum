<?php
// Initialize the session
session_start();

// Include header file
include_once("include/header.php");
?>

<?php
if(empty($_SESSION["username"])){
    echo '<p class="text-center">Моля влез или се регистрирай!</p>';
}else{
    echo '<p class="text-center">Здравей <strong>' . $_SESSION["username"] . '</strong>.</p>';
}
?>

<div style="overflow-x: auto;">
    <table>
        <tr>
            <!--Forum Name-->
            <th colspan="3">
                <h1>Име на форум</h1>
            </th>
            <th>
                <h1><a href="#">[-]</a></h1>
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