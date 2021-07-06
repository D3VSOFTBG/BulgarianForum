<?php
// If number1 or number2 is empty then refresh page
if(empty($_COOKIE["number1"])|| empty($_COOKIE["number2"])){
    header("Refresh:0");
}

// If cookie not exist, then set cookie
if(!isset($_COOKIE["CAPTCHA"])){
    setcookie("CAPTCHA", "Activated", NULL, NULL, NULL, TRUE, TRUE);
    $number1 = rand(1,10);
    $number2 = rand(1,10);
    setcookie("number1", $number1, NULL, NULL, NULL, TRUE, TRUE);
    setcookie("number2", $number2, NULL, NULL, NULL, TRUE, TRUE);
}else{
    $result = $_COOKIE["number1"] + $_COOKIE["number2"];
}
?>