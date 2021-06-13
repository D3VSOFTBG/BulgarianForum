<?php
include_once("include/header.php");
?>
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