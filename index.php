<?php
// Initialize the session
session_start();

// Include database file
require_once("include/db.php");

// Include header file
include_once("include/header.php");

$registered_users = 0;

// Prepare a select statement
$sql = "SELECT id from users";

if($stmt = $pdo->prepare($sql)){
    if($stmt->execute()){
        $registered_users = $stmt->rowCount();
    }
}
?>
<div class="responsive">
    <table>
        <tr>
            <!--Category (Name/Description)-->
            <th colspan="3">
                <p>Име на категория</p>
            </th>
            <th>
                <p><a href="#">&#10133;&#10134;</a></p>
            </th>
        </tr>
        <tr>
            <!--New posts-->
            <td>X</td>
            <!--Forum Name-->
            <td>
                <p><strong><a href="#">Име на форум</a></strong></p>
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
        <td><?php echo $registered_users; ?></td>
    </tr>
</table>
<?php
include_once("include/footer.php");
?>