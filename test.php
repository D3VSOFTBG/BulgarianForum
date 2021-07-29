<?php
// echo substr(md5(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789')) , 0 , 32)."<br>";


// Initialize the session
session_start();

if(!isset($_SESSION["Token_sent_time"])){

    $_SESSION["Token_sent_time"] = time();
}else{
    echo $_SESSION["Token_sent_time"];
    echo "<br>";
    echo time() - $_SESSION["Token_sent_time"];

    if(time() - $_SESSION["Token_sent_time"] > 1800){
        echo "Your session is expired";
        session_unset();
    }
}


?>