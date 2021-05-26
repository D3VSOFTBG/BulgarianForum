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
                        <p style="font-size: 25px;">Име на форум</p>
                    </th>
                    <th>
                        <p><a href="#">[-]</a></p>
                    </th>
                </tr>
                <tr>
                    <!--New posts-->
                    <td>X</td>
                    <!--Category (Name/Description)-->
                    <td><p><strong><a href="#">Име на категория</a></strong></p></td>
                    <!--Statistics (Topics/Posts)-->
                    <td><p>Публикации:&nbsp;<strong>1</strong></p></td>
                    <td><p>Теми:&nbsp;<strong>1</strong></p></td>
                </tr>                
            </table>
        </div>
        <footer>
            <p class="text-center"><a href="#">BulgarianForum</a> &copy; 2021
        </footer>
    </body>
</html>