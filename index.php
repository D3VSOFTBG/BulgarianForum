<?php
include_once("config.php");
?>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <h1 style="text-align:center;"><?php echo $title; ?></h1>
        <div style="overflow-x:auto;">
        <table>
            <tr>
                <!--Forum Name-->
                <th colspan="3">
                    <p style="font-size: 50px;">Име на форум</p>
                </th>
            </tr>
            <tr>
                <!--New posts-->
                <td>X</td>
                <!--Category (Name/Description)-->
                <td><p><strong>Име на категория</strong></p><p style="font-size: 10px;">Описание на категория</p></td>
                <!--Statistics (Topics/Posts)-->
                <td><p style="font-size: 10px;">Теми:&nbsp;<strong>1</strong></p><p style="font-size: 10px;">Публикации:&nbsp;<strong>1</strong></p></td>
        </table>
</div>
    </body>
</html>