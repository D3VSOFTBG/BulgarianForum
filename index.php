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
                <th colspan="4">
                    <p style="font-size: 25px;">Име на форум</p>
                </th>
            </tr>
            <tr>
                <!--New posts-->
                <td>X</td>
                <!--Category (Name/Description)-->
                <td><p><strong><a href="#">Име на категория</a></strong></p></td>
                <!--Statistics (Topics/Posts)-->
                <td><p>Теми:&nbsp;<strong>1</strong></p></td>
                <td><p>Публикации:&nbsp;<strong>1</strong></p></td>
        </table>
        </div>
    </body>
</html>